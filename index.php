<?php include('includes/header.php'); ?>
<link rel="stylesheet" href="assets/css/index.css?v1.1">


<!-- Main Slider Start -->
<section class="main_slider">
    <div class="container">
        <?php
        $sliderDealQ = mysqli_query($con, "SELECT od.*, vb.store_name, vb.brand_logo FROM offer_deals od, vendor_brand vb, vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND od.is_slider='Yes' AND od.deal_times > '0' AND vb.vendor_id=od.vendor_id AND vm.vendor_id=vb.vendor_id AND vm.expire_date>NOW() GROUP BY od.id;;");
        $CoutnsliderDealQ = mysqli_num_rows($sliderDealQ);
        if ($CoutnsliderDealQ > 0) {
        ?>
            <div class="row">
                <div id="mainherosec" class="owl-carousel owl-theme">
                    <?php
                    while ($sliderDeal = mysqli_fetch_array($sliderDealQ)) {
                    ?>
                        <div class="item pri_deta">
                            <div class="image-box">
                                <figure class="image"><img src="upload/deals-img/<?= $sliderDeal['offer_img']; ?>" alt=""></figure>
                                <div class="overlay-box" onclick="window.location.href='deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $sliderDeal['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>'">
                                    <div class="brndlogo">
                                        <img src="upload/vendor-doc/brand-logo/<?= $sliderDeal['brand_logo']; ?>" class="" alt="">
                                        <p class="ec-slide-store-title mb-1"> <?= $sliderDeal['store_name'] ?></p>
                                    </div>
                                    <h1 class="ec-slide-title mb-1" title="<?= $sliderDeal['offer_title'] ?>"><?php echo implode(' ', array_slice(explode(' ', $sliderDeal['offer_title']), 0, 7)); ?>...</h1>
                                    <div class="ec-slide-desc srb-si">

                                        <div class="ec-pro-rat-price">
                                            <!-- <p  class="ec-slide-store-title mb-1">Brand : <?= $sliderDeal['store_name'] ?></p> -->
                                            <?php
                                            $currentSrbTime = date("Y-m-d H:i");
                                            $DealDteTime = $sliderDeal['offer_start_date'] . ' ' . $sliderDeal['offer_start_time'];




                                            if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {

                                            ?>
                                                <span class="timerTile2">Coming Soon</span>
                                                <p class="countdown text-center  mt-2 mb-0" data-value="<?= $sliderDeal['offer_start_date'] . ' ', $sliderDeal['offer_start_time'] . ':00' ?>"></p>
                                            <?php
                                            } else {
                                            ?>
                                                <span class="timerTile">Ends In</span>

                                                <p class="countdown  text-center mt-2 mb-0" data-value="<?= $sliderDeal['offer_end_date'] . ' ', $sliderDeal['offer_end_time'] . ':00' ?>"></p>
                                            <?php
                                            }

                                            ?>

                                        </div>
                                        <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $sliderDeal['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-lg btn-primary">Grab Deal<i class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>
                                    </div>


                                </div>
                            </div>
                        </div>


                    <?php
                    }
                    ?>

                </div>
            </div>
        <?php

        } else {
        ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="notfound">
                        <div class="no-blog">
                            <img src="assets/images/sorry-item.webp" width="100" alt="">
                            <div class="tet">
                                <h3>Oop's, No Deals Found!</h3>
                                <p>Stay Connected ):</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

</section>
<!-- Main Slider End -->

<!--  category Section Start -->

<section class="section ec-category-section section-space-p">
    <div class="container">
        <div class="row margin-minus-b-15 margin-minus-t-15">
            <div id="ec-cat-slider" class="ec-cat-slider owl-carousel">
                <?php
                $getCatQ = mysqli_query($con, "SELECT od.*, c.id, c.cat_name, c.cat_img FROM offer_deals od, category c WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.offer_cat=c.id GROUP BY c.id ORDER BY `c`.`cat_name` ASC");
                while ($getCat = mysqli_fetch_array($getCatQ)) {
                ?>
                    <div class="ec_cat_content ec_cat_content_1" style="cursor: pointer;" onclick="window.location.href='listing.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $getCat['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>'">
                        <div class="ec_cat_inner ec_cat_inner-1">
                            <img src="upload/cat-img/<?= $getCat['cat_img'] ?>" class="srbcat_img" alt="drink" />

                            <div class="ec-category-desc">
                                <h3><?= $getCat['cat_name'] ?></h3>
                                <a href="listing.php?<?= $urltoken ?>&<?= $urltoken ?>&&cat_id=<?= $getCat['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="cat-show-all">Show All <i class="ecicon eci-angle-double-right" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>

            </div>
        </div>
    </div>
</section>
<!--category Section End -->


<!-- Product tab Area Start -->

<!-- ec Product tab Area End -->

<section class="section ec-product-tab">
    <div class="container">
        <!-- ec New Arrivals, ec Trending, ec Top Rated end -->


        <div class="row" id="upcomingDeal">
            <div class="col-lg-12 col-xl-9" id="total_deals">
                <!-- Product tab area start -->
                <div class="row space-t-50">
                    <div class="col-md-12">
                        <div class="section-title mydlssec">
                            <h2 class="ec-title">Total Deals</h2>

                        </div>
                    </div>
                </div>

                <?php
                if ($totalDealCount == 0) {
                ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="notfound">
                                <div class="no-blog">
                                    <img src="assets/images/sorry-item.webp" width="100" alt="">
                                    <div class="tet">
                                        <h3>Oop's, No Deals Found!</h3>
                                        <p>Stay Connected ):</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } else { ?>

                    <div>
                        <div class="row">
                            <?php
                            $arr = array();
                            $earr = array();
                            $sarr = array();
                            while ($td_data1 = mysqli_fetch_array($totalDealQ)) {
                                $currentSrbTime = date("Y-m-d H:i");
                                $DealDteTime = $td_data1['offer_start_date'] . ' ' . $td_data1['offer_start_time'];


                                if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {
                                    $sarr[] = $td_data1;
                                } else {
                                    $arr[] = $td_data1;
                                }
                            }
                            $arr = array_merge($arr, $sarr);
                            foreach ($arr as $td_data) {
                                $vendDetQ = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$td_data[vendor_id]' ");
                                $vendDetQ = mysqli_fetch_array($vendDetQ);

                            ?>

                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ec-product-content " <?= (($td_data['deal_times'] == 0) && ($td_data['deal_times'] != "n/a")) ? 'style="filter: grayscale(2);"' : 'onclick="location.href=deal-detail.php?' . $urltoken . '&' . $urltoken . '&&deal_id=' . $td_data['id'] . '&' . $urltoken . '&' . $urltoken . '"'; ?>>
                                    <div class="ec-product-inner" <?= (($td_data['deal_times'] == 0) && ($td_data['deal_times'] != "n/a")) ? 'style="cursor:not-allowed;"' : ''; ?>>
                                        <?= (($td_data['deal_times'] == 0) && ($td_data['deal_times'] != "n/a")) ? '<div class="outStock">
                                            <p>Deal Out of Stock</p>
                                            <img src="assets/images/expired.png" width="200px" alt="dd">
                                        </div>' : ''; ?>
                                        <div class="ec-pro-image-outer <?= (($td_data['deal_times'] == 0) && ($td_data['deal_times'] != "n/a")) ? 'srv-blur' : ''; ?>">
                                            <div class="ec-pro-image">
                                                <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $td_data['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="image">
                                                    <img class="main-image" src="upload/deals-img/<?= $td_data['offer_img'] ?>" alt="Product" />
                                                    <img class="hover-image" src="upload/deals-img/<?= $td_data['offer_img'] ?>" alt="Product" />
                                                </a>

                                                <?= ($td_data['deal_feature'] != "n/a") ? '<div class="offer-feature">
                                                    ' . $td_data['deal_feature'] . '
                                                </div>' : ''; ?>
                                            </div>
                                        </div>
                                        <div class="ec-pro-content <?= (($td_data['deal_times'] == 0) && ($td_data['deal_times'] != "n/a")) ? 'srv-blur' : ''; ?>">
                                            <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $td_data['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>">
                                                <h6 class="ec-pro-stitle"><?= $td_data['offer_title'] ?></h6>
                                            </a>


                                            <div class="ec-pro-rat-price">

                                                <?php
                                                $currentSrbTime = date("Y-m-d H:i");
                                                $DealDteTime = $td_data['offer_start_date'] . ' ' . $td_data['offer_start_time'];




                                                if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {

                                                ?>
                                                    <span class="timerTile2">Coming Soon</span>
                                                    <p class="countdown" data-value="<?= $td_data['offer_start_date'] . ' ', $td_data['offer_start_time'] . ':00' ?>"></p>
                                                <?php
                                                } else {
                                                ?>
                                                    <span class="timerTile">Ends In</span>

                                                    <p class="countdown" data-value="<?= $td_data['offer_end_date'] . ' ', $td_data['offer_end_time'] . ':00' ?>"></p>
                                                <?php
                                                }

                                                ?>

                                            </div>
                                            <span class="percentage"><?= ($td_data['deal_times'] == "n/a") ? 'Unlimited' : '' . $td_data['deal_times'] . ' Remaining' ?> </span>
                                            <h5 class="ec-pro-title mt-1 p-0"><a><?= $vendDetQ['store_name'] . ' <span>(' . $vendDetQ['store_locality'] . ')</span>' ?></a></h5>

                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>

                <?php } ?>

            </div>
            <!-- Sidebar area start -->
            <div class="ec-side-cat-overlay"></div>
            <div class="col-lg-12 col-xl-3 sidebar-dis-991" id="lastMinute">
                <div class="cat-sidebar space-t-50" id="upcming_deals">

                    <div class="ec-sidebar-slider">
                        <div class="ec-sb-slider-title mytlt">
                            <span>Deal of the day</span>
                        </div>

                        <?php
                        if ($DealofDaytQCount == 0) {
                        ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="notfound">
                                        <div class="no-blog">
                                            <img src="assets/images/sorry-item.webp" width="100" alt="">
                                            <div class="tet">
                                                <h3>Oop's, No Deals Found!</h3>
                                                <p>Stay Connected ):</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } else { ?>

                            <div class="ec-sb-pro-sl">
                                <?php
                                while ($doftdayData = mysqli_fetch_array($DealofDaytQ)) {
                                ?>
                                    <div>
                                        <div class="ec-sb-pro-sl-item">
                                            <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $doftdayData['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="sid_pro_img"><img src="upload/deals-img/<?= $doftdayData['offer_img'] ?>" alt="product" /></a>
                                            <div class="ec-pro-content">
                                                <h5 class="ec-pro-title"><a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $doftdayData['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>"><?= $doftdayData['offer_title'] ?></a></h5>
                                                <?php
                                                if ($doftdayData['rating_points'] == 0) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($doftdayData['rating_points'] == 1) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($doftdayData['rating_points'] == 2) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($doftdayData['rating_points'] == 3) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($doftdayData['rating_points'] == 4) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($doftdayData['rating_points'] == 5) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="remaining"><span><strong><?= ($doftdayData['deal_times'] == "n/a")?'Unlimited':''.$doftdayData['deal_times'].''; ?></strong> Deal Items</span></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>

                        <?php } ?>



                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!--  Top Vendor Section Start -->
<section class="section pt-4 pb-5 mb-2" id="totalDeal">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h2 class="ec-title"><a href="brands.php">Popular Brands</a></h2>

                </div>
            </div>
        </div>
        <div class="row margin-minus-t-15 margin-minus-b-15">
            <?php
            $brandsql = mysqli_query($con, "SELECT od.*, vb.store_name, vb.brand_logo FROM offer_deals od, vendor_brand vb , vendor_membership vm WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='Active' AND vm.vendor_id=vb.vendor_id AND vm.expire_date>NOW() AND od.vendor_id=vb.vendor_id AND (deal_times>0 OR deal_times='n/a') GROUP BY vb.store_name ORDER BY `vb`.`store_name` ASC limit 0, 12;");
            $brandCount = mysqli_num_rows($brandsql);
            if ($brandCount > 0) {
                while ($brandRow = mysqli_fetch_array($brandsql)) {
                    $venDealCOunt = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND `status`='Active' AND `published`='1' AND `is_deleted`='0' AND (deal_times>0 OR deal_times='n/a') AND `vendor_id`='$brandRow[vendor_id]'  "));
            ?>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ec_ven_content" onclick="window.location.href='listing.php?<?= $urltoken ?>&<?= $urltoken ?>&vendor_id=<?= $brandRow['vendor_id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>'">
                        <div class="ec-vendor-card ddn">
                            <div class="ec-vendor-detail">
                                <div class="ec-vendor-avtar">
                                    <img src="upload/vendor-doc/brand-logo/<?= $brandRow['brand_logo']; ?>" alt="vendor img">
                                </div>
                                <div class="ec-vendor-info">
                                    <a href="listing.php?<?= $urltoken ?>&<?= $urltoken ?>&vendor_id=<?= $brandRow['vendor_id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="name"><?= $brandRow['store_name']; ?></a>
                                    <p class="prod-count"><?= $venDealCOunt ?> Deals</p>


                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="notfound">
                            <div class="no-blog">
                                <img src="assets/images/sorry-item.webp" width="100" alt="">
                                <div class="tet">
                                    <h3>Oop's, No Deals Found!</h3>
                                    <p>Stay Connected ):</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!--  Top Vendor Section End -->





<script src="assets/js/countdown.js"></script>
<?php include('includes/footer.php'); ?>
<script>
    $('#mainherosec').owlCarousel({
        center: false,
        items: 2,
        loop: true,
        nav: true,
        navText: ["<div class='nav-button owl-prev'><img src='assets/images/left-arrow.png'></div>", "<div class='nav-button owl-next'><img src='assets/images/right-arrow.png'></div>"],
        dots: false,
        margin: 0,
        smartSpeed: 1000,
        autoplay: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1000: {
                items: 3,
                nav: true
            },
            1100: {
                items: 3,
                nav: true
            }

        }

    });
</script>
<script>
    <?php


    while ($esd_data1 = mysqli_fetch_array($totalDealQ1)) {

        $mytimerjs = '$("#ec-spe-count' . $esd_data1['id'] . '").countdowntimer({
        startDate: Date(),
        dateAndTime: $("#dealEndDate' . $esd_data1['id'] . '").attr("data-value"),
        labelsFormat: true,
        displayFormat: "DHMS"
        });';

        echo $mytimerjs;
    }

    ?>
</script>