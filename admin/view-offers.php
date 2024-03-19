<?php include('includes/header.php');


if (!authChecker('admin', ['view_deal', 'edit_offer'])) {
    noAccessPage();
}

if (isset($_GET['type']) && $_GET['type'] == "active") {
    if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
        if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
            $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd , od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND CONCAT( od.offer_end_date,' ',od.offer_end_time,':00') > NOW() AND v.is_deleted='0' AND od.status= 'Active' AND od.is_deleted= '0' AND od.ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' ORDER BY od.id DESC");
        }
    } else {
        $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd , od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND CONCAT( od.offer_end_date,' ',od.offer_end_time,':00') > NOW() AND v.is_deleted='0' AND od.status= 'Active' AND od.is_deleted= '0' ORDER BY `od`.`id` DESC");
    }
} else if (isset($_GET['type']) && $_GET['type'] == "inactive") {
    if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
        if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
            $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id  AND od.is_deleted='0' AND od.status= 'Inactive' AND od.ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]'");
        }
    } else {
        $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND od.is_deleted='0' AND od.status= 'Inactive' ORDER BY `od`.`id` DESC;");
    }
} else if (isset($_GET['type']) && $_GET['type'] == "expired") {
    if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
        if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
            $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND CONCAT( od.offer_end_date,' ',od.offer_end_time,':00') < NOW() AND od.is_deleted='0' AND ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]'");
        }
    } else {
        $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND CONCAT( od.offer_end_date,' ',od.offer_end_time,':00') < NOW() AND od.is_deleted='0' ORDER BY `od`.`id` DESC");
    }

    $exp = "Expired";
} else if (isset($_GET['type']) && $_GET['type'] == "dlt") {
    if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
        if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
            $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id  AND od.is_deleted='1' AND ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]'");
        }
    } else {
        $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND od.is_deleted='1' ORDER BY `od`.`id` DESC");
    }

    $exp = "Deleted";
} else if (isset($_GET['type']) && $_GET['type'] == "schedule") {
    if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
        if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
            $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id  AND od.is_deleted='1' AND ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]'");
        }
    } else {
        $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND od.is_deleted='0' AND od.status='schedule' AND od.published='0' ORDER BY `od`.`id` DESC");
    }

    $exp = "Schedule";
} else {


    if (isset($_POST['datefrom']) && isset($_POST['dateto'])) {
        if (!empty($_POST['datefrom']) && !empty($_POST['dateto'])) {
            $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id AND od.ins_date BETWEEN '$_POST[datefrom]' AND '$_POST[dateto]' ORDER BY `od`.`id` DESC");
        }
    } else {
        $myofferdealsql = mysqli_query($con, "SELECT od.*, v.vendor_code, v.is_deleted as ven_is_dltd, od.is_deleted as od_is_dltd,vb.store_name, c.cat_name, od.edited as deal_edited FROM offer_deals od, vendor v, vendor_brand vb, category c WHERE od.vendor_id=v.id AND od.vendor_id=vb.vendor_id AND od.offer_cat=c.id ORDER BY `od`.`id` DESC");
    }
}

?>
<link rel="stylesheet" href="assets/datatable/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<style>
    .checkMe {
        cursor: pointer;
    }

    .offerdeal h5 {
        color: #6571ff;
        font-size: 12px;
    }

    .offerdeal .sts_true,
    .offerdeal .sts_false {
        font-size: 11px;
        font-weight: 500;
        padding: 1px 2px;
        position: relative;
        top: 2px;
    }

    .offerdeal .sts_true {
        color: #008000d1;
        background: #e2f4e2;
    }

    .offerdeal .sts_false {
        color: indianred;
        background: #ffefef;
    }

    .offers_list td {
        font-size: 12px;
    }

    .expr_dt {
        color: indianred;
        background: #ffd9d973;
        padding: 2px 3px;
        font-weight: 500;
    }

    .edit_ofr,
    .dlt_ofr {
        font-size: 14px;
        font-weight: 600;

    }

    .edit_ofr {
        background: #ddffdd;
        color: #008000f5;
        padding: 4px 4px 3px 7px;
        margin-right: 15px;
        border: 1px solid #d7e7d7;
        border-radius: 5px;
    }

    tr.offers_list td {
        padding: 12px 9px;
    }

    .dlt_ofr {
        background: #ffeeee;
        color: #bb3b3b;
        padding: 4px 7px 3px 7px;
        border: 1px solid #e7d5d5c7;
    }
</style>


<div class="row">
    <div class="col-md-3  stretch-card align-items-center">
        <h5 class="card-title">OFFERS LIST</h5>
    </div>
    <div class="col-md-9 mb-2 grid-margin stretch-card justify-content-end">
        <?php include('date-selector.php'); ?>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="dataTableExample table table-bordered no-wrap table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Deal Code</th>
                                <th>Deal Title</th>
                                <th>Vendor Code</th>
                                <th>Store Name</th>
                                <th>Category</th>
                                <th>In Slider</th>
                                <th>Deal Items</th>
                                <th>Click</th>
                                <th>View</th>
                                <th>Expire Date</th>
                                <th>Date</th>

                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="">

                            <?php
                            $i = 1;
                            while ($ofrdlsrow = mysqli_fetch_array($myofferdealsql)) {
                                $currentSrbTime = date("Y-m-d H:i");
                                $DealDteTime = $ofrdlsrow['offer_end_date'] . ' ' . $ofrdlsrow['offer_end_time'];
                            ?>

                                <tr class="offers_list">
                                    <td><?= $i++ ?></td>
                                    <td><?= ($ofrdlsrow['deal_code'] == null) ? 'null' : '' . $ofrdlsrow['deal_code'] . ''; ?></td>
                                    <td style="width: 100px !important; ">
                                        <div class="offerdeal">
                                            <h5><a href="edit_offer.php?id=<?= $ofrdlsrow['id']; ?>"><?= $ofrdlsrow['offer_title']; ?></a></h5>
                                            <?php
                                            if (isset($exp)) {
                                            ?>
                                                <span class="sts_false"><?= $exp ?></span>
                                            <?php
                                            } else if ($ofrdlsrow['od_is_dltd'] == 1) {
                                                ?>
                                                <span class="sts_false"><?= "Deal Deleted"?></span>

                                                <?php
                                            } else if ((strtotime($DealDteTime) < strtotime($currentSrbTime))) {
                                            ?>
                                                <span class="sts_false"><?= "Expired"?></span>
                                            <?php
                                            } else {
                                            ?>
                                                <?php
                                                if ($ofrdlsrow['ven_is_dltd']) { ?>
                                                    <span class='sts_false'>Vendor Deleted</span>
                                                    <?php   } else if ($ofrdlsrow['od_is_dltd'] == 0) {

                                                    if ($ofrdlsrow['status'] == "Active") {
                                                    ?>
                                                        <span class='sts_true'>Active</span>
                                                    <?php
                                                    } else if ($ofrdlsrow['deal_edited'] == 1) {
                                                    ?>
                                                        <span class='sts_false'>Deal Edited</span>
                                                    <?php
                                                    } elseif ($ofrdlsrow['status'] == "Schedule") {
                                                    ?>
                                                        <span class='sts_false' style="color: #6f0b0b; background: #ffce00;">Schedule</span>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <span class='sts_false'><?= $ofrdlsrow['status']; ?></span>
                                                    <?php

                                                    }
                                                } else { ?>
                                                    <span class='sts_false'>Deal Deleted</span>

                                                <?php } ?>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td><?= ($ofrdlsrow['vendor_code'] == null) ? 'null' : '' . $ofrdlsrow['vendor_code'] . ''; ?></td>
                                    <td style="width: 100px !important; ">

                                        <?= $ofrdlsrow['store_name']; ?>

                                    </td>
                                    <td>

                                        <?= $ofrdlsrow['cat_name']; ?>

                                    </td>
                                    <td><?= $ofrdlsrow['is_slider']; ?></td>
                                    <td><?= $ofrdlsrow['deal_times']; ?></td>
                                    <td><?= $ofrdlsrow['click']; ?></td>
                                    <td><?= $ofrdlsrow['view']; ?></td>
                                    <td><span class="expr_dt"><?= $ofrdlsrow['offer_end_date']; ?>, <?= $ofrdlsrow['offer_end_time']; ?></span></td>
                                    <td><?= $ofrdlsrow['ins_date']; ?></td>

                                    <td>
                                        <?php
                                        if (authChecker('admin', ['edit_offer'])) {
                                        ?>
                                            <a href="edit_offer.php?id=<?= $ofrdlsrow['id']; ?>" class="myact_btn edit_ofr">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="edit_offer.php?id=<?= $ofrdlsrow['id']; ?>" class="myact_btn edit_ofr">
                                                View
                                            </a>
                                        <?php
                                        }
                                        ?>
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