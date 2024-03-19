<?php include('config.php');


$dealimg_Id = $_POST['dealimgid'];

$dealimgsql = mysqli_query($con,"DELETE FROM `deals_img` WHERE `id`='$dealimg_Id'");

if($dealimgsql){
    echo 1;
}
else{
    echo 0;
}
    
    
?>