<?php include('includes/header.php');

if (!authChecker('admin', ['view_category', 'edit_category', 'view_normal_membership', 'view_flash_deal_membership', 'add_normal_membership', 'add_flash_deal_membership', 'edit_normal_membership', 'edit_flash_deal_membership'])) {
    noAccessPage();
}

?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
<style>
    .table>:not(caption)>*>* {
        padding: 10px;
        background-color: var(--bs-table-bg);
        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    table.dataTable thead th {
        text-align: center;
    }

    table.dataTable td {

        text-align: center;
    }
</style>
<?php
if (isset($_GET['cat_id'])) {
    $id = $_GET['cat_id'];
    $getCatDet = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$id' ");
    $loca = mysqli_fetch_array($getCatDet);
}
?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Category : <?= $loca['cat_name']; ?></h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">
        <?php
        if (authChecker('admin', ['add_normal_membership'])) {
        ?>
            <a href="add-category-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $id ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-primary mx-1">Add Category Plans</a>
        <?php
        }
        ?>

        <?php
        if (authChecker('admin', ['add_flash_deal_membership'])) {
        ?>
            <a href="flash-deal-plan.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $id ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-warning mx-1">Add Flash Deals Plans</a>
        <?php
        }
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Sub Categories</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>SUB CATEGORY IMAGE</th>
                                <th>SUB CATEGORY NAME</th>
                                <th>STATUS</th>
                                <?php
                                if (authChecker('admin', ['edit_category'])) {
                                ?>
                                    <th>Action</th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = "1";

                            $getCat = mysqli_query($con, "SELECT * FROM `sub_category` WHERE `parent_cat`='$id' AND `trash`='0' ");
                            while ($mainCatDet = mysqli_fetch_array($getCat)) {

                            ?>

                                <tr>
                                    <td>#<?= $i++ ?></td>
                                    <td><img src="../upload/cat-img/<?= $mainCatDet['sub_cat_img'] ?>" alt=""></td>
                                    <td><?= $mainCatDet['sub_cat_name'] ?></td>

                                    <td><span class="badge bg-success"><?= $mainCatDet['status'] ?></span></td>
                                    <?php
                                    if (authChecker('admin', ['edit_category'])) {
                                    ?>
                                        <td>
                                            <a href="edit-category.php?<?= $urltoken ?>&<?= $urltoken ?>&&sub_cat_id=<?= $mainCatDet['id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-primary btn-icon">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="javascript:;" data-value="<?= $mainCatDet['id'] ?>" class="btn btn-danger btn-icon" id="subcatdlt">
                                                <i data-feather="trash"></i>
                                            </a>

                                        </td>
                                    <?php
                                    }
                                    ?>
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

    <?php
    if (authChecker('admin', ['view_normal_membership', 'edit_normal_membership'])) {
    ?>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Category Plans</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample2" class="table dataTableExample">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Plan grade</th>
                                    <th>Plan type</th>
                                    <th>Plan name</th>
                                    <th>Plan days</th>
                                    <th>Plan amnt</th>
                                    <th>Status</th>
                                    <?php
                                    if (authChecker('admin', ['edit_normal_membership'])) {
                                    ?>
                                        <th>Action</th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                $getPlan = mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `cat_id`='$id' AND `trash` = '0' ");
                                // echo "SELECT * FROM `membership_plan` WHERE `cat_id`='$id' AND `trash` = '0'";
                                // print_r($mainPlanDet = mysqli_fetch_array($getPlan));
                                // die();
                                while ($mainPlanDet = mysqli_fetch_array($getPlan)) {
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $mainPlanDet['plan_grade'] ?></td>
                                        <td><?= $mainPlanDet['plan_type'] ?></td>
                                        <td><?= $mainPlanDet['plan_name'] ?></td>
                                        <td><?= $mainPlanDet['plan_days'] ?></td>
                                        <td><?= $mainPlanDet['plan_amnt'] ?></td>
                                        <td><span class="badge  <?= ($mainPlanDet['status'] == 1) ? 'bg-success' : 'bg-warning'; ?>"><?= ($mainPlanDet['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>
                                        <?php
                                        if (authChecker('admin', ['edit_normal_membership'])) {
                                        ?>
                                            <td>
                                                <a href="edit-membership-plan.php?<?= $urltoken . $urltoken ?>&&id=<?= $mainPlanDet['id'] ?>&plan=mem&<?= $urltoken . $urltoken ?>" class="btn btn-primary p-1 px-2"><i class="fa fa-pencil"></i></a>

                                            </td>
                                        <?php
                                        }
                                        ?>

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
    <?php
    }
    ?>



    <?php
    if (authChecker('admin', ['view_flash_deal_membership', 'edit_flash_deal_membership'])) {
    ?>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Flash Plans</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample3" class="table dataTableExample">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Plan grade</th>
                                    <th>Plan type</th>
                                    <th>Plan name</th>
                                    <th>Plan Items</th>
                                    <th>Plan Amount</th>
                                    <th>Status</th>
                                    <?php
                                    if (authChecker('admin', ['edit_flash_deal_membership'])) {
                                    ?>
                                        <th>Action</th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $getPlan = "SELECT * FROM `last_minute_deals_plan` WHERE `cat_id`='$id' AND `trash` = '0' ";
                                $getPlanQ = mysqli_query($con, $getPlan);

                                $i = 1;
                                while ($mainPlanDetLmd = mysqli_fetch_array($getPlanQ)) {
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $mainPlanDetLmd['plan_grade'] ?></td>
                                        <td><?= $mainPlanDetLmd['plan_type'] ?></td>
                                        <td><?= $mainPlanDetLmd['plan_name'] ?></td>
                                        <td><?= $mainPlanDetLmd['plan_deal_items'] ?></td>
                                        <td><?= $mainPlanDetLmd['plan_amnt'] ?></td>
                                        <td><span class="badge  <?= ($mainPlanDetLmd['status'] == 1) ? 'bg-success' : 'bg-warning'; ?>"><?= ($mainPlanDetLmd['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>
                                        <?php
                                        if (authChecker('admin', ['edit_flash_deal_membership'])) {
                                        ?>
                                            <td>
                                                <a href="edit-membership-plan.php?<?= $urltoken . $urltoken ?>&&id=<?= $mainPlanDetLmd['id'] ?>&plan=lmd&<?= $urltoken . $urltoken ?>" class="btn btn-primary p-1 px-2"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        <?php
                                        }
                                        ?>

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
    <?php
    }
    ?>
</div>

<?php include('includes/footer.php'); ?>
<script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>

<script>
    $('.trashLMPForm').on('submit', function() {
        let id = document.getElementById(this.id).firstElementChild.name;
        let trimId = id.split("_");
        id = trimId[1];
        $.ajax({
            type: "POST",
            url: "ajax/add-cat.php",
            data: {
                id: id,
                action: 'trashLMP'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                };
            }
        });
    })
    $('.trashCForm').on('submit', function() {
        let id = document.getElementById(this.id).firstElementChild.name;
        let trimId = id.split("_");
        id = trimId[1];
        $.ajax({
            type: "POST",
            url: "ajax/add-cat.php",
            data: {
                id: id,
                action: 'trashC'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                };
            }
        });
    })
    $(function() {
        'use strict';

        $(function() {
            $('#dataTableExample').DataTable({
                "aLengthMenu": [
                    [10, 30, 50, -1],
                    [10, 30, 50, "All"]
                ],
                "iDisplayLength": 10,
                "language": {
                    search: ""
                }
            });
            $('#dataTableExample').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });
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



    $(document).on("click", "#subcatdlt", function() {
        var id = $(this).attr("data-value");
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                $.ajax({
                    url: "ajax/add-cat.php",
                    type: "POST",
                    async: false,
                    data: {
                        id: id,
                        type: 'DltSubcat'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            location.href = "view-category.php";
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                        }
                    }
                });
            }
        });
    });
</script>