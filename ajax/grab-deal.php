<?php include('../admin/ajax/config.php');
require_once '../emailer/mail.class.php';
require_once('../vendor2/autoload.php');
if (isset($_POST['type']) && $_POST['type'] == "grabDeal") {
    $token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    $srbTok = substr(str_shuffle($str), 0, 5);
    $orderToken = 'DD' . round(microtime(true)) . strtoupper($srbTok);
    $DeAlId = $_POST['DeAlId'];
    $UserId = $_POST['UserId'];
    $Ins_d = date('Y/m/d');

    $getUserDetails = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `user` WHERE `user_name`='$UserId'"));
    $usrfirst_name = $getUserDetails['first_name'];
    $usrCode = $getUserDetails['c_code'];
    $usrMob = $getUserDetails['mobile_num'];
    $usrEmail = $getUserDetails['email_id'];
    $usrstatus = $getUserDetails['status'];





    if ($usrstatus == "Active") {

        $GetDealstsDataQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `id`='$DeAlId'");
        $GetDealstsData = mysqli_fetch_array($GetDealstsDataQ);

        $Dealstatus = $GetDealstsData['status'];
        $Dealvendor_id = $GetDealstsData['vendor_id'];

        $currentSrbTime = date("Y-m-d H:i");
        $DealDteTime = $GetDealstsData['offer_end_date'] . ' ' . $GetDealstsData['offer_end_time'];



        // vendor details:
        $getVdrDetails = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor` WHERE `id`='$Dealvendor_id'"));
        $vdrfirst_name = $getVdrDetails['f_name'];
        $vdrCode = $getVdrDetails['c_code'];
        $vdrMob = $getVdrDetails['cp_num'];
        $vdrMovile = $vdrCode . $vdrMob;


        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {

            if ($Dealstatus == "Active") {
                $GetDealDataQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `id`='$DeAlId'");
                $GetDealData = mysqli_fetch_array($GetDealDataQ);
                $DealItems = $GetDealData['deal_times'];
                $offer_title = $GetDealData['offer_title'];
                $Islast_minute_deal = $GetDealData['last_minute_deal'];

                if ($DealItems == "n/a") {
                    $leftDealItems = "n/a";
                } else {
                    $leftDealItems = $DealItems - 1;
                }
                $DealClick = $GetDealData['click'];
                $grossClick = $DealClick + 1;
                $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                $couponCode = substr(str_shuffle($str), 0, 5);
                $grabDealQ = mysqli_query($con, "INSERT INTO `deals_order`(`order_token`, `deal_id`, `user_id`,`coupon_code`, `ins_date`) VALUES ('$orderToken','$DeAlId ','$UserId','$couponCode','$Ins_d')");
                $last_id = mysqli_insert_id($con);
                $updateDealitems = mysqli_query($con, "UPDATE `offer_deals` SET `deal_times`='$leftDealItems',`click`='$grossClick' WHERE `id`='$DeAlId' ");
                //     echo "UPDATE `offer_deals` SET `deal_times`='$leftDealItems',`click`='$grossClick' WHERE `id`='$DeAlId'";
                // die();
                if ($grabDealQ && $updateDealitems) {


                    if ($usrMob != null) {
                        $number = $usrCode . $usrMob;
                        if ($Islast_minute_deal == "Yes") {
                            
                            $client = new \GuzzleHttp\Client();

                            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                                'body' => '{"template_id":"6492b968d6fc0558f955a532","sender":"DISDMK","short_url":"0","mobiles":"' . $vdrMovile . '","var1":"' . $offer_title . '","var2":"' .  $couponCode . '","var3":"' .  $usrfirst_name . '","var4":"' . $number . '","var5":"' . $leftDealItems . '"}',
                                'headers' => [
                                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                                    'accept' => 'application/json',
                                    'content-type' => 'application/json',
                                ],
                            ]);


                            $client = new \GuzzleHttp\Client();

                            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                                'body' => '{"template_id":"6492ba00d6fc05351e3f9143","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $usrfirst_name . '","var2":"' . $offer_title . '","var3":"' . $couponCode . '","var4":"' . $vdrfirst_name . '","var5":"' . $vdrMovile . '"}',
                                'headers' => [
                                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                                    'accept' => 'application/json',
                                    'content-type' => 'application/json',
                                ],
                            ]);
                        } else {
                           
                            $client = new \GuzzleHttp\Client();

                            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                                'body' => '{"template_id":"6492ba31d6fc054307148153","sender":"DISDMK","short_url":"0","mobiles":"' . $vdrMovile . '","var1":"' . $vdrfirst_name . '","var2":"' . $offer_title . '","var3":"' . $couponCode . '","var4":"' . $usrfirst_name . '","var5":"' . $number . '"}',
                                'headers' => [
                                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                                    'accept' => 'application/json',
                                    'content-type' => 'application/json',
                                ],
                            ]);

                            $client = new \GuzzleHttp\Client();

                            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                                'body' => '{"template_id":"6492b9a7d6fc055a69788fb4","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $usrfirst_name . '","var2":"' . $offer_title . '","var3":"' . $couponCode . '","var4":"' . $vdrfirst_name . '","var5":"' . $vdrMovile . '"}',
                                'headers' => [
                                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                                    'accept' => 'application/json',
                                    'content-type' => 'application/json',
                                ],
                            ]);
                        }



                        // echo $response->getBody();



                    } else if ($usrEmail != null) {
                        // for user otp mail
                        include '../emailer_html/grab-deals/index.php';

                        $mail_title = "Discount Dhamaka";

                        $mail_subject = "Discount Dhamaka Deal Details";
                        $userDealmsg = " ";
                        // user email-id
                        $user_mail = new HttpMail($usrEmail);

                        $sendMail =  $user_mail->send($mail_title, $mail_subject, $userDealmsg);
                        //    if($sendMail){
                        //     $data['message1'] = 'Email sent';
                        // $data['status1'] = true;
                        //    }
                        //    else{
                        //     $data['message1'] = 'Email not sent';
                        // $data['status1'] = false;
                        //    }
                    }

                    $data['message'] = 'Deal Grab Successfull Please Check Email or Mobile For Further Information';
                    $data['url'] = 'order-success.php?' . $urltoken . '&' . $urltoken . '&&id=' . $last_id . '&' . $urltoken . '&' . $urltoken;
                    $data['status'] = true;
                } else {
                    $data['message'] = 'Error Occur in this grab deal !';
                    $data['status'] = false;
                }
            } else {
                $data['message'] = 'Deal Disabled by administor !';
                $data['status'] = false;
            }
        } else {
            $data['message'] = 'Deal Expired !';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'You can not grab this deal at a moment !';
        $data['status'] = false;
    }
}
echo json_encode($data);
