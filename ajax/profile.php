<?php include('../admin/ajax/config.php');

if (isset($_POST['type']) && $_POST['type'] == "editUserProfile") {
    $UserName = $_POST['UserName'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $cntry_code = $_POST['cntry_code'];
    $userMob_mu =$_POST['userMob_mu'];

    $updtaProfileQuer = mysqli_query($con, "UPDATE `user` SET `user_name`='$UserName',`first_name`='$FirstName',`last_name`='$LastName' WHERE `c_code`='$cntry_code' AND `mobile_num`='$userMob_mu' ");

    // echo "UPDATE `user` SET `user_name`='$UserName',`first_name`='$FirstName',`last_name`='$LastName' WHERE `c_code`='$cntry_code' AND `mobile_num`='$userMob_mu'";
    // die();

    if ($updtaProfileQuer) {
        $data['message'] = 'Profile Update';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Found in Profile Update';
        $data['status'] = false;
    }
}


echo json_encode($data);
