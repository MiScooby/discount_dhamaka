<?php include('config.php');

if (isset($_POST['type']) && $_POST['type'] == "fetchVendors") {

    $fetVenQ = mysqli_query($con, "SELECT  *  FROM vendor   WHERE status='Active' AND  is_deleted='0'  ");
    $outPut = '<option></option>';
    if ($fetVenQ) {

        while ($fetVen = mysqli_fetch_array($fetVenQ)) {
            $outPut .= ' 
            <option value="' . $fetVen['id'] . '"> ( ' . $fetVen['mobile_num'] . ' ) - ' . strtoupper($fetVen['merchant_bus_name']) . '</option>
            ';
        }
        echo $outPut;
    }
}


if (isset($_POST['addCoupon']) && $_POST['addCoupon'] == "addCoupon") {

    $CouponCode   = $_POST['CouponCode'];
    $CouponTitle   = $_POST['CouponTitle'];
    $coupon_type   = $_POST['coupon_type'];
    $Coupon_Value   = $_POST['Coupon_Value'];
    $Coupon_Limit   = $_POST['Coupon_Limit'];
    $Coupon_start   = $_POST['Coupon_start'];
    $Coupon_expire   = $_POST['Coupon_expire'];
    $user_type   = $_POST['user_type'];
    $user_type_list   = $_POST['user_type_list'];
    $ins_date = date('Y/m/d');
    $ins_time = date('h:i:s');

    $checkCoupon = mysqli_query($con, "SELECT * FROM `coupons` WHERE `coupon_code`='$CouponCode' AND `trash`='0'");
    $CouponCodeCount = mysqli_num_rows($checkCoupon);

    if ($CouponCodeCount == 0) {
        $addCOuponQ = mysqli_query($con, "INSERT INTO `coupons`( `coupon_code`, `title`, `start_date`, `end_date`, `offer_type`, `offer_value`, `red_count`, `user_type`, `added_date`, `added_time`) VALUES ('$CouponCode','$CouponTitle','$Coupon_start','$Coupon_expire','$coupon_type','$Coupon_Value','$Coupon_Limit','$user_type','$ins_date','$ins_time')");

        if ($addCOuponQ) {
            $last_id = mysqli_insert_id($con);

            if ($user_type == "Individual") {

                foreach ($user_type_list as $Venid) {
                    $veidQ = mysqli_query($con, "INSERT INTO `coupon_users`(`vendor_id`, `coupon_id`, `red_count`, `added_date`, `added_time`) VALUES ('$Venid','$last_id', '$Coupon_Limit','$ins_date','$ins_time')");
                }

                if ($veidQ) {
                    $data['message'] = 'New Coupon Added Successfully... ';
                    $data['status'] = true;
                } else {
                    $data['message'] = 'Error in adding coupon..';
                    $data['status'] = false;
                }
            } else {
                $data['message'] = 'New Coupon Added Successfully... ';
                $data['status'] = true;
            }
        } else {
            $data['message'] = 'Error in adding coupon..';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Coupon Code Already Exist..';
        $data['status'] = false;
    }



    echo json_encode($data);
}

if (isset($_POST['typeCoupon']) && $_POST['typeCoupon'] == "editCoupon") {
    $couponID = $_POST['couponID'];
    $CouponCode   = $_POST['CouponCode'];
    $CouponTitle   = $_POST['CouponTitle'];
    $coupon_type   = $_POST['coupon_type'];
    $Coupon_Value   = $_POST['Coupon_Value'];
    $Coupon_Limit   = $_POST['Coupon_Limit'];
    $Coupon_start   = $_POST['Coupon_start'];
    $Coupon_expire   = $_POST['Coupon_expire'];
    $user_type   = $_POST['user_type'];
    $user_type_list   = $_POST['user_type_list'];
    $ins_date = date('Y/m/d');
    $ins_time = date('h:i:s');


    $UpdateCouponQ = mysqli_query($con, "UPDATE `coupons` SET  `coupon_code`='$CouponCode',`title`='$CouponTitle',`start_date`='$Coupon_start',`end_date`='$Coupon_expire',`offer_type`='$coupon_type',`offer_value`='$Coupon_Value',`red_count`='$Coupon_Limit',`user_type`='$user_type',`added_date`='$ins_date',`added_time`='$ins_time' WHERE `id`='$couponID' ");

    if ($UpdateCouponQ) {


        if ($user_type == "Individual") {

            foreach ($user_type_list as $Venid) {
                 
                $checkVen = mysqli_query($con, "SELECT * FROM `coupon_users` WHERE `vendor_id`='$Venid' AND `coupon_id`='$couponID' ");
              
                $checkVenCount = mysqli_num_rows($checkVen);
                if ($checkVenCount == 0) {
                    $veidQ = mysqli_query($con, "INSERT INTO `coupon_users`(`vendor_id`, `coupon_id`, `red_count`, `added_date`, `added_time`) VALUES ('$Venid','$couponID', '$Coupon_Limit','$ins_date','$ins_time')");
                      
                    if ($veidQ) {
                        $data['message'] = 'Promo Code Updated Successfully... ';
                        $data['status'] = true;
                    } else {
                        $data['message'] = 'Error in update Promo Code..';
                        $data['status'] = false;
                    }
                }else{
                    $data['message'] = 'User Already added in this Promo Code..';
                    $data['status'] = false;
                }
            }

           
        } else {
            $data['message'] = 'Promo Code Updated Successfully... ';
            $data['status'] = true;
        }
    } else {
        $data['message'] = 'Error in update Promo Code..';
        $data['status'] = false;
    }




    echo json_encode($data);
}


if (isset($_POST['type']) && $_POST['type'] == "coupon_dlt") {
    $copId = $_POST['copId'];
    $TrashCouponQ = mysqli_query($con, "UPDATE `coupons` SET  `trash`='1' WHERE `id`='$copId' ");
    if ($TrashCouponQ) {
        $data['message'] = 'Promo Code Delete Successfully...';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in delete Promo Code..';
        $data['status'] = false;
    }
    echo json_encode($data);
}

if (isset($_POST['type']) && $_POST['type'] == "coupon_sts") {
    $coupID = $_POST['coupID'];
    $sts = $_POST['sts'];
    $StstCoupoW = mysqli_query($con, "UPDATE `coupons` SET  `status`='$sts' WHERE `id`='$coupID' ");
    if ($StstCoupoW) {
        $data['message'] = 'Coupon Status Update Successfully...';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Status Update..';
        $data['status'] = false;
    }
    echo json_encode($data);
}
