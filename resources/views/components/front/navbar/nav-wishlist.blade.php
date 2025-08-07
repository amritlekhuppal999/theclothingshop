

    <li class="nav-item nav-wishlist">
        <a class="nav-link" href="/wishlist">
            @if (Request::path() == "wishlist" )
                {{-- <i class="fas fa-heart" style="color: #e1141e;"></i> --}}
                <i class="fas fa-heart text-purple"></i>
            @else 
                <i class="fas fa-heart"></i>
            @endif
            
            {{-- <span class="badge badge-warning navbar-badge top-0">15</span> --}}
            {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">15</span> --}}
        </a>
    </li>