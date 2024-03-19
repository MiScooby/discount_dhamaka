<?php include('../admin/ajax/config.php');
include('../sendmail.php');
require_once('../vendor2/autoload.php');
// print_r($_POST);

$paySts = $_POST['code']; 
$OrderId = $_POST['transactionId'];
$payment_id = $_POST['providerReferenceId'];
$Ins_d = date('Y/m/d');

$getOrderDetail = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `mem_order` WHERE `order_id`='$OrderId'"));
$PaybleAmnt = $getOrderDetail['paid_amnt'];
$planAmnt = $getOrderDetail['plan_amnt'];
$planDays = $getOrderDetail['plan_days'];
$LoginVendorId = $getOrderDetail['vendor_id'];
$couponCode = $getOrderDetail['coupon_code'];
$payment_status = $getOrderDetail['payment_status'];
if ($couponCode != "0") {
    
    $ChkCouponData = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `coupons` WHERE `coupon_code`='$couponCode' "));
    $user_type = $ChkCouponData['user_type'];
     $coupon_id = $ChkCouponData['id'];
   
}

if ($paySts = "PAYMENT_SUCCESS"  && $payment_status == "pending") {
    $addmemOrderQu = mysqli_query($con, "UPDATE `mem_order` SET `payment_status`='complete',`payment_id`='$payment_id',`payment_date`='$Ins_d'   WHERE `order_id`='$OrderId' ");

    if ($addmemOrderQu) {
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
        $addCouponUsedQ = mysqli_query($con, "INSERT INTO `coupon_used_all`(`vendor_id`,`order_id`, `coupon_id`, `used_date`) VALUES ('$LoginVendorId','$OrderId','$couponCode','$Ins_d')");

        $getInovceDataQ = mysqli_query($con, "SELECT v.id, v.merchant_bus_name, v.address_1, v.gst_num, v.email_id, v.c_code, v.mobile_num, mo.id, mo.order_id, mo.plan_id, mo.date_time, mo.payment_date, mo.plan_amnt, mo.plan_days, mp.plan_grade, mp.plan_type, mp.plan_name FROM vendor v, mem_order mo, membership_plan mp WHERE mo.vendor_id=v.id AND mo.plan_id=mp.id AND mo.vendor_id='$LoginVendorId' ORDER BY `mo`.`id` DESC;");


        $getInovceDataR = mysqli_fetch_array($getInovceDataQ);



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

        $addPlanQu = mysqli_query($con, "INSERT INTO `vendor_membership`(`vendor_id`, `mem_plan_amnt`, `mem_plan_days`, `mem_plan_paid_amnt`, `add_date`,`expire_date`) VALUES ('$LoginVendorId','$planAmnt',$planDays, '$PaybleAmnt', '$Ins_d','$expireday')");
        if ($addPlanQu) {

            // SEND EMAIL to admin on new user registration

            $vendorEmail =  $getInovceDataR['email_id'];
            $vendorcode =  $getInovceDataR['c_code'];
            $vendormo =  $getInovceDataR['mobile_num'];
            $vendorName =  $getInovceDataR['merchant_bus_name'];
            $orderId =  $getInovceDataR['order_id'];
            $planNameSMS =  $getInovceDataR['plan_name'];


            $number = $vendorcode . $vendormo;
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

                // print_r($response);
                // die;
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
            header("location:../vendor-profile.php");
        } else {
            noAccessPage1();
        }
    } else {
        noAccessPage1();
    }
}else{
    noAccessPage1();
}
