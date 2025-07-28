<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Blade;

use App\View\Components\front\Carousel;
use App\View\Components\front\home\FeaturedBigThree;
use App\View\Components\front\home\FeaturedProducts;
use App\View\Components\front\product\ProductCard;

use App\View\Components\front\navbar\NavBar;
use App\View\Components\front\navbar\NavMenu;
use App\View\Components\front\navbar\NavItems;


use App\View\Components\front\category\SubCategoryFilter;
use App\View\Components\front\category\ThemeFilter;
use App\View\Components\front\category\AttributeFilter;

use App\View\Components\front\profile\EditProfile;
use App\View\Components\front\profile\ManageAddress;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();

        Blade::component('front.carousel', Carousel::class);
        Blade::component('front.home.featured-big-three', FeaturedBigThree::class);
        Blade::component('front.home.featured-products', FeaturedProducts::class);
        Blade::component('front.product.product-card', ProductCard::class);
        
        Blade::component('front.navbar.nav-bar', NavBar::class);
        Blade::component('front.navbar.nav-menu', NavMenu::class);
        Blade::component('front.navbar.nav-items', NavItems::class);
        
        Blade::component('front.category.sub-category-filter', SubCategoryFilter::class);
        Blade::component('front.category.theme-filter', ThemeFilter::class);
        Blade::component('front.category.attribute-filter', AttributeFilter::class);
        
        
        Blade::component('front.profile.manage-address', ManageAddress::class);
    }
}
