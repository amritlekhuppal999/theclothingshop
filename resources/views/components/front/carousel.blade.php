
@php
    //echo $attributes["dummy"].'<br />';
    // var_dump($attributes); exit();
    // $dummy = (isset($attributes["dummy"])) ? $attributes["dummy"] : "false";
@endphp

    @if($bannerImages->isNotEmpty())
    {{-- @if(isset($bannerImages)) --}}

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($bannerImages as $key => $bannerImage)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ ($key == 0) ? "active" : "" }}"></li>
                @endforeach
            </ol>

            <div class="carousel-inner">
                
                @foreach($bannerImages as $key => $bannerImage)
                    <div class="carousel-item {{ ($key == 0) ? "active" : "" }}">
                        <img 
                            class="" {{-- d-block img-fluid w-100 --}}
                            src="{{ asset($bannerImage["image_location"]) }}" 
                            alt="First slide" 
                            {{-- style="width:100%; height:68vh; object-fit: cover;" --}}
                        />
                    </div>
                @endforeach
                
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    @else
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            </ol>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('images/carousel-loader.png') }}" alt="First slide">
                </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    @endif



{{-- 
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Carousel</h3>
        </div>
        

        <div class="card-body">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class=""></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2" class="active"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/all-star.jpg') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://placehold.it/900x500/3c8dbc/ffffff&amp;text=I+Love+Bootstrap" alt="Second slide">
                    </div>
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="https://placehold.it/900x500/f39c12/ffffff&amp;text=I+Love+Bootstrap" alt="Third slide">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/all-star.jpg') }}" alt="First slide" style="width:100%; height:68vh;">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('images/naruto-ultimate-collection.webp') }}" alt="Second slide" style="width:100%; height:68vh;">
                    </div>
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('images/rick-n-morty.webp') }}" alt="Third slide" style="width:100%; height:68vh;">
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        
    </div>

--}}