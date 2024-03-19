<?php include('includes/header.php');

?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">




<style>
    .catCls a img {
        border: 2px solid #f5f5f5;
        cursor: pointer;
        border-radius: 10px;
    }

    .cat-type {
        background-color: #6571ff !important;
        opacity: 1;
        color: #fff;
    }

    .dropify-wrapper {
        display: block;
        position: relative;
        cursor: pointer;
        overflow: hidden;
        width: 100%;
        max-width: 70%;
        height: 125px;
        padding: 5px 10px;
        font-size: 14px;
        line-height: 22px;
        color: #777;
        background-color: #FFF;
        background-image: none;
        text-align: center;
        border: 2px solid #E5E5E5;
        -webkit-transition: border-color .15s linear;
        transition: border-color .15s linear;
    }
</style>
<?php
if (isset($_GET['cat_id'])) {
    $id = $_GET['cat_id'];
    $Cat = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$id'");
    $mainCat = mysqli_fetch_array($Cat);
}
?>
<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <?php
            $getCOuntofPlan = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `cat_id`='$id' AND (`plan_grade`='A-Area' OR `plan_grade`='B-Area' OR `plan_grade`='C-Area') GROUP BY plan_grade"));


            $getCOuntofPlanA = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `cat_id`='$id' AND `plan_grade`='A-Area' GROUP BY plan_grade"));
            $getCOuntofPlanB = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `cat_id`='$id' AND `plan_grade`='B-Area' GROUP BY plan_grade"));
            $getCOuntofPlanC = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `membership_plan` WHERE `cat_id`='$id' AND `plan_grade`='C-Area' GROUP BY plan_grade"));


            if ($getCOuntofPlan != 3) {
            ?>
                <div class="card-body">

                    <h6 class="card-title">Add Category Plan</h6>

                    <form class="forms-sample" action="javascript:;" id="CatPlanForm" enctype="multipart/form-data">
                        <div class='loading'></div>
                        <div class="mb-3">
                            <label for="CatPlanName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" readonly name="CatPlanName" value="<?= $mainCat['cat_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="PlanGrade" class="form-label">Plan Grade</label>
                            <select class="js-example-basic-single form-select" id="PlanGrade" name="PlanGrade" data-width="100%" required>
                                <option></option>
                                <option value="A-Area" <?= ($getCOuntofPlanA == 0) ? '' : 'disabled'; ?>>A Area</option>
                                <option value="B-Area" <?= ($getCOuntofPlanB == 0) ? '' : 'disabled'; ?>>B Area</option>
                                <option value="C-Area" <?= ($getCOuntofPlanC == 0) ? '' : 'disabled'; ?>>C Area</option>
                            </select>
                        </div>
                        <div class="mb-3" id="PlanDet" style="display: none;">

                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control cat-type" readonly name="Economy" value="Economy">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <input type="text" required class="form-control mb-3" readonly name="Etype[]" value="Silver">
                                        <input type="text" required class="form-control mb-3" readonly name="Etype[]" value="Gold">
                                        <input type="text" required class="form-control mb-3" readonly name="Etype[]" value="Platinum">
                                    </div>
                                    <div class="col-sm-3">

                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="eDays[]" placeholder="Enter Plan Days">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="eDays[]" placeholder="Enter Plan Days">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="eDays[]" placeholder="Enter Plan Days">
                                    </div>
                                    <div class="col-sm-3">

                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="eAmnt[]" placeholder="Enter Plan Amount">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="eAmnt[]" placeholder="Enter Plan Amount">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="eAmnt[]" placeholder="Enter Plan Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control cat-type" readonly name="Premium" value="Premium">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <input type="text" required class="form-control mb-3" readonly name="pType[]" value="Silver">
                                        <input type="text" required class="form-control mb-3" readonly name="pType[]" value="Gold">
                                        <input type="text" required class="form-control mb-3" readonly name="pType[]" value="Platinum">
                                    </div>
                                    <div class="col-sm-3">

                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="pDays[]" placeholder="Enter Plan Days">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="pDays[]" placeholder="Enter Plan Days">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="pDays[]" placeholder="Enter Plan Days">
                                    </div>
                                    <div class="col-sm-3">

                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="pAmnt[]" placeholder="Enter Plan Amount">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="pAmnt[]" placeholder="Enter Plan Amount">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="pAmnt[]" placeholder="Enter Plan Amount">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control cat-type" readonly name="Luxury" value="Luxury">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">

                                        <input type="text" required class="form-control mb-3" readonly name="lType[]" value="Silver">
                                        <input type="text" required class="form-control mb-3" readonly name="lType[]" value="Gold">
                                        <input type="text" required class="form-control mb-3" readonly name="lType[]" value="Platinum">
                                    </div>
                                    <div class="col-sm-3">

                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="lDays[]" placeholder="Enter Plan Days">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="lDays[]" placeholder="Enter Plan Days">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="lDays[]" placeholder="Enter Plan Days">
                                    </div>
                                    <div class="col-sm-3">

                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="lAmnt[]" placeholder="Enter Plan Amount">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="lAmnt[]" placeholder="Enter Plan Amount">
                                        <input type="text" required class="form-control mb-3" oninput="this.value = this.value.replace(/\D+/g, '')" minlength="1" name="lAmnt[]" placeholder="Enter Plan Amount">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="hidden" name="cat_id" id="cat_id" value="<?= $mainCat['id'] ?>">
                            <input type="hidden" name="type" id="type" value="memPlan">
                            <button type="submit" class="btn btn-primary me-2 w-50" id="AddMemPlanBtn">Add Category Plan</button>
                        </div>
                    </form>

                </div>
            <?php

            } else {
            ?>
            
                <div class="rwomsg">
                    <img src="assets/images/war.png" width="150" alt="">
                    <h3>Plan Already Added in this category if you want to change something you can edit from plan list</h3>
                </div>
            <?php
            }
            ?>

        </div>
    </div>

</div>
<style>

</style>
<div id="snackbar"></div>

<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>

<script>
    $(function() {
        'use strict'

        $("#PlanGrade").select2({
            placeholder: "Select Plan Grade"
        });
        $("#PlanType").select2({
            placeholder: "Select Plan Type"
        });
        $("#PlanName").select2({
            placeholder: "Select Plan Name"
        });



        $("#PlanGrade").on("change", function(e) {
            $("#PlanDet").show();
        });


    });

    function mySanck() {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar")

        // Add the "show" class to DIV
        x.className = "Snashow";

        // After 3 seconds, remove the Snashow class from DIV
        setTimeout(function() {
            x.className = x.className.replace("Snashow", "");
        }, 3000);
    }


    $(document).on("submit", "#CatPlanForm", function(e) {
        // alert();
        // e.preventDefault();
        //  alert();
        // console.log(new FormData(this));
        // return false;
        $.ajax({
            url: 'ajax/membership-plan.php',
            type: "POST",
            async: false,
            data: $(this).serialize(),
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $('#CatPlanForm')[0].reset();
                    window.setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }

        });
    });
</script>