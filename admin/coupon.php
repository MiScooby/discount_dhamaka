<?php include('includes/header.php');
if (!authChecker('admin', ['add_coupon_code', 'view_coupon_code', 'edit_coupon_code'])) {
    noAccessPage();
}

if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
    if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
        $checkCoupon = mysqli_query($con, "SELECT * FROM `coupons` WHERE `trash`='0' AND added_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' ORDER BY id DESC");
    } else {
        $checkCoupon = mysqli_query($con, "SELECT * FROM `coupons` WHERE `trash`='0' ORDER BY id DESC");
    }
} else {
    $checkCoupon = mysqli_query($con, "SELECT * FROM `coupons` WHERE `trash`='0' ORDER BY id DESC");
}


?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<link rel="stylesheet" href="assets/datatable/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
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

<?php
if (authChecker('admin', ['edit_offer'])) {
?>
    <div class="row justify-content-center">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Add Promo Code</h6>

                    <form class="forms-sample" id="addCouponForm" action="javascript:;" enctype="multipart/form-data">
                        <div class='loading'></div>
                        <div class="mb-3">
                            <label for="CouponCode" class="form-label">Promo Code <span class="reuired">*</span> </label>
                            <input type="text" class="form-control" id="Coupon_Code" name="CouponCode" required placeholder="Enter Promo Code">
                            <div id="ErrMsg" style="display: none;"></div>
                        </div>
                        <div class="mb-3">
                            <label for="CouponTitle" class="form-label">Promo Code Title <span class="reuired">*</span> </label>
                            <input type="text" class="form-control" id="CouponTitle" name="CouponTitle" required placeholder="Enter Promo Code Title">
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Promo Code Redemption Type<span>*</span> : </label>
                                <select class="form-control ct" id="coupon_type" required name="coupon_type">
                                    <option></option>
                                    <option value="Flat">Flat</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label w-100">Promo Code Value <span>*</span> </label>
                                <input class="form-control form-control-lg" oninput="this.value = this.value.replace(/\D+/g, '')" type="number" value="0" min="1" placeholder="Enter Promo Code Value" name="Coupon_Value" id="Coupon_Value" required="">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <label class="form-label">Promo Code Redemption Limit<span>*</span> : </label>
                                <input class="form-control form-control-lg" oninput="this.value = this.value.replace(/\D+/g, '')" type="number" value="1" min="1" placeholder="Enter Promo Code Redemption Limit" name="Coupon_Limit" id="Coupon_Limit" required="">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label w-100">Promo Code Start Date <span>*</span> </label>
                                <input class="form-control form-control-lg" type="date" name="Coupon_start" id="Coupon_start" required="">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label w-100">Promo Code Expire Date <span>*</span> </label>
                                <input class="form-control form-control-lg" type="date" name="Coupon_expire" id="Coupon_expire" required="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Promo Code User type<span>*</span> : </label>
                                <select class="form-control ct" id="user_type" required name="user_type">
                                    <option></option>
                                    <option value="All">All</option>
                                    <option value="Individual">Individual</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Promo Code User type List<span>*</span> : </label>
                                <select class="form-control" id="user_type_list" disabled multiple required name="user_type_list[]">
                                    <option></option>
                                    <option value="All">Promo Code Exist For All Vendors</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="addCoupon" value="addCoupon">
                            <button type="submit" class="btn btn-primary me-2 w-50" id="AddCouponBtn">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
<?php
}
?>
<div class="row">
    <div class="col-md-3  stretch-card align-items-center">
        <h5 class="card-title">COUPON LIST</h5>
    </div>
    <div class="col-md-9 mb-2 grid-margin stretch-card justify-content-end">
        <?php include('date-selector.php'); ?>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card p-3">
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="" class="dataTableExample table table-striped ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Promo Code</th>
                                <th>Promo Code Type</th>
                                <th>Promo Code Value</th>
                                <th>Added Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="">

                            <?php
                            $i = 1;
                            while ($coupsrow = mysqli_fetch_array($checkCoupon)) {

                            ?>

                                <tr class="offers_list">
                                    <td><?= $i++ ?></td>
                                    <td><?= $coupsrow['coupon_code']; ?></td>
                                    <td><?= $coupsrow['offer_type']; ?></td>
                                    <td><?= $coupsrow['offer_value']; ?></td>

                                    <td><?= $coupsrow['added_date'] . ' ' . $coupsrow['added_time']; ?></td>
                                    <td>
                                        <select name="usr_sts" id="cop_sts" data-id="<?= $coupsrow['id'] ?>" class="user_stsopt form-select">
                                            <option data-id="" value="1" <?php if ($coupsrow['status'] == "1") {
                                                                                echo "selected";
                                                                            } ?>>Active</option>
                                            <option data-id="" value="0" <?php if ($coupsrow['status'] == "0") {
                                                                                echo "selected";
                                                                            } ?>>Inactive</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="view-coupon.php?<?= $urltoken ?>$<?= $urltoken ?>&&coup_id=<?= $coupsrow['id'] ?>&<?= $urltoken ?>$<?= $urltoken ?>" class="btn btn-success">View</a>

                                        <a href="javascript:;" id="couponDLt" data-id="<?= $coupsrow['id'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>


                                    </td>
                                </tr>

                            <?php } ?>




                        </tbody>

                    </table>

                </div>

            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>
<script src="assets/datatable/js/jquery.dataTables.min.js"></script>

<script>
    $('.dataTableExample').DataTable();
</script>
<script>
    $(function() {
        'use strict'

        $("#cop_sts").select2();
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
    document.getElementsByName("Coupon_expire")[0].setAttribute('min', today);
    document.getElementsByName("Coupon_start")[0].setAttribute('min', today);
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
    $(document).on("submit", "#addCouponForm", function() {
        $.ajax({
            type: "POST",
            url: "ajax/coupon.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#AddCouponBtn").attr("disabled", "disabled");
                $("#AddCouponBtn").text("Please Wait..");
            },
            complete: function() {
                $("#AddCouponBtn").removeAttr("disabled", "disabled");
                $("#AddCouponBtn").text("Submit");

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
    $(document).on('click', '#couponDLt', function() {
        copId = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    url: "ajax/coupon.php",
                    type: "POST",
                    async: false,
                    data: {
                        copId: copId,
                        type: "coupon_dlt",
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
            }
        });
    });
    $(document).on("change", "#cop_sts", function() {
        coupID = $(this).attr('data-id');
        sts = $(this).val();
        $.ajax({
            url: "ajax/coupon.php",
            type: "POST",
            async: false,
            data: {
                coupID: coupID,
                sts: sts,
                type: "coupon_sts",
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