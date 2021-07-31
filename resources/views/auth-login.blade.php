<!DOCTYPE html>
<html class="loading" lang="en">
<!-- BEGIN : Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Login Page</title>
{{--    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/img/ico/favicon.ico">--}}
{{--    <link rel="shortcut icon" type="image/png" href="../../../app-assets/img/ico/favicon-32.png">--}}
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/feather/style.min.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/simple-line-icons/style.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/perfect-scrollbar.min.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/fonts/font-awesome/css/font-awesome.min.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/prism.min.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/switchery.min.css">--}}
    <!-- END VENDOR CSS-->
    <!-- BEGIN APEX CSS-->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/colors.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/layout-dark.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/layout-dark.css')}}">
</head>
<!-- END : Head-->

<!-- BEGIN : Body-->

<body class="vertical-layout vertical-menu 1-column auth-page navbar-static layout-dark blank-page" data-menu="vertical-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
        <div class="main-panel">
            <!-- BEGIN : Main Content-->
            <div class="main-content">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <!--Login Page Starts-->
                    <section id="login" class="auth-height">
                        <div class="row full-height-vh m-0">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="card overflow-hidden">
                                    <div class="card-content">
                                        <div class="card-body auth-img">
                                            <div class="row m-0">
                                                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center auth-img-bg p-3">
                                                    <img src="{{asset('assets/images/login.png')}}" alt="" class="img-fluid" width="300" height="230">
                                                </div>
                                                <div class="col-lg-6 col-12 px-4 py-3">
                                                    <h4 class="mb-2 card-title">Login</h4>
                                                    <p>Welcome back, please login to your account.</p>
                                                    <input type="text" class="form-control mb-3" placeholder="Username">
                                                    <input type="password" class="form-control mb-2" placeholder="Password">
                                                    <div class="d-sm-flex justify-content-between mb-3 font-small-2">
                                                        <div class="remember-me mb-2 mb-sm-0">
                                                            <div class="checkbox auth-checkbox">
                                                                <input type="checkbox" id="auth-ligin">
                                                                <label for="auth-ligin"><span>Remember Me</span></label>
                                                            </div>
                                                        </div>
                                                        <a href="auth-forgot-password.html">Forgot Password?</a>
                                                    </div>
                                                    <div class="d-flex justify-content-between flex-sm-row flex-column">
                                                        <a href="auth-register.html" class="btn bg-light-primary mb-2 mb-sm-0">Register</a>
                                                        <a href="dashboard1.html" class="btn btn-primary">Login</a>
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h6 class="text-primary m-0">Or Login With</h6>
                                                        <div class="login-options">
                                                            <a class="btn btn-sm btn-social-icon btn-facebook mr-1"><span class="fa fa-facebook"></span></a>
                                                            <a class="btn btn-sm btn-social-icon btn-twitter mr-1"><span class="fa fa-twitter"></span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!--Login Page Ends-->
                </div>
            </div>
            <!-- END : End Main Content-->
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <!-- BEGIN VENDOR JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/vendors/js/switchery.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN APEX JS-->
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/notification-sidebar.js"></script>
    <script src="../../../app-assets/js/customizer.js"></script>
    <script src="../../../app-assets/js/scroll-top.js"></script>
    <!-- END APEX JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
    <!-- BEGIN: Custom CSS-->
    <script src="../../../assets/js/scripts.js"></script>
    <!-- END: Custom CSS-->
</body>
<!-- END : Body-->

</html>