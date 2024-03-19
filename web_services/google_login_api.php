<?php
include('../admin/ajax/config.php');
error_reporting(0);

if(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']))
{
    $_SERVER['PHP_AUTH_USER'] = 'test';
    $_SERVER['PHP_AUTH_PW'] = 'test12345';
}

 if ($_SERVER['PHP_AUTH_USER'] != '' && $_SERVER['PHP_AUTH_PW'] != ''){
    
    $serveruser = $_SERVER['PHP_AUTH_USER'];
    $serverpswd = $_SERVER['PHP_AUTH_PW'];
    $query_api = "select * from appservices where status='active'";

    $result_api = mysqli_query($con, $query_api);
    $row_api = mysqli_fetch_assoc($result_api);
    $username = $row_api['username'];
    $pswd = $row_api['password'];

    $auth_user = hash('sha256', $serverpswd);
    if ($serveruser == $username && $auth_user == $pswd){

        $user_name = $_POST['user_name'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $email_id = $_POST['email_id'];
        // $passWordStr = $_POST['Password'];
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $urltoken = substr(str_shuffle($str), 0, 10);
        $password = hash('sha256', $urltoken);
        $device_type = $_POST['device_type'];
        $device_id = $_POST['device_id'];
        

        // $email_id = $_POST['email_id'];
            if ($email_id != '') {
                $query = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id` = '".$email_id."'");
                $cnt = mysqli_num_rows($query);                
                if ($cnt > 0){
                    $row = mysqli_fetch_assoc($query);
                    // $tkn = $row['user_token'];
                    // echo $tkn; die;

                    $hash_user_token = encrypt_decrypt($row['user_token'], 'encrypt');
                    $loginURLForMobile = "https://micodetest.com/discount_dhamaka_new/log-device?u={$hash_user_token}";

                        echo json_encode(array('response' => 'Success', 'message'=>'Login Successful.', 'url' => $loginURLForMobile)); 
                }else{
                    if ($user_name != ''){
                        $token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'.round(microtime(true));
                        $userTok = substr(str_shuffle($token), 0, 28);

                        $check_username = mysqli_query($con, "select * FROM user WHERE `user_name`='$user_name'");
                        $usernameCount = mysqli_num_rows($check_username);
                        if ($usernameCount == '0'){
                            if ($username != '' && $firstName != '' && $lastName != '' && $email_id != ''  && $device_type != '' && $device_id != '') {
                                $addUser = mysqli_query($con, "INSERT INTO `user`(`user_token`,`user_name`,`first_name`, `last_name`, `email_id`, `password`, `device_type`, `device_id`) VALUES ('$userTok','$user_name','$firstName','$lastName','$email_id','$password','$device_type','$device_id')");
                                if ($addUser) {

                                    $hash_user_token = encrypt_decrypt($userTok, 'encrypt');
                                    $loginURLForMobile = "https://micodetest.com/discount_dhamaka_new/log-device?u={$hash_user_token}";
                                    echo json_encode(array('response' => 'Success', 'message' => 'Login Successful!', 'url'=> $loginURLForMobile));

                                } else {
                                    echo json_encode(array('response' => 'Failure', 'message' => 'Error in User Adding Process'));
                                }
                            } else {
                                echo json_encode(array('response' => 'Failure', 'message' => 'Please Fill all the field.'));
                            }
                        }
                        else{
                            echo json_encode(array('response' => 'Failure', 'message' => 'Username Allready Taken.'));
                        }
                    }else{
                        echo json_encode(array('response' => 'Failure', 'message' => 'Please Verify Username.'));
                    }
                }
            } else {
                echo json_encode(array('response' => 'Failure', 'message'=>'Please Enter Email ID.'));
            }

    } else {
        echo json_encode(array('response' => 'Failure', 'message'=>'Invalid Credentials.'));
    }
} else {
    echo json_encode(array('response' => 'Failure', 'message'=>'Auth Credentials missing.'));
}
