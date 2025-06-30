
    {{-- Sorting options BTN --}}
    
    <div {{ $attributes->merge(["class" => "col-md-4 text-right"]) }} >

        <div class="dropdown ">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $buttonText }}
            </button>
            
            {{ $slot }}

        </div>
    </div>



    {{-- How this component is used..

        <x-front.sort-button 
            page="orders" 
            buttonText="Orders In Last 30 Days" >
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2" style="">
                <li><a class="dropdown-item active" href="#">Last 30 Days</a></li>
                <li><a class="dropdown-item" href="#">Last 3 Months</a></li>
                <li><a class="dropdown-item" href="#">2024</a></li>
                <li><a class="dropdown-item" href="#"> 2023 </a></li>
                <li><a class="dropdown-item" href="#"> 2024 </a></li>
            </ul>
        </x-front.sort-button>

    --}}