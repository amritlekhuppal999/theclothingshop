

    <li class="nav-item dropdown">
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