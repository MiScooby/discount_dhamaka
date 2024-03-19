<?php 
 include('../admin/ajax/config.php');
if (isset($_POST['type']) && ($_POST['type']) == "addComment") {

    $comment = $_POST['comment'];
    $star = $_POST['star'];
    $username = $_POST['venId'];
    $dealId = $_POST['dealId'];
    $Ins_d = date('Y/m/d');
    $Ins_time = time();
    $getUserDet = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name` = '$username'");
    // die("SELECT * FROM `USER` WHERE `user_name` = '$username'");
    $userIdQ = mysqli_fetch_array($getUserDet);
    $userId = $userIdQ['id'];
    $commentCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `comments` WHERE `user_id` = '$userId' AND `deal_id`='$dealId'"));

    if(!$commentCount){
        $insertComment = mysqli_query($con, "INSERT INTO `comments` (`deal_id`, `user_id`, `comments`, `rating`, `trash`, `ins_date`, `ins_time`) VALUES ( '$dealId', '$userId ', '$comment', '$star', '0', '$Ins_d', '$Ins_time')");

        if ($insertComment) {
            $data['message'] = 'Comment added successfully..';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error in adding comment..';
            $data['status'] = false;
        }
    }
    else{
        $data['message'] = 'You have already added a comment..';
        $data['status'] = false;
    }
}
echo json_encode($data);
?>