<?php include('../admin/ajax/config.php');

if (isset($_POST['CouponCodeType']) && $_POST['CouponCodeType'] == "ApplyCoupons") {
    $AmountCrse  = $_POST['AmountCrse'];
    $CouponCodeFiled  = $_POST['CouponCodeFiled'];
    $LoginVendorId = $_POST['LoginVendorId'];
    $ChkCoupon = mysqli_query($con, "SELECT * FROM `coupons` WHERE `trash`='0'  AND `status`='1' AND `coupon_code`='$CouponCodeFiled' ");
    $ChkCouponCount = mysqli_num_rows($ChkCoupon);
    if ($ChkCouponCount > 0) {
        $ChkCouponData = mysqli_fetch_array($ChkCoupon);
        $coupId = $ChkCouponData['id'];
        $expDate = $ChkCouponData['end_date'];
        $CouponType = $ChkCouponData['offer_type'];
        $Couponvalue = $ChkCouponData['offer_value'];
        $CouponRedemption_count = $ChkCouponData['red_count'];
        $user_type = $ChkCouponData['user_type'];
        $CurDate = date('Y-m-d');

        if ($expDate > $CurDate) {
            if ($user_type == "Individual") {
                $chechKVendExist = mysqli_query($con, "SELECT cu.*, v.user_name FROM coupon_users cu, vendor v, coupons c WHERE v.id=cu.vendor_id AND c.id=cu.coupon_id AND  v.user_name='$LoginVendorId' AND c.id='$coupId ' ");
                $chechKVendExistCount = mysqli_num_rows($chechKVendExist);
                $chechKVendExistData = mysqli_fetch_array($chechKVendExist);
                if ($chechKVendExistCount > 0) {
                    if ($chechKVendExistData['red_count'] > 0) {
                        $disAmnt = $AmountCrse;
                        if ($CouponType == "Percentage") {
                            $perAnt = $AmountCrse * ($Couponvalue / 100);
                            $disAmnt = $AmountCrse - $perAnt;
                            if ($disAmnt < 0) {
                                $disAmnt = "0";
                            }
                        } else if ($CouponType == "Flat") {
                            $disAmnt = $AmountCrse - $Couponvalue;
                            if ($disAmnt < 0) {
                                $disAmnt = "0";
                            }
                        }
                        $data['amount'] = $disAmnt;
                        $data['coupon'] = $CouponCodeFiled;
                        $data['message'] = 'Promo Code Applied..';
                        $data['status'] = true;
                    } else {
                        $data['message'] = 'Promo Code Already Used !..';
                        $data['status'] = false;
                    }
                } else {
                    $data['message'] = 'Promo Code Not Available for You !..';
                    $data['status'] = false;
                }
            } else {
  
                $checkCounponALluse  = mysqli_num_rows(mysqli_query($con, "SELECT c.* FROM coupons c, coupon_used_all cua, vendor v WHERE c.coupon_code=cua.coupon_id AND v.id=cua.vendor_id AND v.user_name = '$LoginVendorId' AND c.coupon_code='$CouponCodeFiled'"));
                if ($CouponRedemption_count > $checkCounponALluse) {
                    $disAmnt = $AmountCrse;
                    if ($CouponType == "Percentage") {
                        $perAnt = $AmountCrse * ($Couponvalue / 100);
                        $disAmnt = $AmountCrse - $perAnt;
                        if ($disAmnt < 0) {
                            $disAmnt = "0";
                        }
                    } else if ($CouponType == "Flat") {
                        $disAmnt = $AmountCrse - $Couponvalue;
                        if ($disAmnt < 0) {
                            $disAmnt = "0";
                        }
                    }
                    $data['amount'] = $disAmnt;
                    $data['coupon'] = $CouponCodeFiled;
                    $data['message'] = 'Promo Code Applied..';
                    $data['status'] = true;
                } else {
                    $data['message'] = 'Promo Code Already Used !..';
                        $data['status'] = false;
                }
            }
        } else {
            $data['message'] = 'Promo Code Expired !..';
            $data['status'] = false;
        }
    } else {
        $data['message'] = 'Invalid Promo Code !..';
        $data['status'] = false;
    }
}


echo json_encode($data);
