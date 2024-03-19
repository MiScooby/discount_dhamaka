<?php
include('../admin/ajax/config.php');
error_reporting(1);
date_default_timezone_set("Asia/Kolkata");

function pushNotificationForAndroid($to, $body, $title, $icon, $click_action='no', $imageURL='no')
{

    try{

    $url = "https://fcm.googleapis.com/fcm/send";

            $addeddate = date("Y-m-d");
            $addedtime = date("H:i");
            $dateofadd = date("D, d M Y", strtotime($addeddate));
            $row_id = '456';

            if(is_null($imageURL)){ $imageURL = 'no'; }

            $fields = array(
                'registration_ids' => array(
                    $to
                ) ,
                'data' => array(
                    "title" => 'Message',
                    "message" => $body,
                    "date" => $dateofadd,
                    "time" => $addedtime,
                    "click_action" => (!empty($click_action)) ? $click_action : 'no',
                    "show_title" => $title,
                    "id" => $row_id,
                    "checkdate" => $addeddate,
                    "image" => (!empty($imageURL)) ? $imageURL : 'no'
                )
            );

            echo "<pre>";
            print_r($fields);
            echo "</pre>";

            $fields = json_encode($fields);
            $headers = array(
                'Authorization: key=AAAA7OEweZI:APA91bFjj85d0dGdulK756qu5qhVYCIvAh_a7VIZAMRTdhjSA8eMi2XTlP3-EiJ8PJnWp60ztIWgu6AUzDQA7lj0v-d2BiZ_hudeLPjcAUx8Q-Ip8AM693B1AG3s0WlRnT6APezx3evO',
                'Content-Type: application/json'
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            $result = curl_exec($ch);

            echo '<pre>';
            print_r($result);
            echo '</pre>';

            return $result;
            curl_close($ch);

            }catch(Exception $e){

            print_r( $e->getMessage() );die();

        }

}

    if(isset($_GET['userloginid'])){

        $userloginid = trim($_GET['userloginid']);

        if(!empty($userloginid)){
            $query = mysqli_query($con, "SELECT * FROM `user` WHERE `email_id` = '".$userloginid."' OR `mobile_num` = '".$userloginid."' order by id desc;");
            $cnt = mysqli_num_rows($query);
            if($cnt > 0){
                $cnt1 = mysqli_fetch_assoc($query);
                $device_id = $cnt1['device_id'];
                if($device_id != 'null'){
                    // echo $device_id ; die;
   
                    $to = $device_id;
                    $body = 'Message';
                    $title = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the    industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.';
                    $icon = 'https://cdn-icons-png.flaticon.com/512/300/300221.png';

                    if(isset($_GET['image'])){
                        if($_GET['image'] == 'yes'){
                            $myImage = 'https://images.pexels.com/photos/3476860/pexels-photo-3476860.jpeg';
                        }else{
                            $myImage = 'no';
                        }
                    }else{
                        $myImage = 'no';
                    }

                    $imageURL = $myImage;

                    pushNotificationForAndroid($to, $body, $title, $icon, $click_action='no', $imageURL);

                }
                else{
                    echo "Device ID Not Found.";
                }
                
            }else{
                echo "User Not Found.";
            }
           
        }else{
            echo "Please Enter User ID.";
        }


    }else{
        echo 'userloginid required in url';
        echo '<br>';
        // echo 'Example:  http://localhost:8060/discount_dhamaka_new/web_services/test-notification.php?userloginid=test@gmail.comvfvcfcf&image=no';
        echo 'Example:  https://micodetest.com/discount_dhamaka_new/web_services/test-notification.php?userloginid=test@gmail.comvfvcfcf&image=no';
    }

