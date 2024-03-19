<?php include('config.php');

if (isset($_POST['type']) && $_POST['type'] == "memPlan") {

 

    $cat_id = $_POST['cat_id'];
    $CatPlanName = $_POST['CatPlanName'];
    $PlanGrade = $_POST['PlanGrade'];
    $ins_date = date('Y/m/d');


    $AddMemPlan = "INSERT INTO `membership_plan`(`cat_id`,`cat_name`, `plan_grade`, `plan_type`, `plan_name`, `plan_days`, `plan_amnt`, `ins_date`) VALUES ";

    foreach ($_POST['Etype'] as $key => $value) {
        // echo $_POST['eAmnt'][$key];        
        $AddMemPlan .= "('$cat_id','$CatPlanName','$PlanGrade','$_POST[Economy]','" . $_POST['Etype'][$key] . "','" . $_POST['eDays'][$key] . "','" . $_POST['eAmnt'][$key] . "','$ins_date'),";
    }
    // echo $AddMemPlan;
    foreach ($_POST['pType'] as $key => $value) {
        $AddMemPlan .= "('$cat_id','$CatPlanName','$PlanGrade','$_POST[Premium]','" . $_POST['pType'][$key] . "','" . $_POST['pDays'][$key] . "','" . $_POST['pAmnt'][$key] . "','$ins_date'),";
    }
    foreach ($_POST['lType'] as $key => $value) {
        $AddMemPlan .= "('$cat_id','$CatPlanName','$PlanGrade','$_POST[Luxury]','" . $_POST['lType'][$key] . "','" . $_POST['lDays'][$key] . "','" . $_POST['lAmnt'][$key] . "','$ins_date'),";
    }
    // echo $AddMemPlan;
    $AddMemPlan = trim($AddMemPlan, ',');
    $AddMemPlanQ = mysqli_query($con, "$AddMemPlan");
    if ($AddMemPlanQ) {
        $data['message'] = 'Membership Plan Added ';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Membership Plan Add';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "lmdPlan") {


    $cat_id = $_POST['cat_id'];
    $CatPlanName = $_POST['CatPlanName'];
    $PlanGrade = $_POST['PlanGrade'];
    $ins_date = date('Y/m/d');


    $AddMemPlan = "INSERT INTO `last_minute_deals_plan`(`cat_id`,`cat_name`, `plan_grade`, `plan_type`, `plan_name`, `plan_deal_items`, `plan_amnt`, `ins_date`) VALUES ";

    foreach ($_POST['Etype'] as $key => $value) {
        // echo $_POST['eAmnt'][$key];        
        $AddMemPlan .= "('$cat_id','$CatPlanName','$PlanGrade','$_POST[Economy]','" . $_POST['Etype'][$key] . "','" . $_POST['eItems'][$key] . "','" . $_POST['eAmnt'][$key] . "','$ins_date'),";
    }
    // echo $AddMemPlan;
    foreach ($_POST['pType'] as $key => $value) {
        $AddMemPlan .= "('$cat_id','$CatPlanName','$PlanGrade','$_POST[Premium]','" . $_POST['pType'][$key] . "','" . $_POST['pItems'][$key] . "','" . $_POST['pAmnt'][$key] . "','$ins_date'),";
    }
    foreach ($_POST['lType'] as $key => $value) {
        $AddMemPlan .= "('$cat_id','$CatPlanName','$PlanGrade','$_POST[Luxury]','" . $_POST['lType'][$key] . "','" . $_POST['lItems'][$key] . "','" . $_POST['lAmnt'][$key] . "','$ins_date'),";
    }
    // echo $AddMemPlan;
    $AddMemPlan = trim($AddMemPlan, ',');
    $AddMemPlanQ = mysqli_query($con, "$AddMemPlan");
    if ($AddMemPlanQ) {
        $data['message'] = 'Membership Plan Added ';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Membership Plan Add';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "EditmemPlan") {

  $planId = $_POST['planId'];
  $memPlanDays = $_POST['memPlanDays'];
  $memPlanAmnt = $_POST['memPlanAmnt'];


    $editPlanQ = "UPDATE `membership_plan` SET `plan_days`='$memPlanDays',`plan_amnt`='$memPlanAmnt' WHERE `id`='$planId'";
    $editPlan = mysqli_query($con, "$editPlanQ");
    if ($editPlan) {
        $data['message'] = 'Membership Plan Updated ';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Membership Plan Edit';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "EditlmdPlan") {

    $planId = $_POST['planId'];
    $lmdPlanitems = $_POST['lmdPlanitems'];
    $lmdPlanAmnt = $_POST['lmdPlanAmnt'];
  
  
      $editPlanQ = "UPDATE `last_minute_deals_plan` SET `plan_deal_items`='$lmdPlanitems',`plan_amnt`='$lmdPlanAmnt' WHERE `id`='$planId'";
      $editPlan = mysqli_query($con, "$editPlanQ");
      if ($editPlan) {
          $data['message'] = 'Membership Plan Updated ';
          $data['status'] = true;
      } else {
          $data['message'] = 'Error in Membership Plan Edit';
          $data['status'] = false;
      }
  }

echo json_encode($data);
