<?php include('../admin/ajax/config.php');
include('../sendmail.php');
require_once('../vendor2/autoload.php');

$plantok = '1234567890';
$plantoktoken = substr(str_shuffle($plantok), 0, 6);


if (isset($_POST['type']) && $_POST['type'] == "AddMeMOrder") {
    $LoginVendorId = $_POST['LoginVendorId'];
    $planId = $_POST['planId'];
    $planAmnt = $_POST['planAmnt'];
    $PaybleAmnt = $_POST['PaybleAmnt'];
    $planDays = $_POST['planDays'];
    $dataCoupon = $_POST['dataCoupon'];
    $couponCode = $_POST['couponCode'];

    $getvenidQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$LoginVendorId'");
    $getvenid = mysqli_fetch_array($getvenidQ);
    $vendorId = $getvenid['id'];
    $vendorName = $getvenid['f_name'] . " " . $getvenid['l_name'];
    $vendorEmailId = $getvenid['email_id'];
    $vendorMob = $getvenid['mobile_num'];
    $Ins_d = date('Y/m/d');

    $orderId = "DD" . $plantoktoken;
    $addmemOrderQu = mysqli_query($con, "INSERT INTO `mem_order`(`order_id`, `vendor_id`, `plan_id`, `plan_amnt`, `plan_days`,`coupon_ap`, `coupon_code`, `paid_amnt`) VALUES ('$orderId','$vendorId','$planId','$PaybleAmnt','$planDays', '$dataCoupon' ,'$couponCode', '$planAmnt')");


    $getInovceDataQ = mysqli_query($con, "SELECT v.merchant_bus_name, v.address_1, v.gst_num, v.email_id, mo.order_id, mo.plan_id, mo.plan_amnt, mo.plan_days, mo.payment_id, mp.plan_grade, mp.plan_type, mp.plan_name FROM vendor v, mem_order mo, membership_plan mp WHERE mo.vendor_id='$vendorId' AND mo.plan_id=mp.id;");
    $getInovceDataR = mysqli_fetch_array($getInovceDataQ);


    if ($addmemOrderQu) {

        $data['vendorid'] = $vendorId;
        $data['vendorName'] = $vendorName;
        $data['vendorEmailId'] = $vendorEmailId;
        $data['vendorMob'] = $vendorMob;
        $data['orderId'] = $orderId;
        $data['couponCode'] = $couponCode; 
        $data['status'] = true;
    } else {
        $data['status'] = false;
    }
}



if (isset($_POST['type']) && $_POST['type'] == "AddMeMOrderWithOutPay") {

    $LoginVendorId = $_POST['LoginVendorId'];
    $planId = $_POST['planId'];
    $planAmnt = $_POST['planAmnt'];
    $PaybleAmnt = $_POST['PaybleAmnt'];
    $planDays = $_POST['planDays'];
    $dataCoupon = $_POST['dataCoupon'];
    $couponCode = $_POST['couponCode'];



    $getvenidQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$LoginVendorId'");
    $getvenid = mysqli_fetch_array($getvenidQ);
    $vendorId = $getvenid['id'];
    $vendorName = $getvenid['f_name'] . " " . $getvenid['l_name'];
    $vendorEmailId = $getvenid['email_id'];
    $vendorMob = $getvenid['mobile_num'];
    $Ins_d = date('Y/m/d');

    $orderId = "DD" . $plantoktoken;
    $addmemOrderQu = mysqli_query($con, "INSERT INTO `mem_order`(`order_id`, `vendor_id`, `plan_id`, `plan_amnt`, `plan_days`, `coupon_ap`, `coupon_code`, `paid_amnt`, `payment_status`) VALUES ('$orderId','$vendorId','$planId','$PaybleAmnt','$planDays','$dataCoupon','$couponCode','$planAmnt','PayAgainstCoupon')");

    $getInovceDataQ = mysqli_query($con, "SELECT v.id, v.merchant_bus_name, v.address_1, v.gst_num, v.email_id, v.c_code, v.mobile_num, mo.id, mo.order_id, mo.plan_id, mo.date_time, mo.payment_date, mo.plan_amnt, mo.plan_days, mp.plan_grade, mp.plan_type, mp.plan_name FROM vendor v, mem_order mo, membership_plan mp WHERE mo.vendor_id=v.id AND mo.plan_id=mp.id AND mo.vendor_id='$LoginVendorId' ORDER BY `mo`.`id` DESC;");

    $getInovceDataR = mysqli_fetch_array($getInovceDataQ);

    // define('Invoicedata', $getInovceDataR);
    // require_once('../generatepdf/TCPDF/tcpdf.php');
    // require_once('../generatepdf/memPlan.php');


    // $pdf->Output(__DIR__ . '/../pdf/' . $invoiceName . '.pdf', 'F');

    $expday = $i = 0;
    $actplan = mysqli_query($con, "SELECT * FROM  `vendor_membership` WHERE expire_date>'$Ins_d' AND vendor_id='$LoginVendorId' ORDER BY add_date desc");
    if (mysqli_num_rows($actplan) > 0) {
        while ($row = mysqli_fetch_array($actplan)) {
            //   print_r($row);
            $i++;
            if ($i == 1) {
                $date2 = $Ins_d;
                $date1 = $row['add_date'];
                $diff = abs(strtotime($date2) - strtotime($date1));

                $years = floor($diff / (365 * 60 * 60 * 24));
                $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                $expday = $expday + ($row['mem_plan_days'] - $days);
            } else {
                $expday = $expday + $row['mem_plan_days'];
            }
        }
        $expday = $expday + $planDays;
    } else {
        $expday = $planDays;
    }

    $expireday = date('Y/m/d', strtotime($Ins_d . " +" . $expday . " days"));

    $addPlanQu = mysqli_query($con, "INSERT INTO `vendor_membership`(`vendor_id`, `mem_plan_amnt`, `mem_plan_days`,`mem_plan_paid_amnt`, `add_date`,`expire_date`) VALUES ('$vendorId','$PaybleAmnt',$planDays,'$planAmnt','$Ins_d','$expireday')");
    if ($addPlanQu) {


        // SEND EMAIL to admin on new user registration

        $vendorEmail =  $getInovceDataR['email_id'];
        $vendorcode =  $getInovceDataR['c_code'];
        $vendormo =  $getInovceDataR['mobile_num'];
        $vendorName =  $getInovceDataR['merchant_bus_name'];
        $orderId =  $getInovceDataR['order_id'];
        $number = $vendorcode . $vendornm;

        if (mysqli_num_rows($actplan) > 0) {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"6492b852d6fc051736069923","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vendorName . '", "var2":"' . $planNameSMS . '", "var3":"' . $expireday . '"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
        } else {
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"6493d31cd6fc055d1273e2a5","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vendorName . '", "var2":"' . $planNameSMS . '", "var3":"' . $planDays . ' Days"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
        }


        $data['status'] = true;
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in add plan to vendor profile';
    }
}


if (isset($_POST['type']) && $_POST['type'] == "AddLMDOrder") {

    $LoginVendorId = $_POST['LoginVendorId'];
    $planId = $_POST['planId'];
    $planAmnt = $_POST['planAmnt'];
    $PaybleAmnt = $_POST['PaybleAmnt'];
    $planItems = $_POST['planItems'];
    $dataCoupon = $_POST['dataCoupon'];
    $couponCode = $_POST['couponCode'];

    $getvenidQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$LoginVendorId'");
    $getvenid = mysqli_fetch_array($getvenidQ);
    $vendorId = $getvenid['id'];
    $vendorName = $getvenid['f_name'] . " " . $getvenid['l_name'];
    $vendorEmailId = $getvenid['email_id'];
    $vendorMob = $getvenid['mobile_num'];
    $Ins_d = date('Y/m/d');

    $orderId = "DDLMD" . $plantoktoken;
    $addmemOrderQu = mysqli_query($con, "INSERT INTO `lmd_order`(`order_id`, `vendor_id`, `plan_id`, `plan_amnt`, `plan_deals`, `coupon_ap`, `coupon_code`, `paid_amnt`) VALUES ('$orderId','$vendorId','$planId','$PaybleAmnt','$planItems', '$dataCoupon', '$couponCode', '$planAmnt' )");

    if ($addmemOrderQu) {

        $data['vendorid'] = $vendorId;
        $data['vendorName'] = $vendorName;
        $data['vendorEmailId'] = $vendorEmailId;
        $data['vendorMob'] = $vendorMob;
        $data['couponCode'] = $couponCode;
        $data['order_id'] = $orderId;
        $data['status'] = true;
    } else {
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "AddLMDPayMnetID") {
    // print_r($_POST);
    // die();
    $LoginVendorId = $_POST['LoginVendorId'];
    $payment_id = $_POST['payment_id']; 
    $couponCode = $_POST['couponCode']; 
    $planItems1 = $_POST['planItems'];
    
    $Ins_d = date('Y/m/d');

 
    $addmemOrderQu = mysqli_query($con, "UPDATE `lmd_order` SET `payment_status`='complete',`payment_id`='$payment_id',`payment_date`='$Ins_d'  WHERE `vendor_id`='$LoginVendorId' ");


    if ($addmemOrderQu) {
        $addCouponUsedQ = mysqli_query($con, "INSERT INTO `coupon_used_all`(`vendor_id`, `coupon_id`, `used_date`) VALUES ('$LoginVendorId','$couponCode','$Ins_d')");

        $getInovceDataQ = mysqli_query($con, "SELECT v.id, v.merchant_bus_name, v.address_1, v.gst_num, v.email_id, v.c_code, v.mobile_num, lmo.order_id, lmo.plan_id, lmo.date_time, lmo.payment_date, lmo.plan_amnt, lmp.plan_deal_items, lmp.plan_grade, lmp.plan_type, lmp.plan_name FROM vendor v, lmd_order lmo, last_minute_deals_plan lmp WHERE lmo.vendor_id=v.id AND lmo.plan_id=lmp.id AND lmo.vendor_id='$LoginVendorId'");

        $getInovceDataR = mysqli_fetch_array($getInovceDataQ);
        // print_r($getInovceDataR);
        $vendorcode =  $getInovceDataR['c_code'];
        $vendormo =  $getInovceDataR['mobile_num'];
        $vendorName =  $getInovceDataR['merchant_bus_name'];

      


        $planQ = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE `vendor_id`='$LoginVendorId' AND plan_items>0");
        $actPlan = mysqli_num_rows($planQ);

        $planQ2 = mysqli_query($con, "SELECT * FROM `vendor_last_minute_deal_plan` WHERE `vendor_id`='$LoginVendorId'");
        $actPlan2 = mysqli_num_rows($planQ2);

        if ($actPlan > 0) {
          
            $getActPlanData = mysqli_fetch_array($planQ);
          
            $planItemsAct = ($planItems1 + $getActPlanData['plan_items']);
            $wod = "UPDATE `vendor_last_minute_deal_plan` SET `plan_items`='$planItemsAct' WHERE `vendor_id`='$LoginVendorId'";
            $addPlanQu = mysqli_query($con, $wod);
        } elseif($actPlan2 > 0){
          
            $getActPlanData2 = mysqli_fetch_array($planQ2);
             
            
            $planItemsAct = ($planItems1 + $getActPlanData2['plan_items']);
            $wod = "UPDATE `vendor_last_minute_deal_plan` SET `plan_items`='$planItemsAct' WHERE `vendor_id`='$LoginVendorId'";
            $addPlanQu = mysqli_query($con, $wod);
        } else {
            $addPlanQu = mysqli_query($con, "INSERT INTO `vendor_last_minute_deal_plan`(`vendor_id`,  `plan_items`, `add_date`) VALUES ('$LoginVendorId', '$planItems1','$Ins_d')");
        }



        if ($addPlanQu) {

            $number = $vendorcode . $vendormo;
            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"6493d366d6fc056024209683","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vendorName . '","var2":"' . $planItems1 . '"}',



                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);

            $data['status'] = true;
        } else {
            $data['status'] = false;
            $data['message'] = 'Error Occur in add plan to vendor profile';
        }
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in payment process';
    }
}
echo json_encode($data);
