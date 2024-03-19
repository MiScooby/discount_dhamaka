<?php include('includes/header.php');


if (!authChecker('admin', ['edit_vendor', 'view_vendor'])) {
    noAccessPage();
}

if (isset($_GET['vendor_id'])) {
    $id = $_GET['vendor_id'];
    $GetvendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `id`='$id'");
    $Getvendor = mysqli_fetch_array($GetvendorQ);
}

$catId = $Getvendor['business_cat'];

$countDealcatplan = mysqli_num_rows(mysqli_query($con, "SELECT mp.* FROM membership_plan mp, category c WHERE mp.cat_id=c.id AND mp.cat_id='$catId'"));
?>
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">

<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 38px;
        border: 1px solid #e9ecef !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px;
        position: absolute;
        top: 1px;
        right: 1px;
        width: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 23px;
    }

    .pass1 {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 25px;
        top: 12px;
        color: #000865;
        font-weight: 500;
        cursor: pointer;
    }

    .userinfodiv {
        background: #fcfcfcc4;
        padding: 20px 20px 8px;
        border-radius: 20px;
        border: 1px solid #f6f6f6cc;
    }

    .divbtn {
        padding-top: 10px;
    }

    .dropify-wrapper {
        height: 100px;
    }

    .dropify-wrapper .dropify-message span.file-icon {
        font-size: 20px;
    }

    .userinfodiv .forms-sample .form-label {
        font-weight: 500;
        color: #030414bd;
        font-size: 12px;
    }

    .row.mb-3 {
        display: flex;
        align-items: center;
    }

    .useravatar img {
        width: 90px;
    }

    .sec-head {
        font-weight: 600;
        margin-bottom: 15px;
        color: #2bc79c;
    }

    .notedesc {
        font-size: 11px;
        color: #747474;
        font-weight: 500;
    }

    .notedesc ul {
        margin-left: 10px;
        padding: 0;
    }

    div#loader {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        bottom: 0;
    }

    .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
    }

    .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: auto;
        border-radius: 50%;
        border: 6px solid #f5a705;
        border-color: #f5a705 transparent #f5a705 transparent;
        animation: lds-dual-ring 1.2s linear infinite;
        position: absolute;
        top: 0%;
        left: 0%;
        right: 0;
        bottom: 0;
        z-index: 1000;
    }

    @keyframes lds-dual-ring {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgb(255 214 153 / 8%);
        z-index: 999;
        opacity: 1;
        transition: all 0.5s;
    }
</style>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div id="loader" style="display: none;">
                    <div class="lds-dual-ring">
                        <div class="overlay">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6  stretch-card align-items-center">
                        <h5 class="card-title">EDIT VENDOR / VENDOR DETAILS</h5>
                    </div>
                    <div class="col-md-6 mb-2 grid-margin stretch-card justify-content-end">
                        <a href="mailto:<?= $Getvendor['email_id']; ?>" class="btn btn-success me-2">Send Email to vendor</a>
                    </div>

                </div>

                <div class="userinfodiv">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="sec-head">Vendor Personal Details :</p>
                        </div>
                        <div class="col-md-12">

                            <form class="forms-sample">
                                <input type="hidden" id="vendorId" value="<?= $Getvendor['id']; ?>">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Vendor User Name:</label>
                                        <input class="form-control mb-4 mb-md-0" id="VUserName" type="text" value="<?= $Getvendor['user_name']; ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Vendor First Name:</label>
                                        <input class="form-control mb-4 mb-md-0" id="VFirstName" type="text" value="<?= $Getvendor['f_name']; ?>" />
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Vendor Last Name:</label>
                                        <input class="form-control" id="VLastName" type="text" value="<?= $Getvendor['l_name']; ?>" />
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Vendor Email Address:</label>
                                    </div>
                                    <div class="col-md-9">

                                        <input class="form-control mb-4 mb-md-0" id="VEmailAdd" type="email" value="<?= $Getvendor['email_id']; ?>" disabled />


                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Vendor Mobile Number:</label>
                                    </div>



                                    <div class="col-md-3">
                                        <select class="js-example-basic-single form-control" id="Vc_code" disabled>
                                            <option value="<?= $Getvendor['c_code']; ?>" selected>
                                                <?= $Getvendor['c_code']; ?></option>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" disabled id="VmobilNUm" value="<?= $Getvendor['mobile_num']; ?>" />
                                    </div>



                                </div>





                        </div>
                    </div>
                </div>

                <div class="userinfodiv mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="sec-head">Vendor Business Details : :</p>
                        </div>
                        <div class="col-md-12">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Business Type :</label>
                                    <select class=" form-control" id="busType">
                                        <option value="Single brand" <?= ('Single brand' == $Getvendor['business_type']) ? 'Selected' : ''; ?>>
                                            Single Store </option>
                                        <option value="Multi brand" <?= ('Multi brand' == $Getvendor['business_type']) ? 'Selected' : ''; ?>>
                                            Multi Store</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Business Category :</label>
                                    <select class=" form-control" id="busCat">
                                        <?php
                                        $getCat = mysqli_query($con, "SELECT * FROM `category` ");
                                        while ($getCatDet = mysqli_fetch_array($getCat)) {
                                        ?>
                                            <option value="<?= $getCatDet['id']; ?>" <?= ($getCatDet['id'] == $Getvendor['business_cat']) ? 'Selected' : ''; ?>>
                                                <?= $getCatDet['cat_name']; ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Merchant Business Name :</label>

                                    <input class="form-control mb-4 mb-md-0" id="Vmb_name" type="text" value="<?= $Getvendor['merchant_bus_name']; ?>" />


                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Merchant GST Number :</label>

                                    <input class="form-control mb-4 mb-md-0" id="VgstNum" type="text" value="<?= $Getvendor['gst_num']; ?>" />


                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Contact Person Name :</label>

                                    <input class="form-control mb-4 mb-md-0" id="Vcp_name" type="text" value="<?= $Getvendor['cp_name']; ?>" />


                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Contact Person Contact Number :</label>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <select class=" form-control" id="cp_code">

                                                <option data-id="" value="<?= $Getvendor['cp_c_code']; ?>">
                                                    <?= $Getvendor['cp_c_code']; ?></option>
                                            </select>

                                        </div>
                                        <div class="col-sm-8">
                                            <input class="form-control mb-4 mb-md-0" id="Vcp_num" type="text" value="<?= $Getvendor['cp_num']; ?>" />
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Contact Person Email :</label>

                                    <input class="form-control mb-4 mb-md-0" id="Vcp_email" type="text" value="<?= $Getvendor['cp_email']; ?>" />


                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Landline No :</label>

                                    <input class="form-control mb-4 mb-md-0" id="Vlandline" type="text" value="<?= $Getvendor['landline_num']; ?>" disabled />


                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="userinfodiv mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="sec-head">Vendor Business Address Details : :</p>
                        </div>
                        <div class="col-md-12">

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Address 1 :</label>
                                    <input class="form-control mb-4 mb-md-0" id="VAddr_1" type="text" value="<?= $Getvendor['address_1']; ?>" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Address 2 :</label>
                                    <input class="form-control mb-4 mb-md-0" id="VAddr_2" type="text" value="<?= $Getvendor['address_2']; ?>" />
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">City :</label>

                                    <input class="form-control mb-4 mb-md-0" id="vCity" type="text" value="<?= $Getvendor['city']; ?>" />


                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">State :</label>

                                    <input class="form-control mb-4 mb-md-0" id="cState" type="text" value="<?= $Getvendor['state']; ?>" />


                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pincode :</label>

                                    <input class="form-control mb-4 mb-md-0" id="vPin" type="text" value="<?= $Getvendor['pin_code']; ?>" />


                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="userinfodiv mt-3">
                    <div class="row">
                        <div class="col-md-12">

                            <?php
                            $checkDocVenQ = mysqli_query($con, "SELECT * FROM `vendor_document_upload` WHERE `vendor_id`='$Getvendor[id]' ");
                            $checkDocVenCount = mysqli_num_rows($checkDocVenQ);

                            if ($checkDocVenCount == 0) {


                            ?>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Vendor Documents:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <?php
                                                if (authChecker('admin', ['edit_vendor'])) {
                                                ?> <span class="badge  bg-warning">DOCUMENT NOT UPLOADED</span>
                                                    <a href="add-vendor-doc.php?<?= $urltoken . $urltoken ?>&&vendor_id=<?= $Getvendor['id']; ?>&&<?= $urltoken . $urltoken ?>" class="addDocu">Add Documents</a>
                                                    <span style="color: #444; padding: 0 15px;">or</span>
                                                <?php } ?>
                                                <a href="javascript:;" id="sendDocLink" data-v-id="<?= $id ?>" class="addDocu">Send Doc Upload Link To Vendor</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                            <?php

                            } else {
                            ?>
                                <div class="row mb-3" id="VenDocSec">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th class="pt-0">#</th>
                                                            <th class="pt-0">Document Name</th>
                                                            <th class="pt-0">Document File</th>
                                                            <th class="pt-0">Upload Date</th>
                                                            <?php
                                                            if (authChecker('admin', ['edit_vendor'])) {
                                                            ?>
                                                                <th class="pt-0">Action</th>
                                                            <?php
                                                            }
                                                            ?>
                                                        </tr>
                                                    </thead>
                                                    <style>
                                                        .table-responsive tr {
                                                            text-align: center;
                                                        }

                                                        .table-responsive tbody tr td {
                                                            line-height: 50px;
                                                            padding: 5px .85rem;
                                                        }
                                                    </style>
                                                    <tbody>
                                                        <?php
                                                        $i = 1;
                                                        $fetchDocuQ = mysqli_query($con, "SELECT * FROM `vendor_document_upload` WHERE `vendor_id`='$Getvendor[id]'");
                                                        while ($fetchDocu = mysqli_fetch_array($fetchDocuQ)) {
                                                            $timestamp = strtotime($fetchDocu['datetime']);
                                                            $date = date('d-m-Y', $timestamp);
                                                        ?>
                                                            <?php
                                                            if ($fetchDocu['gst_file'] != null) {
                                                            ?>
                                                                <tr>
                                                                    <td>#<?= $i++ ?></td>
                                                                    <td>GST</td>

                                                                    <td>
                                                                        <div class="me-3">
                                                                            <a href="../upload/vendor-doc/vendor-docs/<?= $fetchDocu['gst_file'] ?>"><img src="assets/images/doc.png" class="rounded-circle wd-35" alt="gst"></a>
                                                                        </div>
                                                                    </td>
                                                                    <td><?= $date ?></td>
                                                                    <?php
                                                                    if (authChecker('admin', ['edit_vendor'])) {
                                                                    ?>
                                                                        <td>

                                                                            <a href="javascript:;" class="btn btn-danger btn-icon dltdocven" data-id="<?= $fetchDocu['id'] ?>" data-type="gst_file">
                                                                                <i data-feather="trash"></i>
                                                                            </a>
                                                                        </td>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            } else {

                                                                if (authChecker('admin', ['edit_vendor'])) {

                                                                ?>
                                                                    <tr>
                                                                        <td>#<?= $i++ ?></td>
                                                                        <td>GST</td>
                                                                        <td>
                                                                            <span>click on the side button for upload file</span>
                                                                        </td>
                                                                        <td>--</td>
                                                                        <td>

                                                                            <a href="add-document.php?<?= $urltoken . $urltoken ?>&type=gst_file&<?= $urltoken ?>&docid=<?= $fetchDocu['id'] ?>&<?= $urltoken . $urltoken ?>" class="btn btn-danger btn-icon">
                                                                                <i data-feather="upload"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>

                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($fetchDocu['pan_file'] != null) {
                                                            ?>
                                                                <tr>
                                                                    <td>#<?= $i++ ?></td>
                                                                    <td>Pan Card</td>
                                                                    <td>
                                                                        <div class="me-3">
                                                                            <a href="../upload/vendor-doc/vendor-docs/<?= $fetchDocu['pan_file'] ?>"><img src="assets/images/doc.png" class="rounded-circle wd-35" alt="pancard"></a>
                                                                        </div>
                                                                    </td>
                                                                    <td><?= $date ?></td>
                                                                    <?php
                                                                    if (authChecker('admin', ['edit_vendor'])) {
                                                                    ?>
                                                                        <td>

                                                                            <a href="javascript:;" class="btn btn-danger btn-icon dltdocven" data-id="<?= $fetchDocu['id'] ?>" data-type="pan_file">
                                                                                <i data-feather="trash"></i>
                                                                            </a>
                                                                        </td>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </tr>
                                                                <?php
                                                            } else {

                                                                if (authChecker('admin', ['edit_vendor'])) {

                                                                ?>
                                                                    <tr>
                                                                        <td>#<?= $i++ ?></td>
                                                                        <td>Pan Card</td>
                                                                        <td>
                                                                            <span>click on the side button for upload file</span>
                                                                        </td>
                                                                        <td>--</td>
                                                                        <td>

                                                                            <a href="add-document.php?<?= $urltoken . $urltoken ?>&type=pan_file&<?= $urltoken ?>&docid=<?= $fetchDocu['id'] ?>&<?= $urltoken . $urltoken ?>" class="btn btn-danger btn-icon">
                                                                                <i data-feather="upload"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>

                                                            <?php
                                                            if ($fetchDocu['brand_appr_file'] != null) {
                                                            ?>
                                                                <tr>
                                                                    <td>#<?= $i++ ?></td>
                                                                    <td>Brand Approval</td>

                                                                    <td>
                                                                        <div class="me-3">
                                                                            <a href="../upload/vendor-doc/vendor-docs/<?= $fetchDocu['brand_appr_file'] ?>"><img src="assets/images/doc.png" class="rounded-circle wd-35" alt="user"></a>
                                                                        </div>
                                                                    </td>
                                                                    <td><?= $date ?></td>
                                                                    <?php
                                                                    if (authChecker('admin', ['edit_vendor'])) {
                                                                    ?>
                                                                        <td>

                                                                            <a href="javascript:;" class="btn btn-danger btn-icon dltdocven" data-id="<?= $fetchDocu['id'] ?>" data-type="brand_file">
                                                                                <i data-feather="trash"></i>
                                                                            </a>
                                                                        </td>
                                                                    <?php
                                                                    } ?>
                                                                </tr>
                                                                <?php
                                                            } else {
                                                                if (authChecker('admin', ['edit_vendor'])) {
                                                                ?>
                                                                    <tr>
                                                                        <td>#<?= $i++ ?></td>
                                                                        <td>Brand Approval</td>
                                                                        <td>
                                                                            <span>click on the side button for upload file</span>
                                                                        </td>
                                                                        <td>--</td>
                                                                        <td>

                                                                            <a href="add-document.php?<?= $urltoken . $urltoken ?>&type=brand_appr_file&<?= $urltoken ?>&docid=<?= $fetchDocu['id'] ?>&<?= $urltoken . $urltoken ?>" class="btn btn-danger btn-icon">
                                                                                <i data-feather="upload"></i>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                            <?php
                                                                }
                                                            }
                                                            ?>



                                                        <?php
                                                        }

                                                        ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                            <?php

                            if (authChecker('admin', ['edit_vendor'])) {


                                if ($countDealcatplan > 0) {
                            ?>
                                    <div class="row mb-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Vendor Current Status:</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="js-example-basic-single form-control" id="vendor_sts">
                                                <option data-id="" value="Active" selected>Active</option>
                                                <option data-id="" value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3" id="PlanGradeSec">
                                        <div class="col-md-3">
                                            <label class="form-label">Vendor Plan Grade :</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="js-example-basic-single form-select" id="PlanGrade" name="PlanGrade" data-width="100%">
                                                <option></option>
                                                <option value="A-Area" <?= ($Getvendor['plan_grade'] == "A-Area") ? 'Selected' : ''; ?>>A-Area
                                                </option>
                                                <option value="B-Area" <?= ($Getvendor['plan_grade'] == "B-Area") ? 'Selected' : ''; ?>>B-Area
                                                </option>
                                                <option value="C-Area" <?= ($Getvendor['plan_grade'] == "C-Area") ? 'Selected' : ''; ?>>C-Area
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3" id="PlanTypeSec">
                                        <div class="col-md-3">
                                            <label class="form-label">Vendor Plan Type :</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select class="js-example-basic-single form-select" id="PlanType" name="PlanType" data-width="100%">
                                                <option></option>
                                                <option value="Economy" <?= ($Getvendor['plan_type'] == "Economy") ? 'Selected' : ''; ?>>
                                                    Economy</option>
                                                <option value="Premium" <?= ($Getvendor['plan_type'] == "Premium") ? 'Selected' : ''; ?>>Premium
                                                </option>
                                                <option value="Luxury" <?= ($Getvendor['plan_type'] == "Luxury") ? 'Selected' : ''; ?>>Luxury
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="divbtn">

                                                <?php
                                                if ($Getvendor['edited'] == "1") {
                                                ?>
                                                    <button type="button" id="saveUserbtn" class="btn btn-success me-2">Approved</button>

                                                    <button type="button" id="NtAppvBtn" class="btn btn-warning text-white me-2">Not
                                                        Approved</button>
                                                <?php

                                                } else {
                                                ?>
                                                    <button type="button" id="saveUserbtn" class="btn btn-primary me-2">Approve Vendor Details</button>
                                                    <button type="button" id="DltBtn" class="btn btn-danger me-2">Delete
                                                        Vendor</button>
                                                    <button type="button" id="NtAppvBtn" class="btn btn-warning text-white me-2">Not
                                                        Approved</button>
                                                <?php
                                                }
                                                ?>


                                            </div>

                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="row mb-3">
                                        <span class="badge bg-danger ">Please Add Membership plan on this category for add plan
                                            or activate Vendor</span>
                                    </div>
                            <?php
                                }
                            }
                            ?>



                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


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

    $(document).ready(function() {
        $('.me-3').magnificPopup({
            type: 'iframe',
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

        $(".js-example-basic-single").select2();
        $("#busType").select2();
        $("#busCat").select2();
        $("#cp_code").select2();

        $("#PlanGrade").select2({
            placeholder: "Select Plan Grade"
        });
        $("#PlanType").select2({
            placeholder: "Select Plan Type"
        });



        $(document).on("click", "#viewDocs", function() {
            $("#VenDocSec").fadeIn(500);
        });

        $(document).on("click", ".toggle-password", function() {
            if ($(".pass1").find("input").attr("type") == "password") {
                $(".pass1").find("input").attr("type", "text");
                $(this).addClass("fa-eye");
                $(this).removeClass("fa-eye-slash");
            } else {
                $(".pass1").find("input").attr("type", "password");
                $(this).removeClass("fa-eye");
                $(this).addClass("fa-eye-slash");
            }
        });



    });
</script>
<script>
    $(document).on("click", "#DltBtn", function() {
        var vendorIdnum = $("#vendorId").val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result);
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                $.ajax({
                    url: "ajax/vendors.php",
                    type: "POST",
                    async: false,
                    data: {
                        vendorIdnum: vendorIdnum,
                        type: 'DltVendor'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            location.href = "vendors.php";
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                        }
                    }
                });
            }
        });

    });

    $(document).on("click", "#NtAppvBtn", function() {
        var vendorIdnum = $("#vendorId").val();
        $.ajax({
            url: "ajax/vendors.php",
            type: "POST",
            async: false,
            data: {
                vendorIdnum: vendorIdnum,
                type: 'NtAppvVend'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    location.href = "vendors.php";
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });

    });

    $(document).on("click", ".dltdocven", function() {
        docvenId = $(this).attr('data-id');
        docType = $(this).attr('data-type');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // console.log(result);

                $.ajax({
                    url: "ajax/docs.php",
                    type: "POST",
                    async: false,
                    data: {
                        docvenId: docvenId,
                        docType: docType,
                        type: 'DltVendorDocs'
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            window.setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                        }
                    }
                });
            }
        });
    });

    $(document).on("click", "#saveUserbtn", function() {
        var vendorId = $("#vendorId").val();
        var VUserName = $("#VUserName").val();
        var VFirstName = $("#VFirstName").val();
        var VLastName = $("#VLastName").val();
        var busType = $("#busType").val();
        var busCat = $("#busCat").val();
        var Vmb_name = $("#Vmb_name").val();
        var VgstNum = $("#VgstNum").val();
        var Vcp_name = $("#Vcp_name").val();
        var cp_code = $("#cp_code").val();
        var Vcp_num = $("#Vcp_num").val();
        var Vcp_email = $("#Vcp_email").val();
        var VAddr_1 = $("#VAddr_1").val();
        var VAddr_2 = $("#VAddr_2").val();
        var vCity = $("#vCity").val();
        var cState = $("#cState").val();
        var vPin = $("#vPin").val();
        var vendor_sts = $("#vendor_sts").val();
        var PlanGrade = $("#PlanGrade").val();
        var PlanType = $("#PlanType").val();
        // alert(vendor_sts);
        if (PlanGrade == "") {
            swicon = "warning";
            msg = "Please Select Plan Grade";
            srbSweetAlret(msg, swicon);
        } else if (PlanType == "") {
            swicon = "warning";
            msg = "Please Select Plan Type";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                url: "ajax/vendors.php",
                type: "POST",
                async: false,
                data: {
                    vendorId: vendorId,
                    VUserName: VUserName,
                    VFirstName: VFirstName,
                    VLastName: VLastName,
                    busType: busType,
                    busCat: busCat,
                    Vmb_name: Vmb_name,
                    VgstNum: VgstNum,
                    Vcp_name: Vcp_name,
                    cp_code: cp_code,
                    Vcp_num: Vcp_num,
                    Vcp_email: Vcp_email,
                    VAddr_1: VAddr_1,
                    VAddr_2: VAddr_2,
                    vCity: vCity,
                    cState: cState,
                    vPin: vPin,
                    vendor_sts: vendor_sts,
                    PlanGrade: PlanGrade,
                    PlanType: PlanType,
                    type: 'UpdateVendorDet'
                },
                beforeSend: function() {
                    $("#saveUserbtn").html('Please Wait <i class="fa fa-spinner fa-spin"></i>');
                    $("#loader").fadeIn(300);
                },
                complete: function() {
                    $("#saveUserbtn").html('Approve Vendor Details');
                    $("#loader").fadeOut(300);
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status == 1) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);

                        setTimeout(() => {
                            location.href = "vendors.php";
                        }, 1000);
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                }
            });
        }

    });

    $(document).on("click", "#sendDocLink", function() {
        vendid = $(this).attr('data-v-id');
        $.ajax({
            url: "ajax/docs.php",
            type: "POST",
            async: false,
            data: {
                vendid: vendid,
                type: 'venDocLink'
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                }
            }
        });
    })
</script>