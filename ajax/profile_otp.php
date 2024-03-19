<?php include('../admin/ajax/config.php');
require_once '../emailer/mail.class.php';
$user_otep = rand(1000, 9999);
$user_otp  = substr(str_shuffle($user_otep), 0, 4);
// $user_otp  = "1234";
if (isset($_POST['type']) && $_POST['type'] == "EmailOtp") {
    $emailAddress = $_POST['emailAddress'];
    $usertype = $_POST['usertype'];

    // usertype: 'user'
    $checkEmail = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id`='$emailAddress'");
    if (mysqli_num_rows($checkEmail) == 0) {
        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`email_id`, `otp`) VALUES ('$usertype','$emailAddress','$user_otp')");
        if ($genrateOtp) {
            // for user otp mail
            include '../emailer_html/otp-emailer/index.php';

            $mail_title = "Discount Dhamaka";

            $mail_subject = "Discount Dhamaka Email Verification Code";

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

    // mychange
    $userid = $_POST['userid'];

    $checkEmailid = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `email_id`='$emailAddress' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkEmailid);
    $otp = $gteOPT['otp'];

    if ($otp == $emailOtp) {

        // my change
        $emailupdate = mysqli_query($con, "UPDATE `user` SET `email_id`='$emailAddress', `email_verified`='1' WHERE `user_name`='$userid'");

        $data['message'] = 'Otp Verify';
        $data['status'] = true;
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
    $checkMobile = mysqli_query($con, "SELECT * FROM `user` WHERE `c_code`='$c_code' AND `mobile_num`='$mobNum'");
    if (mysqli_num_rows($checkMobile) == 0) {
        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`c_code`, `mobile`, `otp`) VALUES ('$usertype','$c_code','$mobNum','$user_otp')");
        if ($genrateOtp) {
            $number = $c_code.$mobNum;
            // $four_digit_code = rand(1000, 9999);
            $msg = $user_otp;
            $msgs = urldecode($msg);
            $url = 'https://rest.nexmo.com/sms/json?' . http_build_query(
                [
                    'api_key' =>  '550fbd53',
                    'api_secret' => 'JcWwE9ctNTkwDv8t',
                    'to' => $number,
                    'from' => 'Vonage APIs',
                    'text' => 'Your One Time Code is '. $msgs .' Please Dont Share it with any one'
                ]
            );
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
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

    // mychange
    $userid = $_POST['userid'];

    $checkmobCode = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `c_code`='$c_code' AND `mobile`='$mobNum' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkmobCode);
    $otp = $gteOPT['otp'];

    if ($otp == $verifyOtpMob) {

        // my change
        $emailupdate = mysqli_query($con, "UPDATE `user` SET `c_code`='$c_code',`mobile_num`='$mobNum', `mobile_verified`='1' WHERE `user_name`='$userid'");

        $data['message'] = 'Otp Verify';
        $data['status'] = true;
    } else {
        $data['message'] = 'Otp Not Verify';
        $data['status'] = false;
    }
}


// vendor email otp
if (isset($_POST['type']) && $_POST['type'] == "vendorEmailOtpVer") {
    $VenemailAddressVer = $_POST['VenemailAddressVer'];
    $usertype = $_POST['usertype'];

    // usertype: 'user'

    $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`email_id`, `otp`) VALUES ('$usertype','$VenemailAddressVer','$user_otp')");
    if ($genrateOtp) {
         // for user otp mail
         include '../emailer_html/otp-emailer/index.php';

         $mail_title="Discount Dhamaka";

         $mail_subject="Discount Dhamaka Signup Verification Code";

         // user email-id
         $user_mail = new HttpMail($VenemailAddressVer);

         $user_mail->send($mail_title,$mail_subject,$userotpmsg);
        $data['message'] = 'Otp Genrated';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error found on Otp Genrated';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "verEmailOtpVendor") {

    $VenemailAddressVer = $_POST['VenemailAddressVer'];
    $emailOtp = $_POST['emailOtp'];
    $usertype = $_POST['usertype'];

    // mychange
    $VendorId = $_POST['VendorId'];

    $checkEmailid = mysqli_query($con, "SELECT * FROM `user_temp` WHERE `email_id`='$VenemailAddressVer' AND `user_type`='$usertype' ORDER BY `user_temp`.`id` DESC");

    $gteOPT = mysqli_fetch_array($checkEmailid);
    $otp = $gteOPT['otp'];

    if ($otp == $emailOtp) {

        // my change
        $emailupdate = mysqli_query($con, "UPDATE `vendor` SET `email_verified`='1' WHERE `user_name`='$VendorId'");

        $data['message'] = 'Otp Verify';
        $data['status'] = true;
    } else {
        $data['message'] = 'Otp Not Verify';
        $data['status'] = false;
    }
}

echo json_encode($data);
