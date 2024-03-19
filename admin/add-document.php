<?php include('includes/header.php');
if (!authChecker('admin', ['edit_vendor'])) {
    noAccessPage();
}
if (isset($_GET['type']) && isset($_GET['docid'])) {
    $docsTYpe = $_GET['type'];
    $docsID = $_GET['docid'];
} 

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

                <h6 class="card-title">Add document</h6>

                <form action="javascript:;" class="forms-sample" id="addDocsForm" enctype="multipart/form-data">
                    <div class='loading'></div>
                    <div class="mb-3">
                        <label for="docsTYpe" class="form-label">Document Name</label>
                        <input type="text" class="form-control" id="docsTYpe" readonly name="docsTYpe" value="<?= $docsTYpe ?>">
                    </div>
                    <div class="mb-3">
                        <label for="docsfile" class="form-label">Document File</label>
                        <input type="file" class="form-control" id="docsfile" onchange="validateDocs(this)" required name="docsfile">
                        <input type="hidden" name="docsID" value="<?= $docsID ?>">
                        <input type="hidden" name="typeDoc" value="docUpload">
                    </div>
                    <div class="text-center"> 
                        <button type="submit" class="btn btn-primary me-2 w-50" id="AddDocsBtn">Add Document</button>
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
    function validateDocs(ctrl) {
        var fileUpload = ctrl;
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.pdf)$");
        if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof(fileUpload.files) == "undefined") {
                swicon = "warning";
                msg = "This browser does not support HTML5.";
                srbSweetAlret(msg, swicon);
                $(ctrl).val('');
                return false;
            }
        } else {
            swicon = "warning";
            msg = "Please select a valid Image file or PDF File.";
            srbSweetAlret(msg, swicon);
            $(ctrl).val('');
            return false;
        }
    }
    $(document).on("submit", "#addDocsForm", function() {
        $.ajax({
            type: "POST",
            url: "ajax/docs.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#AddDocsBtn").attr('disabled', 'disabled');
                $("#AddDocsBtn").text('Please Wait..');
            },
            complete: function() {
                $("#AddDocsBtn").removeAttr('disabled');
                $("#AddDocsBtn").text('Add Document');
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
    });
</script>