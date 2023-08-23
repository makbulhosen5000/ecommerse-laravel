
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
        @include('admin.partial.body')
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.partial.script')
</body>

</html>
