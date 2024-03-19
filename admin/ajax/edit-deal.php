<?php include('config.php');
require_once('../../vendor2/autoload.php');

if (isset($_POST['editofferDeal']) == "editofferDeal") {

    $dealofrId = $_POST['dealofrId'];
    $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.mobile_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealofrId'"));

    $dealpub = $checkPublished['published'];
    $deal_codeEditDeal = $checkPublished['deal_code'];
    $f_nameEditDeal = $checkPublished['merchant_bus_name'];
    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['mobile_num'];
    $statsEditDeal = $checkPublished['status'];


    $DealOffertitle = mysqli_escape_string($con, $_POST['DealOffertitle']);
    $DealDesc = $_POST['DealDesc'];
    $DealCategory = $_POST['DealCategory'];
    $AddDealsubCat = $_POST['AddDealsubCat'];
    $DealStartDate = $_POST['DealStartDate'];
    $DealStartTime = $_POST['DealStartTime'];
    $DealEndDate = $_POST['DealEndDate'];
    $DealEndTime = $_POST['DealEndTime'];
    $dealItems = (empty($_POST['dealItems'])) ? 'n/a' :  $_POST['dealItems'];;
    $deal_shortdesc = (empty($_POST['deal_shortdesc'])) ? 'n/a' :  $_POST['deal_shortdesc'];
    $dealFeauture = (empty($_POST['dealFeauture'])) ? 'n/a' :  $_POST['dealFeauture'];
    $lastMintDeal = $_POST['lastMintDeal'];

    $dealOfferImg = $_FILES['dealOfferImg'];
    $dealImg = $_FILES['dealImg'];

    $OfferInslider = $_POST['OfferInslider'];
    $AllowComment = $_POST['AllowComment'];
    $OfferClick = $_POST['OfferClick'];
    $OfferView = $_POST['OfferView'];
    $ratingPoint = $_POST['ratingPoint'];
    $dofday = $_POST['dofday'];

    $mul_img = $_FILES["dealOfferImg"]["tmp_name"];
    $newpro_filename2 = 'd' . round(microtime(true)) . '.jpg';
    move_uploaded_file($mul_img, "../../upload/deals-img/" . $newpro_filename2);
    $number = $c_codeEditDeal . $mobile_numEditDeal;

    // echo $dealImg['name'][0];

    // echo '"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Edited"';
    // die;
    if ($mul_img != '') {
        $dealofrupdate_sql = mysqli_query($con, "UPDATE `offer_deals` SET `offer_title`='$DealOffertitle',`offer_desc`='$DealDesc',`offer_img`='$newpro_filename2',`offer_cat`='$DealCategory',`offer_sub_cat`='$AddDealsubCat',`last_minute_deal`='$lastMintDeal',`offer_start_date`='$DealStartDate',`offer_start_time`='$DealStartTime',`offer_end_date`='$DealEndDate',`offer_end_time`='$DealEndTime',`deal_times`='$dealItems',`deal_short_desc`='$deal_shortdesc',`deal_feature`='$dealFeauture',`is_slider`='$OfferInslider',`allow_cmnt`='$AllowComment',`fake_click`='$OfferClick',`fake_view`='$OfferView',`deal_of_the_day`='$dofday' WHERE `id`='$dealofrId'");



        if ($dealofrupdate_sql) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Edited"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            $data['message'] = 'Offer Deal Updated Successfully..';

            $data['status'] = true;
        } else {
            $data['message'] = 'Offer Deal Not Updated...';

            $data['status'] = false;
        }
    } elseif ($dealImg['name'][0] != '') {

        mysqli_query($con, "DELETE FROM `deals_img` WHERE `deal_id`='$dealofrId'");

        $str = ' INSERT INTO `deals_img`( `deal_id`, `deal_img`) VALUES ';
        foreach ($dealImg['name'] as $key => $val) {
            $newpro_filename = 'dd' . $key . round(microtime(true)) . '.jpg';
            $mul_img2 = $dealImg["tmp_name"][$key];

            move_uploaded_file($mul_img2, "../../upload/deals-img/" . $newpro_filename);
            // die();
            $str .= "('" . $dealofrId . "','" . $newpro_filename . "'),";
        }
        $str = trim($str, ',');
        mysqli_query($con, $str);

        $dealofrupdate_sql = mysqli_query($con, "UPDATE `offer_deals` SET `offer_title`='$DealOffertitle',`offer_desc`='$DealDesc',`offer_cat`='$DealCategory',`offer_sub_cat`='$AddDealsubCat',`last_minute_deal`='$lastMintDeal',`offer_start_date`='$DealStartDate',`offer_start_time`='$DealStartTime',`offer_end_date`='$DealEndDate',`offer_end_time`='$DealEndTime',`deal_times`='$dealItems',`deal_short_desc`='$deal_shortdesc',`deal_feature`='$dealFeauture',`is_slider`='$OfferInslider',`allow_cmnt`='$AllowComment',`fake_click`='$OfferClick',`fake_view`='$OfferView',`rating_points`='$ratingPoint',`deal_of_the_day`='$dofday' WHERE `id`='$dealofrId'");

        if ($dealofrupdate_sql) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Edited"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            $data['message'] = 'Offer Deal Updated Successfully..';

            $data['status'] = true;
        } else {
            $data['message'] = 'Offer Deal Not Updated...';

            $data['status'] = false;
        }
    } elseif ($dealImg['name'][0] != '' && $mul_img != '') {

        mysqli_query($con, "DELETE FROM `deals_img` WHERE `deal_id`='$dealofrId'");

        $str = ' INSERT INTO `deals_img`(`deal_id`, `deal_img`) VALUES ';
        foreach ($dealImg['name'] as $key => $val) {
            $newpro_filename = 'dd' . $key . round(microtime(true)) . '.jpg';
            $mul_img2 = $dealImg["tmp_name"][$key];

            move_uploaded_file($mul_img2, "../../upload/deals-img/" . $newpro_filename);
            // die();
            $str .= "('" . $dealofrId . "','" . $newpro_filename . "'),";
        }
        $str = trim($str, ',');
        mysqli_query($con, $str);

        $dealofrupdate_sql = mysqli_query($con, "UPDATE `offer_deals` SET `offer_title`='$DealOffertitle',`offer_desc`='$DealDesc',`offer_img`='$newpro_filename2',`offer_cat`='$DealCategory',`offer_sub_cat`='$AddDealsubCat',`last_minute_deal`='$lastMintDeal',`offer_start_date`='$DealStartDate',`offer_start_time`='$DealStartTime',`offer_end_date`='$DealEndDate',`offer_end_time`='$DealEndTime',`deal_times`='$dealItems',`deal_short_desc`='$deal_shortdesc',`deal_feature`='$dealFeauture',`is_slider`='$OfferInslider',`allow_cmnt`='$AllowComment',`fake_click`='$OfferClick',`fake_view`='$OfferView',`rating_points`='$ratingPoint',`deal_of_the_day`='$dofday' WHERE `id`='$dealofrId'");

        if ($dealofrupdate_sql) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Edited"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            $data['message'] = 'Offer Deal Updated Successfully..';
            $data['status'] = true;
        } else {
            $data['message'] = 'Offer Deal Not Updated...';
            $data['status'] = false;
        }
    } else {
        $dealofrupdate_sql = mysqli_query($con, "UPDATE `offer_deals` SET `offer_title`='$DealOffertitle',`offer_desc`='$DealDesc',`offer_cat`='$DealCategory',`offer_sub_cat`='$AddDealsubCat',`last_minute_deal`='$lastMintDeal',`offer_start_date`='$DealStartDate',`offer_start_time`='$DealStartTime',`offer_end_date`='$DealEndDate',`offer_end_time`='$DealEndTime',`deal_times`='$dealItems',`deal_short_desc`='$deal_shortdesc',`deal_feature`='$dealFeauture',`is_slider`='$OfferInslider',`allow_cmnt`='$AllowComment',`fake_click`='$OfferClick',`fake_view`='$OfferView',`rating_points`='$ratingPoint',`deal_of_the_day`='$dofday', `edited`='0' WHERE `id`='$dealofrId'");

        if ($dealofrupdate_sql) {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"Edited"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            $data['message'] = 'Offer Deal Updated Successfully..';

            $data['status'] = true;
        } else {
            $data['message'] = 'Offer Deal Not Updated...';

            $data['status'] = false;
        }
    }
}

if (isset($_POST['type']) && ($_POST['type']) == "dltDeal") {

    $dealId = $_POST['dealId'];
    $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.mobile_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealId'"));

    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['mobile_num'];
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


if (isset($_POST['type']) && ($_POST['type']) == "ApprvDeal") {

    $dealId = $_POST['dealId'];
    $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.mobile_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealId'"));

    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['mobile_num'];
    $number = $c_codeEditDeal . $mobile_numEditDeal;
    $f_nameEditDeal = $checkPublished['merchant_bus_name'];
    $DealOffertitle = $checkPublished['offer_title'];
    $deal_codeEditDeal = $checkPublished['deal_code'];

    $AppDealQuery = mysqli_query($con, "UPDATE `offer_deals` SET `status`='Active', `edited`='0' WHERE `id`='$dealId'");
    if ($AppDealQuery) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"6492b74cd6fc05677a09c1e3","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        $data['message'] = 'Deal Approved Successfully..';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Deal Approved..';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && ($_POST['type']) == "RejectDeal") {

    $dealId = $_POST['dealId'];
    $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.mobile_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealId'"));

    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['mobile_num'];
    $number = $c_codeEditDeal . $mobile_numEditDeal;
    $f_nameEditDeal = $checkPublished['merchant_bus_name'];
    $DealOffertitle = $checkPublished['offer_title'];
    $deal_codeEditDeal = $checkPublished['deal_code'];

    $AppDealQuery = mysqli_query($con, "UPDATE `offer_deals` SET `status`='Rejected', `edited`='0' WHERE `id`='$dealId'");
    if ($AppDealQuery) {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"649e92f5d6fc050caf353953","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $DealOffertitle . '", "var2":"' . $deal_codeEditDeal . '", "var3":"Rejected"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        $data['message'] = 'Deal Rejected Successfully..';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Deal Rejection..';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && ($_POST['type']) == "DealSts") {

    $dealId = $_POST['dealId'];
    $sts = $_POST['sts'];
    $checkPublished = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.published, od.offer_title, v.f_name, v.c_code, v.mobile_num, v.merchant_bus_name , od.status FROM offer_deals od, vendor v WHERE od.vendor_id=v.id  AND  od.id='$dealId'"));

    $c_codeEditDeal = $checkPublished['c_code'];
    $mobile_numEditDeal = $checkPublished['mobile_num'];
    $number = $c_codeEditDeal . $mobile_numEditDeal;
    $f_nameEditDeal = $checkPublished['merchant_bus_name'];
    $DealOffertitle = $checkPublished['offer_title'];
    $deal_codeEditDeal = $checkPublished['deal_code'];

    $AppDealQuery = mysqli_query($con, "UPDATE `offer_deals` SET `status`='$sts' WHERE `id`='$dealId'");
    if ($AppDealQuery) {
         
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"6492b6f5d6fc0524d42fa7e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_nameEditDeal . '", "var2":"' . $DealOffertitle . '", "var3":"' . $deal_codeEditDeal . '", "var4":"'.$sts.'"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
        $data['message'] = 'Deal Status Changed Successfully..';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Deal Status Changed..';
        $data['status'] = false;
    }
}

echo json_encode($data);
