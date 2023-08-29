<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partial.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->

        @include('admin.partial.sidebar')

        <!-- partial -->
        @include('admin.partial.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div>
                    <h1 class="text-center text-2xl">All Order List</h1>
                </div>

                <div class="table-responsive mt-5 text-center">
                    <table class="table">
                        <caption>List of Product</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Product Title</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Payment Status</th>
                                <th scope="col">Delivery Status</th>
                                <th scope="col">Image</th>
                                <th scope="col">Delivered</th>
                                <th scope="col">PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->product_title }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->payment_status }}</td>
                                    <td>{{ $item->delivery_status }}</td>
                                    <td>
                                        <img src="/images/product/{{ $item->image }}" alt=""
                                            class="rounded mx-auto d-block">
                                    </td>
                                    <td>
                                        @if($item->delivery_status == 'processing')
                                        <a id="" href="{{ url('delivered',$item->id) }}"
                                            class="btn btn-primary" onclick="return confirm('Are You Sure To Dilever?')">Deliver</a>
                                        @else
                                        <a id="" href="" class="btn btn-warning">Delivered</a>
                                        @endif
                                    </td>
                                    <td>  <a href="{{ url('print_pdf',$item->id) }}" class="btn btn-success">Print PDF</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.partial.script')
</body>

</html>
