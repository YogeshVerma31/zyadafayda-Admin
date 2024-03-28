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
                    <div class="row">
                        <div class="col-xl-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add Banner Slider</h4>
                                    <form class="forms-sample" method="POST" enctype="multipart/form-data"
                                        action="{{ route('post-banner') }}">
                                        @csrf
                                        @method('POST')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Banner Slider Image</label>
                                                    <input type="file" accept="image/*" max="1024"
                                                        class="form-control" id="exampleInputUsername1"
                                                        name="bannerImage" required placeholder="Select Image">
                                                </div>
                                            </div>
                                            <div class="col-md-6 grid-margin stretch-card">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Banner Link</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1"
                                                        name="banner_link" placeholder="Banner Link">
                                                    </input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                                <button class="btn btn-light">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
