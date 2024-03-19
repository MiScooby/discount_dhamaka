<?php include('includes/header.php');
if (isset($_GET['vendor_id'])) {
    $id = $_GET['vendor_id'];
    $GetvendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `id`='$id'");
    $Getvendor = mysqli_fetch_array($GetvendorQ);
}
 
if (!authChecker('admin', ['edit_vendor'])) { noAccessPage(); }

?>
<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<style>
    .notedesc {
        font-size: 11px;
        color: #747474;
        font-weight: 500;
    }

    .notedesc ul {
        margin-left: 10px;
        padding: 0;
    }
</style>


<div class="row justify-content-center">
    <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title">Add Document</h6>

                <form action="javascript:void(0);" id="docs_Form" enctype="multipart/form-data" class="form-inner srb-mt-form">

                    <div class="tab-100 col-md-12 mb-3">
                        <div id="locationField">
                            <label class="form-label"> PAN Card</label>
                            <div class="input-field">
                                <input type="file" class="form-control" id="panCardFile" name="panCardFile" onchange="validateDocs(this)">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <div class="tab-100 col-md-12 mb-3">
                        <div id="locationField">
                            <label class="form-label"> GST</label>
                            <div class="input-field">
                                <input type="file" class="form-control" id="gstFile" name="gstFile" onchange="validateDocs(this)">
                                <span></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ($Getvendor['business_type'] == "Multi brand") { ?>
                        <div class="tab-100 col-md-12 mb-3">
                            <div id="locationField">
                                <label class="form-label"> Brand Approval</label>
                                <div class="input-field">
                                    <input type="file" class="form-control" id="brandApprovalFile" name="brandApprovalFile" onchange="validateDocs(this)">
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="type" value="vendor_docs_upload">
                    <input type="hidden" name="ven_id" id="ven_id" value="<?= $id ?>">
                    <button type="submit" class="btn btn-primary">Upload Documents</button>
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
    $('#vendorDocImage').dropify();

    $("#vendorDocImage").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/png", "image/JPEG", "image/JPG", "image/jpeg", "image/jpg"];
        // if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {

        // }


        var fileType = file.type; // holds the file types
        var match = ["application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/png", "image/JPEG", "image/JPG", "image/webp", "image/jpeg", "image/jpg"]; // defined the file types
        var fileSize = file.size; // holds the file size
        var maxSize = 100 * 1024 * 1024; // defined the file max size (100 MB)

        // Checking the Valid Image file types
        if ((match.indexOf(fileType) == '-1')) {
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $(".dropify-preview").hide('');
            $(".dropify-clear").hide('');
            $(".dropify-render").html('');
            return false;
        }

        // Checking the defined image size
        if (fileSize > maxSize) {
            alert('Please select low file size.');
            $(".dropify-preview").hide('');
            $(".dropify-clear").hide('');
            $(".dropify-render").html('');
            return false;
        }


    });


    $(document).on("submit", "#docs_Form", function() {
        var panFile = document.getElementById('panCardFile').files.length;
        var gstFile = document.getElementById('gstFile').files.length;
        var bAFile = document.getElementById('brandApprovalFile');
        var vid = $('#ven_id').val();

        var formData = new FormData();
        formData.append('ven_id', vid);
        formData.append('type', "vendor_docs_upload");
        formData.append('panCardFile', document.getElementById("panCardFile").files[0]);
        formData.append('gstFile', document.getElementById("gstFile").files[0]);
        if (($('#brandApprovalFile').length > 0)) {
            formData.append('brandApprovalFile', document.getElementById("brandApprovalFile").files[0]);
        }

        if (!panFile) {
            swicon = "warning";
            msg = "Please Upload Pan Card";
            srbSweetAlret(msg, swicon);
        } else if (!gstFile) {
            swicon = "warning";
            msg = "Please Upload GST";
            srbSweetAlret(msg, swicon);
        } else if (($('#brandApprovalFile').length > 0) && (!bAFile.files.length)) {
            swicon = "warning";
            msg = "Please Upload Brand Approval";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                type: "POST",
                url: "ajax/docs.php",
                processData: false,
                contentType: false,
                data: new FormData(this),
                beforeSend: function() {
                    $("#loader").fadeIn(300);
                },
                complete: function() {
                    $("#loader").fadeOut(300);
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        location.href = data.url;
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                }
            });
        }
    });

    
</script>