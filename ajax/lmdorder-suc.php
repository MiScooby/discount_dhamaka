<?php include('../admin/ajax/config.php');
include('../sendmail.php');
require_once('../vendor2/autoload.php');

$paySts = $_POST['code'];
$OrderId = $_POST['transactionId'];
$payment_id = $_POST['providerReferenceId'];
$Ins_d = date('Y/m/d');

$getOrderDetail = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `lmd_order` WHERE `order_id`='$OrderId'"));
$PaybleAmnt = $getOrderDetail['paid_amnt'];
$planAmnt = $getOrderDetail['plan_amnt'];
$planItems1 = $getOrderDetail['plan_deals'];
$LoginVendorId = $getOrderDetail['vendor_id'];
$couponCode = $getOrderDetail['coupon_code'];
$payment_status = $getOrderDetail['payment_status'];

if ($couponCode != "0") {
    $ChkCouponData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `coupons` WHERE `coupon_code`='$couponCode' "));
    $user_type = $ChkCouponData['user_type'];
    $coupon_id = $ChkCouponData['id'];
}

if ($paySts = "PAYMENT_SUCCESS"  && $payment_status == "pending") {
    $addmemOrderQu = mysqli_query($con, "UPDATE `lmd_order` SET `payment_status`='complete',`payment_id`='$payment_id',`payment_date`='$Ins_d'  WHERE `vendor_id`='$LoginVendorId' ");
    if ($couponCode != "0") {

        if ($user_type == "Individual") {
            $redData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `coupon_users` WHERE `coupon_id`='$coupon_id' "));
            $redCount = $redData['red_count'];
            $redCountC = ($redCount - 1);

            if($redCountC < 0){
                $redCountC = "0";
            }
            mysqli_query($con, "UPDATE `coupon_users` SET  `red_count`='$redCountC'  WHERE `vendor_id`='$LoginVendorId' AND `coupon_id`='$coupon_id'");
        }
    }
    if ($addmemOrderQu) {
        $addCouponUsedQ = mysqli_query($con, "INSERT INTO `coupon_used_all`(`vendor_id`, `order_id`, `coupon_id`, `used_date`) VALUES ('$LoginVendorId','$OrderId','$couponCode','$Ins_d')");

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
        } elseif ($actPlan2 > 0) {

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

            echo true;
            header("location:../vendor-profile.php");
        } else {
             noAccessPage1();
            $data['message'] = 'Error Occur in add plan to vendor profile';
        }
    } else {
         noAccessPage1();
        $data['message'] = 'Error Occur in payment process';
    }
}else{
     noAccessPage1();
}
