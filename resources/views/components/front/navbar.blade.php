@php
    $navItems = array(
        [
            "name" => "Topwear",
            "items" =>  [
                "All Topwear" => "all-topwear",
                "All T-Shirts" => "all-tshirts",
                "All Shirts" => "all-shirts",
                "Oversized  T-shirts" => "oversized-tshirts",
                "Polos" => "polos",
                "Solid  T-shirts" => "solid-tshirts",
                "Classic Fit T-shirts" => "classic-fit-tshirts",
                "Oversized Full Sleeve" => "oversized-full-sleeve",
                "Dropcut T-shirts" => "dropcut-tshirts",
                "Co-ord Sets" => "co-ord-sets",
                "Jackets" => "jackets",
                "Hoodies Sweatshirts" => "hoodies-sweatshirts"
            ]
        ],

        [
            "name" => "Bottomwear",
            "items" =>  [
                "All Bottomwear" => "all-bottomwear",
                "Pants" => "pants", 
                "Cargos" => "cargos",
                "Jeans" => "jeans",
                "Joggers" => "joggers",
                "Shorts" => "shorts",
                "Boxers Innerwear" => "boxers-innerwear",
                "Pajamas" => "pajamas"
            ]
        ],

        [
            "name" => "Bestseller",
            "items" =>  [
                "Best of T-shirts" => "best-of-tshirts",
                "Best of Shirts" => "best-of-shirts",
                "Best of Polos" => "best-of-polos",
                "Best of Bottoms" => "best-of-bottoms",
                "Best of Sneakers" => "best-of-sneakers"
            ]
        ],

        [
            "name" => "Sneakers",
            "items" =>  [
                "Sneakers" => "sneakers"
            ]
        ],

        [
            "name" => "Accessories",
            "items" =>  [
                "Comics" => "comics",
                "Manga" => "manga",
                "Mobile Covers" => "mobile-covers",
                "Backpacks" => "backpacks",
                "Posters" => "posters"
            ]
        ],

        [
            "name" => "Collection",
            "items" =>  [
                "New Arrivals" => "new-arrivals",
                "Best Sellers" => "best-sellers",
                "Supima" => "supima",
                "Pet Merch" => "pet-merch",
            ]
        ],

        [
            "name" => "Themes",
            "items" =>  [
                "Cartoons" => "cartoons",
                "Anime" => "anime",
                "Movies" => "movies",
                "TV Shows" => "tv-shows",
                "Sports" => "sports",
                "Games" => "games",
            ]
        ],
    );
@endphp



    <nav class="main-header navbar navbar-expand-md navbar-white navbar-light">
        <div class="container-fluid">
            
            <!-- LOGO -->
            <a href="/" class="navbar-brand">
                <!-- src="../../dist/img/AdminLTELogo.png" -->
                <!-- https://www.thesouledstore.com/static/img/newlogosticky.f7f01f0.png -->
                <img 
                    src="{{asset('dist/img/AdminLTELogo.png')}}" 
                    alt="AdminLTE Logo" 
                    class="brand-image img-circle elevation-3"
                    style="opacity: .8"
                />
                <span class="brand-text font-weight-light">{{config('app.name')}}</span>
            </a>

            <!-- collapsed -->
            <button 
                class="navbar-toggler order-1 " 
                type="button" 
                data-toggle="collapse" data-target="#navbarCollapse" 
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">

                <!-- Left navbar links -->
                <ul class="navbar-nav" >
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">TopWear</a>
                    </li> -->
                    @foreach($navItems as $navItem)
                        
                        <x-front.navbar.nav-items 
                            :navItem="$navItem"
                        />
                        
                    @endforeach
                </ul>
                
                <!-- SEARCH FORM -->
                <x-front.searchbar/>
            </div>
            
    
    
            <!-- Right navbar links -->
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        @if (Request::path() == "account" )
                            <i class="fas fa-user-alt" style="color: #e1141e;"></i>
                        @else 
                            <i class="fas fa-user-alt"></i>
                        @endif
                        <!-- <span class="badge badge-danger navbar-badge">3</span> -->
                    </a>
    
                    
                    <x-front.navbar.account-menu />



                </li>
                
                
                <!-- Wishlist -->
                <li class="nav-item dropdown">
                    <a class="nav-link" href="/wishlist">
                        @if (Request::path() == "wishlist" )
                            <i class="fas fa-heart" style="color: #e1141e;"></i>
                        @else 
                            <i class="fas fa-heart"></i>
                        @endif
                        
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
    
                    <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div> -->
                </li>
    
                <!-- shopping cart -->
                <li class="nav-item">
                    <a class="nav-link" href="/cart">
                        @if (Request::path() == "cart" )
                            <i class="fas fa-shopping-cart" style="color: #e1141e;"></i>
                        @else 
                            <i class="fas fa-shopping-cart"></i>
                        @endif
                        <span class="badge badge-warning navbar-badge">5</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>