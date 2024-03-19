<?php session_start();
include('config.php');

$adminU = $_POST['loginEmail'];
$adminPstr = $_POST['loginPass'];
$adminP = hash('sha256', $adminPstr);
$ip_add = $_SERVER['REMOTE_ADDR'];
$logIns_d = date('Y/m/d');
$logIns_t = date("h:i:s");
$aUser_check = mysqli_query($con, "SELECT ee.*, er.status as role_status, er.trash as role_trash FROM ec_employee ee, ec_roles_type er WHERE ee.email = '" . $adminU . "' AND ee.email_verified='1' AND ee.status='1' AND er.id = ee.role_id");

$aUser_count = mysqli_num_rows($aUser_check);

if ($aUser_count > 0) {

    $aUser_table = mysqli_fetch_assoc($aUser_check);
  
    $db_pass = $aUser_table['password'];
    $user_token = $aUser_table['email'];
    if ($aUser_table['role_trash'] == '0') {
        if ($aUser_table['role_status'] == '1') {
            if ($adminP == $db_pass) {
                $logInQuery = mysqli_query($con, "UPDATE `ec_employee` SET `last_login_date`='$logIns_d',`last_login_time`='$logIns_t',`ip_address`='$ip_add' WHERE `email` = '$adminU' ");
                $login_att = mysqli_query($con, "INSERT INTO `ec_login_attempts`(`user_name`, `password`, `login_date`, `login_time`, `ip_address`, `status`) VALUES ('$adminU','$adminP','$logIns_d','$logIns_t','$ip_add','Pass')");
                echo json_encode(array('status' => true, 'message' => 'Login Successfully Enjoy Your Account'));
                $_SESSION['usertoken'] = $user_token;

                if ($_POST["loginSave"] == "1") {
                    setcookie("member_login", $_POST["loginEmail"], time() + 31556926, '/');
                    setcookie("member_p", $_POST["loginPass"], time() + 31556926, '/');
                } else {

                    setcookie("member_login", $_POST["loginEmail"], time() - 31556926, '/');
                    setcookie("member_p", $_POST["loginPass"], time() - 31556926, '/');
                }
            } else {
                $login_att = mysqli_query($con, "INSERT INTO `ec_login_attempts`(`user_name`, `password`, `login_date`, `login_time`, `ip_address`, `status`) VALUES ('$adminU','$adminP','$logIns_d','$logIns_t','$ip_add','Fail')");
                echo json_encode(array('status' => false, 'message' => 'Wrong Password Entered !'));
            }
        } else {
            $login_att = mysqli_query($con, "INSERT INTO `ec_login_attempts`(`user_name`, `password`, `login_date`, `login_time`, `ip_address`, `status`) VALUES ('$adminU','$adminP','$logIns_d','$logIns_t','$ip_add','Fail')");
            echo json_encode(array('status' => false, 'message' => 'Role Not Active !'));
        }
    } else {
        $login_att = mysqli_query($con, "INSERT INTO `ec_login_attempts`(`user_name`, `password`, `login_date`, `login_time`, `ip_address`, `status`) VALUES ('$adminU','$adminP','$logIns_d','$logIns_t','$ip_add','Fail')");
        echo json_encode(array('status' => false, 'message' => 'Role Not Exist !'));
    }
} else {
    $login_att = mysqli_query($con, "INSERT INTO `ec_login_attempts`(`user_name`, `password`, `login_date`, `login_time`, `ip_address`, `status`) VALUES ('$adminU','$adminP','$logIns_d','$logIns_t','$ip_add','Fail')");
    echo json_encode(array('status' => false, 'message' => 'Invalid email !'));
}
