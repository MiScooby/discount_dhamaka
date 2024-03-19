<?php include('includes/header.php');
?>
<link rel="stylesheet" type="text/css" href="assets/css/v-profile.css?v1.1">
<link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">
<style>
    .table> :not(:first-child) {
        border-top: inherit;
    }
</style>

<section class="pricing-section">

    <div class="container">
        <div class="sec-title text-center">
            <span class="title">Get plan</span>
            <h2>Choose a Plan</h2>
        </div>

        <div class="outer-box">
            <input type="hidden" id="LoginVendorId" value="<?= $_SESSION['LoggedInVendor'] ?>">
            <div class="row">
                <?php
                $getUserPlanTYpeQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$_SESSION[LoggedInVendor]' ");
                $getUserPlanTYpe = mysqli_fetch_array($getUserPlanTYpeQ);



                if (isset($_GET['SubsPlan_type']) && $_GET['SubsPlan_type'] == "LmdealPlan") {
                    $getPlanQ = mysqli_query($con, "SELECT * FROM `last_minute_deals_plan` WHERE `cat_id`='$getUserPlanTYpe[business_cat]' AND `plan_grade`='$getUserPlanTYpe[plan_grade]' AND `plan_type`='$getUserPlanTYpe[plan_type]' AND `trash`='0' ");
                } else if (isset($_GET['SubsPlan_type']) && $_GET['SubsPlan_type'] == "memPlan") {
                    $getPlanQ = mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `cat_id`='$getUserPlanTYpe[business_cat]' AND `plan_grade`='$getUserPlanTYpe[plan_grade]' AND `plan_type`='$getUserPlanTYpe[plan_type]' AND `trash`='0'  ");
                }
                while ($getPlan = mysqli_fetch_array($getPlanQ)) {
                ?>
                    <div class="pricing-block col-lg-4 col-md-6 col-sm-12 wow fadeInUp">
                        <div class="inner-box">
                            <div class="icon-box">
                                <div class="icon-outer"><i class="fa fa-paper-plane"></i></div>
                            </div>
                            <div class="price-box">
                                <div class="title"> <?= $getPlan['plan_name'] ?></div>
                                <h4 class="price">₹ <?= $getPlan['plan_amnt'] ?></h4>
                            </div>
                            <?php
                            if ($_GET['SubsPlan_type'] == "memPlan") {
                            ?>
                                <ul class="features">
                                    <li class="true"><i class="fa fa-check"></i> This plan is valid For <?= $getPlan['plan_days'] ?> Days. </li>
                                </ul>
                                
                                <div class="btn-box">
                                    <a   href="checkout.php?planid=<?=$getPlan['id']?>&&plantype=memPlan" class="theme-btn">BUY plan</a>
                                </div>
                            <?php
                            } else if ($_GET['SubsPlan_type'] == "LmdealPlan") {
                            ?>
                                <ul class="features">
                                    <li class="true"><i class="fa fa-check"></i> This plan has <?= $getPlan['plan_deal_items'] ?> Deals. </li>
                                </ul>
                                <div class="btn-box">
                                <a   href="checkout.php?planid=<?=$getPlan['id']?>&&plantype=LmdealPlan" class="theme-btn">BUY plan</a>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                <?php
                }
                ?>
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
        var planDays = $(this).attr("data-planDays");
        var LoginVendorId = $("#LoginVendorId").val();

        jQuery.ajax({
            type: 'post',
            url: 'ajax/add-plan.php',
            data: {
                planId: planId,
                planAmnt: planAmnt,
                planDays: planDays,
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
                    var options = {
                        "key": "rzp_test_4MnlI8cz6nrXo7",
                        "amount": planAmnt * 100,
                        "currency": "INR",
                        "name": "Discount Dhamaka",
                        "description": "Test Transaction",
                        "image": "https://micodetest.com/discount-dhamaka/assets/images/logo/logo-8.png",
                        "handler": function(response) {
                            // console.log(response);
                            // return false;
                            jQuery.ajax({
                                type: 'post',
                                url: 'ajax/add-plan.php',
                                data: {
                                    LoginVendorId: data.vendorid,
                                    planAmnt: planAmnt,
                                    planDays: planDays,
                                    orderId: data.orderId,
                                    payment_id: response.razorpay_payment_id,
                                    type: "AddPayMnetID"
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
                                        window.location.href = "vendor-profile.php";
                                    } else {
                                        swicon = "warning";
                                        msg = data.message;
                                        srbSweetAlret(msg, swicon);
                                    }
                                }
                            });
                        },
                        "prefill": {
                            "name": data.vendorName,
                            "email": data.vendorEmailId,
                            "contact": data.vendorMob
                        },
                        "theme": {
                            "color": "#3399cc"
                        },

                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            }
        });



    });

    $(document).on("click", "#AddLMDPlan", function() {
        var planId = $(this).attr("data-planid");
        var planAmnt = $(this).attr("data-planAmnt");
        var planItems = $(this).attr("data-planItems");
        var LoginVendorId = $("#LoginVendorId").val();

        jQuery.ajax({
            type: 'post',
            url: 'ajax/add-plan.php',
            data: {
                planId: planId,
                planAmnt: planAmnt,
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
                data = JSON.parse(data);
                if (data.status) {
                    var options = {
                        "key": "rzp_test_4MnlI8cz6nrXo7",
                        "amount": planAmnt * 100,
                        "currency": "INR",
                        "name": "Discount Dhamaka",
                        "description": "Test Transaction",
                        "image": "https://micodetest.com/discount-dhamaka/assets/images/logo/logo-8.png",
                        "handler": function(response) {
                            // console.log(response);
                            // return false;
                            jQuery.ajax({
                                type: 'post',
                                url: 'ajax/add-plan.php',
                                data: {
                                    LoginVendorId: data.vendorid,
                                    planAmnt: planAmnt,
                                    planItems: planItems,
                                    payment_id: response.razorpay_payment_id,
                                    type: "AddLMDPayMnetID"
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
                                        window.location.href = "vendor-profile.php";
                                    } else {
                                        swicon = "warning";
                                        msg = data.message;
                                        srbSweetAlret(msg, swicon);
                                    }
                                }
                            });
                        },
                        "prefill": {
                            "name": data.vendorName,
                            "email": data.vendorEmailId,
                            "contact": data.vendorMob
                        },
                        "theme": {
                            "color": "#3399cc"
                        },

                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                }
            }
        });



    });
</script>