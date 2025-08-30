
    {{-- Search Bar --}}
    
    {{-- <div class="{{ $divClass }}">
        <input class="form-control" type="search" placeholder="{{ $placeholder }}" id="{{ $id }}" >
        
        <!-- Search Results -->
        <div id="show-search-results" class="search-results-{{ $page }}" style="z-index:9; position:absolute; width:97%;" hidden>
            <ul class="list-group">
                <a href="/category" class="list-group-item list-group-item-action">An item</a>
                <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
            </ul>
        </div>
    </div> --}}

    {{-- How this component is used..

        <x-front.search-bar 
            page="orders" 
            divClass="col-md-8"
            placeholder="Search orders"
            id="orders-search-bar"
        /> 

    --}}

    <div class="{{ $divClass }}">
        <div class="search-overlay-section">
            <button class="btn search-btn-re" id="searchBtn" style="background:#E5E6E4;">
                <i class="fas fa-search"></i>
            </button>

            <!-- Search Overlay -->
            <div class="search-overlay" id="searchOverlay">
                <div class="search-container">
                    <button class="close-btn" id="closeBtn">&times;</button>
                    
                    <form class="search-form" id="searchForm">
                        <h2 class="search-title">What are you looking for?</h2>
                        <p class="search-subtitle">Search through our content and find what you need</p>
                        
                        <div class="search-input-container">
                            <input 
                                type="text" 
                                class="search-input" 
                                id="searchInput"
                                placeholder="Type your search query..."
                                autocomplete="off"
                            >
                            <button type="submit" class="search-submit">
                                <svg viewBox="0 0 24 24">
                                    <path d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-0.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.792 0-6.877-3.085-6.877-6.877z"/>
                                </svg>
                            </button>
                        </div>
                    </form>

                    <div class="search-suggestions">
                        <div class="suggestions-title">Popular searches:</div>
                        <div class="suggestions-list">
                            <span class="suggestion-tag">Web Development</span>
                            <span class="suggestion-tag">JavaScript</span>
                            <span class="suggestion-tag">CSS Tips</span>
                            <span class="suggestion-tag">React</span>
                            <span class="suggestion-tag">Design Patterns</span>
                            <span class="suggestion-tag">API Integration</span>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>

        <div class="normal-search-section">
            <input class="form-control" type="search" placeholder="{{ $placeholder }}" id="{{ $id }}" >
            
            <!-- Search Results -->
            <div id="show-search-results" class="search-results-{{ $page }}" style="z-index:9; position:absolute; width:97%;" hidden>
                <ul class="list-group">
                    <a href="/category" class="list-group-item list-group-item-action">An item</a>
                    <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                    <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                    <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                    <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>
                </ul>
            </div>
        </div>
    </div>



    

    

    @push('searchbar-scripts')
        <script>
            console.log('SEARCHBAR COMPONENT');
        </script>

        <script>
            class SearchOverlay {
                constructor() {
                    this.searchBtn = document.getElementById('searchBtn');
                    this.searchOverlay = document.getElementById('searchOverlay');
                    this.closeBtn = document.getElementById('closeBtn');
                    this.searchForm = document.getElementById('searchForm');
                    this.searchInput = document.getElementById('searchInput');
                    this.suggestionTags = document.querySelectorAll('.suggestion-tag');
                    
                    this.init();
                }

                init() {
                    this.bindEvents();
                }

                bindEvents() {
                    // Open overlay
                    this.searchBtn.addEventListener('click', () => this.openOverlay());
                    
                    // Close overlay
                    this.closeBtn.addEventListener('click', () => this.closeOverlay());
                    this.searchOverlay.addEventListener('click', (e) => {
                        if (e.target === this.searchOverlay) {
                            this.closeOverlay();
                        }
                    });

                    // Keyboard shortcuts
                    document.addEventListener('keydown', (e) => {
                        if (e.key === 'Escape') {
                            this.closeOverlay();
                        }
                        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                            e.preventDefault();
                            this.openOverlay();
                        }
                    });

                    // Search form submission
                    this.searchForm.addEventListener('submit', (e) => {
                        e.preventDefault();
                        this.performSearch();
                    });

                    // Suggestion tags
                    this.suggestionTags.forEach(tag => {
                        tag.addEventListener('click', () => {
                            this.searchInput.value = tag.textContent;
                            this.searchInput.focus();
                        });
                    });

                    // Input focus on overlay open
                    this.searchOverlay.addEventListener('transitionend', () => {
                        if (this.searchOverlay.classList.contains('active')) {
                            this.searchInput.focus();
                        }
                    });
                }

                openOverlay() {
                    this.searchOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                    
                    // Focus input after animation
                    setTimeout(() => {
                        this.searchInput.focus();
                    }, 300);
                }

                closeOverlay() {
                    this.searchOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                    this.searchInput.value = '';
                }

                performSearch() {
                    const query = this.searchInput.value.trim();
                    
                    if (query) {
                        // Here you would typically send the search query to your backend
                        // For demo purposes, we'll just show an alert
                        alert(`Searching for: "${query}"`);
                        
                        // You can replace this with actual search logic:
                        // - Make API call
                        // - Redirect to search results page
                        // - Show results in the overlay
                        
                        this.closeOverlay();
                    }
                }
            }

            // Initialize the search overlay when DOM is loaded
            document.addEventListener('DOMContentLoaded', () => {
                new SearchOverlay();
            });
        </script>
    @endpush