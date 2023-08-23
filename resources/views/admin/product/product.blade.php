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
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            @if (Session::get('success'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                                    <strong>{{ Session::get('success') }}</strong>
                                </div>
                            @endif

                            <h1 class="text-center bold text-2xl">Add Product</h1>

                            <form action="{{ url('/add_product') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Product Title</label>
                                    <input type="text" class="form-control text-red-600" id="title"
                                        name="title" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <textarea class="form-control text-red-600 " id="description" name="description" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="number" class="form-control text-red-600 " id="price"
                                        name="price" min="0.01" step="0.01" required>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="number" class="form-control text-red-600 " id="discount_price"
                                        name="discount_price" min="0.01" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="category">Product Category</label>
                                    <select class="form-control text-red-600 " id="category" name="category" required>
                                        <option value="" selected="">Select a category</option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->category_name }}">
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control text-red-600 " id="quantity"
                                        name="quantity" min="1" required>
                                </div>

                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" class="form-control text-red-600 -file bg-white"
                                        name="image" accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.partial.script')
</body>

</html>
