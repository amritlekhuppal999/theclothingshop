<?php

namespace App\Http\Controllers\FrontEnd\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BannerImages;


class HomeController extends Controller
{
    private $HOME_ROUTE = 'front-end/';
    private $VIEW_NOT_FOUND = 'front-end/404';


    public function CREATE(){

        try {
            $bannerImages = BannerImages::where('status', 1)->where('active_in_banner', 1)->get();

            $return_data = [
                "bannerImages" => $bannerImages
            ];
        } 
        catch (\Throwable $th) {
            //throw $th;
            $return_data = [
                "bannerImages" => []
            ];
        }

        return view($this->HOME_ROUTE.'home', $return_data);
    }
}
