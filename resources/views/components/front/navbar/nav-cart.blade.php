    
    
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