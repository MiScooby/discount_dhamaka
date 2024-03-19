<?php include('includes/header.php');

if (isset($_GET['coup_id'])) {
    $GetCopid = $_GET['coup_id'];
    $checkCoupon = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `coupons` WHERE `id`='$GetCopid' AND `trash`='0'"));
}

if (!authChecker('admin', ['view_coupon_code', 'edit_coupon_code'])) {
    noAccessPage();
}

?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<style>
    .err_msg {
        color: red;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: 600;
        padding-top: 5px;
    }

    .select2-container--default .select2-selection--multiple {
        background-color: white;
        border: 1px solid #e9ecef !important;
        border-radius: 4px;
        cursor: text;
        padding: 4px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        color: #747474;
        font-size: 11px !important;
        font-weight: 500;
        padding: 5px 5px !important;
    }
</style>


<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title"> Coupon View</h6>

                <form class="forms-sample" id="EditCouponForm" action="javascript:;" enctype="multipart/form-data">
                    <div class='loading'></div>
                    <div class="mb-3">
                        <label for="CouponCode" class="form-label">Coupon Code <span class="reuired">*</span> </label>
                        <input type="text" class="form-control" id="Coupon_Code" name="CouponCode" required placeholder="Enter Coupon Code" value="<?= $checkCoupon['coupon_code']; ?>">
                        <div id="ErrMsg" style="display: none;"></div>
                    </div>
                    <div class="mb-3">
                        <label for="CouponTitle" class="form-label">Coupon Title <span class="reuired">*</span> </label>
                        <input type="text" class="form-control" id="CouponTitle" name="CouponTitle" required placeholder="Enter Coupon Title" value="<?= $checkCoupon['title']; ?>">
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Coupon Redemption Type<span>*</span> : </label>
                            <select class="form-control ct" id="coupon_type" required name="coupon_type">
                                <option></option>
                                <option value="Flat" <?= ($checkCoupon['offer_type'] == 'Flat') ? 'selected' : ''; ?>>Flat</option>
                                <option value="Percentage" <?= ($checkCoupon['offer_type'] == 'Percentage') ? 'selected' : ''; ?>>Percentage</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label w-100">Coupon Value <span>*</span> </label>
                            <input class="form-control form-control-lg" oninput="this.value = this.value.replace(/\D+/g, '')" type="number" value="<?= $checkCoupon['offer_value']; ?>" min="1" placeholder="Enter Coupon Value" name="Coupon_Value" id="Coupon_Value" required="">
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">
                            <label class="form-label">Coupon Redemption Limit<span>*</span> : </label>
                            <input class="form-control form-control-lg" oninput="this.value = this.value.replace(/\D+/g, '')" type="number" value="<?= $checkCoupon['red_count']; ?>" min="1" placeholder="Enter Coupon Redemption Limit" name="Coupon_Limit" id="Coupon_Limit" required="">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label w-100">Coupon Start Date <span>*</span> </label>
                            <input class="form-control form-control-lg" value="<?= $checkCoupon['start_date']; ?>" type="date" name="Coupon_start" id="Coupon_start" required="">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label w-100">Coupon Expire Date <span>*</span> </label>
                            <input class="form-control form-control-lg" value="<?= $checkCoupon['end_date']; ?>" type="date" name="Coupon_expire" id="Coupon_expire" required="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Coupon User type<span>*</span> : </label>
                            <select class="form-control ct" id="user_type" required name="user_type">
                                <option></option>
                                <option value="All" <?= ($checkCoupon['user_type'] == 'All') ? 'selected' : ''; ?>>All</option>
                                <option value="Individual" <?= ($checkCoupon['user_type'] == 'Individual') ? 'selected' : ''; ?>>Individual</option>
                            </select>
                        </div>

                        <?php
                        if ($checkCoupon['user_type'] == 'All') {
                        ?>
                            <div class="col-sm-6">
                                <label class="form-label">Coupon User type List<span>*</span> : </label>
                                <select class="form-control" id="user_type_list" multiple required name="user_type_list[]">
                                    <option></option>
                                    <option value="All" selected>Coupon Exist For All Vendors</option>
                                </select>
                            </div>
                        <?php
                        } elseif ($checkCoupon['user_type'] == 'Individual') {
                            $fetVenQ = mysqli_query($con, "SELECT v.*, vb.store_name FROM vendor v, vendor_brand vb WHERE vb.vendor_id=v.id AND v.status='Active' AND v.is_deleted='0' ");
                        ?>
                            <div class="col-sm-6">
                                <label class="form-label">Coupon User type List <span>*</span> 
                                <span class="PopInfo" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="right" data-bs-content="List of vendor who have brand name registered with us."><i class="fa fa-info"></i></span> : </label>

                               
                                <select class="form-control" id="user_type_list" multiple required name="user_type_list[]">
                                    <option></option>
                                    <?php
                                    while ($fetVen = mysqli_fetch_array($fetVenQ)) {
                                        $GetVen = mysqli_query($con, "SELECT * FROM `coupon_users` WHERE `coupon_id`='$GetCopid'");
                                        echo "SELECT * FROM `coupon_users` WHERE `coupon_id`='$GetCopid'";
                                        $soe = "";
                                        while ($GetVenD = mysqli_fetch_array($GetVen)) {
                                            if ($GetVenD['vendor_id'] == $fetVen['id']) {
                                                $soe = "selected";
                                            }
                                        }

                                    ?>
                                        <option value="<?= $fetVen['id'] ?>" <?= $soe ?>><?= $fetVen['mobile_num'] . ' ' . strtoupper($fetVen['store_name']) ?></option>
                                    <?php   } ?>
                                </select>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                    if (authChecker('admin', ['edit_coupon_code'])) {
                    ?>
                        <div class="text-center">
                            <input type="hidden" name="typeCoupon" value="editCoupon">
                            <input type="hidden" name="couponID" value="<?= $checkCoupon['id']; ?>">
                            <button type="submit" class="btn btn-primary me-2 w-50" id="editCouponBtn">Save Changes</button>
                        </div>
                    <?php } ?>
                </form>

            </div>
        </div>
    </div>

</div>



<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>

<script>
    $(function() {
        'use strict'

        $("#user_sts").select2();
        $("#coupon_type").select2({
            placeholder: 'Select an option.'
        });
        $("#user_type").select2({
            placeholder: 'Select an option.'
        });
        $("#user_type_list").select2({
            placeholder: 'Select an option.'
        });



    });
</script>

<script>
    var today = new Date().toISOString().split('T')[0];
    var todayExp = $('#Coupon_start').val();
    document.getElementsByName("Coupon_expire")[0].setAttribute('min', today);
    document.getElementsByName("Coupon_start")[0].setAttribute('min', todayExp);
</script>
<script>
    $(document).on("change", "#coupon_type", function() {
        coupType = $(this).val();
        if (coupType == "Flat") {
            $("#Coupon_Value").attr(
                "placeholder",
                "Please Enter Coupon Value in Flat Amount"
            );
            $("#Coupon_Value").removeAttr("max", "100");
        } else if (coupType == "Percentage") {
            $("#Coupon_Value").attr(
                "placeholder",
                "Please Enter Coupon Value in Percentage"
            );
            $("#Coupon_Value").attr("max", "100");
        } else {
            $("#Coupon_Value").removeAttr("max", "100");
        }
    });
    $("#Coupon_Code").on("keyup", function(e) {
        $(this).prop('type', 'text');
        var value = $(this).val();
        if (value != '') {
            var regx = /^(?=.*[A-Z])(?=.*[0-9])[A-Z0-9]+$/;
            var isValid = regx.test(value);
            if (!isValid) {
                $('#AddCouponBtn').attr('disabled', 'disabled');
                $("#ErrMsg").show();
                $("#ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Coupon Code must be in alphanumeric eg: CODE123 </div>");
            } else {
                $("#ErrMsg").hide();
                $('#AddCouponBtn').removeAttr('disabled', 'disabled');
            }
        }

    });
    $(document).on("change", "#user_type", function() {
        coupType = $(this).val();
        if (coupType == "Individual") {
            $.ajax({
                url: "ajax/coupon.php",
                type: "POST",
                async: false,
                data: {
                    type: 'fetchVendors'
                },
                success: function(data) {
                    if (data) {
                        $('#user_type_list').removeAttr('disabled');
                        $("#user_type_list").val([]).change();
                        $('#user_type_list').html(data);
                    }
                }
            });
        } else if (coupType == "All") {
            $('#user_type_list').removeAttr('disabled');
            $('#user_type_list').html('<option></option>  <option value="All" selected>Coupon Exist For All Vendors</option>');
        }
    });
    $(document).on("submit", "#EditCouponForm", function() {
        $.ajax({
            type: "POST",
            url: "ajax/coupon.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#editCouponBtn").attr("disabled", "disabled");
                $("#editCouponBtn").text("Please Wait..");
            },
            complete: function() {
                $("#editCouponBtn").removeAttr("disabled", "disabled");
                $("#editCouponBtn").text("Save Changes");

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
            },
        });
    });
</script>