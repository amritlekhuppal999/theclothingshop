
    @php
        $counter = 0;
    @endphp

    @if(count($productList))
        
        @foreach($productList as $products)
            
            <tr>
                <td>
                    <a href="pages/examples/invoice.html">{{ ++$counter }}</a>
                </td>

                <td>{{ $products["product_name"] }}</td>

                <td>{{ $products["target_group"] }}</td>

                <td>
                    <span class="btn btn-sm btn-secondary">{{ getCategoryName($products["category_id"]) }}</span> 
                    @if($products["sub_category_id"] > 0)
                        -> 
                        <span class="btn btn-sm btn-primary">{{ getSubCategoryName($products["sub_category_id"]) }}</span>
                    @endif
                </td>

                <td>₹ {{ $products["base_price"] }} /-</td>

                <td>
                    <span class="text-success">
                        {{ $products["discount_percentage"] }}%
                    </span>
                </td>

                <td>
                    <span class="badge badge-{{ ($products["status"]) ? "success" : "danger" }}">{{ getGeneralStatus($products["status"]) }}</span>
                </td>

                @if($products["status"] == 1)
                    <td>
                        {{-- {{ $products["id"] }} --}}
                        <a class="btn btn-sm btn-primary " style="position:static; margin-bottom:2px!important;" 
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
