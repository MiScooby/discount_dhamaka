<?php include('includes/header.php'); 

if(isset($_GET['role_id'])){
    $roleID = $_GET['role_id'];
    $getDataRole = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `ec_roles_type` WHERE `id`='$roleID' "));
}

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

                <form class="forms-sample" id="EditRoleForm" action="javascript:;" method="post" enctype="multipart/form-data">
                    <div class='loading'></div>
                    <div class="mb-3">
                        <label for="RoleName" class="form-label">Role Name :</label>
                        <input type="text" class="form-control" value="<?=$getDataRole['title'];?>" name="RoleName" required placeholder="Enter Role Name">
                    </div>

                    <div class="mb-3">
                        <div>
                            <label class="form-label">Status </label>
                            <div class="input-field">
                                <select class="js-example-basic-single form-select" id="RoleSts" name="RoleSts" data-width="100%" required>
                                    <option></option>
                                    <option value="1" <?=($getDataRole['status']=='1')?'selected':'';?>>Active</option>
                                    <option value="0" <?=($getDataRole['status']=='0')?'selected':'';?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <input type="hidden" name="EditRoles">
                        <input type="hidden" name="RoleId" value="<?=$getDataRole['id'];?>">
                        <button type="submit" class="btn btn-primary me-2 w-50" id="EditRoleBtn">Submit</button>
                    </div>
                </form>

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
    $(document).on("submit", "#EditRoleForm", function(e) {
        $.ajax({
            type: "POST",
            url: "ajax/roles.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#EditRoleBtn").attr("disabled", "disabled");
                $("#EditRoleBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
                $("#loader").show();

            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#EditRoleBtn").removeAttr("disabled", "disabled");
                    $("#EditRoleBtn").html("Submit");
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#EditRoleForm")[0].reset();
                    $("#EditRoleBtn").removeAttr("disabled", "disabled");
                    $("#EditRoleBtn").html("Submit");
                }
            },
        });


    });
 
</script>