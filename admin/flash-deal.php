<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/datatable/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/datatable/css/buttons.dataTables.min.css">

<?php include('date-selector.php'); ?>
<div class="row">

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Flash Deals Plans</h6>
                <div class="table-responsive">
                <table id="" class="dataTableExample table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Vendor Code</th>
                                <th>Vendor Username</th>
                                <th>Category</th>
                                <th>Subscription Deals</th> 
                                <th>Membership Start Date</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = "#01";
                            $getPlan = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` GROUP BY vendor_id ORDER BY `vendor_last_minute_deal_plan`.`id` DESC");
                            if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
                                if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
                                    $getPlan = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE add_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' GROUP BY vendor_id ORDER BY `vendor_last_minute_deal_plan`.`id` DESC");
                                }
                            } else if (isset($_GET['datefrom']) && isset($_GET['dateto'])) {
                                if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
                                    $getPlan = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE add_date BETWEEN '$_GET[datefrom]' AND '$_GET[dateto]' GROUP BY vendor_id ORDER BY `vendor_last_minute_deal_plan`.`id` DESC");
                                }
                            }


                            while ($planmem = mysqli_fetch_array($getPlan)) {
                                $planDetq = mysqli_query($con, "SELECT vlm.*,v.vendor_code, v.user_name, c.cat_name FROM vendor_last_minute_deal_plan vlm, vendor v, category c  WHERE v.id=vlm.vendor_id AND v.business_cat=c.id AND vlm.vendor_id='$planmem[vendor_id]' GROUP BY `vlm`.`id` ORDER BY `vlm`.`id` DESC");

                                $planDet =  mysqli_fetch_array($planDetq); 
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= ($planDet['vendor_code'] == null) ? 'n/a' : '' . $planDet['vendor_code'] . ''; ?></td>
                                    <td><?= $planDet['user_name']; ?></td>
                                    <td><?= $planDet['cat_name'] ?></td>
                                    <td><?= $planDet['plan_items'] ?> Deal</td> 
                                    <td><?= $planDet['add_date'] ?></td>
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
    $('.dataTableExample').DataTable({
        scrollX: true,
       
       
    });
</script>