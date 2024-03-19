<?php include('admin/ajax/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Discount Dhamaka - Forgot Password</title>
  <link href="assets/images/favicon/favicon-8.png" rel="icon">

  <meta name="description" content="Forgot Password">

  <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/vendor/font-awesome/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/lgn-reg.css">
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
                    <p class="text-9 fw-600   text-white text-center">Don't worry,</p>
                    <h1 class="text-9 fw-600 mb-5 text-white text-center">We are here to help you to recover your password.</h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Welcome Text End -->

        <!-- Forgot password Form
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
                  if (isset($_GET['vendorfrgrt'])) {
                  ?>
                    <p class="text-end text-2 mb-0">Return to <a href="login.php?<?= $urltoken . $urltoken ?>&vendorlogin&<?= $urltoken . $urltoken ?>">Sign In</a></p>
                  <?php
                  } else {
                  ?>
                    <p class="text-end text-2 mb-0">Return to <a href="login.php">Sign In</a></p>
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
                <h3 class="fw-600 mb-4">Forgot password?</h3>


                <?php
                if (isset($_GET['vendorfrgrt'])) {
                ?>
                  <div class="vendorform">
                    

                    <form id="vforgotPassForm-mob" method="post">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="c_code_de mb-3">
                            <label for="vfp_c_code" class="form-label fw-500">Country Code</label>
                            <select name="vfp_c_code" class="form-control bg-light border-light countrycodeslc2" id="vfp_c_code" disabled>
                              <option></option>
                              <option value="91" selected>India 91</option>
                            </select>
                            <i class="fa fa-phone-alt"></i>
                          </div>

                        </div>
                        <div class="col-md-7">
                          <div class="mb-3">
                            <label for="vfp_mob_num" class="form-label fw-500">Mobile Number</label>
                            <div class="myrwdiv">
                              <input type="number" class="form-control bg-light border-light" id="vfp_mob_num" required="" placeholder="Enter Mobile Number">
                            </div>
                          </div>
                        </div>

                        <div class="col-md-5">
                          <div class="mb-3">
                            <label for="vfp_verifyOtpMob" class="form-label fw-500">Verify OTP</label>
                            <div class="myrwdiv">
                              <input type="text" class="form-control bg-light border-light" id="vfp_verifyOtpMob" required="" disabled placeholder="Verify OTP">

                            </div>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="mb-3 veribtn">
                            <button type="button" id="vfp_mob_btn" class="myotpbtn">Send Verification OTP</button>
                            <div id="vMobiSendOtpSec"></div>
                          </div>
                        </div>
                      </div>
                    </form>

                    <form id="vCreatePassForm-mob" method="post" style="display: none;">
                      <input type="hidden" name="vMobUserName" id="vMobUserName">
                      <div class="mb-3 pass2">
                        <label for="vmob_newPswd" class="form-label fw-500">Password</label>
                        <a class="float-end text-2" href="forgot-password.php">Forgot Password ?</a>
                        <input type="password" class="form-control bg-light border-light" id="vmob_newPswd" required="" placeholder="Enter New Password">
                        <span toggle="#password-field" class="fa field-icon toggle-password1 fa-eye-slash"></span>
                      </div>

                      <div class="mb-3">
                        <label for="vmob_cfrmPswd" class="form-label fw-500">Confirm Password</label>
                        <input type="password" class="form-control bg-light border-light" id="vmob_cfrmPswd" required="" placeholder="Enter Confirm Password">
                      </div>
                      <div id="ErrMsg3" style="display: none;"></div>
                      <button class="btn btn-primary shadow-none mt-2" id="vcreatePswdMob" type="button">Create New Password</button>
                    </form>
                  </div>
                <?php
                } else {
                ?>
                  <div class="customerdiv">
                    <div class="mylogfrm emailform">
                      <p class="text-muted mb-4">Enter the email address associated with your account.</p>
                      <form id="forgotPassForm-email" method="post">
                        <div class="mb-3">
                          <label for="fb_emailAddress" class="form-label fw-500">Email id</label>
                          <input type="text" class="form-control bg-light border-light" id="fb_emailAddress" required="" placeholder="Enter Email id">
                        </div>
                        <div class="row">
                          <div class="col-md-5">
                            <div class="mb-3">
                              <label for="fp_verifyOtpEmail" class="form-label fw-500">Verify OTP</label>
                              <div class="myrwdiv">
                                <input type="text" class="form-control bg-light border-light" id="fp_verifyOtpEmail" required="" disabled placeholder="Verify OTP">

                              </div>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="mb-3 veribtn">
                              <button type="button" id="fb_email_btn" class="myotpbtn">Send Verification OTP</button>
                              <div id="EmailSendOtpSec"></div>
                            </div>
                          </div>
                        </div>
                      </form>

                      <form id="CreatePassForm-Email" method="post" style="display: none;">
                        <input type="hidden" name="EmailUserName" id="EmailUserName">
                        <div class="mb-3 pass2">
                          <label for="Email_newPswd" class="form-label fw-500">New Password</label>
                          <input type="password" class="form-control bg-light border-light" id="Email_newPswd" required="" placeholder="Enter New Password">
                          <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password1"></span>
                        </div>
                        <div class="mb-3">
                          <label for="Email_cfrmPswd" class="form-label fw-500">Confirm Password</label>
                          <input type="password" class="form-control bg-light border-light" id="Email_cfrmPswd" required="" placeholder="Enter Confirm Password">
                        </div>
                        <div id="ErrMsg" style="display: none;"></div>
                        <button class="btn btn-primary shadow-none mt-2" id="createPswdEmail" type="button">Create New Password</button>
                      </form>
                      <div class="d-flex align-items-center my-4">
                        <hr class="flex-grow-1">
                        <span class="mx-3 text-2 loginwithme" data-id=".mobileform" data-bs-toggle="tooltip" data-bs-original-title="Change password with Mobile Number">Or Change password with Mobile Number</span>
                        <hr class="flex-grow-1">
                      </div>
                    </div>

                    <div class="mylogfrm mobileform active">
                      <p class="text-muted mb-4">Enter the mobile number associated with your account.</p>


                      <form id="forgotPassForm-mob" method="post">
                        <div class="row">
                          <div class="col-md-5">
                            <div class="c_code_de mb-3">
                              <label for="fp_c_code" class="form-label fw-500">Country Code</label>
                              <select name="fp_c_code" class="form-control bg-light border-light countrycodeslc2" id="fp_c_code" disabled>
                                <option></option>
                                <option value="91" selected>India 91</option>
                              </select>
                              <i class="fa fa-phone-alt"></i>
                            </div>


                          </div>
                          <div class="col-md-7">
                            <div class="mb-3">
                              <label for="fp_mob_num" class="form-label fw-500">Mobile Number</label>
                              <div class="myrwdiv">
                                <input type="text" class="form-control bg-light border-light" id="fp_mob_num" required="" placeholder="Enter Mobile Number">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-5">
                            <div class="mb-3">
                              <label for="fp_verifyOtpMob" class="form-label fw-500">Verify OTP</label>
                              <div class="myrwdiv">
                                <input type="text" class="form-control bg-light border-light" id="fp_verifyOtpMob" required="" disabled placeholder="Verify OTP">

                              </div>
                            </div>
                          </div>
                          <div class="col-md-7">
                            <div class="mb-3 veribtn">
                              <button type="button" id="fp_mob_btn" class="myotpbtn">Send Verification OTP</button>
                              <div id="MobiSendOtpSec"></div>
                            </div>
                          </div>
                        </div>
                      </form>


                      <form id="CreatePassForm-mob" method="post" style="display: none;">
                        <input type="hidden" name="MobUserName" id="MobUserName">
                        <div class="mb-3 pass2">
                          <label for="mob_newPswd" class="form-label fw-500">New Password</label>
                          <input type="password" class="form-control bg-light border-light" id="mob_newPswd" required="" placeholder="Enter New Password">
                          <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password1"></span>
                        </div>
                        <div class="mb-3">
                          <label for="mob_cfrmPswd" class="form-label fw-500">Confirm Password</label>
                          <input type="password" class="form-control bg-light border-light" id="mob_cfrmPswd" required="" placeholder="Enter Confirm Password">
                        </div>
                        <div id="ErrMsg2" style="display: none;"></div>
                        <button class="btn btn-primary shadow-none mt-2" id="createPswdMob" type="button">Create New Password</button>
                      </form>
                      <div class="d-flex align-items-center my-4">
                        <hr class="flex-grow-1">
                        <span class="mx-3 text-2 loginwithme" data-id=".emailform" data-bs-toggle="tooltip" data-bs-original-title="Change password with Email-Id">Or Change password with Email-Id</span>
                        <hr class="flex-grow-1">
                      </div>
                    </div>


                  </div>
                <?php
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Forgot password Form End -->
      </div>
    </div>
  </div>

  <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
  <script src="assets/select2/select2.min.js"></script>
  <script src="assets/sweetalert2/sweetalert2.min.js"></script>
  <script src="assets/js/log-reg.js"></script>
  <script src="assets/js/srb-validation.js"></script>
  <script>
    $("#Email_newPswd").on("keyup", function(e) {
      $(this).prop('type', 'password');
      var value = $(this).val();
      if (value != '') {
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
        var isValid = regex.test(value);
        if (!isValid) {
          $('#createPswdEmail').attr('disabled', 'disabled');
          $("#Email_newPswd").addClass('err_bdr');
          $("#ErrMsg").show();
          $("#ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
        } else {
          $("#ErrMsg").hide();
          $('#createPswdEmail').removeAttr('disabled', 'disabled');
          $("#Email_newPswd").removeClass('err_bdr');
        }
      }
    });
    $("#mob_newPswd").on("keyup", function(e) {
      $(this).prop('type', 'password');
      var value = $(this).val();
      if (value != '') {
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
        var isValid = regex.test(value);
        if (!isValid) {
          $('#createPswdMob').attr('disabled', 'disabled');
          $("#mob_newPswd").addClass('err_bdr');
          $("#ErrMsg2").show();
          $("#ErrMsg2").html("<div class='err_msg' id='" + this.id + "ErrMsg2'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
        } else {
          $("#ErrMsg2").hide();
          $('#createPswdMob').removeAttr('disabled', 'disabled');
          $("#mob_newPswd").removeClass('err_bdr');
        }
      }
    });
    $("#vmob_newPswd").on("keyup", function(e) {
      $(this).prop('type', 'password');
      var value = $(this).val();
      if (value != '') {
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
        var isValid = regex.test(value);
        if (!isValid) {
          $('#vcreatePswdMob').attr('disabled', 'disabled');
          $("#vmob_newPswd").addClass('err_bdr');
          $("#ErrMsg3").show();
          $("#ErrMsg3").html("<div class='err_msg' id='" + this.id + "ErrMsg3'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
        } else {
          $("#ErrMsg3").hide();
          $('#vcreatePswdMob').removeAttr('disabled', 'disabled');
          $("#vmob_newPswd").removeClass('err_bdr');
        }
      }
    });
  </script>
  <script>
    $(document).ready(function() {
      $("#fp_c_code").select2({
        placeholder: "Select Country Code"
      });
      $("#vfp_c_code").select2({
        placeholder: "Select Country Code"
      });

      $(document).on("click", ".loginwithme", function() {

        var lgnwithme = $(this).attr("data-id");

        $(".mylogfrm").removeClass("active");
        $(lgnwithme).addClass("active");

      });


      $(document).on("click", "#fp_mob_btn", function() {
        fp_c_code = $("#fp_c_code").val();
        fp_mob_num = $("#fp_mob_num").val();

        if (fp_c_code == "") {

          swicon = "warning";
          msg = "Please Select Country Code";
          srbSweetAlret(msg, swicon);

        } else if (fp_mob_num == "") {

          swicon = "warning";
          msg = "Please Enter Mobile Number";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/otp.php",
            data: {
              fp_c_code: fp_c_code,
              fp_mob_num: fp_mob_num,
              type: 'frgtPassOtp',
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
                $("#fp_verifyOtpMob").removeAttr('disabled');
                $("#fp_mob_btn").text('Verify Otp');
                $("#fp_mob_btn").attr('id', 'fp_mob_ver_btn');
                $("#MobiSendOtpSec").html('<p class="resendotp"> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>');

                var timeleft = 30;
                var downloadTimer = setInterval(function() {
                  timeleft--;
                  document.getElementById("countdowntimer").textContent = timeleft;
                  if (timeleft <= 0) {
                    clearInterval(downloadTimer);
                    $(".resendotp").html("<a href='javascript:void(0);' id='fp_mob_btn'>Resend otp</a>");
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

      $(document).on("click", "#fb_email_btn", function() {
        fb_emailAddress = $("#fb_emailAddress").val();

        if (fb_emailAddress == "") {
          swicon = "warning";
          msg = "Please Enter Email Address";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/otp.php",
            data: {
              fb_emailAddress: fb_emailAddress,
              type: 'frgtPassOtp_email',
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
                $("#fp_verifyOtpEmail").removeAttr('disabled');
                $("#fb_email_btn").text('Verify Otp');
                $("#fb_email_btn").attr('id', 'fp_email_ver_btn');
                $("#EmailSendOtpSec").html('<p class="resendotp"> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>');

                var timeleft = 30;
                var downloadTimer = setInterval(function() {
                  timeleft--;
                  document.getElementById("countdowntimer").textContent = timeleft;
                  if (timeleft <= 0) {
                    clearInterval(downloadTimer);
                    $(".resendotp").html("<a href='javascript:void(0);' id='fb_email_btn'>Resend otp</a>");
                  }

                }, 1000);
              } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                $("#fb_emailAddress").val('');
              }

            }
          });
        }

      });


      $(document).on("click", "#fp_mob_ver_btn", function() {
        fp_verifyOtpMob = $("#fp_verifyOtpMob").val();
        fp_c_code = $("#fp_c_code").val();
        fp_mob_num = $("#fp_mob_num").val();

        if (fp_verifyOtpMob == "") {
          swicon = "warning";
          msg = "Please Enter Verification Code";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/otp.php",
            data: {
              fp_c_code: fp_c_code,
              fp_verifyOtpMob: fp_verifyOtpMob,
              fp_mob_num: fp_mob_num,
              type: 'Fp_MobileOtpVer',
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
                $("#fb_mob_num").attr('disabled', 'disabled');
                $("#fb_c_code").attr('disabled', 'disabled');
                $("#forgotPassForm-mob").hide();
                $("#CreatePassForm-mob").show();
                $("#MobUserName").val(data.userName);
              } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                $("#fb_mob_num").val('');
                $("#fb_c_code").select2();
              }

            }
          });
        }
      });


      $(document).on("click", "#fp_email_ver_btn", function() {
        fp_verifyOtpEmail = $("#fp_verifyOtpEmail").val();
        fb_emailAddress = $("#fb_emailAddress").val();

        if (fp_verifyOtpEmail == "") {
          swicon = "warning";
          msg = "Please Enter Verification Code";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/otp.php",
            data: {
              fp_verifyOtpEmail: fp_verifyOtpEmail,
              fb_emailAddress: fb_emailAddress,
              type: 'Fp_EmailOtpVer',
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
                $("#fp_verifyOtpEmail").attr('disabled', 'disabled');
                $("#forgotPassForm-email").hide();
                $("#CreatePassForm-Email").show();
                $("#EmailUserName").val(data.userName);
              } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                $("#fb_mob_num").val('');
                $("#fb_c_code").select2();
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

      $(document).on("click", "#createPswdMob", function() {
        MobUserName = $("#MobUserName").val();
        mob_newPswd = $("#mob_newPswd").val();
        mob_cfrmPswd = $("#mob_cfrmPswd").val();
        mobile_ver = mobileVerified();

        if (mob_newPswd == "") {
          swicon = "warning";
          msg = "Please Enter New Password";
          srbSweetAlret(msg, swicon);

        } else if (mob_cfrmPswd == "") {
          swicon = "warning";
          msg = "Please Enter Confirm Password";
          srbSweetAlret(msg, swicon);

        } else if (mobile_ver !== "1" && mobile_ver == "0") {
          swicon = "warning";
          msg = "Please Verify Mobile";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/password.php",
            data: {
              MobUserName: MobUserName,
              mob_newPswd: mob_newPswd,
              mob_cfrmPswd: mob_cfrmPswd,
              type: 'pswdUpdateMob'
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
                location.href = "login.php";
              } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                $("#mob_newPswd").val('');
                $("#mob_cfrmPswd").val('');
              }

            }
          });
        }
      });

      $(document).on("click", "#createPswdEmail", function() {
        EmailUserName = $("#EmailUserName").val();
        Email_newPswd = $("#Email_newPswd").val();
        Email_cfrmPswd = $("#Email_cfrmPswd").val();
        email_ver = emailVerified();

        if (Email_newPswd == "") {
          swicon = "warning";
          msg = "Please Enter New Password";
          srbSweetAlret(msg, swicon);

        } else if (Email_cfrmPswd == "") {
          swicon = "warning";
          msg = "Please Enter Confirm Password";
          srbSweetAlret(msg, swicon);

        } else if (email_ver !== "1" && email_ver == "0") {
          swicon = "warning";
          msg = "Please Verify Email Id";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/password.php",
            data: {
              EmailUserName: EmailUserName,
              Email_newPswd: Email_newPswd,
              Email_cfrmPswd: Email_cfrmPswd,
              type: 'pswdUpdateEmail'
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
                location.href = "login.php";
              } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                $("#mob_newPswd").val('');
                $("#mob_cfrmPswd").val('');
              }

            }
          });
        }
      });

      // for vendor forget password

      $(document).on("click", "#vfp_mob_btn", function() {
        vfp_c_code = $("#vfp_c_code").val();
        vfp_mob_num = $("#vfp_mob_num").val();

        if (vfp_c_code == "") {

          swicon = "warning";
          msg = "Please Select Country Code";
          srbSweetAlret(msg, swicon);

        } else if (vfp_mob_num == "") {

          swicon = "warning";
          msg = "Please Enter Mobile Number";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/otp.php",
            data: {
              vfp_c_code: vfp_c_code,
              vfp_mob_num: vfp_mob_num,
              type: 'VfrgtPassOtp',
              usertype: 'vendor'
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
                $("#vfp_verifyOtpMob").removeAttr('disabled');
                $("#vfp_verifyOtpMob").focus();
                $("#vfp_mob_btn").text('Verify Otp');
                $("#vfp_mob_btn").attr('id', 'vfp_mob_ver_btn');
                $("#vMobiSendOtpSec").html('<p class="resendotp vresendotp"> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>');

                var timeleft = 30;
                var downloadTimer = setInterval(function() {
                  timeleft--;
                  document.getElementById("countdowntimer").textContent = timeleft;
                  if (timeleft <= 0) {
                    clearInterval(downloadTimer);
                    $(".vresendotp").html("<a href='javascript:void(0);' id='vfp_mob_btn'>Resend otp</a>");
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

      $(document).on("click", "#vfp_mob_ver_btn", function() {
        vfp_verifyOtpMob = $("#vfp_verifyOtpMob").val();
        vfp_c_code = $("#vfp_c_code").val();
        vfp_mob_num = $("#vfp_mob_num").val();

        if (vfp_verifyOtpMob == "") {
          swicon = "warning";
          msg = "Please Enter Verification Code";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/otp.php",
            data: {
              vfp_c_code: vfp_c_code,
              vfp_verifyOtpMob: vfp_verifyOtpMob,
              vfp_mob_num: vfp_mob_num,
              type: 'vFp_MobileOtpVer',
              usertype: 'vendor'
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
                $("#vfb_mob_num").attr('disabled', 'disabled');
                $("#vfb_c_code").attr('disabled', 'disabled');
                $("#vforgotPassForm-mob").hide();
                $("#vCreatePassForm-mob").show();
                $("#vMobUserName").val(data.userName);
              } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                $("#vfb_mob_num").val('');
                $("#vfb_c_code").select2();
              }

            }
          });
        }
      });
      $(document).on("click", "#vcreatePswdMob", function() {
        vMobUserName = $("#vMobUserName").val();
        vmob_newPswd = $("#vmob_newPswd").val();
        vmob_cfrmPswd = $("#vmob_cfrmPswd").val();
        mobile_ver = mobileVerified();

        if (vmob_newPswd == "") {
          swicon = "warning";
          msg = "Please Enter New Password";
          srbSweetAlret(msg, swicon);

        } else if (vmob_cfrmPswd == "") {
          swicon = "warning";
          msg = "Please Enter Confirm Password";
          srbSweetAlret(msg, swicon);

        } else if (mobile_ver !== "1" && mobile_ver == "0") {
          swicon = "warning";
          msg = "Please Verify Mobile";
          srbSweetAlret(msg, swicon);

        } else {
          $.ajax({
            type: "POST",
            url: "ajax/password.php",
            data: {
              vMobUserName: vMobUserName,
              vmob_newPswd: vmob_newPswd,
              vmob_cfrmPswd: vmob_cfrmPswd,
              type: 'VpswdUpdateMob'
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
                location.href = data.url;
              } else {
                swicon = "warning";
                msg = data.message;
                srbSweetAlret(msg, swicon);
                $("#mob_newPswd").val('');
                $("#mob_cfrmPswd").val('');
              }

            }
          });
        }
      });
    })
  </script>

</body>

</html>