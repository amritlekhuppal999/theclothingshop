

    <li class="nav-item dropdown">
        <a id="" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">{{$navItem["name"]}}</a>
        
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            @foreach($navItem["items"] as $itemName => $itemSlug)
                <li><a href="{{ "/category/".$itemSlug }}" class="dropdown-item">{{ $itemName }}</a></li>
            @endforeach
                <!-- 
                    <li><a href="#" class="dropdown-item"> {{-- $yo --}} </a></li>
                    <li><a href="#" class="dropdown-item">Some other action</a></li>
                -->
    
        </ul>
    </li>