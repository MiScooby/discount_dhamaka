<?php
ob_start();
session_start();
// print_r($_SESSION);
// die;
include('admin/ajax/config.php');
if (isset($_SESSION['LoggedInUser'])) {
    $userBySession = $_SESSION['LoggedInUser'];
    $getUser_det = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name`='$userBySession' ");
    $UseR = mysqli_fetch_array($getUser_det);
}


$url = $_SERVER['PHP_SELF'];
$target = explode('/', $url);
$page = end($target);

$totalDealQ = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND (deal_times>0 OR deal_times='n/a') GROUP BY od.id ORDER BY CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') ASC");

$totalDealCount = mysqli_num_rows($totalDealQ);

$LastMintDealQ = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND (deal_times>0 OR deal_times='n/a') AND od.last_minute_deal='Yes' AND vm.vendor_id=v.id AND vm.expire_date>NOW() GROUP BY od.id");

$LastMintDealCount = mysqli_num_rows($LastMintDealQ);

$RecentDealsQ = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND v.is_deleted='0' AND od.date_time > DATE_SUB(NOW(), INTERVAL 48 HOUR) AND (deal_times>0 OR deal_times='n/a') GROUP BY od.id ORDER BY `id` DESC");
$RecentDealsCount = mysqli_num_rows($RecentDealsQ);

$ExpireSoonQ = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND TIMESTAMPDIFF(SECOND,NOW(),CONCAT(`offer_end_date`,' ',`offer_end_time`,':00'))>=1 AND TIMESTAMPDIFF(SECOND,NOW(),CONCAT(`offer_end_date`,' ',`offer_end_time`,':00'))<=84600 AND (deal_times>0 OR deal_times='n/a') GROUP BY od.id");
$ExpireSoonCount = mysqli_num_rows($ExpireSoonQ);

// for JS timer counter expire soon sql
$totalDealQ1 = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.published='1' AND od.status='Active' AND od.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND od.vendor_id=v.id AND v.is_deleted='0' AND (deal_times>0 OR deal_times='n/a') GROUP BY od.id");
$totalDealCount = mysqli_num_rows($totalDealQ);
// end here

$UpCOmingDealQ = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND  CONCAT(`offer_start_date`,' ',`offer_start_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') GROUP BY od.id");
$UpCOmingDealCount = mysqli_num_rows($UpCOmingDealQ);

$BigSaleDealQ = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND deal_times='n/a' GROUP BY od.id");
$BigSaleDealCount = mysqli_num_rows($BigSaleDealQ);


$DealofDaytQ = mysqli_query($con, "SELECT od.* FROM offer_deals od, vendor v, vendor_membership vm WHERE od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() AND od.deal_of_the_day='Yes' AND CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') GROUP BY od.id");
$DealofDaytQCount = mysqli_num_rows($DealofDaytQ);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <?php $get_url = $_SERVER['REQUEST_URI'];

    $url = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
    if (isset($url)) {
        if ($url == '' || $url == 'index.php') { ?>
            <title>Discount Dhamaka - Big Discount Bigger Savings</title>
            <link rel="manifest" href="/manifest.json">
            <meta name="description" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta name="Title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta name="robots" content="index, follow" />
            <meta name="Owner" content="Discount Dhamaka" />
            <meta name="Author" content="Discount Dhamaka" />
            <meta property="og:title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta property="og:type" content="Discount Dhamaka" />
            <meta property="og:url" content="https://discountdhamaka.in/" ; />
            <meta property="og:image" content="https://micodetest.com/discount_dhamaka_new/assets/images/logo/logo-8.png" ; />
            <meta property="og:description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
            <link rel="canonical" href="https://discountdhamaka.in/" ; />
            <link rel="alternate" href="https://discountdhamaka.in/" ; hreflang="en-us" />

        <?php
        } elseif ($url == 'about.php') { ?>
            <title>About Discount Dhamaka - Big Discount Bigger Savings</title>
            <link rel="manifest" href="/manifest.json">
            <meta name="description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
            <meta name="Keywords" content="" />
            <meta name="Title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta name="robots" content="index, follow" />
            <meta name="Owner" content="Discount Dhamaka" />
            <meta name="Author" content="Discount Dhamaka" />
            <meta property="og:title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta property="og:type" content="Discount Dhamaka" />
            <meta property="og:url" content="https://discountdhamaka.in/" ; />
             <meta property="og:image" content="https://micodetest.com/discount_dhamaka_new/assets/images/logo/logo-8.png" ; />
            <meta property="og:description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
            <link rel="canonical" href="https://discountdhamaka.in/" ; />
            <link rel="alternate" href="https://discountdhamaka.in/" ; hreflang="en-us" />

        <?php
        } elseif ($url == 'contact.php') { ?>
            <title>Contact Discount Dhamaka - Big Discount Bigger Savings</title>
            <link rel="manifest" href="/manifest.json">
            <meta name="description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
            <meta name="Keywords" content="" />
            <meta name="Title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta name="robots" content="index, follow" />
            <meta name="Owner" content="Discount Dhamaka" />
            <meta name="Author" content="Discount Dhamaka" />
            <meta property="og:title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta property="og:type" content="Discount Dhamaka" />
            <meta property="og:url" content="https://discountdhamaka.in/" ; />
             <meta property="og:image" content="https://micodetest.com/discount_dhamaka_new/assets/images/logo/logo-8.png" ; />
            <meta property="og:description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
            <link rel="canonical" href="https://discountdhamaka.in/" ; />
            <link rel="alternate" href="https://discountdhamaka.in/" ; hreflang="en-us" />

        <?php
        } elseif ($url == 'deal-detail.php') {
            $id = $_GET['deal_id'];
            $getDealDetQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `id`='$id' ");
            $getDealsDetHeae = mysqli_fetch_array($getDealDetQ);
        ?>
            <title><?= ucfirst($getDealsDetHeae['offer_title']) ?> - Discount Dhamaka</title>
            <link rel="manifest" href="/manifest.json">
            <meta name="description" content="<?= $getDealsDetHeae['deal_short_desc'] ?>" />
            <meta name="Keywords" content="" />
            <meta name="Title" content="<?= ucfirst($getDealsDetHeae['offer_title']) ?> - Discount Dhamaka" />
            <meta name="robots" content="index, follow" />
            <meta name="Owner" content="Discount Dhamaka" />
            <meta name="Author" content="Discount Dhamaka" />
            <link rel="canonical" href="https://discountdhamaka.in/" ; />
            <link rel="alternate" href="https://discountdhamaka.in/" ; hreflang="en-us" />

            <meta property="og:title" content="<?= ucfirst($getDealsDetHeae['offer_title']) ?> - Discount Dhamaka">
            <meta property="og:description" content="<?= $getDealsDetHeae['deal_short_desc'] ?>">
            <meta property="og:image" content="https://micodetest.com/discount_dhamaka_new/upload/deals-img/<?= $getDealsDetHeae['offer_img'] ?>">
            <meta property="og:url" content="https://discountdhamaka.in/">
            <meta property="og:type" content="Discount Dhamaka">
            <meta property="og:site_name" content="Discount Dhamaka">

        <?php
        } else {
        ?>
            <title>Discount Dhamaka - Big Discount Bigger Savings</title>
            <link rel="manifest" href="/manifest.json">
            <meta name="description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
            <meta name="Keywords" content="" />
            <meta name="Title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta name="robots" content="index, follow" />
            <meta name="Owner" content="Discount Dhamaka" />
            <meta name="Author" content="Discount Dhamaka" />
            <meta property="og:title" content="Discount Dhamaka - Big Discount Bigger Savings" />
            <meta property="og:type" content="Discount Dhamaka" />
            <meta property="og:url" content="" ; />
             <meta property="og:image" content="https://micodetest.com/discount_dhamaka_new/assets/images/logo/logo-8.png" ; />
            <meta property="og:description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
            <link rel="canonical" href="https://discountdhamaka.in/" ; />
            <link rel="alternate" href="https://discountdhamaka.in/" ; hreflang="en-us" />
        <?php
        }
    } else { ?>
        <title>Discount Dhamaka - Big Discount Bigger Savings</title>
        <link rel="manifest" href="/manifest.json">
        <meta name="description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
        <meta name="Keywords" content=" " />
        <meta name="Title" content="Discount Dhamaka - Big Discount Bigger Savings" />
        <meta name="robots" content="index, follow" />
        <meta name="Owner" content="Discount Dhamaka" />
        <meta name="Author" content="Discount Dhamaka" />
        <meta property="og:title" content="Discount Dhamaka - Big Discount Bigger Savings" />
        <meta property="og:type" content="Discount Dhamaka" />
        <meta property="og:url" content="" ; />
         <meta property="og:image" content="https://micodetest.com/discount_dhamaka_new/assets/images/logo/logo-8.png" ; />
        <meta property="og:description" content="Welcome to DiscountDhamaka, North West Delhi’s best online Deals platform conceptualized specifically for our customers of this area during these challenging and demanding times due to the spread of Covid-19." />
        <link rel="canonical" href="https://discountdhamaka.in/" ; />
            <link rel="alternate" href="https://discountdhamaka.in/" ; hreflang="en-us" />
    <?php } ?>

    <!-- site Favicon -->
    <link rel="icon" href="assets/images/favicon/favicon-8.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="assets/images/favicon/favicon-8.png" />
    <meta name="msapplication-TileImage" content="assets/images/favicon/favicon-8.png" />

    <!-- css Icon Font -->
    <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="assets/css/plugins/nouislider.css" />
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/owl.carousel.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/owl.theme.default.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/main.css?v1.3" />
    <link rel="stylesheet" href="assets/css/srb-custom.css?v1.2" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/sweetalert2/sweetalert2.min.css">


    <style>
        button.ec-close img {
            height: 27px;
        }

        .clo_cat_bnt {
            position: absolute;
            right: 10px;
            top: 10px;
        }

        @media(max-width:768px) {
            .top-mob-right-srb {
                text-align: right;
                color: #fff;
                display: flex;
                justify-content: flex-end;
                align-items: center;
            }

            .top-right-user-loc {
                color: #444444;
                border-radius: 4px;
                position: relative;
                cursor: pointer;
                left: 10px;
                font-weight: 400;
                font-size: 13px;
                line-height: 15px;
            }

            .top-right-user-loc strong {
                font-weight: 600;
            }

            #ec-overlay {
                display: none;
            }

            .mylcs {
                font-size: 10px;
            }
        }
    </style>

</head>


<body>
    <div id="ec-overlay"><span class="loader_img"></span></div>
    <!-- Header start  -->
    <header class="ec-header ">

        <!-- Ec Header Bottom  Start -->
        <div class="ec-header-bottom d-none d-lg-block">
            <div class="container position-relative">
                <div class="row">
                    <div class="ec-flex">
                        <!-- Ec Header Logo Start -->
                        <div class="align-self-center">
                            <div class="header-logo">
                                <a href="index.php"><img src="assets/images/logo/logo-8.png" alt="Site Logo" /><img class="dark-logo" src="assets/images/logo/dark-logo-8.png" alt="Site Logo" style="display: none;" /></a>
                            </div>
                        </div>
                        <!-- Ec Header Logo End -->

                        <!-- Ec Header Search Start -->
                        <div class="align-self-center">
                            <div class="header-search">
                                <form class="ec-btn-group-form" action="#">
                                    <div class="myheadsrcdiv">
                                        <select name="country" disabled class="headselect form-control select_2_1">
                                            <option value="">Select Country</option>

                                            <option value="Delhi" selected>New Delhi</option>

                                        </select>

                                        <div class="inputsrch">
                                            <input class="form-control" placeholder="Enter Brand or Deals Name..." type="text" id="searchFiledTop">

                                            <div id="searchResult">
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Ec Header Search End -->

                        <!-- Ec Header Button Start -->
                        <div class="align-self-center">
                            <div class="ec-header-bottons">

                                <!-- Header User Start -->

                                <div class="ec-header-user dropdown">
                                    <?php
                                    if (isset($_SESSION['LoggedInVendor'])) {
                                        $vendorBySession = $_SESSION['LoggedInVendor'];
                                        $getVndr_det = mysqli_query($con, "SELECT * FROM `vendor` WHERE `user_name`='$vendorBySession' AND `status`='Active' ");
                                        $VenDor = mysqli_fetch_array($getVndr_det);
                                    ?>
                                        <a href="vendor-profile.php" class="ec-header-btn">
                                            <div><img src="assets/images/icons/store.svg" class="svg_img header_svg" alt="" /></div>
                                            <?= (isset($_SESSION['LoggedInVendor'])) ? '<span style="padding-left: 5px; font-weight:600;">' . $VenDor['f_name'] . '</span>' : ''; ?>

                                        </a>
                                    <?php
                                    } else if (isset($_SESSION['LoggedInUser'])) {
                                        $userBySession = $_SESSION['LoggedInUser'];
                                        $getUser_det = mysqli_query($con, "SELECT * FROM `user` WHERE `user_name`='$userBySession' AND `status`='Active' ");
                                        $UseR = mysqli_fetch_array($getUser_det);
                                    ?>
                                        <a href="profile.php" class="ec-header-btn">
                                            <div><img src="assets/images/icons/user.svg" class="svg_img header_svg" alt="" /></div>
                                            <?= (isset($_SESSION['LoggedInUser'])) ? '<span style="padding-left: 5px; font-weight:600;">' . $UseR['first_name'] . '</span>' : ''; ?>


                                        </a>
                                    <?php
                                    } else {
                                    ?>
                                        <a href="profile.php" class="ec-header-btn">
                                            <div><img src="assets/images/icons/user.svg" class="svg_img header_svg" alt="" /></div>



                                        </a>
                                    <?php
                                    }
                                    ?>


                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Ec Header Button End -->
        <style>
            .ec-side-cart .ec-menu-inner .ec-menu-content ul li a {
                display: block;
                padding: 10px 0px;
                text-transform: capitalize;
                color: #444444;
                border-bottom: 1px solid #ededed;
                font-size: 15px;
                font-weight: 500;
                display: flex;
                justify-content: space-between;
            }
        </style>
        <!-- Header responsive Bottom  Start -->
        <div class="ec-header-bottom d-lg-none myheadercat_sec_hny">
            <div class="container position-relative">
                <div class="row">

                    <!-- Ec Header Logo Start -->
                    <div class="col-4">
                        <div class="header-logo">
                            <a href="index.php"><img src="assets/images/logo/logo-8.png" alt="Site Logo" /><img class="dark-logo" src="assets/images/logo/dark-logo-8.png" alt="Site Logo" style="display: none;" /></a>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="top-mob-right-srb">
                            <a href="javascript:void(0);" class="ec-header-btn ec-sidebar-toggle">
                                <img src="assets/images/icons/menu.svg" class="svg_img header_svg" alt="icon">
                            </a>

                            <div class="top-right-user-loc">
                                <a href="javascript:void(0);">
                                    <div class="user-name">Hi, <strong><?= (isset($_SESSION['LoggedInUser'])) ? '' . $UseR['first_name'] . '' : 'User'; ?></strong></div>
                                    <span class="mylcs"><i class="ecicon eci-map-marker" aria-hidden="true"></i> New Delhi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                </div>
            </div>
        </div>
        <!-- Header responsive Bottom  End -->

        <!-- category menu -->
        <div id="ec-mobile-catmenu" class="ec-side-cart ec-mobile-menu">
            <div class="ec-menu-title">
                <div class="left_cat_tit">
                    <span class="menu_title">Categories</span>
                    <!--<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. dolor sit amet </p>-->
                </div>
                <div class="clo_cat_bnt">
                    <button class="ec-close"><img src="assets/images/letter-x.gif" alt=""></button>
                </div>
            </div>

            <div class="ec-menu-inner">
                <div class="ec-menu-content">
                    <ul>
                        <?php
                        $getCatQHea = mysqli_query($con, "SELECT od.*, c.cat_name FROM offer_deals od, category c, vendor v, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND c.id=od.offer_cat AND od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW() GROUP BY od.offer_cat ORDER BY `c`.`cat_name` ASC");
                        while ($getCathea = mysqli_fetch_array($getCatQHea)) {
                            $catDealCOunt1 = mysqli_num_rows(mysqli_query($con, "SELECT od.*, c.cat_name, c.id FROM offer_deals od, category c, vendor v, vendor_membership vm  WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND c.id=od.offer_cat AND od.offer_cat='$getCathea[offer_cat]' AND od.published='1' AND od.status='Active' AND od.is_deleted='0' AND od.vendor_id=v.id AND v.is_deleted='0' AND vm.vendor_id=v.id AND vm.expire_date>NOW()"));



                        ?>
                            <li onclick="listing.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $getCathea['offer_cat'] ?>&<?= $urltoken ?>&<?= $urltoken ?>"><a href="listing.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $getCathea['offer_cat'] ?>&<?= $urltoken ?>&<?= $urltoken ?>"><?= $getCathea['cat_name'] ?> <small>(<?= $catDealCOunt1 ?>)</small></a>

                            </li>

                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>
        <!-- end here -->


    </header>
    <!-- Header End  -->

    <div id="ec-mobile-catmenu-hny" class="ec-side-cart ec-mobile-menu ">
        <div class="ec-menu-title">
            <span class="menu_title">My Deals</span>
            <button class="ec-close">×</button>

        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <?php include('top-bar.php'); ?>
            </div>
        </div>
    </div>


    <!--  category Section Start -->
    <section class="section srb-category-section section-space-p myheadercat_sec">
        <div class="container">

            <div class="row margin-minus-b-15 margin-minus-t-15">
                <div id="srb-cat-slider" class="srb-cat-slider owl-carousel">
                    <?php include('top-bar.php'); ?>

                </div>
            </div>
        </div>
    </section>
    <!--category Section End -->