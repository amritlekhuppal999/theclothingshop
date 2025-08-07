    <!-- Top Navigation -->
    <nav class="topnav" id="topnav">
        <div class="nav-container justify-content-md-evenly p-2">
            <a href="#" class="logo">
                <div class="logo-icon">R</div>
                TheClothingShop
            </a>

            <ul class="nav-menu-re mt-3 pl-0">
                <li class="nav-item-re">
                    <a href="#" class="nav-link-re">
                        Topwear
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item">T-Shirts</a>
                        <a href="#" class="dropdown-item">Shirts</a>
                        <a href="#" class="dropdown-item">Hoodies</a>
                        <a href="#" class="dropdown-item">Jackets</a>
                        <a href="#" class="dropdown-item">Sweaters</a>
                    </div>
                </li>

                <li class="nav-item-re">
                    <a href="#" class="nav-link-re">
                        Bottomwear
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item">Jeans</a>
                        <a href="#" class="dropdown-item">Trousers</a>
                        <a href="#" class="dropdown-item">Shorts</a>
                        <a href="#" class="dropdown-item">Track Pants</a>
                    </div>
                </li>

                <li class="nav-item-re">
                    <a href="#" class="nav-link-re">
                        Bestseller
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item">Top Rated</a>
                        <a href="#" class="dropdown-item">Most Popular</a>
                        <a href="#" class="dropdown-item">Trending Now</a>
                        <a href="#" class="dropdown-item">Customer Favorites</a>
                    </div>
                </li>

                <li class="nav-item-re">
                    <a href="#" class="nav-link-re">
                        Sneakers
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item">Running Shoes</a>
                        <a href="#" class="dropdown-item">Casual Sneakers</a>
                        <a href="#" class="dropdown-item">High Tops</a>
                        <a href="#" class="dropdown-item">Basketball Shoes</a>
                    </div>
                </li>

                <li class="nav-item-re">
                    <a href="#" class="nav-link-re">
                        Accessories
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item">Bags</a>
                        <a href="#" class="dropdown-item">Wallets</a>
                        <a href="#" class="dropdown-item">Belts</a>
                        <a href="#" class="dropdown-item">Watches</a>
                        <a href="#" class="dropdown-item">Sunglasses</a>
                    </div>
                </li>

                <li class="nav-item-re">
                    <a href="#" class="nav-link-re">
                        Collection
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item">Summer Collection</a>
                        <a href="#" class="dropdown-item">Winter Collection</a>
                        <a href="#" class="dropdown-item">Formal Wear</a>
                        <a href="#" class="dropdown-item">Casual Wear</a>
                    </div>
                </li>

                <li class="nav-item-re">
                    <a href="#" class="nav-link-re">
                        Themes
                        <span class="dropdown-arrow">▼</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-item">Minimalist</a>
                        <a href="#" class="dropdown-item">Vintage</a>
                        <a href="#" class="dropdown-item">Sporty</a>
                        <a href="#" class="dropdown-item">Urban</a>
                    </div>
                </li>
            </ul>

            <div class="nav-actions">
                <div class="search-container">
                    {{-- <input type="text" class="search-input" placeholder="Search"> --}}
                    <button class="search-btn">🔍</button>
                </div>
                <div class="profile-dropdown" id="profile-dropdown">
                    <button class="profile-btn" id="profile-btn">
                        <i class="fas fa-user-alt"></i>
                        {{-- <span style="font-size: 10px;">▼</span> --}}
                    </button>
                    <div class="profile-menu">
                        <a href="#" class="profile-menu-item">My Profile</a>
                        <a href="#" class="profile-menu-item">My Orders</a>
                        <a href="#" class="profile-menu-item">Wishlist</a>
                        <a href="#" class="profile-menu-item">Settings</a>
                        <a href="#" class="profile-menu-item">Help & Support</a>
                        <a href="#" class="profile-menu-item">Logout</a>
                    </div>
                </div>
                <button class="icon-btn"><i class="fas fa-heart"></i></button>
                <button class="icon-btn"><i class="fas fa-shopping-cart"></i></button>
                <button class="mobile-toggle" id="mobile-toggle">☰</button>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-logo">
                <div class="logo-icon">R</div>
                TheClothingShop
            </a>
            <button class="sidebar-close" id="sidebar-close">✕</button>
        </div>

        <nav class="sidebar-menu">
            <div class="sidebar-item">
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    <span class="sidebar-icon">👕</span>
                    Topwear
                    <span class="sidebar-arrow">▶</span>
                </div>
                <div class="sidebar-submenu">
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">T-Shirts</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Shirts</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Hoodies</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Jackets</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Sweaters</a>
                    </div>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    <span class="sidebar-icon">👖</span>
                    Bottomwear
                    <span class="sidebar-arrow">▶</span>
                </div>
                <div class="sidebar-submenu">
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Jeans</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Trousers</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Shorts</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Track Pants</a>
                    </div>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    <span class="sidebar-icon">⭐</span>
                    Bestseller
                    <span class="sidebar-arrow">▶</span>
                </div>
                <div class="sidebar-submenu">
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Top Rated</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Most Popular</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Trending Now</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Customer Favorites</a>
                    </div>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    <span class="sidebar-icon">👟</span>
                    Sneakers
                    <span class="sidebar-arrow">▶</span>
                </div>
                <div class="sidebar-submenu">
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Running Shoes</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Casual Sneakers</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">High Tops</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Basketball Shoes</a>
                    </div>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    <span class="sidebar-icon">👜</span>
                    Accessories
                    <span class="sidebar-arrow">▶</span>
                </div>
                <div class="sidebar-submenu">
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Bags</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Wallets</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Belts</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Watches</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Sunglasses</a>
                    </div>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    <span class="sidebar-icon">📁</span>
                    Collection
                    <span class="sidebar-arrow">▶</span>
                </div>
                <div class="sidebar-submenu">
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Summer Collection</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Winter Collection</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Formal Wear</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Casual Wear</a>
                    </div>
                </div>
            </div>

            <div class="sidebar-item">
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    <span class="sidebar-icon">🎨</span>
                    Themes
                    <span class="sidebar-arrow">▶</span>
                </div>
                <div class="sidebar-submenu">
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Minimalist</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Vintage</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Sporty</a>
                    </div>
                    <div class="sidebar-subitem">
                        <a href="#" class="sidebar-sublink">Urban</a>
                    </div>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>


    @once
        <script>
            const mobileToggle = document.getElementById('mobile-toggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarClose = document.getElementById('sidebar-close');
            const overlay = document.getElementById('overlay');
            const topnav = document.getElementById('topnav');
            const profileBtn = document.getElementById('profile-btn');
            const profileDropdown = document.getElementById('profile-dropdown');

            function openSidebar() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
                topnav.classList.add('sidebar-open');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                topnav.classList.remove('sidebar-open');
                document.body.style.overflow = 'auto';
            }

            // Sidebar functionality
            mobileToggle.addEventListener('click', openSidebar);
            sidebarClose.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

            // Profile dropdown functionality
            profileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('active');
            });

            // Close profile dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!profileDropdown.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                }
            });

            // Sidebar treeview functionality
            function toggleSidebarItem(element) {
                const parentItem = element.parentElement;
                const isExpanded = parentItem.classList.contains('expanded');

                // Close all other expanded items
                document.querySelectorAll('.sidebar-item.expanded').forEach(item => {
                    if (item !== parentItem) {
                        item.classList.remove('expanded');
                    }
                });

                // Toggle current item
                parentItem.classList.toggle('expanded');
            }

            // Close sidebar when window is resized to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });

            // Close sidebar on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSidebar();
                    profileDropdown.classList.remove('active');
                }
            });

        </script>
    @endonce
