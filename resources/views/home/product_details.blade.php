<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <base href="/public">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Ecom</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->

        <div class="col-sm-6 col-md-4 col-lg-4 mx-auto my-5">
            <div class="box">
                <div class="img-box pt-2">
                    <img src="/images/product/{{ $product->image }}" width="428" height="200" alt="">
                </div>
                <div class="detail-box">
                    <h5>
                        {{ $product->title }}
                    </h5>
                    @if ($product->discount_price != null)
                        <h6 class="text-danger">
                            Discount Price: ${{ $product->discount_price }}
                        </h6>
                        <h6 style="text-decoration:line-through">
                            Price: ${{ $product->price }}
                        </h6>
                    @else
                        <h6>
                            Price: ${{ $product->price }}
                        </h6>
                    @endif
                    <h6>
                        Product Category:{{ $product->category }}
                    </h6>
                    <h6>
                        Product Description: {{ $product->description }}
                    </h6>
                    <h6> Available Quantity: {{ $product->quantity }}
                    </h6>
                    <form action="{{ url('add_cart', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1">
                        <input type="submit" class="mb-4" value="Add To Cart">
                    </form>
                </div>
            </div>
        </div>

        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->
    </div>

    <!-- jQery -->
    <script src="home/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="home/js/popper.min.js"></script>
    <!-- bootstrap js -->
    <script src="home/js/bootstrap.js"></script>
    <!-- custom js -->
    <script src="home/js/custom.js"></script>
</body>

</html>
