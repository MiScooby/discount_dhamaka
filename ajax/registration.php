<?php session_start();
include('../admin/ajax/config.php');
require_once('../vendor2/autoload.php');

if (isset($_POST['type']) && $_POST['type'] == "registerViaEmail") {

    $token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz' . round(microtime(true));
    $userTok = substr(str_shuffle($token), 0, 28);

    $emailAddress = $_POST['emailAddress'];
    $email_ver = str_replace('"', '', $_POST['email_ver']);
    $email_userName = $_POST['email_userName'];
    $email_firstName = $_POST['email_firstName'];
    $email_lastName = $_POST['email_lastName'];

    $passWordStr = $_POST['email_Password'];
    $passWord = hash('sha256', $passWordStr);

    $cnfpassWordStr = $_POST['email_confirmPassword'];
    $cnfpassWord =  hash('sha256', $cnfpassWordStr);
    $checkUserName = mysqli_query($con, "SELECT * FROM `user` WHERE  `user_name`='$email_userName' ");
    $userNamCount = mysqli_num_rows($checkUserName);
    if ($userNamCount == 0) {
        if ($passWord == $cnfpassWord) {
            $addUser = mysqli_query($con, "INSERT INTO `user`(`user_token`,`user_name`, `first_name`, `last_name`,  `email_id`, `password`, `email_verified`) VALUES ('$userTok','$email_userName', '$email_firstName','$email_lastName','$emailAddress','$passWord',$email_ver)");

            if ($addUser) {
                $data['message'] = 'User Add SuccessFully';
                $data['status'] = true;
                $_SESSION['LoggedInUser'] = $email_userName;

                // SEND EMAIL to new user on registration
                // $userName =  $email_firstName . ' ' . $email_lastName;
                // $mail->AddAddress("afreen@maishinfotech.com", "$userName");
                // $mail->Subject = 'Discount Dhamaka Acoount Creation';
                // $mail->MsgHTML('Your account is created successfully');

                // if ($mail->send()) {
                //     $data['sentMail'] = 'success';
                // } else {
                //     $data['sentMail'] = 'failure';
                // }


            } else {
                $data['message'] = 'Error in user add process';
                $data['status'] = false;
            }
        } else {
            $data['message'] = 'Password Are Not Same';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'User Name Already Exist';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "registerViaMob") {

    $token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz' . round(microtime(true));
    $userTok = substr(str_shuffle($token), 0, 28);

    $c_code = $_POST['c_code'];
    $mobNum = $_POST['mobNum'];

    $mobile_ver = str_replace('"', '', $_POST['mobile_ver']);
    $mob_userName = $_POST['mob_userName'];
    $mob_firstName = $_POST['mob_firstName'];
    $mob_lastName = $_POST['mob_lastName'];

    $passWordStr = $_POST['mob_Password'];
    $passWord = hash('sha256', $passWordStr);

    $cnfpassWordStr = $_POST['mob_confirmPassword'];
    $cnfpassWord =  hash('sha256', $cnfpassWordStr);

    $checkUserName = mysqli_query($con, "SELECT * FROM `user` WHERE  `user_name`='$mob_userName' ");
    $userNamCount = mysqli_num_rows($checkUserName);
    if ($userNamCount == 0) {
        if ($passWord == $cnfpassWord) {
            $addUser = mysqli_query($con, "INSERT INTO `user`(`user_token`,`user_name`,`first_name`, `last_name`, `c_code`, `mobile_num`, `password`, `mobile_verified`) VALUES ('$userTok','$mob_userName','$mob_firstName','$mob_lastName','$c_code','$mobNum','$passWord','$mobile_ver')");

            if ($addUser) {
                $data['message'] = 'User Add SuccessFully';
                $data['status'] = true;
                $_SESSION['LoggedInUser'] = $mob_userName;
                $number = $c_code . $mobNum;
                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                    'body' => '{"template_id":"64103ceed6fc0560ca6872c2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $mob_firstName . '"}',
                    'headers' => [
                        'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                    ],
                ]);
                // echo $response->getBody();
            } else {
                $data['message'] = 'Error in user add process';
                $data['status'] = false;
            }
        } else {
            $data['message'] = 'Password Are Not Same';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'User Name Already Exist';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "vendor_reg") {
    $token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz' . round(microtime(true));
    $userTok = substr(str_shuffle($token), 0, 28);

    $vC_code = $_POST['vC_code'];
    $vMob_num = $_POST['vMob_num'];
    $vMob_ver = str_replace('"', '', $_POST['vMob_ver']);
    $vF_name = $_POST['vF_name'];
    $vL_name = $_POST['vL_name'];
    $vUser_name = $_POST['vUser_name'];
    $vEmail_id = $_POST['vEmail_id'];

    $vNewPass = $_POST['vNewPass'];
    $passWord = hash('sha256', $vNewPass);

    $vRePass = $_POST['vRePass'];
    $cnfpassWord =  hash('sha256', $vRePass);

    $vBusType = $_POST['vBusType'];
    $vBusCat = $_POST['vBusCat'];
    $vBusName = $_POST['vBusName'];
    $vCPname = $_POST['vCPname'];
    $vCPemail = $_POST['vCPemail'];

    $vCp_cCode = $_POST['vCp_cCode'];
    $vCPmobile = $_POST['vCPmobile'];
    $vGstNum = (empty($_POST['vGstNum'])) ? 'n/a' :  $_POST['vGstNum'];
    $vLandlineNum = (empty($_POST['vLandlineNum'])) ? 'n/a'  :  $_POST['vLandlineNum'];
    $vAdd1 = $_POST['vAdd1'];
    $vAdd2 = (empty($_POST['vAdd2'])) ? 'n/a' : $_POST['vAdd2'];
    $vCity = $_POST['vCity'];
    $vState = $_POST['vState'];
    $vZipCode = $_POST['vZipCode'];
    $vLatCode = $_POST['vLatCode'];
    $vLngCode = $_POST['vLngCode'];
    $Ins_d = date('Y/m/d');
    $Ins_t = date("h:i:s");

    $tokdr = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $toknebe = substr(str_shuffle($tokdr), 0, 5);

    $VenCode = 'DD-' . $toknebe . '-VEN'. round(microtime(true));

    $checkUserName = mysqli_query($con, "SELECT * FROM `vendor` WHERE  `user_name`='$vUser_name'");

    $userNamCount = mysqli_num_rows($checkUserName);
    if ($userNamCount == 0) {

        $checkEmail = mysqli_query($con, "SELECT * FROM `vendor` WHERE  `email_id`='$vEmail_id'");

        $useremailCount = mysqli_num_rows($checkEmail);

        if ($useremailCount == 0) {
            if ($passWord == $cnfpassWord) {

                $addVendor = mysqli_query($con, "INSERT INTO `vendor`(`vendor_code`,`user_name`, `f_name`, `l_name`, `c_code`, `mobile_num`, `mobile_verified`, `email_id`, `password`, `business_type`, `business_cat`, `address_1`, `address_2`, `city`, `state`, `pin_code`,`latitude`,`longtitude`, `merchant_bus_name`, `cp_name`, `cp_email`, `cp_c_code`, `cp_num`, `gst_num`, `landline_num`, `ins_date`, `ins_time`) VALUES ('$VenCode','$vUser_name','$vF_name','$vL_name','$vC_code','$vMob_num','$vMob_ver', '$vEmail_id' ,'$passWord','$vBusType','$vBusCat','$vAdd1','$vAdd2','$vCity','$vState','$vZipCode','$vLatCode','$vLngCode','$vBusName', '$vCPname','$vCPemail', '$vCp_cCode', '$vCPmobile','$vGstNum','$vLandlineNum', '$Ins_d', '$Ins_t')");

                if ($addVendor) {
                    $vId = mysqli_fetch_array(mysqli_query($con, "SELECT id FROM `vendor` ORDER BY `id` DESC LIMIT 1"))['id'];
                    if ($vBusType == 'Multi brand') {
                        $ms = 1;
                    } else {
                        $ms = 0;
                    }

                    $data['url'] = 'business_document.php?' . $urltoken . $urltoken . '&vendor_id=' . $vId . '&' . $urltoken . '&' . $urltoken . '&ms=' . $ms . '&' . $urltoken;
                    $data['message'] = 'Vendor Add SuccessFully';
                    $data['status'] = true;
                } else {
                    $data['message'] = 'Error in Vendor add process';
                    $data['status'] = false;
                }
            } else {
                $data['message'] = 'Password Are Not Same';
                $data['status'] = false;
            }
        } else {
            $data['message'] = 'Vendor Email Id Already Exist';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Vendor User Name Already Exist';
        $data['status'] = false;
    }
}
if (isset($_POST['type']) && $_POST['type'] == "vendor_docs_upload") {
    $vId = $_POST['ven_id'];
    $gstFile = $_FILES['gstFile'];
    $pCFile = $_FILES['panCardFile'];

    $gstExt = explode('.', $gstFile['name'])[1];
    $pcFExt = explode('.', $pCFile['name'])[1];


    if (!empty($_FILES['brandApprovalFile']['tmp_name'])) {
        $bAFile = $_FILES['brandApprovalFile'];
        $baFExt = explode('.', $bAFile['name'])[1];
        $baF = 'brand_' . round(microtime(true)) . '.' . $baFExt;
    } else {
        $baF = '';
    }

    $gstF = 'gst_' . round(microtime(true)) . '.' . $gstExt;
    $pcF = 'pan_' . round(microtime(true)) . '.' . $pcFExt;

    $vendorType = mysqli_fetch_array(mysqli_query($con, "SELECT `business_type` FROM `vendor` WHERE id = '$vId'"))['business_type'];

    $vendorDet = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor` WHERE id = '$vId'"));

    $insetDocs = mysqli_query($con, "INSERT INTO `vendor_document_upload` ( `vendor_id`, `vendor_type`, `gst_file`, `pan_file`, `brand_appr_file`) VALUES ( '$vId', '$vendorType', '$gstF', '$pcF', '$baF')");

    if ($insetDocs) {
        $data['message'] = 'Documents Uploaded Successfully';
        $data['status'] = true;

        if ($baF != '') {
            move_uploaded_file($bAFile['tmp_name'], "../upload/vendor-doc/vendor-docs/" . $baF);
        }
        move_uploaded_file($gstFile['tmp_name'], "../upload/vendor-doc/vendor-docs/" . $gstF);
        move_uploaded_file($pCFile['tmp_name'], "../upload/vendor-doc/vendor-docs/" . $pcF);

        $vName = $vendorDet['f_name'];
        $c_code = $vendorDet['c_code'];
        $mobNum = $vendorDet['mobile_num'];

        $number = $c_code . $mobNum;




        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"64103df7d6fc054ba80aeaf6","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vName . '"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        // echo $response->getBody();


    } else {
        $data['message'] = 'Could not upload documents';
        $data['status'] = false;
    }
}
echo json_encode($data);
