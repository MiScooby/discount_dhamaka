<?php include('config.php');

if (isset($_POST['type']) && $_POST['type'] == "comntSts") {

    $id = $_POST['id'];
    $geStatus = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `comments` WHERE `id`=' $id'"));
    if ($geStatus['status'] == 0) {
        $status = "1";
    } else {
        $status = "0";
    } 

    $changeSts = mysqli_query($con, "UPDATE `comments` SET `status`='$status' WHERE `id`='$id'");
    if($changeSts){
        $data['message'] = 'Comment Status Changed..';
        $data['status'] = true;
    }else{
        $data['message'] = 'Error in chnage comment status';
        $data['status'] = false;
    }    

}


if (isset($_POST['type']) && $_POST['type'] == "comntdlt") {

    $id = $_POST['id'];

    $changeSts = mysqli_query($con, "UPDATE `comments` SET `trash`='1' WHERE `id`='$id'");
    if($changeSts){
        $data['message'] = 'Comment Deleted..';
        $data['status'] = true;
    }else{
        $data['message'] = 'Error in comment Delete';
        $data['status'] = false;
    }    

}

echo json_encode($data);
