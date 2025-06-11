
    @php
        $counter = 0;
        //var_dump($productList[0]["sub_category_name"]);
    @endphp

    @if(count($productList))
        @foreach($productList as $products)
            
            <tr>
                <td> {{ ++$counter }} </td>

                <td>
                    <h4>
                        <a 
                            href="{{ route("product", ["product_slug" => $products["product_slug"] ]) }}"
                            target="0_">
                            {{ $products["product_name"] }}
                        </a>
                    </h4>
                </td>

                <td>{{ get_target_group($products["target_group"]) }}</td>

                <td>
                    <div class="treeview">
                        <ul>
                            <li>
                                <span class="btn btn-sm btn-secondary">{{ getCategoryName($products["category_id"]) }}</span>
                                <ul>
                                    @php $sub_categories = get_sub_category_list($products["PROD_ID"]); @endphp
                                    @foreach($sub_categories as $sub_category)
                                        <li>
                                            <a 
                                                href="{{ route("category", ["sub_category_slug" => $sub_category["sub_category_slug"] ]) }}"
                                                target="0_"
                                                class="btn btn-sm bg-purple">
                                                {{ $sub_category["sub_category_name"] }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </div>

                </td>

                <td> 
                    <b>
                        ₹ {{ $products["base_price"] }} /-
                    </b> 
                </td>

                <td>
                    <b class="text-success">
                        {{ $products["discount_percentage"] }}%
                    </b>
                </td>

                <td>
                    <span class="badge badge-{{ ($products["status"]) ? "success" : "danger" }}">{{ getGeneralStatus($products["status"]) }}</span>
                </td>

                @if($products["status"] == 1)
                    <td>
                        {{-- {{ $products["id"] }} --}}
                        <a class="btn btn-sm bg-purple " style="position:static; margin-bottom:2px!important;" 
                            href="{{ route("products-variants", ["productSlug" => $products["product_slug"] ]) }}">
                            Variants
                        </a> 
                        

                        <a class="btn btn-sm btn-info " 
                            href="{{ route("products-add-images", ["productSlug" => $products["product_slug"] ]) }}">
                            Images
                        </a>

                        <a class="btn btn-sm btn-secondary" 
                            href="{{ route("products-update", ["productSlug" => $products["product_slug"] ]) }}">
                            Edit
                        </a>
                    </td>
                @else
                    <td>
                        {{-- {{ $products["id"] }} --}}
                        <a 
                            class="btn btn-sm btn-success "
                            href="{{ route("restore-product", ["productSlug" => $products["product_slug"] ]) }}">
                            Restore
                        </a>
                    </td>    
                @endif
            </tr> 

        @endforeach

    @else
        
        <tr>
            <td colspan="8" class="text-center">
                No Records Found
            </td>
        </tr>

    @endif



{{-- <div class="treeview">
    <ul>
        <li>Root Item 1
            <ul>
                <li>Child Item 1.1</li>
                <li>Child Item 1.2
                    <ul>
                        <li>Grandchild Item 1.2.1</li>
                        <li>Grandchild Item 1.2.2</li>
                    </ul>
                </li>
                <li>Child Item 1.3</li>
            </ul>
        </li>
        <li>Root Item 2
            <ul>
                <li>Child Item 2.1</li>
                <li>Child Item 2.2</li>
            </ul>
        </li>
        <li>Root Item 3</li>
    </ul>
</div> --}}