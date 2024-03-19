<?php 
include('../admin/ajax/config.php');
error_reporting(0);
if(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']))
{
    $_SERVER['PHP_AUTH_USER'] = 'test';
    $_SERVER['PHP_AUTH_PW'] = 'test12345';
}
//if ($_SERVER['PHP_AUTH_USER'] == 'test') {
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
        $type = $_POST['type'];
        if(!empty($type)){
            $email_id = $_POST['email_id'];
            $c_code = $_POST['c_code'];
            $mobile = $_POST['mobile'];

            if($type == "email" || $type == "Email"){
                if ($email_id != ''){
                    $query = mysqli_query($con, "select * FROM user WHERE `email_id` = '" . $email_id . "'");
                    $cnt = mysqli_num_rows($query);
                    if ($cnt >= '1'){
                        $passWordStr = $_POST['Password'];
                        $passWord = hash('sha256', $passWordStr);
                        $cnfpassWordStr = $_POST['ConfirmPassword'];
                        $cnfpassWord = hash('sha256', $cnfpassWordStr);
                        if($passWordStr != '' && $cnfpassWordStr != ''){
                            if ($passWord == $cnfpassWord){
                                $updatePassword = "update `user` set password='".$passWord."' where email_id='".$email_id."'";
                                $update_query = mysqli_query($con, $updatePassword);
                                if ($update_query){
                                    echo json_encode(array('response' => 'Success', 'message' => 'Password Updated Successfully'));
                                }else{
                                    echo json_encode(array('response' => 'Failure', 'message' => 'Error in Password Updation'));
                                }
                            }else{
                                echo json_encode(array('response' => 'Failure', 'message' => 'Confirm Password are not Matched'));
                            }
                        }else{
                            echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Password.'));
                        }
                    }else{
                        echo json_encode(array('response' => 'Failure', 'message' => 'Email Not Exist..'));
                    }
                }else{
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Fill all the Fields.'));
                }

            }else if($type == "mobile" || $type == "Mobile"){
                if ($mobile != '' && $c_code != ''){
                    $query = mysqli_query($con, "select * FROM user WHERE `mobile_num` = '" . $mobile . "'");
                    $cnt = mysqli_num_rows($query);
                    if ($cnt > '0'){
                        $passWordStr = $_POST['Password'];
                        $passWord = hash('sha256', $passWordStr);
                        $cnfpassWordStr = $_POST['ConfirmPassword'];
                        $cnfpassWord = hash('sha256', $cnfpassWordStr);
                        if($passWordStr != '' && $cnfpassWordStr != ''){
                            if ($passWord == $cnfpassWord){
                                $updatePassword = "update `user` set password='".$passWord."' where mobile_num='".$mobile."'";
                                $update_query = mysqli_query($con, $updatePassword);
                                if ($update_query){
                                    echo json_encode(array('response' => 'Success', 'message' => 'Password Updated Successfully'));
                                }else{
                                    echo json_encode(array('response' => 'Failure', 'message' => 'Error in Password Updateion'));
                                }
                            }else{
                                echo json_encode(array('response' => 'Failure', 'message' => 'Confirm Password are not Matched'));
                            }

                        }
                        else{
                            echo json_encode(array('response' => 'Failure', 'message' => 'Please Enter Password.'));
                        }
                    }else{
                        echo json_encode(array('response' => 'Failure', 'message' => 'Mobile Not Exist.'));
                    }

                }
                else{
                    echo json_encode(array('response' => 'Failure', 'message' => 'Please Fill all the Fields.'));
                }

            }else{
                echo json_encode(array('response' => 'Failure', 'message' => 'Invalid Type'));
            }

        }else{
            echo json_encode(array('response' => 'Failure', 'message' => 'please Enter Type Mobile/Email'));
        }
    }else{
        echo json_encode(array('response' => 'Failure', 'message' => 'Invalid Credentials.', 'url' => ''));
    }

}else {
    echo json_encode(array('response' => 'Failure', 'message' => 'Auth Credentials missing.', 'url' => ''));
}


?>