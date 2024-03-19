<?php
//echo $auth_user = hash('sha256', $_SERVER['PHP_AUTH_PW']);exit;
//$_SERVER['PHP_AUTH_USER'] = 'test';

if(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']))
{
    $_SERVER['PHP_AUTH_USER'] = 'test';
    $_SERVER['PHP_AUTH_PW'] = 'test12345';
}

if ($_SERVER['PHP_AUTH_USER'] != '' && $_SERVER['PHP_AUTH_PW'] != '') {
    // echo $_SERVER['PHP_AUTH_USER'];exit;
    include('../admin/ajax/config.php');
    $serveruser = $_SERVER['PHP_AUTH_USER'];
    $serverpswd = $_SERVER['PHP_AUTH_PW'];

    $query_api = "select * from appservices where status='active'";

    $result_api = mysqli_query($con, $query_api);
    $row_api = mysqli_fetch_assoc($result_api);
    $username = $row_api['username'];
    $pswd = $row_api['password'];

    $auth_user = hash('sha256', $serverpswd);

    if ($serveruser == $username && $auth_user == $pswd){
        // $email_id = $_POST['email_id'];
        // $mobile = $_POST['username'];
        $password_enc = $_POST['password'];
        $userloginid = $_POST['userloginid'];
        $devicetype = $_POST['device_type'];
        $deviceid = $_POST['device_id'];
        $password = hash('sha256', $password_enc);

        // if(isset($_POST['username'])){

            if (isset($_POST['userloginid']) && isset($_POST['password']) && isset($_POST['device_type']) && isset($_POST['device_id'])) {
                
                 $sql = "SELECT * FROM `user` WHERE `email_id` = '" . $userloginid . "' OR `mobile_num` = '" . $userloginid . "'";
                //$query = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id` = '".$userloginid."' OR `mobile_num` = '".$userloginid."'");
                $query = mysqli_query($con, $sql);
                $cnt = mysqli_num_rows($query);
                
                if ($cnt > 0) {
                    $row = mysqli_fetch_assoc($query);
                    $userDBpass = $row['password'];
                    $userid = $row['id'];
                    if($userDBpass == $password){
                        
                        
                        $hash_user_token = encrypt_decrypt($row['user_token'], 'encrypt');

                        //echo '<br><br><br>';

                        //echo encrypt_decrypt($abcabc, 'decrypt');die();

                        $loginURLForMobile = "https://www.discountdhamaka.com/log-device?u={$hash_user_token}";
                        
                        echo json_encode(array('response' => 'Success', 'message'=>'Login Successful.', 'url' => $loginURLForMobile));
                        $update = "update user set device_type='".$devicetype."', device_id='".$deviceid."' where id='".$userid."'";
                        mysqli_query($con, $update);
                        
                    }else{
                        echo json_encode(array('response' => 'Failure', 'message'=>'Please Enter Correct Password.', 'url' => ''));
                    }
                    
                }else{
                    echo json_encode(array('response' => 'Failure', 'message'=>'User Not Registered.', 'url' => ''));
                }
            } else {
                echo json_encode(array('response' => 'Failure', 'message'=>'Please Enter Full Credentials.', 'url' => ''));
            }
        // }
    } else {
        echo json_encode(array('response' => 'Failure', 'message'=>'Invalid Credentials.', 'url' => ''));
    }
} else {
    echo json_encode(array('response' => 'Failure', 'message'=>'Auth Credentials missing.', 'url' => ''));
}
