<?php include('includes/header.php');

if (!authChecker('admin', ['view_user', 'edit_user'])) {
    noAccessPage();
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
        <h5 class="card-title">CUSTOMERS USERS LIST</h5>
    </div>
    <?php
    if (authChecker('admin', ['add_user'])) {
    ?>
        <div class="col-md-6 mb-2 grid-margin stretch-card justify-content-end">
            <a href="add-user.php" class="btn btn-success me-2">Add User</a>
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
                                <th>S.NO</th>
                                <th>USERNAME</th>
                                <th>NAME</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>STATUS</th>
                                <th>Action</th>

                            </tr>
                        </thead>

                        <tbody class="">
                            <?php
                            $i = "1";
                            if (isset($_GET['datefrom']) && isset($_GET['dateto'])) {
                                if (!empty($_GET['datefrom']) && !empty($_GET['dateto'])) {
                                    $getUserQ = mysqli_query($con, "SELECT * FROM `user` WHERE `is_deleted`='0' AND ins_date BETWEEN '$_GET[datefrom] 00:00:00' AND '$_GET[dateto] 00:00:00' ORDER BY `user`.`id` DESC ");
                                }
                            } else {
                                $getUserQ = mysqli_query($con, "SELECT * FROM `user` WHERE `is_deleted`='0' ORDER BY `user`.`id` DESC");
                            }


                            while ($getUser = mysqli_fetch_array($getUserQ)) {
                            ?>
                                <tr class="customer_list all_users cmn_tr active">
                                    <td><?= $i++ ?></td>
                                    <td>
                                        <div class="usernmimg">
                                            <img src="assets/images/faces/face1.png" alt="user-img" style="width:30px;height:30px;">
                                            <span><?= $getUser['user_name'] ?></span>
                                        </div>
                                    </td>
                                    <td><?= $getUser['first_name'] . " " . $getUser['last_name'] ?></td>
                                    <td><?= ($getUser['mobile_num'] != null) ? '' . $getUser['mobile_num'] . '' : 'n/a'; ?></td>
                                    <td><?= ($getUser['email_id'] != null) ? '' . $getUser['email_id'] . '' : 'n/a'; ?></td>

                                    <td>
                                        <?php
                                        if ($getUser['status'] == 'Active') {
                                        ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php
                                        } else {
                                        ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php
                                        }
                                        ?>
                                    </td>

                                    <td>
                                        <a href="view-user.php?<?= $urltoken ?>$<?= $urltoken ?>&&user_id=<?= $getUser['id'] ?>&<?= $urltoken ?>$<?= $urltoken ?>" class="btn btn-success">View</a>
                                        <?php
                                        if (authChecker('admin', ['edit_user'])) {
                                        ?>
                                            <select name="usr_sts" id="user_sts" data-id="<?= $getUser['id'] ?>" class="user_stsopt form-select">
                                                <option data-id="" value="Active" <?php if ($getUser['status'] == "Active") {
                                                                                        echo "selected";
                                                                                    } ?>>Active</option>
                                                <option data-id="" value="Inactive" <?php if ($getUser['status'] !== "Active") {
                                                                                        echo "selected";
                                                                                    } ?>>Inactive</option>
                                            </select>
                                        <?php } ?>
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
                scrollX: true,
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
    $(document).ready(function() {
        $(document).on("change", "#user_sts", function() {
            var userId = $(this).attr('data-id');
            var user_sts = $("#user_sts").val();

            $.ajax({
                url: "ajax/customers.php",
                type: "POST",
                async: false,
                data: {
                    userId: userId,
                    user_sts: user_sts,
                    type: 'statusChnage'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        location.reload();

                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                }
            });
        });
    });
</script>