        

        @php
            $position = $attributes->get('position');
        @endphp
        

        @if($position == "navbar")
            
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="">
                @foreach($sub_categories as $sub_category)
                    <li>
                        <a 
                            href="{{ safe_route("category", [
                                            "category_slug" => $categorySlug, 
                                            "sc" => $sub_category["sub_category_slug"]
                                        ])
                                    }}" 
                            class="dropdown-item">
                            {{ $sub_category["sub_category_name"] }}
                        </a>
                    </li>
                @endforeach 
            </ul>

        @elseif($position == "sidebar")
            
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

        @endif
        