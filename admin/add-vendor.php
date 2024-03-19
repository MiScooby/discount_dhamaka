<?php include('includes/header.php');
 
if (!authChecker('admin', ['add_vendor'])) { noAccessPage(); }

?>
<!-- Plugin css for this page -->
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
        top: 15px;
        font-size: 14px;
        color: #757575;
        cursor: pointer;
    }

    .myrwdiv {
        display: flex;
    }

    .checkUser {
        font-size: 14px;
        background: #bcefe0;
        border: 1px solid #bcefe0;
        color: #292929;
        height: 45px;
        width: 100%;
        font-weight: 600;
        border-radius: 0.25rem;
        line-height: 1.4;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .veribtn {
        margin-top: 28px;
    }

    .veribtn button.myotpbtn {
        font-size: 14px;
        background: #bcefe0;
        border: 1px solid #bcefe0;
        color: #292929;
        height: 45px;
        width: 100%;
        font-weight: 600;
        border-radius: 0.25rem;
    }

    .resendotp {
        font-size: 12px;
        text-align: right;
        font-weight: 600;
        color: #208cc3;
    }

    .pass1,
    .pass2,
    .pass3 {
        position: relative;
    }

    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0;
        position: relative;
        width: 100% !important;
        vertical-align: middle;
    }
    div#ErrMsg {
    font-size: 10px;
    font-weight: 500;
    color: red;
}
</style>


<div class="row justify-content-center">
    <div class="col-md-8 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                <h6 class="card-title text-center">Add Vendor</h6>
                <hr>
                <form action="javascript:void(0);" id="vendor_Form" method="POST" enctype="multipart/form-data" class="form-inner srb-mt-form">
                    <div class="end_border animation-delay-25ms">
                        <div class="row">
                            <div class="tab-100 mb-3 col-md-3">
                                <label class="form-label">Country Code</label>
                                <select class="vC_code form-select" id="vC_code" disabled name="parentCat" data-width="100%">
                                    <option></option>
                                    <option value="91" selected>India 91</option>
                                </select>
                            </div>
                            <div class="tab-100 mb-3 col-md-9">
                                <div id="focus">
                                    <label class="form-label"> Mobile Number</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" name="phone" id="vMob_num" placeholder="Mobile Number" maxlength="10" oninput="this.value = this.value.replace(/\D+/g, '')">
                                        <span></span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row" id="otpSec">
                            <div class="tab-100 mb-3 col-md-6">
                                <div id="target1">
                                    <label class="form-label">Verification Code *</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" name="code" id="vOtpCode" disabled placeholder="Enter OTP">
                                        <span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-100 mb-3 col-md-6">
                                <div class="mb-3 veribtn">
                                    <button type="button" id="sendOtpVendor" class="myotpbtn">Send Verification OTP</button>
                                    <div id="MobiSendOtpSec">
                                        <p class="resendotp"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="bussinessDetails" style="display: none ;">
                            <div class="py-3 col-md-12">
                                <label class="labelHeadingSrb">Enter Vendor Personal Details :</label>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> First Name</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vF_name" name="first-name" placeholder=" First Name">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> Last Name</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vL_name" name="last-name" placeholder=" Last Name">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> User Name</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vUser_name" name="user name" placeholder="User Name">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label">Email Address</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vEmail_id" name="email" placeholder="admin@example.com">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label">Password</label>
                                    <div class="input-field pass1">
                                        <input id="vNewPass" type="password" class="form-control" name="password">
                                        <span></span>
                                        <i toggle="#vNewPass" class="toggle-icon fa fa-eye-slash fa-eye field-icon toggle-password"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label">Confirm Password</label>
                                    <div class="input-field">
                                        <input id="vRePass" type="password" class="form-control" name="re-pass">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div id="ErrMsg" style="display: none;"></div>
                            <div class="py-3 col-md-12">
                                <label class="labelHeadingSrb">Enter Vendor Business Details :</label>
                            </div>
                            <div class="tab-100 mb-3 col-md-6 ">
                                <div>
                                    <label class="form-label">Business Type</label>
                                    <div class="input-field">
                                        <select class="form-control " id="vBusType">
                                            <option>Business Type</option>
                                            <option value="Single Store">Single Store</option>
                                            <option value="Multi Store">Multi Store</option>
                                        </select>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6 ">
                                <div>
                                    <label class="form-label">Select Category</label>
                                    <div class="input-field">
                                        <select class="form-control " id="vBusCat">
                                            <option>Select Category</option>
                                            <?php
                                            $CateListQ = mysqli_query($con, "SELECT * FROM `category` WHERE `status`='Active'");

                                            while ($getCateList = mysqli_fetch_array($CateListQ)) {
                                            ?>
                                                <option value="<?= $getCateList['id'] ?>"><?= $getCateList['cat_name'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> Merchant Business Name</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vBusName" name="last-name" placeholder="Merchant Business Name">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> GST No.</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vGstNum" name="gstnumber" placeholder="GST No.">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-4">
                                <div>
                                    <label class="form-label"> Contact Person Name</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vCPname" name="last-name" placeholder=" Contact Person Name">
                                        <span></span>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-100 mb-3 col-md-8">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div>
                                            <label class="form-label"> Country Code</label>
                                            <div class="input-field">
                                                <select class="form-control" id="vCp_cCode">
                                                    <option></option>
                                                    <option value="91" selected>India 91</option>
                                                </select>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div>
                                            <label class="form-label"> Contact Person Phone Number</label>
                                            <div class="input-field">
                                                <input type="text" class="form-control" id="vCPmobile" oninput="this.value = this.value.replace(/\D+/g, '')" name="phone" placeholder="Person Number">
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label">Contact Person Email </label>
                                    <div class="input-field">
                                        <input type="email" class="form-control" id="vCPemail" name="email" placeholder="admin@example.com">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label">Landline No.</label>
                                    <div class="input-field">
                                        <input type="number" class="form-control" id="vLandlineNum" name="landlineno." placeholder="Landline No.">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="py-3 col-md-12">
                                <label class="labelHeadingSrb">Enter Vendor Business Address :</label>
                            </div>


                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label">Address 1</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="vAdd1" name="address" placeholder="Address 1">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> Address 2</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="route" name="address" placeholder="Address 2">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> Locality</label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="sublocality_level_1" name="locality" placeholder="locality">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> City </label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="locality" name="city" placeholder="City">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-100 mb-3 col-md-6">
                                <div>
                                    <label class="form-label"> State </label>
                                    <div class="input-field">
                                        <input type="text" class="form-control" id="administrative_area_level_1" name="state" placeholder="State">
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-50 col-md-6">
                                <div>
                                    <label class="form-label">Pincode </label>
                                    <div class="input-field">
                                        <input type="number" class="form-control" id="postal_code" name="zip-code" placeholder="10001">
                                        <span></span>
                                        <input type="hidden" id="latInput" placeholder="latatude" />
                                        <input type="hidden" id="lngInput" placeholder="longitude" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-check my-2">
                                <input id="agree_term" name="agree_term" class="form-check-input" type="checkbox">
                                <label class="form-check-label" for="agree_term">I agree to the <a href="../terms-condition.php">Terms & Conditions </a> and <a href="../privacy-policy.php">Privacy Policy</a>.</label>
                            </div>
                        </div>

                    </div>

                    <button type="button" class="btn btn-primary" disabled id="VendorRegBtn">Add Vendor</button>
                </form>

            </div>
        </div>
    </div>

</div>


<?php include('includes/footer.php'); ?>
<script src="assets/vendors/select2/select2.min.js"></script>
<script>
        $("#vNewPass").on("keyup", function(e) {
        $(this).prop('type', 'password');
        var value = $(this).val();
        $("#ErrMsg").hide();
        
        if (value != '') {
            var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
            var isValid = regex.test(value);
            if (!isValid) {
                $('#VendorRegBtn').attr('disabled', 'disabled');
                $("#vNewPass").addClass('err_bdr');
                $("#ErrMsg").fadeIn(100);
                $("#ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
            } else {
                $("#ErrMsg").hide();
                $('#VendorRegBtn').removeAttr('disabled', 'disabled');
                $("#vNewPass").removeClass('err_bdr');
            }
        }else{
            $("#ErrMsg").hide();
            $('#VendorRegBtn').attr('disabled', 'disabled');
        }
       
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>

<script>
    var placeSearch, autocomplete;
    var componentForm = {
        route: 'short_name',
        sublocality_level_1: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        postal_code: 'short_name'
    };
    var input = document.getElementById('vAdd1');

    function initMap() {
        var geocoder;
        var autocomplete;
        geocoder = new google.maps.Geocoder();
        var card = document.getElementById('locationField');
        autocomplete = new google.maps.places.Autocomplete(input);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            fillInAddress();
        });

        function fillInAddress(new_address) {
            if (typeof new_address == 'undefined') {
                var place = autocomplete.getPlace(input);
                var latValue = place.geometry.location.lat();
                var lngValue = place.geometry.location.lng();
                // console.log(lngValue);
                var latInput = document.getElementById('latInput');
                var lngInput = document.getElementById('lngInput');
                latInput.value = latValue;
                lngInput.value = lngValue;
            } else {
                place = new_address;
            }
            //console.log(place);
            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            for (var i = 0; i < place.address_components.length; i++) {

                var addressType = place.address_components[i].types[0];
                console.log(addressType);
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }

    }
</script>
<script>
    $(function() {
        'use strict'


        $("#vC_code").select2({
            placeholder: "Select Country Code"
        });
        $("#vCp_cCode").select2({
            placeholder: "Select Country Code"
        });



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
</script>

<script>
    $(document).on("click", "#sendOtpVendor", function() {
        vC_code = $('#vC_code').val();
        vMob_num = $('#vMob_num').val();

        if (vC_code == "") {
            alert("Select Country Code Please");
        } else if (vMob_num == "") {
            alert("Enter Mobile Number Please");

        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/otp.php",
                data: {
                    vC_code: vC_code,
                    vMob_num: vMob_num,
                    type: 'VendorOtpMob',
                    usertype: 'vendor'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        $('#vOtpCode').removeAttr('disabled', 'disabled');
                        $('#vOtpCode').focus();
                        $('#vMob_num').attr('disabled', 'disabled');
                        $("#sendOtpVendor").text('Verify Otp');
                        $("#sendOtpVendor").attr('id', 'verifyVendorMobOtp');
                        $("#VendorRegBtn").attr('disabled', 'disabled');
                        $("#MobiSendOtpSec").html('<p class="resendotp"> Resend OTP in <span id="countdowntimer">30 </span> Seconds</p>');

                        var timeleft = 30;
                        var downloadTimer = setInterval(function() {
                            timeleft--;
                            document.getElementById("countdowntimer").textContent = timeleft;
                            if (timeleft <= 0) {
                                clearInterval(downloadTimer);
                                $(".resendotp").html("<a href='javascript:void(0);' id='sendOtpVendor'>Resend otp</a>");
                            }

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

    $(document).on("click", "#verifyVendorMobOtp", function() {
        vOtpCode = $('#vOtpCode').val();
        vC_code = $('#vC_code').val();
        vMob_num = $('#vMob_num').val();

        if (vOtpCode == "") {
            swicon = "warning";
            msg = "Please Enter Verification !!";
            srbSweetAlret(msg, swicon);
        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/otp.php",
                data: {
                    vOtpCode: vOtpCode,
                    vC_code: vC_code,
                    vMob_num: vMob_num,
                    type: 'VendorOtpMobVer',
                    usertype: 'vendor'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        $("#bussinessDetails input").removeAttr('disabled', 'disabled');
                        $("#bussinessDetails select").removeAttr('disabled', 'disabled');
                        $("#bussinessDetails").show();
                        $('#vMob_num').attr('disabled', 'disabled');
                        $('#vC_code').attr('disabled', 'disabled');
                        $("#otpSec").hide();
                        $('#vendor_Form').removeClass('srb-mt-form');
                        $('#vF_name').focus();
                        $("#VendorRegBtn").removeAttr('disabled', 'disabled');
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        $('#vMob_num').val();
                        $('#vC_code').select2();
                    }
                }
            });
        }
    });

    function mobileVerified() {

        let mobileVerified;
        $.ajax({
            url: "../ajax/otp.php",
            type: "POST",
            async: false,
            data: {
                type: 'mobileVerified'
            },
            success: function(data) {

                if (data) {
                    mobileVerified = data;
                } else {
                    mobileVerified = data;
                }
            }
        });

        return mobileVerified;
    }

    $(document).on("click", "#VendorRegBtn", function() {
        vC_code = $('#vC_code').val();
        vMob_num = $('#vMob_num').val();
        vMob_ver = mobileVerified();
        vF_name = $('#vF_name').val();
        vL_name = $('#vL_name').val();
        vUser_name = $('#vUser_name').val();
        vEmail_id = $('#vEmail_id').val();
        vNewPass = $('#vNewPass').val();
        vRePass = $('#vRePass').val();
        vBusType = $('#vBusType').val();
        vBusCat = $('#vBusCat').val();
        vBusName = $('#vBusName').val();
        vCPname = $('#vCPname').val();
        vCPemail = $('#vCPemail').val();
        vCp_cCode = $('#vCp_cCode').val();
        vCPmobile = $('#vCPmobile').val();
        vGstNum = $('#vGstNum').val();
        vLandlineNum = $('#vLandlineNum').val();
        vAdd1 = $('#vAdd1').val();
        vAdd2 = $('#route').val();
        locality = $('#sublocality_level_1').val();
        vCity = $('#locality').val();
        vState = $('#administrative_area_level_1').val();
        vZipCode = $('#postal_code').val();
        vLatCode = $('#latInput').val();
        vLngCode = $('#lngInput').val();
        $agree_term = $("#agree_term").prop('checked');

        if (vC_code == "") {
            alert("Select Country Code Please");

        } else if (vMob_num == "") {
            alert("Enter Mobile Number Please");

        } else if (vMob_ver !== "1" && vMob_ver == "0") {
            alert("Please Verify Your mobile");

        } else if (vF_name == "") {
            alert("Enter First Name Please");

        } else if (vL_name == "") {
            alert("Enter Last Name Please");

        } else if (vUser_name == "") {
            alert("Enter User Name Please");

        } else if (vEmail_id == "") {
            alert("Enter Email Address Please");

        } else if (vNewPass == "") {
            alert("Enter Your Password Please");

        } else if (vRePass == "") {
            alert("Enter Confirm Password Please");

        } else if (vBusType == "") {
            alert("Select Business Type Please");

        } else if (vBusCat == "") {
            alert();
            msg = "Select Business Category Please";
            srbSweetAlret(msg, swicon);
        } else if (vBusName == "") {
            alert("Enter Business Name Please");

        } else if (vCPname == "") {
            alert("Enter Contact Person Name");

        } else if (vCp_cCode == "") {
            alert("Select Contact Person C.Code");

        } else if (vCPmobile == "") {
            alert("Enter Contact Person Mobile");

        } else if (vCPemail == "") {
            alert("Enter Contact Person Email");

        } else if (vAdd1 == "") {
            alert("Enter Address Please");

        } else if (vCity == "") {
            alert("Enter Your City Please");

        } else if (vState == "") {
            alert("Enter Your State Please");

        } else if (vZipCode == "") {
            alert("Enter ZIP Code Please");

        } else if ($agree_term == false) {
            alert("Please Agree Terms & Conditions");


        } else {
            $.ajax({
                type: "POST",
                url: "../ajax/registration.php",
                data: {
                    vC_code: vC_code,
                    vMob_num: vMob_num,
                    vMob_ver: vMob_ver,
                    vF_name: vF_name,
                    vL_name: vL_name,
                    vUser_name: vUser_name,
                    vEmail_id: vEmail_id,
                    vNewPass: vNewPass,
                    vRePass: vRePass,
                    vBusType: vBusType,
                    vBusCat: vBusCat,
                    vBusName: vBusName,
                    vCPname: vCPname,
                    vCPemail: vCPemail,
                    vCp_cCode: vCp_cCode,
                    vCPmobile: vCPmobile,
                    vGstNum: vGstNum,
                    vLandlineNum: vLandlineNum,
                    vAdd1: vAdd1,
                    vAdd2: vAdd2,
                    locality: locality,
                    vCity: vCity,
                    vState: vState,
                    vZipCode: vZipCode,
                    vLatCode: vLatCode,
                    vLngCode: vLngCode,
                    type: 'vendor_reg'
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);

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
</script>