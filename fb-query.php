<?php
include('fb-config.php');

if (isset($_GET['code'])) {
    if (isset($_SESSION['LoggedInUser'])) {
        $access_token = $_SESSION['LoggedInUser'];
    } else {
        $access_token = $facebook_helper->getAccessToken();

        $_SESSION['LoggedInUser'] = $access_token;

        $facebook->setDefaultAccessToken($_SESSION['LoggedInUser']);
    }


    $graph_response = $facebook->get("/me?fields=id,name,first_name,last_name,email", $access_token);

    $facebook_user_info = $graph_response->getGraphUser();

    $userinfo = [
        'email' => $facebook_user_info['email'],
        'first_name' => $facebook_user_info['first_name'],
        'last_name' => $facebook_user_info['last_name'],
    ];

    // $userName = $facebook_user_info['id'];
     $token5 = substr($facebook_user_info['id'], 0, 5);
            $userName = $userinfo['first_name'].$token5;
    
    $EmailChecksql = "SELECT * FROM `user` WHERE  `email_id`='{$userinfo['email']}'";
    $EmailCheckresult = mysqli_query($con, $EmailChecksql);

    if (mysqli_num_rows($EmailCheckresult) > 0) {
        // user is exists
        $userinfo = mysqli_fetch_array($EmailCheckresult);
        $token = $userinfo['user_name'];
    } else {
        $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
        $urltoken = substr(str_shuffle($str), 0, 8);
        $passWord = hash('sha256', $urltoken);

        $insertUsersql = "INSERT INTO `user`(`user_name`, `first_name`, `last_name`,`email_id`, `password`, `email_verified`) VALUES ('$userName','{$userinfo['first_name']}','{$userinfo['last_name']}','{$userinfo['email']}','$passWord','1')";

        $insertUsersqlresult = mysqli_query($con, $insertUsersql);
        if ($insertUsersqlresult) {

            
            $token = $userName;
        } else {
            echo "User is not created";
            die();
        }
    }

    $_SESSION['LoggedInUser'] = $token;
}
