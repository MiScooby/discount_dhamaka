<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/datatable/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/datatable/css/buttons.dataTables.min.css">

<?php include('date-selector.php'); ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Membership Plans</h6>
                <div class="table-responsive">
                    <table id="" class="dataTableExample table" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Vendor Code</th>
                                <th>Vendor User Name</th>
                                <th>Category</th>
                                <th>Subscription Days</th>
                                <th>Subscription Amount</th>
                                <th>Expiry Date</th>
                                <th>Membership Start Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $getPlan = mysqli_query($con, "SELECT * FROM `vendor_membership`GROUP BY vendor_id ORDER BY `vendor_membership`.`id` DESC");
                            if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
                                if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
                                    $getPlan = mysqli_query($con, "SELECT * FROM `vendor_membership` WHERE add_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' GROUP BY vendor_id ORDER BY `vendor_membership`.`id` DESC");
                                }
                            } else if (isset($_GET['datefrom']) && isset($_GET['dateto'])) {
                                if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
                                    $getPlan = mysqli_query($con, "SELECT * FROM `vendor_membership` WHERE add_date BETWEEN '$_GET[datefrom]' AND '$_GET[dateto]' GROUP BY vendor_id ORDER BY `vendor_membership`.`id` DESC");
                                }
                            }
                            while ($planmem = mysqli_fetch_array($getPlan)) {
                                $planDetq = mysqli_query($con, "SELECT vm.*, v.vendor_code, v.user_name, c.cat_name FROM vendor_membership vm, vendor v, category c WHERE v.id=vm.vendor_id AND c.id=v.business_cat AND vm.vendor_id='$planmem[vendor_id]' GROUP BY vm.vendor_id ORDER BY vm.id");
                                $planDet = mysqli_fetch_array($planDetq);
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= ($planDet['vendor_code'] == null) ? 'n/a' : '' . $planDet['vendor_code'] . ''; ?></td>
                                    <td><?= $planDet['user_name']; ?></td>
                                    <td><?= $planDet['cat_name'] ?></td>
                                    <td><?= $planDet['mem_plan_days'] ?> Day</td>
                                    <td>&#8377;<?= $planDet['mem_plan_amnt'] ?></td>
                                    <td><?= $planDet['expire_date'] ?></td>
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