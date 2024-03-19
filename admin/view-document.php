<?php include('includes/header.php'); ?>
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
                <h6 class="card-title">Data Table</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>Document NAME</th>
                                <th>STATUS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = "1";
                            $getLocality = mysqli_query($con, "SELECT * FROM `documents` ORDER BY `documents`.`doc_name` ASC");
                            while ($mainDoc = mysqli_fetch_array($getLocality)) {
                            ?>

                                <tr>
                                    <td>#<?= $i++ ?></td>
                                    <td><?= $mainDoc['doc_name'] ?></td>
                                    <td><span class="badge  <?= ($mainDoc['status'] == '1') ? ' bg-success' : 'bg-danger'; ?>"><?= ($mainDoc['status'] == '1') ? 'Active' : 'Inactive'; ?></span></td>
                                    <td>

                                        <select name="usr_sts" id="doc_sts" data-id="<?= $mainDoc['id'] ?>" class="stsopt form-select">
                                            <option value="1" <?php if ($mainDoc['status'] == "1") {
                                                                    echo "selected";
                                                                } ?>>Active</option>
                                            <option value="0" <?php if ($mainDoc['status'] == "0") {
                                                                    echo "selected";
                                                                } ?>>Inactive</option>
                                        </select>
                                        <a id="dltBtn" data-id="<?= $mainDoc['id'] ?>" class="btn btn-danger btn-icon">
                                            <i data-feather="trash"></i>
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
    $(document).on("change", "#doc_sts", function() {
        var DocId = $(this).attr('data-id');
        var doc_sts = $(this).val();
        $.ajax({
            url: "ajax/docs.php",
            type: "POST",
            data: {
                DocId: DocId,
                doc_sts: doc_sts,
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

    $(document).on("click", "#dltBtn", function() {
        var DocId = $(this).attr('data-id');
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
                    url: "ajax/docs.php",
                    type: "POST",
                    data: {
                        DocId: DocId,
                        type: 'dltDocs'
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
            }
        });

    });
</script>