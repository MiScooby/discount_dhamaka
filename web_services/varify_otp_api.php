<?php
include('../admin/ajax/config.php');
error_reporting(0);
if(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']))
{
    $_SERVER['PHP_AUTH_USER'] = 'test';
    $_SERVER['PHP_AUTH_PW'] = 'test12345';
}
if ($_SERVER['PHP_AUTH_USER'] != '' && $_SERVER['PHP_AUTH_PW'] != '') {

    $serveruser = $_SERVER['PHP_AUTH_USER'];
    $serverpswd = $_SERVER['PHP_AUTH_PW'];

    $query_api = "select * from appservices where status='active'";

    $result_api = mysqli_query($con, $query_api);
    $row_api = mysqli_fetch_assoc($result_api);
    $username = $row_api['username'];
    $pswd = $row_api['password'];
    $auth_user = hash('sha256', $serverpswd);

    if ($serveruser == $username && $auth_user == $pswd) {
        $type = $_POST['type'];
        if (!empty($type)) {
            if ($type == "email" || $type == "Email") {
                $email_id = $_POST['email'];
                if ($email_id != '') {
                    $queryy = "SELECT * from `user_temp` WHERE `email_id` = '" . $email_id . "' order by id DESC";
                    $fetch_queryy = mysqli_query($con, $queryy);
                    $fetch_row = mysqli_num_rows($fetch_queryy);
                    if ($fetch_row > 0) {
                        $otp = $_POST['otp'];
                        if ($otp != '') {
                            $otp_fetch = mysqli_fetch_assoc($fetch_queryy);
                            $check_otp = $otp_fetch['otp'];
                            if ($otp == $check_otp) {
                                echo json_encode(array('response' => 'Success', 'varify' => '1', 'message' => 'Otp Varified Successfully!'));
                            } else {
                                echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Correct OTP'));
                            }
                        } else {
                            echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter OTP.'));
                        }
                    } else {
                        echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Valid Email.'));
                    }
                } else {
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Email ID To Varify OTP'));
                }
            } else if ($type == "mobile" || $type == "Mobile") {
                $mobile = $_POST['mobile'];
                if ($mobile != '') {

                    $queryy = "SELECT * from `user_temp` WHERE `mobile` = '" . $mobile . "' order by id DESC";
                    $fetch_queryy = mysqli_query($con, $queryy);
                    $fetch_row = mysqli_num_rows($fetch_queryy);
                    if ($fetch_row > 0) {
                        $otp = $_POST['otp'];
                        if ($otp != '') {
                            $otp_fetch = mysqli_fetch_assoc($fetch_queryy);
                            $check_otp = $otp_fetch['otp'];
                            if ($otp == $check_otp) {
                                echo json_encode(array('response' => 'Success', 'varify' => '1', 'message' => 'Otp Varified Successfully!'));
                            } else {
                                echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Correct OTP'));
                            }
                        } else {
                            echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter OTP.'));
                        }
                    } else {
                        echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Valid Mobile.'));
                    }
                } else {
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Mobile To Varify OTP'));
                }
            } else {
                echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Mobile To Varify OTP'));
            }
        } else {
            echo json_encode(array('response' => 'Failure', 'message' => 'please Enter Type Mobile/Email'));
        }
    } else {
        echo json_encode(array('response' => 'Failure', 'message' => 'Invalid Credentials.'));
    }
} else {
    echo json_encode(array('response' => 'Failure', 'message' => 'Auth Credentials missing.'));
}
