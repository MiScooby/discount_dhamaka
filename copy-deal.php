<?php include('includes/header.php');


if (!isset($_SESSION['LoggedInVendor']) && $_SESSION['LoggedInVendor'] == '') {
    header('location:login.php');
}
$vendorBySession = $_SESSION['LoggedInVendor'];
$getVndr_det = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vendorBySession' AND `status`='Active' ");
$VenDor = mysqli_fetch_array($getVndr_det);

$getCat_det = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$VenDor[business_cat]' AND `status`='Active' ");
$VenCat = mysqli_fetch_array($getCat_det);

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


                                <form action="javascript:void(0)" method="post" class="row g-3" id="copyVendorDealForm" enctype="multipart/form-data">
                                    <input type="hidden" id="deal_id" value="<?= $data['id']; ?>" name="dealId">
                                    <div class="col-md-12 space-t-15">
                                        <label class="form-label">Offer Title <span class="mand">*</span></label>
                                        <input type="text" name="DealOffertitle" id="DealOffertitle" required class="form-control" maxlength="50" value="<?= $data['offer_title']; ?>">
                                        <span class="discri">Input title for the offer.</span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-3">
                                        <label class="form-label">Deal Description <span class="mand">*</span></label>
                                     
                                        <textarea id="editor" name="DealDesc" rows="10" cols="80" required="" required><?= $data['offer_desc']; ?></textarea>
                                        <span class="discri">Input description of the offer.</span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-2">

                                        <label class="form-label">Offer Image </label><br>

                                        <img src="upload/deals-img/<?= $data['offer_img']; ?>" alt="" width="100px" class="mb-2">
                                        <input type="file" name="dealOfferImg" class="form-control" onchange="validateimg(this)" id="dealOfferImg" accept="image/*" style="padding-top:14px !important;">
                                        <input type="hidden" name="dealOfferImgCopy" value="<?= $data['offer_img']; ?>">
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
                                        <input type="number" name="dealItems" id="dealItems" class="form-control" value="<?= $data['deal_times']; ?>">
                                        <span class="discri">Input number of deal items will be available for offer. Incase you dont fill this filed uour deal item count will unlimited</span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-2">
                                        <label class="form-label">Deal Images <span class="mand">*</span></label><br>
                                        <input type="file" name="dealImg[]" required multiple class="form-control" onchange="validateimg(this)" accept="image/*" style="padding-top:14px !important;">
                                        <span class="discri">Choose images for the deal. Drag and drop to change their order. Make Sure Image Size Will be 400*300 </span>
                                    </div>
                                    <div class="col-md-12 space-t-15 mt-3">
                                        <label class="form-label">Short Description</label>
                                        <textarea type="text" name="deal_shortdesc" id="deal_excerpt" class="form-control" spellcheck="false" placeholder="Description"> <?= $data['deal_short_desc']; ?></textarea>
                                        <span class="discri">Input description which will appear in the deal single page sidebar.</span>

                                    </div>
                                    <div class="col-md-12 space-t-15  mt-3">
                                        <label class="form-label">Deal Features </label>
                                        <input type="text" maxlength="15" name="dealFeauture" id="dealFeauture" class="form-control" value="<?= $data['deal_feature']; ?>">

                                    </div>

                                    <div class="col-md-12  space-t-15 mt-3">
                                        <input type="hidden" name="type" value="copyVendorDeal">
                                        <input type="hidden" name="VendorId" value="<?= $data['vendor_id']; ?>">

                                        <button type="submit" class="btn btn-primary ">Copy Deal</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>
<script src="assets/datatables.net/jquery.dataTables.js"></script>
<script src="assets/datatables.net-bs5/dataTables.bootstrap5.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/super-build/ckeditor.js"></script>

<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        toolbar: {
            items: [

                'heading', '|', 'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'fontSize', '|',

                'insertImage', '|',

                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },





        placeholder: 'Welcome to CKEditor 5!',


        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },




        removePlugins: [

            'CKBox',
            'CKFinder',
            'EasyImage',
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

            'MathType'
        ]
    });
</script>
<script>
    $("#lastMintDeal").select2({
        placeholder: "Is This Last Minute Deal"
    });
    
    $(".select_tws").select2({
        placeholder: "Subcategory"
    });

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
    });
</script>



<script>
    $(document).on("submit", "#copyVendorDealForm", function(e) {
        
        e.preventDefault();
        $.ajax({
            url: 'ajax/edit_deal.php',
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
                    location.href = "vendor-profile.php";
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
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
</script>