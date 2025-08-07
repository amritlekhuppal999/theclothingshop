    
        
    <nav class="sidebar-menu">
        @foreach($categories as $category)
            <div class="sidebar-item">
                
                <div class="sidebar-link" onclick="toggleSidebarItem(this)">
                    {{-- <span class="sidebar-icon">👕</span> --}}
                    {{ $category["category_name"] }}
                    <span class="sidebar-arrow"> 
                        <i class="right fas fa-angle-left"></i>
                    </span>
                </div>
                
                {{-- <x-front.sidebar.side-items :categoryId="$category['id']" :categorySlug="$category['category_slug']" /> --}}
                <x-front.navbar.nav-items 
                    :categoryId="$category['id']" 
                    :categorySlug="$category['category_slug']" 
                    position="sidebar" 
                />
            </div>
        @endforeach
    </nav>
    