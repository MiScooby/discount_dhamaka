<?php include('admin/ajax/config.php');
include('google-config.php');
include('fb-config.php');

$facebook_permissions = ['email']; // Optional permissions

$facebook_login_url = $facebook_helper->getLoginUrl('https://micodetest.com/discount-dhamaka/profile.php', $facebook_permissions);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Discount Dhamaka - Login and Register</title>
    <link href="assets/images/favicon/favicon-8.png" rel="icon">

    <meta name="description" content="Login and Register">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/lgn-reg.css?v1.1">
    <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
    <link id="color-switcher" type="text/css" rel="stylesheet" href="assets/css/color-teal.css">
</head>

<body>

    <style>
        span.select2-selection.select2-selection--single {
            display: block;
            width: 100% !important;
            padding: 0.375rem 0.75rem;
            font-size: 14px;
            font-weight: 400;
            height: 50px;
            line-height: 27px;
            color: #212529;
            background-color: #f5f5f6;
            background-clip: padding-box;
            border: 1px solid #ced4da4f;
            appearance: none;
            border-radius: 0.25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        span.select2.select2-container.select2-container--default {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 35px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 50px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
        }
    </style>
    <div id="main-wrapper" class="discountdmk-login-register">
        <div class="container-fluid px-0">
            <div class="row g-0 min-vh-100">
                <!-- Welcome Text
========================= -->
                <div class="col-md-5">
                    <div class="hero-wrap h-100">
                        <div class="hero-mask opacity-9 bg-primary"></div>
                        <div class="hero-bg hero-bg-scroll" style="background-image:url('assets/lgn-reg-assets/images/login-bg-1.jpg');"></div>
                        <div class="hero-content w-100">
                            <div class="container d-flex flex-column min-vh-100">
                                <div class="row g-0">
                                    <div class="col-11 col-md-10 col-lg-9 mx-auto">
                                        <div class="logo mt-5 mb-5 mb-md-0"> <a class="d-flex justify-content-center" href="index.php" title="Discount Dhamaka"><img src="assets/images/logo/logo-8.png" alt="Discount Dhamaka"></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-0 my-auto">
                                    <div class="col-11 col-md-10 col-lg-9 mx-auto">

                                        <h1 class="text-9 fw-600 mb-5 text-white text-center">Discount Dhamaka provides best platform for exclusive deals in your area.</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Welcome Text End -->

                <!-- Login Form
========================= -->
                <div class="col-md-7 h-100 d-flex flex-column" style="position: relative;">
                    <div id="loader" style="display: none;">
                        <div class="lds-dual-ring">
                            <div class="overlay">
                            </div>
                        </div>
                    </div>
                    <div class="container pt-5">
                        <div class="row g-0">
                            <div class="col-11 mx-auto">
                                <div class="mytpopt1">
                                    <?php
                                    if (!isset($_GET['vendorlogin'])) {
                                    ?>
                                        <p class="text-end text-2 mb-0"><span class="signinas" id="resNam">Not a member ?</span> <a href="register.php" class="cghref">Sign Up</a></p>

                                    <?php
                                    }
                                    ?>




                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container my-auto py-5">
                        <div class="row g-0">
                            <div class="col-11 col-md-10 col-lg-9 col-xl-8 mx-auto">

                                <div class="customerdiv <?= (isset($_GET['vendorlogin'])) ? 'mylogfrm' : ''; ?>">
                                    <h3 class="fw-600 mb-4">Sign in to Discount Dhamaka</h3>

                                    <div class="row gx-2">
                                        <div class="col-4 col-sm-4 col-lg-6">
                                            <div class="d-grid">

                                                <a href="<?php echo $google_client->createAuthUrl() ?>" class="btn btn-google btn-sm fw-400 shadow-none"><span class="me-2"><i class="fab fa-google"></i></span><span class="d-none d-lg-inline">Sign in with Google</span></a>

                                            </div>
                                        </div>
                                        <div class="col-8 col-sm-8 col-lg-6">
                                            <div class="d-flex flex-column">
                                                <div class="d-grid">

                                                    <a href="<?php echo $facebook_login_url ?>" class="btn btn-facebook btn-sm fw-400 shadow-none"><span class="me-2"><i class="fab fa-facebook-f"></i></span><span class="d-none d-lg-inline">Sign in with Facebook</span></a>


                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mylogfrm emailform ">
                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 text-muted">Sign in with Email-Id</span>
                                            <hr class="flex-grow-1">
                                        </div>
                                        <form id="loginForm">
                                            <div class="mb-3">
                                                <label for="emailAddress" class="form-label fw-500">Email
                                                    Address</label>
                                                <input type="email" class="form-control bg-light border-light" id="emailAddress" required="" placeholder="Enter Your Email">
                                            </div>
                                            <div class="mb-3 pass1">
                                                <label for="loginPasswordEmail" class="form-label fw-500">Password</label>
                                                <a class="float-end text-2" href="forgot-password.php">Forgot Password
                                                    ?</a>
                                                <input type="password" class="form-control bg-light border-light" id="loginPasswordEmail" required="" placeholder="Enter Password">
                                                <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                                            </div>
                                            <button class="btn btn-primary shadow-none mt-2" id="loginviaEmail" type="button">Sign in</button>
                                        </form>

                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 loginwithme" data-id=".mobileform" data-bs-toggle="tooltip" data-bs-original-title="SignIn with Mobile Number">Or SignIn with Mobile
                                                Number</span>
                                            <hr class="flex-grow-1">
                                        </div>

                                    </div>

                                    <div class="mylogfrm mobileform active">
                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 text-muted">Sign in with Mobile</span>
                                            <hr class="flex-grow-1">
                                        </div>
                                        <form id="loginForm">
                                            <div class="mb-3">
                                                <label for="mobileNumber" class="form-label fw-500">Mobile
                                                    Number</label>
                                                <input type="text" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')" class="form-control bg-light border-light" id="mobileNumber" required="" placeholder="Enter Mobile Number">
                                            </div>
                                            <div class="mb-3 pass2">
                                                <label for="loginPasswordMob" class="form-label fw-500">Password</label>
                                                <a class="float-end text-2" href="forgot-password.php">Forgot Password
                                                    ?</a>
                                                <input type="password" class="form-control bg-light border-light" id="loginPasswordMob" required="" placeholder="Enter Password">
                                                <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password1"></span>
                                            </div>
                                            <button class="btn btn-primary shadow-none mt-2" type="button" id="loginviaMob">Sign in</button>
                                        </form>

                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 loginwithme" data-id=".emailform" data-bs-toggle="tooltip" data-bs-original-title="SignIn with Email-Id">Or SignIn with
                                                Email-Id</span>
                                            <hr class="flex-grow-1">
                                        </div>

                                    </div>
                                </div>
                                <div class="customerdiv_vendor <?= (isset($_GET['vendorlogin'])) ? '' : 'mylogfrm'; ?> ">
                                    <h3 class="fw-600 mb-4">Sign in to Discount Dhamaka</h3>



                                    <div class="mylogfrm emailform active">
                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 text-muted">Sign in with Mobile Number</span>
                                            <hr class="flex-grow-1">
                                        </div>
                                        <form id="vendor_loginForm">
                                            <div class="mb-2">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="c_code_de mb-3">
                                                            <label for="countryCode" class="form-label fw-500">Country
                                                                Code</label>
                                                            <select name="countryCode" class="form-control bg-light border-light countrycodeslc2" id="Vendorc_code" disabled>
                                                                <option></option>
                                                                <option value="91" selected>India 91</option>
                                                            </select>
                                                            <i class="fa fa-phone-alt"></i>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-8">
                                                        <label for="vendor_mobileNumber" class="form-label fw-500">Mobile Number</label>
                                                        <input type="text" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')" class="form-control bg-light border-light" id="vendor_mobileNumber" required="" placeholder="Enter Mobile Number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 pass3">
                                                <label for="VendorLoginPass" class="form-label fw-500">Password</label>
                                                <a class="float-end text-2" href="forgot-password.php?<?= $urltoken . $urltoken ?>&&vendorfrgrt&&<?= $urltoken . $urltoken ?>">Forgot Password
                                                    ?</a>
                                                <input type="password" class="form-control bg-light border-light" id="VendorLoginPass" required="" placeholder="Enter Password">
                                                <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password2"></span>
                                            </div>
                                            <button class="btn btn-primary shadow-none mt-2" type="button" id="vendor_loginBtn"> Sign in</button>
                                        </form>



                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 loginwithme" data-id=".mobileform" data-bs-toggle="tooltip" data-bs-original-title="Login with User Name">Or Login with User Name</span>
                                            <hr class="flex-grow-1">
                                        </div>
                                    </div>
                                    <div class="mylogfrm mobileform ">
                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 text-muted">Sign in with User Name</span>
                                            <hr class="flex-grow-1">
                                        </div>
                                        <form id="vendor_loginForm_user">
                                            <div class="mb-3">
                                                <div class="row">

                                                    <div class="col-md-12">
                                                        <label for="vendor_userName" class="form-label fw-500">User Name</label>
                                                        <input type="text" class="form-control bg-light border-light" id="vendor_userName" required="" placeholder="Enter User Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 pass3">
                                                <label for="VendorLoginPassUser" class="form-label fw-500">Password</label>
                                                <a class="float-end text-2" href="forgot-password.php?<?= $urltoken . $urltoken ?>&&vendorfrgrt&&<?= $urltoken . $urltoken ?>">Forgot Password
                                                    ?</a>
                                                <input type="password" class="form-control bg-light border-light" id="VendorLoginPassUser" required="" placeholder="Enter Password">
                                                <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password2"></span>
                                            </div>
                                            <button class="btn btn-primary shadow-none mt-2" type="button" id="vendor_loginBtn_user"> Sign in</button>


                                        </form>

                                        <div class="d-flex align-items-center my-4">
                                            <hr class="flex-grow-1">
                                            <span class="mx-3 text-2 loginwithme" data-id=".emailform" data-bs-toggle="tooltip" data-bs-original-title="Login with Mobile Number">Or Login with
                                                Mobile Number</span>
                                            <hr class="flex-grow-1">
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Login Form End -->
        </div>
    </div>
    </div>


    <!-- Script -->
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/select2/select2.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/log-reg.js"></script>
    <script>
        $(document).on("click", ".srbVen_log", function() {
            $('.customerdiv_vendor').removeClass('mylogfrm');
            $('.customerdiv').addClass('mylogfrm');
            $('.srbVen_log').addClass('srbuser_log');
            $('.srbuser_log').removeClass('srbVen_log');
            $("#namePos").text('User');
            $("#resNam").text('Register as a Vendor ?');
            $('.cghref').attr('href', 'business.php');
        });
        $(document).on("click", ".srbuser_log", function() {
            $('.customerdiv').removeClass('mylogfrm');
            $('.customerdiv_vendor').addClass('mylogfrm');
            $('.srbuser_log').addClass('srbVen_log');
            $('.srbVen_log').removeClass('srbuser_log');
            $("#namePos").text('Vendor');
            $("#resNam").text('Not a member ?');
            $('.cghref').attr('href', 'register.php');
        });

        $("#Vendorc_code").select2({
            placeholder: "Select Country Code"
        });

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
    <script>
        $(document).on("click", "#loginviaMob", function() {
            mobNum = $("#mobileNumber").val();
            UserpassWord = $("#loginPasswordMob").val();
            if (mobNum == "") {
                swicon = "warning";
                msg = "Enter Mobile Num";
                srbSweetAlret(msg, swicon);

            } else if (UserpassWord == "") {
                swicon = "warning";
                msg = "Enter Password";
                srbSweetAlret(msg, swicon);

            } else {

                $.ajax({
                    type: "POST",
                    url: "ajax/login.php",
                    data: {
                        mobNum: mobNum,
                        UserpassWord: UserpassWord,
                        type: 'userLogMob'
                    },
                    beforeSend: function() {
                        $("#loader").fadeIn(300);
                    },
                    complete: function() {
                        $("#loader").fadeOut(300);
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            var url = window.location.href;
                            url = url.split('url=')[1];
                            // console.log(url);
                            if (url == undefined) {
                                url = "profile.php"
                            }
                            // console.log(url);

                            location.href = url;
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);

                        };
                    }
                });
            }
        });

        $(document).on("click", "#loginviaEmail", function() {

            emailId = $("#emailAddress").val();
            UserpassWord = $("#loginPasswordEmail").val();

            if (emailId == "") {
                alert("Enter Email id");
            } else if (UserpassWord == "") {
                alert("verify Email");
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/login.php",
                    data: {
                        emailId: emailId,
                        UserpassWord: UserpassWord,
                        type: 'userLogEmail'
                    },
                    beforeSend: function() {
                        $("#loader").fadeIn(300);
                    },
                    complete: function() {
                        $("#loader").fadeOut(300);
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            var url = window.location.href;
                            url = url.split('url=')[1];
                            //  console.log(url);
                            if (url == undefined) {
                                url = "index.php"
                            }
                            // console.log(url);
                            location.href = url;
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                        }
                    }
                });
            }
        });

        $(document).on("click", "#vendor_loginBtn", function() {
            Vendorc_code = $("#Vendorc_code").val();
            vendor_mobileNumber = $("#vendor_mobileNumber").val();
            VendorLoginPass = $("#VendorLoginPass").val();
            if (Vendorc_code == "") {
                swicon = "warning";
                msg = "Select Country Code";
                srbSweetAlret(msg, swicon);

            } else if (vendor_mobileNumber == "") {
                swicon = "warning";
                msg = "Enter Mobile Num";
                srbSweetAlret(msg, swicon);

            } else if (VendorLoginPass == "") {
                swicon = "warning";
                msg = "Enter Password";
                srbSweetAlret(msg, swicon);

            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/login.php",
                    data: {
                        Vendorc_code: Vendorc_code,
                        vendor_mobileNumber: vendor_mobileNumber,
                        VendorLoginPass: VendorLoginPass,
                        type: 'vendorLogMob'
                    },
                    beforeSend: function() {
                        $("#loader").fadeIn(300);
                    },
                    complete: function() {
                        $("#loader").fadeOut(300);
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            if (data.FirstLogin == "1") {
                                location.href =
                                    "choose-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&SubsPlan_type=memPlan&&<?= $urltoken ?>&<?= $urltoken ?>";
                            } else {
                                location.href = "vendor-profile.php";
                            }

                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);

                        }
                    }
                });
            }
        });

        $(document).on("click", "#vendor_loginBtn_user", function() {

            vendor_userName = $("#vendor_userName").val();
            VendorLoginPassUser = $("#VendorLoginPassUser").val();
            if (Vendorc_code == "") {
                swicon = "warning";
                msg = "Select Country Code";
                srbSweetAlret(msg, swicon);

            } else if (vendor_userName == "") {
                swicon = "warning";
                msg = "Enter User Name";
                srbSweetAlret(msg, swicon);

            } else if (VendorLoginPassUser == "") {
                swicon = "warning";
                msg = "Enter Password";
                srbSweetAlret(msg, swicon);

            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/login.php",
                    data: {

                        vendor_userName: vendor_userName,
                        VendorLoginPassUser: VendorLoginPassUser,
                        type: 'vendorLogUser'
                    },
                    beforeSend: function() {
                        $("#loader").fadeIn(300);
                    },
                    complete: function() {
                        $("#loader").fadeOut(300);
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            if (data.FirstLogin == "1") {
                                location.href =
                                    "choose-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&SubsPlan_type=memPlan&&<?= $urltoken ?>&<?= $urltoken ?>";
                            } else {
                                // location.href = "";
                                // window.open("","_self")
                                window.location.replace("vendor-profile.php");
                            }

                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);

                        }
                    }
                });
            }
        });
    </script>

</body>

</html>