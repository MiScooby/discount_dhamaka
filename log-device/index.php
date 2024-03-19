<?php
ob_start();
session_start();
include('../admin/ajax/config.php');

if (isset($_GET['u'])) {

    $get_token = $_GET['u'];
     
    $dec_user_token = encrypt_decrypt($get_token, 'decrypt');
    


    $checkToken = mysqli_query($con, "SELECT * FROM `user` WHERE `user_token`='$dec_user_token'");
    if (mysqli_num_rows($checkToken) > 0) {
        
        $getuserPass = mysqli_fetch_array($checkToken);
        $dbuser = $getuserPass['user_name'];
        if (isset($dbuser)) {
            
            $_SESSION['LoggedInUser'] = $dbuser;
            $_SESSION['LoggedInMobile'] = 'yes';
            // print_r($_SESSION);
            // die;
            header('Location: https://discountdhamaka.com/');
        } else {

            header('Location: https://discountdhamaka.com/login.php');
        }
    } else {

        header('Location: https://discountdhamaka.com/login.php');
    }
} else if (isset($_GET['v'])) {

    $get_token = $_GET['v'];
    $dec_user_token = encrypt_decrypt($get_token, 'decrypt');



    $checkToken = mysqli_query($con, "SELECT * FROM `vendor` WHERE `vendor_code`='$dec_user_token'");
    if (mysqli_num_rows($checkToken) > 0) {
        $getuserPass = mysqli_fetch_array($checkToken);
        $dbuser = $getuserPass['user_name'];
        if (isset($dbuser)) {

            $_SESSION['LoggedInVendor'] = $dbuser;
            $_SESSION['LoggedInMobile'] = 'yes';
            header('Location: https://www.discountdhamaka.com/');
        } else {

            header('Location: https://www.discountdhamaka.com/login.php');
        }
    } else {

        header('Location: https://www.discountdhamaka.com/login.php');
    }
}
