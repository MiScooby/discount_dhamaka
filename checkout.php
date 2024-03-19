<?php include('includes/header.php');
if (isset($_GET['plantype']) && isset($_GET['planid'])) {
    $PlanId = $_GET['planid'];
    if ($_GET['plantype'] == "memPlan") {
        $getDeaLdet = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `id` = '$PlanId' "));
    } else if ($_GET['plantype'] == "LmdealPlan") {
        $getDeaLdet = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `last_minute_deals_plan` WHERE `id` = '$PlanId' "));
    }
}
?>
<link rel="stylesheet" type="text/css" href="assets/css/v-profile.css?v1.1">
<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/checkout.css?v1.1">


<section class="pricing-section">

    <div class="container">
        <div class="sec-title text-center">
            <span class="title">Plan Checkout</span>
            <h2>Proceed To Pay</h2>
        </div>
        <div class="outer-box py-3">
            <input type="hidden" id="LoginVendorId" value="<?= $_SESSION['LoggedInVendor'] ?>">

            <div class="row justify-content-center">

                <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="inner-box">
                        <div class="icon-box">
                            <div class="icon-outer"><i class="fa fa-paper-plane"></i></div>
                        </div>
                        <div class="price-box">
                            <div class="title"><?= $getDeaLdet['plan_name']; ?></div>
                            <h4 class="price">₹ <?= $getDeaLdet['plan_amnt']; ?></h4>
                        </div>



                    </div>
                </div>
                <div class=" col-lg-6 col-md-6 col-sm-12 wow fadeInUp">
                    <div class="form-edit py-4">

                        <div class="price-box">
                            <div class="title"> Vendor <?= $getDeaLdet['plan_type'] . ' ' . $getDeaLdet['plan_name']; ?> <?= ($_GET['plantype'] == "memPlan") ? 'Membership' : 'Flash Deal'; ?> Plan</div>
                        </div>
                        <div class="price-sec">
                            <div>
                                <h5 class="m-0">Price :</h5>
                            </div>
                            <div class="amt">
                                Rs.<span class="srbCourseAmnt"><?= $getDeaLdet['plan_amnt']; ?></span>/-
                            </div>
                        </div>
                        <div class="coupon-sec d-flex">
                            <form action="javascript:;" enctype="multipart/form-data" id="ApcouponForm" class="w-100" method="post">
                                <label for="" id="CoupnLable">Do You have Any Promo Code ?</label>
                                <div class="input-group" id="CouponSec">
                                    <input name="CouponCodeFiled" required="required" class="form-control" placeholder="Enter Promo Code.." type="text" style="background-color: #fff !important; color: #121921 !important;">
                                    <input type="hidden" name="CouponCodeType" value="ApplyCoupons">
                                    <input type="hidden" name="AmountCrse" id="AmountCrse" value="<?= $getDeaLdet['plan_amnt'] ?>">
                                    <input type="hidden" name="LoginVendorId" value="<?= $_SESSION['LoggedInVendor'] ?>">
                                    <button type="submit" class="btn btn-primary couponBtn">Apply</button>
                                </div>
                            </form>
                        </div>
                        <div class="pay-sec">
                            <?php
                            if ($_GET['plantype'] == "memPlan") {
                            ?>
                                <button class="btn btn-primary proceedToPayBtn w-100" id="AddpLantoVendorAc" data-payble="<?= $getDeaLdet['plan_amnt']; ?>" data-planid="<?= $getDeaLdet['id'] ?>" data-planAmnt="<?= $getDeaLdet['plan_amnt'] ?>" data-planDays="<?= $getDeaLdet['plan_days'] ?>" data-coupon="no" data-coupon-code="0">Proceed To Pay</button>
                            <?php
                            } else if ($_GET['plantype'] == "LmdealPlan") {
                            ?>
                                <button class="btn btn-primary proceedToPayBtn w-100" id="AddLMDPlan" data-payble="<?= $getDeaLdet['plan_amnt']; ?>" data-planid="<?= $getDeaLdet['id'] ?>" data-planAmnt="<?= $getDeaLdet['plan_amnt'] ?>" data-planItems="<?= $getDeaLdet['plan_deal_items'] ?>" data-coupon="no" data-coupon-code="0">Proceed To Pay</button>
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


<?php include('includes/footer.php'); ?>
<script src="assets/sweetalert2/sweetalert2.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).on('click', ".doYouhaveCpn", function() {
        dfg = $(this).attr('data-id');
        $('.' + dfg).toggle();
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
    $(document).on("click", "#AddpLantoVendorAc", function() {
        var planId = $(this).attr("data-planid");
        var planAmnt = $(this).attr("data-planAmnt");
        var PaybleAmnt = $(this).attr("data-payble");
        var planDays = $(this).attr("data-planDays");
        var dataCoupon = $(this).attr("data-coupon");
        var couponCode = $(this).attr("data-coupon-code");
        var LoginVendorId = $("#LoginVendorId").val();

        jQuery.ajax({
            type: 'post',
            url: 'ajax/add-plan.php',
            data: {
                planId: planId,
                planAmnt: planAmnt,
                PaybleAmnt: PaybleAmnt,
                planDays: planDays,
                dataCoupon: dataCoupon,
                couponCode: couponCode,
                LoginVendorId: LoginVendorId,
                type: "AddMeMOrder"
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
                    jQuery.ajax({
                        type: 'post',
                        url: 'ajax/phonepay.php',
                        data: {
                            LoginVendorId: data.vendorid,
                            couponCode: data.couponCode,
                            planAmnt: planAmnt,
                            planDays: planDays,
                            orderId: data.orderId,
                            type: "AddPayMnetID"
                        },
                        success: function(data) {
                            //data = JSON.parse(data);
                            window.location.href = data
                            // console.log(data);
                        }
                    });
                }
            }
        });



    });

    $(document).on("click", "#AddLMDPlan", function() {
        var planId = $(this).attr("data-planid");
        var planAmnt = $(this).attr("data-planAmnt");
        var PaybleAmnt = $(this).attr("data-payble");
        var planItems = $(this).attr("data-planItems");
        var dataCoupon = $(this).attr("data-coupon");
        var couponCode = $(this).attr("data-coupon-code");
        var LoginVendorId = $("#LoginVendorId").val();

        jQuery.ajax({
            type: 'post',
            url: 'ajax/add-plan.php',
            data: {
                planId: planId,
                planAmnt: planAmnt,
                PaybleAmnt: PaybleAmnt,
                dataCoupon: dataCoupon,
                couponCode: couponCode,
                planItems: planItems,
                LoginVendorId: LoginVendorId,
                type: "AddLMDOrder"
            },
            beforeSend: function() {
                $("#loader").fadeIn(300);
            },
            complete: function() {
                $("#loader").fadeOut(300);
            },
            success: function(data) {
                // console.log(data);
                data = JSON.parse(data);
                // alert(data);
                if (data.status) {
                    
                    jQuery.ajax({
                        type: 'post',
                        url: 'ajax/phonepay.php',
                        data: {
                            LoginVendorId: data.vendorid,
                            couponCode: data.couponCode,
                            planAmnt: planAmnt,
                            planItems: planItems, 
                            orderId: data.order_id,
                            type: "AddLMDPayMnetID"
                        },
                        success: function(data) { 
                            window.location.href = data 
                        }
                    });                  
                }
            }
        });



    });
</script>

<script>
    $(document).on("submit", "#ApcouponForm", function() {

        $.ajax({
            type: "POST",
            url: "ajax/coupon_cb.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $(".couponBtn").attr("disabled", "disabled");
                $(".couponBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
            },
            complete: function() {
                $(".couponBtn").removeAttr("disabled", "disabled");
                $(".couponBtn").html("Apply Coupon");


            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $('.srbCourseAmnt').text(data.amount);
                    $('.proceedToPayBtn').attr('data-planAmnt', data.amount);
                    $('.proceedToPayBtn').attr('data-coupon', 'yes');
                    $('.proceedToPayBtn').attr('data-coupon-code', data.coupon);
                    $('#CouponSec').html('<div class="appliedCpn"><h5>Promo code <span>' + data.coupon + '</span> Applied..</h5> <a href="javascript:;" id="removeCpnBtn"><i class="fa fa-trash"></i></a> </div>');
                    if (data.amount == "0") {
                        NewIdname = idName + '_pWAmnt';
                        $('.proceedToPayBtn').attr('id', NewIdname);
                    }
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            },
        });
    });

    $(document).on('click', '#removeCpnBtn', function() {

        $('#CouponSec').html(' <input name="CouponCodeFiled" required="required" class="form-control" placeholder="Enter Coupon Code.." type="text" style="background-color: #fff !important; color: #121921 !important;">' +
            '<input type="hidden" name="CouponCodeType" value="ApplyCoupons">' +
            '<input type="hidden" name="AmountCrse" id="AmountCrse" value="<?= $getDeaLdet['plan_amnt'] ?>">' +
            '<input type="hidden" name="LoginVendorId" value="<?= $_SESSION['LoggedInVendor'] ?>">' +
            '<button type="submit" class="btn btn-primary couponBtn">Apply Coupon</button>');
        var AmountCrse = $('#AmountCrse').val();
        $('.srbCourseAmnt').text(AmountCrse);
        $('.proceedToPayBtn').attr('data-planAmnt', AmountCrse);
        $('.proceedToPayBtn').attr('data-coupon', 'no');
        $('.proceedToPayBtn').attr('data-coupon-code', '0');
    });

    $(document).on("click", "#AddpLantoVendorAc_pWAmnt", function() {
        var planId = $(this).attr("data-planid");
        var planAmnt = $(this).attr("data-planAmnt");
        var PaybleAmnt = $(this).attr("data-payble");
        var planDays = $(this).attr("data-planDays");
        var dataCoupon = $(this).attr("data-coupon");
        var couponCode = $(this).attr("data-coupon-code");
        var LoginVendorId = $("#LoginVendorId").val();

        jQuery.ajax({
            type: 'post',
            url: 'ajax/add-plan.php',
            data: {
                planId: planId,
                planAmnt: planAmnt,
                PaybleAmnt: PaybleAmnt,
                planDays: planDays,
                dataCoupon: dataCoupon,
                couponCode: couponCode,
                LoginVendorId: LoginVendorId,
                type: "AddMeMOrderWithOutPay"
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

                }
            }
        });



    });
</script>