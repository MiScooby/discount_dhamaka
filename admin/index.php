<?php include('includes/header.php');
$ttl_usrCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `user` WHERE `is_deleted`='0'"));
$ttl_vndCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor` WHERE `is_deleted`='0'"));
$act_vndCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor` WHERE `is_deleted`='0' AND status='Active'"));
$pnd_vndCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor` WHERE  `is_deleted`='0' AND `status`!='Active' OR `edited`='1'"));
$act_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND `is_deleted`='0' AND `status`='Active' "));
$Inact_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `is_deleted`='0' AND `status`='Inactive' "));
$sch_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `is_deleted`='0' AND `status`='Schedule'  AND `published`='0'"));
$exp_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') < NOW() AND `is_deleted`='0'"));
$dlt_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `is_deleted`='1' "));
$tttl_grb_deal_Count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `deals_order` GROUP BY order_token"));
$membershipCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor_membership` WHERE status='Active' GROUP BY vendor_id ORDER BY `vendor_membership`.`vendor_id` DESC"));
$lmdMemeCOunt = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE status='1' GROUP BY vendor_id ORDER BY `id` DESC"));
$lmdEarningq = mysqli_query($con, "SELECT lmo.*, v.user_name, lmp.plan_name, lmp.plan_deal_items FROM lmd_order lmo, vendor v, last_minute_deals_plan lmp WHERE lmo.vendor_id = v.id AND lmo.plan_id = lmp.id AND payment_status = 'complete' GROUP BY lmo.order_id");


$memEarningq = mysqli_query($con, "SELECT mo.*, v.user_name, mp.plan_name, v.vendor_code FROM mem_order mo, vendor v, membership_plan mp WHERE mo.vendor_id = v.id AND mo.plan_id = mp.id AND payment_status = 'complete' GROUP BY mo.order_id");



if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
    if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
        $ttl_usrCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `user` WHERE `is_deleted`='0' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'"));

        $ttl_vndCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor` WHERE `is_deleted`='0' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'"));

        $act_vndCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor` WHERE `is_deleted`='0' AND status='Active' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'"));

        $pnd_vndCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor` WHERE `is_deleted`='0' AND status !='Active' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'"));

        $act_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND `is_deleted`='0' AND status='Active' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'"));

        $Inact_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `is_deleted`='0' AND status='Inactive' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'"));


        $sch_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `is_deleted`='0' AND `status`='Schedule'  AND `published`='0' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'" ));

        $exp_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') < NOW() AND `is_deleted`='0' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00'"));

        $dlt_DealCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `is_deleted`='1' AND ins_date BETWEEN '$_POST[datefrom] 00:00:00' AND '$_POST[dateto] 00:00:00' "));


        $tttl_grb_deal_Count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `deals_order` WHERE ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]'  GROUP BY order_token"));

        $membershipCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor_membership` WHERE status='Active' AND add_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' GROUP BY vendor_id ORDER BY `vendor_membership`.`vendor_id` DESC"));

        $lmdMemeCOunt = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE status='1' AND add_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' GROUP BY vendor_id ORDER BY `id` DESC"));

        $lmdEarningq = mysqli_query($con, "SELECT lmo.*, v.user_name, lmp.plan_name, lmp.plan_deal_items FROM lmd_order lmo, vendor v, last_minute_deals_plan lmp WHERE lmo.vendor_id = v.id AND lmo.plan_id = lmp.id AND payment_status = 'complete' AND lmo.payment_date BETWEEN  '$_GET[datefrom]' AND '$_GET[dateto]'  GROUP BY lmo.order_id");


        $memEarningq = mysqli_query($con, "SELECT mo.*, v.user_name, mp.plan_name , v.vendor_code  FROM mem_order mo, vendor v, membership_plan mp WHERE mo.vendor_id = v.id AND mo.plan_id = mp.id AND payment_status = 'complete' AND mo.payment_date BETWEEN '$_GET[datefrom]' AND '$_GET[dateto]'  GROUP BY mo.order_id");
    }
}


$total = 0;
while ($lmdEarning = mysqli_fetch_array($lmdEarningq)) {
    $total = $total + $lmdEarning['paid_amnt'];
}

$Lmdtotal = 0;
while ($memEarning = mysqli_fetch_array($memEarningq)) {
    $Lmdtotal = $Lmdtotal + $memEarning['paid_amnt'];
}
?>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
    </div>
    <?php include('date-selector.php'); ?>
</div>

<div class="row">
    <div class="col-12 col-xl-12">
        <div class="row">
            <?php
            if (authChecker('admin', ['view_user', 'edit_user'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='users.php?<?= $urltoken . $urltoken ?>&type=all<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? '&datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">




                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Total Customers</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $ttl_usrCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Users</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (authChecker('admin', ['total_vendor_dashboard', 'view_vendor', 'edit_vendor'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='vendors.php?<?= $urltoken . $urltoken ?>&type=all&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Total Vendors</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $ttl_vndCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Vendors</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>


            <?php
            if (authChecker('admin', ['active_vendor_dashboard', 'view_vendor', 'edit_vendor'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='vendors.php?<?= $urltoken . $urltoken ?>&type=active&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Active Vendors</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $act_vndCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Active</span>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (authChecker('admin', ['pending_vendor_dashboard', 'view_vendor', 'edit_vendor'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='vendors.php?<?= $urltoken . $urltoken ?>&type=pending&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Pending Vendors</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $pnd_vndCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>Pending</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <div class="row">
            <?php
            if (authChecker('admin', ['active_deal_dashboard', 'view_deal', 'edit_offer'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='view-offers.php?<?= $urltoken . $urltoken ?>&type=active&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Active Deals</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $act_DealCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Active</span>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (authChecker('admin', ['view_deal', 'edit_offer'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='view-offers.php?<?= $urltoken . $urltoken ?>&type=schedule&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Schedule Deals</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $sch_DealCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>Schedule</span>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (authChecker('admin', ['inactive_deal_dashboard', 'view_deal', 'edit_offer'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='view-offers.php?<?= $urltoken . $urltoken ?>&type=inactive&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Inactive Deals</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $Inact_DealCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>Inactive</span>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (authChecker('admin', ['expired_deal_dashboard', 'view_deal', 'edit_offer'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='view-offers.php?<?= $urltoken . $urltoken ?>&type=expired&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Expired Deals</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $exp_DealCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>Expired</span>

                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (authChecker('admin', ['deleted_deal_dashboard', 'view_deal', 'edit_offer'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" style="cursor: pointer;" onclick="location.href='view-offers.php?<?= $urltoken . $urltoken ?>&type=dlt&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Deleted Deals</h6>
                                <div class="dropdown mb-2">
                                    <!-- <a type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                </a> -->
                                    <!-- <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                    <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View All</span></a>

                                </div> -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $dlt_DealCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>Deleted</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (authChecker('admin', ['grabbed_deal_dashboard'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" onclick="location.href='grabbed-deals.php?<?= $urltoken . $urltoken ?>&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'" style="cursor: pointer;">




                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Total Grabbed Deals</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $tttl_grb_deal_Count ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Grabbed Deals</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <?php
            if (authChecker('admin', ['membership_subscription'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" onclick="location.href='membership.php?<?= $urltoken . $urltoken ?>&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'" style="cursor: pointer;">




                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Total Subscription </h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $membershipCount ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Membership</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (authChecker('admin', ['falsh_deal_subscription'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" onclick="location.href='flash-deal.php?<?= $urltoken . $urltoken ?>&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'" style="cursor: pointer;">




                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-2">Total Flash Deal</h6>

                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-7">
                                    <h3 class="mb-2"><?= $lmdMemeCOunt ?></h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>Membership</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-5">
                                    <img src="assets/images/analytics.svg" class="svg_img header_svg" alt="icon">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            if (authChecker('admin', ['earning_dashboard', 'view_earning'])) {
            ?>
                <div class="col-md-3 grid-margin">
                    <div class="card">
                        <div class="card-body" onclick="location.href='earnings.php?<?= $urltoken . $urltoken ?>&<?= (isset($_POST['datefrom']) && isset($_POST['dateto'])) ? 'datefrom=' . $_POST['datefrom'] . '&dateto=' . $_POST['dateto'] . '' : ''; ?>&<?= $urltoken . $urltoken ?>'" style="cursor: pointer;">




                            <div class="d-flex justify-content-center text-center align-items-baseline">
                                <h6 class="card-title mb-2">Total Earning</h6>

                            </div>
                            <div class="row text-center">
                                <div class="col-6 col-md-12 col-xl-12 ">
                                    <h3 class="mb-2">RS: <span id="totalEarnig"></span></h3>
                                    <div class="d-flex justify-content-center align-items-baseline">
                                        <p class="text-success text-center">
                                            <span>INR Earning</span>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
    </div>
</div> <!-- row -->



<?php include('includes/footer.php'); ?>

<script>
    var memTamnt = <?= $total ?>;
    var LmdTamnt = <?= $Lmdtotal ?>; 

    var totalEarnig = (memTamnt + LmdTamnt);
    $("#totalEarnig").text(totalEarnig);
</script>

 