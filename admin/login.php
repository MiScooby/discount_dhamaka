<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <title>DiscountDhamka - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&amp;display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="assets/vendors/core/core.css">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">

    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/demo1/style.min.css">
    <!-- End layout styles -->
    <link rel="stylesheet" type="text/css" href="../assets/sweetalert2/sweetalert2.min.css">

</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-8 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6 pe-md-0">
                                    <div class="auth-side-wrapper">
                                    <img src="assets/images/login-bg.avif" width="100%" alt="">
                                    </div>
                                </div>
                                <div class="col-md-6 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#" class="noble-ui-logo d-block mb-2">   Discount<span> Dhamaka </span></a>
                                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                        <form class="forms-sample" id="logInForm" autocomplete="off">
                                            <div class="mb-3">
                                                <label for="userEmail" class="form-label">Email address</label>
                                                <input type="email" class="form-control" id="userEmail" placeholder="Email" required value="<?php if (isset($_COOKIE["member_login"])) {
                                                                                                                                                echo $_COOKIE["member_login"];
                                                                                                                                            }  ?>">
                                                <label id="email-error" class="error invalid-feedback"></label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="userPassword" class="form-label">Password</label>
                                                <input type="password" required class="form-control" id="userPassword" autocomplete="current-password" placeholder="Password" value="<?php if (isset($_COOKIE["member_p"])) {
                                                                                                                                                                                            echo $_COOKIE["member_p"];
                                                                                                                                                                                        }  ?>">

                                                <label id="pass-error" class="error invalid-feedback"></label>
                                            </div>

                                            <div>
                                                <a href="javascript:void(0);" class="btn btn-primary mb-2 mb-md-0 text-white" id="loginBtn">Login</a>

                                            </div>
                                            <div class="alert alert-danger text-center " style="display:none;" role="alert" id="inv_cred">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->

    <script src="../assets/sweetalert2/sweetalert2.min.js"></script>

    <script>
        function srbSweetAlret(msg, swicon) {
            msg = msg;
            swicon = swicon;
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: swicon,
                title: msg
            })
        }
    </script>

    <!-- Custom js for this page -->
    <script>
        $(document).ready(function() {
            $(document).on("click", "#loginBtn", function() {
                var logEmail = $('#userEmail').val();
                var logPass = $('#userPassword').val();
                var remEmBer = 0;

                if ($('#authCheck').is(':checked')) {
                    var remEmBer = 1;
                }
                if (logEmail == '') {
                    $('#userEmail').addClass('is-invalid');
                    $("#email-error").html("**Please enter a valid email address");
                } else if (logPass == '') {
                    $('#userPassword').addClass('is-invalid');
                    $("#pass-error").html("**Please enter a valid Password");
                } else {
                    $('#userEmail').removeClass('is-invalid');
                    $('#pass-error').removeClass('is-invalid');
                    $.ajax({
                        data: {
                            loginEmail: logEmail,
                            loginPass: logPass,
                            loginSave: remEmBer
                        },
                        type: "post",
                        url: "ajax/login.php",
                        success: function(data) {

                            // alert(data);
                            data = JSON.parse(data);
                            if (data.status) {
                                window.location.href = "index.php";
                            } else {
                                swicon = "warning";
                                msg = data.message;
                                srbSweetAlret(msg, swicon);
                            }
                        }

                    });
                }
            });

        });
    </script>
    <!-- End custom js for this page -->

</body>

</html>