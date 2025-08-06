    
    <ul class="navbar-nav" style="">
        @foreach($categories as $category)
            
            <li class="nav-item dropdown">
                <a 
                    href="#" 
                    id="" 
                    data-toggle="dropdown" 
                    aria-haspopup="true" 
                    aria-expanded="false" class="nav-link dropdown-toggle">
                    {{ $category["category_name"] }}
                </a>
                
                <x-front.navbar.nav-items :categoryId="$category['id']" :categorySlug="$category['category_slug']"/>
            </li>

        @endforeach
    </ul>
    {{--  --}}