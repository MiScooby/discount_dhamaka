<?php
include('../admin/ajax/config.php');
require_once '../emailer/mail.class.php';
require_once('../vendor2/autoload.php');
error_reporting(0);
$OTPtoken = '1234567890' . round(microtime(true));
$user_otp = substr(str_shuffle($OTPtoken), 0, 4);
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


            $email_id = $_POST['email_id'];
            $usertype = $_POST['usertype'];
            $c_code = $_POST['c_code'];
            $mobile = $_POST['mobile'];


            if ($type == "email" || $type == "Email") {
                if ($email_id != '' && $usertype != '') {
                    $query = mysqli_query($con, "select * FROM user WHERE `email_id` = '" . $email_id . "'");
                    $cnt = mysqli_num_rows($query);
                    if ($cnt == '0') {
                        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`, `email_id`, `otp`) VALUES ('$usertype','$email_id','$user_otp')");
                        if ($genrateOtp) {
                            $queryy = "SELECT * from `user_temp` WHERE `email_id` = $email_id";
                            $fetch_queryy = mysqli_query($con, $queryy);
                            $row_fetch = mysqli_fetch_assoc($fetch_queryy);
                            echo json_encode(array('response' => 'Success', 'message' => 'Otp Send Successfully !'));
                        } else {
                            echo json_encode(array('response' => 'Failure', 'message' => 'Error in Otp Genration Process !'));
                        }
                    } else {
                        echo json_encode(array('response' => 'Failure', 'message' => 'Email Already Exist.'));
                    }
                } else {
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter All Details.'));
                }
            } else if ($type == "mobile" || $type == "Mobile") {

                if ($mobile != '' && $c_code != '' && $usertype != '') {

                    $query = mysqli_query($con, "select * FROM user WHERE `mobile_num` = '" . $mobile . "'");
                    $cnt = mysqli_num_rows($query);
                    if ($cnt == '0') {

                        $genrateOtp = mysqli_query($con, "INSERT INTO `user_temp`(`user_type`,`c_code`, `mobile`, `otp`) VALUES ('$usertype','$c_code','$mobile','$user_otp')");
                        if ($genrateOtp) {
                            $queryy = "SELECT * from `user_temp` WHERE `mobile` = $mobile";
                            $fetch_queryy = mysqli_query($con, $queryy);
                            $row_fetch = mysqli_fetch_assoc($fetch_queryy);
                            $number = $c_code . $mobile;
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
                            echo json_encode(array('response' => 'Success', 'message' => 'Otp Send Successfully !'));
                        } else {
                            echo json_encode(array('response' => 'Failure', 'message' => 'Error in Otp Genration Process !'));
                        }
                    } else {
                        echo json_encode(array('response' => 'Failure', 'message' => 'Mobile Already Exist'));
                    }
                } else {
                    echo json_encode(array('response' => 'Failure', 'message' => 'Something Went Wrong.'));
                }
            } else {
                echo json_encode(array('response' => 'Failure', 'message' => 'Invalid Type'));
            }
        } else {
            echo json_encode(array('response' => 'Failure', 'message' => 'please Enter Type Mobile/Email'));
        }
    } else {
        echo json_encode(array('response' => 'Failure', 'message' => 'Invalid Credentials.', 'url' => ''));
    }
} else {
    echo json_encode(array('response' => 'Failure', 'message' => 'Auth Credentials missing.', 'url' => ''));
}
