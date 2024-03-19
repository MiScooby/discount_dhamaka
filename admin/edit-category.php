<?php include('includes/header.php');
 
if (!authChecker('admin', ['edit_category'])) { noAccessPage(); }

?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">




<style>
    .catCls a img {
        border: 2px solid #f5f5f5;
        cursor: pointer;
        border-radius: 10px;
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
    $editCat = mysqli_query($con, "SELECT * FROM `category` WHERE `id`='$id'");
    $EditmainCat = mysqli_fetch_array($editCat);
} else if (isset($_GET['sub_cat_id'])) {
    $id = $_GET['sub_cat_id'];
    $editCat = mysqli_query($con, "SELECT sc.id, sc.sub_cat_name,sc.sub_cat_img, sc.parent_cat, c.cat_name FROM category c, sub_category sc WHERE sc.parent_cat=c.id AND sc.id= $id");
    $EditmainCat = mysqli_fetch_array($editCat);
}
?>
<div class="row justify-content-center">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Edit Category</h6>
                <?php
                if (isset($_GET['cat_id'])) {
                ?>
                    <form class="forms-sample" id="EditCatForm" enctype="multipart/form-data">
                        <div class='loading'></div>
                        <div class="mb-3">
                            <label for="EditcatName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="EditcatName" name="EditcatName" required placeholder="Enter Category Name" value="<?= $EditmainCat['cat_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Parent Category</label>

                            <select class="js-example-basic-single form-select" id="parentCat" name="parentCat" data-width="100%">
                                <option value="0" selected>None</option>
                                <?php
                                $getParentCat = mysqli_query($con, "SELECT * FROM `category` WHERE `status`='Active'");
                                while ($getParCat = mysqli_fetch_array($getParentCat)) {
                                ?>
                                    <option value="<?= $getParCat['id'] ?>"><?= $getParCat['cat_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>



                        <div class=" mb-3">
                            <label for="EditcatImage" class="form-label">Category Image</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="catCls">

                                    <div data-aos="fade-up" data-aos-duration="700"><a href="../upload/cat-img/<?= $EditmainCat['cat_img'] ?>"><img src="../upload/cat-img/<?= $EditmainCat['cat_img'] ?>" width="125px" alt=""></a></div>

                                </div>
                                <input type="file" id="EditcatImage" name="EditcatImage" />
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="cat_id" id="cat_id" value="<?= $EditmainCat['id'] ?>">
                            <input type="hidden" name="editCat" id="editCat" value="editCat">
                            <button type="submit" class="btn btn-primary me-2 w-50" id="EditCatBtn">Save Category</button>
                        </div>
                    </form>
                <?php
                } else if (isset($_GET['sub_cat_id'])) {
                ?>

                    <form class="forms-sample" id="EditCatForm" enctype="multipart/form-data">
                        <div class='loading'></div>
                        <div class="mb-3">
                            <label for="EditcatName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="EditcatName" name="EditcatName" required placeholder="Enter Category Name" value="<?= $EditmainCat['sub_cat_name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Parent Category</label>




                            <select class="js-example-basic-single form-select" id="parentCat" name="parentCat" data-width="100%">
                                <option value="0">None</option>
                                <?php
                                $getParentCat = mysqli_query($con, "SELECT * FROM `category` WHERE `status`='Active'");
                                while ($getParCat = mysqli_fetch_array($getParentCat)) {
                                ?>
                                    <option value="<?= $getParCat['id'] ?>" <?php if ($getParCat['id'] == $EditmainCat['parent_cat']) {
                                                                                echo "selected";
                                                                            } ?>><?= $getParCat['cat_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>



                        </div>



                        <div class=" mb-3">
                            <label for="EditcatImage" class="form-label">Category Image</label>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="catCls">

                                    <div data-aos="fade-up" data-aos-duration="700"><a href="../upload/cat-img/<?= $EditmainCat['sub_cat_img'] ?>"><img src="../upload/cat-img/<?= $EditmainCat['sub_cat_img'] ?>" width="125px" alt=""></a></div>

                                </div>
                                <input type="file" id="EditcatImage" name="EditcatImage" />
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="cat_id" id="cat_id" value="<?= $EditmainCat['id'] ?>">
                            <input type="hidden" name="editCat" id="editCat" value="editCat">
                            <button type="submit" class="btn btn-primary me-2 w-50" id="EditCatBtn">Save Category</button>
                        </div>
                    </form>

                <?php
                }
                ?>
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
    $(document).ready(function() {
        $('.catCls').magnificPopup({
            type: 'image',
            delegate: 'a',
            gallery: {
                enabled: true
            }
        });
    });
</script><!-- FOOTER -->
<script>
    $(function() {
        'use strict'

        if ($(".js-example-basic-single").length) {
            $(".js-example-basic-single").select2();
        }
        if ($(".js-example-basic-multiple").length) {
            $(".js-example-basic-multiple").select2();
        }

        $('#EditcatImage').dropify();

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

    $("#EditcatImage").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#EditcatImage").val(null);
            return false;
        } else {}
    });
    $('#EditcatImage').bind('change', function() {
        var file = this.files[0],
            img;
        if (Math.round(file.size / (1024 * 1024)) > 1) { // make it in MB so divide by 1024*1024
            $("#EditcatImage").val(null);
            alert('Please select banner size less than 1 MB');
            return false;
        }
    });



    $(document).on("submit", "#EditCatForm", function(e) {
        e.preventDefault();
        console.log(new FormData(this));
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
                    $('#EditCatForm')[0].reset();
                    $("#EditCatForm").trigger("reset");
                    $(".dropify-preview").hide('');
                    $(".dropify-clear").hide('');
                    $(".dropify-render").html('');
                    $(".loading").removeClass('show');
                    $(".js-example-basic-single").select2();
                    location.href = data.location;
                }
            }
        });
    });
</script>