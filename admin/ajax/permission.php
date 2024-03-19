<?php include('config.php');


if (isset($_POST['AddPermission'])) {

    $permission = implode(',', $_POST['permission']);
    $roleId = $_POST['roleId'];
    $checkROleCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `ec_set_permission` WHERE `role_id`='$roleId' "));
    if ($checkROleCount == 0) {

        $addPermQ = mysqli_query($con, "INSERT INTO `ec_set_permission`(`role_id`, `function_id`) VALUES ('$roleId', '$permission')");

        if ($addPermQ) {
            $data['message'] = 'Permission Updated Successfully';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error Occur in permisssion process';
            $data['status'] = false;
        }
    } else {
        $updatePer = mysqli_query($con, "UPDATE `ec_set_permission` SET `function_id` = '$permission' WHERE `role_id` = '$roleId';");
        if ($updatePer) {
            $data['message'] = 'Permission Updated Successfully';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error Occur in permisssion process';
            $data['status'] = false;
        }
    }
}

echo json_encode($data);
