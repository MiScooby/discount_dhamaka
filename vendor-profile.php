<?php include('includes/header.php');


if (!isset($_SESSION['LoggedInVendor']) && $_SESSION['LoggedInVendor'] == '') {
    header('location:login.php');
}
$vendorBySession = $_SESSION['LoggedInVendor'];
$getVndr_det = mysqli_query($con, "SELECT *  FROM vendor WHERE  user_name='$vendorBySession' AND status='Active'");
$getVndr_detCount = mysqli_num_rows($getVndr_det);
if ($getVndr_detCount == 1) {
    $VenDor = mysqli_fetch_array($getVndr_det);
} else {
    header('location:login.php');
}

$getCat_det = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$VenDor[business_cat]' AND `status`='Active' ");
$VenCat = mysqli_fetch_array($getCat_det);

$brandlogoQuery = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$VenDor[id]'"));

?>
<link rel="stylesheet" href="assets/css/profile.css?v1.3">
<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
<link rel="stylesheet" href="assets/datatables.net-bs5/dataTables.bootstrap5.css">
<link rel="stylesheet" type="text/css" href="assets/css/v-profile.css?v1.3">



<?php
$checkLMDealQ = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE `vendor_id`='$VenDor[id]'  ORDER BY `vendor_last_minute_deal_plan`.`id` DESC LIMIT 1 ");
$checkLMDealCount = mysqli_num_rows($checkLMDealQ);
$checkLMDeal = mysqli_fetch_array($checkLMDealQ);


$VedDealQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `vendor_id`='$VenDor[id]' AND `is_deleted`='0' ");
$VedDealCount = mysqli_num_rows($VedDealQ);
?>
<input type="hidden" value="<?= $vendorBySession; ?>" id="VendorId">
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
                                <?php
                                if (!empty($brandlogoQuery['brand_logo'])) {
                                ?>
                                    <img class="v-img" src="upload/vendor-doc/brand-logo/<?= $brandlogoQuery['brand_logo'] ?>" alt="vendor image">
                                <?php
                                } else {
                                ?>
                                    <img class="v-img" src="assets/images/user/1.png" alt="vendor image">
                                <?php
                                }
                                ?>


                                <h5><?= $VenDor['merchant_bus_name'] ?></h5>
                            </div>
                            <div class="ec-vendor-block-items">
                                <ul>
                                    <li><a href="#dashboard" class="tab-link vProbar Active" data-tabc=".dashboard-prf-tab"><i class="fa fa-home"></i> Dashboard</a></li>

                                    <li><a href="#profile" class="tab-link vProbar" data-tabc=".dash-prf-tab"><i class="fa fa-user"></i> My Profile</a></li>

                                    <li><a href="#brand" class="tab-link vProbar" data-tabc=".brand-prf-tab"><i class="fa fa-bandcamp"></i> Brand</a></li>

                                    <li><a href="#deals" class="tab-link vProbar" data-tabc=".edit-prf-tab"><i class="fa fa-tag"></i> Deals</a></li>
                                    <li><a href="#grabbed-deal" class="tab-link vProbar" data-tabc=".grabbed-deal-prf-tab"><i class="fa fa-tag"></i> Grabbed Deals</a></li>
                                    <li><a href="javascript:void(0);" onclick="logout()" class="logouttb"><i class="fa fa-sign-out "></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card srb-re">
                    <div id="loader" style="display: none;">
                        <div class="lds-dual-ring">
                            <div class="overlay">
                            </div>
                        </div>
                    </div>
                    <div class="coupon-dstab active dashboard-prf-tab" data-value="dashboard">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <?php
                                $checkSubsQuery = mysqli_query($con, "SELECT * FROM `vendor_membership` WHERE `vendor_id`='$VenDor[id]' ORDER BY `id` DESC");

                                // echo "SELECT * FROM `vendor_membership` WHERE `vendor_id`='$VenDor[id]' ORDER BY `id` DESC";

                                $checkSubsQueryCount = mysqli_num_rows($checkSubsQuery);
                                $getSubdet = mysqli_fetch_array($checkSubsQuery);
                                if ($checkSubsQueryCount > 0) {
                                ?>
                                    <div class="row invoice-card-row">
                                        <div class="col-xl-6 col-xxl-3 col-sm-6">
                                            <div class="card_my bg-warning invoice-card">
                                                <div class="card-body d-flex">
                                                    <div class="icon me-3">
                                                        <img src="assets/images/icons/calendar.svg" width="25px" alt="">
                                                    </div>
                                                    <div>
                                                        <h2 class="text-white invoice-num">Renew Before Last Date</h2>

                                                        <?php
                                                        $planAdddate = $getSubdet['add_date'];
                                                        $Plandays = $getSubdet['mem_plan_days'];
                                                        $next_due_date = $getSubdet['expire_date'];
                                                        $current_date = date('Y-m-d');
                                                        $current_date > $next_due_date ?  $planExpired = true : $planExpired = false; ?>

                                                        <span class="text-white fs-18"><?= $next_due_date ?></span>
                                                        <?php if ($current_date > $next_due_date) { ?>
                                                            <span class="btn btn_danger text-danger d-sm-inline-block d-none">Plan
                                                                Expired<i class="las la-signal ms-3 scale5"></i></span>
                                                        <?php  }
                                                        ?>
                                                        <!-- <?= (date('Y-m-d') <= $next_due_date) ? '' : ''; ?> -->
                                                        <div style="    display: flex;  align-items: flex-end; justify-content: space-between;">
                                                            <a href="#subscription" class="tab-link sbr-subs-btn" data-tabc=".subscription-prf-tab" style="color: #fff !important;"> My Subscription</a>

                                                            <a href="choose-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&SubsPlan_type=memPlan&&<?= $urltoken ?>&<?= $urltoken ?>" class="tab-link sbr-subs-btn" style="color: #fff !important;">Renew<i class="las la-signal ms-3 scale5"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-xxl-3 col-sm-6">
                                            <div class="card_my bg-success invoice-card">
                                                <div class="card-body d-flex">

                                                    <?php
                                                    if (($checkLMDealCount > 0) && ($checkLMDeal['plan_items'] > "0")) {
                                                    ?>
                                                        <div class="mr-2"> <a href="javascript:void(0);" class="btn btn-primary one_off"><?= $checkLMDeal['plan_items'] ?> <i class="las la-signal ms-3 scale5"></i></a></div>
                                                        <div>
                                                            <h2 class="text-white invoice-num">Remaining Flash Deals</h2>
                                                            <div style="    display: flex;  align-items: flex-end; justify-content: space-between;">
                                                                <a href="choose-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&SubsPlan_type=LmdealPlan&&<?= $urltoken ?>&<?= $urltoken ?>" class="tab-link sbr-subs-btn " style="color: #fff !important;">Renew<i class="las la-signal ms-3 scale5"></i></a>
                                                                <a href="#flash_subscription" class="tab-link sbr-subs-btn ml-1" data-tabc=".flash_subscription-prf-tab" style="color: #fff !important;"> My Subscription</a>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div>
                                                            <p class="text-white srb-fs-12">If you want to offer Flash Deals which are offered for 30 minutes to 24 Hours then you have to buy a separate package as they are charged on deal basis.
                                                            </p>
                                                            <a href="choose-plan.php?<?= $urltoken . '&' . $urltoken . '&&SubsPlan_type=LmdealPlan&&' . $urltoken . '&' . $urltoken ?>" class="btn btn-primary lmdealbtn">Buy Flash Deals Plan<i class="las la-signal ms-3 scale5"></i></a>

                                                        </div>
                                                    <?php
                                                    }
                                                    ?>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="col-12">
                                    <div class="card_top">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-xl-12">
                                                    <div class="card-bx bg-blue">
                                                        <img class="pattern-img" src="assets/images/pattern6.png" alt="">
                                                        <div class="card-info text-white">
                                                            <img src="assets/images/circle.png" class="mb-4" alt="">
                                                            <h2 class="text-white card-balance">Hi
                                                                <?= $VenDor['f_name']; ?> here's quick overview of your
                                                                stats.</h2>
                                                            <p class="fs-16">
                                                                <?= ($checkSubsQueryCount > 0) ? 'Total Deals: <span>' . $VedDealCount . '</span>' : '<a href="choose-plan.php?' . $urltoken . '&' . $urltoken . '&&SubsPlan_type=memPlan&&' . $urltoken . '&' . $urltoken . '" class="text-white">Please Subscribe With Discount Dhamaka Membership</a>'; ?>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="coupon-dstab  brand-prf-tab" data-value="brand">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="row g-3" action="javascript:;" enctype="multipart/form-data" id="storeBrandForm">

                                        <?php
                                        $brandQuery = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$VenDor[id]'");
                                        // echo "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$VenDor[id]'";
                                        $storeCountBrnd = mysqli_num_rows($brandQuery);
                                        $getBrandStore = mysqli_fetch_array($brandQuery);
                                        ?>
                                        <div class="col-md-12 space-t-15">
                                            <label class="form-label">Brand Name</label>
                                            <input type="text" name="storeName" class="form-control" <?= (!empty($getBrandStore['store_name'])) ? 'value="' . $getBrandStore['store_name'] . '" disabled' : ''; ?> id="storeName" placeholder="Store Name">
                                        </div>


                                        <div class="col-md-12 space-t-15 mt-3">

                                            <label class="form-label">Brand Logo</label>
                                            <?= (empty($getBrandStore['brand_logo'])) ? '' : '<div class="p-2"> <img src="upload/vendor-doc/brand-logo/' . $getBrandStore['brand_logo'] . '" width="100px" alt="img"></div>'; ?>
                                            <input type="file" onchange="validateBrandLogo(this)" class="form-control" <?= (empty($getBrandStore['brand_logo'])) ? '' : 'id="brandLogo"'; ?> name="brandLogo">
                                        </div>




                                        <div class="col-md-12 space-t-15 mt-3">
                                            <label class="form-label">Brand Description</label>

                                            <textarea id="myDesc" class="editor" name="myDesc" rows="10" cols="80" required="">
                                            <?= (!empty($getBrandStore['store_desc'])) ? '' . $getBrandStore['store_desc'] . '' : ''; ?>
                                            </textarea>
                                        </div>

                                        <div class="col-md-12 space-t-15 mt-3">
                                            <label class="form-label">Brand Locality</label>

                                            <select <?= (!empty($getBrandStore['store_locality'])) ? 'disabled' : ''; ?> class=" form-control" name="brandLocality" id="busLoc">
                                                <option></option>
                                                <?php
                                                $getLoc = mysqli_query($con, "SELECT * FROM `locality` WHERE `status`='active' ");
                                                while ($getLocDet = mysqli_fetch_array($getLoc)) {
                                                ?>
                                                    <option value="<?= $getLocDet['locality']; ?>" <?= (isset($getBrandStore['store_locality']) && $getBrandStore['store_locality'] ==  $getLocDet['locality']) ? 'selected' : ''; ?>><?= $getLocDet['locality']; ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        </div>

                                        <div class="col-md-12 space-t-15 mt-3">
                                            <label class="form-label">Brand Location</label>

                                            <!-- <div id="locationField">
                                                <input id="autocomplete"  class="form-control" name="preLoc" placeholder="Precise Locations" type="text"></input>
                                            </div> -->

                                            <div id="locationField">
                                                <input id="autocomplete" <?= (!empty($getBrandStore['store_location'])) ? 'readonly value="' . $getBrandStore['store_location'] . '"' : ' '; ?> placeholder="Enter your address" class="form-control" name="preLoc" type="text"></input>
                                            </div>
                                            <input type="hidden" id="latInput" name="latInput" placeholder="latatude" />
                                            <input type="hidden" id="lngInput" name="lngInput" placeholder="longitude" />

                                        </div>

                                        <div class="col-md-12 space-t-15 mt-4">

                                            <div id="map" style="height: 350px;"></div>
                                            <div id="infowindow-content">
                                                <img src="" width="16" height="16" style="display: none;" id="place-icon">
                                                <span id="place-name" class="title"></span><br>
                                                <span id="place-address"></span>
                                            </div>

                                        </div>
                                        <input type="hidden" name="vendorId" value="<?= $vendorBySession ?>">

                                        <div class="col-md-12 space-t-15">
                                            <?php if ($storeCountBrnd != 1) { ?>
                                                <button type="submit" id="SaveStoreBrand" class="btn btn-primary top_to">Save Brand</button>
                                                <input type="hidden" name="type" value="addBrandStore">

                                            <?php } ?>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="coupon-dstab grabbed-deal-prf-tab  " data-value="grabbed-deal">
                        <?php
                        if ($checkSubsQueryCount > 0) {
                        ?>

                            <?php if ($storeCountBrnd == 1) { ?>

                                <div class="ec-vendor-card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="topheaddiv">
                                                    <h5>Your Total Grabbed Deals List -</h5>
                                                    <?php $planExpired ? $dataid = "" :  $dataid = ".add_dealfrm"; ?>

                                                </div>
                                            </div>

                                            <style>
                                                .mydealdiv1.active {
                                                    display: block;
                                                }

                                                .mydealdiv1 {
                                                    display: none;
                                                }
                                            </style>

                                            <div class="mydealdiv1 active tableDiv table-responsive">

                                                <table id="dtBasicExample" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th>#</th>
                                                            <th>Order Id</th>
                                                            <th>User Name</th>
                                                            <th>Coupon Code</th>
                                                            <th>Deal Name</th>
                                                            <th>Deal Category</th>
                                                            <th>Deal Start Date</th>
                                                            <th>Deal End Date</th>
                                                            <th>User Email</th>
                                                            <th>User Mobile</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $i = 1;
                                                        $dealDetail = mysqli_query($con, "SELECT dd.*,od.offer_title, c.cat_name, od.offer_start_date, od.offer_start_time, od.offer_end_date, od.offer_end_time, u.first_name as usr_f_name, u.last_name as usr_l_name, u.mobile_num as usr_mob , u.email_id as usr_email FROM deals_order dd, offer_deals od, vendor v, user u, category c WHERE od.id=dd.deal_id AND od.vendor_id=v.id AND dd.user_id=u.user_name AND od.offer_cat=c.id AND v.id='$VenDor[id]' GROUP BY dd.coupon_code ORDER BY `dd`.`id` DESC;");

                                                        while ($dealDetailList = mysqli_fetch_array($dealDetail)) {


                                                        ?>
                                                            <tr>
                                                                <td><?= $i++ ?></td>
                                                                <td><?= $dealDetailList['order_token']; ?></td> 
                                                                <td><?= $dealDetailList['usr_f_name']; ?> <?= $dealDetailList['usr_l_name']; ?></td>
                                                                <td><span class="badge bg-success"><?= $dealDetailList['coupon_code']; ?></span></td>
                                                                <td><?= $dealDetailList['offer_title']; ?></td>
                                                                <td><?= $dealDetailList['cat_name']; ?></td>
                                                                <td><?= $dealDetailList['offer_start_date']; ?> <?= $dealDetailList['offer_start_time']; ?></td>
                                                                <td><?= $dealDetailList['offer_end_date']; ?> <?= $dealDetailList['offer_end_time']; ?></td>
                                                                
                                                                <td><?php if ($dealDetailList['usr_email'] != null) {
                                                                        echo "<a href='mailto:" . $dealDetailList['usr_email'] . "'>" . $dealDetailList['usr_email'] . "</a>";
                                                                    } else {
                                                                        echo '<p class="text-secondary">-</p>';
                                                                    } ?> </td>
                                                                <td><a href="tel:<?= $dealDetailList['usr_mob']; ?>"><?= $dealDetailList['usr_mob']; ?></a></td>
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

                            <?php } else { ?>

                                <div class="ec-vendor-card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7 MembershipSubs">
                                            <img src="assets/images/deals.png" alt="">
                                            <p style="background:#f0fff9;color:indianred;padding:8px 0;border-radius:19px;font-size:14px;font-weight:600;text-transform:uppercase;">
                                                You have to add <span style="border-bottom:1px solid #cd5c5c66;">brand store
                                                    information</span> to <span style="border-bottom:1px solid #cd5c5c66;">add
                                                    Deals</span></p>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        <?php
                        } else {
                        ?>
                            <div class="ec-vendor-card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-7 MembershipSubs">
                                        <img src="assets/images/membership.png" alt="">
                                        <p>You Don't Have Any Subscription for Add Deals. Please Subscribe Our Membership by
                                            click below Button</p>
                                        <a href="choose-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&SubsPlan_type=memPlan&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-success">Subscribe Membership</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="coupon-dstab  dash-prf-tab" data-value="profile">
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
                                                                <img class="image-thumb-preview ec-image-preview v-img" src="assets/images/banner/8.jpg" alt="edit" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ec-vendor-block-detail">
                                                    <div class="thumb-upload">
                                                        <div class="thumb-preview ec-preview">
                                                            <div class="image-thumb-preview">
                                                                <img class="image-thumb-preview ec-image-preview v-img" src="assets/images/user/1.png" alt="edit" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mymsg">
                                                            <div class="alert-success">
                                                                <p>Hi, <span><?= $VenDor['f_name']; ?></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ec-vendor-upload-detail">
                                                    <form class="row g-3">
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">User Name</label>
                                                            <input type="text" class="form-control" id="vuserName" value="<?= $VenDor['user_name'] ?>" disabled>

                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">First Name</label>
                                                            <input disabled type="text" class="form-control" id="vFirstName" value="<?= $VenDor['f_name'] ?>">

                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Last Name</label>
                                                            <input disabled type="text" class="form-control" id="VlastName" value="<?= $VenDor['l_name'] ?>">

                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <style>
                                                                .plsvrfy {
                                                                    left: 210px;
                                                                }
                                                            </style>
                                                            <label class="form-label">Email-Id
                                                                <?= ($VenDor['email_verified'] == 1) ? '' : '<a href=javascript:void(0); class=plsvrfy emailv_click data-link-action=quickview data-bs-toggle=modal data-bs-target=#email_verified_modal>Verify Email-Id</a>'; ?>
                                                            </label>
                                                            <input disabled type="email" class="form-control" value="<?= $VenDor['email_id'] ?>" placeholder="Enter Email Id">
                                                            <span class="frmicon env"><i class="fa fa-envelope"></i></span>
                                                        </div>

                                                        <div class="col-md-2 space-t-15 myslct">
                                                            <label class="form-label" for="countrycode">Country
                                                                Code</label>
                                                            <input type="text" class="form-control" value="<?= $VenDor['c_code'] ?>" disabled placeholder="Enter Country Code" disabled>
                                                            <span class="frmicon env"><i class="fa fa-globe"></i></span>
                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Mobile </label>

                                                            <input type="text" class="form-control" value="<?= $VenDor['mobile_num'] ?>" placeholder="Enter Mobile Number" disabled>
                                                            <span class="frmicon env"><i class="fa fa-phone-alt"></i></span>
                                                        </div>

                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Merchant Business Name</label>
                                                            <input disabled type="text" class="form-control" id="mbName" value="<?= $VenDor['merchant_bus_name'] ?>" placeholder="Business Name">

                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Busines Type</label>
                                                            <div class="select-wrapper">
                                                                <select class="select_tws form-control" id="Bustypev" disabled>

                                                                    <option value="Single Store" <?= ('Single Store' == $VenDor['business_type']) ? 'Selected' : ''; ?>>
                                                                        Single Store </option>
                                                                    <option value="Multi Store" <?= ('Multi Store' == $VenDor['business_type']) ? 'Selected' : ''; ?>>
                                                                        Multi Store</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Busines Category</label>
                                                            <div class="select-wrapper">
                                                                <select disabled class="select_tws form-control" id="BusCatv">
                                                                    <option></option>
                                                                    <?php
                                                                    $getCatQuery = mysqli_query($con, "SELECT * FROM `category` WHERE `status`='Active' ");
                                                                    while ($getCatList = mysqli_fetch_array($getCatQuery)) {
                                                                    ?>
                                                                        <option value="<?= $getCatList['id'] ?>" <?= ($getCatList['id'] == $VenDor['business_cat']) ? 'selected' : ''; ?>>
                                                                            <?= $getCatList['cat_name'] ?>
                                                                        </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Contact Person Name</label>
                                                            <input type="text" class="form-control" id="cpName" value="<?= $VenDor['cp_name'] ?>" placeholder="Person Name">

                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Contact Person Email</label>
                                                            <input type="email" id="cpEmail" value="<?= $VenDor['cp_email'] ?>" class="form-control" placeholder="Enter Email Id">
                                                            <span class="frmicon env"><i class="fa fa-envelope"></i></span>
                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Contact Person Mobile</label>

                                                            <input type="text" class="form-control" id="cpNum" value="<?= $VenDor['cp_num'] ?>" placeholder="Enter Mobile Number">
                                                            <span class="frmicon env"><i class="fa fa-envelope"></i></span>
                                                        </div>

                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">GST No.</label>
                                                            <input disabled type="text" class="form-control" id="vGst" placeholder="GST No" <?= ($VenDor['gst_num'] !== "n/a") ? 'value="' . $VenDor['gst_num'] . '"' : ''; ?>>

                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Landline No.</label>
                                                            <input disabled type="number" id="vLandline" class="form-control" <?= ($VenDor['landline_num'] !== "n/a") ? 'value="' . $VenDor['landline_num'] . '"' : ''; ?>>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6 space-t-15">
                                                                <label class="form-label">Address 1</label>
                                                                <input disabled type="text" id="vAddr1" class="form-control" placeholder="Address 1" value="<?= $VenDor['address_1'] ?>">
                                                                <span class="frmicon"><i class="fa fa-address-book"></i></span>
                                                            </div>
                                                            <div class="col-md-6 space-t-15">
                                                                <label class="form-label">Address 2 </label>
                                                                <input disabled type="text" id="vAddr2" class="form-control" placeholder="Address 2" <?= ($VenDor['address_2'] !== "n/a") ? 'value="' . $VenDor['address_2'] . '"' : ''; ?>>
                                                                <span class="frmicon"><i class="fa fa-address-book"></i></span>
                                                            </div>
                                                            <div class="col-md-4 space-t-15">
                                                                <label class="form-label">City </label>
                                                                <input disabled type="text" id="vCity" class="form-control" placeholder="City" value="<?= $VenDor['city'] ?>">

                                                            </div>
                                                            <div class="col-md-4 space-t-15">
                                                                <label class="form-label">State </label>
                                                                <input disabled type="text" id="vState" value="<?= $VenDor['state'] ?>" class="form-control" placeholder="State ">

                                                            </div>
                                                            <div class="col-md-4 space-t-15">
                                                                <label class="form-label">Pincode </label>
                                                                <input disabled type="text" id="vPinCode" value="<?= $VenDor['pin_code'] ?>" class="form-control" placeholder="Pincode">

                                                            </div>


                                                            <div class="col-md-6 space-t-15" id="editOtpSec" style="display: none;">
                                                                <label class="form-label">Verify Otp For Edit Profile
                                                                </label>
                                                                <div class="d-flex">

                                                                    <input type="text" id="vEditOtp" class="form-control" placeholder="Enter Otp">
                                                                    <button type="button" id="verVendorEditOtp" class="btn btn-primary" style="height: 38px; line-height: 38px;">Verify
                                                                        Otp</button>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 space-t-15">
                                                                <button type="button" id="saveVendorProfile" class="btn btn-primary">Save Profile</button>
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
                    </div>

                    <div class="coupon-dstab subscription-prf-tab  " data-value="subscription">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body p-2 mydealdiv1 active  ">

                                        <table id="" class="table dtBasicExample table-striped table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Order Id</th>
                                                    <th>Plan Name</th>
                                                    <th>Plan Amount</th>
                                                    <th>Plan Days</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Date</th>
                                                    <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $i = 1;
                                                $getMem = mysqli_query($con, "SELECT mo.*, mp.plan_name, mp.plan_type FROM mem_order mo, membership_plan mp WHERE mp.id=mo.plan_id AND mo.payment_status='complete' AND mo.vendor_id='$VenDor[id]' ORDER BY `mo`.`id` DESC");
                                                while ($getMemData = mysqli_fetch_array($getMem)) {
                                                ?>
                                                    <tr style="text-align: center;">
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $getMemData['order_id'] ?></td>
                                                        <td><?= $getMemData['plan_name'] . ' ' . $getMemData['plan_type'] . ' Membership Plan'; ?></td>
                                                        <td><?= $getMemData['plan_amnt'] ?></td>
                                                        <td><?= $getMemData['plan_days'] ?></td>
                                                        <td><?= $getMemData['paid_amnt'] ?></td>
                                                        <td><?= $getMemData['payment_date'] ?></td>
                                                        <td><a href="invoice/index.php?<?= $urltoken . $urltoken ?>&&invoice=<?= $getMemData['order_id'] ?>&type=mem&&<?= $urltoken . $urltoken ?>" style="font-size: 12px; width: 130px;" target="_blank" class="btn btn-primary">View Invoice</a></td>
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
                    <div class="coupon-dstab flash_subscription-prf-tab  " data-value="flash_subscription">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="card">
                                    <div class="card-body p-2 mydealdiv1 active  ">

                                        <table id="" class="table dtBasicExample table-striped table-bordered">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>#</th>
                                                    <th>Order Id</th>
                                                    <th>Plan Name</th>
                                                    <th>Plan Amount</th>
                                                    <th>Plan Days</th>
                                                    <th>Paid Amount</th>
                                                    <th>Payment Date</th>
                                                    <th>Invoice</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                $i = 1;
                                                $getMem = mysqli_query($con, "SELECT lmo.*, lmp.plan_name, lmp.plan_type FROM lmd_order lmo, last_minute_deals_plan lmp WHERE lmp.id=lmo.plan_id AND lmo.payment_status='complete' AND lmo.vendor_id='$VenDor[id]' ORDER BY `lmo`.`id` DESC");
                                                while ($getMemData = mysqli_fetch_array($getMem)) {
                                                ?>
                                                    <tr style="text-align: center;">
                                                        <td><?= $i++ ?></td>
                                                        <td><?= $getMemData['order_id'] ?></td>
                                                        <td><?= $getMemData['plan_name'] . ' ' . $getMemData['plan_type'] . ' Membership Plan'; ?></td>
                                                        <td><?= $getMemData['plan_amnt'] ?></td>
                                                        <td><?= $getMemData['plan_deals'] ?></td>
                                                        <td><?= $getMemData['paid_amnt'] ?></td>
                                                        <td><?= $getMemData['payment_date'] ?></td>
                                                        <td><a href="invoice/index.php?<?= $urltoken . $urltoken ?>&&invoice=<?= $getMemData['order_id'] ?>&type=lmd&&<?= $urltoken . $urltoken ?>" style="font-size: 12px; width: 130px;" target="_blank" class="btn btn-primary">View Invoice</a></td>
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
                    <div class="coupon-dstab edit-prf-tab" data-value="deals">

                        <?php
                        if ($checkSubsQueryCount > 0) {
                        ?>

                            <?php if ($storeCountBrnd == 1) { ?>

                                <div class="ec-vendor-card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>
                                                <div class="topheaddiv">
                                                    <h5>Your Total Number of Deals List -</h5>
                                                    <?php $planExpired ? $dataid = "" :  $dataid = ".add_dealfrm"; ?>
                                                    <button <?php if ($planExpired) { ?> disabled <?php } else {
                                                                                                    '';
                                                                                                }; ?> class="btn add_to_btn dealFormBtn clickaddeal" data-id="<?= $dataid; ?>">Add Deal</button>
                                                    <button class="btn add_to_btn dealFormBtn  cancelAddDeal" data-id=".add_dealfrm">Cancel Deal</button>
                                                </div>
                                            </div>

                                            <style>
                                                .mydealdiv1.active {
                                                    display: block;
                                                }

                                                .mydealdiv1 {
                                                    display: none;
                                                }
                                            </style>

                                            <div class="mydealdiv1 active tableDiv table-responsive">

                                                <table id="dtBasicExample" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr style="text-align: center;">
                                                            <th>#</th>
                                                            <th>Deal Code</th>
                                                            <th>Deal</th>
                                                            <th>Status</th>
                                                            <th>Categories</th>
                                                            <th>Deal Start Date</th>
                                                            <th>Deal End Date</th>
                                                            <th>Deals Type</th>
                                                            <th>Deals</th>
                                                            <th>Grabbed Deals</th>
                                                            <th>Balance Deals</th>
                                                            <th>Clicks</th>
                                                            <th>Views</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        $dealQuer = mysqli_query($con, "SELECT od.*, c.cat_name FROM offer_deals od, category c WHERE `vendor_id`='$VenDor[id]' AND od.offer_cat=c.id ORDER BY od.id DESC");

                                                        while ($dealQuerList = mysqli_fetch_array($dealQuer)) {

                                                            $dealId = $dealQuerList['id'];

                                                            $grabbedDealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `deals_order` WHERE `deal_id`='$dealId'"));

                                                            if ($dealQuerList['deal_times'] != "n/a") {
                                                                $baldeal = ($dealQuerList['deal_times'] + $grabbedDealCount);
                                                            } else {
                                                                $baldeal = "Unlimited";
                                                            }

                                                        ?>
                                                            <tr>
                                                                <td><?= $i++ ?></td>
                                                                <td> <span class="order_id"><?= ($dealQuerList['deal_code'] == null) ? 'null' : '' . $dealQuerList['deal_code'] . ''; ?></span>
                                                                <td> <span class="order_id"><?= $dealQuerList['offer_title'] ?></span>
                                                                </td>
                                                                <td>

                                                                    <?php


                                                                    $currentSrbTime = date("Y-m-d H:i");
                                                                    $DealDteTime = $dealQuerList['offer_end_date'] . ' ' . $dealQuerList['offer_end_time'];



                                                                    if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {

                                                                        if ($dealQuerList['status'] == "Hide") {
                                                                            $stsDeal = "Paused";
                                                                        } else if ($dealQuerList['is_deleted'] == 1) {
                                                                            $stsDeal = "Deleted";
                                                                        } else if ($dealQuerList['status'] == "Reject") {
                                                                            $stsDeal = "Rejected";
                                                                        } else if (($dealQuerList['status'] == "Active") && ($dealQuerList['published'] == "1")) {
                                                                            $stsDeal = "Active";
                                                                        } else if ($dealQuerList['status'] == "Inactive") {
                                                                            $stsDeal = "Inactive";
                                                                        } else {
                                                                            $stsDeal = "Schedule";
                                                                        }
                                                                    } else {
                                                                        if ($dealQuerList['is_deleted'] == 1) {
                                                                            $stsDeal = "Deleted";
                                                                        } else if ($dealQuerList['status'] == "Reject") {
                                                                            $stsDeal = "Rejected";
                                                                        } else if ($dealQuerList['status'] == "Inactive") {
                                                                            $stsDeal = "Inactive";
                                                                        } else {
                                                                            $stsDeal = "Expired";
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <span class="order_date <?= $stsDeal ?>">
                                                                        <?= $stsDeal ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id"><?= $dealQuerList['cat_name'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id"><?= $dealQuerList['offer_start_date'] . ' ' . $dealQuerList['offer_start_time'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id"><?= $dealQuerList['offer_end_date'] . ' ' . $dealQuerList['offer_end_time'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id ytprDeal"> <small style="font-size: 9px; font-weight: 600;">
                                                                            <?php

                                                                            $currentSrbTime = date("Y-m-d H:i");
                                                                            $DealDteTime = $dealQuerList['offer_start_date'] . ' ' . $dealQuerList['offer_start_time'];


                                                                            if ($dealQuerList['last_minute_deal'] == "Yes") {
                                                                                echo "Flash Deal Deal";
                                                                            } else if ($dealQuerList['deal_times'] == "n/a") {
                                                                                echo "Big Sale Deal";
                                                                            } else if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                                                                echo "Upcoming Deal";
                                                                            } else {
                                                                                echo "Normal Deal";
                                                                            }
                                                                            ?>
                                                                        </small> </span>
                                                                </td>


                                                                <td>
                                                                    <span class="order_id">
                                                                        <?= $baldeal ?>
                                                                    </span>
                                                                </td>
                                                                <td class="px-0 text-center">
                                                                    <span class="order_id">
                                                                        <?= $grabbedDealCount ?>
                                                                    </span>
                                                                </td>
                                                                <td class="px-0 text-center">
                                                                    <span class="order_id ytprDeal">
                                                                        <small style="font-size: 10px; font-weight: 600;"> <?= ($dealQuerList['deal_times'] == "n/a") ? 'Unlimited' : '' . $dealQuerList['deal_times'] . ''; ?> </small> </span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id">
                                                                        <?= $dealQuerList['fake_click'] ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id">
                                                                        <?= $dealQuerList['fake_view'] ?>
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <?php if ($dealQuerList['is_deleted'] == "0") { ?>
                                                                        <ul class="add_btns">

                                                                            <li>

                                                                                <?php
                                                                                if ($dealQuerList['last_minute_deal'] != "Yes") {

                                                                                    $currentSrbTime = date("Y-m-d H:i");
                                                                                    $DealDteTime = $dealQuerList['offer_end_date'] . ' ' . $dealQuerList['offer_end_time'];

                                                                                    if ((strtotime($DealDteTime) < strtotime($currentSrbTime))) {




                                                                                ?>


                                                                                        <a href="<?= "copy-deal.php?" . $urltoken . "&" . $urltoken . "&id=" . $dealQuerList['id'] . "&" . $urltoken; ?>" style="padding:0;" type="submit" name="editDealBtn"><i class="fa fa-copy" aria-hidden="true" style="color: orange;"></i></a>
                                                                                    <?php
                                                                                    } else {   ?>

                                                                                        <a href="<?= "edit_deal.php?" . $urltoken . "&" . $urltoken . "&id=" . $dealQuerList['id'] . "&" . $urltoken; ?>" style="padding:0;" type="submit" name="editDealBtn"><i class="fa fa-edit" aria-hidden="true" style="color: orange;"></i></a>
                                                                                <?php

                                                                                    }
                                                                                }
                                                                                ?>


                                                                            </li>

                                                                            <li>
                                                                                <a target="_blank" href="preview-offer.php?<?= $urltoken . $urltoken ?>&deal_id=<?= $dealQuerList['id'] ?>&<?= $urltoken . $urltoken ?>" title="Deal Preview"><i class="fa fa-desktop" aria-hidden="true" style="color: navyblue;"></i></a>
                                                                            </li>
                                                                            <?php
                                                                            if ($dealQuerList['published'] == "1") {
                                                                                if ($dealQuerList['status'] != "Reject" && $dealQuerList['status'] != "Delete" && $dealQuerList['status'] != "Inactive") {

                                                                                    $currentSrbTime = date("Y-m-d H:i");
                                                                                    $DealDteTime = $dealQuerList['offer_end_date'] . ' ' . $dealQuerList['offer_end_time'];
                                                                                    if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                                                            ?>
                                                                                        <li>
                                                                                            <?= ($dealQuerList['status'] == "Active") ? '<a href="javascript:void(0)" data-id="' . $dealQuerList['id'] . '"  id="hideDeal" title="Hide Deal"><i class="fa fa-eye-slash" aria-hidden="true" style="color: red;"></i></a>' : '<a href="javascript:void(0)" data-id="' . $dealQuerList['id'] . '"  id="showDeal" title="Show Deal"><i class="fa fa-eye" aria-hidden="true" style="color: #02cc60;"></i></a>'; ?>

                                                                                        </li>
                                                                            <?php
                                                                                    }
                                                                                }
                                                                            }
                                                                            ?>



                                                                            <li>
                                                                                <a href="javascript:void(0)" title="Delete Deal" data-id="<?= $dealQuerList['id'] ?>" id="dltDeal"><i class="fa fa-times" aria-hidden="true" style="color: red;"></i></a>
                                                                            </li>
                                                                        </ul>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <span class="order_date Deleted">
                                                                            Deleted
                                                                        </span>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>



                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="mydealdiv1 adddeal add_dealfrm">

                                                <form class="row g-3" id="addVendorDealForm" enctype="multipart/form-data">


                                                    <div class="col-md-12 space-t-15">
                                                        <label class="form-label">Offer Title <span class="mand">*</span></label>
                                                        <span class="testlimit" id="charsrbtitle"></span>
                                                        <input type="text" name="DealOffertitle" id="DealOffertitle" required class="form-control" maxlength="50">
                                                        <span class="discri">Input title for the offer.</span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-3">
                                                        <label class="form-label">Deal Description <span class="mand">*</span></label>
                                                        <textarea id="myDesc_two" name="DealDesc" class="editor"></textarea>
                                                        <span class="discri">Input description of the offer.</span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-2">
                                                        <label class="form-label">Offer Image <span class="mand">*</span></label><br>
                                                        <input type="file" name="dealOfferImg" required class="form-control" onchange="validateimg(this)" id="dealOfferImg" accept="image/*" style="padding-top:14px !important;">
                                                        <span class="discri">Upload and select featured image for the offer. Make Sure Image Size Will be Max 500*500 & Min 200*200 photo size</span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-4">
                                                        <label class="form-label">Offer Category <span class="mand">*</span></label><br>
                                                        <input class="form-control mb-1" value="<?= $VenDor['business_cat'] ?>" name="DealCategory" readonly type="hidden" />
                                                        <select class="select_tws form-control mb-1" disabled>
                                                            <option value="<?= $VenDor['business_cat'] ?>">
                                                                <?= $VenCat['cat_name'] ?></option>

                                                        </select>

                                                        <?php
                                                        $getSUbCat_det = mysqli_query($con, "SELECT * FROM `sub_category` WHERE `parent_cat`='$VenDor[business_cat]' AND `status`='Active' ");
                                                        $SubCatDor = mysqli_num_rows($getSUbCat_det);
                                                        if ($SubCatDor  > 0) {
                                                        ?>
                                                            <select class="select_tws form-control" id="AddDealsubCat" name="AddDealsubCat">
                                                                <option></option>
                                                                <?php
                                                                while ($SubCatDorlist = mysqli_fetch_array($getSUbCat_det)) {
                                                                ?>
                                                                    <option value="<?= $SubCatDorlist['id'] ?>">
                                                                        <?= $SubCatDorlist['sub_cat_name'] ?></option>
                                                                <?php
                                                                }
                                                                ?>

                                                            </select>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <?php
                                                    if (($checkLMDealCount > 0) && ($checkLMDeal['plan_items'] > "0")) {
                                                    ?>
                                                        <div class="col-md-12 space-t-15  mt-3 d-flex align-items-center">
                                                            <label class="form-label p-0 mr-2">Flash Deals</label>
                                                            <select class="select_tws form-control w-50" id="lastMintDeal" name="lastMintDeal">
                                                                <option value="Yes">Yes</option>
                                                                <option value="No" selected>No</option>
                                                            </select>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="col-md-12 space-t-15  mt-3 d-flex align-items-end">
                                                            <label class="form-label p-0 mb-0 mr-2" style="width: 150px;">Flash Deals : </label>
                                                            <select class="select_tws form-control w-50" id="lastMintDeal" name="lastMintDeal" disabled>
                                                                <option value="Yes">Yes</option>
                                                                <option value="No" selected>No</option>
                                                            </select>
                                                            <small style="font-size: 10px; font-weight: 600; margin: 0 10px; ">Note : If you want to offer Flash Deals which are offered for 30 minutes to 24 Hours then you have to buy a separate package as they are charged on deal basis.
                                                            . <a href="choose-plan.php?<?= $urltoken . '&' . $urltoken . '&&SubsPlan_type=LmdealPlan&&' . $urltoken . '&' . $urltoken ?>">Buy Flash Deals Plan</a>
                                                            </small>

                                                        </div>

                                                    <?php
                                                    }
                                                    ?>


                                                    <div class="col-md-12 space-t-15 mt-4">
                                                        <label>Offer Start Date: <span class="mand">*</span></label>

                                                        <input class="form-control" id="datePicker" name="DealStartDate" required type="date" />

                                                        <input class="form-control dealstrtime" required name="DealStartTime" id="DealStartTime" type="time" />
                                                        <span class="discri">Set start date for the offer. If this field is
                                                            empty current time will be applied to the offer.</span>
                                                    </div>

                                                    <div class="col-md-12 space-t-15 mt-4">
                                                        <label>Offer Expire Date: <span class="mand">*</span></label>

                                                        <input required class="form-control" id="dateEnd" name="DealEndDate" type="date" />

                                                        <input required id="DealEndTime" class="form-control dealendtime" name="DealEndTime" type="time" />
                                                        <span class="discri">Set end date for the offer.</span>
                                                    </div>

                                                    <div class="col-md-12 space-t-15 mt-2">
                                                        <label class="form-label">Deal Items</label>
                                                        <input type="text" oninput="this.value = this.value.replace(/\D+/g, '')" name="dealItems" id="dealItems" class="form-control">
                                                        <span class="discri">Input number of deal items will be available for
                                                            offer. Incase you dont fill this filed uour deal item count will
                                                            unlimited</span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-2">
                                                        <label class="form-label">Deal Images <span class="mand">*</span></label><br>
                                                        <input type="file" name="dealImg[]" multiple class="form-control" onchange="validateimg(this)" accept="image/*" style="padding-top:14px !important;">
                                                        <span class="discri">Choose max 7 images at a time for the deal. Drag and drop to change
                                                            their order. Make Sure Image Size Will be Max 500*500 & Min 200*200 photo size </span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-3">
                                                        <label class="form-label">Short Description</label>
                                                        <span class="testlimit" id="charsrb"></span>
                                                        <textarea type="text" name="deal_shortdesc" id="deal_excerpt" maxlength="200" class="form-control" spellcheck="false" placeholder="Description"></textarea>

                                                        <span class="discri">Input description which will appear in the deal
                                                            single page sidebar.</span>

                                                    </div>
                                                    <div class="col-md-12 space-t-15  mt-3">
                                                        <label class="form-label">Deal Features </label>
                                                        <span class="testlimit" id="charsrbFeat"></span>
                                                        <input type="text" maxlength="15" name="dealFeauture" id="dealFeauture" class="form-control">

                                                    </div>

                                                    <div class="col-md-12  space-t-15 mt-3">
                                                        <input type="hidden" name="addVendorDeal" value="addVendorDeal">
                                                        <input type="hidden" name="VendorId" value="<?= $VenDor['id'] ?>">

                                                        <button type="submit" id="submitAdddealBtn" class="btn btn-primary add_to_btn_to">Finish</button>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <?php } else { ?>

                                <div class="ec-vendor-card-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-7 MembershipSubs">
                                            <img src="assets/images/deals.png" alt="">
                                            <p style="background:#f0fff9;color:indianred;padding:8px 0;border-radius:19px;font-size:14px;font-weight:600;text-transform:uppercase;">
                                                You have to add <span style="border-bottom:1px solid #cd5c5c66;">brand store
                                                    information</span> to <span style="border-bottom:1px solid #cd5c5c66;">add
                                                    Deals</span></p>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        <?php
                        } else {
                        ?>
                            <div class="ec-vendor-card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-7 MembershipSubs">
                                        <img src="assets/images/membership.png" alt="">
                                        <p>You Don't Have Any Subscription for Add Deals. Please Subscribe Our Membership by
                                            click below Button</p>
                                        <a href="choose-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&SubsPlan_type=memPlan&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-success">Subscribe Membership</a>
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

                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="VenemailAddressVer" class="form-label fw-500">Email
                                                Address</label>
                                            <div class="myrwdiv">
                                                <input type="email" class="form-control bg-light border-light" id="VenemailAddressVer" value="<?= $VenDor['email_id'] ?>" disabled placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row justify-content-center" id="otpVerSec">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="VendorEmailverifyOtp" class="form-label fw-500">Verify
                                                OTP</label>
                                            <div class="myrwdiv">
                                                <input type="text" class="form-control bg-light border-light" id="VendorEmailverifyOtp" required="" maxlength="4" disabled placeholder="Verify OTP">
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



<?php include('includes/footer.php'); ?>
<script src="assets/select2/select2.min.js"></script>
<script src="assets/sweetalert2/sweetalert2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/super-build/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>
<script src="assets/datatables.net/jquery.dataTables.js"></script>
<script src="assets/datatables.net-bs5/dataTables.bootstrap5.js"></script>


<script>
    $(document).ready(function() {
        var $txtArea = $('#deal_excerpt');
        var $chars = $('#charsrb');
        var textMax = $txtArea.attr('maxlength');

        $chars.html(textMax + ' / 200');

        $txtArea.on('keyup', countChar);

        function countChar() {
            var textLength = $txtArea.val().length;
            var textRemaining = textMax - textLength;
            $chars.html(textRemaining + ' / 200');
        };
    });
    $(document).ready(function() {
        var $txtArea = $('#DealOffertitle');
        var $chars = $('#charsrbtitle');
        var textMax = $txtArea.attr('maxlength');

        $chars.html(textMax + ' / 50');

        $txtArea.on('keyup', countChar);

        function countChar() {
            var textLength = $txtArea.val().length;
            var textRemaining = textMax - textLength;
            $chars.html(textRemaining + ' / 50');
        };
    });
    $(document).ready(function() {
        var $txtArea = $('#dealFeauture');
        var $chars = $('#charsrbFeat');
        var textMax = $txtArea.attr('maxlength');

        $chars.html(textMax + ' / 15');

        $txtArea.on('keyup', countChar);

        function countChar() {
            var textLength = $txtArea.val().length;
            var textRemaining = textMax - textLength;
            $chars.html(textRemaining + ' / 15');
        };
    });
</script>
<script>
    // $(document).on('change', "#DealOffertitle", function() {
    //     console.log(this)
    // })
    $("#vFirstName").on("change", function() {
        var value = $(this).val();
        console.log('changed')
        if (value != '') {
            var regex = /^[a-zA-Z ]{2,30}$/;
            var isValid = regex.test(value);
            console.log('correct');
        } else {
            console.log('incorrect');
        }
    })

    function validateimg(ctrl) {
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof(fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function(e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function() {
                        var height = this.height;
                        var width = this.width;
                        // console.log(height);
                        if ((height > 500 || width > 500) || (height < 200 || width < 200)) {
                            swicon = "warning";
                            msg = "Please upload Max 500*500 & Min 200*200 photo size.";
                            srbSweetAlret(msg, swicon);
                            $(ctrl).val('');
                            return false;
                        }
                    };
                }
            } else {
                swicon = "warning";
                msg = "This browser does not support HTML5.";
                srbSweetAlret(msg, swicon);
                $(ctrl).val('');
                return false;
            }
        } else {
            swicon = "warning";
            msg = "Please select a valid Image file.";
            srbSweetAlret(msg, swicon);
            $(ctrl).val('');
            return false;
        }
    }


    function validateOfferimg(ctrl) {
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof(fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function(e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function() {
                        var height = this.height;
                        var width = this.width;
                        // console.log(height);
                        if ((height > 300 || width > 900) || (height < 275 || width < 800)) {
                            swicon = "warning";
                            msg = "Please upload 900*300 photo size.";
                            srbSweetAlret(msg, swicon);
                            $(ctrl).val('');
                            return false;
                        }
                    };
                }
            } else {
                swicon = "warning";
                msg = "This browser does not support HTML5.";
                srbSweetAlret(msg, swicon);
                $(ctrl).val('');
                return false;
            }
        } else {
            swicon = "warning";
            msg = "Please select a valid Image file.";
            srbSweetAlret(msg, swicon);
            $(ctrl).val('');
            return false;
        }
    }


    function validateBrandLogo(ctrl) {
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof(fileUpload.files) == "undefined") {
                swicon = "warning";
                msg = "This browser does not support HTML5.";
                srbSweetAlret(msg, swicon);
                $(ctrl).val('');
                return false;
            }
        } else {
            swicon = "warning";
            msg = "Please select a valid Image file.";
            srbSweetAlret(msg, swicon);
            $(ctrl).val('');
            return false;
        }
    }


    // prevent selection of previous date of endDate 
    $(document).on('change', "#dateEnd", () => {
        var dateEnd = $("#dateEnd").val();
        console.log(dateEnd);
        $('#datePicker').attr('max', dateEnd);
    });
</script>

<script>
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };



    var input = document.getElementById('autocomplete');

    function initMap() {
        var geocoder;
        var autocomplete;

        geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: <?= (isset($getBrandStore['store_lat'])) ? '' . $getBrandStore['store_lat'] . '' : '28.6139';  ?>,
                lng: <?= (isset($getBrandStore['store_lng'])) ? '' . $getBrandStore['store_lng'] . '' : '77.2090';  ?>,

            },
            zoom: 15
        });
        var marker = new google.maps.Marker({
            position: {
                lat: <?= (isset($getBrandStore['store_lat'])) ? '' . $getBrandStore['store_lat'] . '' : '28.6139';  ?>,
                lng: <?= (isset($getBrandStore['store_lng'])) ? '' . $getBrandStore['store_lng'] . '' : '77.2090';  ?>,
            },
            map: map,

        });
        var card = document.getElementById('locationField');
        autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29),
            draggable: true
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            console.log(place);

            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
            fillInAddress();

        });

        function fillInAddress(new_address) { // optional parameter
            if (typeof new_address == 'undefined') {
                var place = autocomplete.getPlace(input);
                var latValue = place.geometry.location.lat();
                var lngValue = place.geometry.location.lng();
                console.log(lngValue);
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
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

        google.maps.event.addListener(marker, 'dragend', function() {
            geocoder.geocode({
                'latLng': marker.getPosition()
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        // console.log(autocomplete);
                        $('#autocomplete').val(results[0].formatted_address);
                        $('#latitude').val(marker.getPosition().lat());
                        $('#longitude').val(marker.getPosition().lng());
                        infowindow.setContent(results[0].formatted_address);
                        infowindow.open(map, marker);
                        // google.maps.event.trigger(autocomplete, 'place_changed');
                        fillInAddress(results[0]);
                    }
                }
            });
        });
    }
</script>

<script>
    $(function() {
        $('#dtBasicExample').DataTable({
            "scrollX": true,
            "responsive": false,
        });

        $('.dtBasicExample').DataTable({
            "scrollX": true,
        });

    });
    $("#BusCatv").select2({
        placeholder: "Select category"
    });
    $("#busLoc").select2({
        placeholder: "Select Locality"
    });

    $("#Bustypev").select2({
        placeholder: "Select Business Type"
    });
    $("#AddDealsubCat").select2({
        placeholder: "Select Sub Category"
    });
    $("#lastMintDeal").select2({
        placeholder: "Is This Last Minute Deal"
    });
</script>
<script>
    $(".editor").each(function() {
        var __editorName = $(this).attr('id');
        CKEDITOR.ClassicEditor.create(document.getElementById(__editorName), {

            toolbar: {
                items: [

                    'heading', '|',
                    'bold', 'italic', 'underline', '|',

                    'undo', 'redo', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',

                    'insertImage', 'blockQuote', '|',

                    'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            // Changing the language of the interface requires loading the language file using the <script> tag.
            // language: 'es',
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph'
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1'
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2'
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3'
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4'
                    },
                    {
                        model: 'heading5',
                        view: 'h5',
                        title: 'Heading 5',
                        class: 'ck-heading_heading5'
                    },
                    {
                        model: 'heading6',
                        view: 'h6',
                        title: 'Heading 6',
                        class: 'ck-heading_heading6'
                    }
                ]
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
            placeholder: '',
            height: 600,

            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
            fontFamily: {
                options: [
                    'default',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
            fontSize: {
                options: [10, 12, 14, 'default', 18, 20, 22],
                supportAllValues: true
            },
            // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
            // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
            htmlSupport: {
                allow: [{
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }]
            },
            // Be careful with enabling previews
            // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
            htmlEmbed: {
                showPreviews: true
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
            mention: {
                feeds: [{
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }]
            },
            // The "super-build" contains more premium features that require additional configuration, disable them below.
            // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
            removePlugins: [
                // These two are commercial, but you can try them out without registering to a trial.
                // 'ExportPdf',
                // 'ExportWord',
                'CKBox',
                'CKFinder',
                'EasyImage',
                // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                // Storing images as Base64 is usually a very bad idea.
                // Replace it on production website with other solutions:
                // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                // 'Base64UploadAdapter',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                // from a local file system (file://) - load this site via HTTP server if you enable MathType
                'MathType'
            ]
        });
    });
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
    $(document).ready(function() {

        $('.cancelAddDeal').hide()
        // new change js-29-12-2022
        $(document).on("click", ".dealFormBtn", function() {

            $(".cancelAddDeal").toggle();
            $(".clickaddeal").toggle();
            $(".add_dealfrm").toggle("show");
            $(".tableDiv").toggleClass("active");
        });


        $(document).on("click", "#editDealForm", function() {
            $.ajax({
                type: "POST",
                url: "ajax/add-deal.php",
                dataType: "json",
                data: $("#editDealForm").serialize(),
                success: function(data) {
                    console.log(data)
                    $('#DealOffertitle').val(data.offer_title);
                    $('#deal_excerpt').val(data.deal_short_desc);
                    $('#datePicker').val(data.offer_start_date);
                    $('#dateEnd').val(data.offer_end_date);
                    v$('#DealEndTime').val(data.offer_end_time);
                    $('#dealItems').val(data.deal_times);
                    $('#dealFeauture').val(data.deal_feature);
                    $('.dealstrtime').val(data.offer_start_time);
                    $('#DealEndTime').val(data.offer_end_time);
                    $('#deal_id').val(data.id);

                }
            });
        });

        // email verifiction js
        $(document).on("click", "#sendEmailotp", function() {
            VenemailAddressVer = $("#VenemailAddressVer").val();
            if (VenemailAddressVer == "") {
                swicon = "warning";
                msg = "Enter Email id";
                srbSweetAlret(msg, swicon);
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/profile_otp.php",
                    data: {
                        VenemailAddressVer: VenemailAddressVer,
                        type: 'vendorEmailOtpVer',
                        usertype: 'vendor'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {

                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $("#VendorEmailverifyOtp").removeAttr('disabled');
                            $("#VendorEmailverifyOtp").focus();
                            $("#sendEmailotp").text('Verify Otp');
                            $("#sendEmailotp").attr('id', 'verifyEmailOtpVendor');
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $("#VenemailAddressVer").val('');
                        }

                    }
                });
            }
        });
        $(document).on("click", "#verifyEmailOtpVendor", function() {
            VenemailAddressVer = $("#VenemailAddressVer").val();
            emailOtp = $("#VendorEmailverifyOtp").val();
            VendorId = $("#VendorId").val();

            if (emailOtp == "") {
                swicon = "warning";
                msg = "Please Enter Verification Code";
                srbSweetAlret(msg, swicon);
            } else {
                $.ajax({
                    type: "POST",
                    url: "ajax/profile_otp.php",
                    data: {
                        VenemailAddressVer: VenemailAddressVer,
                        emailOtp: emailOtp,
                        VendorId: VendorId,
                        type: 'verEmailOtpVendor',
                        usertype: 'vendor'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            window.setTimeout(function() {
                                location.reload();
                            }, 3000);
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $("#VendorEmailverifyOtp").val('');
                        }

                    }
                });
            }
        });

    });

    $(document).ready(function() {
        $(document).on("click", ".tab-link", function() {
            $(".tab-link").removeClass("active");
            $(this).addClass("active");

            var mytabcls = $(this).attr("data-tabc");

            $(".coupon-dstab").removeClass("active");
            $(mytabcls).addClass("active");

        });


        // toggle password 
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
    });
</script>

<script>
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

    function sendOtpVendorEdit() {
        var vuserName = $("#vuserName").val();
        $.ajax({
            url: "ajax/otp.php",
            type: "POST",
            async: false,
            data: {
                vuserName: vuserName,
                type: 'sendOtpVendorEdit',
                usertype: 'vendor'
            },

        });
    }

    function emialVerificationVendorProfile() {
        let emialVerificationVendorProfile;
        var vuserName = $("#vuserName").val();
        $.ajax({
            url: "ajax/vendor.php",
            type: "POST",
            async: false,
            data: {
                vuserName: vuserName,
                type: 'emialVerificationVendorProfile',
                usertype: 'vendor'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    emialVerificationVendorProfile = data.par;
                } else {

                    emialVerificationVendorProfile = data.par;
                }
            }

        });
        return emialVerificationVendorProfile;
    }

    $(document).on("click", "#verVendorEditOtp", function() {
        var vuserName = $("#vuserName").val();
        var vEditOtp = $("#vEditOtp").val();
        $.ajax({
            url: "ajax/otp.php",
            type: "POST",
            async: false,
            data: {
                vuserName: vuserName,
                vEditOtp: vEditOtp,
                type: 'verOtpVendorEdit',
                usertype: 'vendor'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    $("#editOtpSec").hide();
                    $("#saveVendorProfile").removeAttr('disabled', 'disabled');
                    $("#saveVendorProfile").text("Finish Edit");
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#vEditOtp").val('');
                }

            }

        });
    });

    $(document).on("click", "#saveVendorProfile", function() {
        var vuserName = $("#vuserName").val();
        var vFirstName = $("#vFirstName").val();
        var VlastName = $("#VlastName").val();
        var mbName = $("#mbName").val();
        var cpName = $("#cpName").val();
        var cpEmail = $("#cpEmail").val();
        var cpNum = $("#cpNum").val();
        var Bustypev = $("#Bustypev").val();
        var BusCatv = $("#BusCatv").val();
        var vGst = $("#vGst").val();
        var vLandline = $("#vLandline").val();
        var vAddr1 = $("#vAddr1").val();
        var vAddr2 = $("#vAddr2").val();
        var vCity = $("#vCity").val();
        var vState = $("#vState").val();
        var vPinCode = $("#vPinCode").val();
        var vMobVer = mobileVerified();
        var vEmailVer = emialVerificationVendorProfile();

        if (vEmailVer !== "1" && vEmailVer == "0") {
            swicon = "warning";
            msg = "Please Verify Email id!";
            srbSweetAlret(msg, swicon);

        } else if (vMobVer !== "1" && vMobVer == "0") {
            $("#editOtpSec").show();
            $("#saveVendorProfile").attr('disabled', 'disabled');
            sendOtpVendorEdit();
            swicon = "warning";
            msg = "Please Verify Mobile";
            srbSweetAlret(msg, swicon);

        } else {
            $.ajax({
                type: "POST",
                url: "ajax/vendor.php",
                data: {
                    vuserName: vuserName,
                    vFirstName: vFirstName,
                    VlastName: VlastName,
                    mbName: mbName,
                    cpName: cpName,
                    cpEmail: cpEmail,
                    cpNum: cpNum,
                    Bustypev: Bustypev,
                    BusCatv: BusCatv,
                    vGst: vGst,
                    vLandline: vLandline,
                    vAddr1: vAddr1,
                    vAddr2: vAddr2,
                    vCity: vCity,
                    vState: vState,
                    vPinCode: vPinCode,
                    type: 'EditVendorDet'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.reload();
                        }, 3000);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        $("#VendorEmailverifyOtp").val('');
                    }

                }
            });
        }


    });
</script>

<script>
    $(document).on("submit", "#addVendorDealForm", function(e) {
        e.preventDefault();

        var dStartTime = $('#DealStartTime').val()
        var dEndTime = $('#DealEndTime').val();
        var datePicker = $('#datePicker').val();
        var dateEnd = $('#dateEnd').val();

        if (($('#lastMintDeal').val() == 'Yes') && (dateEnd > datePicker) && (dEndTime > dStartTime)) {
            swicon = "warning";
            msg = "Deal End Time Can't Be More Than 24 Hours... ";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                url: 'ajax/add-deal.php',
                type: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#submitAdddealBtn").attr('disabled', 'disabled');
                    $("#submitAdddealBtn").text("Please Wait...");
                    $("#loader").fadeIn(300);
                },
                complete: function() {
                    $("#submitAdddealBtn").removeAttr('disabled');
                    $("#submitAdddealBtn").text("Finish");
                    $("#loader").fadeOut(300);
                },
                success: function(data) {
                    if (data.status == 1) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.reload();
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



    $(document).on("submit", "#storeBrandForm", function(e) {
        e.preventDefault();
        var VendorId = $("#VendorId").val();
        var storeName = $("#storeName").val();
        var preciseLocation = $("#autocomplete").val();
        var busLoc = $('#busLoc').val();

        if (storeName == "") {
            swicon = "warning";
            msg = "Store Name Not Entered";
            srbSweetAlret(msg, swicon);
        } else if (busLoc == "") {
            swicon = "warning";
            msg = "Store Locality Not Selected";
            srbSweetAlret(msg, swicon);
        } else if (preciseLocation == "") {
            swicon = "warning";
            msg = "Store Location Not Entered";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                url: 'ajax/vendor.php',
                type: 'POST',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#submitAdddealBtn").text("Please Wait");
                },
                complete: function() {
                    $("#submitAdddealBtn").text("Finish");
                },
                success: function(data) {
                    if (data.status == 1) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.reload();
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

    $(document).on("click", "#dltDeal", function() {
        var dealId = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                $.ajax({
                    url: "ajax/add-deal.php",
                    type: "POST",
                    async: false,
                    data: {
                        dealId: dealId,
                        type: 'dltDeal'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status == 1) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            window.setTimeout(function() {
                                location.reload();
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
    });

    $(document).on("click", "#hideDeal", function() {
        var dealId = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to hide this deal!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Hide this deal !'
        }).then((result) => {
            if (result.isConfirmed) {
                // console.log(result);
                Swal.fire(
                    'Hidden!',
                    'Your Deal has been Hidden.',
                    'success'
                )
                $.ajax({
                    url: "ajax/add-deal.php",
                    type: "POST",
                    async: false,
                    data: {
                        dealId: dealId,
                        type: 'hideDeal'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status == 1) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            window.setTimeout(function() {
                                location.reload();
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
    });
    $(document).on("click", "#showDeal", function() {
        var dealId = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to show this deal!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, show this deal !'
        }).then((result) => {
            if (result.isConfirmed) {
                // console.log(result);
                Swal.fire(
                    'Hidden!',
                    'Your Deal has been Hidden.',
                    'success'
                )
                $.ajax({
                    url: "ajax/add-deal.php",
                    type: "POST",
                    async: false,
                    data: {
                        dealId: dealId,
                        type: 'showDeal'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status == 1) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            window.setTimeout(function() {
                                location.reload();
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
    });
</script>


<script>
    document.getElementById("datePicker").min = new Date().getFullYear() + "-" + parseInt(new Date().getMonth() + 1) + "-" +
        new Date().getDate()

    document.getElementById("dateEnd").min = new Date().getFullYear() + "-" + parseInt(new Date().getMonth() + 1) + "-" +
        new Date().getDate()
</script>
<script>
    // disable previous dates
    var currentDate = new Date().toISOString().split("T")[0];
    $("#datePicker").attr('min', currentDate);
    $("#dateEnd").attr('min', currentDate);

    // offer expire date change automatically js
    $(document).on("change", "#datePicker", function() {
        // offer start date
        var mydate = $(this).val();
        $("#dateEnd").attr('min', mydate);

        if ($('#lastMintDeal').val() == "Yes") {
            var startDate = $("#datePicker").val()
            var date = new Date(startDate)
            var d = date.setDate(date.getDate() + 1)
            var maxDate = new Date(d).toISOString().split("T")[0]
            $("#dateEnd").attr('max', maxDate);
        } else {
            $("#dateEnd").attr('max', '');
        }
    });

    $('#lastMintDeal').on('change', function() {
        $("#datePicker").val('');
        $("#dateEnd").val('');
        console.log($("#datePicker").val());
        console.log($("#dateEnd").val());

    })

    if ((window.location.href).includes('#')) {
        var url = (window.location.href).split('#')[1];
        // console.log(url);
        if (url != "") {
            $('.vProbar').removeClass('Active');
            $('a[href=#' + url + ']').addClass('Active');
            $('.coupon-dstab').removeClass('active');
            $('div[data-value=' + url + ']').addClass('active');

        } else {
            $('a[href=#dashboard]').addClass('Active');
            $('div[data-value=dashboard]').addClass('active');
        }
    }
</script>