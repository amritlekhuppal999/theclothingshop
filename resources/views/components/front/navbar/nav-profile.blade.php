    
    
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            @if (Request::path() == "profile" )
                <i class="fas fa-user-alt" style="color: #e1141e;"></i>
            @else 
                <i class="fas fa-user-alt"></i>
            @endif
            <!-- <span class="badge badge-danger navbar-badge">3</span> -->
        </a>

        
        <x-front.navbar.account-menu />
    </li>