<?php include('admin/ajax/config.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discount Dhamaka - Vendor Registration</title>

    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">

    <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/lgn-reg-assets/vendor/font-awesome/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="assets/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bus-style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bus-responsive.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bus-animation.css">
    <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">

</head>

<body>
    <?php $vId = $_GET['vendor_id'];
    $multiStore = $_GET['ms'];
    // print_r($_GET['vendor_id'] ." ". $_GET['ms']);

    $checkDocs = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `vendor_document_upload` WHERE vendor_id='$vId'"));

    ?>

    <section class="registration-form">
        <div class="row">
            <!-- sidebar -->
            <?php 
            
            if(!isset($_SESSION['LoggedInMobile'])){
                ?>
                <div id="sidbar" class="col-md-4 sidebar">
                <div class="hero-bg hero-bg-scroll" style="background-image:url('assets/lgn-reg-assets/images/login-bg-1.jpg');"></div>
                <div class="sidebar-inner" style="z-index: 99;">
                    <div class="container">
                        <div class="wrapper">
                            <div class="bus_logo">
                                <a href="index.php">
                                    <img src="assets/images/logo/logo-8.png" alt="Discount Dhamaka">
                                </a>
                            </div>
                            <!-- sidebar-content -->
                            <div class="sidebar-content">
                                <div class="sidebar-text">
                                    <h2>
                                        List Your Business Online With Discount Dhamaka
                                    </h2>
                                     
                                </div>

                                <!-- contact-info -->
                                <div class="contact-info">
                                    
                                    <div class="contact-info-inner">
                                        <div class="contact-icon">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <div class="contact-details">
                                            <p>Contact via email</p>
                                            <h6>support@discountdhamaka.com</h6>
                                        </div>
                                    </div>

                                    <!-- sidebar button -->
                                    <a href="index.php"><button><i class="fa fa-arrow-left"></i> Back Home</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
                <?php
            }
            
            ?>
            

            <!-- registration form -->
            <div id="reg-form" class="col-md-8 pop registration-form-inner h-100" style="position: relative;">

                <div id="loader" style="display: none;">
                    <div class="lds-dual-ring">
                        <div class="overlay">
                        </div>
                    </div>
                </div>

                <div class="registration-stats" style="display:none;">
                    <div class="stst-content">
                        <img src="assets/images/under-process.png" width="150px" height="150px" alt="">
                        <h3>Thank You For Choosing Discount Dhamaka</h3>
                        <p>Our Excutive Will Connect With You Soon</p>
                        <a href="<?=($_SESSION['LoggedInMobile'] == 'yes')?'login.php':'index.php';?>" class="btn btn-success">Back To Home</a>
                    </div>
                </div>
                <!-- top shape -->
                <div class="shapes-top">
                    <div class="big-shape"></div>
                    <div class="small-shape"></div>
                </div>

                <!-- bottom shape -->
                <div class="shapes-bottom">
                    <div class="small-shape"></div>
                    <div class="big-shape"></div>
                </div>
                <?php
                if ($checkDocs == 0) {
                ?>
                    <div class="registration-inner" id="registration-form">


                        <div class="container">
                            <div class="wrapper">
                                <div class="mytopdiv">
                                    <div class="row g-0">
                                        <div class="col-12 col-md-12 col-lg-2 col-xl-12">
                                            <h3 class="fw-600">Vendor Registration With Discount Dhamaka</h3>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center my-3">
                                        <span class="mx-3 text-2 text-muted" style="margin-left:0 !important;">Vendor Documentaion</span>
                                        <hr class="flex-grow-1">
                                    </div>
                                </div>

                                <div class="documents-sec">
                                    <form action="javascript:void(0);" id="docs_Form" enctype="multipart/form-data" class="form-inner srb-mt-form">

                                        <div class="tab-100 col-md-12">
                                            <div id="locationField">
                                                <label>PAN Card</label>
                                                <div class="input-field">
                                                    <input type="file" id="panCardFile" name="panCardFile" onchange="validateDocs(this)">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-100 col-md-12">
                                            <div id="locationField">
                                                <label>GST</label>
                                                <div class="input-field">
                                                    <input type="file" id="gstFile" name="gstFile" onchange="validateDocs(this)">
                                                    <span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($multiStore) { ?>
                                            <div class="tab-100 col-md-12">
                                                <div id="locationField">
                                                    <label>Brand Approval</label>
                                                    <div class="input-field">
                                                        <input type="file" id="brandApprovalFile" name="brandApprovalFile" onchange="validateDocs(this)">
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <input type="hidden" name="type" value="vendor_docs_upload">
                                        <input type="hidden" name="ven_id" id="ven_id" value="<?= $vId ?>">
                                        <button type="submit" class="btn btn-primary">Upload Documents</button>
                                    </form>
                                </div>


                            </div>
                        </div>



                    </div>
                <?php
                } else {
                ?>
                    <div class="registration-stats">
                        <div class="stst-content">
                            <img src="assets/images/under-process.png" width="150px" height="150px" alt="">
                            <h3>Thank You For Choosing Discount Dhamaka</h3>
                            <p>Our Excutive Will Connect With You Soon</p>
                            <a href="<?=($_SESSION['LoggedInMobile'] = 'yes')?'login.php':'index.php';?>" class="btn btn-success">Back To Home</a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </section>


    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/sweetalert2/sweetalert2.min.js"></script>
    <script src="assets/js/srb-validation.js"></script>

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
                    url: "ajax/registration.php",
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
                            $('#registration-form').hide();
                            $('.registration-stats').show();
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

</body>

</html>