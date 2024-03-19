<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
<style>
    tr td {
        padding: 0 15px !important;
        line-height: 55px;
    }
</style>

<div class="row">
    <div class="col-md-6  stretch-card align-items-center">
        <h5 class="card-title">MEMBERSHIP PLANS</h5>
    </div>
    <div class="col-md-6 mb-2 grid-margin stretch-card justify-content-end">
        <a href="add-membership-plan.php" class="btn btn-success me-2">Add Membership Plan</a>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Plan Type</th>
                                <th>Days For Plan</th>
                                <th>Plan Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>#</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            $getPlanListQ = mysqli_query($con, "SELECT * FROM `membership_plan`");
                            while ($getPlanList = mysqli_fetch_array($getPlanListQ)) {
                            ?>
                                <tr>
                                    <td>#<?= $i++ ?></td>
                                    <td><?= $getPlanList['membership_plan'] ?></td>
                                    <td><?= $getPlanList['plan_days'] ?></td>
                                    <td><?= $getPlanList['plan_amnt'] ?></td>
                                    <td> <span class="badge <?= ($getPlanList['status'] == 1) ? 'bg-success' : 'bg-danger'; ?> "><?= ($getPlanList['status'] == 1) ? 'Active' : 'Inactive'; ?></span></td>
                                    <td><?= $getPlanList['ins_date'] ?></td>
                                    <td>
                                        <a href="edit-membership-plan.php?<?= $urltoken ?>$<?= $urltoken ?>&&plan_id=<?= $getPlanList['id'] ?>&<?= $urltoken ?>$<?= $urltoken ?>" class="btn btn-primary">Edit</a>
                                        <a href="javascript:void(0);" id="dltPlan" data-id="<?= $getPlanList['id'] ?>" class="btn btn-danger btn-icon"><i data-feather="trash-2"></i></a>
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

    $(document).on("click", "#dltPlan", function() {
        var PlaNId = $(this).attr('data-id');
        $.ajax({
            url: 'ajax/membership-plan.php',
            type: "POST",
            async: false,
            data: {
                PlaNId: PlaNId,
                type: 'DltMemPlan'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    location.reload();
                } else {
                    alert(data.message);
                }
            }
        });
    });
</script>