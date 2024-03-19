<?php include('../admin/ajax/config.php');
$mobOtp = $_POST['mobOtp'];
$otpMob = $_POST['otpMob'];
$checkMob = mysqli_query($con, "SELECT * FROM `mobile_otp_ver` WHERE `mobile`='$otpMob'");

$gteOPT = mysqli_fetch_array($checkMob);
$otp = $gteOPT['otp'];

if ($otp == $mobOtp) {
    $data['message'] = 'Otp Verify';
    $data['status'] = true;
    $cookie_name = "mob_ver";
    $cookie_value = "1";
    setcookie($cookie_name, $cookie_value, time() + (60 * 5), "/");
} else {
    $data['message'] = 'Otp Not Verify';
    $data['status'] = false;
}


echo json_encode($data);
