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
                    <h1 class="text-center text-2xl">All Product List</h1>
                </div>
                <form action="{{ url('add_category') }}" method="POST" class="text-center">
                    @csrf

                </form>
                <div class="table-responsive mt-5 text-center">
                    <table class="table">
                        <caption>List of Product</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Discount Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <textarea id="" cols="20" rows="2">{{ $item->description }}</textarea>
                                    </td>

                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->discount_price }}</td>
                                    <td>
                                        <img src="/images/product/{{ $item->image }}" alt=""
                                            class="rounded mx-auto d-block">
                                    </td>
                                    <td>
                                        <a href="{{ url('update_product',$item->id) }}" class="btn btn-primary">Edit</a>
                                        <a id="delete" href="{{ url('delete_product', $item->id) }}"
                                            class="btn btn-danger">delete</a>
                                    </td>
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
