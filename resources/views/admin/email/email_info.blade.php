<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public" />
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

                            <h1 class="text-center bold text-2xl mb-2">Send Email {{ $order->email }}</h1>

                            <form action="{{ url('send_user_email',$order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="title">Email Greeting</label>
                                    <input type="text" class="form-control text-red-600" id="title"
                                        name="greeting" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="price">Email FirstLine</label>
                                    <input  class="form-control text-red-600 "
                                        name="firstline" min="0.01" step="0.01" required>
                                </div>
                                   <div class="form-group">
                                    <label for="description">Email Body</label>
                                    <textarea class="form-control text-red-600 " name="body" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="discount_price">Discount Button Name</label>
                                    <input type="text" class="form-control text-red-600 " 
                                        name="button" min="0.01" step="0.01">
                                </div>

                                <div class="form-group">
                                    <label for="quantity">Email URL</label>
                                    <input type="text" class="form-control text-red-600 "
                                        name="url" required>
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Email Last Line</label>
                                    <input type="text" class="form-control text-red-600 "
                                        name="lastline" required>
                                </div>

                                <button type="submit" class="btn btn-success">Send Email</button>
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
