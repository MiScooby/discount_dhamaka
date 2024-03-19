<?php include('includes/header.php');

if (!authChecker('admin', ['view_deal', 'edit_offer'])) {
    noAccessPage();
}

$deal_id = $_GET['id'];


$myofferdealsql = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `id`='$deal_id'");

$ofrdlsrow = mysqli_fetch_array($myofferdealsql);

// for category fetch
$mycatid = $ofrdlsrow['offer_cat'];
$myoffrcatsql = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$mycatid'");
$catrow = mysqli_fetch_array($myoffrcatsql);

// for sub-category fetch
$mysubcatid = $ofrdlsrow['offer_sub_cat'];
$myoffrsubcatsql = mysqli_query($con, "SELECT * FROM `sub_category` WHERE `id`='$mysubcatid'");
$subcatrow = mysqli_fetch_array($myoffrsubcatsql);

// for store name fetch
$vendorid = $ofrdlsrow['vendor_id'];
$getEmail = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor` WHERE `id`='$vendorid'"));

$brandstrsql = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$vendorid'");
$brandrow = mysqli_fetch_array($brandstrsql);




?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">

<style>
    label.form-label {
        font-weight: 500;
        color: #656565;
        font-size: 14px;
    }

    .offerinfodiv {
        background: #fcfcfcc4;
        padding: 20px 20px 8px;
        border-radius: 20px;
        border: 1px solid #f6f6f6cc;
    }

    .offerinfodiv .sec-head {
        font-weight: 600;
        margin-bottom: 15px;
        color: #2bc79c;
    }

    span.discri {
        font-style: italic;
        font-size: 12px;
        font-weight: 500;
        color: #888383;
    }

    .dealimgs {
        position: relative;
    }

    .dealimgs img {
        border: 2px solid #7d71ff30;
        border-radius: 5px;
    }

    .rmdealimg {
        cursor: pointer;
        position: absolute;
        right: 28px;
        top: 2px;
        background: #fed9d9;
        color: indianred;
        padding: 0 4px;
        border-radius: 3px;
        box-shadow: -3px 3px 2px 0px #fab1b1b3;
    }

    .rmdealimg:hover {
        box-shadow: none;
        color: indianred;
    }
</style>

<div class="row justify-content-center">
    <div class="row">

        <div class="col-md-12 mb-2 grid-margin stretch-card justify-content-end">
            <?php
            if ($getEmail['email_id'] != null) {
            ?>

                <a href="mailto:<?= $getEmail['email_id']; ?>" class="btn btn-success me-2">Send Email to vendor</a>


            <?php
            }
            ?>


        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title" style="text-align:left;font-size:18px;padding-left:25px;">Edit Offer</h6>




                <form class="forms-sample" id="editofferForm" enctype="multipart/form-data">

                    <div class="offerinfodiv mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="sec-head">Offer Details-1:</p>
                            </div>
                            <div class="col-md-12 space-t-15">
                                <label class="form-label">Offer Title</label>
                                <input type="text" name="DealOffertitle" id="DealOffertitle" value="<?= $ofrdlsrow['offer_title']; ?>" class="form-control">
                                <span class="discri">Input title for the offer.</span>
                            </div>
                            <div class="col-md-12 space-t-15 mt-3">
                                <label class="form-label">Deal Description</label>
                                <textarea id="myDesc" name="DealDesc" rows="10" cols="80"><?= $ofrdlsrow['offer_desc']; ?></textarea>
                                <span class="discri">Input description of the offer.</span>
                            </div>

                            <div class="col-md-2 space-t-15 mt-2">
                                <label class="form-label">Offer Image</label><br>
                                <img src="../upload/deals-img/<?= $ofrdlsrow['offer_img']; ?>" style="width:130px;">
                            </div>

                            <div class="col-md-10 space-t-15 mt-2">
                                <label class="form-label"></label><br>
                                <input type="file" name="dealOfferImg" class="form-control" accept="image/*">
                                <span class="discri">Upload and select featured image for the offer.</span>
                            </div>

                            <div class="col-md-6 space-t-15 mt-4">
                                <label class="form-label">Offer Category </label>
                                <select class="js-example-basic-single form-select" name="DealCategory" id="myMaincat">
                                    <option value="<?= $catrow['id']; ?>"><?= $catrow['cat_name']; ?></option>
                                    <!-- <?php
                                            $mycatsql = mysqli_query($con, "SELECT * FROM `category` WHERE id!='$mycatid' AND `status`='Active'");
                                            while ($mycatrow = mysqli_fetch_array($mycatsql)) {
                                            ?>
                                  <option value="<?= $mycatrow['id']; ?>"><?= $mycatrow['cat_name']; ?></option>
                                <?php } ?> -->
                                </select>
                            </div>

                            <div class="col-md-6 space-t-15 mt-4">
                                <label class="form-label">Sub-Category </label>
                                <select class="js-example-basic-single form-select" id="AddDealsubCat" name="AddDealsubCat">

                                    <?php
                                    $myoffrsubcatsql1 = mysqli_query($con, "SELECT * FROM `sub_category` WHERE `parent_cat`='$mycatid' and `id`!='$mysubcatid'");
                                    while ($subcatrow1 = mysqli_fetch_array($myoffrsubcatsql1)) {
                                    ?>
                                        <option value="<?= $subcatrow1['id']; ?>"><?= $subcatrow1['sub_cat_name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-12 space-t-15  mt-3 d-flex align-items-center">
                                <label class="form-label" style="margin-right:5px;margin-bottom: 0;">Flash Deals</label>
                                <select class="js-example-basic-single form-select" style="width:80px !important;" id="lastMintDeal" name="lastMintDeal">
                                    <?php if ($ofrdlsrow['last_minute_deal'] == 'Yes') { ?>
                                        <option value="Yes" selected>Yes</option>
                                        <option value="No">No</option>
                                    <?php } else { ?>
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected>No</option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-12 space-t-15 mt-4">
                                <label class="form-label">Offer Start Date: </label>
                                <input class="form-control" id="datePicker" name="DealStartDate" type="date" value="<?= $ofrdlsrow['offer_start_date']; ?>" />
                                <input class="form-control dealstrtime" name="DealStartTime" type="time" value="<?= $ofrdlsrow['offer_start_time']; ?>" />
                                <span class="discri">Set start date for the offer. If this field is empty current time will be applied to the offer.</span>
                            </div>

                            <div class="col-md-12 space-t-15 mt-4">
                                <label class="form-label">Offer Expire Date: </label>

                                <input class="form-control" id="dateEnd" name="DealEndDate" type="date" value="<?= $ofrdlsrow['offer_end_date']; ?>" />

                                <input class="form-control dealendtime" name="DealEndTime" type="time" value="<?= $ofrdlsrow['offer_end_time']; ?>" />
                                <span class="discri">Set end date for the offer.</span>
                            </div>

                            <div class="col-md-12 space-t-15 mt-2">
                                <label class="form-label">Deal Items </label>
                                <input type="number" name="dealItems" class="form-control" value="<?= $ofrdlsrow['deal_times']; ?>">
                                <span class="discri">Input number of deal items or services which will be available for offer.</span>
                            </div>
                            <div class="col-md-12 space-t-15 mt-2">
                                <div class="row mydealimgsdiv">
                                    <?php
                                    // deals images fetch
                                    $dealimgsql = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$deal_id'");
                                    while ($dealimgrow = mysqli_fetch_array($dealimgsql)) {
                                    ?>
                                        <div class="col-md-2 space-t-15 mt-2 mb-2">
                                            <div class="dealimgs">
                                                <img src="../upload/deals-img/<?= $dealimgrow['deal_img']; ?>" style="width:100px;height:100px;">
                                                <?php
                                                if (authChecker('admin', ['edit_offer'])) {
                                                ?>
                                                    <a href="javascript:void(0);" class="rmdealimg" data-id="<?= $dealimgrow['id']; ?>"><i class="fa fa-trash"></i></a>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <label class="form-label">Deal Images</label><br>
                                <input type="file" name="dealImg[]" multiple class="form-control" accept="image/*">
                                <span class="discri">Choose images for the deal. Drag and drop to change their order.</span>
                            </div>
                            <div class="col-md-12 space-t-15 mt-3">
                                <label class="form-label">Short Description</label>
                                <textarea type="text" name="deal_shortdesc" id="deal_excerpt" class="form-control" spellcheck="false" placeholder="Description"><?= $ofrdlsrow['deal_short_desc']; ?></textarea>
                                <span class="discri">Input description which will appear in the deal single page sidebar.</span>

                            </div>
                            <div class="col-md-12 space-t-15  mt-3">
                                <label class="form-label">Deal Features </label>
                                <input type="text" name="dealFeauture" class="form-control" value="<?= $ofrdlsrow['deal_feature']; ?>">
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                    <?php
                    if (authChecker('admin', ['edit_offer'])) {
                    ?>
                        <div class="offerinfodiv">



                            <div class="text-left mb-3 pt-3">
                                <?php
                                if (($ofrdlsrow['status'] != "Schedule")) {
                                    if (($ofrdlsrow['status'] == "Delete") || ($ofrdlsrow['status'] == "Rejected")) {

                                ?>
                                        <a class="alert alert-danger">Deal is not able to save any thing</a>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="sec-head">Offer Details-2: </p>
                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Offer In Slider</label>
                                                    <select class="js-example-basic-single form-select" id="OfferInslider" name="OfferInslider" data-width="100%">
                                                        <?php if ($ofrdlsrow['is_slider'] == 'Yes') { ?>
                                                            <option value="Yes" selected>Yes</option>
                                                            <option value="No">No</option>
                                                        <?php } else { ?>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No" selected>No</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label class="form-label">Allow Comment</label>
                                                    <select class="js-example-basic-single form-select" id="AllowComment" name="AllowComment" data-width="100%">
                                                        <?php if ($ofrdlsrow['allow_cmnt'] == 'Yes') { ?>
                                                            <option value="Yes" selected>Yes</option>
                                                            <option value="No">No</option>
                                                        <?php } else { ?>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No" selected>No</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="OfferClick" class="form-label">Offer Click</label>
                                                    <input type="text" class="form-control" id="OfferClick" name="OfferClick" placeholder="Enter  Click" value="<?= $ofrdlsrow['click']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="OfferView" class="form-label">Offer View</label>
                                                    <input type="text" class="form-control" id="OfferView" name="OfferView" placeholder="Enter  View" value="<?= $ofrdlsrow['view']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="ratingPoint" class="form-label">Offer Rating</label>
                                                    <input type="text" class="form-control" id="ratingPoint" name="ratingPoint" placeholder="Enter Deal Rating out of 5" value="<?= $ofrdlsrow['rating_points']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="ratingPointsTotal" class="form-label">Offer Rating Total</label>
                                                    <input type="text" class="form-control" id="ratingPointsTotal" name="ratingPointsTotal" readonly value="5">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="mb-3">
                                                    <label for="dofday" class="form-label">Deal Of The Day</label>
                                                    <select class="js-example-basic-single form-select" id="dofday" name="dofday" data-width="100%">
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="dealofrId" id="mydlid" value="<?= $deal_id; ?>">
                                        <input type="hidden" name="editofferDeal" value="editofferDeal">
                                        <button type="submit" class="btn btn-primary me-2 w-30 savedtl">Approve Offer Details</button>
                                        <button type="button" id="dltDeal" class="btn btn-danger me-2 w-30">Delete Offer Details</button>


                                        <?php
                                        if ($ofrdlsrow['published'] != "1") {
                                        ?>
                                            <a href="preview-offer.php?deal_id=<?= $deal_id; ?>" class="btn btn-warning text-white me-2 w-30">Publish Deal</a>
                                        <?php
                                        }
                                        ?>
                                    <?php }
                                } else {
                                    ?>
                                    <button type="button" id="ApprvDeal" data-deal="<?= $deal_id; ?>" class="btn btn-success me-2 w-30">Active Deal</button>

                                    <button type="button" id="RejectDeal" data-deal="<?= $deal_id; ?>" class="btn btn-danger me-2 w-30">Reject Deal</button>
                                <?php
                                } ?>

                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </form>

            </div>
        </div>
    </div>
    <?php
    if (($ofrdlsrow['status'] != "Schedule")) {
        if (($ofrdlsrow['status'] != "Delete")) {
    ?>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body py-3 px-3">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <label for="CHanegeStatsDeal" class="form-label pb-0">Change Status to :</label>
                            </div>
                            <div class="col-md-4">
                                <select class="js-example-basic-single form-select" id="CHanegeStatsDeal" name="CHanegeStatsDeal" data-deal="<?= $deal_id; ?>" data-width="100%">
                                    <option <?= ($ofrdlsrow['status'] == "Active") ? 'Selected' : ''; ?> value="Active">Active</option>
                                    <option <?= ($ofrdlsrow['status'] == "Inactive") ? 'Selected' : ''; ?> value="Inactive">Inactive</option>
                                    <option <?= ($ofrdlsrow['status'] == "Hide") ? 'Selected' : ''; ?> value="Hide">Pause</option>
                                    <option <?= ($ofrdlsrow['status'] == "Rejected") ? 'Selected' : ''; ?> value="Rejected">Rejected</option>
                                    <option <?= ($ofrdlsrow['status'] == "Schedule") ? 'Selected' : ''; ?> value="Schedule">Schedule</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php
        }
    }
    ?>

</div>
<style>

</style>

<div id="snackbar"></div>

<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>


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
                items: ['Image']
            },
        ]
    });

    function mySanck() {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar")

        // Add the "show" class to DIV
        x.className = "Snashow";

        // After 3 seconds, remove the Snashow class from DIV
        setTimeout(function() {
            x.className = x.className.replace("Snashow", "");
        }, 3000);
    }
</script>

<script>
    $(document).ready(function() {
        $(document).on("submit", "#editofferForm", function(e) {
            e.preventDefault();
            $(".savedtl").text("Please Wait...");
            $(".savedtl").attr('disabled', 'disabled');
            var formData = new FormData(this);
            $.ajax({
                url: 'ajax/edit-deal.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.reload();
                        }, 500);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        window.setTimeout(function() {
                            location.reload();
                        }, 500);
                    }
                }
            });
        });

        // remove dealimg remove_deal_imgs.php
        $(document).on("click", ".rmdealimg", function() {
            var mydealimg_id = $(this).attr("data-id");

            $.ajax({
                url: 'ajax/remove_deal_imgs.php',
                type: 'POST',
                data: {
                    dealimgid: mydealimg_id
                },
                success: function(data) {
                    if (data == 1) {
                        location.reload();
                        alert("Successfully Deleted!");
                    } else {
                        alert("Image Not Deleted!");
                    }
                }
            });

        });

        $(document).on("click", "#dltDeal", function() {
            var dealId = $('#mydlid').val();
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
                        url: "ajax/edit-deal.php",
                        type: "POST",
                        async: false,
                        data: {
                            dealId: dealId,
                            type: 'dltDeal'
                        },
                        success: function(data) {
                            data = JSON.parse(data);
                            if (data.status) {
                                swicon = "success";
                                msg = data.message;
                                srbSweetAlret(msg, swicon);
                                window.location.replace("view-offers.php");
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
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on("change", "#myMaincat", function() {
            var catid = $(this).val();
            $.ajax({
                url: "ajax/subcat.php",
                type: "POST",
                data: {
                    catid1: catid
                },
                success: function(data) {
                    if (data) {
                        $("#AddDealsubCat").prop("disabled", false);
                        $("#AddDealsubCat").html(data);
                    }
                }

            });

        });
    });
</script>

<script>
    //  document.getElementById("datePicker").min = new Date().getFullYear() + "-" +  parseInt(new Date().getMonth() + 1 ) + "-" + new Date().getDate()

    //  document.getElementById("dateEnd").min = new Date().getFullYear() + "-" +  parseInt(new Date().getMonth() + 1 ) + "-" + new Date().getDate()

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

<script>
    $(document).on("click", "#ApprvDeal", function() {
        var dealId = $(this).attr('data-deal');
        $.ajax({
            url: "ajax/edit-deal.php",
            type: "POST",
            async: false,
            data: {
                dealId: dealId,
                type: 'ApprvDeal'
            },
            beforeSend: function() {
                $("#ApprvDeal").attr('disabled', 'disabled');
                $("#ApprvDeal").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");

            },

            success: function(data) {
                data = JSON.parse(data);
                if (data.status == 1) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);

                }

            },

            complete: function() {
                $("#ApprvDeal").removeAttr('disabled');
                $("#ApprvDeal").html("Active Deal");

            },

        });
    });

    $(document).on("click", "#RejectDeal", function() {
        var dealId = $(this).attr('data-deal');
        $.ajax({
            url: "ajax/edit-deal.php",
            type: "POST",
            async: false,
            data: {
                dealId: dealId,
                type: 'RejectDeal'
            },
            beforeSend: function() {
                $("#RejectDeal").attr('disabled', 'disabled');
                $("#RejectDeal").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");

            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status == 1) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);

                }

            },
            complete: function() {
                $("#RejectDeal").removeAttr('disabled');
                $("#RejectDeal").html("Reject Deal");

            }

        });
    });
</script>

<script>
    $(document).on('change', '#CHanegeStatsDeal', function() {
        dealId = $(this).attr('data-deal');
        sts = $(this).val();
        $.ajax({
            url: "ajax/edit-deal.php",
            type: "POST",
            async: false,
            data: {
                dealId: dealId,
                sts: sts,
                type: 'DealSts'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);

                }

            }

        });
    });
</script>