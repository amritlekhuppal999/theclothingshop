    
    
    
    
    <div class="row" id="load-product-skeleton-loader">
        
        @for($i = 0; $i < 4; $i++)
            <div class="col-md-3">
                <div class="card product-card border-0 "> {{-- dark --}}
                    <div class="product-image">
                        <a href="#">
                            <img src="https://imageplaceholder.net/736x981" alt="" class="card-img-top" />
                        </a>
                        
                        <button 
                            class="favorite-btn active" 
                            data-product_id=""
                            data-saved_in_wishlist=""
                            aria-label="Add to favorites">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    
                    <div class="card-body">
                        <a href="#">
                            <h5 class="product-title"> Product name </h5>
                        </a>

                        <div class="price-section">
                            <span class="current-price">₹ </span>
                            <span class="original-price">₹ </span>
                            <span class="discount-badge">% </span>
                        </div>
                    </div>
                </div>

            </div>
        @endfor
    </div>