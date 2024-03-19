<?php include('includes/header.php');
 
if (!authChecker('admin', ['view_grabbed_deals'])) { noAccessPage(); }

?>
<link rel="stylesheet" href="assets/datatable/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="assets/datatable/css/buttons.dataTables.min.css">

<style>
    .table a {
        color: #000865;
    }
</style>

<?php include('date-selector.php'); ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Category Table</h6>
                <div class="table-responsive">
                    <table class="table dataTableExample">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Id</th>
                                <th>Vendor Brand Name</th>
                                <th>User Name</th>
                                <th>
                                    Coupon Code</th>
                                <th>Deal Name</th>
                                <th>Deal Category</th>
                                <th>Deal Start Date</th>
                                <th>Deal End Date</th>
                                <th>Vendor Email</th>
                                <th>Vendor Mobile</th>
                                <th>User Email</th>
                                <th>User Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = "#01";
                            $getDealDetails = mysqli_query($con, "SELECT dd.*,od.offer_title, c.cat_name, od.offer_start_date, od.offer_start_time, od.offer_end_date, od.offer_end_time, vb.store_name, v.mobile_num as vendor_mob, v.email_id as vendor_email, u.first_name as usr_f_name, u.last_name as usr_l_name, u.mobile_num as usr_mob , u.email_id as usr_email FROM deals_order dd, offer_deals od, vendor v, vendor_brand vb, user u, category c WHERE od.id=dd.deal_id AND od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND dd.user_id=u.user_name AND od.offer_cat=c.id GROUP BY dd.coupon_code ORDER BY `dd`.`id` DESC;");

                            if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
                                if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
                                    $getDealDetails = mysqli_query($con, "SELECT dd.*,od.offer_title, c.cat_name, od.offer_start_date, od.offer_start_time, od.offer_end_date, od.offer_end_time, vb.store_name, v.mobile_num as vendor_mob, v.email_id as vendor_email, u.first_name as usr_f_name, u.last_name as usr_l_name, u.mobile_num as usr_mob , u.email_id as usr_email FROM deals_order dd, offer_deals od, vendor v, vendor_brand vb, user u, category c WHERE od.id=dd.deal_id AND od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND dd.user_id=u.user_name AND od.offer_cat=c.id AND dd.ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' GROUP BY dd.coupon_code ORDER BY `dd`.`id` DESC;");
                                }
                            }else if(isset($_GET['datefrom']) && isset($_GET['dateto'])){
                                if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
                                    $getDealDetails = mysqli_query($con, "SELECT dd.*,od.offer_title, c.cat_name, od.offer_start_date, od.offer_start_time, od.offer_end_date, od.offer_end_time, vb.store_name, v.mobile_num as vendor_mob, v.email_id as vendor_email, u.first_name as usr_f_name, u.last_name as usr_l_name, u.mobile_num as usr_mob , u.email_id as usr_email FROM deals_order dd, offer_deals od, vendor v, vendor_brand vb, user u, category c WHERE od.id=dd.deal_id AND od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND dd.user_id=u.user_name AND od.offer_cat=c.id AND dd.ins_date BETWEEN '$_GET[datefrom]' AND '$_GET[dateto]' GROUP BY dd.coupon_code ORDER BY `dd`.`id` DESC;");
                                }
                            }

                            while ($dealDetail = mysqli_fetch_array($getDealDetails)) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $dealDetail['order_token']; ?></td>
                                    <td><?= $dealDetail['store_name']; ?></td>
                                    <td><?= $dealDetail['usr_f_name']; ?> <?= $dealDetail['usr_l_name']; ?></td>
                                    <td><span class="badge bg-success"><?= $dealDetail['coupon_code']; ?></span></td>
                                    <td><?= $dealDetail['offer_title']; ?></td>
                                    <td><?= $dealDetail['cat_name']; ?></td>
                                    <td><?= $dealDetail['offer_start_date']; ?> <?= $dealDetail['offer_start_time']; ?></td>
                                    <td><?= $dealDetail['offer_end_date']; ?> <?= $dealDetail['offer_end_time']; ?></td>
                                    <td><a href="mailto:<?= $dealDetail['vendor_email']; ?>"><?= $dealDetail['vendor_email']; ?></a></td>
                                    <td><a href="tel:<?= $dealDetail['vendor_mob']; ?>"><?= $dealDetail['vendor_mob']; ?></a></td>
                                    <td><?php if ($dealDetail['usr_email'] != null) {
                                            echo "<a href='mailto:" . $dealDetail['usr_email'] . "'>" . $dealDetail['usr_email'] . "</a>";
                                        } else {
                                            echo '<p class="text-secondary">-</p>';
                                        } ?> </td>
                                    <td><a href="tel:<?= $dealDetail['usr_mob']; ?>"><?= $dealDetail['usr_mob']; ?></a></td>
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