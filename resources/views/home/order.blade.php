<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
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
                    <table class="table">
                        <caption>List of Product</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Title</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Delivery Status</th>
                                <th scope="col">Image</th>                              
                                <th scope="col">Cancel Order</th>                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->product_title }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->payment_status }}</td>
                                    <td>{{ $item->delivery_status }}</td>
                                    <td>
                                        <img src="/images/product/{{ $item->image }}" alt=""
                                            class="rounded mx-auto d-block" width="100" height="100">
                                    </td>
                                    @if($item->delivery_status=='processing')
                                    <td>
                                        <a onclick="return confirm('Are You Sure To Cancel The Order!')" href="{{ url('cancel_order',$item->id) }}" class="btn btn-warning">Cancel Order</a>
                                    </td>
                                    @else
                                       <td>
                                        <a disabled class="btn btn-success">Dilevered Order</a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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