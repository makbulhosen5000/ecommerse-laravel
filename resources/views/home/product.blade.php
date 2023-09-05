<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Our <span>products</span>
                <div>
                    <form action="{{ url('search_product') }}" method="GET">
                        <input type="search" placeholder="search product" class="p-3" name="search" style="width: 500px">
                        <input type="submit" value="Search" value="Search">
                    </form>
                </div>
            </h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details', $product->id) }}" class="option1">
                                    Product Details
                                </a>
                                <form action="{{ url('add_cart',$product->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="quantity"  value="1" min="1">
                                    <input type="submit" class="mb-4"  value="Add To Cart">
                                </form>
                               
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="images/product/{{ $product->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $product->title }}
                            </h5>
                            @if ($product->discount_price != null)
                                <h6 class="text-danger">
                                    ${{ $product->discount_price }}
                                </h6>
                                <h6 style="text-decoration:line-through">
                                    ${{ $product->price }}
                                </h6>
                            @else
                                <h6>
                                    ${{ $product->price }}
                                </h6>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <span class="pt-5">
                {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
            </span>

        </div>
</section>
