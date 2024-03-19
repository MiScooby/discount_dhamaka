<?php

include('admin/ajax/config.php');

if (isset($_GET['byApp'])) {
    ob_start();
    session_start();
    $_SESSION['LoggedInMobile'] = 'yes';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Dhamaka - Vendor Registration</title>

    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">

    <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bus-style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bus-responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bus-animation.css">
    <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
    <style>
        .select2-container {
            box-sizing: border-box;
            display: inherit;
            margin: 0;
            position: relative;
            vertical-align: middle;
        }

        .sidebar .bg-primary {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background-color: #20c997 !important;
            z-index: 9;
            opacity: 0.9;
        }

        .err_msg {
            color: red;
            font-size: 12px;
            font-weight: 500;
        }

        .err_bdr {
            border-color: red !important;
        }

        .dinoen {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .dinoen {
                display: block !important;
                margin-bottom: 30px;
            }

            .srb-mt-form {
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>

    <section class="registration-form">
        <div class="row">
            <!-- sidebar -->

            <div id="sidbar" class="col-md-4 sidebar">
                <div class="hero-bg hero-bg-scroll" style="background-image:url('assets/lgn-reg-assets/images/login-bg-1.jpg');"></div>
                <div class="sidebar-inner" style="z-index: 99;">

                    <div class="container">
                        <div class="wrapper">
                            <div class="bus_logo">
                                <a href="index.php">
                                    <img src="assets/images/logo/logo-8.png" alt="Discount Dhamaka">
                                </a>
                            </div>
                            <!-- sidebar-content -->
                            <div class="sidebar-content">
                                <div class="sidebar-text">
                                    <h2>
                                        List Your Business Online With Discount Dhamaka
                                    </h2>

                                </div>

                                <!-- contact-info -->
                                <div class="contact-info">

                                    <div class="contact-info-inner">
                                        <div class="contact-icon">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div class="contact-details">
                                            <p>Contact via email</p>
                                            <h6><a href="mailto:support@discountdhamaka.com" style="color: #fff !important; text-decoration: none;">support@discountdhamaka.com</a></h6>
                                        </div>
                                    </div>

                                    <!-- sidebar button -->
                                    <a href="index.php"><button><i class="fa fa-arrow-left"></i> Back Home</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>



            <!-- registration form -->
            <div id="reg-form" class="col-md-8 pop registration-form-inner h-100" style="position: relative;">

                <div id="loader" style="display: none;">
                    <div class="lds-dual-ring">
                        <div class="overlay">
                        </div>
                    </div>
                </div>

                <div class="registration-inner" id="registration-form">

                    <div class="container">
                        <div class="wrapper">

                            <div class="mytopdiv">

                                <div class="row dinoen">
                                    <img src="assets/images/logo/logo-8.png" alt="">
                                </div>
                                <div class="row g-0">
                                    <div class="col-12 col-md-12 col-lg-2 col-xl-12">
                                        <h3 class="fw-600">Vendor Registration With Discount Dhamaka</h3>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center my-3">
                                    <span class="mx-3 text-2 text-muted" style="margin-left:0 !important;">Register with Mobile</span>
                                    <hr class="flex-grow-1">
                                </div>
                            </div>


                            <!-- seller registration form -->
                            <form action="javascript:void(0);" id="vendor_Form" method="POST" enctype="multipart/form-data" class="form-inner srb-mt-form">
                                <div class="end_border animation-delay-25ms">
                                    <div class="row">
                                        <div class="tab-100 col-md-4">
                                            <label for="countryCode" class="form-label fw-500">Country Code <span class="req">*</span> </label>
                                            <select name="countryCode" disabled class="form-control bg-light border-light countrycodeslc2" id="vC_code">
                                                <option></option>
                                                <?php
                                                $getCountryQ = mysqli_query($con, "SELECT * FROM `country` WHERE `id`='99'");
                                                while ($getCountry = mysqli_fetch_array($getCountryQ)) {
                                                ?>
                                                    <option selected value="<?= $getCountry['phonecode'] ?>"><?= $getCountry['nicename'] . " " . $getCountry['phonecode'] ?></option>
                                                <?php
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="tab-100 col-md-8">
                                            <div id="focus">
                                                <label> Mobile Number <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')" name="phone" id="vMob_num" placeholder="Mobile Number">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row" id="otpSec">
                                        <div class="tab-100 col-md-6">
                                            <div id="target1">
                                                <label>Verification Code <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" name="code" id="vOtpCode" disabled placeholder="Enter OTP">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-100 col-md-6">
                                            <div class="mb-3 veribtn">
                                                <button type="button" id="sendOtpVendor" class="myotpbtn">Send Verification OTP</button>
                                                <div id="MobiSendOtpSec"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="bussinessDetails" style="display: none  ;">
                                        <div class="py-3 col-md-12">
                                            <label class="labelHeadingSrb">Enter Vendor Personal Details :</label>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label> First Name <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="vF_name" name="first-name" placeholder=" First Name">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label> Last Name <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="vL_name" name="last-name" placeholder=" Last Name">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label> User Name <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="vUser_name" name="user name" placeholder="User Name">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label>Email Address <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="vEmail_id" name="email" placeholder="admin@example.com">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label>Password <span class="req">*</span></label>
                                                <div class="input-field pass1">
                                                    <input id="vNewPass" type="password" name="password">
                                                    <span></span>
                                                    <i toggle="#vNewPass" class="toggle-icon fa fa-eye-slash fa-eye field-icon toggle-password"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label>Confirm Password <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input id="vRePass" type="password" name="re-pass">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ErrMsg" style="display: none;"></div>
                                        <div class="py-3 col-md-12">
                                            <label class="labelHeadingSrb">Enter Vendor Business Details :</label>
                                        </div>
                                        <div class="tab-100 col-md-6 ">
                                            <div>
                                                <label>Business Type <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <select class="form-control " id="vBusType">
                                                        <option></option>
                                                        <option value="Single brand">Single brand</option>
                                                        <option value="Multi brand">Multi brand</option>
                                                    </select>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6 ">
                                            <div>
                                                <label>Select Category <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <select class="form-control " id="vBusCat">
                                                        <option></option>
                                                        <?php
                                                        $CateListQ = mysqli_query($con, "SELECT * FROM `category` WHERE `status`='Active'");

                                                        while ($getCateList = mysqli_fetch_array($CateListQ)) {
                                                        ?>
                                                            <option value="<?= $getCateList['id'] ?>"><?= $getCateList['cat_name'] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label> Merchant Business Name <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="vBusName" name="last-name" placeholder="Merchant Business Name">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label> GST No.</label>
                                                <div class="input-field">
                                                    <input type="text" maxlength="15" id="vGstNum" name="gstnumber" placeholder="GST No.">
                                                    <span></span>
                                                </div>
                                                <div id="ErrMsg1" style="display: none;"></div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-4">
                                            <div>
                                                <label> Contact Person Name <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="vCPname" name="last-name" placeholder=" Contact Person Name">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-100 col-md-8">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <div>
                                                        <label> Country Code <span class="req">*</span></label>
                                                        <div class="input-field">
                                                            <select disabled class="changeme form-control" id="vCp_cCode">
                                                                <option></option>
                                                                <?php
                                                                $getCountryQ = mysqli_query($con, "SELECT * FROM `country` WHERE `id`='99'");
                                                                while ($getCountry = mysqli_fetch_array($getCountryQ)) {
                                                                ?>
                                                                    <option selected value="<?= $getCountry['phonecode'] ?>"><?= $getCountry['nicename'] . " " . $getCountry['phonecode'] ?></option>
                                                                <?php
                                                                } ?>
                                                            </select>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-7">
                                                    <div>
                                                        <label> Contact Person Phone Number <span class="req">*</span></label>
                                                        <div class="input-field">
                                                            <input type="text" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')" id="vCPmobile" name="phone" placeholder="Person Number">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label>Contact Person Email <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="email" id="vCPemail" name="email" placeholder="admin@example.com">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label>Landline No.</label>
                                                <div class="input-field">
                                                    <input type="number" id="vLandlineNum" name="landlineno." placeholder="Landline No.">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="ErrMsg1" style="display: none;"></div>
                                        <div class="py-3 col-md-12">
                                            <label class="labelHeadingSrb">Enter Vendor Business Address :</label>
                                        </div>


                                        <div class="tab-100 col-md-12">
                                            <div id="locationField">
                                                <label>Address 1 <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="vAdd1" name="address" placeholder="Address 1">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-12">
                                            <div>
                                                <label> Address 2 <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="route" name="address" placeholder="Address 2">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-12">
                                            <div>
                                                <label> Locality <span class="req">*</span></label>

                                                <div class="input-field">
                                                    <input type="text" id="sublocality_level_1" name="locality" placeholder="locality">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label> City <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="locality" name="city" placeholder="City">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-6">
                                            <div>
                                                <label> State <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="text" id="administrative_area_level_1" name="state" placeholder="State">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-50 col-md-6">
                                            <div>
                                                <label>Pincode <span class="req">*</span></label>
                                                <div class="input-field">
                                                    <input type="number" id="postal_code" name="zip-code" placeholder="10001">
                                                    <span></span>
                                                    <input type="hidden" id="latInput" placeholder="latatude" />
                                                    <input type="hidden" id="lngInput" placeholder="longitude" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row register-field">
                                            <label>
                                                <div class="label-input">
                                                    <input type="checkbox" id="agree_term" name="checkbox">
                                                </div>
                                                <div class="label-text">
                                                    I/we Confirm that I/we have read and agree to the
                                                    <?php
                                                    if (!isset($_SESSION['LoggedInMobile'])) {
                                                    ?>
                                                        <a href="terms-condition.php?<?= $urltoken . $urltoken ?>&&type=vendor&& <?= $urltoken . $urltoken ?>" target="_blank">Terms & Conditions</a>

                                                        and

                                                        <a href="privacy-policy.php?<?= $urltoken . $urltoken ?>&&type=vendor&& <?= $urltoken . $urltoken ?>" target="_blank">Privacy Policy</a>.
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <a href="javascript:void(0);" data-link-action="quickview" data-bs-toggle="modal" data-bs-target="#termcob">Terms & Conditions</a>



                                                        and

                                                        <a href="javascript:;" data-link-action="quickview" data-bs-toggle="modal" data-bs-target="#privacypol">Privacy Policy</a>.
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </label>
                                            <div class="reg-btn">
                                                <button type="button" id="VendorRegBtn">Register</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>

                <div class="registration-stats" style="display: none;">
                    <div class="stst-content">
                        <img src="assets/images/under-process.png" width="150px" height="150px" alt="">
                        <h3>Thank You For Choosing Discount Dhamaka</h3>
                        <p>Our Excutive Will Connect With You Soon</p>
                        <a href="index.php" class="btn btn-success">Back To Home</a>
                    </div>
                </div>
                <!-- top shape -->
                <div class="shapes-top">
                    <div class="big-shape"></div>
                    <div class="small-shape"></div>
                </div>

                <!-- bottom shape -->
                <div class="shapes-bottom">
                    <div class="small-shape"></div>
                    <div class="big-shape"></div>
                </div>
            </div>
        </div>
    </section>


    <style>
        .terms_condition_page {
            border-top: 1px solid #f1f1f1e6;
        }

        .terms_condition_page .ec-common-wrapper {
            padding: 30px 10px;
            border: 1px solid #ededed7a;
            max-width: 100%;
            border-radius: 15px;
            margin: 0 auto;
            background-color: #f9fffe5c;
        }

        .terms_condition_page .section-title .ec-title {
            font-family: inherit;
            font-weight: 700;
            margin-bottom: 7px;
            color: #eca207;
            letter-spacing: 0;
            position: relative;
            display: inline;
            line-height: 22px;
            letter-spacing: 0.02rem;
            text-transform: capitalize;
        }

        .ec-cms-block .ec-cms-block-title {
            margin-bottom: 5px;
            color: #455263;
            font-size: 16px;
            line-height: 24px;
            font-weight: 600;
            letter-spacing: 0;
            text-align: left;
            /* font-family: "Montserrat"; */
        }

        .terms_condition_page .ec-cms-block p {
            margin-bottom: 29px;
        }

        .ec-cms-block p {
            font-size: 13px;
            color: #777777;
            line-height: 26px;
            font-weight: 400;
            letter-spacing: 0;
            text-align: left;
            margin-bottom: 14px !important;
        }

        .btn-close {
            padding: 10px;
            margin-left: auto;
            margin-top: 10px;
        }

        .terms_condition_page .section-title {
            margin-bottom: 15px;
            margin-top: 20px;
            padding: 0;
            position: relative;
            padding-bottom: 10px;
            border-bottom: none;
        }

        .uldiv p {
            margin-bottom: 10px !important;
        }

        .uldiv ul li {
            line-height: 30px;
            font-size: 13px;
            font-weight: 400;
            color: #777777;
        }

        .terms_condition_page .col-md-12 {
            padding: 0 5px;
        }

        .modal-content {
            position: relative;
            display: flex;
            flex-direction: column;
            width: 100%;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 0.3rem;
            height: 700px;
            outline: 0;
            overflow-y: scroll;
        }
    </style>
    <!-- email-verified popup -->
    <div class="modal fade" id="termcob" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row terms_condition_page">
                        <div class="col-md-12 text-center">
                            <div class="section-title">
                                <h2 class="ec-title">Vendor Terms & Condition</h2>
                                <p class="sub-title mb-3">Welcome to the Discount Dhamaka marketplace</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="ec-common-wrapper">
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Acceptance of Terms </h3>
                                        <p>By using <a href="javascript:void(0);"><strong>https://www.discountdhamaka.in/</strong></a> (the “Website” )or <strong>“DiscountDhamaka”</strong> , the Mobile App, you (“you” or the “User”) unconditionally agree to the terms and conditions, without restriction, that we XXX Software Private Limited” have provided herein for use of this Website or Mobile App. If you do not wish to agree to the outlined terms and conditions (the “Terms of Use” or “Agreement”), please do not use this Website and/or Mobile App</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">General</h3>
                                        <p><strong>“DiscountDhamaka”</strong> provides an interactive online service owned and operated by XXX Software Private Limited through the Website on the World Wide Web of the Internet (the “Web” or “Internet”) and android as well as ios Mobile App consisting of information services, content and transaction capabilities provided by XXX Software Private Limited its subsidiaries and its associates with whom it has business relationships (“Business Associates”) including but not limited to third parties that provide services in relation to creation, production or distribution of content for the Website (“Third Party Content Providers”), third parties that provide advertising services to DiscountDhamaka (“Third Party Advertisers”) and third parties that perform function on behalf of DiscountDhamaka like sending out and distributing our administrative and promotional emails and sms (“Third Party Service Providers”).</p>
                                        <p> By registering or sharing your mobile no. on/with www.discountdhamaka.in,DiscountDhamaka Mobile App & DiscountDhamaka affiliates you explicitly agree to be contacted by our personnel via call/send you SMS’s related to our services, promotional offers, special deals, updates for new services and other items even if the contact number you have entered/shared is on DND (Do not Disturb).</p>
                                        <p> The User by subscribing to the services provided by DiscountDhamaka, unconditionally agrees to be contacted by DiscountDhamaka or any of its merchants, affiliates, associates and / or assigns for regular updates relating to the services, status of their requests, new and / or promotional offers and other information, which DiscountDhamaka in its sole discretion may deem appropriate to send to the User(s) and the same in any manner will not be treated as breach of any privacy or rights of the User(s). Check out privacy policy for opt-out. This Agreement sets forth the terms and conditions that apply to the use of this Website by the User.</p>
                                        <p> The right to use this Website is personal to User and is not transferable to any other person or entity. User shall be responsible for protecting the confidentiality of User’s password(s), if any. User understands and acknowledges that, although the Internet is often a secure environment, sometimes there are interruptions in service or events that are beyond the control of DiscountDhamaka, and DiscountDhamaka shall not be responsible for any data lost while transmitting information on the Internet.</p>
                                        <p>While it is DiscountDhamaka’s objective to make the Website accessible at all times, the Website may be unavailable from time to time for any reason including, without limitation, routine maintenance. You understand and acknowledge that due to circumstances both within and outside of the control of DiscountDhamaka, access to the Website may be interrupted, suspended or terminated from time to time.</p>
                                        <p>DiscountDhamaka reserves the right, in its sole discretion, to terminate the access to any or all DiscountDhamaka websites and the related services or any portion thereof at any time, without notice.</p>
                                        <p>DiscountDhamaka shall have the right at any time to change or discontinue any aspect or feature of the Website, including, but not limited to, content, graphics, deals, offers, settings, hours of availability and equipment needed for access or use. Further, DiscountDhamaka may discontinue disseminating any portion of information or category of information, may change or eliminate any transmission method and may change transmission speeds or other signal characteristics.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Modified Terms</h3>
                                        <p>DiscountDhamaka reserves the right at all times to discontinue or modify any of our Terms of Use and/or our Privacy Policy as we deem necessary or desirable without prior notification to you. Such changes may include, among other things, the adding of certain fees or charges. We suggest to you, therefore, that you re-read this important notice containing our Terms of Use and Privacy Policy from time to time in order that you stay informed as to any such changes. If we make changes to our Terms of Use and Privacy Policy and you continue to use our Website, you are implicitly agreeing to the amended Terms of Use and Privacy Policy. Unless specified otherwise, any such deletions or modifications shall be effective immediately upon DiscountDhamaka’s posting thereof. Any use of the Website by User after such notice shall be deemed to constitute acceptance by User of such modifications.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Equipment</h3>
                                        <p>User shall be responsible for obtaining and maintaining all telephone, computer hardware and other equipment needed for access to and use of this Website and all charges related thereto. DiscountDhamaka shall not be liable for any damages to the User’s equipment resulting from the use of this Website.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Registration</h3>
                                        <p>To utilize certain portions of the Website, you may be required to complete a registration process and establish an account with DiscountDhamaka website and/or Mobile App (“Account”). You represent and warrant that all information provided by you to DsicountDhamaka is current, accurate, and complete, and that you will maintain the accuracy and completeness of this information on a prompt, timely basis.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Password and Security</h3>
                                        <p>As a registered user of the Websiteand/or Mobile App, you may receive or establish a user name and one or more passwords. You are solely responsible for maintaining the confidentiality and security of your password(s) and Account(s). You understand and agree that you are individually and fully responsible for all actions and postings made from your Account(s). Any accounts you create are not transferrable. You agree to notify DiscountDhamaka immediately if you become aware of any unauthorized use of your Account(s).</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">User Conduct</h3>
                                        <p>This Website and any individual websites or merchant-specific, city-specific, or state-specific sites now or hereinafter contained within or otherwise available through external hyperlinks with our Website and/or Mobile App are private property. All interactions on this Website and/or Mobile App must comply with these Terms of Use. User shall not post or transmit through this Website and/or Mobile App any material which violates or infringes in any way upon the rights of others, or any material which is unlawful, threatening, abusive, defamatory, invasive of privacy or publicity rights, vulgar, obscene, profane or otherwise objectionable, which encourages conduct that would constitute a criminal offense, give rise to civil liability or otherwise violate any law, or which, without DiscountDhamaka’s express prior, written approval, contains advertising or any solicitation with respect to products or services. Any conduct by a User that in DiscountDhamaka’s exclusive discretion is in breach of the Terms of Use or which restricts or inhibits any other User from using or enjoying this Website and/or Mobile App is strictly prohibited. User shall not use this Website and/or Mobile App to advertise or perform any commercial, religious, political or non-commercial solicitation, including, but not limited to, the solicitation of users of this Website and/or Mobile App to become users of other online or offline services directly or indirectly competitive or potentially competitive with DiscountDhamaka.</p>
                                        <p>The foregoing provisions of this Section 7 applies equally to and are for the benefit of DiscountDhamaka, its subsidiaries, Business Associates and Third Party Content Providers, and each shall have the right to assert and enforce such provisions directly or on its own behalf.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Purchase and Redemption of ‘DiscountDhamaka’ Deals</h3>
                                        <p><strong>DiscountDhamaka</strong> provides an opportunity to its Users to avail value deals from a number of merchants, with which <strong>DiscountDhamaka</strong> has an association at discounted prices by issue of Deal Code that can be redeemed up to a certain validity period from outlets of the Institutions. In order to purchase <strong>DiscountDhamaka</strong> Deals, the User would be required to create an account on the Website. This is required so we can provide you with easy access to print your orders, view your past purchases and modify your preferences. By placing an order on the Website, you make an offer to us to purchase <strong>DiscountDhamaka</strong> Deals for buying / availing specific products and/or services which you have selected based on <strong>DiscountDhamaka</strong>´s standard terms and conditions, institution-specific restrictions and on these Terms of Use. All <strong>DiscountDhamaka</strong> Deals are promotional Deals and shall be subject to the Standard Terms and Conditions and Specific Terms and Conditions. <strong>DiscountDhamaka</strong> Deals are issued on behalf of the Institutions and only such Institutions, to the exclusion of <strong>DiscountDhamaka</strong>, shall be responsible for any and all injuries, illnesses, damages, charges, expenses, claims, liabilities and costs suffered by or in respect of a customer, caused in whole or in part by the Institutions or which arises out of the goods and/or services provided by the Institutions, as well as for any unclaimed property liability arising from unredeemed <strong>DiscountDhamaka</strong> Deals</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner uldiv">
                                        <h3 class="ec-cms-block-title">Standard Terms and Conditions (for All DiscountDhamaka Deals).</h3>
                                        <p>All Vendors shall be defined as an Institution that offers services as displayed on <strong>DiscountDhamaka</strong> website or Mobile App in its regular business operations, and is making such services available to purchasers of <strong>DiscountDhamaka</strong> Deals. In this respect, the following shall constitute as Standard Terms and Conditions for redeeming <strong>DiscountDhamaka</strong> Deals</p>
                                        <ul>
                                            <li><i class="fa fa-check"></i> shall not be responsible for the quality of services provided by the Vendors, and the same shall be the sole responsibility of the Vendor.</li>
                                            <li><i class="fa fa-check"></i> No refunds shall be granted for DiscountDhamaka Deals.</li>
                                            <li><i class="fa fa-check"></i> Deals are redeemable in their entirety only and may not be redeemed incrementally.</li>
                                            <li><i class="fa fa-check"></i> Deals can be redeemed only after due verification of the customer including, without limitation, matching the unique identification number provided to the customer at the time of purchase of DiscountDhamaka Deals.</li>
                                            <li><i class="fa fa-check"></i> Validity period for redemption of DiscountDhamaka Deals is determined by Vendors, and shall be mentioned on DiscountDhamaka Deals.</li>
                                            <li><i class="fa fa-check"></i> Use of DiscountDhamaka Deals for alcoholic beverages is at the sole discretion of the Restaurant and is further subject to all applicable laws.</li>
                                            <li><i class="fa fa-check"></i> It is at the discretion of the Restaurant to determine whether DiscountDhamaka Deals can be combined with any other Restaurant Deals, third party Deals, Deals, or promotions and the like.</li>
                                            <li><i class="fa fa-check"></i> Deals cannot be used for taxes, tips or prior balances, unless permitted by the Vendor.</li>
                                            <li><i class="fa fa-check"></i> Deals are valid for the specific outlet as specified in the deal of a multi outlet brand unless otherwise stated.</li>
                                            <li><i class="fa fa-check"></i> The issuing of Deals and honouring of deals is at the sole discretion of the Vendor and DiscountDhamaka has no liability towards non honouring of deal however intimation of any such non honoring of deals cases be immediately intimated to DiscountDhamaka customer care for investigation and initiation of appropriate action against the vendor if required .</li>
                                            <li><i class="fa fa-check"></i> Reproduction, sale or trade of DiscountDhamaka Deals is strictly prohibited.</li>
                                            <li><i class="fa fa-check"></i> Any attempted redemption not consistent with these terms &amp; conditions will render the DiscountDhamaka Deal void and invalid.</li>
                                            <li><i class="fa fa-check"></i> The DiscountDhamaka Deal will expire on the date specified on it.</li>
                                            <li><i class="fa fa-check"></i> Limit of Two (2) Deals per vendor per customer is applicable. Only Two Deals per customer per vendor can be used unless otherwise specified by the Institution or DiscountDhamaka.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">User Generated Content</h3>
                                        <p>The Website may allow for you to contribute and add value deals from a number of merchants. DiscountDhamaka reserves the right to include the value deal contributed by you to the Website or discard it, in its sole discretion.</p>
                                        <p>DiscountDhamaka shall not have any obligation to pre-screen or regularly review all contributed content/ value deal. However, DiscountDhamaka has the absolute right (though not the obligation) to remove, without notice, any content / value deal posted.</p>
                                        <p>By posting any content/ value deal, you represent and warrant (a) you have all right, title, and interest to such posted content/ value deal, including but not limited to any consent, authorization, release, clearance or license from any third party (such as, but not limited to, any release related to rights of privacy or publicity) necessary for you to provide, post, upload, input or submit the posted content, or (b) such posted content/ value deal is in the public domain, or (c) your use of such posted content/ value deal constitutes fair use. You further represent and warrant that posting such content/ value deal does not violate or constitute the infringement of any patent, copyright, trademark, trade secret, right of privacy, right of publicity, moral rights, or other intellectual property right recognized by any applicable jurisdiction of any person or entity, or otherwise constitute the breach of any agreement with any other person or entity.</p>
                                        <p>You also agree not to post any of the following types of content to the Website: (a) adult content, pornography, explicit sexual images, or nude images; (b) content containing explicit, vulgar, or obscene language; (c) content promoting hate, abuse or destructive actions; (d) content promoting illegal activities; or primarily political, religious, psychic, or metaphysical content; (e) content promoting pirated software; (f) content intending for phishing or spreading malware; (g) content that is disparaging of any person or entity; (h) content that is in violation of any law or regulation; or (i) any other content that is or could be considered inappropriate, unsuitable or offensive, all as determined by us.</p>
                                        <p>You shall be liable for any claims, damages or other demands arising due to any content/ value deal posted by you in violation of this clause and agree to indemnify DiscountDhamaka for any claims, damages or other demands arising due to any content/ value deal posted by you.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Copyright and Trademarks</h3>
                                        <p>Everything located on or in this Website, including the Mobile App, is the exclusive property of DiscountDhamaka or used with express permission of the copyright and/or trademark owner. Any violation of this policy may result in a copyright, trademark or other intellectual property right infringement that may subject User to civil and / or criminal penalties.</p>
                                        <p>This Website contains copyrighted material, trademarks and other proprietary information, including, but not limited to, text, software, photos, video, graphics, music, sound, and the entire contents of DiscountDhamaka protected by copyright as a collective work under the Indian copyright laws. DiscountDhamaka owns a copyright in the selection, coordination, arrangement and enhancement of such content, as well as in the content original to it.</p>
                                        <p>User may not modify, publish, transmit, participate in the transfer or sale, create derivative works, or in any way exploit any of the content, in whole or in part. User may download / print / save copyrighted material for User’s personal use only. Except as otherwise expressly stated under copyright law, no copying, redistribution, retransmission, publication or commercial exploitation of downloaded material without the express permission of DiscountDhamaka and the copyright owner is permitted. If copying, redistribution or publication of copyrighted material is permitted, no changes in or deletion of author attribution, trademark legend or copyright notice shall be made. User acknowledges that he/she/it does not acquire any ownership rights by downloading copyrighted material. Trademarks that are located within or on the Website or a Web site otherwise owned or operated in conjunction with DiscountDhamaka or the Mobile App shall not be deemed to be in the public domain but rather the exclusive property of DiscountDhamaka, unless such site is under license from the Trademark owner thereof in which case such license is for the exclusive benefit and use of DiscountDhamaka, unless otherwise stated. User shall not upload, post or otherwise make available on this Website or Mobile App any material protected by copyright, trademark or other proprietary right without the express permission of the owner of the copyright, trademark or other proprietary right. DiscountDhamaka does not have any express burden or responsibility to provide User with indications, markings or anything else that may aid User in determining whether the material in question is copyrighted or trademarked. User shall be solely liable for any damage resulting from any infringement of copyrights, trademarks, proprietary rights or any other harm resulting from such a submission. By submitting material to any public area of this Website and/or Mobile App, User warrants that the owner of such material has expressly granted DiscountDhamaka the royalty-free, perpetual, irrevocable and non-exclusive right and license to use, reproduce, modify, adapt, publish, translate and distribute such material (in whole or in part) worldwide and/or to incorporate it in other works in any form, media or technology now known or hereafter developed for the full term of any copyright that may exist in such material. Users also permits any other User to access, view, store or reproduce the material for that User’s personal use. User hereby grants DiscountDhamaka the right to edit, copy, publish and distribute any material made available on this Website and/or Mobile App by User.</p>
                                        <p>The foregoing provisions of Section 13 apply equally to and are for the benefit of DiscountDhamaka, its subsidiaries, Business Associates and Third Party Content Providers and each shall have the right to assert and enforce such provisions directly or on its own behalf.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Disclaimer of Warranty; Limitation of Liability</h3>
                                        <p>User expressly agrees that use of this website and / or mobile app is at user’s sole risk. Neither discountdhamaka, its subsidiaries and business associates nor any of their respective employees, agents and third party content providers warrant that use of the website and/or mobile app will be uninterrupted or error free; nor do they make any warranty as to (i) the results that may be obtained from use of this website and/or mobile app or (ii) the accuracy, reliability or content of any information, service or merchandise provided through this website or the mobile app.</p>
                                        <p>This website and the mobile app are made accessible on an “as is” basis without warranties of any kind, either express or implied, including, but not limited to, warranties of title or implied warranties of merchantability or fitness for a particular purpose, other than those warranties which are implied by and incapable of exclusion, restriction or modification under the laws applicable to this agreement.</p>
                                        <p>This disclaimer of liability applies to any damages or injury caused by any failure of performance, error, omission, interruption, deletion, defect, delay in operation or transmission, computer virus, communication line failure, theft or destruction or unauthorized access to, alteration of, or use of record, whether for breach of contract, tortuous behavior, negligence, or under any other cause of action. User specifically acknowledges that discountdhamaka is not liable for the defamatory, offensive or illegal conduct of other users or third-parties and that the risk of injury from the foregoing rests entirely with user.</p>
                                        <p>In no event shall discountdhamaka, or any person or entity involved in creating, producing or distributing this website and/or mobile app or the contents hereof, including any software, be liable for any damages, including, without limitation, direct, indirect, incidental, special, consequential or punitive damages arising out of the use of or inability to use this website and / or mobile app. User hereby acknowledges that the provisions of this section shall apply to all content on this site and the mobile app.</p>
                                        <p>In addition to the terms set forth above, neither discountdhamaka, nor its subsidiaries and business associates, third party service providers or third party content providers shall be liable regardless of the cause or duration, for any errors, inaccuracies, omissions, or other defects in, or untimeliness or unauthenticity of, the information contained within this website and/or mobile app for any delay or interruption in the transmission thereof to the user, or for any claims or losses arising therefrom or occasioned thereby. None of the foregoing parties shall be liable for any third-party claims or losses of any nature, including without limitation lost profits, punitive or consequential damages.</p>
                                        <p>Discountdhamaka is not responsible for any content that a user, subscriber, or an unauthorized user may post on this website and/ or mobile app any content that is posted or uploaded that is or may be deemed unsuitable can and may be taken down by discountdhamaka. Moreover, discountdhamaka reserves the right to edit, change, alter, delete and prohibit any and all content that it, discountdhamaka, deems unsuitable.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Monitoring</h3>
                                        <p>DiscountDhamaka shall have the right, but not the obligation, to monitor the content of the Website at all times, including the comment section and any chat rooms and forums that may hereinafter be included as part of the Website and/ or Mobile App, to determine compliance with this Agreement and any operating rules established by DiscountDhamaka, as well as to satisfy any applicable law, regulation or authorized government request. Without limiting the foregoing, DiscountDhamaka shall have the right to remove any material that DiscountDhamaka, in its sole discretion, finds to be in violation of the provisions hereof or otherwise objectionable.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Privacy</h3>
                                        <p>User acknowledges that all discussion for ratings, comments, bulletin board service, chat rooms and/or other message or communication facilities (collectively “Communities”) are public and not private communications, and that, therefore, others may read User’s communications without User’s knowledge. DiscountDhamaka does not control or endorse the content, messages or information found in any Community, and, therefore, DiscountDhamaka specifically disclaims any liability concerning the Communities and any actions resulting from User’s participation in any Community, including any objectionable content. Generally, any communication which User posts on the Website and/or Mobile App(whether in chat rooms, discussion groups,comments section, message boards or otherwise) is considered to be non-confidential. If particular web pages permit the submission of communications that will be treated by DiscountDhamaka as confidential, that fact will be stated on those pages. By posting comments, messages or other information on the Website, User grants DiscountDhamaka the right to use such comments, messages or information for promotions, advertising, market research or any other lawful purpose. For more information see DiscountDhamaka’s Privacy Policy.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">License Grant</h3>
                                        <p>By posting content/ deals/ communications on or through this Website and/or Mobile App, User shall be deemed to have granted to DiscountDhamaka a royalty-free, perpetual, irrevocable & non-exclusive license to copy, transmit, use, reproduce, modify, publish, edit, translate, distribute, perform, display, reformat and incorporate it into a collective work the content/ value deals/ communication alone or as part of other works in any form, media, or technology whether now known or hereafter developed, and to sublicense such rights through multiple tiers of sublicensees. For greater certainty, this means that, among other things, DiscountDhamaka has the right to use any and all ideas you submit (including ideas about our products, services, publications or advertising campaigns) in any manner that we choose, without any notice or obligation to you whatsoever.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Indemnification</h3>
                                        <p>User agrees to defend, indemnify and hold harmless DiscountDhamaka, its subsidiaries and Business Associates, and their respective directors, officers, employees and agents from and against all claims and expenses, including attorneys’ fees, arising out of the use of this Website and/or the Mobile App by User.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Termination</h3>
                                        <p>DiscountDhamaka may terminate this Agreement at any time. Without limiting the foregoing, DiscountDhamaka shall have the right to immediately terminate any passwords or accounts of User in the event of any conduct by User which DiscountDhamaka, in its sole discretion, considers to be unacceptable, or in the event of any breach by User of this Agreement.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Trademarks</h3>
                                        <p>DiscountDhamaka is a trademark of XXX. All rights in respect of this trademark are hereby expressly reserved. Unless otherwise indicated, all other trademarks appearing on the Website are the property of their respective owners.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Third Party Content</h3>
                                        <p>DiscountDhamaka, similar to an Internet Service Provider, is a distributor (and not a publisher) of content supplied by third parties and Users. Accordingly, DiscountDhamaka has no more editorial control over such content than does a public library, bookstore or newsstand. Any opinions, advice, statements, services, offers, or other information or content expressed or made available by third parties, including information providers, or any other Users are those of the respective author(s) or distributors and not of DiscountDhamaka. Neither DiscountDhamaka nor any third-party provider of information guarantees the accuracy, completeness, or usefulness of any content, nor its merchantability or fitness for any particular purpose .</p>
                                        <p>In many instances, the content available through this Website and/or Mobile App represents the opinions and judgments of the respective information provider, User, or other user not under contract with DiscountDhamaka. DiscountDhamaka neither endorses nor is responsible for the accuracy or reliability of any opinion, advice or statement made on the Website and/or Mobile App by anyone other than authorized DiscountDhamaka employee spokespersons while acting in official capacities.</p>
                                        <p>Under no circumstances will DiscountDhamaka be liable for any loss or damage caused by User’s reliance on information obtained through the Website and/or Mobile App. It is the responsibility of User to evaluate the accuracy, completeness or usefulness of any information, opinion, advice etc. or other content available through the Website and/or Mobile App. The Website may contains links to third party Websites maintained by other content providers.</p>
                                        <p>These links are provided solely as a convenience to you and not as an endorsement by DiscountDhamaka of the contents on such third-party sites and DiscountDhamaka hereby expressly disclaims any representations regarding the content or accuracy of materials on such third-party Web sites. If User decides to access linked third-party Web sites, User does so at own risk. Unless you have executed a written agreement with DiscountDhamaka expressly permitting you to do so, you may not provide a hyperlink to the Website from any other website. DiscountDhamaka reserves the right to revoke its consent to any link at any time in its sole discretion.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Force Majeure</h3>
                                        <p>Without prejudice to any other provision herein, DiscountDhamaka shall not be liable for any loss, damage or penalty as a result of any delay in or failure to deliver or otherwise perform hereunder due to any cause beyond the DiscountDhamaka’s control, including, without limitation, acts of the User, embargo or other governmental act, regulation or request affecting the conduct of DiscountDhamaka’s business, fire, explosion, accident, theft, vandalism, riot, acts of war, strikes or other labour difficulties, lightning, flood, windstorm or other acts of God.</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">Miscellaneous</h3>
                                        <p>This Agreement and any operating rules for the Website established by DiscountDhamaka constitute the entire agreement of the parties with respect to the subject matter hereof. No waiver by either party of any breach or default hereunder is a waiver of any preceding or subsequent breach or default. The section headings used herein are for convenience only and shall be of no legal force or effect. If any provision of this Agreement is held invalid by a court of competent jurisdiction, such invalidity shall not affect the enforceability of any other provisions contained in this Agreement and the remaining portions of this Agreement shall continue in full force and effect. The failure of either party to exercise any of its rights under this Agreement shall not be deemed a waiver or forfeiture of such rights or any other rights provided hereunder.</p>
                                        <p>DiscountDhamaka’s headquarters are in Delhi, India. Legal issues arising out of, but not exclusive to the use of, this Website or the Mobile App (unless otherwise specifically stated) are governed by and in accordance with the laws of Delhi (exclusive of its rules regarding conflicts of laws).</p>
                                        <p>Please read our privacy policy for data safety and other terms.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="privacypol" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button type="button" class="btn-close qty_close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row terms_condition_page">
                        <div class="col-md-12 text-center">
                            <div class="section-title">
                                <h2 class="ec-title">Vendor Privacy Policy</h2>
                                <p class="sub-title mb-3">Welcome to the Discount Dhamaka marketplace</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="ec-common-wrapper">

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <p>We, XXX Pvt. Ltd. (hereinafter referred to as the “Company”), having its offices at Delhi, where such expression shall, unless repugnant to the context thereof, be deemed to include our respective legal heirs, representatives, administrators, permitted successors and assigns are the creators of this Privacy Policy, which ensures our steady commitment to Your privacy with regard to the protection of your invaluable information. This privacy policy contains information about a Website called ‘www.DiscountDhamka.in (hereinafter referred to as the “Website”) and/or Mobile App with the name DiscountDhamaka. In order to provide you with uninterrupted use of our services, we may collect and, in some circumstances, disclose information about you. To ensure better protection of your privacy, we provide this notice explaining our information collection and disclosure policies, and the choices you make about the way your information is collected and used.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner uldiv">
                                        <h3 class="ec-cms-block-title">DEFINITIONS</h3>
                                        <p>The term ‘You’ & ‘User’, shall mean any legal person or entity accessing or using the services provided on this Website and/or Mobile App who is competent to enter into binding contracts, as per the provisions of the Indian Contract Act, 1872.</p>
                                        <ul>
                                            <li><i class="fa fa-check"></i> The terms ‘we’, ‘us’, ‘our’ shall mean the Website and/or the Company and/or the Mobile App, as the context so requires.</li>
                                            <li><i class="fa fa-check"></i> The term ‘Services’ shall mean the business of advertising online deals of various vendors on its online platform by the name of DiscountDhamaka.</li>
                                            <li><i class="fa fa-check"></i> The terms ‘Party’ and ‘Parties’ shall respectively be used to refer to the User and the Company individually and collectively, as the context so requires.</li>
                                            <li><i class="fa fa-check"></i> “Personal Information” shall mean and refer to any personally identifiable information that we may collect from you.</li>
                                            <li><i class="fa fa-check"></i> “Third Parties” refer to any Website, Mobile App, company or individual apart from the User and the creator of this Website and/or Mobile App.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner uldiv">
                                        <h3 class="ec-cms-block-title">INFORMATION COLLECTED</h3>
                                        <p>We are committed to respecting your online privacy. We further recognize your need for appropriate protection and management of any Personal Information you share with us. Since we provide certain services as mentioned above, we may collect the following information which are appropriately required to provide such services:</p>
                                        <p>From Users, information including name, contact number, email address, etc. Is collected. We collect, and store personal information provided by you from time to time on the Website and/or Mobile App. We only collect and use such information from you that we consider necessary for achieving a seamless, efficient and safe experience, customized to your needs including:</p>
                                        <ul>
                                            <li><i class="fa fa-check"></i> To enable the provision of services opted for by you.</li>
                                            <li><i class="fa fa-check"></i> To communicate necessary account and service related information from time to time.</li>
                                            <li><i class="fa fa-check"></i> To allow you to receive quality customer care services.</li>
                                            <li><i class="fa fa-check"></i> To comply with applicable laws, rules and regulations.</li>
                                            <li><i class="fa fa-check"></i> To facilitate evolution of the platform through provision of analytics to users.</li>
                                        </ul>
                                        <p>Where any service requested by you involves a third party, such information as is reasonably necessary by the Company to carry out your service request may be shared with such third party.</p>
                                        <p>We also do use your contact information to send you offers based on your interests and prior activity. The Company may also use contact information internally to direct its efforts for service improvement, but shall immediately delete all such information upon withdrawal of your consent for the same through an email to be sent to ______________. We collect and store your search details on the Website and/or Mobile App, including your search history, the usage of the Website and/or Mobile App and the features and time you have used the Website and/or Mobile App for. We collect any communications between you and other Users/third-parties on the Website and/or Mobile App.</p>
                                        <p>Transacting over the internet has inherent risks which can only be avoided by you following security practices yourself, such as not revealing account/login related information to any other person and informing our customer care team about any suspicious activity or where your account has/may have been compromised.</p>
                                        <p>At every stage prior to, during or after information collection, you have the right to access all personally identifiable information provided, rectify or alter all personally identifiable information provided, restrict the level of information to be retained as per your sole discretion and object to the retention, use and potential disclosure of the personally identifiable information.</p>
                                        <p>Users are responsible for maintaining the security and confidentiality of their account details and passwords. Please note that We will never ask you for your password in an unsolicited phone call or in an unsolicited e-mail. Further, Users are advised to sign off from their systems after availing of the Services to avoid accidental and unauthorised access to personal information from their accounts by any third-party.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">OUR USE OF YOUR INFORMATION</h3>
                                        <p>The information provided by you at the time of registration and thereafter shall be used to contact you when necessary. For more details about the nature of such communications, please refer to our Terms of Service. Further, your personal data may be collected and stored by us for internal record.</p>
                                        <p>We use your tracking information such as IP addresses, and or Device ID to help identify you and to gather broad demographic information. In case we are acquired by or merged with another company, we shall be legally obliged to share information disclosed by you and information about you to the company we are acquired by or merged with. In the event of a merger or acquisition, we shall notify you by email to review our revised privacy policy, as and when Your Personal Information is shared with or becomes subject to a different privacy policy.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner uldiv">
                                        <h3 class="ec-cms-block-title">COOKIES</h3>
                                        <p>We use data collection devices such as “cookies” on certain pages of our Websites and/or Mobile App. “Cookies” are small files sited on your hard drive that assist us in providing customized services. We also offer certain features that are only available through the use of a “cookie”. Cookies can also help us provide information, which is targeted to your interests. Cookies may be used to identify logged in or registered users. Our Website and/or Mobile App uses session cookies to ensure that you have a good experience. These cookies contain a unique number, your ‘session ID’, which allows our server to recognise your computer and/or Mobile Device and ‘remember’ what you’ve done on the site. The benefits of this are:</p>
                                        <ul>
                                            <li><i class="fa fa-check"></i> You only need to log in once if you’re navigating secure areas of the site</li>
                                            <li><i class="fa fa-check"></i> Our server can distinguish between your computer and/or mobile device and other users, so you can see the information that you have requested.</li>
                                        </ul>
                                        <p>You can choose to accept or decline cookies by modifying your browser settings if you prefer. This may prevent you from taking full advantage of the Website and/or Mobile App. We also use various third-party cookies for usage, behavioural, analytics and preferences data.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner uldiv">
                                        <h3 class="ec-cms-block-title">YOUR RIGHTS REGARDING INFORMATION</h3>
                                        <p>Unless subject to an exemption, you have the following rights with respect to your personal data we hold:</p>
                                        <ul>
                                            <li><strong>A:</strong> The right to request a copy of your personal data which we hold about you.</li>
                                            <li><strong>B:</strong> The right to request for any correction to any personal data if it is found to be inaccurate or out of date.</li>
                                            <li><strong>C:</strong> The right to withdraw Your consent to the processing at any time.</li>
                                            <li><strong>D:</strong> The right to object to the processing of personal data.</li>
                                            <li><strong>E:</strong> The right to lodge a complaint with a supervisory authority.</li>
                                            <li><strong>F:</strong> The right to obtain information as to whether personal data are transferred to a third country or to an international organization.</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">CONFIDENTIALITY</h3>
                                        <p>Your information is regarded as confidential and therefore shall not be divulged to any third party, unless if legally required to do so to the appropriate authorities, or if necessary to ensure Users may fully avail of the services of the Website and/or Mobile App.</p>
                                        <p>We shall not sell, share, or rent your personal information to any marketing agencies or any other such companies that indulge in unsolicited communications. Any communication by Us to You shall be undertaken in accordance with Our Terms of Service and Privacy Policy.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">SECURITY</h3>
                                        <p>We treat data as an asset that must be protected against loss and unauthorized access. We employ many different security techniques to protect such data from unauthorized access by members inside and outside the Company. We follow generally accepted industry standards to protect the Personal Information submitted to us and information that we have accessed. However, “perfect security” does not exist on the Internet. You therefore agree that any security breaches beyond the control of our standard security procedures are at your sole risk and discretion.</p>
                                        <p>When any information is uploaded to Your User account, it sends it over the Internet using Secure Sockets Layer (SSL). This method encrypts the information to help prevent others from reading it while it’s in transit from your computer to Us. If you’re using the Website to upload sensitive data, you should properly secure your computer. To help do this, you can use anti-spyware and virus protection software. You can also restrict access to your computer and/or mobile device (for example, by using a strong password for your login and a network firewall).</p>
                                        <P>The Company shall not be held liable in any way for events beyond our control or in any way for accidental or unauthorised access of your information. No data transmission over the Internet or any wireless network can be guaranteed to be absolutely secure.</P>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner uldiv">
                                        <h3 class="ec-cms-block-title">DISCLOSURE OF YOUR INFORMATION TO THIRD PARTIES</h3>
                                        <p>Due to the existing regulatory environment, we cannot ensure that all of your Personal Information shall never be disclosed in ways other than those described in this Privacy Policy. Although we use industry standard practices to protect your privacy, we do not promise, and you should not expect, that your personally identifiable information or private communications would always remain private.</p>
                                        <ul>
                                            <li><strong>External service providers:</strong> there may be a number of services offered by external service providers that help you use our website and/or mobile app. If you choose to use these optional services, and in the course of doing so, disclose information to the external service providers, and/ or grant them permission to collect information about you, then their use of your information is governed by their privacy policy.</li>
                                            <li><strong>Other corporate entities:</strong> we may share much of our data, including your personal information, with our parent and/ or subsidiaries that are committed to serving your needs through use of our website and/or mobile app and related services, throughout the world. Such data shall be shared for the sole purpose of enhancing your experience of using the website and/or mobile app. To the extent that these entities have access to your information, they shall treat it at least as protectively as they treat information they obtain from their other members. It is possible that we and/or our parent and/or subsidiaries, or any combination of such, could merge with or be acquired by another business entity. Should such a combination occur, you should expect that we would share some or all of your information in order to continue to provide the service. You shall receive notice of such event (to the extent it occurs).</li>
                                            <li><strong>Law and order:</strong> we cooperate with law enforcement inquiries, as well as other third parties to enforce laws, such as: intellectual property rights, fraud and other rights. We can, and you so authorise us, disclose your personal information to law enforcement and other government officials as we, in our sole discretion, believe necessary or appropriate, in connection with an investigation of fraud, intellectual property infringements, or other activity that is illegal or may expose us/ us or you to any legal liability.<strong></li>
                                        </ul>
                                        <p>Any information that you make publicly available on the site and/or Mobile App may be potentially viewed by any party, and by posting such material it is deemed that you consent to share such information with such parties.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner ">
                                        <h3 class="ec-cms-block-title">ACCESSING, REVIEWING AND CHANGING YOUR PROFILE</h3>
                                        <p>Following registration, you can review and change the information you submitted at the stage of registration. An option for facilitating such change shall be available in your ‘My Profile’ page. If you change any information, we may keep track of your old information.</p>
                                        <p>If you believe that any information we are holding on you is incorrect or incomplete, or to remove your profile, please write to or email us as soon as possible, at ___________. We shall promptly correct any information found to be incorrect.</p>
                                        <P>We shall retain in our files, information you have requested to remove for certain circumstances, such as to resolve disputes, troubleshoot problems and enforce our terms and conditions. Further, such prior information is never completely removed from our databases due to technical and legal constraints, including stored ‘back up’ systems. Therefore, you should not expect that all of your personally identifiable information shall be completely removed from our databases in response to your requests.</P>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">INDEMNITY</h3>
                                        <p>You agree and undertake to indemnify us in any suit or dispute by any Third Party arising out of disclosure of Personal Information by You to Third Parties either through Our Website and/or Mobile App or otherwise and Your use and access of Websites and/or Mobile App and resources of Third Parties. We assume no liability for any actions of Third Parties with regard to Your Personal Information, which you may have disclosed to such Third Parties.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">SEVERABILITY</h3>
                                        <p>Each paragraph of this privacy policy shall be and remain separate from and independent of and severable from all and any other paragraphs herein except where otherwise expressly indicated or indicated by the context of the agreement. The decision or declaration that one or more of the paragraphs are null and void shall have no effect on the remaining paragraphs of this privacy policy.</p>
                                    </div>
                                </div>

                                <div class="col-sm-12 ec-cms-block">
                                    <div class="ec-cms-block-inner">
                                        <h3 class="ec-cms-block-title">AMENDMENT</h3>
                                        <p>Our Privacy Policy may change from time to time with or without notice.</p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/select2/select2.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/srb-validation.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>

    <script>
        var placeSearch, autocomplete;
        var componentForm = {
            route: 'short_name',
            sublocality_level_1: 'long_name',
            locality: 'long_name',
            administrative_area_level_1: 'long_name',
            postal_code: 'short_name'
        };
        var input = document.getElementById('vAdd1');

        function initMap() {
            var geocoder;
            var autocomplete;
            geocoder = new google.maps.Geocoder();
            var card = document.getElementById('locationField');
            autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function() {
                fillInAddress();
            });

            function fillInAddress(new_address) {
                if (typeof new_address == 'undefined') {
                    var place = autocomplete.getPlace(input);
                    var latValue = place.geometry.location.lat();
                    var lngValue = place.geometry.location.lng();
                    // console.log(lngValue);
                    var latInput = document.getElementById('latInput');
                    var lngInput = document.getElementById('lngInput');
                    latInput.value = latValue;
                    lngInput.value = lngValue;
                } else {
                    place = new_address;
                }
                //console.log(place);
                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                for (var i = 0; i < place.address_components.length; i++) {

                    var addressType = place.address_components[i].types[0];
                    console.log(addressType);
                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];
                        document.getElementById(addressType).value = val;
                    }
                }
            }

        }
    </script>
    <script>
        $(document).ready(function() {
            $("#bussinessDetails input").attr('disabled', 'disabled')
            $("#bussinessDetails select").attr('disabled', 'disabled')
            $("#vC_code").select2({
                placeholder: "Select Country Code"
            });
            $("#vCp_cCode").select2({
                placeholder: "Select Country Code"
            });
            $("#vBusType").select2({
                placeholder: "Select brand Type"
            });
            $("#vBusCat").select2({
                placeholder: "Select Business Category"
            });



            $(document).on("click", ".toggle-password", function() {
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

        });
    </script>

    <script>
        $(document).on("click", "#sendOtpVendor", function() {
            vC_code = $('#vC_code').val();
            vMob_num = $('#vMob_num').val();

            if (vC_code == "") {
                swicon = "warning";
                msg = "Select Country Code Please";
                srbSweetAlret(msg, swicon);
            } else if (vMob_num == "") {
                swicon = "warning";
                msg = "Enter Mobile Number Please";
                srbSweetAlret(msg, swicon);
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/otp.php",
                    data: {
                        vC_code: vC_code,
                        vMob_num: vMob_num,
                        type: 'VendorOtpMob',
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
                            $('#vMob_num').attr('disabled', 'disabled');
                            $('#vOtpCode').removeAttr('disabled', 'disabled');
                            $('#vOtpCode').focus();
                            $("#sendOtpVendor").text('Verify Otp');
                            $("#sendOtpVendor").attr('id', 'verifyVendorMobOtp');
                            $("#MobiSendOtpSec").html('<p class="resendotp"> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>');

                            var timeleft = 30;
                            var downloadTimer = setInterval(function() {
                                timeleft--;
                                document.getElementById("countdowntimer").textContent = timeleft;
                                if (timeleft <= 0) {
                                    clearInterval(downloadTimer);
                                    $(".resendotp").html("<a href='javascript:void(0);' id='sendOtpVendor'>Resend otp</a>");
                                }

                            }, 1000);

                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                        }
                    }
                });
            }
        });

        $(document).on("click", "#verifyVendorMobOtp", function() {
            vOtpCode = $('#vOtpCode').val();
            vC_code = $('#vC_code').val();
            vMob_num = $('#vMob_num').val();

            if (vOtpCode == "") {
                swicon = "warning";
                msg = "Select Country Code Please";
                srbSweetAlret(msg, swicon);
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/otp.php",
                    data: {
                        vOtpCode: vOtpCode,
                        vC_code: vC_code,
                        vMob_num: vMob_num,
                        type: 'VendorOtpMobVer',
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
                            $("#bussinessDetails input").removeAttr('disabled', 'disabled');
                            $("#bussinessDetails select").removeAttr('disabled', 'disabled');
                            $("#bussinessDetails").show();
                            $('#vMob_num').attr('disabled', 'disabled');
                            $('#vC_code').attr('disabled', 'disabled');
                            $("#otpSec").hide();
                            $('#vendor_Form').removeClass('srb-mt-form');
                            $('#vF_name').focus();
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $('#vMob_num').val();
                            $('#vC_code').select2();
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

        $("#vNewPass").on("keyup", function(e) {
            $(this).prop('type', 'password');
            var value = $(this).val();
            if (value != '') {
                var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
                var isValid = regex.test(value);
                if (!isValid) {
                    $('#VendorRegBtn').attr('disabled', 'disabled');
                    $("#vNewPass").addClass('err_bdr');
                    $("#ErrMsg").show();
                    $("#ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
                } else {
                    $("#ErrMsg").hide();
                    $('#VendorRegBtn').removeAttr('disabled', 'disabled');
                    $("#vNewPass").removeClass('err_bdr');
                }
            }
        });

        $("#vGstNum").on("keyup", function(e) {
            $(this).prop('type', 'text');
            var value = $(this).val();
            if (value != '') {
                var regex = /[0-9]{2}[A-Z]{3}[ABCFGHLJPTF]{1}[A-Z]{1}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
                var isValid = regex.test(value);
                if (!isValid) {
                    $('#VendorRegBtn').attr('disabled', 'disabled');
                    $("#vGstNum").addClass('err_bdr');
                    $("#ErrMsg1").show();
                    $("#ErrMsg1").html("<div class='err_msg' id='" + this.id + "ErrMsg1'>Please Enter Valid GSTIN Number. eg : 07IWTSG8757B1X1</div>");
                } else {
                    $("#ErrMsg1").hide();
                    $('#VendorRegBtn').removeAttr('disabled', 'disabled');
                    $("#vGstNum").removeClass('err_bdr');
                }
            } else {
                $("#ErrMsg1").hide();
                $('#VendorRegBtn').removeAttr('disabled', 'disabled');
                $("#vGstNum").removeClass('err_bdr');
            }
        });

        $(document).on("click", "#VendorRegBtn", function() {
            vC_code = $('#vC_code').val();
            vMob_num = $('#vMob_num').val();
            vMob_ver = mobileVerified();
            vF_name = $('#vF_name').val();
            vL_name = $('#vL_name').val();
            vUser_name = $('#vUser_name').val();
            vEmail_id = $('#vEmail_id').val();
            vNewPass = $('#vNewPass').val();
            vRePass = $('#vRePass').val();
            vBusType = $('#vBusType').val();
            vBusCat = $('#vBusCat').val();
            vBusName = $('#vBusName').val();
            vCPname = $('#vCPname').val();
            vCPemail = $('#vCPemail').val();
            vCp_cCode = $('#vCp_cCode').val();
            vCPmobile = $('#vCPmobile').val();
            vGstNum = $('#vGstNum').val();
            vLandlineNum = $('#vLandlineNum').val();
            vAdd1 = $('#vAdd1').val();
            vAdd2 = $('#route').val();
            locality = $('#sublocality_level_1').val();
            vCity = $('#locality').val();
            vState = $('#administrative_area_level_1').val();
            vZipCode = $('#postal_code').val();
            vLatCode = $('#latInput').val();
            vLngCode = $('#lngInput').val();
            $agree_term = $("#agree_term").prop('checked');

            if (vC_code == "") {
                swicon = "warning";
                msg = "Select Country Code Please";
                srbSweetAlret(msg, swicon);
            } else if (vMob_num == "") {
                swicon = "warning";
                msg = "Enter Mobile Number Please";
                srbSweetAlret(msg, swicon);
            } else if (vMob_ver !== "1" && vMob_ver == "0") {
                swicon = "warning";
                msg = "Please Verify Your mobile";
                srbSweetAlret(msg, swicon);
            } else if (vF_name == "") {
                swicon = "warning";
                msg = "Enter First Name Please";
                srbSweetAlret(msg, swicon);
            } else if (vL_name == "") {
                swicon = "warning";
                msg = "Enter Last Name Please";
                srbSweetAlret(msg, swicon);
            } else if (vUser_name == "") {
                swicon = "warning";
                msg = "Enter User Name Please";
                srbSweetAlret(msg, swicon);
            } else if (vEmail_id == "") {
                swicon = "warning";
                msg = "Enter Email Address Please";
                srbSweetAlret(msg, swicon);
            } else if (vNewPass == "") {
                swicon = "warning";
                msg = "Enter Your Password Please";
                srbSweetAlret(msg, swicon);
            } else if (vRePass == "") {
                swicon = "warning";
                msg = "Enter Confirm Password Please";
                srbSweetAlret(msg, swicon);
            } else if (vBusType == "") {
                swicon = "warning";
                msg = "Select Business Type Please";
                srbSweetAlret(msg, swicon);
            } else if (vBusCat == "") {
                swicon = "warning";
                msg = "Select Business Category Please";
                srbSweetAlret(msg, swicon);
            } else if (vBusName == "") {
                swicon = "warning";
                msg = "Enter Business Name Please";
                srbSweetAlret(msg, swicon);
            } else if (vCPname == "") {
                swicon = "warning";
                msg = "Enter Contact Person Name";
                srbSweetAlret(msg, swicon);
            } else if (vCp_cCode == "") {
                swicon = "warning";
                msg = "Select Contact Person C.Code";
                srbSweetAlret(msg, swicon);
            } else if (vCPmobile == "") {
                swicon = "warning";
                msg = "Enter Contact Person Mobile";
                srbSweetAlret(msg, swicon);
            } else if (vCPemail == "") {
                swicon = "warning";
                msg = "Enter Contact Person Email";
                srbSweetAlret(msg, swicon);
            } else if (vAdd1 == "") {
                swicon = "warning";
                msg = "Enter Address Please";
                srbSweetAlret(msg, swicon);
            } else if (vCity == "") {
                swicon = "warning";
                msg = "Enter Your City Please";
                srbSweetAlret(msg, swicon);
            } else if (vState == "") {
                swicon = "warning";
                msg = "Enter Your State Please";
                srbSweetAlret(msg, swicon);
            } else if (vZipCode == "") {
                swicon = "warning";
                msg = "Enter ZIP Code Please";
                srbSweetAlret(msg, swicon);
            } else if ($agree_term == false) {
                swicon = "warning";
                msg = "Please Agree To The Terms & Conditions";
                srbSweetAlret(msg, swicon);

            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/registration.php",
                    data: {
                        vC_code: vC_code,
                        vMob_num: vMob_num,
                        vMob_ver: vMob_ver,
                        vF_name: vF_name,
                        vL_name: vL_name,
                        vUser_name: vUser_name,
                        vEmail_id: vEmail_id,
                        vNewPass: vNewPass,
                        vRePass: vRePass,
                        vBusType: vBusType,
                        vBusCat: vBusCat,
                        vBusName: vBusName,
                        vCPname: vCPname,
                        vCPemail: vCPemail,
                        vCp_cCode: vCp_cCode,
                        vCPmobile: vCPmobile,
                        vGstNum: vGstNum,
                        vLandlineNum: vLandlineNum,
                        vAdd1: vAdd1,
                        vAdd2: vAdd2,
                        locality: locality,
                        vCity: vCity,
                        vState: vState,
                        vZipCode: vZipCode,
                        vLatCode: vLatCode,
                        vLngCode: vLngCode,
                        type: 'vendor_reg'
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
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>