<?php
include('../admin/ajax/config.php');
require_once '../emailer/mail.class.php';
require_once('../vendor2/autoload.php');
$OTPtoken = '1234567890' . round(microtime(true));
$user_otp = substr(str_shuffle($OTPtoken), 0, 4);

// email otp
if (isset($_POST['type']) && $_POST['type'] == "EmailOtp") {
    $emailAddress = $_POST['emailAddress'];
    $usertype = $_POST['usertype'];

    // user otp


    // usertype: 'user'
    $checkEmail = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id`='$emailAddress' AND `is_deleted`='0' ");
    if (mysqli_num_rows($checkEmail) == 0) {
        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`email_id`, `otp`) VALUES ('$usertype','$emailAddress','$user_otp')");
        if ($genrateOtp) {

            // for user otp mail
            include '../emailer_html/otp-emailer/index.php';

            $mail_title = "Discount Dhamaka";

            $mail_subject = "Discount Dhamaka Signup Verification Code";

            // user email-id
            $user_mail = new HttpMail($emailAddress);

            $user_mail->send($mail_title, $mail_subject, $userotpmsg);


            $data['message'] = 'Otp Genrated';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error found on Otp Genrated';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Email Id already Exist';
        $data['status'] = false;
    }
}
if (isset($_POST['type']) && $_POST['type'] == "verEmailOtp") {

    $emailAddress = $_POST['emailAddress'];
    $emailOtp = $_POST['emailOtp'];
    $usertype = $_POST['usertype'];

    $checkEmailid = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `email_id`='$emailAddress' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkEmailid);
    $otp = $gteOPT['otp'];

    if ($otp == $emailOtp) {
        $data['message'] = 'Otp Verified';
        $data['status'] = true;
        $cookie_name = "email_ver";
        $cookie_value = 1;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    } else {
        $data['message'] = 'Otp Not Verify';
        $data['status'] = false;
    }
}

// mobile Otp Section
if (isset($_POST['type']) && $_POST['type'] == "MobileOtp") {
    $c_code = $_POST['c_code'];
    $mobNum = $_POST['mobNum'];
    $usertype = $_POST['usertype'];
    $checkMobile = mysqli_query($con, "SELECT * FROM `user` WHERE `c_code`='$c_code' AND `mobile_num`='$mobNum' AND `is_deleted`='0'");
    if (mysqli_num_rows($checkMobile) == 0) {
        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`c_code`, `mobile`, `otp`) VALUES ('$usertype','$c_code','$mobNum','$user_otp')");
        if ($genrateOtp) {
            $number = $c_code . $mobNum;
            $msg = $user_otp;



            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"64103e9bd6fc0509ad120fb4","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"","var2":"' . $msg . '"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            // echo $response->getBody();

            $data['message'] = 'Otp Genrated';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error found on Otp Genrated';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Mobile Num already Exist';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "MobileOtpVer") {

    $verifyOtpMob = $_POST['verifyOtpMob'];
    $mobNum = $_POST['mobNum'];
    $c_code = $_POST['c_code'];
    $usertype = $_POST['usertype'];

    $checkmobCode = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `c_code`='$c_code' AND `mobile`='$mobNum' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkmobCode);
    $otp = $gteOPT['otp'];

    if ($otp == $verifyOtpMob) {
        $data['message'] = 'Otp Verified';
        $data['status'] = true;
        $cookie_name = "mobile_ver";
        $cookie_value = 1;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    } else {
        $data['message'] = 'Wrong OTP Entered';
        $data['status'] = false;
    }
}

// email or mob is verified or not
if (isset($_POST['type']) && $_POST['type'] == "emailVerified") {

    if (isset($_COOKIE['email_ver'])) {
        $data =  $_COOKIE['email_ver'];
    } else {
        $data = 0;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "mobileVerified") {

    if (isset($_COOKIE['mobile_ver'])) {
        $data =  $_COOKIE['mobile_ver'];
    } else {
        $data = 0;
    }
}

// forget Password Otp Section
if (isset($_POST['type']) && $_POST['type'] == "frgtPassOtp") {
    $fp_c_code = $_POST['fp_c_code'];
    $fp_mob_num = $_POST['fp_mob_num'];
    $usertype = $_POST['usertype'];
    $checkUser = mysqli_query($con, "SELECT * FROM `user` WHERE `c_code`='$fp_c_code' AND `mobile_num`='$fp_mob_num'");
    if (mysqli_num_rows($checkUser) > 0) {
        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`c_code`, `mobile`, `otp`) VALUES ('$usertype','$fp_c_code','$fp_mob_num','$user_otp')");

        if ($genrateOtp) {
            $number = $fp_c_code . $fp_mob_num;
            $msg = $user_otp;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"64103c7ad6fc056106190642","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"","var2":"' . $msg . '"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            // echo $response->getBody();
            $data['message'] = 'OTP Genrated';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error found on OTP Genrated';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Mobile Number Not Registered !';
        $data['status'] = false;
    }
}
if (isset($_POST['type']) && $_POST['type'] == "Fp_MobileOtpVer") {

    $fp_verifyOtpMob = $_POST['fp_verifyOtpMob'];
    $fp_mob_num = $_POST['fp_mob_num'];
    $fp_c_code = $_POST['fp_c_code'];
    $usertype = $_POST['usertype'];

    $checkmobCode = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `c_code`='$fp_c_code' AND `mobile`='$fp_mob_num' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkmobCode);
    $otp = $gteOPT['otp'];

    if ($otp == $fp_verifyOtpMob) {
        $checkUser = mysqli_query($con, "SELECT * FROM `user` WHERE `c_code`='$fp_c_code' AND `mobile_num`='$fp_mob_num'");
        $getUsrName = mysqli_fetch_array($checkUser);
        $data['userName'] = $getUsrName['user_name'];
        $data['message'] = 'Otp Verified';
        $data['status'] = true;
        $cookie_name = "mobile_ver";
        $cookie_value = 1;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    } else {
        $data['message'] = 'Wrong OTP Entered';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "frgtPassOtp_email") {
    $fb_emailAddress = $_POST['fb_emailAddress'];
    $usertype = $_POST['usertype'];

    $checkEmail = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id`='$fb_emailAddress'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`email_id`, `otp`) VALUES ('$usertype','$fb_emailAddress','$user_otp')");
        if ($genrateOtp) {


            // // for user otp mail
            // include '../emailer_html/otp_emailer.php';

            // $mail_title = "Discount Dhamaka";

            // $mail_subject = "Discount Dhamaka Forgot Password OTP Verification Code";

            // // user email-id
            // $user_mail = new HttpMail($fb_emailAddress);

            // $user_mail->send($mail_title, $mail_subject, $userotpmsg);


            $data['message'] = 'Otp Genrated';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error found on Otp Genrated';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Email Id Not Registered';
        $data['status'] = false;
    }
}
if (isset($_POST['type']) && $_POST['type'] == "Fp_EmailOtpVer") {

    $fp_verifyOtpEmail = $_POST['fp_verifyOtpEmail'];
    $fb_emailAddress = $_POST['fb_emailAddress'];
    $usertype = $_POST['usertype'];

    $checkEmailid = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `email_id`='$fb_emailAddress' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkEmailid);
    $otp = $gteOPT['otp'];

    if ($otp == $fp_verifyOtpEmail) {

        $checkUser = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id`='$fb_emailAddress'  ");
        $getUsrName = mysqli_fetch_array($checkUser);
        $data['userName'] = $getUsrName['user_name'];

        $data['message'] = 'Otp Verified';
        $data['status'] = true;
        $cookie_name = "email_ver";
        $cookie_value = 1;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    } else {
        $data['message'] = 'Wrong OTP Entered';
        $data['status'] = false;
    }
}

// vendor Otp Section

if (isset($_POST['type']) && $_POST['type'] == "VendorOtpMob") {
    $vC_code = $_POST['vC_code'];
    $vMob_num = $_POST['vMob_num'];
    $usertype = $_POST['usertype'];

    $checkMobile = mysqli_query($con, "SELECT * FROM `vendor` WHERE `c_code`='$vC_code' AND `mobile_num`='$vMob_num'  AND `is_deleted`='0'");

    if (mysqli_num_rows($checkMobile) == 0) {

        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`c_code`, `mobile`, `otp`) VALUES ('$usertype','$vC_code','$vMob_num','$user_otp')");
        if ($genrateOtp) {
            $number = $vC_code . $vMob_num;
            // $four_digit_code = rand(1000, 9999);
            $msg = $user_otp;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"64103e67d6fc05685a7fef52","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"","var2":"' . $msg . '"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            // echo $response->getBody();
            $data['message'] = 'Otp Genrated';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error found on Otp Genrated';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Mobile Num already Exist';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "VendorOtpMobVer") {

    $vOtpCode = $_POST['vOtpCode'];
    $vMob_num = $_POST['vMob_num'];
    $vC_code = $_POST['vC_code'];
    $usertype = $_POST['usertype'];

    $checkmobCode = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `c_code`='$vC_code' AND `mobile`='$vMob_num' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkmobCode);
    $otp = $gteOPT['otp'];

    if ($otp == $vOtpCode) {
        $data['message'] = 'Otp Verified';
        $data['status'] = true;
        $cookie_name = "mobile_ver";
        $cookie_value = 1;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    } else {
        $data['message'] = 'Wrong OTP Entered !!';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "VfrgtPassOtp") {
    $vfp_c_code = $_POST['vfp_c_code'];
    $vfp_mob_num = $_POST['vfp_mob_num'];
    $usertype = $_POST['usertype'];

    $checkUser = mysqli_query($con, "SELECT * FROM `vendor` WHERE `c_code`='$vfp_c_code' AND `mobile_num`='$vfp_mob_num'");
    $fetcVen = mysqli_fetch_array($checkUser);
    if (mysqli_num_rows($checkUser) > 0) {
        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`c_code`, `mobile`, `otp`) VALUES ('$usertype','$vfp_c_code','$vfp_mob_num','$user_otp')");
        if ($genrateOtp) {
            $number = $vfp_c_code . $vfp_mob_num;
            // $four_digit_code = rand(1000, 9999);
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"64103c7ad6fc056106190642","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $fetcVen['f_name'] . '","var2":"' . $user_otp . '"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            $data['message'] = 'OTP Genrated';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error found on OTP Genrated';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Mobile Number Not Registered !';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "vFp_MobileOtpVer") {

    $vfp_verifyOtpMob = $_POST['vfp_verifyOtpMob'];
    $vfp_mob_num = $_POST['vfp_mob_num'];
    $vfp_c_code = $_POST['vfp_c_code'];
    $usertype = $_POST['usertype'];

    $checkmobCode = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `c_code`='$vfp_c_code' AND `mobile`='$vfp_mob_num' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkmobCode);
    $otp = $gteOPT['otp'];

    if ($otp == $vfp_verifyOtpMob) {
        $checkUser = mysqli_query($con, "SELECT * FROM `vendor` WHERE `c_code`='$vfp_c_code' AND `mobile_num`='$vfp_mob_num'");
        $getUsrName = mysqli_fetch_array($checkUser);
        $data['userName'] = $getUsrName['user_name'];
        $data['message'] = 'Otp Verified';
        $data['status'] = true;
        $cookie_name = "mobile_ver";
        $cookie_value = 1;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    } else {
        $data['message'] = 'Wrong OTP Entered';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "sendOtpVendorEdit") {
    $vuserName = $_POST['vuserName'];
    $usertype = $_POST['usertype'];
    $checkVendor = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vuserName' ");
    $getDet = mysqli_fetch_array($checkVendor);
    $vcodeC = $getDet['c_code'];
    $vmobnum = $getDet['mobile_num'];

    $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`c_code`, `mobile`, `otp`) VALUES ('$usertype','$vcodeC','$vmobnum','$user_otp')");
    if ($genrateOtp) {
         $number = $vcodeC . $vmobnum;
        
        // $four_digit_code = rand(1000, 9999);
        $msg = $user_otp;
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"64a934c4d6fc0550a1548742","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vuserName . '", "var2":"' . $msg . '"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        // echo $response->getBody();
        $data['message'] = 'Otp Genrated';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error found on Otp Genrated';
        $data['status'] = false;
    }
}
if (isset($_POST['type']) && $_POST['type'] == "verOtpVendorEdit") {

    $vuserName = $_POST['vuserName'];
    $usertype = $_POST['usertype'];
    $checkVendor = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vuserName' ");
    $getDet = mysqli_fetch_array($checkVendor);
    $vC_Code = $getDet['c_code'];
    $vmobnum = $getDet['mobile_num'];
    $vEditOtp = $_POST['vEditOtp'];
    $checkmobCode = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `c_code`='$vC_Code' AND `mobile`='$vmobnum' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkmobCode);
    $otp = $gteOPT['otp'];

    if ($otp == $vEditOtp) {
        $data['message'] = 'Otp Verified';
        $data['status'] = true;
        $cookie_name = "mobile_ver";
        $cookie_value = 1;
        setcookie($cookie_name, $cookie_value, time() + 30, "/");
    } else {
        $data['message'] = 'Wrong OTP Entered';
        $data['status'] = false;
    }
}
echo json_encode($data);
