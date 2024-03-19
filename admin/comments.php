<?php include('includes/header.php');
if (!authChecker('admin', ['view_comment'])) { noAccessPage(); }
?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Category Table</h6>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Product Name</th>
                                <th>Comment</th>
                                <th>Rating</th>
                                <th>User Name</th>
                                <th>Satus</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $getCat = mysqli_query($con, "SELECT c.*, u.first_name, u.last_name, od.offer_title FROM comments c, offer_deals od, user u WHERE c.deal_id=od.id AND c.user_id = u.id AND c.trash='0' ORDER BY `c`.`id` DESC");
                            while ($mainCat = mysqli_fetch_array($getCat)) {                           

                            ?>

                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $mainCat['offer_title'] ?></td>
                                    <td><?= $mainCat['comments'] ?></td>
                                    <td><?= $mainCat['rating'] ?> Star</td>
                                    <td><?= $mainCat['first_name']." ".$mainCat['last_name'] ?></td>
                                    <td><span class="badge <?=($mainCat['status']=="1")?'bg-success':'bg-danger'; ?> "><?=($mainCat['status']=="1")?'Active':'Inactive'; ?></span></td>
                                    <td><a href="view-comment.php?<?= $urltoken ?>&<?= $urltoken ?>&&cmnt_id=<?= $mainCat['id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-success">View</a> 
                                 
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