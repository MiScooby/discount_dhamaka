<?php include('includes/header.php');


if (!isset($_SESSION['LoggedInVendor']) && $_SESSION['LoggedInVendor'] == '') {
    header('location:login.php');
}
$vendorBySession = $_SESSION['LoggedInVendor'];
$getVndr_det = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vendorBySession' AND `status`='Active' ");
$VenDor = mysqli_fetch_array($getVndr_det);

$getCat_det = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$VenDor[business_cat]' AND `status`='Active' ");
$VenCat = mysqli_fetch_array($getCat_det);

// if(isset($data)){
//     print_r($data);
//     die();
// }
?>
<link rel="stylesheet" href="assets/css/profile.css">
<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
<link rel="stylesheet" href="assets/datatables.net-bs5/dataTables.bootstrap5.css">
<link rel="stylesheet" type="text/css" href="assets/css/v-profile.css">
<style>
    input#VendorEmailverifyOtp {
        padding: 15px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .select2-container {
        box-sizing: border-box;
        display: block;
        margin: 0;
        position: relative;
    }


    form.row.g-3 {
        padding: 0px 23px;
    }

    button.btn.btn-primary.top_to {
        margin-bottom: 13px;
        margin-top: 10px;
        width: 101px;
        border-radius: 27px;
    }

    .card_myy {
        margin-bottom: 1.875rem;
        background-color: #fff;
        transition: all .5s ease-in-out;
        position: relative;
        border: 0px solid transparent;
        height: calc(100% - 30px);
        border: 1px solid #eeeeee;
        border-radius: 16px;
        height: 200px;
        display: flex;
        align-items: center;
    }

    h2.text-white.card-balance {
        max-width: 500px;
        margin-bottom: 20px;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        background-color: transparent;
        color: #777;
        border-radius: 0;
        border: 1px solid #eeeeee !important;
        height: 38px;
        -webkit-box-shadow: none;
        box-shadow: none;
        outline: none;
        min-height: 38px;
        padding: 6px;
    }

    .Storedesc {
        padding: 10px;
        background-color: #eeeeee;
        border-radius: 5px;
        margin-bottom: 5px;
    }

    .srb-fs-12 {
        font-size: 12px;
        padding: 0;
        margin: 0;
        line-height: 20px;
        margin-bottom: 10px;
    }

    .lmdealbtn {
        text-align: center;
        padding: 5px;
        height: 30px;
        line-height: 20px;
        border-radius: 5px;
        width: 100%;
    }

    .mand {
        color: red;
    }

    .swal2-title {
        position: relative;
        max-width: 100%;
        margin: 0;
        padding: 5px 0 0;
        color: inherit;
        font-size: 20px;
        font-weight: 600;
        text-align: center;
        text-transform: none;
        word-wrap: break-word;
    }

    .swal2-html-container {
        z-index: 1;
        justify-content: center;
        margin: 10px 0 0;
        padding: 0;
        overflow: auto;
        color: inherit;
        font-size: 14px;
        font-weight: 400;
        line-height: normal;
        text-align: center;
        word-wrap: break-word;
        word-break: break-word;
    }

    .swal2-icon {
        position: relative;
        box-sizing: content-box;
        justify-content: center;
        width: 5em;
        height: 5em;
        margin: 1.5em auto 0.6em;
        border: 0.25em solid transparent;
        border-radius: 50%;
        border-color: #000;
        font-family: inherit;
        line-height: 5em;
        cursor: default;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .swal2-popup {
        display: none;
        position: relative;
        box-sizing: border-box;
        grid-template-columns: minmax(0, 100%);
        width: 25em;
        max-width: 100%;
        padding: 0 0 1.25em;
        border: none;
        border-radius: 5px;
        background: #fff;
        color: #545454;
        font-family: inherit;
        font-size: 1rem;
    }
</style>


<?php
$checkLMDealQ = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE `vendor_id`='$VenDor[id]' ");
$checkLMDealCount = mysqli_num_rows($checkLMDealQ);
$checkLMDeal = mysqli_fetch_array($checkLMDealQ);


$VedDealQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `vendor_id`='$VenDor[id]' ");
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
                                <img class="v-img" src="assets/images/user/1.png" alt="vendor image">
                                <h5><?= $VenDor['merchant_bus_name'] ?></h5>
                            </div>
                            <div class="ec-vendor-block-items">
                                <ul>
                                    <li><a href="vendor-profile.php" class="tab-link active" data-tabc=".dashboard-prf-tab"><i class="fa fa-home"></i> Dashboard</a></li>

                                    <li><a href="vendor-profile.php" class="tab-link" data-tabc=".dash-prf-tab"><i class="fa fa-user"></i> My Profile</a></li>

                                    <li><a href="vendor-profile.php" class="tab-link" data-tabc=".brand-prf-tab"><i class="fa fa-bandcamp"></i> Brand</a></li>

                                    <li><a href="vendor-profile.php" class="tab-link" data-tabc=".edit-prf-tab"><i class="fa fa-tag"></i> Deals</a></li>

                                    <li><a href="javascript:void(0);" onclick="logout()" class="logouttb"><i class="fa fa-sign-out "></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="coupon-dstab active dashboard-prf-tab">
                        <div class="ec-vendor-card-body">
                            <?php


                            $vendorBySession = $_SESSION['LoggedInVendor'];
                            $getVndr_det = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vendorBySession' AND `status`='Active' ");
                            $VenDor = mysqli_fetch_array($getVndr_det);

                            $getCat_det = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$VenDor[business_cat]' AND `status`='Active' ");
                            $VenCat = mysqli_fetch_array($getCat_det);


                            $checkLMDealQ = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE `vendor_id`='$VenDor[id]' ");
                            $checkLMDealCount = mysqli_num_rows($checkLMDealQ);
                            $checkLMDeal = mysqli_fetch_array($checkLMDealQ);


                            $VedDealQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `vendor_id`='$VenDor[id]' ");
                            $VedDealCount = mysqli_num_rows($VedDealQ);


                            if (isset($_GET['id'])) {
                                $id = $_GET['id'];
                                $data = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM offer_deals WHERE id =  $id")); ?>


                                <form action="javascript:void(0)" method="post" class="row g-3" id="editVendorDealForm" enctype="multipart/form-data">
                                    <input type="hidden" id="deal_id" value="<?= $data['id']; ?>" name="dealId">
                                    <div class="col-md-12 space-t-15">
                                        <label class="form-label">Offer Title <span class="mand">*</span></label>
                                        <input type="text" name="DealOffertitle" id="DealOffertitle" readonly class="form-control" value="<?= $data['offer_title']; ?>">
                                        <span class="discri">Input title for the offer.</span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-3">
                                        <label class="form-label">Deal Description <span class="mand">*</span></label>
                                        <textarea id="myDesc_two" name="DealDesc" rows="10" cols="80" required="" readonly><?= $data['offer_desc']; ?></textarea>
                                        <span class="discri">Input description of the offer.</span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-2">

                                        <label class="form-label">Offer Image </label><br>

                                        <img src="upload/deals-img/<?= $data['offer_img']; ?>" alt="" width="200px">
                                        <input type="file" name="dealOfferImg" disabled class="form-control" onchange="validateimg(this)" id="dealOfferImg" accept="image/*" style="padding-top:14px !important;" value="<?= $data['id']; ?>">
                                        <span class="discri">Upload and select featured image for the offer. Make Sure Image Size Will be 400*300 </span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-4">
                                        <label class="form-label">Offer Category <span class="mand">*</span></label><br>
                                        <input class="form-control mb-1" value="<?= $VenDor['business_cat'] ?>" name="DealCategory" readonly type="hidden" />
                                        <select class="select_tws form-control mb-1" disabled>
                                            <option value="<?= $VenDor['business_cat'] ?>"><?= $VenCat['cat_name'] ?></option>

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
                                                    <option value="<?= $SubCatDorlist['id'] ?>"><?= $SubCatDorlist['sub_cat_name'] ?></option>
                                                <?php
                                                }
                                                ?>

                                            </select>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <?php
                                    if ($checkLMDealCount > 0) {
                                    ?>
                                        <div class="col-md-12 space-t-15  mt-3 d-flex align-items-center">
                                            <label class="form-label p-0 mr-2">Last Minute Deals</label>
                                            <select class="select_tws form-control w-50" id="lastMintDeal" name="lastMintDeal">
                                                <option value="Yes">Yes</option>
                                                <option value="No" selected>No</option>
                                            </select>
                                        </div>
                                    <?php
                                    }
                                    ?>


                                    <div class="col-md-12 space-t-15 mt-4">
                                        <label>Offer Start Date: <span class="mand">*</span></label>

                                        <input class="form-control" id="datePicker" name="DealStartDate" required type="date" value="<?= $data['offer_start_date']; ?>" />

                                        <input class="form-control dealstrtime" required name="DealStartTime" type="time" value="<?= $data['offer_start_time']; ?>" />
                                        <span class="discri">Set start date for the offer. If this field is empty current time will be applied to the offer.</span>
                                    </div>

                                    <div class="col-md-12 space-t-15 mt-4">
                                        <label>Offer Expire Date: <span class="mand">*</span></label>

                                        <input required class="form-control" id="dateEnd" name="DealEndDate" type="date" value="<?= $data['offer_end_date']; ?>" />

                                        <input required id="DealEndTime" class="form-control dealendtime" name="DealEndTime" type="time" value="<?= $data['offer_end_time']; ?>" />
                                        <span class="discri">Set end date for the offer.</span>
                                    </div>

                                    <div class="col-md-12 space-t-15 mt-2">
                                        <label class="form-label">Deal Items</label>
                                        <input type="number" name="dealItems" id="dealItems" class="form-control" value="<?= $data['deal_times']; ?>">
                                        <span class="discri">Input number of deal items will be available for offer. Incase you dont fill this filed uour deal item count will unlimited</span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-2">
                                        <label class="form-label">Deal Images <span class="mand">*</span></label><br>
                                        <?php
                                        $deid =  $data['id'];

                                        $ed = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$deid'");
                                        while ($edimg = mysqli_fetch_array($ed)) {
                                        ?>
                                            <div> <img src="upload/deals-img/<?=$edimg['deal_img'];?>" alt="" width="200px">
                                            </div>
                                        <?php
                                        }
                                        ?>

                                        <br>

                                        <input type="file" disabled name="dealImg[]" multiple class="form-control" onchange="validateimg(this)" accept="image/*" style="padding-top:14px !important;">
                                        <span class="discri">Choose images for the deal. Drag and drop to change their order. Make Sure Image Size Will be 400*300 </span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea type="text" readonly name="deal_shortdesc" id="deal_excerpt" class="form-control" spellcheck="false" placeholder="Description"> <?= $data['deal_short_desc']; ?></textarea>
                                        <span class="discri">Input description which will appear in the deal single page sidebar.</span>

                                    </div>
                                    <div class="col-md-12 space-t-15  mt-3">
                                        <label class="form-label">Deal Features </label>
                                        <input type="text" readonly maxlength="15" name="dealFeauture" id="dealFeauture" class="form-control" value="<?= $data['deal_feature']; ?>">

                                    </div>

                                    <div class="col-md-12  space-t-15 mt-3">
                                        <input type="hidden" name="editVendorDeal" value="editVendorDeal">
                                        <input type="hidden" name="VendorId" value="<?= $data['vendor_id']; ?>">

                                        <button type="submit" class="btn btn-primary ">Finish</button>
                                    </div>

                                </form>
                                <script>
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
                                                        console.log(height);
                                                        if ((height > 500 || width > 500) || (height < 200 || width < 200)) {
                                                            swicon = "warning";
                                                            msg = "You Have to upload a Max 500*500 & Min 200*200 photo size.";
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
                                </script>
                            <?php }
                            ?>

                        </div>
                    </div>
                    <div class="coupon-dstab  brand-prf-tab">
                        <div class="ec-vendor-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="row g-3">
                                        <?php
                                        $brandQuery = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$VenDor[id]'");
                                        $storeCountBrnd = mysqli_num_rows($brandQuery);
                                        $getBrandStore = mysqli_fetch_array($brandQuery);
                                        ?>
                                        <div class="col-md-12 space-t-15">
                                            <label class="form-label">Store Name</label>
                                            <input type="text" class="form-control" <?= (!empty($getBrandStore['store_name'])) ? 'value="' . $getBrandStore['store_name'] . '"' : ' '; ?> id="storeName" placeholder="Store Name">

                                        </div>
                                        <div class="col-md-12 space-t-15 mt-3">
                                            <label class="form-label">Store Description</label>

                                            <textarea id="myDesc" rows="10" cols="80" required="">
                                            <?= (!empty($getBrandStore['store_desc'])) ? '' . $getBrandStore['store_desc'] . '' : ' '; ?>
                                            </textarea>
                                        </div>

                                        <div class="col-md-12 space-t-15 mt-3">
                                            <label class="form-label">Precise Locations</label>

                                            <div id="locationField">
                                                <input id="autocomplete" <?= (!empty($getBrandStore['store_location'])) ? 'value="' . $getBrandStore['store_location'] . '"' : ' '; ?> class="form-control" placeholder="Precise Locations" type="text"></input>
                                            </div>

                                        </div>
                                        <div class="col-md-12 space-t-15 mt-4">
                                            <div id="map" style="height: 350px;"></div>
                                            <div id="infowindow-content">
                                                <!-- <img src="" width="16" height="16" id="place-icon"> -->
                                                <span id="place-name" class="title"></span><br>
                                                <span id="place-address"></span>
                                            </div>

                                        </div>

                                        <div class="col-md-12 space-t-15">
                                            <button type="button" <?= ($storeCountBrnd == 1) ? 'id="EditStoreBrand"' : 'id="SaveStoreBrand"'; ?> class="btn btn-primary top_to"> <?= ($storeCountBrnd == 1) ? 'Edit Brand' : 'Save Brand'; ?></button>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="coupon-dstab  dash-prf-tab">
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
                                                                <p>Hi, <span><?= $VenDor['f_name']; ?></span>, you have total no. of <strong>0</strong> deals</p>
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
                                                            <input type="text" class="form-control" id="vFirstName" value="<?= $VenDor['f_name'] ?>">

                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Last Name</label>
                                                            <input type="text" class="form-control" id="VlastName" value="<?= $VenDor['l_name'] ?>">

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
                                                            <label class="form-label" for="countrycode">Country Code</label>
                                                            <input type="text" class="form-control" value="<?= $VenDor['c_code'] ?>" disabled placeholder="Enter Country Code" disabled>
                                                            <span class="frmicon env"><i class="fa fa-globe"></i></span>
                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Mobile </label>

                                                            <input type="text" class="form-control" value="<?= $VenDor['mobile_num'] ?>" placeholder="Enter Mobile Number" disabled>
                                                            <span class="frmicon env"><i class="fa fa-phone-alt"></i></span>
                                                        </div>
                                                        <!-- <div class="col-md-6 space-t-15 pass1">
                                                            <label class="form-label">Password</label>
                                                            <input type="password" class="form-control" id="venDorPass">
                                                            <span class="frmicon"><i class="fa fa-lock"></i></span>
                                                            <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                                                        </div>
                                                        <div class="col-md-6 space-t-15 pass2">
                                                            <label class="form-label">Repeat Password</label>
                                                            <input type="password" class="form-control" placeholder="******">
                                                            <span class="frmicon"><i class="fa fa-lock"></i></span>
                                                            <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                                                        </div> -->
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Merchant Business Name</label>
                                                            <input type="text" class="form-control" id="mbName" value="<?= $VenDor['merchant_bus_name'] ?>" placeholder="Business Name">

                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Busines Type</label>
                                                            <div class="select-wrapper">
                                                                <select class="select_tws form-control" id="Bustypev" disabled>

                                                                    <option value="Single Store" <?= ('Single Store' == $VenDor['business_type']) ? 'Selected' : ''; ?>>Single Store </option>
                                                                    <option value="Multi Store" <?= ('Multi Store' == $VenDor['business_type']) ? 'Selected' : ''; ?>>Multi Store</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Busines Category</label>
                                                            <div class="select-wrapper">
                                                                <select class="select_tws form-control" id="BusCatv">
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
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Contact Person Name</label>
                                                            <input type="text" class="form-control" id="cpName" value="<?= $VenDor['cp_name'] ?>" placeholder="Person Name">

                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Contact Person Email</label>
                                                            <input disabled type="email" id="cpEmail" value="<?= $VenDor['cp_email'] ?>" class="form-control" placeholder="Enter Email Id">
                                                            <span class="frmicon env"><i class="fa fa-envelope"></i></span>
                                                        </div>
                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">Contact Person Mobile</label>

                                                            <input type="text" class="form-control" id="cpNum" value="<?= $VenDor['cp_num'] ?>" placeholder="Enter Mobile Number">
                                                            <span class="frmicon env"><i class="fa fa-envelope"></i></span>
                                                        </div>

                                                        <div class="col-md-4 space-t-15">
                                                            <label class="form-label">GST No.</label>
                                                            <input type="text" class="form-control" id="vGst" placeholder="GST No" <?= ($VenDor['gst_num'] !== "n/a") ? 'value="' . $VenDor['gst_num'] . '"' : ''; ?>>

                                                        </div>
                                                        <div class="col-md-6 space-t-15">
                                                            <label class="form-label">Landline No.</label>
                                                            <input type="number" id="vLandline" class="form-control" <?= ($VenDor['landline_num'] !== "n/a") ? 'value="' . $VenDor['landline_num'] . '"' : ''; ?>>

                                                        </div>


                                                        <div class="row">
                                                            <div class="col-md-6 space-t-15">
                                                                <label class="form-label">Address 1</label>
                                                                <input type="text" id="vAddr1" class="form-control" placeholder="Address 1" value="<?= $VenDor['address_1'] ?>">
                                                                <span class="frmicon"><i class="fa fa-address-book"></i></span>
                                                            </div>
                                                            <div class="col-md-6 space-t-15">
                                                                <label class="form-label">Address 2 </label>
                                                                <input type="text" id="vAddr2" class="form-control" placeholder="Address 2" <?= ($VenDor['address_2'] !== "n/a") ? 'value="' . $VenDor['address_2'] . '"' : ''; ?>>
                                                                <span class="frmicon"><i class="fa fa-address-book"></i></span>
                                                            </div>
                                                            <div class="col-md-4 space-t-15">
                                                                <label class="form-label">City </label>
                                                                <input type="text" id="vCity" class="form-control" placeholder="City" value="<?= $VenDor['city'] ?>">

                                                            </div>
                                                            <div class="col-md-4 space-t-15">
                                                                <label class="form-label">State </label>
                                                                <input type="text" id="vState" value="<?= $VenDor['state'] ?>" class="form-control" placeholder="State ">

                                                            </div>
                                                            <div class="col-md-4 space-t-15">
                                                                <label class="form-label">Pincode </label>
                                                                <input type="text" id="vPinCode" value="<?= $VenDor['pin_code'] ?>" class="form-control" placeholder="Pincode">

                                                            </div>


                                                            <div class="col-md-6 space-t-15" id="editOtpSec" style="display: none;">
                                                                <label class="form-label">Verify Otp For Edit Profile </label>
                                                                <div class="d-flex">

                                                                    <input type="text" id="vEditOtp" class="form-control" placeholder="Enter Otp">
                                                                    <button type="button" id="verVendorEditOtp" class="btn btn-primary" style="height: 38px; line-height: 38px;">Verify Otp</button>
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

                    <div class="coupon-dstab edit-prf-tab">

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
                                                    <a href="#" class="btn add_to_btn dealFormBtn clickaddeal" data-id=".add_dealfrm">Add Deal</a>
                                                    <a href="#" class="btn add_to_btn dealFormBtn  cancelAddDeal" data-id=".add_dealfrm">Cancel Deal</a>
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
                                                            <th>Deal</th>
                                                            <th>Status</th>
                                                            <th>Categories</th>
                                                            <th> Deals</th>
                                                            <th>Clicks</th>
                                                            <th>Views</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $dealQuer = mysqli_query($con, "SELECT od.*, c.cat_name FROM offer_deals od, category c WHERE `vendor_id`='$VenDor[id]' AND od.offer_cat=c.id AND od.is_deleted='0'");

                                                        while ($dealQuerList = mysqli_fetch_array($dealQuer)) {
                                                        ?>
                                                            <tr>
                                                                <td><span class="order_id"><?= $dealQuerList['offer_title'] ?></span></td>
                                                                <td>
                                                                    <span class="order_date"><?= ($dealQuerList['status'] == 1) ? 'Active' : 'Inactive'; ?></span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id"><?= $dealQuerList['cat_name'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id"><?= $dealQuerList['deal_times'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id">
                                                                        <?= $dealQuerList['click'] ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span class="order_id">
                                                                        <?= $dealQuerList['view'] ?>
                                                                    </span>
                                                                </td>

                                                                <td>
                                                                    <ul class="add_btns">

                                                                        <li>
                                                                            <a href="edit_deal.php?id=<?= $dealQuerList['id'] ?>" style="padding:0;" type="submit" name="editDealBtn"><i class="fa fa-edit" aria-hidden="true" style="color: orange;"></i></a>
                                                                        </li>

                                                                        <li>
                                                                            <?= ($dealQuerList['status'] == "1") ? '<a href="javascript:void(0)" data-id="' . $dealQuerList['id'] . '"  id="hideDeal" title="Hide Deal"><i class="fa fa-eye-slash" aria-hidden="true" style="color: red;"></i></a>' : '<a href="javascript:void(0)" data-id="' . $dealQuerList['id'] . '"  id="showDeal" title="Show Deal"><i class="fa fa-eye" aria-hidden="true" style="color: #02cc60;"></i></a>'; ?>

                                                                        </li>


                                                                        <li>
                                                                            <a href="javascript:void(0)" title="Delete Deal" data-id="<?= $dealQuerList['id'] ?>" id="dltDeal"><i class="fa fa-times" aria-hidden="true" style="color: red;"></i></a>
                                                                        </li>
                                                                    </ul>

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
                                                        <input type="text" name="DealOffertitle" id="DealOffertitle" required class="form-control">
                                                        <span class="discri">Input title for the offer.</span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-3">
                                                        <label class="form-label">Deal Description <span class="mand">*</span></label>
                                                        <textarea id="myDesc_two" name="DealDesc" rows="10" cols="80" required="" required></textarea>
                                                        <span class="discri">Input description of the offer.</span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-2">
                                                        <label class="form-label">Offer Image <span class="mand">*</span></label><br>
                                                        <input type="file" name="dealOfferImg" required class="form-control" onchange="validateimg(this)" id="dealOfferImg" accept="image/*" style="padding-top:14px !important;">
                                                        <span class="discri">Upload and select featured image for the offer. Make Sure Image Size Will be 400*300 </span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-4">
                                                        <label class="form-label">Offer Category <span class="mand">*</span></label><br>
                                                        <input class="form-control mb-1" value="<?= $VenDor['business_cat'] ?>" name="DealCategory" readonly type="hidden" />
                                                        <select class="select_tws form-control mb-1" disabled>
                                                            <option value="<?= $VenDor['business_cat'] ?>"><?= $VenCat['cat_name'] ?></option>

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
                                                                    <option value="<?= $SubCatDorlist['id'] ?>"><?= $SubCatDorlist['sub_cat_name'] ?></option>
                                                                <?php
                                                                }
                                                                ?>

                                                            </select>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <?php
                                                    if ($checkLMDealCount > 0) {
                                                    ?>
                                                        <div class="col-md-12 space-t-15  mt-3 d-flex align-items-center">
                                                            <label class="form-label p-0 mr-2">Last Minute Deals</label>
                                                            <select class="select_tws form-control w-50" id="lastMintDeal" name="lastMintDeal">
                                                                <option value="Yes">Yes</option>
                                                                <option value="No" selected>No</option>
                                                            </select>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>


                                                    <div class="col-md-12 space-t-15 mt-4">
                                                        <label>Offer Start Date: <span class="mand">*</span></label>

                                                        <input class="form-control" id="datePicker" name="DealStartDate" required type="date" />

                                                        <input class="form-control dealstrtime" required name="DealStartTime" type="time" />
                                                        <span class="discri">Set start date for the offer. If this field is empty current time will be applied to the offer.</span>
                                                    </div>

                                                    <div class="col-md-12 space-t-15 mt-4">
                                                        <label>Offer Expire Date: <span class="mand">*</span></label>

                                                        <input required class="form-control" id="dateEnd" name="DealEndDate" type="date" />

                                                        <input required id="DealEndTime" class="form-control dealendtime" name="DealEndTime" type="time" />
                                                        <span class="discri">Set end date for the offer.</span>
                                                    </div>

                                                    <div class="col-md-12 space-t-15 mt-2">
                                                        <label class="form-label">Deal Items</label>
                                                        <input type="number" name="dealItems" id="dealItems" class="form-control">
                                                        <span class="discri">Input number of deal items will be available for offer. Incase you dont fill this filed uour deal item count will unlimited</span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-2">
                                                        <label class="form-label">Deal Images <span class="mand">*</span></label><br>
                                                        <input type="file" name="dealImg[]" multiple class="form-control" onchange="validateimg(this)" accept="image/*" style="padding-top:14px !important;">
                                                        <span class="discri">Choose images for the deal. Drag and drop to change their order. Make Sure Image Size Will be 400*300 </span>
                                                    </div>
                                                    <div class="col-md-12 space-t-15 mt-3">
                                                        <label class="form-label">Short Description</label>
                                                        <textarea type="text" name="deal_shortdesc" id="deal_excerpt" class="form-control" spellcheck="false" placeholder="Description"></textarea>
                                                        <span class="discri">Input description which will appear in the deal single page sidebar.</span>

                                                    </div>
                                                    <div class="col-md-12 space-t-15  mt-3">
                                                        <label class="form-label">Deal Features </label>
                                                        <input type="text" maxlength="15" name="dealFeauture" id="dealFeauture" class="form-control">

                                                    </div>

                                                    <div class="col-md-12  space-t-15 mt-3">
                                                        <input type="hidden" name="addVendorDeal" value="addVendorDeal">
                                                        <input type="hidden" name="VendorId" value="<?= $VenDor['id'] ?>">

                                                        <button type="submit" class="btn btn-primary add_to_btn_to">Finish</button>
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
                                            <p style="background:#f0fff9;color:indianred;padding:8px 0;border-radius:19px;font-size:14px;font-weight:600;text-transform:uppercase;">You have to add <span style="border-bottom:1px solid #cd5c5c66;">brand store information</span> to <span style="border-bottom:1px solid #cd5c5c66;">add Deals</span></p>
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
                                        <p>You Don't Have Any Subscription for Add Deals. Please Subscribe Our Membership by click below Button</p>
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
                                            <label for="VenemailAddressVer" class="form-label fw-500">Email Address</label>
                                            <div class="myrwdiv">
                                                <input type="email" class="form-control bg-light border-light" id="VenemailAddressVer" value="<?= $VenDor['email_id'] ?>" disabled placeholder="Enter Email Address">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row justify-content-center" id="otpVerSec">
                                    <div class="col-md-5">
                                        <div class="mb-3">
                                            <label for="VendorEmailverifyOtp" class="form-label fw-500">Verify OTP</label>
                                            <div class="myrwdiv">
                                                <input type="text" class="form-control bg-light border-light" id="VendorEmailverifyOtp" required="" maxlength="4" disabled placeholder="Verify OTP">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="mb-3 veribtn">
                                            <button type="button" id="sendEmailotp" class="myotpbtn">Send Verification OTP</button>
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
<script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>
<script src="assets/datatables.net/jquery.dataTables.js"></script>
<script src="assets/datatables.net-bs5/dataTables.bootstrap5.js"></script>

<script>
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
                        console.log(height);
                        if ((height > 500 || width > 500) || (height < 200 || width < 200)) {
                            swicon = "warning";
                            msg = "You Have to upload a Max 500*500 & Min 200*200 photo size.";
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
</script>

<script>
    var input = document.getElementById('autocomplete');

    function initMap() {
        var geocoder;
        var autocomplete;

        geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 28.7041,
                lng: 77.1025
            },
            zoom: 9,
            mapTypeControl: false,
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
                        console.log(autocomplete);
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
        $('#dtBasicExample').DataTable();

    });
    $("#BusCatv").select2({
        placeholder: "Select category"
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
    CKEDITOR.replace('myDesc', {
        toolbar: [{
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-']
            },
            {
                name: 'insert',
                items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
        ]
    });
    CKEDITOR.replace('myDesc_two', {

        toolbar: [{
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-']
            },
            {
                name: 'insert',
                items: ['Image']
            },

        ]
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
    $(document).on('change', "#dateEnd", () => {
        var dateEnd = $("#dateEnd").val();
        $('#datePicker').attr('max', dateEnd);
    });

    $(document).ready(function() {

        $('.cancelAddDeal').hide()
        // new change js-29-12-2022
        $(document).on("click", ".dealFormBtn", function() {

            $(".cancelAddDeal").toggle();
            $(".clickaddeal").toggle();
            $(".add_dealfrm").toggle("show");
            $(".tableDiv").toggleClass("active");
        });


        $(document).on("submit", "#editVendorDealForm", function() {
            $.ajax({
                type: "POST",
                url: "ajax/edit_deal.php",
                data: $("#editVendorDealForm").serialize(),
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.href = 'vendor-profile.php';
                        }, 2000);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                    $("#editVendorDealForm")[0].reset();

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
        $.ajax({
            url: 'ajax/add-deal.php',
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data.status == 1) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });

    });



    $(document).on("click", "#SaveStoreBrand", function() {
        var VendorId = $("#VendorId").val();
        var storeName = $("#storeName").val();
        var myDesc = CKEDITOR.instances['myDesc'].getData();
        var preciseLocation = $("#autocomplete").val();

        if (storeName == "") {
            swicon = "warning";
            msg = "Store Name Not Entered";
            srbSweetAlret(msg, swicon);
        } else if (myDesc == "") {
            swicon = "warning";
            msg = "Store Description Not Entered";
            srbSweetAlret(msg, swicon);
        } else if (preciseLocation == "") {
            swicon = "warning";
            msg = "Store Location Not Entered";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                url: "ajax/vendor.php",
                type: "POST",
                async: false,
                data: {
                    VendorId: VendorId,
                    storeName: storeName,
                    myDesc: myDesc,
                    preciseLocation: preciseLocation,
                    type: 'addBrandStore'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status == 1) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);

                    }

                }

            });
        }

    });



    $(document).on("click", "#EditStoreBrand", function() {
        var VendorId = $("#VendorId").val();
        var storeName = $("#storeName").val();
        var myDesc = CKEDITOR.instances['myDesc'].getData();
        var preciseLocation = $("#autocomplete").val();

        if (storeName == "") {
            swicon = "warning";
            msg = "Store Name Not Entered";
            srbSweetAlret(msg, swicon);
        } else if (myDesc == "") {
            swicon = "warning";
            msg = "Store Description Not Entered";
            srbSweetAlret(msg, swicon);
        } else if (preciseLocation == "") {
            swicon = "warning";
            msg = "Store Location Not Entered";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                url: "ajax/vendor.php",
                type: "POST",
                async: false,
                data: {
                    VendorId: VendorId,
                    storeName: storeName,
                    myDesc: myDesc,
                    preciseLocation: preciseLocation,
                    type: 'editBrandStore'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status == 1) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.reload();
                        }, 2000);
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
    document.getElementById("datePicker").min = new Date().getFullYear() + "-" + parseInt(new Date().getMonth() + 1) + "-" + new Date().getDate()

    document.getElementById("dateEnd").min = new Date().getFullYear() + "-" + parseInt(new Date().getMonth() + 1) + "-" + new Date().getDate()

    $(document).ready(function() {

        $(document).on("change", "#lastMintDeal", function() {

            if ($(this).val() == 'Yes') {

                // offer start date
                var mydate = new Date();

                const today1 = mydate;
                const yyyy1 = today1.getFullYear();
                let mm1 = today1.getMonth() + 1; // Months start at 0!
                let dd1 = today1.getDate();

                if (dd1 < 10) dd1 = '0' + dd1;
                if (mm1 < 10) mm1 = '0' + mm1;

                const formattedStartDate = yyyy1 + '-' + mm1 + '-' + dd1;

                $("#datePicker").val(formattedStartDate);

                // add 1 day in offer start date
                var theDate = new Date(mydate);
                var myNewDate = new Date(theDate);
                myNewDate.setDate(myNewDate.getDate() + 1);

                // date formater in yyyy-mm-dd
                const today = myNewDate;
                const yyyy = today.getFullYear();
                let mm = today.getMonth() + 1; // Months start at 0!
                let dd = today.getDate();

                if (dd < 10) dd = '0' + dd;
                if (mm < 10) mm = '0' + mm;

                const formattedNextDate = yyyy + '-' + mm + '-' + dd;

                $("#dateEnd").val(formattedNextDate);

                // disabled all date from selected date
                document.getElementById("dateEnd").min = new Date().getFullYear() + "-" + parseInt(new Date().getMonth() + 1) + "-" + new Date().getDate()

            } else {

                var todayDate = new Date();

                $("#datePicker").val(" ");
                $("#dateEnd").val(" ");

                document.getElementById("datePicker").min = new Date(todayDate).getFullYear() + "-" + parseInt(new Date(todayDate).getMonth() + 1) + "-" + new Date(todayDate).getDate()

                document.getElementById("dateEnd").min = new Date(todayDate).getFullYear() + "-" + parseInt(new Date(todayDate).getMonth() + 1) + "-" + new Date(todayDate).getDate()
            }

        });

        // offer expire date change automatically js
        $(document).on("change", "#datePicker", function() {

            // offer start date
            var mydate = $(this).val();

            // add 1 day in offer start date
            var theDate = new Date(mydate);
            var myNewDate = new Date(theDate);
            myNewDate.setDate(myNewDate.getDate() + 1);

            // date formater in yyyy-mm-dd
            const today = myNewDate;
            const yyyy = today.getFullYear();
            let mm = today.getMonth() + 1; // Months start at 0!
            let dd = today.getDate();

            if (dd < 10) dd = '0' + dd;
            if (mm < 10) mm = '0' + mm;

            const formattedNextDate = yyyy + '-' + mm + '-' + dd;

            // $("#dateEnd").val(formattedNextDate);

            // console.log(mydate);
            // console.log(formattedNextDate);

            // disabled all date from selected date
            document.getElementById("dateEnd").min = new Date(myNewDate).getFullYear() + "-" + parseInt(new Date(myNewDate).getMonth() + 1) + "-" + new Date(myNewDate).getDate()

        });



    });
</script>