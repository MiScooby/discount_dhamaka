<?php include('includes/header.php');
 
if (!authChecker('admin', ['add_user'])) { noAccessPage(); }

?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<style>
    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 4px;
    }

    .form-control,
    .select2-container--default .select2-search--dropdown .select2-search__field,
    .typeahead.tt-hint,
    .typeahead.tt-input {
        display: block;
        width: 100%;
        height: 45px;
        padding: 0.469rem 0.8rem;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #000;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e9ecef;
        appearance: none;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .pass2,
    .pass2 {
        position: relative;
    }

    .toggle-password,
    .toggle-password1 {
        position: absolute;
        right: 15px;
        top: 45px;
        font-size: 14px;
        color: #757575;
        cursor: pointer;
    }

    .myrwdiv {
        display: flex;
    }

    .checkUser {
        font-size: 14px;
        background: #bcefe0;
        border: 1px solid #bcefe0;
        color: #292929;
        height: 45px;
        width: 100%;
        font-weight: 600;
        border-radius: 0.25rem;
        line-height: 1.4;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .veribtn {
        margin-top: 28px;
    }

    .veribtn button.myotpbtn {
        font-size: 14px;
        background: #bcefe0;
        border: 1px solid #bcefe0;
        color: #292929;
        height: 45px;
        width: 100%;
        font-weight: 600;
        border-radius: 0.25rem;
    }

    .resendotp {
        font-size: 12px;
        text-align: right;
        font-weight: 600;
        color: #208cc3;
    }

    div#ErrMsg {
        font-size: 10px;
        font-weight: 500;
        color: red;
    }
</style>


<div class="row justify-content-center">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title text-center">Add User</h6>
                <hr>
                <form class="forms-sample" id="addCatForm" enctype="multipart/form-data">
                    <div class='loading'></div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Country Code</label>
                            <select disabled class="c_code form-select" id="c_code" name="parentCat" data-width="100%">
                                <option></option>
                                <?php
                                $getCountryQ = mysqli_query($con, "SELECT * FROM `country` WHERE `name`='India' ");
                                while ($getCountry = mysqli_fetch_array($getCountryQ)) {
                                ?>
                                    <option value="<?= $getCountry['phonecode'] ?>" selected><?= $getCountry['nicename'] . " " . $getCountry['phonecode'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="mob_num" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="mob_num" name="mob_num" required placeholder="Enter Mobile Number" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')">
                        </div>
                    </div>
                    <div class="row" id="otpVerSecmob">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="verifyOtpMob" class="form-label fw-500">Verify OTP</label>
                                <div class="myrwdiv">
                                    <input type="text" class="form-control " id="verifyOtpMob" required="" placeholder="Verify OTP" disabled>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3 veribtn">
                                <button type="button" id="sendMobotp" class="myotpbtn">Send Verification Code</button>
                                <div id="MobiSendOtpSec">
                                    <p class="resendotp"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none;" id="signUpfiledMob">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">

                                    <label for="mob_userName" class="form-label fw-500">User Name</label>
                                    <div class="myrwdiv">

                                        <input type="text" class="form-control " id="mob_userName" required="" placeholder="Enter First Name">


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mob_firstName" class="form-label fw-500">First Name</label>
                                    <input type="text" class="form-control " id="mob_firstName" required="" placeholder="Enter First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mob_lastName" class="form-label fw-500">Last Name</label>
                                    <input type="text" class="form-control " id="mob_lastName" required="" placeholder="Enter Last Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 pass2">
                                    <label for="mob_Password" class="form-label fw-500">Password</label>
                                    <input type="password" class="form-control " id="mob_Password" required="" placeholder="Enter Password">
                                    <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mob_confirmPassword" class="form-label fw-500">Confirm Password</label>
                                    <input type="password" class="form-control " id="mob_confirmPassword" required="" placeholder="Enter Password">
                                </div>
                            </div>
                            <div id="ErrMsg" style="display: none;"></div>
                        </div>


                        <div class="form-check my-4">
                            <input id="agree_term" name="agree_term" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="agree_term">I agree to the <a href="../terms-condition.php">Terms & Conditions</a> and <a href="../privacy-policy.php">Privacy Policy</a>.</label>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="button" class="btn btn-primary me-2 w-50" id="signUpwithmobileBtn">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>


<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>

<script>
    $("#mob_Password").on("keyup", function(e) {
        $(this).prop('type', 'password');
        var value = $(this).val();
        $("#ErrMsg").hide();
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
        } else {
            $("#ErrMsg").hide();
        }
    });

    $("#signUpwithmobileBtn").hide();
    $(function() {
        'use strict'

        if ($("#c_code").length) {
            $("#c_code").select2({
                placeholder: "Select Country Code"
            });
        }

    });
    $(document).on("click", ".toggle-password", function() {
        if ($(".pass2").find("input").attr("type") == "password") {
            $(".pass2").find("input").attr("type", "text");
            $(this).addClass("fa-eye");
            $(this).removeClass("fa-eye-slash");
        } else {
            $(".pass2").find("input").attr("type", "password");
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
        }
    });
</script>

<script>
    $(document).on("click", "#sendMobotp", function() {
        c_code = $("#c_code").val();
        mobNum = $("#mob_num").val();
        if (c_code == "") {
            swicon = "warning";
            msg = "please Select Country Code";
            srbSweetAlret(msg, swicon);

        } else if (mobNum == "") {
            swicon = "warning";
            msg = "please Enter Mobile Num";
            srbSweetAlret(msg, swicon);


        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/otp.php",
                data: {
                    c_code: c_code,
                    mobNum: mobNum,
                    type: 'MobileOtp',
                    usertype: 'user'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        $("#verifyOtpMob").removeAttr('disabled');
                        $("#mob_num").attr('disabled', 'disabled');
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
                url: "../ajax/otp.php",
                data: {
                    c_code: c_code,
                    verifyOtpMob: verifyOtpMob,
                    mobNum: mobNum,
                    type: 'MobileOtpVer',
                    usertype: 'user'
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
                        $("#signUpwithmobileBtn").show();
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

    function mobileVerified() {

        let mobileVerified;
        $.ajax({
            url: "../ajax/otp.php",
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

        } else if (mobile_ver != "1" && mobile_ver == "0") {

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
            msg = "Enter Confirm Password";
            srbSweetAlret(msg, swicon);

        } else if ($agree_term == false) {

            swicon = "warning";
            msg = "Please Agree Terms & Conditions";
            srbSweetAlret(msg, swicon);

        } else {
            $.ajax({
                url: "../ajax/registration.php",
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
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        location.href = "users.php";
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