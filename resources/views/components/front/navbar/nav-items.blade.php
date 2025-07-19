    
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            @foreach($sub_categories as $sub_category)
                <li>
                    <a 
                        href="{{ safe_route("category", [
                                        "category_slug" => $categorySlug, "sc" => $sub_category["sub_category_slug"]
                                    ])
                                }}" 
                        class="dropdown-item">
                        {{ $sub_category["sub_category_name"] }}
                    </a>
                </li>
            @endforeach 
        </ul>