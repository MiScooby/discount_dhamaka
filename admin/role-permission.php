<?php include('includes/header.php');
error_reporting(0);
if (isset($_GET['rid'])) {
    $get_token = $_GET['rid'];
    $dec_token = encrypt_decrypt($get_token, 'decrypt');

    $getSelectedPer = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `ec_set_permission` WHERE `role_id`='$dec_token' "));
     $get_tag = explode(",", $getSelectedPer['function_id']);
    
}
?>

<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<style>

</style>


<div class="row justify-content-center">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Add Permission To Role</h6>

                <form class="forms-sample" action="javascript:;" method="post" id="AddPerForm" enctype="multipart/form-data">
                    <?php
                    $getPermCatQ = mysqli_query($con, "SELECT * FROM `ec_functions` WHERE `status`='1' GROUP BY category ");
                    while ($getPermCat = mysqli_fetch_array($getPermCatQ)) {

                    ?>
                        <div class="row  mb-1">
                            <small class="mb-3"><b><?= $getPermCat['category']; ?> : </b></small>
                            <?php
                            $getPermQ = mysqli_query($con, "SELECT * FROM `ec_functions` WHERE `status`='1' AND `category`='$getPermCat[category]' ");
                            while ($getPerm = mysqli_fetch_array($getPermQ)) {

                            ?>
                                <div class="col-sm-3">
                                    <div class="form-check form-check-inline mb-3">

                                    <?php
                                        $tempSelected = "";
                                        if(in_array($getPerm['id'], $get_tag)){
                                            $tempSelected = "checked";
                                        }else{
                                            $tempSelected = "";
                                        }
                                    ?>

                                        <input type="checkbox" class="form-check-input" <?= $tempSelected ?? '' ?> value="<?= $getPerm['id'] ?>" id="<?= $getPerm['function_name']; ?>" name="permission[]">
                                        <label class="form-check-label tx-11" for="<?= $getPerm['function_name']; ?>">
                                            <?= $getPerm['alias']; ?>
                                        </label>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                    <input type="hidden" name="AddPermission">
                    <input type="hidden" name="roleId" value="<?= $dec_token ?>">
                    <button type="submit" class="btn btn-primary" id="SavePerBtn">Save Permission</button>
                </form>

            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php'); ?>

<script>
    $(document).on("submit", "#AddPerForm", function() {
        $.ajax({
            type: "POST",
            url: "ajax/permission.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#SavePerBtn").attr("disabled", "disabled");
                $("#SavePerBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");


            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#SavePerBtn").removeAttr("disabled", "disabled");
                    $("#SavePerBtn").html("Save Permission");
                    window.setTimeout(function() {
                        location.reload();
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#AddPerForm")[0].reset();
                    $("#SavePerBtn").removeAttr("disabled", "disabled");
                    $("#SavePerBtn").html("Save Permission");
                }
            },
        });
    });
</script>