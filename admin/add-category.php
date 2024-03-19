<?php include('includes/header.php');
if (!authChecker('admin', ['add_category'])) { noAccessPage(); }
?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<style>

</style>


<div class="row justify-content-center">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Add Category</h6>

                <form class="forms-sample" id="addCatForm" enctype="multipart/form-data">
                    <div class='loading'></div>
                    <div class="mb-3">
                        <label for="catName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="catName" name="catName" required placeholder="Enter Category Name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parent Category</label>
                        <select class="js-example-basic-single form-select" id="parentCat" name="parentCat" data-width="100%">
                            <option value="0" selected>None</option>
                            <?php 
                                $getParentCat = mysqli_query($con, "SELECT * FROM `category` WHERE `status`='Active'");
                                while ($getParCat = mysqli_fetch_array($getParentCat)) {
                                    ?>
                                    <option value="<?= $getParCat['id']?>"><?= $getParCat['cat_name']?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>

                    <div class=" mb-3">
                        <label for="catImage" class="form-label">Category Image</label>
                        <input type="file" id="catImage" required name="catImage" />
                    </div>
                    <div class="text-center">
                    <input type="hidden" name="addCat" value="addCat">
                        <button type="submit" class="btn btn-primary me-2 w-50" id="AddCatBtn">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>
<style>

</style>
<div id="snackbar"></div>

<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>
<script>
    $(function() {
        'use strict'

        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2();
        }
        if ($(".js-example-basic-multiple").length) {
            $(".js-example-basic-multiple").select2();
        }

        $('#catImage').dropify();

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

    $("#catImage").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#catImage").val(null);
            return false;
        } else {}
    });
    $('#catImage').bind('change', function() {
        var file = this.files[0],
            img;
        if (Math.round(file.size / (1024 * 1024)) > 1) { // make it in MB so divide by 1024*1024
            $("#catImage").val(null);
            alert('Please select banner size less than 1 MB');
            return false;
        }
    });

    
    

    $(document).on("submit", "#addCatForm", function(e) {


        e.preventDefault();
        $.ajax({
            url: 'ajax/add-cat.php',
            type: 'POST',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $(".loading").addClass('show');
            },
            success: function(data) {


                if (data.status = 1) {
                    mySanck();
                    $("#snackbar").html(data.message);
                    $('#addCatForm')[0].reset();
                    $("#addCatForm").trigger("reset");
                    $(".dropify-preview").hide('');
                    $(".dropify-clear").hide('');
                    $(".dropify-render").html('');
                    $(".loading").removeClass('show');
                    $(".js-example-basic-single").select2();
                    location.href = "view-category.php";
                }
            }
        });

    });
</script>