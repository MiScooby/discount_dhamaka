<?php include('config.php');


if (isset($_POST['AddRoles'])) {
    $RoleName = $_POST['RoleName'];
    $RoleSts = $_POST['RoleSts'];

    $getNameCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `ec_roles_type` WHERE `title`='$RoleName' "));
    if ($getNameCount == 0) {


        $addroleQ = mysqli_query($con, "INSERT INTO `ec_roles_type`(`title`, `status`) VALUES ('$RoleName', '$RoleSts')");

        if ($addroleQ) {
            $data['message'] = 'Role Added Successfully';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error Occur in role adding process';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Role Alredy Exist !';
        $data['status'] = false;
    }
}


if (isset($_POST['EditRoles'])) {
    $RoleName = $_POST['RoleName'];
    $RoleSts = $_POST['RoleSts'];
    $RoleId = $_POST['RoleId'];
    $editroleQ = mysqli_query($con, "UPDATE `ec_roles_type` SET `title`='$RoleName',`status`='$RoleSts' WHERE `id`='$RoleId' ");

    if ($editroleQ) {
        $data['message'] = 'Role Updated Successfully';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Occur in role update process';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "RolestatusChnage") {

    $roleid = $_POST['roleid'];
    $sts = $_POST['sts'];

    $changerolests = mysqli_query($con, "UPDATE `ec_roles_type` SET `status`='$sts' WHERE `id`='$roleid' ");

    if ($changerolests) {
        $data['message'] = 'Status Changed Successfully';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Occur in status process';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "RoleDlt") {

    $roleid = $_POST['roleid'];

    $changerolests = mysqli_query($con, "DELETE FROM `ec_roles_type` WHERE `id`='$roleid' ");

    if ($changerolests) {
        $data['message'] = 'Role Delete Successfully';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Occur in delete process';
        $data['status'] = false;
    }
}
echo json_encode($data);
