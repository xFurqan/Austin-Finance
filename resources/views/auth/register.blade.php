<!DOCTYPE html>
<html dir="ltr">

@include('includes.head')

<body>
<div class="main-wrapper">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(assets/images/background/login-register.jpg) no-repeat center center; background-size: cover;">
        <div class="auth-box p-4 bg-white rounded">
            <div>
                <div class="logo">
                    <h3 class="box-title mb-3">Sign Up</h3>
                </div>
                <!-- Form -->
                <div class="row">
                    <div class="col-12">
                        <form class="form-horizontal mt-3 form-material" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus type="text" required="" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <div class="col-xs-12">
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" type="text" required="" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <div class="col-xs-12">
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" type="password" required="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="col-xs-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <div class="">
                                    <div class="checkbox checkbox-success pt-0">
                                        <input id="checkbox-signup" type="checkbox" class="chk-col-indigo material-inputs">
                                        <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group text-center mb-3">
                                <div class="col-xs-12">
                                    <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                                </div>
                            </div>
                            <div class="form-group mb-0 mt-2 ">
                                <div class="col-sm-12 text-center ">
                                    Already have an account? <a href="{{route('login')}}" class="text-info ml-1 ">Sign In</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper scss in scafholding.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right Sidebar -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- All Required js -->
<!-- ============================================================== -->
@include('includes.scripts')

<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>
    $('[data-toggle="tooltip "]').tooltip();
    $(".preloader ").fadeOut();
</script>
</body>

</html>
