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

                @if (Session::get('success'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif
                <form action="{{ url('add_category') }}" method="POST" class="text-center">
                    @csrf
                    <div class="text-center mt-4">

                        <div>
                            <input type="text" name="category_name" class="text-dark"
                                placeholder="Enter Category Name" required>
                        </div>
                        <div>
                            <input class="mt-3 btn-lg btn btn-success" type="submit" value="Add Category">
                        </div>
                    </div>
                </form>
                <div class="table-responsive mt-5 text-center">
                    <table class="table">
                        <caption>List of Category</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $item->category_name }}</td>
                                    <td>
                                        <a onclick="return confirm('Are You Delete It!')"
                                            href={{ url('delete_category', $item->id) }}
                                            class="btn btn-danger">Delete</a>
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
