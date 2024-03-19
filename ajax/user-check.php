<?php include('../admin/ajax/config.php');

    $userName = $_POST['userName'];

    $checkMob = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name`='$userName'");
    if (mysqli_num_rows($checkMob)) {       
        $data['message'] = 'User Name Already Exist';
    }

echo json_encode($data);
