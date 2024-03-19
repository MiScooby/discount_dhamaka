<?php

include('includes/header.php');
if (!isset($_SESSION['LoggedInVendor'])) {
    header("location:login.php");
}

if (isset($_GET['deal_id'])) {
    $id = $_GET['deal_id'];
    $getDealDetQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `id`='$id' ");
    $getDealsDet = mysqli_fetch_array($getDealDetQ);
    $vendDetQ = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$getDealsDet[vendor_id]' ");
    $vendDetQ = mysqli_fetch_array($vendDetQ);
    // print_r($getDealsDet);
    $getDealImgDetQ = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$getDealsDet[id]' ");
    $dealGrabcheckQ = mysqli_query($con, "SELECT * FROM `deals_order` where `user_id`='$vendorBySession' AND `deal_id`='$id' ");
$dealGrabcheck = mysqli_num_rows($dealGrabcheckQ);
}
?>
<link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
<link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
<link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />

<link rel="stylesheet" href="assets/css/main.css" />
<link rel="stylesheet" href="assets/css/product-detail.css">
<style>
    .topdivprev {
        background: #efefefba;
        padding: 30px 0 15px;
    }

    .topdivprev1 {
        background: #efefefba;
        padding: 15px 0 35px;
    }

    .mybtn {
        display: flex;
        justify-content: flex-end;
    }

    .backtopage {
        margin-right: 10px;
    }

    .myprev_div1 {
        display: flex;
        justify-content: center;
    }

    .myprehd {
        /* background: #ffeded; */
        margin-bottom: 0;
        padding: 0;
    }

    .myprehd h3 {
        margin-bottom: 0;
        font-size: 22px;
        font-weight: 600;
        color: #538772;
        text-transform: revert;
    }
.single-product-cover .slick-slide img {
    display: block;
    width: 100%;
    height: 300px;
}
    @media(max-width:768px) {
        .myrwmob {
            display: flex;
            align-items: center;
            flex-direction: column-reverse;
        }

        .myprehd {
            margin-bottom: 0;
            padding: 0;
            margin-top: 15px;
        }

        .backtopage {
            margin-right: 10px;
            font-size: 12px;
        }

        .myprehd h3 {
            margin-bottom: 0;
            font-size: 22px;
            font-weight: 600;
            color: #538772;
            text-transform: revert;
            font-size: 18px;
        }
    }
    .single-slide {
    border: 1px solid #e7e7e7;
    width: 100% !important;
    margin: auto;
    height: auto;
}
</style>

<!-- Sart Preview Deal -->
<section class="ec-page-content section-space-p ">
    <?= (($getDealsDet['deal_times'] == 0) && ($getDealsDet['deal_times'] != "n/a")) ? '<div class="outStock" ><img src="assets/images/expired.png" width="400px" alt="dd"></div>' : ''; ?>
    <div class="container <?= ((($getDealsDet['deal_times'] == 0) && ($getDealsDet['deal_times'] != "n/a")) && ($getDealsDet['deal_times'] != "n/a")) ? 'srv-blur' : ''; ?>">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12" <?= ((($getDealsDet['deal_times'] == 0) && ($getDealsDet['deal_times'] != "n/a")) && ($getDealsDet['deal_times'] != "n/a")) ? 'style="filter: grayscale(1);"' : ''; ?>>

                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-pro-img single-pro-img-no-sidebar">
                                        <div class="single-product-scroll">
                                            <div class="single-product-cover">
                                                <div class="single-slide zoom-image-hover">
                                                    <img class="img-responsive" src="upload/deals-img/<?= $getDealsDet['offer_img'] ?>" alt="">
                                                </div>
                                                <?php

                                                while ($getDealImgsDet = mysqli_fetch_array($getDealImgDetQ)) {

                                                ?>
                                                    <div class="single-slide zoom-image-hover">
                                                        <img class="img-responsive" src="upload/deals-img/<?= $getDealImgsDet['deal_img'] ?>" alt="">
                                                    </div>
                                                <?php
                                                }
                                                ?>


                                            </div>
                                            <div class="single-nav-thumb">
                                                <div class="single-slide">
                                                    <img class="img-responsive" src="upload/deals-img/<?= $getDealsDet['offer_img'] ?>" alt="">
                                                </div>
                                                <?php
                                                $getDealImgDetQ = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$getDealsDet[id]' ");
                                                while ($getDealImgsDet = mysqli_fetch_array($getDealImgDetQ)) {
                                                ?>
                                                    <div class="single-slide">
                                                        <img class="img-responsive" src="upload/deals-img/<?= $getDealImgsDet['deal_img'] ?>" alt="">
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-pro-desc single-pro-desc-no-sidebar">
                                        <div class="single-pro-content">
                                            <h5 class="ec-single-title"><?= $getDealsDet['offer_title'] ?></h5>
                                            <div class="ec-single-rating-wrap">
                                                 <?php
                                                if ($getDealsDet['rating_points'] == 0) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($getDealsDet['rating_points'] == 1) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($getDealsDet['rating_points'] == 2) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($getDealsDet['rating_points'] == 3) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($getDealsDet['rating_points'] == 4) {
                                                ?>
                                                    <div class="ec-single-rating">
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star fill"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                <?php
                                                } elseif ($getDealsDet['rating_points'] == 5) {
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
                                                <span class="ec-read-review"><span class="prscnt"><?= $getDealsDet['rating_points'] ?></span>/<strong>5</strong>
                                                    customers recommended
                                            </div>
                                            <span class="shrtdeschd">In Short</span>
                                            <?= ($getDealsDet['deal_short_desc'] == 'n/a') ? '' : '<div class="ec-single-desc">' . $getDealsDet['deal_short_desc'] . '</div>'; ?>


                                            <div class="ec-single-sales">
                                                <div class="ec-single-sales-inner">
                                                    <div class="ec-single-sales-title">sales accelerators</div>
                                                    <div class="ec-single-sales-progress">
                                                         <?php
                                                        if ($getDealsDet['deal_times'] == "n/a") {
                                                        ?>
                                                            <span class="ec-single-progress-desc">Hurry !
                                                                <span> Unlimited </span>
                                                                deal here</span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="ec-single-progress-desc">Hurry ! Only <span>
                                                                    <?= $getDealsDet['deal_times']   ?></span>
                                                                deals left</span>
                                                        <?php
                                                        }
                                                        ?>
                                                        <span class="ec-single-progressbar"></span>
                                                    </div>
                                                    <div class="ec-single-sales-countdown">
                                                        <p class="countdown" data-value="<?= $getDealsDet['offer_end_date'] . ' ', $getDealsDet['offer_end_time'] . ':00' ?>">
                                                        </p>
                                                        <?= ($dealGrabcheck == 0) ? '<div class="ec-single-count-desc">Time is Running Out!</div>' : ''; ?>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="ec-single-qty">
                                                <div class="myflexbtndtl">
                                                    <div class="ec-single-cart ">
                                                        <button class="btn btn-primary my-btn-1 grabadeal" id="grebDeal" data-value="' . $getDealsDet['id'] . '">Grab The Deal</button>
                                                        <label class="pl-2 msllolbd">Only 2 Deals For A User</label>
                                                    </div> 


                                                    <div class="ec-single-cart ">
                                                        <div class="mystoredivdtl">


                                                            <a href="javascript:void(0);">
                                                                <a href="listing.php?<?= $urltoken ?>&<?= $urltoken ?>&&vendor_id=<?= $vendDetQ['vendor_id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-primary visitstore">Visit To
                                                                    <?= $vendDetQ['store_name'] ?></a>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ec-single-price-stoke">
                                                <div class="ec-single-price">
                                                    <img src="upload/vendor-doc/brand-logo/<?= $vendDetQ['brand_logo'] ?>" width="75px" alt="dd">
                                                    <div class="d-flex flex-column">
                                                        <span class="ec-single-ps-title mb-1"><?= $vendDetQ['store_name'] ?></span>
                                                        <span class="new-price"><?= $vendDetQ['store_location'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="ec-single-stoke">

                                                    <div id="map" style="height: 70px; width: 200px;"></div>
                                                </div>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <div class="row" <?= ((($getDealsDet['deal_times'] == 0) && ($getDealsDet['deal_times'] != "n/a")) && ($getDealsDet['deal_times'] != "n/a")) ? 'style="display: none;"' : ''; ?>>
                        <div class="col-md-12">
                            <div class="ec-single-pro-tab">
                                <div class="ec-single-pro-tab-wrapper">
                                    <div class="ec-single-pro-tab-nav">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-details" role="tablist">Description</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content  ec-single-pro-tab-content">
                                        <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                            <div class="ec-single-pro-tab-desc">
                                                <?= $getDealsDet['offer_desc'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>

                    </div>
                    <!-- product details description area end -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Preview Deal -->



<?php include('includes/footer.php'); ?>
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/plugins/countdownTimer.min.js"></script>
<script src="assets/js/plugins/slick.min.js"></script>
<script src="assets/js/countdown.js"></script>

<script>
    $(document).ready(function() {
        $(".single-product-cover").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: !1,
                fade: !1,
                asNavFor: ".single-nav-thumb",
            }),
            $(".single-nav-thumb").slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                asNavFor: ".single-product-cover",
                dots: !1,
                arrows: !0,
                focusOnSelect: !0,
            })
    });
</script>

</body>

</html>