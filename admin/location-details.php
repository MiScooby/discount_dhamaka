<?php include('includes/header.php'); 
 
if (!authChecker('admin', ['view_locality'])) { noAccessPage(); }

?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">

<?php
if (isset($_GET['loc_id'])) {
    $id = $_GET['loc_id'];
    $getAReaDet = mysqli_query($con, "SELECT * FROM `locality` WHERE `id`='$id' ");
    $loca = mysqli_fetch_array($getAReaDet);
}
?>
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
        <h4 class="mb-3 mb-md-0">Location : <?= $loca['locality_name']; ?></h4>
    </div>
    <div class="d-flex align-items-center flex-wrap text-nowrap">

    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Area Table</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>AREA NAME</th>
                                <th>STATUS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = "1";

                            $getArea = mysqli_query($con, "SELECT * FROM `locality_area` WHERE `parent_locality`='$id' ");
                            while ($mainArea = mysqli_fetch_array($getArea)) {

                            ?>

                                <tr>
                                    <td>#<?= $i++ ?></td>
                                    <td><?= $mainArea['area_name'] ?></td>
                                   
                                    <td><span class="badge bg-success"><?= $mainArea['status'] ?></span></td>
                                    <td>
                                        <a href="edit-location.php?<?= $urltoken ?>&<?= $urltoken ?>&&area_loc_id=<?= $mainArea['id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-primary btn-icon">
                                            <i data-feather="edit"></i>
                                        </a>
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
        });

    });
</script>