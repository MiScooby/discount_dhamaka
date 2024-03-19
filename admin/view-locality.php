<?php include('includes/header.php');

if (!authChecker('admin', ['view_locality', 'edit_locality'])) {
    noAccessPage();
}

?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">

<style>
    .stsopt {
        width: 150px;
        display: unset;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Locality <Details></Details>
                </h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>LOCALITY NAME</th>
                                <th>LOCALITY</th>
                                <th>STATE</th>
                                <th>STATUS</th>
                                <?php
                                if (authChecker('admin', ['edit_locality'])) {
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
                            $getLocality = mysqli_query($con, "SELECT * FROM `locality` ORDER BY `locality_name` ASC");
                            while ($mainLoc = mysqli_fetch_array($getLocality)) {

                            ?>

                                <tr>
                                    <td>#<?= $i++ ?></td>
                                    <td><?= $mainLoc['locality_name'] ?></td>
                                    <td><?= $mainLoc['locality'] ?></td>
                                    <td><?= $mainLoc['state'] ?></td>
                                    <td><span class="badge  <?= ($mainLoc['status'] == 'Active') ? ' bg-success' : 'bg-danger'; ?>"><?= $mainLoc['status'] ?></span></td>
                                    <?php
                                if (authChecker('admin', ['edit_locality'])) {
                                ?>
                                    <td>

                                        <select name="usr_sts" id="loc_sts" data-id="<?= $mainLoc['id'] ?>" class="stsopt form-select">
                                            <option value="Active" <?php if ($mainLoc['status'] == "Active") {
                                                                        echo "selected";
                                                                    } ?>>Active</option>
                                            <option value="Inactive" <?php if ($mainLoc['status'] == "Inactive") {
                                                                            echo "selected";
                                                                        } ?>>Inactive</option>
                                        </select>

                                        <a href="edit-locality.php?<?= $urltoken . $urltoken . '&&locid=' . $mainLoc['id'] . '&&' . $urltoken . $urltoken ?>" class="btn btn-primary p-1 px-2"><i class="fa fa-pencil"></i></a>
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
</div>



<?php include('includes/footer.php'); ?>
<script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>

<script>
    $(function() {
        'use strict';

        $(function() {
            $('#dataTableExample').DataTable({
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
        });



    });
    $(document).on("change", "#loc_sts", function() {
        var loCId = $(this).attr('data-id');
        var loc_sts = $(this).val();
        // alert(loc_sts);
        $.ajax({
            url: "ajax/locality.php",
            type: "POST",
            data: {
                loCId: loCId,
                loc_sts: loc_sts,
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
</script>