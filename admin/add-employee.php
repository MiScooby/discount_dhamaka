<?php include('includes/header.php');
$getRoleData = mysqli_query($con, "SELECT * FROM `ec_roles_type` WHERE `status`='1' AND `id`!='1'");
$getRoleDataCount = mysqli_num_rows($getRoleData);
?>

<!-- Plugin css for this page -->
<link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
<link rel="stylesheet" href="assets/vendors/dropify/dist/dropify.min.css">
<link rel="stylesheet" href="assets/css/demo1/add-cat.css">
<style>
    .main-wrapper .page-wrapper .page-content {
        flex-grow: 1;
        padding: 25px;
        margin-top: 60px;
        background: #fff;
    }

    form small {
        color: #666;
        font-size: 10px;
    }

    .select2-container .select2-selection--single,
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e9ecef;
        border-radius: 4px;
    }

    .form-control,
    .select2-container--default .select2-search--dropdown .select2-search__field,
    .typeahead.tt-hint,
    .typeahead.tt-input {
        display: block;
        width: 100%;
        height: 45px;
        padding: 0.469rem 0.8rem;
        font-size: .875rem;
        font-weight: 400;
        line-height: 1.5;
        color: #000;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #e9ecef;
        appearance: none;
        border-radius: 0.25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .pass2,
    .pass2 {
        position: relative;
    }

    .toggle-password,
    .toggle-password1 {
        position: absolute;
        right: 15px;
        top: 45px;
        font-size: 14px;
        color: #757575;
        cursor: pointer;
    }

    div#ErrMsg {
        font-size: 10px;
        font-weight: 500;
        color: red;
        margin-top: 0;
        margin-bottom: 10px;
    }
</style>
<div class="row justify-content-center">

    <?php
    if ($getRoleDataCount > 0) {
    ?>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Add Employee for access control</h6>

                    <form class="forms-sample" id="AddEmpForm" action="javascript:;" method="post" enctype="multipart/form-data">



                        <div class="mb-3">
                            <div>
                                <label class="form-label">User Role </label>
                                <div class="input-field">
                                    <select class="js-example-basic-single form-select" id="EmpRole" name="EmpRole" data-width="100%" required>
                                        <option></option>
                                        <?php

                                        while ($getRoleDataR = mysqli_fetch_array($getRoleData)) {
                                        ?>
                                            <option value="<?= $getRoleDataR['id'] ?>"><?= $getRoleDataR['title'] ?></option>
                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <small>Note : Employee can access selected role given by admin. </small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Employee Name :</label>
                            <div class="row">
                                <div class="col-sm-6"><input type="text" class="form-control" name="EmployeeFirstName" required placeholder="Enter Employee First Name"></div>
                                <div class="col-sm-6"><input type="text" class="form-control" name="EmployeeLastName" required placeholder="Enter Employee Last Name"></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Country Code</label>
                                <select disabled class="c_code form-select" id="c_code" name="c_code" data-width="100%">
                                    <option></option>
                                    <?php
                                    $getCountryQ = mysqli_query($con, "SELECT * FROM `country` WHERE `name`='India' ");
                                    while ($getCountry = mysqli_fetch_array($getCountryQ)) {
                                    ?>
                                        <option value="<?= $getCountry['phonecode'] ?>" selected><?= $getCountry['nicename'] . " " . $getCountry['phonecode'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="mob_num" class="form-label">Mobile Number</label>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="mob_num" name="mob_num" required placeholder="Enter Main Mobile Number" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="alt_mob_num" name="alt_mob_num" placeholder="Enter Alternate Mobile Number" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee DOB :</label>
                                    <input type="date" class="form-control" name="EmployeeDob" required placeholder="Enter Employee First Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Employee Email-Id :</label>
                                    <input type="email" class="form-control" name="EmployeeEmail" required placeholder="Enter Employee First Name">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 pass2">
                                    <label for="emp_Password" class="form-label fw-500">Password</label>
                                    <input type="password" class="form-control " name="emp_Password" id="emp_Password" required="" placeholder="Enter Password">
                                    <span toggle="#password-field" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-500">Confirm Password</label>
                                    <input type="password" class="form-control " name="emp_Password_cfm" required="" placeholder="Enter Password">
                                </div>
                            </div>
                            <div id="ErrMsg" style="display: none;"></div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Job Description :</label>
                                <textarea name="jobDesc" class="form-control" placeholder="Please Define  Employee Job Description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="AddEmployee">
                            <button type="submit" class="btn btn-primary me-2 w-50" id="AddEmpBtn">Submit</button>
                        </div>
                    </form>

                    <form class="forms-sample" id="VerEmpForm" style="display: none;" action="javascript:;" method="post" enctype="multipart/form-data">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                <div class="mb-3 text-center">
                                    <label class="form-label">Enter Verification Code</label>
                                    <input type="text" minlength="4" maxlength="4" oninput="this.value = this.value.replace(/\D+/g, '')" class="form-control" name="EmpOtp" required placeholder="Enter Verification Code">
                                </div>
                                <div class="text-center">
                                    <input type="hidden" name="VerifyEmployee">
                                    <input type="hidden" id="emailEmp" name="emailEmp">
                                    <button type="submit" class="btn btn-primary me-2 w-50" id="VerifyEmpBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="rwomsg">
            <img src="assets/images/nofound.jpg" width="300px" alt="">

            <p>Please add minimum 1 role or if you have already any role in your list please check status.</p>
            <small>( Super Admin will not count as a role for any employee )</small>
        </div>
    <?php
    }
    ?>
</div>



<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script src="assets/vendors/dropify/dist/dropify.min.js"></script>
<script>
    $('select').select2({
        placeholder: 'please select an option'
    });
    $("#emp_Password").on("keyup", function(e) {
        $(this).prop('type', 'password');
        var value = $(this).val();
        $("#ErrMsg").hide();
        if (value != '') {
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
            var isValid = regex.test(value);
            if (!isValid) {
                $('#AddEmpBtn').attr('disabled', 'disabled');
                $("#emp_Password").addClass('err_bdr');
                $("#ErrMsg").show();
                $("#ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
            } else {
                $("#ErrMsg").hide();
                $('#AddEmpBtn').removeAttr('disabled', 'disabled');
                $("#emp_Password").removeClass('err_bdr');
            }
        } else {
            $("#ErrMsg").hide();
            $('#AddEmpBtn').removeAttr('disabled', 'disabled');
            $("#emp_Password").removeClass('err_bdr');
        }
    });

    $("#signUpwithmobileBtn").hide();
    $(function() {
        'use strict'

        if ($("#c_code").length) {
            $("#c_code").select2({
                placeholder: "Select Country Code"
            });
        }

    });
    $(document).on("click", ".toggle-password", function() {
        if ($(".pass2").find("input").attr("type") == "password") {
            $(".pass2").find("input").attr("type", "text");
            $(this).addClass("fa-eye");
            $(this).removeClass("fa-eye-slash");
        } else {
            $(".pass2").find("input").attr("type", "password");
            $(this).removeClass("fa-eye");
            $(this).addClass("fa-eye-slash");
        }
    });


    $(document).on("submit", "#AddEmpForm", function() {
        $.ajax({
            type: "POST",
            url: "ajax/employees.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#AddEmpBtn").attr("disabled", "disabled");
                $("#AddEmpBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");
                $("#loader").show();

            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status == 1) {
                    $("#AddEmpBtn").removeAttr("disabled", "disabled");
                    $("#AddEmpBtn").html("Submit");
                    $("#AddEmpForm").hide();
                    $("#VerEmpForm").show();
                    $("#emailEmp").val(data.email);

                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#AddEmpBtn").removeAttr("disabled", "disabled");
                    $("#AddEmpBtn").html("Submit");
                }
            },
        });
    });

    $(document).on("submit", "#VerEmpForm", function() {
        $.ajax({
            type: "POST",
            url: "ajax/employees.php",
            processData: false,
            contentType: false,
            data: new FormData(this),
            beforeSend: function() {
                $("#VerifyEmpBtn").attr("disabled", "disabled");
                $("#VerifyEmpBtn").html("Please Wait <i class='fa fa-spinner fa-spin'></i>");               
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status == 1) {
                    $("#VerifyEmpBtn").removeAttr("disabled", "disabled");
                    $("#VerifyEmpBtn").html("Submit");
                    swicon = "success";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    window.setTimeout(function() {
                        window.location.href = "employee-list.php";
                    }, 500);
                } else {
                    swicon = "warning";
                    msg = data.message;
                    srbSweetAlret(msg, swicon);
                    $("#VerifyEmpBtn").removeAttr("disabled", "disabled");
                    $("#VerifyEmpBtn").html("Submit");
                }
            },
        });
    });
</script>