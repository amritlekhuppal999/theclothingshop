
    <div>
        
        <nav class="main-header navbar navbar-expand-md navbar-white navbar-light"
            id="nav-header">
            <div class="container-fluid">
                
                <!-- collapsed -->  {{-- Appears when viewport changes --}}
                <button 
                    class="navbar-toggler order-1" 
                    id="mobile-toggle"
                    {{-- data-toggle="collapse" data-target="#navbarCollapse"  --}}
                    {{-- aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation" --}}
                    type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- LOGO -->
                <x-front.navbar.nav-logo view="normal" />
        
                <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                    <!-- Left navbar links -->
                    <x-front.navbar.nav-menu :categories="$categories"  />
                </div>
                
        
        
                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto" id="right-nav-bar" style="">
                    <div class="d-flex align-items-center justify-content-between pl-3" id="right-nav-bar-cont">
                        <!-- SEARCH FORM -->
                        {{-- <x-front.searchbar /> --}}
                        
                        <!-- Messages Dropdown Menu -->
                        <x-front.navbar.nav-profile />
                        
                        <!-- Wishlist -->
                        <x-front.navbar.nav-wishlist />
                            
                        <!-- shopping cart -->
                        <x-front.navbar.nav-cart />

                        
                    
                    </div>  
                    
                </ul>
            </div>
        </nav>


        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <!-- LOGO -->
                <x-front.navbar.nav-logo view="mobile" />

                <button class="sidebar-close" id="sidebar-close">✕</button>
            </div>

            <x-front.sidebar.sidebar-menu :categories="$categories" />
            
        </aside>

        <!-- Overlay -->
        <div class="overlay" id="overlay"></div>


        {{-- NAVBAR in FOOTER FOR MOBILE VIEW --}}
        <nav class="nav-footer-re d-flex align-items-center justify-content-around">
            {{-- FOOTER BITCHES --}}
            <!-- SEARCH FORM -->
            <x-front.searchbar />
            
            <!-- Wishlist -->
            <x-front.navbar.nav-wishlist />
                
            <!-- shopping cart -->
            <x-front.navbar.nav-cart />
        </nav>

    </div>


    @once
        <script>
            const mobileToggle = document.getElementById('mobile-toggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarClose = document.getElementById('sidebar-close');
            const overlay = document.getElementById('overlay');
            //const topnav = document.getElementById('topnav');
            //const profileBtn = document.getElementById('profile-btn');
            //const profileDropdown = document.getElementById('profile-dropdown');

            function openSidebar() {
                sidebar.classList.add('active');
                overlay.classList.add('active');
                //topnav.classList.add('sidebar-open');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                //topnav.classList.remove('sidebar-open');
                document.body.style.overflow = 'auto';
            }

            // Sidebar functionality
            mobileToggle.addEventListener('click', openSidebar);
            sidebarClose.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);

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
            
        </script>
    @endonce


    