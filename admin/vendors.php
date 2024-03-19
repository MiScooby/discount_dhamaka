<?php include('includes/header.php');

if (!authChecker('admin', ['view_vendor', 'edit_vendor'])) {
    noAccessPage();
}

if (isset($_GET['type']) && $_GET['type'] == "active") {
    if (isset($_GET['datefrom']) && isset($_GET['dateto'])) {
        if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
            $getCendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE    `status`='Active'  AND ins_date BETWEEN '$_GET[datefrom] 00:00:00' AND '$_GET[dateto] 00:00:00' ORDER BY `vendor`.`id` DESC ");
        }
    } else {
        $getCendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE    `status`='Active' ORDER BY `vendor`.`id` DESC");
    }
} else if (isset($_GET['type']) && $_GET['type'] == "pending") {


    if (isset($_GET['datefrom']) && isset($_GET['dateto'])) {
        if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
            $getCendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE    `status`='Inactive' OR `edited`='1' AND ins_date BETWEEN '$_GET[datefrom] 00:00:00' AND '$_GET[dateto] 00:00:00' ORDER BY `vendor`.`id` DESC ");
        }
    } else {
        $getCendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE    `status`='Inactive' OR `edited`='1' ORDER BY `vendor`.`id` DESC");
    }
} else if (isset($_GET['type']) && $_GET['type'] == "all") {
    if (isset($_GET['datefrom']) && isset($_GET['dateto'])) {
        if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
            $getCendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE    ins_date BETWEEN '$_GET[datefrom] 00:00:00' AND '$_GET[dateto] 00:00:00' ORDER BY `vendor`.`id` DESC ");
        }
    } else {
        $getCendorQ = mysqli_query($con, "SELECT * FROM `vendor`  ORDER BY `vendor`.`id` DESC");
    }
} else {
    $getCendorQ = mysqli_query($con, "SELECT * FROM `vendor` ORDER BY `vendor`.`id` DESC");
}

?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">

<style>
    ul.mytbltb {
        background: #fafafa69;
        padding: 10px 15px;
        border-radius: 12px;
        border: 1px solid #f8f8f8e6;
    }

    .mytbltb .mytbllitb {
        display: inline-block;
        border: 1px solid #7987a14f;
        color: #7987a1;
        padding: 2px 10px;
        width: 120px;
        margin-right: 10px;
        border-radius: 12px;
        cursor: pointer;
        text-align: center;
    }

    .mytbltb .mytbllitb.active {
        background: #729fbe;
        color: white;
    }

    .mytbldata {
        display: none;
    }

    .mytbldata.active {
        display: block;
    }

    .cmn_tr {
        display: none !important;
    }

    .cmn_tr.active {
        display: table-row !important;
    }

    .user_stsopt {
        cursor: pointer;
        width: 90px;
        display: inline-block;
        padding: 0.469rem 8px 0.469rem 8px;
    }

    .checkMe {
        cursor: pointer;
    }
</style>


<div class="row">
    <div class="col-md-6  stretch-card align-items-center">
        <h5 class="card-title">VENDOR USERS LIST</h5>
    </div>
    <?php
    if (authChecker('admin', ['add_vendor'])) {
    ?>
        <div class="col-md-6 mb-2 grid-margin stretch-card justify-content-end">
            <a href="add-vendor.php" class="btn btn-success me-2">Add Vendor</a>
        </div>
    <?php
    }
    ?>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="dataTableExample table table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>USERNAME</th>
                                <th>TOKEN</th>
                                <th>NAME</th>
                                <th>Mobile</th>
                                <th>STATUS</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="">
                            <?php

                            while ($getVendor = mysqli_fetch_array($getCendorQ)) {
                            ?>
                                <tr class="customer_list all_users cmn_tr active">
                                    <td><input type="checkbox" class="checkMe" name="checkMe"></td>
                                    <td>
                                        <div class="usernmimg">
                                            <img src="assets/images/faces/face1.png" alt="user-img" style="width:30px;height:30px;">
                                            <span><?= $getVendor['user_name'] ?></span>
                                        </div>
                                    </td>
                                    <td><?= $getVendor['vendor_code']; ?></td>

                                    <td><?= $getVendor['f_name'] . " " . $getVendor['l_name'] ?></td>
                                    <td><?= $getVendor['c_code'] . $getVendor['mobile_num']; ?></td>
                                    <td>
                                        <?php
                                        if ($getVendor['is_deleted'] == "1") {
                                        ?>
                                            <span class="badge bg-danger">Deleted</span>
                                        <?php
                                        } else if ($getVendor['edited'] == "1") {
                                        ?>
                                            <span class="badge bg-warning">Currently Edited</span>
                                        <?php
                                        } else if ($getVendor['status'] == "Active") {
                                        ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php
                                        } else if ($getVendor['status'] == "Not Approved") {
                                        ?>
                                            <span class="badge bg-warning">Not Approved</span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="view-vendor.php?<?= $urltoken ?>$<?= $urltoken ?>$<?= $urltoken ?>&&vendor_id=<?= $getVendor['id'] ?>&&<?= $urltoken ?>$<?= $urltoken ?>" class="btn btn-success">View</a>

                                        <?php
                                        $checkBrnad = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$getVendor[id]' "));

                                        if ($checkBrnad > 0) {
                                        ?>
                                            <a href="vendor-brand.php?<?= $urltoken ?>$<?= $urltoken ?>$<?= $urltoken ?>&&vendor_id=<?= $getVendor['id'] ?>&&<?= $urltoken ?>$<?= $urltoken ?>" class="btn btn-success">View Brand</a>
                                        <?php
                                        }
                                        ?>



                                    </td>
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
<script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>

<script>
    $(function() {
        'use strict';

        $(function() {
            $('.dataTableExample').DataTable({
                "aLengthMenu": [
                    [10, 30, 50, -1],
                    [10, 30, 50, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    search: ""
                }
            });
            $('.dataTableExample').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });


        });


    });
</script>