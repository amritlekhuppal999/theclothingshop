

    <div class="sidebar-submenu">
        @foreach($sub_categories as $sub_category)
            <div class="sidebar-subitem">
                <a 
                    href="{{ safe_route("category", [
                                    "category_slug" => $categorySlug, 
                                    "sc" => $sub_category["sub_category_slug"]
                                ])
                            }}" 
                    class="sidebar-sublink">
                    {{ $sub_category["sub_category_name"] }}
                </a>
            </div>
        @endforeach
    </div>