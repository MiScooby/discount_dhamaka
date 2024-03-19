<?php include('includes/header.php');

if (!authChecker('admin', ['view_category', 'edit_category'])) {
    noAccessPage();
}

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
                                <th>S.NO</th>
                                <th>CATEGORY IMAGE</th>
                                <th>CATEGORY NAME</th>
                                <th>SUB CATEGORY</th>
                                <th>STATUS</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = "#01";
                            $getCat = mysqli_query($con, "SELECT * FROM `category` ORDER BY `cat_name` ASC");
                            while ($mainCat = mysqli_fetch_array($getCat)) {
                                $getSUb = mysqli_query($con, "SELECT * FROM `sub_category` WHERE `parent_cat`='$mainCat[id]' AND `trash`= '0' ");
                                $subCount = mysqli_num_rows($getSUb)

                            ?>

                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><img src="../upload/cat-img/<?= $mainCat['cat_img'] ?>" alt=""></td>
                                    <td><?= $mainCat['cat_name'] ?></td>
                                    <td><?= $subCount ?></td>
                                    <td><span class="badge bg-success"><?= $mainCat['status'] ?></span></td>
                                    <td><a href="category-details.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $mainCat['id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-success">View</a>
                                        <?php
                                        if (authChecker('admin', ['edit_category'])) {
                                        ?>
                                            <a href="edit-category.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $mainCat['id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-primary btn-icon">
                                                <i data-feather="edit"></i>
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