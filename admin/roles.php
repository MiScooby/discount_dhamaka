<?php include('includes/header.php');
$getRole = mysqli_query($con, "SELECT * FROM `ec_roles_type` ORDER BY id ASC");
?>

<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">

<style>
    .select2-container--default.select2-container--disabled .select2-selection--single {
        background-color: #efefef;
        cursor: no-drop;
        border-color: #d6d6d6;
    }

    .s6 {
        height: 45px;
        line-height: 28px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Add Roles for access control</h6>

                <form class="forms-sample" id="AddRoleForm" action="javascript:;" method="post" enctype="multipart/form-data">
                    <div class='loading'></div>
                    <div class="mb-3">
                        <label for="RoleName" class="form-label">Role Name :</label>
                        <input type="text" class="form-control" name="RoleName" required placeholder="Enter Role Name">
                    </div>

                    <div class="mb-3">
                        <div>
                            <label class="form-label">Status </label>
                            <div class="input-field">
                                <select class="js-example-basic-single form-select" id="RoleSts" name="RoleSts" data-width="100%" required>
                                    <option></option>
                                    <option value="1" selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="hidden" name="AddRoles">
                        <button type="submit" class="btn btn-primary me-2 w-50" id="AddRoleBtn">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card p-3">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="" class="dataTableExample table table-striped">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody class="">
                            <?php
                            $i = 1;
                            while ($getRoleData = mysqli_fetch_array($getRole)) {
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= ucfirst($getRoleData['title']); ?></td>
                                    <td>
                                        <select style="width: 100px;" <?= ($getRoleData['editable'] == 'no') ? 'disabled' : 'class="roleStsCHange"'; ?> data-id="<?= $getRoleData['id'] ?>">
                                            <option value="1" <?= ($getRoleData['status'] == 1) ? 'selected' : ''; ?>>Active</option>
                                            <option value="0" <?= ($getRoleData['status'] == 0) ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </td>
                                    <td>
                                        <?php
                                        if ($getRoleData['editable'] == 'yes') {
                                            $hash_token = encrypt_decrypt($getRoleData['id'] , 'encrypt');
                                        ?>
                                            <a href="edit-role.php?<?= $urltoken ?>&<?= $urltoken ?>&&role_id=<?= $getRoleData['id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-primary btn-icon s6">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a href="javascript:;" id="dltRole" data-id="<?= $getRoleData['id'] ?>" class="btn btn-danger btn-icon s6">
                                                <i data-feather="trash"></i>
                                            </a>

                                            <a href="role-permission.php?rid=<?= $hash_token ?>" class="btn btn-danger ">
                                                Set Permission
                                            </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="javascript:;" style="cursor: no-drop;" class="btn btn-secondary s6">
                                                Not Editable
                                            </a>
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
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>
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
<script>
    $('select').select2();
    $("#RoleSts").select2({
        placeholder: 'Please select an option'
    });
    $(document).on("submit", "#AddRoleForm", function(e) {
        $.ajax({
            type: "POST",
            url: "ajax/roles.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#AddRoleBtn").attr("disabled", "disabled");
                $("#AddRoleBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
                $("#loader").show();

            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#AddRoleBtn").removeAttr("disabled", "disabled");
                    $("#AddRoleBtn").html("Submit");
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#AddRoleForm")[0].reset();
                    $("#AddRoleBtn").removeAttr("disabled", "disabled");
                    $("#AddRoleBtn").html("Submit");
                }
            },
        });


    });
    $(document).on("change", ".roleStsCHange", function() {
        var roleid = $(this).attr('data-id');
        var sts = $(this).val();
        $.ajax({
            url: "ajax/roles.php",
            type: "POST",
            async: false,
            data: {
                roleid: roleid,
                sts: sts,
                type: 'RolestatusChnage'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });
    });
    $(document).on("click", "#dltRole", function() {
        var roleid = $(this).attr('data-id');
        $.ajax({
            url: "ajax/roles.php",
            type: "POST",
            async: false,
            data: {
                roleid: roleid, 
                type: 'RoleDlt'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });
    });
</script>