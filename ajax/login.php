<?php session_start();
include('../admin/ajax/config.php');

if (isset($_POST['type']) && $_POST['type'] == "userLogMob") {
    //  print_r($_POST);
    // die();
    $mobNum = $_POST['mobNum'];
    $passWordstr = $_POST['UserpassWord'];
    $passWord =  hash('sha256', $passWordstr);

    $checkMob = mysqli_query($con, "SELECT * FROM `user` WHERE `mobile_num`='$mobNum' AND `status` = 'Active' AND `is_deleted`='0'");
    if (mysqli_num_rows($checkMob) > 0) {
        $getuserPass = mysqli_fetch_array($checkMob);
        $UserPass = $getuserPass['password'];
        $userName = $getuserPass['user_name'];
        if ($getuserPass['status'] == 'Active') {
            if ($passWord == $UserPass) {
                $_SESSION['LoggedInUser'] = $userName;
                $data['message'] = 'Logined';
                $data['status'] = true;
            } else {
                $data['message'] = 'Wrong Password';
                $data['status'] = false;
            }
        } else {
            $data['message'] = 'Your account is not active';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Mobile Not Register';
        $data['status'] = false;
    }
}
if (isset($_POST['type']) && $_POST['type'] == "userLogEmail") {
    $emailId = $_POST['emailId'];
    $passWordstr = $_POST['UserpassWord'];
    $passWord =  hash('sha256', $passWordstr);

    $checkEmail = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id`='$emailId' AND `is_deleted`='0'");
    if (mysqli_num_rows($checkEmail) > 0) {
        $getuserPass = mysqli_fetch_array($checkEmail);
        $UserPass = $getuserPass['password'];
        $userName = $getuserPass['user_name'];
        if ($getuserPass['status'] == 'Active') {
            if ($passWord == $UserPass) {
                $_SESSION['LoggedInUser'] = $userName;
                $data['message'] = 'Login Successfull';
                $data['status'] = true;
            } else {
                $data['message'] = 'Wrong Password';
                $data['status'] = false;
            }
        } else {
            $data['message'] = 'Your account is not active';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Email Not Register';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "vendorLogMob") {
    //  print_r($_POST);
    // die();
    $Vendorc_code = $_POST['Vendorc_code'];
    $vendor_mobileNumber = $_POST['vendor_mobileNumber'];
    $VendorLoginPass = $_POST['VendorLoginPass'];
    $passWord =  hash('sha256', $VendorLoginPass);

    $checkMob = mysqli_query($con, "SELECT * FROM `vendor` WHERE `mobile_num`='$vendor_mobileNumber' AND `c_code`='$Vendorc_code' AND `is_deleted`='0'");
    if (mysqli_num_rows($checkMob) > 0) {
        $getuserPass = mysqli_fetch_array($checkMob);
        if ($getuserPass['status'] == "Active") {
            if ($getuserPass['first_login'] != 0) {
                $UserPass = $getuserPass['password'];
                $userName = $getuserPass['user_name'];
                if ($getuserPass['status'] == 'Active') {
                    if ($passWord == $UserPass) {
                        $_SESSION['LoggedInVendor'] = $userName;
                        $data['message'] = 'Logined';
                        $data['status'] = true;
                    } else {
                        $data['message'] = 'Wrong Password';
                        $data['status'] = false;
                    }
                } else {
                    $data['message'] = 'Your account is not active';
                    $data['status'] = false;
                }
            } else {
                $firstLogin = mysqli_query($con, "UPDATE `vendor` SET `first_login`='1' WHERE `mobile_num`='$vendor_mobileNumber' AND `c_code`='$Vendorc_code'");

                $UserPass = $getuserPass['password'];
                $userName = $getuserPass['user_name'];
                if ($getuserPass['status'] == 'Active') {
                    if ($passWord == $UserPass) {
                        $_SESSION['LoggedInVendor'] = $userName;
                        $data['FirstLogin'] = "1";
                        $data['message'] = 'Logined';
                        $data['status'] = true;
                    } else {
                        $data['message'] = 'Wrong Password';
                        $data['status'] = false;
                    }
                } else {
                    $data['message'] = 'Your account is not active';
                    $data['status'] = false;
                }
            }
        } else {
            $data['message'] = 'Vendor Not Active';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Mobile Not Register';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "vendorLogUser") {

    $vendor_userName = $_POST['vendor_userName'];
    $VendorLoginPassUser = $_POST['VendorLoginPassUser'];
    $passWord =  hash('sha256', $VendorLoginPassUser);

    $checkMob = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vendor_userName' AND `is_deleted`='0'");
    $getuserPass = mysqli_fetch_assoc($checkMob);
 
    if (mysqli_num_rows($checkMob) > 0) {
        $checkVenStatus = mysqli_fetch_assoc($checkMob)['is_deleted'];
        if($checkVenStatus){
            $data['message'] = 'Vendor Deleted';
                $data['status'] = false;
        }
        else{
            //  $getuserPass = mysqli_fetch_assoc($checkMob);
           
            if ($getuserPass['status'] == "Active") {
                $UserPass = $getuserPass['password'];
                $userName = $getuserPass['user_name'];
                if ($passWord == $UserPass) {
                    $_SESSION['LoggedInVendor'] = $userName;
                    $data['message'] = 'Logined';
                    $data['status'] = true;
                } else {
                    $data['message'] = 'Wrong Password';
                    $data['status'] = false;
                }
            } else {
                $data['message'] = 'Vendor Not Active';
                $data['status'] = false;
            }
        }
       
    } else {
        $data['message'] = 'User Name Not Exist';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "isloggined") {
    if ((isset($_SESSION['LoggedInUser'])) && ($_SESSION['LoggedInUser'] != "")) {
        $data =  true;
    } else {
        $data =  false;
    }
}
echo json_encode($data);
