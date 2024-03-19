    <?php

    if (isset($_GET["code"])) {
        //It will Attempt to exchange a code for an valid authentication token.
        $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

        //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
        if (!isset($token['error'])) {
            //Set the access token used for requests
            $google_client->setAccessToken($token['access_token']);

            //Store "access_token" value in $_SESSION variable for future use.
            $_SESSION['access_token'] = $token['access_token'];

            //Create Object of Google Service OAuth 2 class
            $google_service = new Google_Service_Oauth2($google_client);

            //Get user profile data from google
            $data = $google_service->userinfo->get();

            //Below you can find Get profile data and store into $_SESSION variable
            $userinfo = [
                'email' => $data['email'],
                'first_name' => $data['givenName'],
                'last_name' => $data['familyName'],
                'gender' => $data['gender'],
                'full_name' => $data['name'],
                'picture' => $data['picture'],
                'verifiedEmail' => $data['verifiedEmail'],
                'token' => $data['id'],
            ];

            $token5 = substr($userinfo['token'], 0, 5);
            $userName = $userinfo['first_name'].$token5;
            // checking if user is already exists in database
            $EmailChecksql = "SELECT * FROM `user` WHERE `email_id`='{$userinfo['email']}'";
            $EmailCheckresult = mysqli_query($con, $EmailChecksql);
            
            if (mysqli_num_rows($EmailCheckresult) > 0) {
                // user is exists
                $userinfo = mysqli_fetch_array($EmailCheckresult);
                $token = $userinfo['user_name'];
            } else {
                $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                $urltoken = substr(str_shuffle($str), 0, 8);
                $passWord = hash('sha256', $urltoken);

                $insertUsersql = "INSERT INTO `user`(`user_name`, `first_name`, `last_name`,`email_id`, `password`, `email_verified`) VALUES ('$userName','{$userinfo['first_name']}','{$userinfo['last_name']}','{$userinfo['email']}','$passWord','{$data['verifiedEmail']}')";

                $insertUsersqlresult = mysqli_query($con, $insertUsersql);
                if ($insertUsersqlresult) {
                    $token = $userName;
                } else {
                    echo "User is not created";
                    die();
                }
            }

            // save user data into session
            $_SESSION['LoggedInUser'] = $token;
        }
    }
