<?php include('includes/header.php');
if (!authChecker('admin', ['view_earning'])) { noAccessPage(); }

?>
<link rel="stylesheet" href="assets/datatable/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/datatable/css/buttons.dataTables.min.css">
<style>
    .mney{
        color: #30d858;
    font-size: 18px;
    font-weight: 600;
    text-shadow: 0 1px 0.5px #034e2a47;
    }
    .ttm{
        border: 1px solid #f5f5f5;
    padding: 15px;
    background: #6571ff;
    color: #fff;
    font-weight: 600;
    box-shadow: 0px 1px 3px 0px #00000029;
    }
</style>


<div class="row align-items-end" >
    <div class="col-md-3  stretch-card align-items-center">
        <h5 class="ttm mb-2">Total Earning : <span id="totalEarnig"></span></h5>
    </div>
    <div class="col-md-9 mb-0 grid-margin stretch-card justify-content-end">
        <?php include('date-selector.php'); ?>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Membership Deals Earning RS: <span class="mney" id="memTamnt"></span> </h6>
                    <div class="table-responsive">
                        <table class="dataTableExample table">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Vendor Code</th>
                                    <th>Username</th>
                                    <th>Order ID</th>
                                    <th>Payment ID</th>
                                    <th>Invoice</th>
                                    <th>Plan Name</th>
                                    <th>Plan Amount</th>
                                    <th>Recived Amount</th>
                                    <th>Plan Days</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = "#01";
                                $total = 0;
                                $getPlanDetails = mysqli_query($con, "SELECT mo.*, v.user_name, mp.plan_name, v.vendor_code FROM mem_order mo, vendor v, membership_plan mp WHERE mo.vendor_id = v.id AND mo.plan_id = mp.id AND payment_status = 'complete' GROUP BY mo.order_id");

                                if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
                                    if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
                                         $getPlanDetails = mysqli_query($con, "SELECT mo.*, v.user_name, mp.plan_name, v.vendor_code  FROM mem_order mo, vendor v, membership_plan mp WHERE mo.vendor_id = v.id AND mo.plan_id = mp.id AND payment_status = 'complete' AND mo.payment_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]'  GROUP BY mo.order_id");
                                    }
                                }else if(isset($_GET['datefrom']) && isset($_GET['dateto'])){
                                    if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
                                        $getPlanDetails = mysqli_query($con, "SELECT mo.*, v.user_name, mp.plan_name , v.vendor_code  FROM mem_order mo, vendor v, membership_plan mp WHERE mo.vendor_id = v.id AND mo.plan_id = mp.id AND payment_status = 'complete' AND mo.payment_date BETWEEN '$_GET[datefrom]' AND '$_GET[dateto]'  GROUP BY mo.order_id");
                                    }
                                }else{
                                    $getPlanDetails = mysqli_query($con, "SELECT mo.*, v.user_name, mp.plan_name, v.vendor_code FROM mem_order mo, vendor v, membership_plan mp WHERE mo.vendor_id = v.id AND mo.plan_id = mp.id AND payment_status = 'complete' GROUP BY mo.order_id");
                                }

                                while ($details = mysqli_fetch_array($getPlanDetails)) {


                                    $total = $total + $details['paid_amnt'];

                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $details['vendor_code'] ?></td>
                                        <td><?= $details['user_name'] ?></td>
                                        <td><?= $details['order_id'] ?></td>
                                        <td><?= $details['payment_id'] ?></td>
                                        <td><a href="../invoice/index.php?<?=$urltoken.$urltoken?>&&invoice=<?=$details['order_id']?>&type=mem&&<?=$urltoken.$urltoken?>" target="_blank">  View Invoice</a></td>
                                        <td><?= $details['plan_name'] ?></td>
                                        <td>&#8377;<?= $details['plan_amnt'] ?></td>
                                        <td>&#8377;<?= $details['paid_amnt'] ?></td>
                                        <td><?= $details['plan_days'] ?></td>
                                        <td><?= $details['payment_date'] ?></td>
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



        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Flash Deals Earning RS: <span class="mney" id="LmdTamnt"></span> </h6>
                    <div class="table-responsive">
                        <table class="dataTableExample table">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Username</th>
                                    <th>Order ID</th>
                                    <th>Payment ID</th>
                                    <th>Invoice</th>
                                    <th>Plan Name</th>
                                    <th>Plan Amount</th>
                                    <th>Recived Amount</th>
                                    <th>Plan Items</th>
                                    <th>Payment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = "#01";
                                $Lmdtotal = 0;
                                $getPlanDetails = mysqli_query($con, "SELECT lmo.*, v.user_name, lmp.plan_name, lmp.plan_deal_items FROM lmd_order lmo, vendor v, last_minute_deals_plan lmp WHERE lmo.vendor_id = v.id AND lmo.plan_id = lmp.id AND payment_status = 'complete' GROUP BY lmo.order_id");

                                if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
                                    if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
                                        $getPlanDetails = mysqli_query($con, "SELECT lmo.*, v.user_name, lmp.plan_name, lmp.plan_deal_items FROM lmd_order lmo, vendor v, last_minute_deals_plan lmp WHERE lmo.vendor_id = v.id AND lmo.plan_id = lmp.id AND payment_status = 'complete' AND lmo.payment_date BETWEEN  '$_POST[datefrom]' AND '$_POST[dateto]'  GROUP BY lmo.order_id");
                                    }
                                }else if(isset($_GET['datefrom']) && isset($_GET['dateto'])){
                                    if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
                                        $getPlanDetails = mysqli_query($con, "SELECT lmo.*, v.user_name, lmp.plan_name, lmp.plan_deal_items FROM lmd_order lmo, vendor v, last_minute_deals_plan lmp WHERE lmo.vendor_id = v.id AND lmo.plan_id = lmp.id AND payment_status = 'complete' AND lmo.payment_date BETWEEN  '$_GET[datefrom]' AND '$_GET[dateto]'  GROUP BY lmo.order_id");
                                    }
                                }else{
                                    $getPlanDetails = mysqli_query($con, "SELECT lmo.*, v.user_name, lmp.plan_name, lmp.plan_deal_items FROM lmd_order lmo, vendor v, last_minute_deals_plan lmp WHERE lmo.vendor_id = v.id AND lmo.plan_id = lmp.id AND payment_status = 'complete' GROUP BY lmo.order_id");
                                }

                                while ($details = mysqli_fetch_array($getPlanDetails)) {
                                    $Lmdtotal = $Lmdtotal + $details['paid_amnt'];
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $details['user_name'] ?></td>
                                        <td><?= $details['order_id'] ?></td>
                                        <td><?= $details['payment_id'] ?></td>
                                        <td><a href="../invoice/index.php?<?=$urltoken.$urltoken?>&&invoice=<?=$details['order_id']?>&type=lmd&&<?=$urltoken.$urltoken?>" target="_blank">  View Invoice</a></td>
                                        <td><?= $details['plan_name'] ?></td>
                                        <td>&#8377;<?= $details['plan_amnt'] ?></td>
                                        <td>&#8377;<?= $details['paid_amnt'] ?></td>
                                        <td><?= $details['plan_deal_items'] ?></td>
                                        <td><?= $details['payment_date'] ?></td>
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



    <?php include('includes/footer.php'); ?>
    <script src="assets/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/datatable/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {
            'use strict';

            $(function() {
                $('.dataTableExample').DataTable({
                    scrollX: true,
                    scrollCollapse: true,
                    autoWidth: false,
                    paging: true,
                    dom: 'Bfrtip',
                    buttons: [
                        'csvHtml5',
                        'excelHtml5',

                    ],
                    columnDefs: [{
                        "width": "150px",
                        "targets": [0, 3]
                    }, ]
                });

            });

        });
    </script>

    <script>
        var memTamnt = <?= $total ?>;
        var LmdTamnt = <?= $Lmdtotal ?>;
        $("#memTamnt").text(memTamnt);
        $("#LmdTamnt").text(LmdTamnt);

        var totalEarnig = (memTamnt + LmdTamnt);
        $("#totalEarnig").text(totalEarnig);
    </script>