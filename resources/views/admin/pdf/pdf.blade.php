<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
    <div class="">
        <h1 class="display-3">Customer Order Details</h1>
            <p>product_id:{{ $order->product_id }}</p>
            <p>user_id: {{ $order->user_id }}</p>
            <p>customer_name: {{ $order->name }}</p>
            <p>phone: {{ $order->phone }}</p>
            <p>email: {{ $order->email }}</p>
            <p>address: {{ $order->address }}</p>
            <p>product_Name: {{ $order->product_title }}</p>
            <p>Price:{{ $order->price }}</p>
            <p>Quantity: {{ $order->quantity }}</p>
            <p>Payment Status:{{ $order->payment_status }}</p>
            <p>Delivery Status: {{ $order->delivery_status }}</p>
            <img width="250" height="250" src="images/product/{{ $order->image }}" alt="">
    </div>
</body>
</html>