<?php
include('includes/header.php');
// print_r($_GET);
if (isset($_GET['cat_id'])) {
    $Catid = $_GET['cat_id'];
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE   CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.offer_cat ='$Catid' AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");

    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE   CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.offer_cat ='$Catid' AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
} else if (isset($_GET['RecentDeals'])) {
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND od.date_time > DATE_SUB(NOW(), INTERVAL 48 HOUR) AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY id DESC");


    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND od.date_time > DATE_SUB(NOW(), INTERVAL 48 HOUR) AND (deal_times>0 OR deal_times='n/a')  AND v.id=vb.vendor_id GROUP BY od.id ORDER BY id DESC");
} else if (isset($_GET['LastMinDeals'])) {

    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND (deal_times>0 OR deal_times='n/a') AND od.last_minute_deal='Yes' AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");

    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND (deal_times>0 OR deal_times='n/a') AND od.last_minute_deal='Yes' AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
} else if (isset($_GET['ExpireSoonDeals'])) {
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW()  AND TIMESTAMPDIFF(SECOND,NOW(),CONCAT(`offer_end_date`,' ',`offer_end_time`,':00'))>=1 AND TIMESTAMPDIFF(SECOND,NOW(),CONCAT(`offer_end_date`,' ',`offer_end_time`,':00'))<=84600 AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");

    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW()  AND TIMESTAMPDIFF(SECOND,NOW(),CONCAT(`offer_end_date`,' ',`offer_end_time`,':00'))>=1 AND TIMESTAMPDIFF(SECOND,NOW(),CONCAT(`offer_end_date`,' ',`offer_end_time`,':00'))<=84600 AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
} else if (isset($_GET['all'])) {
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
} else if (isset($_GET['upcomingDeals'])) {
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id = od.vendor_id AND CONCAT(`offer_start_date`,' ',`offer_start_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_start_date`,' ',`offer_start_time`,':00') ASC");
    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id = od.vendor_id AND CONCAT(`offer_start_date`,' ',`offer_start_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  GROUP BY od.id ORDER BY CONCAT(`offer_start_date`,' ',`offer_start_time`,':00') ASC;");
} else if (isset($_GET['vendor_id'])) {
    $vendor_id = $_GET['vendor_id'];

    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.vendor_id='$vendor_id' AND   (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");

    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.vendor_id='$vendor_id' AND (deal_times>0 OR deal_times='n/a') AND v.id=vb.vendor_id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
} else if (isset($_GET['bigsale'])) {

    $bigsale = $_GET['bigsale'];
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id = od.vendor_id AND CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.deal_times='n/a' AND v.id=vb.vendor_id ");
    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  od.status='Active' AND od.is_deleted='0' AND od.published='1' AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id = od.vendor_id AND CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.deal_times='n/a' AND v.id=vb.vendor_id ");
} else if (isset($_GET['loc_id'])) {
    $loc_id = $_GET['loc_id'];
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name,l.id as loc_id, l.locality FROM offer_deals od, vendor_brand vb, locality l WHERE CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW() AND vb.vendor_id = od.vendor_id AND vb.store_locality=l.locality AND l.id='$loc_id' AND v.id=vb.vendor_id ");
    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name,l.id as loc_id, l.locality FROM offer_deals od, vendor_brand vb, locality l WHERE CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW() AND vb.vendor_id = od.vendor_id AND vb.store_locality=l.locality AND l.id='$loc_id' AND v.id=vb.vendor_id ");
} else {
    $getDealDetQ = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id=vb.vendor_id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
    $getDealDetQ2 = mysqli_query($con, "SELECT od.*, vb.brand_logo, vb.store_name FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.id=vb.vendor_id  ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");
}


?>
<link rel="stylesheet" href="assets/css/listing.css?v1.1">

<style>
    .overlay-box .brndlogo {
        position: absolute;
        top: 10px;
        left: 15px;
    }

    .overlay-box .brndlogo img {
        width: 50px !important;
        border-radius: 10px;
        border: 2px solid #f5a705;
        padding: 5px;

        background: #fff;
    }
</style>

<!-- Page listing section -->
<section class="section ec-product-tab">
    <!-- <p><?= "SELECT * FROM `offer_deals` WHERE `status`='1' AND `is_deleted`='0' AND  CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND `vendor_id`='$vendor_id' AND   (deal_times>0 OR deal_times='n/a')" ?></p> -->
    <div class="container">
        <div class="row" id="upcomingDeal">
            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside col-lg-3 col-md-12 order-lg-first order-md-last">
                <div class="ec-pro-list-top d-flex">
                    <div class="col-md-6 ec-grid-list">
                        <div class="ec-gl-btn">
                            <button class="btn btn-list"><img src="assets/images/icons/list.svg" class="svg_img gl_svg" alt="" /></button>
                        </div>
                    </div>
                    <div class="col-md-6 ec-sort-select">
                        <span class="sort-by">Filter Products By</span>
                    </div>
                </div>
                <div id="shop_sidebar" class="">
                    <div class="ec-sidebar-heading">
                        <h1>
                            <span>Filter Products By</span>
                            <span class="closefltrside"><i class="fa fa-close"></i></span>
                        </h1>
                    </div>
                    <div class="mymaplocation">
                        <img src="assets/images/mapicon.png" alt="Map-Location" class="maplimg">
                    </div>
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">

                            <?php
                            $categorysql = mysqli_query($con, "SELECT od.*, c.cat_name FROM offer_deals od, category c, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND c.id=od.offer_cat AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() GROUP BY od.offer_cat ORDER BY `c`.`cat_name` ASC");
                            $categoryCount = mysqli_num_rows($categorysql);
                            if ($categoryCount > 0) {
                            ?>
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Category</h3>
                                </div>

                                <div class="ec-sb-block-content">
                                    <ul class="categorylst">


                                        <?php
                                        $catCount = 1;
                                        while ($categoryRow = mysqli_fetch_array($categorysql)) {
                                            $catDealCOuntQ = mysqli_query($con, "SELECT od.*, c.cat_name, c.id FROM offer_deals od, category c, vendor v, vendor_membership vm  WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND c.id=od.offer_cat AND od.offer_cat='$categoryRow[offer_cat]' AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() GROUP BY od.id;");
                                            $catDealCOunt = mysqli_num_rows($catDealCOuntQ);
                                            $catId = $categoryRow['id'];
                                            if ($catCount > 7) {
                                                $liClass = "filter_cat_li hidden_cat_li";
                                            } else {
                                                $liClass = "";
                                            }
                                        ?>

                                            <li class="<?= $liClass; ?>">
                                                <div class="ec-sidebar-block-item d-flex justify-content-between mb-2">

                                                    <label class="m-0 d-flex align-items-center">
                                                        <input type="checkbox" value="<?= $categoryRow['offer_cat']; ?>" id="catCheck<?= $catId; ?>" onclick="showSubCats(<?= $catId; ?>)" />
                                                        <p class="ml-1 mb-0"><?= $categoryRow['cat_name']; ?></p>
                                                    </label>
                                                    <small>(<?= $catDealCOunt ?>)</small>
                                                </div>
                                                <span class="py-2 subCatList" id="subCatList<?= $catId; ?>" style="display: none;">

                                                    <div class="subcat_list mb-2">
                                                        <input type="checkbox" value="<?= $categoryRow['offer_cat']; ?>" id="category" class="filterCheck subCatCheck  showAll_<?= $catId; ?>" />
                                                        <lable class="ml-1 mb-0">All</lable>
                                                    </div>
                                                    <?php

                                                    $fetchSubCat = mysqli_query($con, "SELECT sc.id, sc.sub_cat_name FROM offer_deals od, sub_category sc WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.offer_sub_cat=sc.id AND od.offer_cat='$categoryRow[offer_cat]' GROUP BY sc.id");

                                                    while ($subCat = mysqli_fetch_assoc($fetchSubCat)) {
                                                        $subCatId = $subCat['id'];
                                                        $subCatDealCOuntQ = mysqli_query($con, "SELECT od.*, c.cat_name, c.id FROM offer_deals od, category c, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND c.id=od.offer_cat AND od.offer_cat='$categoryRow[offer_cat]' AND od.offer_sub_cat='$subCatId' AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() GROUP BY od.id");
                                                        $subCatCount = mysqli_num_rows($subCatDealCOuntQ);
                                                    ?>
                                                        <div class="subcat_list">
                                                            <input type="checkbox" name="subCat" class="subCatCheck filterCheck check<?= $catId; ?>" id="subcategory" value="<?= $subCat['id']; ?>" id="subCatCheck<?= $subCat['id']; ?>">
                                                            <label for="subCatCheck<?= $subCat['id']; ?>"><?= $subCat['sub_cat_name']; ?></label>
                                                            <small>(<?= $subCatCount ?>)</small>
                                                        </div>

                                                    <?php } ?>
                                                </span>
                                            </li>

                                        <?php $catCount++;
                                        }
                                        if ($catCount > 7) { ?>
                                            <a href="javascript: void(0);" id="seeMoreCatBtn">Show more >></a>
                                        <?php   }
                                        ?>



                                    </ul>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- country filter -->

                        <!-- Sidebar Brand -->
                        <div class="ec-sidebar-block">
                            <?php
                            $brandsql = mysqli_query($con, "SELECT od.*, vb.store_name FROM offer_deals od, vendor_brand vb, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND od.status='Active' AND vb.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND od.is_deleted='0' GROUP BY od.vendor_id ORDER BY `vb`.`store_name` ASC");
                            $brandCount = mysqli_num_rows($brandsql);
                            if ($brandCount > 0) {
                            ?>

                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title"><a href="brands.php">Brands</a></h3>
                                </div>

                                <div class="ec-sb-block-content">
                                    <ul>

                                        <?php
                                        $brandNum = 1;
                                        while ($brandRow = mysqli_fetch_array($brandsql)) {
                                            $venDealCOuntQ = mysqli_query($con, "SELECT od.*, vb.store_name FROM offer_deals od, vendor_brand vb WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id  AND  `vb`.`vendor_id`='$brandRow[vendor_id]' AND od.status='Active' AND od.is_deleted='0' AND od.published='1' ");


                                            $venDealCOunt = mysqli_num_rows($venDealCOuntQ);
                                            if ($brandNum > 7) {
                                                $liClass = "filter_brand_li hidden_brand_li";
                                            } else {
                                                $liClass = "";
                                            }
                                        ?>
                                            <li class="<?= $liClass; ?>">
                                                <div class="ec-sidebar-block-item d-flex justify-content-between">
                                                    <label class="m-0 d-flex align-items-center">
                                                        <input type="checkbox" class="filterCheck" value="<?= $brandRow['vendor_id'] ?>" id="stores" />
                                                        <p class="ml-1"><?= $brandRow['store_name']; ?></p>
                                                    </label>
                                                    <small>(<?= $venDealCOunt ?>)</small>
                                                </div>
                                            </li>
                                        <?php $brandNum++;
                                        }
                                        if ($brandNum > 2) { ?>
                                            <a href="javascript: void(0);" id="seeMoreBrandBtn">Show more >></a>
                                        <?php } ?>

                                    </ul>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="ec-sidebar-block">
                            <?php
                            $brandsql = mysqli_query($con, "SELECT l.locality FROM offer_deals od, vendor_brand vb, locality l, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND vm.vendor_id=vb.vendor_id AND vm.expire_date>NOW() AND l.locality=vb.store_locality GROUP BY l.locality");
                            $brandCount = mysqli_num_rows($brandsql);
                            if ($brandCount > 0) {
                            ?>

                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Locations</h3>
                                </div>

                                <div class="ec-sb-block-content">
                                    <ul>

                                        <?php
                                        $locationCount = 1;
                                        while ($brandRow = mysqli_fetch_array($brandsql)) {
                                            $venDealCOuntQ = mysqli_query($con, "SELECT od.*, vb.store_name, vb.store_locality FROM offer_deals od, vendor_brand vb WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id   AND od.status='Active' AND od.is_deleted='0' AND od.published='1'AND vb.store_locality= '$brandRow[locality]'; ");

                                            // echo "SELECT od.*, vb.store_name, vb.store_locality FROM offer_deals od, vendor_brand vb WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id   AND od.status='Active' AND od.is_deleted='0' AND od.published='1'AND vb.store_locality= '$brandRow[store_locality]';";



                                            $venDealCOunt = mysqli_num_rows($venDealCOuntQ);
                                            if ($locationCount > 7) {
                                                $liClass = "filter_loc_li hidden_loc_li";
                                            } else {
                                                $liClass = "";
                                            }
                                        ?>

                                            <li class="<?= $liClass; ?>">
                                                <div class="ec-sidebar-block-item d-flex justify-content-between">
                                                    <label class="m-0 d-flex align-items-center">
                                                        <input type="checkbox" class="filterCheck" value="<?= $brandRow['locality'] ?>" id="location" />
                                                        <p class="ml-1"><?= $brandRow['locality']; ?></p>
                                                    </label>
                                                    <small>(<?= $venDealCOunt ?>)</small>
                                                </div>
                                            </li>
                                        <?php
                                            $locationCount++;
                                        }
                                        if ($locationCount > 7) { ?>
                                            <a href="javascript: void(0);" id="seeMoreLocBtn">Show more >></a>
                                        <?php }  ?>


                                    </ul>
                                </div>
                            <?php } ?>

                        </div>

                        <div class="ec-sidebar-block">
                            <?php
                            $brandsql = mysqli_query($con, "SELECT  vd.plan_type FROM offer_deals od, vendor_brand vb, vendor vd, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND vd.id=od.vendor_id AND od.status='Active' AND vm.vendor_id=vd.id AND vm.expire_date>NOW() AND od.is_deleted='0' GROUP BY vd.plan_type ORDER BY `vd`.`plan_type` ASC");

                            $brandCount = mysqli_num_rows($brandsql);
                            if ($brandCount > 0) {
                            ?>
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Type</h3>
                                </div>

                                <div class="ec-sb-block-content">
                                    <ul>
                                        <li>
                                            <!-- type all  -->
                                            <?php

                                            $venDealCOuntAll = mysqli_num_rows(mysqli_query($con, "SELECT od.*, vb.store_name, vb.store_locality, vd.plan_type FROM offer_deals od, vendor_brand vb, vendor vd, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND vd.id=od.vendor_id AND vm.vendor_id=vd.id AND vm.expire_date>NOW() AND vd.is_deleted='0' GROUP BY od.id")); ?>

                                            <div class="ec-sidebar-block-item d-flex justify-content-between">
                                                <label class="m-0 d-flex align-items-center">
                                                    <input type="checkbox" class="filterCheck" value="all" id="plantype" />
                                                    <p class="ml-1">All</p>
                                                </label>
                                                <small>(<?= $venDealCOuntAll ?>)</small>
                                            </div>
                                        </li>



                                        <li>
                                            <?php

                                            $venDealCOuntEco = mysqli_num_rows(mysqli_query($con, "SELECT od.*, vb.store_name, vb.store_locality, vd.plan_type FROM offer_deals od, vendor_brand vb, vendor vd, vendor_membership vm  WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND vd.id=od.vendor_id AND vm.vendor_id=vd.id AND vm.expire_date>NOW() AND vd.is_deleted='0' AND vd.plan_type='Economy' GROUP BY od.id")); ?>
                                            <div class="ec-sidebar-block-item d-flex justify-content-between">
                                                <label class="m-0 d-flex align-items-center">
                                                    <input type="checkbox" class="filterCheck" value="Economy" id="plantype">
                                                    <p class="ml-1">Economy</p>
                                                </label>
                                                <small>(<?= $venDealCOuntEco ?>)</small>
                                            </div>
                                        </li>

                                        <li>
                                            <?php

                                            $venDealCOuntPre = mysqli_num_rows(mysqli_query($con, "SELECT od.*, vb.store_name, vb.store_locality, vd.plan_type FROM offer_deals od, vendor_brand vb, vendor vd, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND vd.id=od.vendor_id AND vm.vendor_id=vd.id AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND vm.expire_date>NOW() AND vd.is_deleted='0' AND vd.plan_type='Premium' GROUP BY od.id")); ?>
                                            <div class="ec-sidebar-block-item d-flex justify-content-between">
                                                <label class="m-0 d-flex align-items-center">
                                                    <input type="checkbox" class="filterCheck" value="Premium" id="plantype">
                                                    <p class="ml-1">Premium</p>
                                                </label>
                                                <small>(<?= $venDealCOuntPre ?>)</small>
                                            </div>
                                        </li>

                                        <li>
                                            <?php

                                            $venDealCOuntLux = mysqli_num_rows(mysqli_query($con, "SELECT od.*, vb.store_name, vb.store_locality, vd.plan_type FROM offer_deals od, vendor_brand vb, vendor vd, vendor_membership vm  WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND od.status='Active' AND od.is_deleted='0' AND od.published='1' AND vd.id=od.vendor_id AND vm.vendor_id=vd.id AND vm.expire_date>NOW() AND vd.is_deleted='0' AND vd.plan_type='Luxury' GROUP BY od.id")); ?>
                                            <div class="ec-sidebar-block-item d-flex justify-content-between">
                                                <label class="m-0 d-flex align-items-center">
                                                    <input type="checkbox" class="filterCheck" value="Luxury" id="plantype">
                                                    <p class="ml-1">Luxury</p>
                                                </label>
                                                <small>(<?= $venDealCOuntLux ?>)</small>
                                            </div>
                                        </li>




                                    </ul>
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- Shop Top Start -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="maplocation_div" style="display:none;">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
                <!-- Shop Top End -->

                <div class="row mylistingpg">

                    <div class="filterhtml">
                        <div class="row mylistingpg" id="filter">

                            <div id="listBnnersec" class="owl-carousel owl-theme">
                                <?php
                                $arr = array();
                                $sarr = array();

                                if (isset($_GET['cat_id'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet2254['offer_start_date'] . ' ' . $getDealDet2254['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr[] = $getDealDet2254;
                                        } else {
                                            $arr[] = $getDealDet2254;
                                        }
                                    }
                                } else if (isset($_GET['RecentDeals'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {


                                        $arr[] = $getDealDet2254;
                                    }
                                } else if (isset($_GET['LastMinDeals'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet2254['offer_start_date'] . ' ' . $getDealDet2254['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr[] = $getDealDet2254;
                                        } else {
                                            $arr[] = $getDealDet2254;
                                        }
                                    }
                                } else if (isset($_GET['ExpireSoonDeals'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet2254['offer_start_date'] . ' ' . $getDealDet2254['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr[] = $getDealDet2254;
                                        } else {
                                            $arr[] = $getDealDet2254;
                                        }
                                    }
                                } else if (isset($_GET['all'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet2254['offer_start_date'] . ' ' . $getDealDet2254['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr[] = $getDealDet2254;
                                        } else {
                                            $arr[] = $getDealDet2254;
                                        }
                                    }
                                } else if (isset($_GET['upcomingDeals'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet2254['offer_start_date'] . ' ' . $getDealDet2254['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr[] = $getDealDet2254;
                                        } else {
                                            $arr[] = $getDealDet2254;
                                        }
                                    }
                                } else if (isset($_GET['vendor_id'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {
                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet2254['offer_start_date'] . ' ' . $getDealDet2254['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr[] = $getDealDet2254;
                                        } else {
                                            $arr[] = $getDealDet2254;
                                        }
                                    }
                                } else if (isset($_GET['bigsale'])) {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {

                                        $arr[] = $getDealDet2254;
                                    }
                                } else {
                                    while ($getDealDet2254 = mysqli_fetch_array($getDealDetQ2)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet2254['offer_start_date'] . ' ' . $getDealDet2254['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr[] = $getDealDet2254;
                                        } else {
                                            $arr[] = $getDealDet2254;
                                        }
                                    }
                                }
                                if (!empty($sarr))
                                    $arr = array_merge($arr, $sarr);

                                // print_r($arr);

                                foreach ($arr as $getDealDet22) {
                                ?>
                                    <div class="top_banner_listign">
                                        <div class="overlay-box">
                                            <div class="brndlogo">
                                                <img src="upload/vendor-doc/brand-logo/<?= $getDealDet22['brand_logo']; ?>" class="" alt="">
                                                <p class="ec-slide-store-title mb-1"> <?= $getDealDet22['store_name'] ?></p>
                                            </div>
                                            <h1 class="ec-slide-title" title="<?= $getDealDet22['offer_title'] ?>"> <?= $getDealDet22['offer_title'] ?></h1>
                                            <div class="ec-slide-desc">
                                                <p><?= $getDealDet22['deal_short_desc'] ?></p>
                                            </div>
                                            <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $getDealDet22['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" style=" height: 40px; border-radius: 10px; margin-top: 10px;" class="btn btn-lg btn-primary">Grab Deal<i class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                        <img src="upload/deals-img/<?= $getDealDet22['offer_img'] ?>" alt="">
                                    </div>
                                <?php
                                }
                                ?>


                            </div>
                            <?php

                            if (mysqli_num_rows($getDealDetQ) > 0) {
                            ?>

                                <?php
                                $arr1 = array();
                                $sarr1 = array();
                                if (isset($_GET['cat_id'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet34['offer_start_date'] . ' ' . $getDealDet34['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr1[] = $getDealDet34;
                                        } else {
                                            $arr1[] = $getDealDet34;
                                        }
                                    }
                                } else if (isset($_GET['RecentDeals'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {


                                        $arr1[] = $getDealDet34;
                                    }
                                } else if (isset($_GET['LastMinDeals'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet34['offer_start_date'] . ' ' . $getDealDet34['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr1[] = $getDealDet34;
                                        } else {
                                            $arr1[] = $getDealDet34;
                                        }
                                    }
                                } else if (isset($_GET['ExpireSoonDeals'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet34['offer_start_date'] . ' ' . $getDealDet34['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr1[] = $getDealDet34;
                                        } else {
                                            $arr1[] = $getDealDet34;
                                        }
                                    }
                                } else if (isset($_GET['all'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet34['offer_start_date'] . ' ' . $getDealDet34['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr1[] = $getDealDet34;
                                        } else {
                                            $arr1[] = $getDealDet34;
                                        }
                                    }
                                } else if (isset($_GET['upcomingDeals'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet34['offer_start_date'] . ' ' . $getDealDet34['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr1[] = $getDealDet34;
                                        } else {
                                            $arr1[] = $getDealDet34;
                                        }
                                    }
                                } else if (isset($_GET['vendor_id'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet34['offer_start_date'] . ' ' . $getDealDet34['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr1[] = $getDealDet34;
                                        } else {
                                            $arr1[] = $getDealDet34;
                                        }
                                    }
                                } else if (isset($_GET['bigsale'])) {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {


                                        $arr[] = $getDealDet34;
                                    }
                                } else {
                                    while ($getDealDet34 = mysqli_fetch_array($getDealDetQ)) {

                                        $currentSrbTime = date("Y-m-d H:i");
                                        $DealDteTime = $getDealDet34['offer_start_date'] . ' ' . $getDealDet34['offer_start_time'];




                                        if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                            $sarr1[] = $getDealDet34;
                                        } else {
                                            $arr1[] = $getDealDet34;
                                        }
                                    }
                                }
                                if (!empty($sarr1))
                                    $arr = array_merge($arr1, $sarr1);
                                // echo count($arr);
                                $temp = array_unique(array_column($arr, 'id'));
                                $unique_arr = array_intersect_key($arr, $temp);

                                foreach ($unique_arr as $getDealDet) {

                                    if ($getDealDet['deal_times'] > '0' || $getDealDet['deal_times'] == 'n/a') {
                                        $vendDetQ = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$getDealDet[vendor_id]' ");
                                        $vendDet = mysqli_fetch_array($vendDetQ);                            ?>



                                        <!-- Shop Top End -->
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ec-product-content" <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? 'style="filter: grayscale(2);"' : 'onclick="location.href=deal-detail.php?' . $urltoken . '&' . $urltoken . '&&deal_id=' . $getDealDet['id'] . '&' . $urltoken . '&' . $urltoken . '"'; ?>>
                                            <div class="ec-product-inner <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? 'style="cursor:not-allowed;"' : ''; ?>">
                                                <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? '<div class="outStock"> <p>Deal Out of Stock</p> <img src="assets/images/expired.png" width="200px" alt="dd"> </div>' : ''; ?>
                                                <div class="ec-pro-image-outer <?= (($getDealDet['deal_times'] == 0) && ($getDealDet['deal_times'] != "n/a")) ? 'srv-blur' : ''; ?>">
                                                    <div class="ec-pro-image">
                                                        <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $getDealDet['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="image">
                                                            <img class="main-image" src="upload/deals-img/<?= $getDealDet['offer_img'] ?>" alt="Product" />
                                                            <img class="hover-image" src="upload/deals-img/<?= $getDealDet['offer_img'] ?>" alt="Product" />
                                                        </a>

                                                        <?= ($getDealDet['deal_feature'] != "n/a") ? '<div class="offer-feature">' . $getDealDet['deal_feature'] . '</div>' : ''; ?>
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

                                <?php
                                    } else {
                                    }
                                }
                            } else {
                                ?>
                                <div class="no-prdct-found">
                                    <img src="assets/images/nofound.jpg" width="200px" alt="">
                                    <h2>Oops No Deals Found !!</h2>
                                    <p>In This Section No Deals Found For Grab Deal.</p>
                                </div>
                            <?php
                            }

                            ?>



                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</section>
<?php include('includes/footer.php'); ?>
<script src="assets/js/countdown.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>
<script>
    var filterCatLi = document.querySelectorAll('.filter_cat_li');
    $('#seeMoreCatBtn').on('click', function() {
        filterCatLi.forEach(element => {
            $(element).toggleClass('hidden_cat_li');
        });
        if ($('#seeMoreCatBtn').text() == 'Show less >>') {
            $('#seeMoreCatBtn').text('Show more >>');
        } else {
            $('#seeMoreCatBtn').text('Show less >>');
        }
    });
    var filterBrandLi = document.querySelectorAll('.filter_brand_li');
    $('#seeMoreBrandBtn').on('click', function() {
        filterBrandLi.forEach(element => {
            $(element).toggleClass('hidden_brand_li');
        });
        if ($('#seeMoreBrandBtn').text() == 'Show less >>') {
            $('#seeMoreBrandBtn').text('Show more >>');
        } else {
            $('#seeMoreBrandBtn').text('Show less >>');
        }
    });
    var filterLocLi = document.querySelectorAll('.filter_loc_li');
    $('#seeMoreLocBtn').on('click', function() {
        filterLocLi.forEach(element => {
            $(element).toggleClass('hidden_loc_li');
        });
        if ($('#seeMoreLocBtn').text() == 'Show less >>') {
            $('#seeMoreLocBtn').text('Show more >>');
        } else {
            $('#seeMoreLocBtn').text('Show less >>');
        }
    });
</script>
<script>
    var icons = {
        deal: {
            icon: "https://tarantelleromane.files.wordpress.com/2016/10/map-marker.png?w=50",
        },
    };

    <?php

    $position = array();
    $venderLocQ = mysqli_query($con, "SELECT od.vendor_id, v.latitude, v.longtitude, vb.store_name, vb.store_desc, vb.store_location FROM offer_deals od, vendor v, vendor_membership vm, vendor_brand vb WHERE od.vendor_id=v.id AND v.id=vb.vendor_id AND od.is_deleted='0' AND v.is_deleted='0' AND vm.expire_date>NOW() AND od.status='Active'  GROUP BY od.vendor_id;");
    while ($venderLoc = mysqli_fetch_assoc($venderLocQ)) {

        $var = '<div id=\"content\"><div id=\"siteNotice\"></div><h1 id=\"firstHeading\" class=\"firstHeading\">' . $venderLoc["store_name"] . '</h1><div id=\"bodyContent\"><p>' . $venderLoc["store_location"] . '</p> <p><a href=\"listing.php?' . $urltoken . '&' . $urltoken . '&vendor_id=' . $venderLoc["vendor_id"] . '&' . $urltoken . '&' . $urltoken . '\">VISIT STORE</a></p></div></div>';
        $title = "abc";
        $position[] = array('title' => $venderLoc["store_name"], 'position' => array('lat' => $venderLoc['latitude'], 'lng' => $venderLoc['longtitude']), 'icon' => 'deal', 'content' => $var);
    }
    // print_r($position);
    ?>
    var airports = jQuery.parseJSON('<?= json_encode($position) ?>');
    console.log(airports);


    function initMap() {
        var india = {
            lat: 28.7041,
            lng: 77.1025,
        };

        var map = new google.maps.Map(document.getElementById("map"), {
            zoom: 12,
            center: india,
            disableDefaultUI: true,
        });

        var InfoWindows = new google.maps.InfoWindow({});
        for (var a = 0; a < airports.length; a++) {
            let contentsss = airports[a].content;
            console.log(contentsss);
            // airports.forEach(function(airport) {
            var marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(airports[a].position.lat),
                    lng: parseFloat(airports[a].position.lng)
                },
                map: map,
                icon: icons[airports[a].icon].icon,
                title: airports[a].title
            });
            marker.addListener("mouseover", function() {
                InfoWindows.open(map, this);
                InfoWindows.setContent(contentsss);
            });
        };
    }
</script>
<script>
    $(document).ready(function() {

        $(document).on("click", ".morefilcat", function() {
            $(".showmorefiltcat").toggle();
        });

        $(document).on("click", ".maplimg", function() {
            $(".maplocation_div").toggle();
        });

        // listing page filter sidebar js
        $(document).on("click", ".ec-gl-btn", function() {

            $("#shop_sidebar").addClass("open-list-filt");
            $("body").css("overflow-y", "hidden");
            $(".ec-side-cart-overlay").show();

        });

        $(document).on("click", ".closefltrside", function() {
            $('#shop_sidebar').removeClass("open-list-filt");
            $(".ec-side-cart-overlay").hide();
            $("body").css("overflow-y", "auto");
        });

        const $menu = $('#shop_sidebar');
        $(document).mouseup(e => {
            if (!$menu.is(e.target) &&
                $menu.has(e.target).length === 0) {
                $('#shop_sidebar').removeClass("open-list-filt");
                $(".ec-side-cart-overlay").hide();
                $("body").css("overflow-y", "auto");
            }
        });


    });
</script>



<script>
    $(document).ready(function() {
        $(document).on("click", ".filterCheck", function() {
            var action = 'data';
            var cat = get_filter_data('category');
            var subCat = get_filter_data('subcategory');
            var stores = get_filter_data('stores');
            var location = get_filter_data('location');
            var plantype = get_filter_data('plantype');

            $.ajax({
                url: 'ajax/filter.php',
                method: 'post',
                data: {
                    action: action,
                    cat: cat,
                    subcategory: subCat,
                    stores: stores,
                    location: location,
                    plantype: plantype
                },
                success: function(response) {
                    $("#filter").html(response);
                    $('#listBnnersec').owlCarousel({
                        center: false,
                        items: 2,
                        loop: true,
                        nav: true,
                        navText: ["<div class='nav-button owl-prev'><img src='assets/images/left-arrow.png'></div>", "<div class='nav-button owl-next'><img src='assets/images/right-arrow.png'></div>"],
                        dots: false,
                        margin: 5,
                        smartSpeed: 2000,
                        autoplay: true,
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 1,
                                nav: true
                            },
                            600: {
                                items: 1,
                                nav: true
                            },
                            1000: {
                                items: 2,
                                nav: true
                            },
                            1100: {
                                items: 2,
                                nav: true
                            }

                        }

                    });
                }
            });

            $.ajax({
                url: 'ajax/map-filter.php',
                method: 'post',
                data: {
                    action: action,
                    cat: cat,
                    subcategory: subCat,
                    stores: stores,
                    location: location,
                    plantype: plantype
                },
                success: function(response) {
                    var airports = jQuery.parseJSON(response);
                    console.log(airports);
                    initMap();

                    function initMap() {
                        var india = {
                            lat: 28.7041,
                            lng: 77.1025,
                        };

                        var map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 12,
                            center: india,
                            disableDefaultUI: true,
                        });

                        var InfoWindows = new google.maps.InfoWindow({});
                        for (var a = 0; a < airports.length; a++) {
                            let contentsss = airports[a].content;
                            console.log(contentsss);
                            // airports.forEach(function(airport) {
                            var marker = new google.maps.Marker({
                                position: {
                                    lat: parseFloat(airports[a].position.lat),
                                    lng: parseFloat(airports[a].position.lng)
                                },
                                map: map,
                                icon: icons[airports[a].icon].icon,
                                title: airports[a].title
                            });
                            marker.addListener("mouseover", function() {
                                InfoWindows.open(map, this);
                                InfoWindows.setContent(contentsss);
                            });
                        };
                    }
                }
            });
        });



        function get_filter_data(text_id) {
            var filter_data = [];
            $('#' + text_id + ':checked').each(function() {
                filter_data.push($(this).val());
            });
            return filter_data;
        }
    });
</script>

<script>
    function showSubCats(id) {
        var showAll = document.querySelector('.showAll_' + id)
        var catCheck = document.getElementById('catCheck' + id)

        if (!catCheck.checked && showAll.checked) {
            $('.showAll_' + id).click();
        } else if (catCheck.checked && !showAll.checked) {
            $('.showAll_' + id).click();
        }

        var subCatList = document.getElementById('subCatList' + id);
        if (subCatList.style.display == 'none') {
            subCatList.style.display = 'block'
        } else {
            subCatList.style.display = 'none'
            var checks = document.querySelectorAll('.check' + id);
            checks.forEach(element => {
                if (element.checked == true) {
                    $(element).click()

                };
            });
        }
    }
</script>

<script>
    $('#listBnnersec').owlCarousel({
        center: false,
        items: 2,
        loop: true,
        nav: true,
        navText: ["<div class='nav-button owl-prev'><img src='assets/images/left-arrow.png'></div>", "<div class='nav-button owl-next'><img src='assets/images/right-arrow.png'></div>"],
        dots: false,
        margin: 5,
        smartSpeed: 2000,
        autoplay: false,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 1,
                nav: true
            },
            1000: {
                items: 2,
                nav: true
            },
            1100: {
                items: 2,
                nav: true
            }

        }

    });
</script>