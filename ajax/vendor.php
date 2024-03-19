<?php include('../admin/ajax/config.php');
require_once('../vendor2/autoload.php');


if (isset($_POST['type']) && $_POST['type'] == "EditVendorDet") {
    $vuserName = $_POST['vuserName'];
    $vFirstName = $_POST['vFirstName'];
    $VlastName = $_POST['VlastName'];
    $mbName = $_POST['mbName'];
    $cpName = $_POST['cpName'];
    $cpEmail = $_POST['cpEmail'];
    $cpNum = $_POST['cpNum'];
    $Bustypev = $_POST['Bustypev'];
    $BusCatv = $_POST['BusCatv'];
    $vGst = (empty($_POST['vGst'])) ? 'n/a' :  $_POST['vGst'];
    $vLandline = empty($_POST['vLandline']) ? 'n/a' :  $_POST['vLandline'];
    $vAddr1 =  $_POST['vAddr1'];
    $vAddr2 =  empty($_POST['vAddr2']) ? 'n/a' :  $_POST['vAddr2'];
    $vCity = $_POST['vCity'];
    $vState = $_POST['vState'];
    $vPinCode = $_POST['vPinCode'];

    $updtaProfileVendorQuer = mysqli_query($con, "UPDATE `vendor` SET `user_name`='$vuserName',`f_name`='$vFirstName',`l_name`='$VlastName',`business_type`='$Bustypev',`business_cat`='$BusCatv',`address_1`='$vAddr1',`address_2`='$vAddr2',`city`='$vCity',`state`='$vState',`pin_code`='$vPinCode',`merchant_bus_name`='$mbName',`cp_name`='$cpName',`cp_email`='$cpEmail',`cp_c_code`='',`cp_num`='$cpNum',`gst_num`='$vGst',`landline_num`='$vLandline', `edited`='1' WHERE `user_name`='$vuserName'");
    if ($updtaProfileVendorQuer) {
        
        $getSYUadychsdiu = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vuserName'");
        $getSYUady = mysqli_fetch_array($getSYUadychsdiu);
        $c_code = $getSYUady['c_code'];
        $mobNum = $getSYUady['mobile_num'];
         $number = $c_code . $mobNum;  

            $client = new \GuzzleHttp\Client();

            $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
                'body' => '{"template_id":"649ae242d6fc051844583bd2","sender":"DISDMK","short_url":"0","mobiles":"'.$number.'","var1":"'.$vuserName.'"}',
                'headers' => [
                    'Authkey' => '315115ArcXDoIizG5e2d5582P1',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);
            // echo $response->getBody();
        $data['message'] = 'Profile Update';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error Found in Profile Update';
        $data['status'] = false;
    }
}



if (isset($_POST['type']) && $_POST['type'] == "emialVerificationVendorProfile") {
    $vuserName = $_POST['vuserName'];


    $getVendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vuserName' ");
    $getVendor = mysqli_fetch_array($getVendorQ);
    if ($getVendor['email_verified'] == 1) {
        $data['message'] = 'Email Verfied';
        $data['par'] = 1;
        $data['status'] = true;
    } else {
        $data['message'] = 'Email not Verfied';
        $data['par'] = 0;
        $data['status'] = false;
    }
}


if (isset($_POST['type']) && $_POST['type'] == "addBrandStore") {
    $VendorId = $_POST['vendorId'];
    $getVendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$VendorId' ");
    $getVendor = mysqli_fetch_array($getVendorQ);
    $vId = $getVendor['id'];
    $storeName = $_POST['storeName'];

    $img = $_FILES['brandLogo']['tmp_name'];
    $brandLocality = $_POST['brandLocality'];
    $myDesc = $_POST['myDesc'];
    $preciseLocation = mysqli_real_escape_string($con, $_POST['preLoc']);
    $latInput = $_POST['latInput'];
    $lngInput = $_POST['lngInput'];
    $Ins_d = date('Y/m/d');
    $Ins_t = date("h:i:s");
    $newpro_filename2 = 'dd_brand' . round(microtime(true)) . ".jpg";
    $getBrandStoreQ = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `store_name`='$storeName' ");
    $getBrandStore = mysqli_num_rows($getBrandStoreQ);
    if ($getBrandStore == 0) {
 
        
        $addBrndStrQ = mysqli_query($con, "INSERT INTO `vendor_brand`(`vendor_id`, `store_name`, `brand_logo`,`store_desc`, `store_location`, `store_locality`,`store_lat`,`store_lng`, `ins_date`, `ins_time`) VALUES ('$vId','$storeName', '$newpro_filename2', '$myDesc','$preciseLocation','$brandLocality','$latInput','$lngInput','$Ins_d','$Ins_t')");
        if ($addBrndStrQ) {
            $data['message'] = 'Brand Store Added Successfully !!';
            $data['status'] = true;
           
            move_uploaded_file($img, "../upload/vendor-doc/brand-logo/" . $newpro_filename2);
            
        } else {
            $data['message'] = 'Error in Brand Store Add !!';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Brand Store Already Exist !!';
        $data['status'] = false;
    }
}



if (isset($_POST['type']) && $_POST['type'] == "editBrandStore") {

    // print_r($_POST);
    // die();

    $VendorId = $_POST['vendorId'];
    $getVendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$VendorId' ");
    $getVendor = mysqli_fetch_array($getVendorQ);
    $vId = $getVendor['id'];
    $storeName = $_POST['storeName'];
    $myDesc = $_POST['descBrand'];
    $preciseLocation = $_POST['preLoc'];
    $brandLocality = $_POST['brandLocality'];
    $latInput = $_POST['latInput'];
    $lngInput = $_POST['lngInput'];

    $img = $_FILES['brandLogo']['tmp_name'];
    $newpro_filename2 = 'dd_brand' . round(microtime(true)) . ".jpg";
    $Ins_d = date('Y/m/d');
    $Ins_t = date("h:i:s");

    $sql = "UPDATE `vendor_brand` SET `store_name`='$storeName',`store_desc`='$myDesc',`store_location`='$preciseLocation',`store_locality`='$brandLocality', `store_lat`='$latInput', `store_lng`='$lngInput',`ins_date`='$Ins_d',`ins_time`='$Ins_t'";

    if(!empty($img)){
        $sql.= ",`brand_logo`='$newpro_filename2'";
        
    }
    $sql .= " WHERE `vendor_id`='$vId'";
  

    $addBrndStrQ = mysqli_query($con, $sql);

    if ($addBrndStrQ) {
        $data['message'] = 'Brand Store Updated Successfully !!';
        $data['status'] = true;
        move_uploaded_file($img, "../upload/vendor-doc/brand-logo/" . $newpro_filename2);
    } else {
        $data['message'] = 'Error in Brand Store Update !!';
        $data['status'] = false;
    }
}
echo json_encode($data);
