
    <nav class="main-header navbar navbar-expand-md navbar-white navbar-light">
        <div class="container-fluid">
            
            <!-- LOGO -->
            <x-front.navbar.nav-logo />

            

            <style>
                /*
                @media screen and (min-width: 320px) {
                    #navbarCollapse{
                        max-width:250px;
                    }
                }

                @media screen and (min-width: 778px) {
                    #navbarCollapse{
                        width:250px;
                    }
                }*/
            </style>
    
            <div class="collapse navbar-collapse order-3" id="navbarCollapse" >

                <!-- Left navbar links -->
                <x-front.navbar.nav-menu :categories="$categories"  />
            </div>
            
    
    
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto ">
                <div class="d-flex justify-content-between pl-3" >
                    <!-- SEARCH FORM -->
                    <x-front.searchbar />
                    
                    <!-- Messages Dropdown Menu -->
                    <x-front.navbar.nav-profile />
                    
                    <!-- Wishlist -->
                    <x-front.navbar.nav-wishlist />
                        
                    <!-- shopping cart -->
                    <x-front.navbar.nav-cart />

                    <!-- collapsed -->  {{-- Appears when viewport changes --}}
                    <button 
                        class="navbar-toggler order-1" 
                        type="button" 
                        data-toggle="collapse" data-target="#navbarCollapse" 
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                
                </div>  
                
            </ul>
        </div>
    </nav>


    