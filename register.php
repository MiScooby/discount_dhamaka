<!DOCTYPE html>
<html lang="en">

<head>
  <title>Discount Dhamaka - Login and Register</title>
  <link href="assets/images/favicon/favicon-8.png" rel="icon">

  <meta name="description" content="Login and Register">


  <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/lgn-reg.css?v1.1">
  <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
  <link id="color-switcher" type="text/css" rel="stylesheet" href="assets/css/color-teal.css">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


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

    .veribtn {
      margin-top: 32px;
    }

    .veribtn button.myotpbtn {
      font-size: 14px;
      background: #bcefe0;
      border: 1px solid #bcefe0;
      color: #292929;
      height: 50px;
      width: 100%;
      font-weight: 600;
      border-radius: 0.25rem;
    }

    .checkUser {
      font-size: 14px;
      background: #bcefe0;
      border: 1px solid #bcefe0;
      color: #292929;
      height: 52px;
      width: 100%;
      font-weight: 600;
      border-radius: 0.25rem;
      line-height: 1.4;
      border-top-left-radius: 0;
      border-bottom-left-radius: 0;
    }

    @media(max-width:768px) {
      .veribtn {
        margin-top: 0;
      }

      .veribtn button.myotpbtn {
        font-size: 14px;
        background: #bcefe0;
        border: 1px solid #bcefe0;
        color: #292929;
        height: 40px;
        width: 120px;
        font-weight: 600;
        border-radius: 0.25rem;
      }

      span.select2-selection.select2-selection--single {
        display: block;
        width: 100% !important;
        padding: 0.375rem 0.75rem;
        font-size: 14px;
        font-weight: 400;
        height: 38px;
        line-height: 27px;
        color: #212529;
        background-color: #f5f5f6;
        background-clip: padding-box;
        border: 1px solid #ced4da4f;
        appearance: none;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
      }

      .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 24px;
      }

      .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
      }
    }
  </style>

</head>

<body>


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
                    <div class="logo mt-5 mb-5 mb-md-0"> <a class="d-flex justify-content-center" href="index.php" title="Discount Dhamaka"><img src="assets/images/logo/logo-8.png" alt="Discount Dhamaka"></a> </div>
                  </div>
                </div>
                <div class="row g-0 my-auto">
                  <div class="col-11 col-md-10 col-lg-9 mx-auto">
                    <!-- <p class="text-4 fw-600 lh-base text-white text-center">Looks like you're new here!</p> -->
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
                <p class="text-end text-2 mb-0">Already a member? <a href="login.php">Sign In</a></p>
              </div>
            </div>
          </div>
          <div class="container my-auto py-5">
            <div class="row g-0">
              <div class="col-11 col-md-10 col-lg-9 col-xl-10 mx-auto">
                <h3 class="fw-600 mb-4">Sign up to Discount Dhamaka</h3>
                <div class="row gx-2">
                  <div class="col-4 col-sm-4 col-lg-6">
                    <div class="d-grid">

                      <a href="https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=online&client_id=1039272015800-ps9thae69neqvju16qqrndvji3r28do4.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fmicodetest.com%2Fdiscount-dhamaka%2Fprofile.php&state&scope=email%20profile&approval_prompt=auto" class="btn btn-google btn-sm fw-400 shadow-none"><span class="me-2"><i class="fab fa-google"></i></span><span class="d-none d-lg-inline">Sign up with Google</span></a>

                    </div>
                  </div>
                  <div class="col-8 col-sm-8 col-lg-6">
                    <div class="d-flex flex-column">
                      <div class="d-grid">

                        <a href="https://www.facebook.com/v2.10/dialog/oauth?client_id=681751543414562&state=d29fde4b051fbfebb5b16e1fbe41557d&response_type=code&sdk=php-sdk-5.7.0&redirect_uri=https%3A%2F%2Fmicodetest.com%2Fdiscount-dhamaka%2Fprofile.php&scope=email" class="btn btn-facebook btn-sm fw-400 shadow-none"><span class="me-2"><i class="fab fa-facebook-f"></i></span><span class="d-none d-lg-inline">Sign up with Facebook</span></a>


                      </div>
                    </div>
                  </div>
                </div>

                <div class="mylogfrm emailform ">
                  <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-2 text-muted">Or with Email</span>
                    <hr class="flex-grow-1">
                  </div>
                  <form id="registerForm1" method="post">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="mb-3">
                          <label for="emailAddress" class="form-label fw-500">Email Address</label>
                          <div class="myrwdiv">
                            <input type="email" class="form-control bg-light border-light" id="emailAddress" required="" placeholder="Enter Email Address">
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="row" id="otpVerSec">
                      <div class="col-md-5">
                        <div class="mb-3">
                          <label for="verifyOtp" class="form-label fw-500">Verify OTP</label>
                          <div class="myrwdiv">
                            <input type="text" class="form-control bg-light border-light" id="verifyOtp" required="" maxlength="4" disabled placeholder="Verify OTP">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="mb-3 veribtn">
                          <button type="button" id="sendEmailotp" class="myotpbtn">Send Verification OTP</button>
                          <div id="EmailSendOtpSec"></div>
                        </div>
                      </div>
                    </div>

                    <div style="display:none;" id="signUpfiledEmail">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">

                            <label for="email_userName" class="form-label fw-500">User Name</label>
                            <div class="myrwdiv">

                              <input type="text" class="form-control bg-light border-light" id="email_userName" required="" placeholder="Enter First Name">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="email_firstName" class="form-label fw-500">First Name</label>
                            <input type="text" class="form-control bg-light border-light" id="email_firstName" required="" placeholder="Enter First Name">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="email_lastName" class="form-label fw-500">Last Name</label>
                            <input type="text" class="form-control bg-light border-light" id="email_lastName" required="" placeholder="Enter Last Name">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3 pass1">
                            <label for="email_Password" class="form-label fw-500">Password</label>
                            <input type="password" class="form-control bg-light border-light" id="email_Password" required="" placeholder="Enter Password">
                            <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3 ">
                            <label for="email_confirmPassword" class="form-label fw-500">Confirm Password</label>
                            <input type="password" class="form-control bg-light border-light" id="email_confirmPassword" required="" placeholder="Enter Password">

                          </div>
                        </div>
                      </div>


                      <div class="form-check my-4">
                        <input id="agree_term_email" name="agree_term_email" class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="agree_term_email">I agree to the <a href="terms-condition.php" target="_blank">Terms</a> and <a href="privacy-policy.php" target="_blank">Privacy Policy</a>.</label>
                      </div>
                    </div>

                    <div class="text-center mt-3">
                      <button class="btn btn-primary shadow-none" disabled id="signUpwithemailBtn" type="button">Create Account With Email Id</button>
                    </div>

                  </form>

                  <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-2 loginwithme" data-id=".mobileform" data-bs-toggle="tooltip" data-bs-original-title="SignUp with Mobile Number">Or SignUp with Mobile Number</span>
                    <hr class="flex-grow-1">
                  </div>

                </div>
                <style>

                </style>
                <div class="mylogfrm mobileform active">
                  <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-2 text-muted">Or with Mobile</span>
                    <hr class="flex-grow-1">
                  </div>
                  <form id="registerForm2" method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="c_code_de mb-3">
                          <label for="countryCode" class="form-label fw-500">Country Code</label>
                          <select name="countryCode" class="form-control bg-light border-light countrycodeslc2" id="c_code" disabled>
                            <option></option>
                            <option value="91" selected>India 91</option>
                          </select>
                          <i class="fa fa-phone-alt"></i>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="mb-3">
                          <label for="mob_num" class="form-label fw-500">Mobile Number</label>
                          <div class="myrwdiv">
                            <input type="text" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')" class="form-control bg-light border-light" id="mob_num" required="" placeholder="Enter Mobile Number">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="otpVerSecmob">
                      <div class="col-md-5">
                        <div class="mb-3">
                          <label for="verifyOtpMob"  maxlength="4" oninput="this.value = this.value.replace(/\D+/g, '')" class="form-label fw-500">Verify OTP</label>
                          <div class="myrwdiv">
                            <input type="text"  class="form-control bg-light border-light" id="verifyOtpMob" required="" disabled placeholder="Verify OTP">

                          </div>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <div class="mb-3 veribtn">
                          <button type="button" id="sendMobotp" class="myotpbtn">Send Verification OTP</button>
                          <div id="MobiSendOtpSec"></div>
                        </div>
                      </div>
                    </div>
                    <div style="display: none;" id="signUpfiledMob">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">

                            <label for="mob_userName" class="form-label fw-500">User Name</label>
                            <div class="myrwdiv">

                              <input type="text" class="form-control bg-light border-light" id="mob_userName" required="" placeholder="Enter First Name">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="mob_firstName" class="form-label fw-500">First Name</label>
                            <input type="text" class="form-control bg-light border-light" id="mob_firstName" required="" placeholder="Enter First Name">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="mob_lastName" class="form-label fw-500">Last Name</label>
                            <input type="text" class="form-control bg-light border-light" id="mob_lastName" required="" placeholder="Enter Last Name">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-3 pass2">
                            <label for="mob_Password" class="form-label fw-500">Password</label>
                            <input type="password" class="form-control bg-light border-light" id="mob_Password" required="" placeholder="Enter Password">
                            <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password1"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-3">
                            <label for="mob_confirmPassword" class="form-label fw-500">Confirm Password</label>
                            <input type="password" class="form-control bg-light border-light" id="mob_confirmPassword" required="" placeholder="Enter Password">
                          </div>
                        </div>
                      </div>
                      <div id="ErrMsg" style="display: none;"></div>

                      <div class="form-check my-4">
                        <input id="agree_term" name="agree_term" class="form-check-input" type="checkbox">
                        <label class="form-check-label" for="agree_term">I agree to the <a href="terms-condition.php" target="_blank">Terms</a> and <a href="privacy-policy.php" target="_blank">Privacy Policy</a>.</label>
                      </div>
                    </div>
                    <div class="text-center mt-3">
                      <button class="btn btn-primary shadow-none m-auto text-center" disabled id="signUpwithmobileBtn" type="button">Create Account With Mobile Number</button>
                    </div>
                  </form>
                  <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-2 loginwithme" data-id=".emailform" data-bs-toggle="tooltip" data-bs-original-title="SignUp with Email-Id">Or SignUp with Email-Id</span>
                    <hr class="flex-grow-1">
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


  <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
  <script src="assets/select2/select2.min.js"></script>
  <script src="assets/sweetalert2/sweetalert2.min.js"></script>
  <script src="assets/js/log-reg.js"></script>

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

    function IsEmail(email) {
      var regex =
        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
      if (!regex.test(email)) {
        return false;
      } else {
        return true;
      }
    }
  </script>
  <script>
    $("#emailAddress").blur(function() {
      var emailAddress = $("#emailAddress").val();
      if (IsEmail(emailAddress) == false) {
        swicon = "warning";
        msg = " Enter an valid email address";
        srbSweetAlret(msg, swicon);
        $("#sendEmailotp").attr('disabled', 'disabled');
      } else {
        $("#sendEmailotp").removeAttr('disabled', 'disabled');
      }
    });


    $("#mob_Password").on("keyup", function(e) {
      $(this).prop('type', 'password');
      var value = $(this).val();
      if (value != '') {
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
        var isValid = regex.test(value);
        if (!isValid) {
          $('#signUpwithmobileBtn').attr('disabled', 'disabled');
          $("#mob_Password").addClass('err_bdr');
          $("#ErrMsg").show();
          $("#ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
        } else {
          $("#ErrMsg").hide();
          $('#signUpwithmobileBtn').removeAttr('disabled', 'disabled');
          $("#mob_Password").removeClass('err_bdr');
        }
      }
    });


    $("#c_code").select2({
      placeholder: "Select Country Code"
    });
    $(document).on("click", "#sendEmailotp", function() {

      emailAddress = $("#emailAddress").val();
      if (emailAddress == "") {
        swicon = "warning";
        msg = "Enter Email id";
        srbSweetAlret(msg, swicon);
      } else {
        $.ajax({
          type: "POST",
          url: "ajax/otp.php",
          data: {
            emailAddress: emailAddress,
            type: 'EmailOtp',
            usertype: 'user'
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

              swicon = "success";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#emailAddress").attr('disabled', 'disabled');
              $("#verifyOtp").removeAttr('disabled');
              $("#sendEmailotp").text('Verify Otp');
              $("#sendEmailotp").attr('id', 'verifyEmailOtp');
              $("#EmailSendOtpSec").html('<p class="resendotp"> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>');

              var timeleft = 30;
              var downloadTimer = setInterval(function() {
                timeleft--;
                document.getElementById("countdowntimer").textContent = timeleft;
                if (timeleft <= 0) {
                  clearInterval(downloadTimer);
                  $(".resendotp").html("<a href='javascript:void(0);' id='sendEmailotp'>Resend otp</a>");
                }

              }, 1000);

            } else {
              swicon = "warning";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#emailAddress").val('');
            }

          }
        });
      }
    });
    $(document).on("click", "#verifyEmailOtp", function() {
      emailAddress = $("#emailAddress").val();
      emailOtp = $("#verifyOtp").val();
      if (emailOtp == "") {
        swicon = "warning";
        msg = "Please Enter Verification Code";
        srbSweetAlret(msg, swicon);
      } else {
        $.ajax({
          type: "POST",
          url: "ajax/otp.php",
          data: {
            emailAddress: emailAddress,
            emailOtp: emailOtp,
            type: 'verEmailOtp',
            usertype: 'user'
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
              swicon = "success";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#emailAddress").attr('disabled', 'disabled');
              $("#otpVerSec").hide();
              $("#signUpfiledEmail").show();
              $("#signUpwithemailBtn").removeAttr('disabled');
            } else {
              swicon = "warning";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#verifyOtp").val('');
            }

          }
        });
      }
    });


    function emailVerified() {
      let emailVerified;
      $.ajax({
        url: "ajax/otp.php",
        type: "POST",
        async: false,
        data: {
          type: 'emailVerified'
        },
        success: function(data) {
          if (data) {
            emailVerified = data;
          } else {
            emailVerified = data;
          }
        }
      });

      return emailVerified;
    }

    $(document).on("click", "#signUpwithemailBtn", function() {
      // $("#loader").fadeIn(300);

      emailAddress = $("#emailAddress").val();
      email_ver = emailVerified();
      email_userName = $("#email_userName").val();
      email_firstName = $("#email_firstName").val();
      email_lastName = $("#email_lastName").val();
      email_Password = $("#email_Password").val();
      email_confirmPassword = $("#email_confirmPassword").val();

      $agree_term = $("#agree_term_email").prop('checked');

      if (emailAddress == "") {

        swicon = "warning";
        msg = "Please Enter Email id";
        srbSweetAlret(msg, swicon);

      } else if (email_ver !== "1" && email_ver == "0") {
        swicon = "warning";
        msg = "verify Email";
        srbSweetAlret(msg, swicon);

      } else if (email_userName == "") {
        swicon = "warning";
        msg = "Enter User Name";
        srbSweetAlret(msg, swicon);

      } else if (email_firstName == "") {
        swicon = "warning";
        msg = "Enter First Name";
        srbSweetAlret(msg, swicon);

      } else if (email_lastName == "") {
        swicon = "warning";
        msg = "Enter Last Name";
        srbSweetAlret(msg, swicon);

      } else if (email_Password == "") {
        swicon = "warning";
        msg = "Enter Password ";
        srbSweetAlret(msg, swicon);

      } else if (email_confirmPassword == "") {
        swicon = "warning";
        msg = "Enter cfn Password";
        srbSweetAlret(msg, swicon);

      } else if ($agree_term == false) {
        swicon = "warning";
        msg = "Please Agree Terms & Conditions";
        srbSweetAlret(msg, swicon);

      } else {
        $.ajax({
          url: "ajax/registration.php",
          type: "POST",
          async: false,
          data: {
            emailAddress: emailAddress,
            email_ver: email_ver,
            email_firstName: email_firstName,
            email_userName: email_userName,
            email_lastName: email_lastName,
            email_Password: email_Password,
            email_confirmPassword: email_confirmPassword,
            type: 'registerViaEmail'
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
              if (url == undefined) {
                url = "profile.php"
              }
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

    $(document).on("click", "#sendMobotp", function() {
      c_code = $("#c_code").val();
      mobNum = $("#mob_num").val();



      if (c_code == "") {
        swicon = "warning";
        msg = "Select Country COde ";
        srbSweetAlret(msg, swicon);

      } else if (mobNum == "") {
        swicon = "warning";
        msg = "Enter Mobile";
        srbSweetAlret(msg, swicon);

      } else {
        $.ajax({
          type: "POST",
          url: "ajax/otp.php",
          data: {
            c_code: c_code,
            mobNum: mobNum,
            type: 'MobileOtp',
            usertype: 'user'
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
              swicon = "success";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#mob_num").attr('disabled', 'disabled');
              $("#verifyOtpMob").removeAttr('disabled');
              $("#sendMobotp").text('Verify Otp');
              $("#sendMobotp").attr('id', 'verifyMobOtp');
              $("#MobiSendOtpSec").html('<p class="resendotp"> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>');

              var timeleft = 30;
              var downloadTimer = setInterval(function() {
                timeleft--;
                document.getElementById("countdowntimer").textContent = timeleft;
                if (timeleft <= 0) {
                  clearInterval(downloadTimer);
                  $(".resendotp").html("<a href='javascript:void(0);' id='sendMobotp'>Resend otp</a>");
                }

              }, 1000);

            } else {
              swicon = "warning";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#mob_num").val('');
              $("#c_code").select2();
            }

          }
        });
      }
    });

    $(document).on("click", "#verifyMobOtp", function() {
      verifyOtpMob = $("#verifyOtpMob").val();
      mobNum = $("#mob_num").val();
      c_code = $("#c_code").val();

      if (verifyOtpMob == "") {
        swicon = "warning";
        msg = "Please Enter Verification Code";
        srbSweetAlret(msg, swicon);

      } else {
        $.ajax({
          type: "POST",
          url: "ajax/otp.php",
          data: {
            c_code: c_code,
            verifyOtpMob: verifyOtpMob,
            mobNum: mobNum,
            type: 'MobileOtpVer',
            usertype: 'user'
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
              swicon = "success";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#mob_num").attr('disabled', 'disabled');
              $("#c_code").attr('disabled', 'disabled');
              $("#otpVerSecmob").hide();
              $("#signUpfiledMob").show();
              $("#signUpwithmobileBtn").removeAttr('disabled');
            } else {
              swicon = "warning";
              msg = data.message;
              srbSweetAlret(msg, swicon);
            }

          }
        });
      }
    });

    function mobileVerified() {

      let mobileVerified;
      $.ajax({
        url: "ajax/otp.php",
        type: "POST",
        async: false,
        data: {
          type: 'mobileVerified'
        },
        success: function(data) {

          if (data) {
            mobileVerified = data;
          } else {
            mobileVerified = data;
          }
        }
      });

      return mobileVerified;
    }

    $(document).on("click", "#signUpwithmobileBtn", function() {

      c_code = $("#c_code").val();
      mobNum = $("#mob_num").val();
      mobile_ver = mobileVerified();
      mob_userName = $("#mob_userName").val();
      mob_firstName = $("#mob_firstName").val();
      mob_lastName = $("#mob_lastName").val();
      mob_Password = $("#mob_Password").val();
      mob_confirmPassword = $("#mob_confirmPassword").val();
      $agree_term = $("#agree_term").prop('checked');

      if (c_code == "") {
        swicon = "warning";
        msg = "Select Country Code";
        srbSweetAlret(msg, swicon);

      } else if (mobNum == "") {
        swicon = "warning";
        msg = "Enter Mobile Num";
        srbSweetAlret(msg, swicon);

      } else if (mobile_ver !== "1" && mobile_ver == "0") {
        swicon = "warning";
        msg = "Please Verify Mobile";
        srbSweetAlret(msg, swicon);

      } else if (mob_userName == "") {
        swicon = "warning";
        msg = "Enter User Name";
        srbSweetAlret(msg, swicon);

      } else if (mob_firstName == "") {
        swicon = "warning";
        msg = "Enter First Name";
        srbSweetAlret(msg, swicon);

      } else if (mob_lastName == "") {
        swicon = "warning";
        msg = "Enter Last Name";
        srbSweetAlret(msg, swicon);

      } else if (mob_Password == "") {
        swicon = "warning";
        msg = "Enter Password ";
        srbSweetAlret(msg, swicon);

      } else if (mob_confirmPassword == "") {
        swicon = "warning";
        msg = "Enter cfn Password";
        srbSweetAlret(msg, swicon);

      } else if ($agree_term == false) {
        swicon = "warning";
        msg = "Please Agree To The Terms & Conditions";
        srbSweetAlret(msg, swicon);

      } else {
        $.ajax({
          url: "ajax/registration.php",
          type: "POST",
          async: false,
          data: {
            c_code: c_code,
            mobNum: mobNum,
            mobile_ver: mobile_ver,
            mob_firstName: mob_firstName,
            mob_userName: mob_userName,
            mob_lastName: mob_lastName,
            mob_Password: mob_Password,
            mob_confirmPassword: mob_confirmPassword,
            type: 'registerViaMob'
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
              
              if (url == undefined) {
                url = "profile.php"
              }
              

              location.href = url;
            } else {
              swicon = "warning";
              msg = data.message;
              srbSweetAlret(msg, swicon);
              $("#loader").fadeOut(300);
            }
          }
        });
      }
    });
  </script>
</body>

</html>