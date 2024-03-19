<?php include('../admin/ajax/config.php');

$CntcName = $_POST['CntcName'];
$CntcEmail = $_POST['CntcEmail']; 
$CntcPhn = $_POST['CntcPhn']; 
$CntcQuery = $_POST['CntcQuery'];

$addQuey = mysqli_query($con, "INSERT INTO `contact_query`(`name`, `email`, `phone`, `query`) VALUES ('$CntcName','$CntcEmail','$CntcPhn','$CntcQuery')");
if($addQuey){
    $data['message'] = 'Query Submitted successfully !';
    $data['status'] = true;
}else{
    $data['message'] = 'Error Occur in contact form !';
    $data['status'] = false;
}
 
echo json_encode($data);
