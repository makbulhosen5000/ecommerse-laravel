<x-app-layout>

</x-app-layout>

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->

        @include('admin.sidebar')

        <!-- partial -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                     @if(Session::get('success'))
                        <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>{{Session::get('success')}}</strong>
                        </div>
                        @endif 
                {{-- @if(session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" area-hidden="true">X</button>
                   {{ session()->get('success') }}
                </div>
                @endif --}}
                <form action="{{ url('add_category') }}" method="POST" class="text-center">
                    @csrf
                    <div class="text-center mt-4">
                        <div>
                        <input type="text" name="category_name" class="text-dark" placeholder="Enter Category Name" required>
                        </div>
                        <div>
                        <input class="mt-3 btn-lg btn btn-success" type="submit" value="Add Category" >
                        </div>
                    </div>
                </form>
           </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>
