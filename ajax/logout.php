<?php 
include('../admin/ajax/config.php');
session_start();

if (!isset($_SESSION['LoggedInMobile'])) {

    if (isset($_SESSION['LoggedInVendor'])) {        
        session_unset();
        session_destroy();
        $data['url'] = "login.php?" . $urltoken . $urltoken . "&vendorlogin&" . $urltoken . $urltoken;
    } else {
        session_unset();
        session_destroy();
        $data['url'] = "login.php";
    }
} else {
    session_unset();
    session_destroy();
    $data['url'] = "blank.php";
}


echo json_encode($data);
