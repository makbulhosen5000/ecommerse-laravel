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
    <title>Famms - Fashion HTML Template</title>
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

       <div class="table-responsive mt-5 text-center">
               @if (Session::get('success'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif
                    <table class="table">
                        <caption>List of Order</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Title</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $totalPrice=0?>
                            @foreach ($carts as $key => $cart)
                                <tr >
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $cart->product_title }}</td>
                                    <td>{{ $cart->price }}</td>
                                    <td>{{ $cart->quantity }}</td>
                                    
                                    <td>
                                        <img width="100" height="100" src="/images/product/{{ $cart->image }}" alt="">
                                    </td>
                                    <td>
                                        <a onclick="return confirm('Are You Sure Want To Remove Product from Cart!!')" href="{{ url('remove_cart', $cart->id) }}"
                                            class="btn btn-danger">Remove Product</a>
                                    </td>
                                </tr>

                                <?php $totalPrice = $totalPrice + $cart->price?>
                             
                            @endforeach
                            <div>
                                  <h1 class="display-2"> Total Price: {{ $totalPrice }}</h1>
                            </div>
                        </tbody>
                    </table>
                    <div class="my-5">
                        <h1 class="display-4">Proceed To Order</h1>
                        <a href="{{ url('cash_on_delivery') }}" class="btn btn-success">Cash On Dilevery</a>
                        <a href="{{ url('stripe',$totalPrice) }}" class="btn btn-primary">Pay Using Card</a>
                    </div>
                </div>
        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->
  

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
