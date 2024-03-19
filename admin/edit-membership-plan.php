<?php include('includes/header.php');

if ((isset($_GET['id'])) &&  (isset($_GET['plan']))) {
    $id = $_GET['id'];
    $plan = $_GET['plan'];
}

if ($plan == "mem") {
    $planName = "Membership";
    $getData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `id`='$id' "));
} else if ($plan == "lmd") {
    $planName = "Flash deal ";
    $getData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `last_minute_deals_plan` WHERE `id`='$id' "));
}

?>
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<style>
    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 4px;
    }
</style>
<div class="row justify-content-center">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title mb-3 text-center">Edit <?= $planName ?> Plan</h6>

                <form class="forms-sample row" id="addMemPlanForm" enctype="multipart/form-data">
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label"><?= $planName ?> Category Name</label>
                        <input type="text" readonly value="<?= $getData['cat_name'] ?>" class="form-control" id="" name="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label"><?= $planName ?> Plan Grade</label>
                        <input type="text" readonly value="<?= $getData['plan_grade'] ?>" class="form-control" id="" name="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label"><?= $planName ?> Plan Types</label>
                        <input type="text" readonly value="<?= $getData['plan_type'] ?>" class="form-control" id="" name="">
                    </div>
                    <div class="col-sm-6 mb-3">
                        <label for="" class="form-label"><?= $planName ?> Plan Name</label>
                        <input type="text" readonly value="<?= $getData['plan_name'] ?>" class="form-control" id="" name="">
                    </div>
                    <?php
                    if ($plan == "mem") {
                    ?>
                        <div class="mb-3">
                            <label for="<?= $plan ?>PlanDays" class="form-label"><?= $planName ?> Plan Days</label>
                            <input type="text" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" value="<?= $getData['plan_days'] ?>" class="form-control" id="<?= $plan ?>PlanDays" name="<?= $plan ?>PlanDays" required placeholder="Enter <?= $planName ?> Plan Days">
                        </div>
                    <?php
                    } else if ($plan == "lmd") {
                    ?>
                        <div class="mb-3">
                            <label for="<?= $plan ?>PlanDays" class="form-label"><?= $planName ?> Plan Items</label>
                            <input type="text" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" value="<?= $getData['plan_deal_items'] ?>" class="form-control" id="<?= $plan ?>Planitems" name="<?= $plan ?>PlanDays" required placeholder="Enter <?= $planName ?> Plan Items">
                        </div>
                    <?php
                    }
                    ?>




                    <div class="mb-3">
                        <label for="<?= $plan ?>PlanAmnt" class="form-label"><?= $planName ?> Plan Amount</label>
                        <input type="text" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" value="<?= $getData['plan_amnt'] ?>" class="form-control" id="<?= $plan ?>PlanAmnt" name="<?= $plan ?>PlanAmnt" required placeholder="Enter <?= $planName ?> Plan Amount">
                    </div>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary me-2 w-50" data-id="<?= $getData['id'] ?>" id="Edit<?= $plan ?>PlanBtn">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script>
    $(function() {
        'use strict'

        if ($("#memPlanType").length) {
            $("#memPlanType").select2({
                placeholder: "Select Any Plan Type"
            });
        }

    });

    $(document).on("click", "#EditmemPlanBtn", function() {
        planId = $(this).attr('data-id');
        memPlanDays = $('#memPlanDays').val();
        memPlanAmnt = $('#memPlanAmnt').val();

        if (memPlanDays == "") {
            alert("Please Enter Plan days ");
        } else if (memPlanAmnt == "") {
            alert("Please Enter Plan Amount ");
        } else {
            $.ajax({
                url: 'ajax/membership-plan.php',
                type: "POST",
                async: false,
                data: {
                    planId: planId,
                    memPlanDays: memPlanDays,
                    memPlanAmnt: memPlanAmnt,
                    type: 'EditmemPlan'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        location.reload();
                        // alert(data.message);
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    });

    $(document).on("click", "#EditlmdPlanBtn", function() {
        planId = $(this).attr('data-id');
        lmdPlanitems = $('#lmdPlanitems').val();
        lmdPlanAmnt = $('#lmdPlanAmnt').val();

        if (lmdPlanitems == "") {
            alert("Please Enter Plan Items ");
        } else if (lmdPlanAmnt == "") {
            alert("Please Enter Plan Amount ");
        } else {
            $.ajax({
                url: 'ajax/membership-plan.php',
                type: "POST",
                async: false,
                data: {
                    planId: planId,
                    lmdPlanitems: lmdPlanitems,
                    lmdPlanAmnt: lmdPlanAmnt,
                    type: 'EditlmdPlan'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        location.reload();
                        // alert(data.message);
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    });
</script>