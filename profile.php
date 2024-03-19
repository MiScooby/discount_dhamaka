<?php
include('includes/header.php');
// print_r($_SESSION);
// die;
// include('fb-query.php');

include('google-config.php');
include('google-query.php');



if (!isset($_SESSION['LoggedInUser']) && $_SESSION['LoggedInUser'] == '') {
    header('location:login.php');
}else{
$userBySession = $_SESSION['LoggedInUser'];
$getUser_det = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name`='$userBySession' AND `status`='Active' ");
$UseR = mysqli_fetch_array($getUser_det);
}
// print_r($_SESSION);

?>
<link rel="stylesheet" href="assets/css/profile.css">
<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .clickme {
        background: #ffb53a;
        color: #fff;
        padding: 5px;
        border-radius: 5px;

        cursor: pointer;
    }

    .hide {
        display: none;
        transition: none !important;
    }

    .show {
        display: table-row;
    }

    .myurlinp input {
        width: 70px;
        font-size: 14px;
        padding: 0;
        height: 25px;
        text-align: center;
        border: none;
    }

    @media (max-width: 600px) {
        .modal-width-res {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 0%;
            height: auto;
            right: 0;
            width: 95%;
            margin: 0px 10px 0 !important;
        }

        .mobilemdldiv {
            padding: 20px 10px 10px !important;
        }

    }
</style>

<!-- User profile section -->
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p profilepg">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                <div class="ec-sidebar-wrap">
                    <!-- Sidebar Category Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-vendor-block">
                            <div class="ec-vendor-block-detail">
                                <img class="v-img" src="assets/images/user/1.png" alt="vendor image">
                                <h5>
                                    <?= $UseR['first_name'] . " " . $UseR['last_name'] ?>
                                </h5>
                            </div>
                            <div class="ec-vendor-block-items">
                                <ul>
                                    <li><a href="javascript:void(0);" class="tab-link active"
                                            data-tabc=".dash-prf-tab"><i class="fa fa-user"></i> My Profile</a></li>
                                    <li><a href="javascript:void(0);" class="tab-link" data-tabc=".edit-prf-tab"><i
                                                class="fa fa-tag"></i> Total No. Deals</a></li>
                                    <li><a href="javascript:void(0);" onclick="logout()" class="logouttb"><i class="fa fa-sign-out "></i> Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">

                    <div class="coupon-dstab active dash-prf-tab">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ec-vendor-block-profile">
                                        <div id="edit_modal">
                                            <div class="ec-vendor-block-img space-bottom-30">
                                                <div class="ec-vendor-block-bg cover-upload">
                                                    <div class="thumb-upload">
                                                        <div class="thumb-preview ec-preview">
                                                            <div class="image-thumb-preview">
                                                                <img class="image-thumb-preview ec-image-preview v-img"
                                                                    src="assets/images/banner/8.jpg" alt="edit" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ec-vendor-block-detail">
                                                    <div class="thumb-upload">

                                                        <div class="thumb-preview ec-preview">
                                                            <div class="image-thumb-preview">
                                                                <img class="image-thumb-preview ec-image-preview v-img"
                                                                    src="assets/images/user/1.png" alt="edit" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mymsg">
                                                            <div class="alert-success">
                                                                <?php
                                                                $checkDealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `deals_order` WHERE `user_id`='$userBySession' "));
                                                                ?>
                                                                <p>Hi, <span>
                                                                        <?= $UseR['first_name'] ?>
                                                                    </span>, you have total no. of <strong>
                                                                        <?= $checkDealCount ?>
                                                                    </strong> deals</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ec-vendor-upload-detail">
                                                    <form class="row g-3">
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">User Name<span
                                                                    class="rqrd">*</span></label>
                                                            <input type="text" class="form-control" id="UserName"
                                                                value="<?= $UseR['user_name'] ?>" readonly>
                                                            <span class="frmicon"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">First Name<span
                                                                    class="rqrd">*</span></label>
                                                            <input type="text" class="form-control" id="FirstName"
                                                                value="<?= $UseR['first_name'] ?>">
                                                            <span class="frmicon"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Last Name<span
                                                                    class="rqrd">*</span></label>
                                                            <input type="text" class="form-control" id="LastName"
                                                                value="<?= $UseR['last_name'] ?>">
                                                            <span class="frmicon"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Email-Id
                                                                <?php if ($UseR['email_id'] == null) { ?><a
                                                                    href="javascript:void(0);"
                                                                    class="plsvrfy emailv_click"
                                                                    data-link-action="quickview" data-bs-toggle="modal"
                                                                    data-bs-target="#email_verified_modal">Verify
                                                                    Email-Id</a>
                                                                <?php }  ?>
                                                            </label>
                                                            <input disabled type="email" class="form-control"
                                                                <?=($UseR['email_id'] !==null) ? 'value="' .
                                                                $UseR['email_id'] . '"'
                                                                : 'placeholder="Please Verify Email Id"' ; ?>>
                                                            <span class="frmicon env"><i
                                                                    class="fa fa-envelope"></i></span>
                                                        </div>

                                                        <div class="col-md-2 space-t-15 myslct">
                                                            <label class="form-label" for="countrycode">Country
                                                                Code</label>
                                                            <select name="countryCode"
                                                                class="form-control cntrycode bg-light border-light countrycodeslc2"
                                                                id="cntry_code" disabled>
                                                                <option
                                                                    value="<?php if ($UseR['c_code'] !== null) { ?><?= $UseR['c_code'] ?><?php } else {
                                                                                                                                            } ?>">
                                                                    <?php if ($UseR['c_code'] !== null) { ?>
                                                                    <?= $UseR['c_code'] ?>
                                                                    <?php } else {
                                                                                                                                                                                                                echo "Select Code";
                                                                                                                                                                                                            } ?>
                                                                </option>

                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Mobile
                                                                <?php if ($UseR['mobile_num'] == null) { ?><a
                                                                    href="javascript:void(0);"
                                                                    class="plsvrfy mobilev_click"
                                                                    data-link-action="quickview" data-bs-toggle="modal"
                                                                    data-bs-target="#mobile_verified_modal">Verify
                                                                    Mobile Number.</a>
                                                                <?php }  ?>
                                                            </label>

                                                            <input type="text" class="form-control"<?php if($UseR['mobile_num'] !==null) {?>value="<?= $UseR['mobile_num'] ?>"
                                                            <?php }?> placeholder="Enter Mobile Number"
                                                            id="userMob_mu" disabled>
                                                            <span class="frmicon env"><i
                                                                    class="fa fa-phone"></i></span>
                                                        </div>

                                                        <div class="col-md-12 space-t-15">
                                                            <button type="button" id="saveProfileBtn"
                                                                class="btn btn-primary">Save Profile</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="coupon-dstab edit-prf-tab">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="topheaddiv">
                                        <h5>Your Total Number of Deals List -</h5>
                                    </div>

                                    <div class="tableDiv table-responsive">

                                        <!-- <div class="searchdiv">
                                            <form action="javascript:void(0);" method="POST">
                                                <div class="form-group">
                                                    <input type="text" class="form-control srchinput" placeholder="Search Orders Here...">
                                                    <span class="srch_icon"><i class="fa fa-search"></i></span>
                                                </div>
                                            </form>
                                        </div> -->

                                        <table id="dtBasicExample" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th colspan="3">Order Number</th>
                                                    <th>Order Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = "1";
                                                $getOrderDet = mysqli_query($con, "SELECT od.*, d.vendor_id, d.offer_title,d.offer_end_date,d.offer_end_time, c.cat_name, vb.store_name, vb.store_location FROM deals_order od, offer_deals d, vendor_brand vb, category c WHERE od.deal_id=d.id AND d.vendor_id=vb.vendor_id AND c.id=d.offer_cat AND `user_id`='$userBySession' ORDER BY `od`.`id` DESC");
                                            
                                                while ($getOrder = mysqli_fetch_array($getOrderDet)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?= $i++ ?>
                                                    </td>
                                                    <td colspan="3"><span class="order_id">
                                                            <?= $getOrder['order_token'] ?>
                                                        </span></td>
                                                    <td>
                                                        <span class="order_date">
                                                            <?= $getOrder['date_time'] ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0);">
                                                            <button type="button" class="btn btn-primary viewodrdtl"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#<?= $getOrder['order_token'] ?>"
                                                                aria-expanded="false"
                                                                aria-controls="collapseExample1">View Order</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr id="<?= $getOrder['order_token'] ?>" class="hide">

                                                    <th>Deal Category</th>
                                                    <th>Deal Name</th>
                                                    <th>Deal Expire Date</th>
                                                    <th>Vendor Name</th>
                                                    <th>Deal code</th>
                                                    <th>Deal Grab Date</th>
                                                </tr>
                                                <tr id="<?= $getOrder['order_token'] ?>" class="hide">

                                                    <td>
                                                        <?= $getOrder['cat_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $getOrder['offer_title'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $getOrder['offer_end_date'] . ' ' . $getOrder['offer_end_time'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $getOrder['store_name'] ?>
                                                    </td>
                                                    <td>
                                                        <div class="myurlinp"
                                                            data-id="myinpval<?= $getOrder['coupon_code'] ?>">
                                                            <input type="url"
                                                                id="myinpval<?= $getOrder['coupon_code'] ?>"
                                                                value="<?= $getOrder['coupon_code'] ?>" name="url"
                                                                class="myurlinp">
                                                            <i class="fa fa-copy clickme" title="Copy Url"></i>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <?= $getOrder['date_time'] ?>
                                                    </td>

                                                </tr>


                                                <?php
                                                }
                                                ?>


                                            </tbody>
                                        </table>
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
<!-- End User profile section -->

<!-- email-verified popup -->
<div class="modal fade" id="email_verified_modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div id="ec-popnews-box-content1" class="myemailfrm emailmdldiv">
                            <h2>Verify Your Email-Id</h2>
                            <form id="ec-popnews-form" action="#" method="post">
                                <input type="hidden" value="<?= $userBySession; ?>" id="userid">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="emailAddress" class="form-label fw-500">Email Address</label>
                                            <div class="myrwdiv">
                                                <input type="email" class="form-control bg-light border-light"
                                                    id="emailAddress" required="" placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row justify-content-center" id="otpVerSec">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="verifyOtp" class="form-label fw-500">Verify OTP</label>
                                            <div class="myrwdiv">
                                                <input type="text" class="form-control bg-light border-light"
                                                    id="verifyOtp" required="" maxlength="4" disabled
                                                    placeholder="Verify OTP">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3 veribtn">
                                            <button type="button" id="sendEmailotp" class="myotpbtn">Send Verification
                                                OTP</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- mobile-verified popup -->
<div class="modal fade " id="mobile_verified_modal" role="dialog" data-focus="false" style="overflow:hidden;">
    <div class="modal-dialog modal-dialog-centered w-100 h-100" role="document">
        <div class="modal-content modal-width-res" >
            <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div id="ec-popnews-box-content1" class="mobilemdldiv emailmdldiv">
                            <h2>Verify Mobile Number</h2>
                            <form id="ec-popnews-form" action="#" method="post">
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="countryCode" class="form-label fw-500">Country Code</label>
                                            <select name="countryCode"
                                                class="form-control bg-light border-light countrycodeslc2" id="c_code"
                                                disabled>
                                                <option></option>
                                                <option value="91" selected>India 91</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3">
                                            <label for="mob_num" class="form-label fw-500">Mobile Number</label>
                                            <div class="myrwdiv">
                                                <input type="text" class="form-control bg-light border-light"
                                                    id="mob_num" required="" placeholder="Enter Mobile Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center" id="otpVerSecmob">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="verifyOtpMob" class="form-label fw-500">Verify OTP</label>
                                            <div class="myrwdiv">
                                                <input type="text" class="form-control bg-light border-light"
                                                    id="verifyOtpMob" required="" disabled placeholder="Verify OTP">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3 veribtn">
                                            <button type="button" id="sendMobotp" class="myotpbtn">Send Verification
                                                OTP</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>

<script src="assets/select2/select2.min.js"></script>
<script src="assets/sweetalert2/sweetalert2.min.js"></script>
<script>

    $(document).ready(function () {
        $(document).on("click", ".clickme", function () {

            var myinputid = $(this).parent().attr("data-id");

            //call function to copy text
            myFunction(myinputid);

        });
    });

    function myFunction(elem) {

        /* Get the text field */
        var copyText = document.getElementById(elem);

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999);

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);

    }
</script>
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

<script>
    $(document).ready(function () {

        $("#c_code").select2();
        $(".countrycodeslc2").select2();

        // email verifiction js
        $(document).on("click", "#sendEmailotp", function () {
            emailAddress = $("#emailAddress").val();
            if (emailAddress == "") {
                swicon = "warning";
                msg = "Enter Email id";
                srbSweetAlret(msg, swicon);
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/profile_otp.php",
                    data: {
                        emailAddress: emailAddress,
                        type: 'EmailOtp',
                        usertype: 'user'
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status) {

                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $("#verifyOtp").removeAttr('disabled');
                            $("#sendEmailotp").text('Verify Otp');
                            $("#sendEmailotp").attr('id', 'verifyEmailOtp');
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
        $(document).on("click", "#verifyEmailOtp", function () {
            emailAddress = $("#emailAddress").val();
            emailOtp = $("#verifyOtp").val();
            userid = $("#userid").val();

            if (emailOtp == "") {
                swicon = "warning";
                msg = "Please Enter Verification Code";
                srbSweetAlret(msg, swicon);
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/profile_otp.php",
                    data: {
                        emailAddress: emailAddress,
                        emailOtp: emailOtp,
                        userid: userid,
                        type: 'verEmailOtp',
                        usertype: 'user'
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            window.setTimeout(function () {
                                window.location = 'profile.php';
                            }, 3000);
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


        // mobile verification js

        $(document).on("click", "#sendMobotp", function () {
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
                    url: "ajax/profile_otp.php",
                    data: {
                        c_code: c_code,
                        mobNum: mobNum,
                        type: 'MobileOtp',
                        usertype: 'user'
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $("#verifyOtpMob").removeAttr('disabled');
                            $("#sendMobotp").text('Verify Otp');
                            $("#sendMobotp").attr('id', 'verifyMobOtp');
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

        $(document).on("click", "#verifyMobOtp", function () {
            verifyOtpMob = $("#verifyOtpMob").val();
            mobNum = $("#mob_num").val();
            c_code = $("#c_code").val();

            userid = $("#userid").val();

            if (verifyOtpMob == "") {
                swicon = "warning";
                msg = "Please Enter Verification Code";
                srbSweetAlret(msg, swicon);

            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/profile_otp.php",
                    data: {
                        c_code: c_code,
                        verifyOtpMob: verifyOtpMob,
                        mobNum: mobNum,
                        userid: userid,
                        type: 'MobileOtpVer',
                        usertype: 'user'
                    },
                    success: function (data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $("#mob_num").attr('disabled', 'disabled');
                            $("#c_code").attr('disabled', 'disabled');
                            window.setTimeout(function () {
                                window.location = 'profile.php';
                            }, 3000);
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
    });



    $(document).ready(function () {
        $(document).on("click", ".tab-link", function () {
            $(".tab-link").removeClass("active");
            $(this).addClass("active");

            var mytabcls = $(this).attr("data-tabc");

            $(".coupon-dstab").removeClass("active");
            $(mytabcls).addClass("active");

        });


        // toggle password 
        $(document).on("click", ".toggle-password", function () {
            if ($(".pass1").find("input").attr("type") == "password") {
                $(".pass1").find("input").attr("type", "text");
                $(this).addClass("fa-eye");
                $(this).removeClass("fa-eye-slash");
            } else {
                $(".pass1").find("input").attr("type", "password");
                $(this).removeClass("fa-eye");
                $(this).addClass("fa-eye-slash");
            }
        });

        $(document).on("click", ".toggle-password", function () {
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
    });

    $(document).on("click", "#saveProfileBtn", function () {
        var UserName = $("#UserName").val();
        var FirstName = $("#FirstName").val();
        var LastName = $("#LastName").val();
        var cntry_code = $("#cntry_code").val();
        var userMob_mu = $("#userMob_mu").val();
        $.ajax({
            type: "POST",
            url: "ajax/profile.php",
            data: {
                UserName: UserName,
                FirstName: FirstName,
                LastName: LastName,
                cntry_code: cntry_code,
                userMob_mu: userMob_mu,
                type: 'editUserProfile'
            },
            success: function (data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function () {
                        window.location = 'profile.php';
                    }, 2000);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#verifyOtp").val('');
                }

            }
        });
    })
</script>