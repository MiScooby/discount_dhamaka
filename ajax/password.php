<?php include('../admin/ajax/config.php');
require_once('../vendor2/autoload.php');
if (isset($_POST['type']) && $_POST['type'] == "pswdUpdateMob") {

    $MobUserName = $_POST['MobUserName'];
    $mob_newPswd = $_POST['mob_newPswd'];
    $mob_cfrmPswd = $_POST['mob_cfrmPswd'];

    if ($mob_newPswd == $mob_cfrmPswd) {
        $usrMsgDet = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `user` WHERE user_name = '$MobUserName'"));
        $UName = $usrMsgDet['first_name'];
        $c_code = $usrMsgDet['c_code'];
        $mobNum = $usrMsgDet['mobile_num'];

        $passWord = hash('sha256', $mob_newPswd);
        $updatePswd = mysqli_query($con, "UPDATE `user` SET `password`='$passWord' WHERE `user_name`='$MobUserName'");
        if ($updatePswd) {

            $data['message'] = 'Password Change Successfully';
            $data['status'] = true;

            $number = $c_code . $mobNum;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"64103c36d6fc0571c8232ab5","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $UName . '"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            // echo $response->getBody();

        } else {
            $data['message'] = 'Error in Password Change';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Password Not Matched';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "pswdUpdateEmail") {

    $EmailUserName = $_POST['EmailUserName'];
    $Email_newPswd = $_POST['Email_newPswd'];
    $Email_cfrmPswd = $_POST['Email_cfrmPswd'];

    if ($Email_newPswd == $Email_cfrmPswd) {
        $passWord = hash('sha256', $Email_newPswd);
        $updatePswd = mysqli_query($con, "UPDATE `user` SET `password`='$passWord' WHERE `user_name`='$EmailUserName'");
        if ($updatePswd) {
            $data['message'] = 'Password Change Successfully';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error in Password Change';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Password Not Matched';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "VpswdUpdateMob") {

    $vMobUserName = $_POST['vMobUserName'];
    $vmob_newPswd = $_POST['vmob_newPswd'];
    $vmob_cfrmPswd = $_POST['vmob_cfrmPswd'];

    if ($vmob_newPswd == $vmob_cfrmPswd) {
        $passWord = hash('sha256', $vmob_newPswd);
        $updatePswd = mysqli_query($con, "UPDATE `vendor` SET `password`='$passWord' WHERE `user_name`='$vMobUserName'");

        $vdrMsgDet = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor` WHERE user_name = '$vMobUserName'"));
        $vName = $vdrMsgDet['f_name'];
        $c_code = $vdrMsgDet['c_code'];
        $mobNum = $vdrMsgDet['mobile_num'];

        if ($updatePswd) {
            $data['message'] = 'Password Change Successfully';
            $data['url'] = 'login.php?'.$urltoken.$urltoken.'&vendorlogin&'.$urltoken.$urltoken;
            $data['status'] = true;
            $number = $c_code . $mobNum;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"64103c36d6fc0571c8232ab5","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vName . '"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            // echo $response->getBody();
        } else {
            $data['message'] = 'Error in Password Change';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Password Not Matched';
        $data['status'] = false;
    }
}
echo json_encode($data);
