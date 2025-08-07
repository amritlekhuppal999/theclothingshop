    
    
    <li class="nav-item nav-cart">
        <a class="nav-link" href="/cart">
            @if (Request::path() == "cart" )
                {{-- <i class="fas fa-shopping-cart" style="color: #e1141e;"></i> --}}
                <i class="fas fa-shopping-cart text-purple"></i>
            @else 
                <i class="fas fa-shopping-cart"></i>
            @endif
            {{-- <span class="badge badge-warning navbar-badge top-0">5</span> --}}
        </a>
    </li>