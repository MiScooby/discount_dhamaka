<?php include('../admin/ajax/config.php');

if (isset($_POST['action'])) {
    $filQ = "SELECT od.*, vb.store_locality, vd.plan_type FROM offer_deals od, vendor_brand vb, vendor vd, vendor_membership vm  WHERE od.vendor_id=vd.id AND vm.vendor_id=vd.id AND  vb.vendor_id=od.vendor_id  AND  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND vd.is_deleted='0' AND vm.expire_date>NOW() ";
    $filQ2 = "SELECT od.*, vb.store_name, vb.brand_logo, vb.store_locality, vd.plan_type FROM offer_deals od, vendor_brand vb, vendor vd, vendor_membership vm  WHERE vb.vendor_id = od.vendor_id AND od.vendor_id=vd.id AND  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND vd.is_deleted='0' AND vm.vendor_id=vd.id AND vm.expire_date>NOW() ";
    if (isset($_POST['cat']) && !isset($_POST['subcategory'])) {
        $cat = implode("','", $_POST['cat']);
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   od.offer_cat IN('" . $cat . "') GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   od.offer_cat IN('" . $cat . "') GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    } else if (isset($_POST['stores'])) {
        $stores = implode("','", $_POST['stores']);
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   od.vendor_id IN('" . $stores . "') GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   od.vendor_id IN('" . $stores . "') GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    } else if (isset($_POST['location'])) {
        $location = implode("','", $_POST['location']);
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   vb.store_locality IN('" . $location . "') GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   vb.store_locality IN('" . $location . "') GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    } else if (isset($_POST['plantype']) && !in_array('all', $_POST['plantype'])) {
        $plantype = implode("','", $_POST['plantype']);
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   vd.plan_type IN('" . $plantype . "') GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   vd.plan_type IN('" . $plantype . "') GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    } else if (isset($_POST['plantype']) && in_array('all', $_POST['plantype'])) {
        $plantype = implode("','", $_POST['plantype']);
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW() GROUP BY  od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW() GROUP BY  od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    } else if (isset($_POST['subcategory']) &&  !isset($_POST['cat'])) {
        $subCat = implode("','", $_POST['subcategory']);
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   od.offer_sub_cat IN('" . $subCat . "') GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND   od.offer_sub_cat IN('" . $subCat . "') GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    } else if (isset($_POST['subcategory']) && isset($_POST['cat'])) {
        $cat = implode("','", $_POST['cat']);
        $subCat = implode("','", $_POST['subcategory']);
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND  ( od.offer_sub_cat IN('" . $subCat . "') OR od.offer_cat IN('" . $cat . "')) GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  AND  ( od.offer_sub_cat IN('" . $subCat . "') OR od.offer_cat IN('" . $cat . "')) GROUP BY  od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    } else {
        $filQ .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
        $filQ2 .= "AND CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW()  GROUP BY od.id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC";
    }
    // echo $filQ2;
    // die();
    $result = mysqli_query($con, $filQ);
    $getDealDetQ1 = mysqli_query($con, $filQ);
    $getDealDetQ24 = mysqli_query($con, $filQ2);

    $outPut = "";
    $rstCount = mysqli_num_rows($result);
    if ($rstCount > 0) {
        while ($getDealDet = mysqli_fetch_assoc($result)) {
            if ($getDealDet['deal_times'] > '0' || $getDealDet['deal_times'] == 'n/a') {

                $vendDetQ = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$getDealDet[vendor_id]' ");
                $vendDet = mysqli_fetch_array($vendDetQ);
                $outPut .= '' ?>
                <div id="listBnnersec" class="owl-carousel owl-theme">
                    <?php
                    while ($getDealDet23 = mysqli_fetch_array($getDealDetQ24)) {
                    ?>
                        <div class="top_banner_listign">
                            <div class="overlay-box">

                                <div class="brndlogo">
                                    <img src="upload/vendor-doc/brand-logo/<?= $getDealDet23['brand_logo']; ?>" class="" alt="">
                                    <p class="ec-slide-store-title mb-1"> <?= $getDealDet23['store_name'] ?></p>
                                </div>
                                <h1 class="ec-slide-title" title="<?= $getDealDet23['offer_title'] ?>"> <?= $getDealDet23['offer_title'] ?></h1>
                                <div class="ec-slide-desc">
                                    <p><?= $getDealDet23['deal_short_desc'] ?></p>
                                </div>
                                <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $getDealDet23['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" style=" height: 40px; border-radius: 10px; margin-top: 10px;" class="btn btn-lg btn-primary">Grab Deal<i class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>

                            </div>
                            <img src="upload/deals-img/<?= $getDealDet23['offer_img'] ?>" alt="">
                        </div>
                    <?php
                    }
                    ?>


                </div>

                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ec-product-content" <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? 'style="filter: grayscale(2);"' : 'onclick="location.href=deal-detail.php?' . $urltoken . '&' . $urltoken . '&&deal_id=' . $getDealDet['id'] . '&' . $urltoken . '&' . $urltoken . '"'; ?>>
                    <div class="ec-product-inner <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? 'style="cursor:not-allowed;"' : ''; ?>">
                        <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? '<div class="outStock">
                                            <p>Deal Out of Stock</p>
                                            <img src="assets/images/expired.png" width="200px" alt="dd">
                                        </div>' : ''; ?>
                        <div class="ec-pro-image-outer <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? 'srv-blur' : ''; ?>">
                            <div class="ec-pro-image">
                                <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $getDealDet['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="image">
                                    <img class="main-image" src="upload/deals-img/<?= $getDealDet['offer_img'] ?>" alt="Product" />
                                    <img class="hover-image" src="upload/deals-img/<?= $getDealDet['offer_img'] ?>" alt="Product" />
                                </a>

                                <?= ($getDealDet['deal_feature'] != "n/a") ? '<div class="offer-feature">
                                                    ' . $getDealDet['deal_feature'] . '
                                                </div>' : ''; ?>
                            </div>
                        </div>
                        <div class="ec-pro-content <?= ((($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) && ($getDealDet['deal_times'] != "n/a")) ? 'srv-blur' : ''; ?>">
                            <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $getDealDet['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>">
                                <h6 class="ec-pro-stitle"><?= $getDealDet['offer_title'] ?></h6>
                            </a>

                            <div class="ec-pro-rat-price">

                                <?php
                                $currentSrbTime = date("Y-m-d H:i");
                                $DealDteTime = $getDealDet['offer_start_date'] . ' ' . $getDealDet['offer_start_time'];




                                if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {

                                ?>
                                    <span class="timerTile2">Coming Soon</span>
                                    <p class="countdown" data-value="<?= $getDealDet['offer_start_date'] . ' ', $getDealDet['offer_start_time'] . ':00' ?>"></p>
                                <?php
                                } else {
                                ?>
                                    <span class="timerTile">Ends In</span>

                                    <p class="countdown" data-value="<?= $getDealDet['offer_end_date'] . ' ', $getDealDet['offer_end_time'] . ':00' ?>"></p>
                                <?php
                                }

                                ?>
                            </div>
                            <span class="percentage"><?= ($getDealDet['deal_times'] == "n/a") ? 'Unlimited' : '' . $getDealDet['deal_times'] . ' Remaining' ?></span>
                            <h5 class="ec-pro-title mt-1 p-0"><a><?= $vendDet['store_name'] . '<span> (' . $vendDet['store_locality'] . ')</span>' ?></a></h5>
                        </div>
                    </div>
                </div>
                <script src="assets/js/countdown.js"></script>
<?php
                '';
            }
        }
    } else {
        $outPut .= '<div class="no-prdct-found">
        <img src="assets/images/nofound.jpg" width="200px" alt="">
        <h2>Oops No Deals Found !!</h2>
        <p>In This Section No Deals Found For Grab Deal.</p>
    </div>';
    }
    echo $outPut;
}

?>