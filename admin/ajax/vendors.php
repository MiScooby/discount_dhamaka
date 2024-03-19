<?php include('config.php');
require_once('../../vendor2/autoload.php');
require_once '../../emailer/mail.class.php';

if (isset($_POST['type']) && $_POST['type'] == "statusChnage") {

    $vendorId = $_POST['vendorId'];
    $vendor_sts = $_POST['vendor_sts'];

    $checkStoretype = mysqli_query($con, "SELECT * FROM `vendor` WHERE `id`='$vendorId' ");
    $storeDet = mysqli_fetch_array($checkStoretype);

    $checkStoreDoc = mysqli_query($con, "SELECT * FROM `vendor_document_upload` WHERE `vendor_id`='$vendorId'");
    $checkStoreDocCo = mysqli_num_rows($checkStoreDoc);
    if ($checkStoreDocCo > 0) {
        $chngStatus = mysqli_query($con, "UPDATE `vendor` SET `status`='$vendor_sts' WHERE `id`='$vendorId'");

        if ($chngStatus) {
            $data['message'] = 'Status Updated';
            $data['status'] = true;
        } else {
            $data['message'] = 'Error in Status Update';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Sorry But Document Not Upload By Admin';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "DltVendor") {

    $vendorIdnum = $_POST['vendorIdnum'];

    $chngStatus = mysqli_query($con, "UPDATE `vendor` SET `is_deleted` = '1' WHERE `id`='$vendorIdnum'");

    if ($chngStatus) {
        $data['message'] = 'User Deleted ';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in User Delete';
        $data['status'] = false;
    }
}

if (isset($_POST['type']) && $_POST['type'] == "NtAppvVend") {

    $vendorIdnum = $_POST['vendorIdnum'];

    $chngStatus = mysqli_query($con, "UPDATE `vendor` SET `status` = 'Not Approved', `edited`='0' WHERE `id`='$vendorIdnum'");
    $vendorMsgDet = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor` WHERE id = '$vendorIdnum'"));
    $vName = $vendorMsgDet['f_name'];
    $c_code = $vendorMsgDet['c_code'];
    $mobNum = $vendorMsgDet['mobile_num'];
    if ($chngStatus) {
        $data['message'] = 'Vendor Not Approved';
        $data['status'] = true;
        $number = $c_code . $mobNum;
        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
            'body' => '{"template_id":"64103d25d6fc05264863f082","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vName . '"}',
            'headers' => [
                'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);

        // // for user otp mail
        // include '../emailer_html/activation/not-approved.php';

        // $mail_title = "Discount Dhamaka";

        // $mail_subject = "Discount Dhamaka Registartion Status";

        // // user email-id
        // $user_mail = new HttpMail($emailAddress);

        // $user_mail->send($mail_title, $mail_subject, $userotpmsg);

        // echo $response->getBody();
    } else {
        $data['message'] = 'Error in Vendor Approved';
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "UpdateVendorDet") {

    $vendorId = $_POST['vendorId'];
    $VUserName = $_POST['VUserName'];
    $VFirstName = $_POST['VFirstName'];
    $VLastName = $_POST['VLastName'];
    $busType = $_POST['busType'];
    $busCat = $_POST['busCat'];
    $Vmb_name = $_POST['Vmb_name'];
    $VgstNum = $_POST['VgstNum'];
    $Vcp_name = $_POST['Vcp_name'];
    $cp_code = $_POST['cp_code'];
    $Vcp_num = $_POST['Vcp_num'];
    $Vcp_email = $_POST['Vcp_email'];
    $VAddr_1 = $_POST['VAddr_1'];
    $VAddr_2 = $_POST['VAddr_2'];
    $vCity = $_POST['vCity'];
    $cState = $_POST['cState'];
    $vPin = $_POST['vPin'];
    $vendor_sts = $_POST['vendor_sts'];
    $PlanGrade = $_POST['PlanGrade'];
    $PlanType = $_POST['PlanType'];


    $vendorMsgDet = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor` WHERE id = '$vendorId'"));
    $vName = $vendorMsgDet['f_name'];
    $c_code = $vendorMsgDet['c_code'];
    $mobNum = $vendorMsgDet['mobile_num'];
    $isedited = $vendorMsgDet['edited'];
    $email_idv = $vendorMsgDet['email_id'];



    $checkStoreDoc = mysqli_query($con, "SELECT * FROM `vendor_document_upload` WHERE `vendor_id`='$vendorId'");
    $checkStoreDocCo = mysqli_num_rows($checkStoreDoc);
    if ($checkStoreDocCo > 0) {
        $updateDetails = mysqli_query($con, "UPDATE `vendor` SET `user_name`='$VUserName',`f_name`='$VFirstName',`l_name`='$VLastName',`business_type`='$busType',`business_cat`='$busCat',`address_1`='$VAddr_1',`address_2`='$VAddr_2' ,`city`='$vCity',`state`='$cState',`pin_code`='$vPin',`merchant_bus_name`='$Vmb_name',`cp_name`='$Vcp_name',`cp_email`='$Vcp_email',`cp_c_code`='$cp_code',`cp_num`='$Vcp_num',`gst_num`='$VgstNum', `status`='$vendor_sts', `plan_grade`='$PlanGrade', `plan_type`='$PlanType', `edited`='0' WHERE `id`='$vendorId' ");

        if ($updateDetails) {
            $data['message'] = 'Vendor Details Updated ';
            $data['status'] = true;
            if ($isedited == "1") {
                $number = $c_code . $mobNum;
                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                    'body' => '{"template_id":"6495237ed6fc0565df27e9a2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vName . '"}',
                    'headers' => [
                        'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                    ],
                ]);
            } else {
                $number = $c_code . $mobNum;
                $client = new \GuzzleHttp\Client();

                $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                    'body' => '{"template_id":"64103d90d6fc05136a3fb163","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $vName . '"}',
                    'headers' => [
                        'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                    ],
                ]);
            }
            // for user otp mail
            include '../../emailer_html/activation/activation.php';

            $mail_title = "Discount Dhamaka";

            $mail_subject = "Discount Dhamaka Registartion Status";

            // user email-id
            $user_mail = new HttpMail($email_idv);

            $user_mail->send($mail_title, $mail_subject, $userotpmsg);

            // echo $response->getBody();

        } else {
            $data['message'] = 'Error in Update Vendor Details';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Sorry But Document Not Upload By Admin';
        $data['status'] = false;
    }
}

if (isset($_POST['addVendorDoc']) && $_POST['addVendorDoc'] == "addVendorDoc") {

    $VendorId = $_POST['VendorId'];
    $vendorDocName = $_POST['vendorDocName'];
    $vendorDocImage = $_FILES['vendorDocImage'];
    $ins_date = date('Y/m/d');

    $mul_img = $_FILES["vendorDocImage"]["tmp_name"];
    $mul_ext = explode('.', $_FILES['vendorDocImage']['name']);
    $extension = end($mul_ext);



    //   $temp = explode(".", $value);
    $newpro_filename = round(microtime(true)) . '.' . $extension;

    $insertDocQuery = mysqli_query($con, "INSERT INTO `vendor_doc`(`vendor_id`, `doc_type`, `doc_file`,`ins_date`) VALUES ('$VendorId','$vendorDocName','$newpro_filename', '$ins_date')");
    if ($insertDocQuery) {
        move_uploaded_file($mul_img, "../../upload/vendor-doc/" . $newpro_filename);
        $data['message'] = 'Document Upload Successfully..';
        $data['location'] = "view-vendor.php?$urltoken&$urltoken&&vendor_id=$VendorId&$urltoken&$urltoken";
        $data['status'] = true;
    }
}

if (isset($_POST['formsubmitType']) && $_POST['formsubmitType'] == "VendorBrandEdit") {
    $BrandName = $_POST['BrandName'];
    $myDesc = $_POST['myDesc'];
    $BrandLocation = $_POST['BrandLocation'];
    $preLoc = $_POST['preLoc'];
    $latInput = $_POST['latInput'];
    $lngInput = $_POST['lngInput'];
    $formsubmitType = $_POST['formsubmitType'];
    $vendorId = $_POST['vendorId'];
    
    $updateBrandQuery = '';
    $updateBrandQuery .= "UPDATE `vendor_brand` SET `store_name`='$BrandName',`store_desc`='$myDesc',`store_location`='$preLoc',`store_locality`='$BrandLocation',`store_lat`='$latInput',`store_lng`='$lngInput'";

    if (!empty($_FILES['BrandLogo']['name'])) {
        $BrandLogo = $_FILES['BrandLogo'];
        $FileExt = explode('.', $BrandLogo['name'])[1];
        $FileExtName = 'dd_brand' . round(microtime(true)) . ".jpg"; 
        $updateBrandQuery .=  ",`brand_logo`= '$FileExtName'";
    }

    
    $updateBrandQuery .=  "WHERE `vendor_id` = '$vendorId'";

    $updateBrandQueryQ = mysqli_query($con, $updateBrandQuery);

    if($updateBrandQueryQ){
        if (!empty($_FILES['BrandLogo']['name'])) {
            move_uploaded_file($BrandLogo['tmp_name'], "../../upload/vendor-doc/brand-logo/" . $FileExtName);
        }
        $data['status'] = true;
        $data['message'] = 'Vendor Saved Successfully..';
    }else{
        $data['status'] = true;
        $data['message'] = 'Vendor Not Saved..';
    }

}

echo json_encode($data);
