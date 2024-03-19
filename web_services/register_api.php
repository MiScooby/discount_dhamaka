<?php
include('../admin/ajax/config.php');

session_start();
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
        if (!empty($type)){

            $verified = $_POST['verify'];
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $c_code = $_POST['c_code'];
            $mobile_no= $_POST['mobile_no'];
            $email_id = $_POST['email_id'];
            $passWordStr = $_POST['Password'];
            $passWord = hash('sha256', $passWordStr);
            $cnfpassWordStr = $_POST['ConfirmPassword'];
            $cnfpassWord = hash('sha256', $cnfpassWordStr);
            $device_type = $_POST['device_type'];
            $device_id = $_POST['device_id'];

            $token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'.round(microtime(true));
            $userTok = substr(str_shuffle($token), 0, 28);

            if($type == "mobile" || $type == "Mobile"){
                $username = $_POST['username'];
                $checkUserName = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name`='$username'");
                $userNamCount = mysqli_num_rows($checkUserName);
                if ($username != '') {
                    if ($userNamCount == 0) {
                        if ($username != '' && $firstName != '' && $lastName != '' && $c_code != '' && $mobile_no != '' && $passWordStr != ''  && $cnfpassWordStr != '' && $verified != '' && $device_type != '' && $device_id != '') {

                            if ($passWord == $cnfpassWord) {
                                $addUser = mysqli_query($con, "INSERT INTO `user`(`user_token`,`user_name`,`first_name`, `last_name`, `c_code`, `mobile_num`, `password`, `mobile_verified`, `device_type`, `device_id`) VALUES ( '$userTok','$username','$firstName','$lastName','$c_code','$mobile_no','$passWord','$verified','$device_type','$device_id')");
                                if ($addUser) {
                                    
                                    $hash_user_token = encrypt_decrypt($userTok, 'encrypt');
                                    $loginURLForMobile = "https://www.discountdhamaka.com/log-device?u={$hash_user_token}";

                                    echo json_encode(array('response' => 'Success', 'message' => 'Registration Successful!', 'url'=> $loginURLForMobile));
                                } else {
                                    echo json_encode(array('response' => 'Failure', 'message' => 'Error in User Registration!'));
                                }
                            } else {
                                echo json_encode(array('response' => 'Failure', 'message' => 'Confirm Password are not Matched'));
                            }
                        } else {
                            echo json_encode(array('response' => 'Failure', 'message' => 'Please Fill all the field.'));
                        }
                    } else {
                        echo json_encode(array('response' => 'Failure', 'message' => 'Username Already Exist.'));
                    }
                } else {
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Verify Username.'));
                } 
            }
            else if($type == "email" || $type == "Email"){
                $username = $_POST['username'];
                $checkUserName = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name`='$username'");
                $userNamCount = mysqli_num_rows($checkUserName);
                if ($username != '') {
                    if ($userNamCount == 0) {
                        if ($username != '' && $firstName != '' && $lastName != '' && $email_id != '' && $passWordStr != ''  && $cnfpassWordStr != '' && $verified != ''  && $device_type != '' && $device_id != '') {

                            if ($passWord == $cnfpassWord) {
                                $addUser = mysqli_query($con, "INSERT INTO `user`( `user_token`,`user_name`,`first_name`, `last_name`, `email_id`, `password`, `email_verified`, `device_type`, `device_id`) VALUES ('$userTok','$username','$firstName','$lastName','$email_id','$passWord','$verified','$device_type','$device_id')");
                                if ($addUser) {

                                    $hash_user_token = encrypt_decrypt($userTok, 'encrypt');
                                    $loginURLForEmail = "https://www.discountdhamaka.com/log-device?u={$hash_user_token}";

                                    echo json_encode(array('response' => 'Success', 'message' => 'User Added Successfully', 'url'=> $loginURLForEmail));

                                } else {
                                    echo json_encode(array('response' => 'Failure', 'message' => 'Error in User Adding Process'));
                                }
                            } else {
                                echo json_encode(array('response' => 'Failure', 'message' => 'Confirm Password are not Matched'));
                            }
                        } else {
                            echo json_encode(array('response' => 'Failure', 'message' => 'Please Fill all the field.'));
                        }
                    } else {
                        echo json_encode(array('response' => 'Failure', 'message' => 'Username Allready Exist.'));
                    }
                } else {
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Verify Username.'));
                } 
            }
            else{
                echo json_encode(array('response' => 'Failure', 'message' => 'please Enter Valid Type.'));
            }
        }
        else{
            echo json_encode(array('response' => 'Failure', 'message' => 'please Enter Type Mobile/Email.'));
        }

    } else {
        echo json_encode(array('response' => 'Failure', 'message' => 'Invalid Credentials.', 'url' => ''));
    }
} else {
    echo json_encode(array('response' => 'Failure', 'message' => 'Auth Credentials missing.', 'url' => ''));
}
