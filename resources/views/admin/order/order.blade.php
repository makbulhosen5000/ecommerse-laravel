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
                    <h1 class="text-center text-2xl">All Order List</h1>
                    <form action="{{ url('search') }}" method="GET">
                        @csrf
                        <div class="container mt-4">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search...">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>

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
                                <th scope="col">Send Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $key => $item)
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
                                            class="btn btn-warning" onclick="return confirm('Are You Sure To Dilever?')">Deliver</a>
                                        @else
                                        <a id="" href="" class="btn btn-primary">Delivered</a>
                                        @endif
                                    </td>
                                    <td>  <a href="{{ url('print_pdf',$item->id) }}" class="btn btn-success">Print PDF</a></td>
                                    <td>  <a href="{{ url('send_email',$item->id) }}" class="btn btn-primary">Send Email</a></td>
                                </tr>
                                @empty
                                <div class="text-center btn btn-warning">
                                    <h1>No Data Found</h1>
                                </div>
                            @endforelse
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
