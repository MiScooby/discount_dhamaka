<?php session_start(); include('../admin/ajax/config.php');

$mobileNum = $_POST['mobileNum'];
$userName = $_POST['userName'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];


$passWordStr = $_POST['passWord'];
$passWord = hash('sha256', $passWordStr);

$cnfpassWordStr = $_POST['cnfpassWord'];
$cnfpassWord =  hash('sha256', $cnfpassWordStr);

if ($passWord == $cnfpassWord) {
    $addUser = mysqli_query($con, "INSERT INTO `user`( `user_name`, `first_name`, `last_name`, `mobile_num`, `password`, `mobile_verified`) VALUES ('$userName','$firstName','$lastName','$mobileNum','$passWord','1')");

    if ($addUser) {
        $mobileNumMSM = '+91'.$mobileNum;
        $client = new \GuzzleHttp\Client();

                            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                                'body' => '{"template_id":"64103ceed6fc0560ca6872c2","sender":"DISDMK","short_url":"0","mobiles":"' . $mobileNumMSM . '","var1":"' . $firstName . '"}',
                                'headers' => [
                                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                                    'accept' => 'application/json',
                                    'content-type' => 'application/json',
                                ],
                            ]);
                            
        $data['message'] = 'User Add SuccessFully';
        $_SESSION['LoggedInUser'] = $userName;
    } else {
        $data['message'] = 'Error in user add process';
    }
} else {
    $data['message'] = 'Password Are Not Same';
}

echo json_encode($data);
