<?php include('config.php');

if (isset($_POST['type']) && $_POST['type'] == "locality") {
    $vAdd1 = $_POST['vAdd1'];
    $locality = $_POST['locality'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $ZipCode = $_POST['ZipCode'];

    $checkQuery = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `locality` WHERE `locality_name`='$vAdd1' "));
    if ($checkQuery) {
        $data['message'] = 'Locality Name Already Exist';
        $data['status'] = false;
    } else {
        $addQuery = mysqli_query($con, "INSERT INTO `locality`(`locality_name`, `locality`, `city`, `state`, `pin_code`) VALUES ('$vAdd1','$locality','$City','$State','$ZipCode')");

        if ($addQuery) {
            $data['message'] = 'Locality Uploaded By Admin';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error occur in add loclity';
            $data['status'] = false;
        }
    }
}

if (isset($_POST['type']) && $_POST['type'] == "statusChnage") {

    $loCId = $_POST['loCId'];
    $loc_sts = $_POST['loc_sts'];

    $chngStatus = mysqli_query($con, "UPDATE `locality` SET `status`='$loc_sts' WHERE `id`='$loCId'");

    if ($chngStatus) {
        $data['message'] = 'Status Updated';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Status Update';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "Editlocality") {
    $vAdd1 = $_POST['vAdd1'];
    $locality = $_POST['locality'];
    $City = $_POST['City'];
    $State = $_POST['State'];
    $ZipCode = $_POST['ZipCode'];
    $locId = $_POST['locId'];
 
        $addQuery = mysqli_query($con, " UPDATE `locality` SET  `locality_name`='$vAdd1',`locality`='$locality',`city`='$City',`state`='$State',`pin_code`='$ZipCode'  WHERE `id`='$locId' ");

        if ($addQuery) {
            $data['message'] = 'Locality Updated By Admin';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error occur in update loclity';
            $data['status'] = false;
        }
  
}

echo json_encode($data);
