
    <nav class="main-header navbar navbar-expand-md navbar-white navbar-light">
        <div class="container-fluid">
            
            <!-- LOGO -->
            <x-front.navbar.nav-logo />

            <!-- collapsed -->  {{-- Appears when viewport changes --}}
            <button 
                class="navbar-toggler order-1 " 
                type="button" 
                data-toggle="collapse" data-target="#navbarCollapse" 
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                <!-- Left navbar links -->
                <x-front.navbar.nav-menu :categories="$categories" />
                
                <!-- SEARCH FORM -->
                <x-front.searchbar />
            </div>
            
    
    
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                
                <!-- Messages Dropdown Menu -->
                <x-front.navbar.nav-profile />
                
                <!-- Wishlist -->
                <x-front.navbar.nav-wishlist />
                    
                <!-- shopping cart -->
                <x-front.navbar.nav-cart />
                
            </ul>
        </div>
    </nav>