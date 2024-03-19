<?php
include('../admin/ajax/config.php');
if (isset($_POST['editVendorDeal']) == "editVendorDeal") {

    $deal_id = $_POST['dealId'];
    $VendorId = $_POST['VendorId'];
    $DealOffertitle = $_POST['DealOffertitle'];
    $DealDesc = $_POST['DealDesc'];
    $DealCategory = $_POST['DealCategory'];
    $AddDealsubCat = (empty($_POST['AddDealsubCat'])) ? 'n/a' :  $_POST['AddDealsubCat'];
    $DealStartDate = $_POST['DealStartDate'];
    $DealStartTime = $_POST['DealStartTime'];
    $DealEndDate = $_POST['DealEndDate'];
    $DealEndTime = $_POST['DealEndTime'];
    $dealItems =  (empty($_POST['dealItems'])) ? 'n/a' :  $_POST['dealItems'];
    $deal_shortdesc = (empty($_POST['deal_shortdesc'])) ? '' :  $_POST['deal_shortdesc'];
    $dealFeauture = (empty($_POST['dealFeauture'])) ? '' :  $_POST['dealFeauture'];
    $lastMintDeal = (empty($_POST['lastMintDeal'])) ? 'No' :  $_POST['lastMintDeal'];
    $newpro_filename2 = 'd' . round(microtime(true)) . '.jpg';


    if (!empty($_POST['lastMintDeal'])) {
        $LMDDataQ = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE `vendor_id`='$VendorId'");
        $LMDData = mysqli_fetch_array($LMDDataQ);
        $LmDItems = $LMDData['plan_items'];
        $leftDealItems = $LmDItems - 1;
    }
    $Ins_d = date('Y/m/d');

    $checkDealQuery = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `offer_title`='$DealOffertitle'");
    $Dealcount = mysqli_num_rows($checkDealQuery);
    if ($Dealcount > 0) {

        $updateDealQuery = '';
        $updateDealQuery .= "UPDATE `offer_deals` SET
        `vendor_id` = '$VendorId', 
        `offer_title`= '$DealOffertitle',
        `offer_desc`= '$DealDesc',
        `offer_cat`= '$DealCategory',
        `offer_sub_cat`= '$AddDealsubCat',
        `last_minute_deal`= '$lastMintDeal',
        `offer_start_date`= '$DealStartDate',
        `offer_start_time`='$DealStartTime' ,
        `offer_end_date`= '$DealEndDate',
        `offer_end_time`= '$DealEndTime', 
        `deal_times`= '$dealItems',
        `deal_short_desc`= '$deal_shortdesc',
        `deal_feature`= '$dealFeauture',
        `published`='0',
        `edited`='1',
        `is_deleted`='0',
        `status`='Schedule',
        `ins_date`= '$Ins_d'";


        if (!empty($_FILES['dealOfferImg'])) {
            $updateDealQuery .=  ",`offer_img`= '$newpro_filename2'";
            $mul_img = $_FILES["dealOfferImg"]["tmp_name"];
            $dealOfferImg = $_FILES['dealOfferImg'];
        }
        $updateDealQuery .=  "WHERE id = $deal_id";
      
        $updateDealQueryR = mysqli_query($con, $updateDealQuery);

        if (!empty($_FILES['dealImg'])) {
            $dealImg = $_FILES['dealImg'];
        }

        if ($lastMintDeal == "Yes") {
            $updLmD = mysqli_query($con, "UPDATE `vendor_last_minute_deal_plan` SET `plan_items`='$leftDealItems' WHERE `vendor_id`='$VendorId'");
        }
        if ($updateDealQueryR) {
            // $dealid = mysqli_insert_id($con);
            $dealid = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM `offer_deals` ORDER BY `id` DESC LIMIT 0,1"))['id'];
            if (!empty($_FILES['dealOfferImg'])) {
                move_uploaded_file($mul_img, "upload/deals-img/" . $newpro_filename2);
            }

            if (!empty($dealImg['name'])) {
                $str = ' INSERT INTO `deals_img`( `deal_id`, `deal_img`) VALUES ';
                foreach ($dealImg['name'] as $key => $val) {
                    $newpro_filename = 'dd' . $key . round(microtime(true)) . '.jpg';
                    $mul_img2 = $dealImg["tmp_name"][$key];

                    move_uploaded_file($mul_img2, "upload/deals-img/" . $newpro_filename);
                    // die();
                    $str .= "('" . $dealid . "','" . $newpro_filename . "'),";
                }
                $str = trim($str, ',');
                mysqli_query($con, $str);
                // header('Location: vendor-profile.php');
            }
            $data['message'] = 'Deal Offer Updated Successfully..';
            $data['status'] = true;
        }
    } else {
        $data['message'] = 'Deal Does not  Exist..';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) == "copyVendorDeal") {

    // print_r($_POST);
    // die();
    
    $deal_id = $_POST['dealId'];
    $VendorId = $_POST['VendorId'];
    $DealOffertitle = $_POST['DealOffertitle'];
    $DealDesc = $_POST['DealDesc'];
    $DealCategory = $_POST['DealCategory'];
    $AddDealsubCat = (empty($_POST['AddDealsubCat'])) ? 'n/a' :  $_POST['AddDealsubCat'];
    $DealStartDate = $_POST['DealStartDate'];
    $DealStartTime = $_POST['DealStartTime'];
    $DealEndDate = $_POST['DealEndDate'];
    $DealEndTime = $_POST['DealEndTime'];
    $dealItems =  (empty($_POST['dealItems'])) ? '' :  $_POST['dealItems'];
    $deal_shortdesc = (empty($_POST['deal_shortdesc'])) ? '' :  $_POST['deal_shortdesc'];
    $dealFeauture = (empty($_POST['dealFeauture'])) ? '' :  $_POST['dealFeauture'];
    $lastMintDeal = (empty($_POST['lastMintDeal'])) ? 'No' :  $_POST['lastMintDeal'];
    $dealOfferImgCopy = $_POST['dealOfferImgCopy'];
    $dealOfferImg = $_FILES['dealOfferImg'];
    $dealImg = $_FILES['dealImg'];
    if (!empty($_POST['lastMintDeal'])) {
        $LMDDataQ = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE `vendor_id`='$VendorId'");
        $LMDData = mysqli_fetch_array($LMDDataQ);
        $LmDItems = $LMDData['plan_items'];
        $leftDealItems = $LmDItems - 1;
    }
    $Ins_d = date('Y/m/d');
    $mul_img = $_FILES["dealOfferImg"]["tmp_name"];
    $newpro_filename2 = 'd' . round(microtime(true)) . '.jpg';
    $dealcode = 'DD' . $VendorId.round(microtime(true));
    $updateDealQueryCopy = mysqli_query($con, "UPDATE `offer_deals` SET `is_deleted`='1',`status`='Delete' WHERE `id`=' $deal_id'");

    if($updateDealQueryCopy){
        $checkDealQuery = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `offer_title`='$DealOffertitle' AND `is_deleted`='0' AND `status`='Active' ");
        $Dealcount = mysqli_num_rows($checkDealQuery);
        if ($Dealcount == 0) {

            if(empty($dealOfferImg['name'])){
                $insertDealQuery = mysqli_query($con, "INSERT INTO `offer_deals`(`deal_code`,`vendor_id`, `offer_title`, `offer_desc`, `offer_img`, `offer_cat`, `offer_sub_cat`, `last_minute_deal`, `offer_start_date`, `offer_start_time`, `offer_end_date`, `offer_end_time`, `deal_times`, `deal_short_desc`, `deal_feature`, `ins_date`) VALUES ('$dealcode','$VendorId','$DealOffertitle','$DealDesc','$dealOfferImgCopy','$DealCategory','$AddDealsubCat','$lastMintDeal','$DealStartDate','$DealStartTime','$DealEndDate','$DealEndTime','$dealItems','$deal_shortdesc','$dealFeauture','$Ins_d')");
            }else{
                $insertDealQuery = mysqli_query($con, "INSERT INTO `offer_deals`(`deal_code`,`vendor_id`, `offer_title`, `offer_desc`, `offer_img`, `offer_cat`, `offer_sub_cat`, `last_minute_deal`, `offer_start_date`, `offer_start_time`, `offer_end_date`, `offer_end_time`, `deal_times`, `deal_short_desc`, `deal_feature`, `ins_date`) VALUES ('$dealcode','$VendorId','$DealOffertitle','$DealDesc','$newpro_filename2','$DealCategory','$AddDealsubCat','$lastMintDeal','$DealStartDate','$DealStartTime','$DealEndDate','$DealEndTime','$dealItems','$deal_shortdesc','$dealFeauture','$Ins_d')");
            }
    
            if ($lastMintDeal == "Yes") {
                $updLmD = mysqli_query($con, "UPDATE `vendor_last_minute_deal_plan` SET `plan_items`='$leftDealItems' WHERE `vendor_id`='$VendorId'");
            }
            if ($insertDealQuery) {
                // $dealid = mysqli_insert_id($con);
                $dealid = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM `offer_deals` ORDER BY `id` DESC LIMIT 0,1"))['id'];
                move_uploaded_file($mul_img, "../upload/deals-img/" . $newpro_filename2);
                if (!empty($dealImg['name'])) {
                    $str = ' INSERT INTO `deals_img`( `deal_id`, `deal_img`) VALUES ';
                    foreach ($dealImg['name'] as $key => $val) {
                        $newpro_filename = 'dd' . $key . round(microtime(true)) . '.jpg';
                        $mul_img2 = $dealImg["tmp_name"][$key];
    
                        move_uploaded_file($mul_img2, "../upload/deals-img/" . $newpro_filename);
                        // die();
                        $str .= "('" . $dealid . "','" . $newpro_filename . "'),";
                    }
                    $str = trim($str, ',');
                    mysqli_query($con, $str);
                }
    
                $data['message'] = 'Deal Offer Copied Successfully..';
                $data['status'] = true;
            }
        } else {
            $data['message'] = 'Deal Already Exist..';
            $data['status'] = false;
        }
    }else{
        $data['message'] = 'Error Occur..';
        $data['status'] = false;
    }

    
}
echo json_encode($data);
