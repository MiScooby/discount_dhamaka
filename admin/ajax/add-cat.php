<?php include('config.php');


if (isset($_POST['addCat']) == "addCat") {
    $catName = $_POST['catName'];
    $parentCat = $_POST['parentCat'];
    $catImage = $_FILES['catImage'];

    $mul_img = $_FILES["catImage"]["tmp_name"];
    // print_r($_FILES["catImage"]);
    // exit();

    //   $temp = explode(".", $value);
    $newpro_filename = round(microtime(true)) . '.jpg';

    if ($parentCat == "0") {
        $checkCatQuery = mysqli_query($con, "SELECT * FROM `category` WHERE `cat_name`='$catName'");
        $Catcount = mysqli_num_rows($checkCatQuery);
        if ($Catcount == 0) {
            $insertCatQuery = mysqli_query($con, "INSERT INTO `category`(`cat_name`, `cat_img`) VALUES ('$catName','$newpro_filename')");
            if ($insertCatQuery) {

                move_uploaded_file($mul_img, "../../upload/cat-img/" . $newpro_filename);
                $data['message'] = 'Category Inserted Successfully..';
            }
        } else {
            // echo json_encode(array('status' => false, 'message' => 'Data Already Exist !'));
            $data['message'] = 'Category Already Exist..';
        }
    } else {
        $checkSubCatQuery = mysqli_query($con, "SELECT * FROM `sub_category` WHERE `sub_cat_name`='$catName' AND `parent_cat`='$parentCat'");
        $SubCatcount = mysqli_num_rows($checkSubCatQuery);
        if ($SubCatcount == 0) {
            $insertSubCatQuery = mysqli_query($con, "INSERT INTO `sub_category`(`sub_cat_name`,`parent_cat`, `sub_cat_img`) VALUES ('$catName','$parentCat','$newpro_filename')");
            if ($insertSubCatQuery) {

                move_uploaded_file($mul_img, "../../upload/cat-img/" . $newpro_filename);
                $data['message'] = 'Sub Category Inserted Successfully..';
            }
        } else {
            // echo json_encode(array('status' => false, 'message' => 'Data Already Exist !'));
            $data['message'] = 'Sub Category Already Exist..';
        }
    }
}  

if (isset($_POST['editCat']) == "editCat") {
    // print_r($_POST);
    // die();
    
    $EditcatName = $_POST['EditcatName'];
    $EditparentCat = $_POST['parentCat'];
    $EditcatImage = $_FILES['EditcatImage'];
    $cat_id = $_POST['cat_id'];
     if (!empty($_FILES['EditcatImage']['name'])) {
$mul_img = $_FILES["EditcatImage"]["tmp_name"];
            $newpro_filename = round(microtime(true)) . '.jpg';
     }

    if ($EditparentCat == "0") {
        $EdittCatQuery = '';
        $EdittCatQuery .= "UPDATE `category` SET `cat_name`='$EditcatName'";
        
        if (!empty($_FILES['EditcatImage']['name'])) {       
            $EdittCatQuery .= ", `cat_img`='$newpro_filename' ";
        }
        
        $EdittCatQuery .= "WHERE `id`='$cat_id'";
        
        // echo $EdittCatQuery;
        // die;
         
        $EdittCatQueryr  = mysqli_query($con, $EdittCatQuery);
        
        if ($EdittCatQueryr) {
            
             if (!empty($_FILES['EditcatImage']['name'])) {       
            move_uploaded_file($mul_img, "../../upload/cat-img/" . $newpro_filename);
        }
        
           
            $data['message'] = 'Category Updated Successfully..';
            $data['location'] = "view-category.php";
        }
    } else{
   
         $EdittCatQuery = '';
         $EdittCatQuery .= "UPDATE `sub_category` SET `sub_cat_name`='$EditcatName',`parent_cat`='$EditparentCat'";
        
        if (!empty($_FILES['EditcatImage']['name'])) {       
            $EdittCatQuery .= ", `sub_cat_img`='$newpro_filename' ";
        }
        $EdittCatQuery .= "WHERE `id`='$cat_id'";
        $EdittCatQueryr  = mysqli_query($con, $EdittCatQuery);
        if ($EdittCatQueryr) {
            
             if (!empty($_FILES['EditcatImage']['name'])) {       
            move_uploaded_file($mul_img, "../../upload/cat-img/" . $newpro_filename);
        }
        
           
            $data['message'] = 'Category Updated Successfully..';
            $data['location'] = "view-category.php";
        }
        
        
    }
}

if (isset($_POST['type']) == "DltSubcat") {
    
    $id = $_POST['id'];
    $dltscQuery = mysqli_query($con, "UPDATE `sub_category` SET  `trash`='1'  WHERE `id`='$id';");
    if($dltscQuery){
        $data['status'] = true;
        $data['message']    = 'Sub Category trashed successfully';
    }
    else{
        $data['status'] = false;
        $data['message']    = 'Could not trash Sub Category';
    }
}

if (isset($_POST['action']) == "trashLMP"){
    $id  = $_POST['id'];

    $trashQ = mysqli_query($con, "UPDATE `last_minute_deals_plan` SET `trash` = '1' WHERE id = '$id'");

    if($trashQ){
        $data['status'] = true;
        $data['message']    = 'Plan trashed successfully';
    }
    else{
        $data['status'] = false;
        $data['message']    = 'Could not trash plan';
    }
}
if (isset($_POST['action']) == "trashC"){
    $id  = $_POST['id'];

    $trashQ = mysqli_query($con, "UPDATE `membership_plan` SET `trash` = '1' WHERE id = '$id'");

    if($trashQ){
        $data['status'] = true;
        $data['message']    = 'Plan trashed successfully';
    }
    else{
        $data['status'] = false;
        $data['message']    = 'Could not trash plan';
    }
}

echo json_encode($data);
