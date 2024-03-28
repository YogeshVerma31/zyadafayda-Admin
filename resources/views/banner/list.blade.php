<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body>
    <div class="container-scroller">
        @include('includes.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('includes.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">

                        <div class="card-body">

                            <div class="m-2 justify-content-center">
                                <h4 class="card-title m-2 d-block">Banner Slider List</h4>
                                <a href="add-banner" class="ml-3 btn btn-primary">Add Banner Slider</a>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Id #</th>
                                                    <th>Banner Image</th>
                                                    <th>Banner Link</th>
                                                    <th>Action</th>
                                                    {{-- <th>Actions</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bannerList as $result)
                                                    <tr class="odd">
                                                        <td class="sorting_1">{{ $result->id }}</td>
                                                        <td>
                                                            <a href="{{ Storage::url($result->banner_image) }}"
                                                                target="_blank"><img style="width:80px;height:80px"
                                                                    src="{{ Storage::url($result->banner_image) }}" /></a>
                                                        </td>
                                                        <td>
                                                            <a href="{{$result->banner_link}}" target="_blank">Link</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a class="text-primary mr-2" href="{{route('edit-banner',$result->id)}}">
                                                                <span class="btn btn-sm btn-primary">
                                                                    <i class="nav-icon i-Pen-3"></i> Edit
                                                                </span>
                                                            </a>
                                                            <form action="{{ route('deleteBanner', $result->id) }}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input type="submit" onclick="return confirm('are you sure to want delete?')" class="text-white btn btn-danger mt-3" value="Delete" />
                                                            </form>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- partial -->
                        </div>
                        <!-- main-panel ends -->
                    </div>
                    <!-- page-body-wrapper ends -->
                </div>
                @include('includes.footer')
                <script>
                    new DataTable('#example');
                </script>
</body>

</html>
