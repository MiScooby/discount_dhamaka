<?php include('../admin/ajax/config.php');
require_once('../vendor2/autoload.php');

if (isset($_POST['addVendorDeal']) == "addVendorDeal") {
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
    $nameKey  = '1234567890' . round(microtime(true));
$nameKeyTok = substr(str_shuffle($nameKey), 0, 5);
    $dealcode = 'DDOF'.$nameKeyTok;


    $dsmp = $DealStartDate . " " . $DealStartTime;
    $demp = $DealEndDate . " " . $DealEndTime;

    // vendor details:
    $getVdrDetails = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor` WHERE `id`='$VendorId'"));
    $vdrfirst_name = $getVdrDetails['f_name'];
    $vdrCode = $getVdrDetails['c_code'];
    $vdrMob = $getVdrDetails['cp_num'];
    $vdrMovile = $vdrCode . $vdrMob;

    if ($dsmp < $demp) {
        $checkDealQuery = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `offer_title`='$DealOffertitle'");
        $Dealcount = mysqli_num_rows($checkDealQuery);
        if ($Dealcount == 0) {
             
            $insertDealQuery = mysqli_query($con, "INSERT INTO `offer_deals`(`deal_code`,`vendor_id`, `offer_title`, `offer_desc`, `offer_img`, `offer_cat`, `offer_sub_cat`, `last_minute_deal`, `offer_start_date`, `offer_start_time`, `offer_end_date`, `offer_end_time`, `deal_times`, `deal_short_desc`, `deal_feature`, `ins_date`) VALUES ('$dealcode','$VendorId','$DealOffertitle','$DealDesc','$newpro_filename2','$DealCategory','$AddDealsubCat','$lastMintDeal','$DealStartDate','$DealStartTime','$DealEndDate','$DealEndTime','$dealItems','$deal_shortdesc','$dealFeauture','$Ins_d')");


            if ($lastMintDeal == "Yes") {
                $updLmD = mysqli_query($con, "UPDATE `vendor_last_minute_deal_plan` SET `plan_items`='$leftDealItems' WHERE `vendor_id`='$VendorId'");
                
                 $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                    'body' => '{"template_id":"649fe9bbd6fc053a1c707cd3","sender":"DISDMK","short_url":"0","mobiles":"' . $vdrMovile . '","var1":"' . $vdrfirst_name . '","var2":"' . $DealOffertitle . '","var3":"' . $dealcode . '","var4":"' . $leftDealItems . '"}',
                    'headers' => [
                        'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                    ],
                ]);
                 
                
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


                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                    'body' => '{"template_id":"64103829d6fc051baa326b43","sender":"DISDMK","short_url":"0","mobiles":"' . $vdrMovile . '","var1":"' . $vdrfirst_name . '","var2":"' . $DealOffertitle . '","var3":"' . $dealcode . '"}',
                    'headers' => [
                        'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                    ],
                ]);
                // echo $response->getBody();

                $data['message'] = 'Deal Offer submitted Successfully..';
                $data['status'] = true;
            }
        } else {
            $data['message'] = 'Deal Already Exist..';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Change End Time Please..';
        $data['status'] = false;
    }
    // die();



}


if (isset($_POST['type']) && ($_POST['type']) == "dltDeal") {

    $dealId = $_POST['dealId'];
     $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.cp_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealId'"));

    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['cp_num'];
    $number = $c_codeEditDeal . $mobile_numEditDeal;
    $f_nameEditDeal = $checkPublished['merchant_bus_name'];
    $DealOffertitle = $checkPublished['offer_title'];
    $deal_codeEditDeal = $checkPublished['deal_code'];

    $dltDealQuery = mysqli_query($con, "UPDATE `offer_deals` SET `is_deleted`='1', `status`='Delete' WHERE `id`='$dealId'");
    // $Dealcount = mysqli_num_rows($checkDealQuery);
    if ($dltDealQuery) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Deleted"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        $data['message'] = 'Deal Delete Successfully..';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Deal Delete..';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && ($_POST['type']) == "hideDeal") {
    $dealId = $_POST['dealId'];
    $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.cp_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealId'"));

    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['cp_num'];
    $number = $c_codeEditDeal . $mobile_numEditDeal;
    $f_nameEditDeal = $checkPublished['merchant_bus_name'];
    $DealOffertitle = $checkPublished['offer_title'];
    $deal_codeEditDeal = $checkPublished['deal_code'];

    $hideDealQuery = mysqli_query($con, "UPDATE `offer_deals` SET `status`='Hide' WHERE `id`='$dealId'");
    // $Dealcount = mysqli_num_rows($checkDealQuery);
    if ($hideDealQuery) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Paused"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        $data['message'] = 'Deal hide Successfully..';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Deal hide..';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && ($_POST['type']) == "showDeal") {
    $dealId = $_POST['dealId'];
    $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.mobile_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealId'"));

    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['mobile_num'];
    $number = $c_codeEditDeal . $mobile_numEditDeal;
    $f_nameEditDeal = $checkPublished['merchant_bus_name'];
    $DealOffertitle = $checkPublished['offer_title'];
    $deal_codeEditDeal = $checkPublished['deal_code'];

    $hideDealQuery = mysqli_query($con, "UPDATE `offer_deals` SET `status`='Active' WHERE `id`='$dealId'");
    // $Dealcount = mysqli_num_rows($checkDealQuery);
    if ($hideDealQuery) {

        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Live Again"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

        $data['message'] = 'Deal Active Successfully..';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Deal hide..';
        $data['status'] = false;
    }
}
echo json_encode($data);
