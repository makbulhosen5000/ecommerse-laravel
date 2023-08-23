<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
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

                            <h1 class="text-center bold text-2xl">Update Product</h1>

                            <form action="{{ url('/update_product_store',$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Product Title</label>
                                    <input type="text" class="form-control text-red-600" name="title" id="title"
                                      value="{{ $product->title }}" >
                                </div>
                                <div class="form-group">
                                    <label for="description">Product Description</label>
                                    <textarea class="form-control text-red-600 " name="description"  id="description"rows="3">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Product Price</label>
                                    <input type="number" class="form-control text-red-600" name="price"  id="price"
                                        value="{{ $product->price }}" min="0.01" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Price</label>
                                    <input type="number" class="form-control text-red-600 " name="discount_price"  id="discount_price"
                                        value="{{ $product->discount_price }}" min="0.01" step="0.01">
                                </div>
                                <div class="form-group">
                                    <label for="category">Product Category</label>
                                    <select class="form-control text-red-600 " id="category" name="category">
                                        <option value="{{ $product->category }}" selected="">{{ $product->category }}</option>
                                        @foreach ($category as $category)
                                            <option value="{{ $category->category_name }}">
                                                {{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control text-red-600 " name="quantity" id="quantity"
                                        value="{{ $product->quantity }}" min="1">
                                </div>

                                <div class="form-group">
                                    <label for="image">Current Product Image</label>
                                     <img src="/images/product/{{ $product->image }}" alt="" width="450">
                                </div>
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <input type="file" class="form-control text-red-600 -file bg-white"
                                        name="image" accept="image/*">
                                </div>
                                <button type="submit" class="btn btn-success">Update Product</button>
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
