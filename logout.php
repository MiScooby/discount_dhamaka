<?php ob_start();
session_start();

if ($_SESSION['LoggedInMobile'] != 'yes') {
    session_unset();
    session_destroy();
    header('location:login.php');
} else {
    session_unset();
    session_destroy();
     header('location:blank.php');
}

?>