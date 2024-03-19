<?php include('config.php');
if (isset($_POST['type']) && $_POST['type'] == "statusChnage") {

    $userId = $_POST['userId'];
    $user_sts = $_POST['user_sts'];

    $chngStatus = mysqli_query($con, "UPDATE `user` SET `status`='$user_sts' WHERE `id`='$userId'");

    if ($chngStatus) {
        $data['message'] = 'Status Updated';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Status Update';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "DltUser") {

    $userIdnum = $_POST['userIdnum'];

    $chngStatus = mysqli_query($con, "UPDATE `user` SET `is_deleted` = '1' WHERE `id`='$userIdnum'");

    if ($chngStatus) {
        $data['message'] = 'User Deleted ';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in User Delete';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "UpdateUserDet") {
    $UserId = $_POST['UserId'];
    $UserName = $_POST['UserName'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $userStatus = $_POST['userStatus'];
    
    $updateDetails = mysqli_query($con, "UPDATE `user` SET `user_name`='$UserName',`first_name`='$FirstName',`last_name`='$LastName',`status`='$userStatus' WHERE `id`='$UserId' ");

    if ($updateDetails) {
        $data['message'] = 'User Details Updated ';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Update User Details';
        $data['status'] = false;
    }
}


echo json_encode($data);
