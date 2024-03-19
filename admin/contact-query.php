<?php include('includes/header.php');

if (!authChecker('admin', ['view_contact_query'])) {
    noAccessPage();
}

?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Contact Queries</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>S.NO</th>
                                <th>NAME</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Query</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = "#01";
                            $getContact = mysqli_query($con, "SELECT * FROM `contact_query`ORDER BY `id` DESC");
                            while ($mainContact = mysqli_fetch_array($getContact)) {
                                 

                            ?>

                                <tr>
                                    <td><?= $i++ ?></td>

                                    <td><?= $mainContact['name'] ?></td>
                                    <td><?= $mainContact['email'] ?></td>
                                    <td><?= $mainContact['phone'] ?></td>
                                    <td><div style="overflow: hidden; width: 350px; text-wrap: wrap;"><?= $mainContact['query'] ?></div></td>

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