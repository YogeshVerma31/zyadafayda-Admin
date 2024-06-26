<!DOCTYPE html>
<html lang="en">
@include('includes.head')

<body>

  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../../assets/images/zyadafayda_log.png" style="height: 70px; width:70px;" alt="logo">
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1"
                    placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password"  name="password" class="form-control form-control-lg" id="exampleInputPassword1"
                    placeholder="Password">
                </div>
                @error('email')
                <div style="color: red">{{ $message }}</div>
            @enderror
                <div class="mt-3 d-grid gap-2">
                  <button  type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</a>
                </div>



              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
    @include('includes.footer')
    <script>
        new DataTable('#example');
    </script>
</body>

</html>
