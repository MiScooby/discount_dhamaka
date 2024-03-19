<?php
if(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']))
{
    $_SERVER['PHP_AUTH_USER'] = 'test';
    $_SERVER['PHP_AUTH_PW'] = 'test12345';
}
if ($_SERVER['PHP_AUTH_USER'] != '' && $_SERVER['PHP_AUTH_PW'] != '') {

    include('../admin/ajax/config.php');
    $serveruser = $_SERVER['PHP_AUTH_USER'];
    $serverpswd = $_SERVER['PHP_AUTH_PW'];

    $query_api = "select * from appservices where status='active'";

    $result_api = mysqli_query($con, $query_api);
    $row_api = mysqli_fetch_assoc($result_api);
    $username = $row_api['username'];
    $pswd = $row_api['password'];

    $auth_user = hash('sha256', $serverpswd);

    if ($serveruser == $username && $auth_user == $pswd) {
        
        $password_enc = $_POST['password'];
        $userloginid = $_POST['userloginid']; 
        $password = hash('sha256', $password_enc);

        // if(isset($_POST['username'])){

        if (isset($_POST['userloginid']) && isset($_POST['password'])) {
               
            $query = mysqli_query($con, "SELECT * FROM `vendor` WHERE ( `user_name` = '" . $userloginid . "' OR `mobile_num` = '" . $userloginid . "' ) AND `status`='Active' AND `is_deleted`='0' ;");
 
            $cnt = mysqli_num_rows($query);

            if ($cnt > 0) {
                $row = mysqli_fetch_assoc($query);
                $userDBpass = $row['password'];
                $userid = $row['id'];
                if ($userDBpass == $password) {


                    $hash_user_token = encrypt_decrypt($row['vendor_code'], 'encrypt');

                   

                    $loginURLForMobile = "https://micodetest.com/discount_dhamaka_new/log-device?v={$hash_user_token}";

                    echo json_encode(array('response' => 'Success', 'message' => 'Login Successful.', 'url' => $loginURLForMobile));
                  
                } else {
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Correct Password.', 'url' => ''));
                }
            } else {
                echo json_encode(array('response' => 'Failure', 'message' => 'Vendor Not Registered.', 'url' => ''));
            }
        } else {
            echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Full Credentials.', 'url' => ''));
        }
        // }
    } else {
        echo json_encode(array('response' => 'Failure', 'message' => 'Invalid Credentials.', 'url' => ''));
    }
} else {
    echo json_encode(array('response' => 'Failure', 'message' => 'Auth Credentials missing.', 'url' => ''));
}
