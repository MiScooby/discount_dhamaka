<?php include('includes/header.php');

if (isset($_SESSION['LoggedInUser'])) {
    $vendorBySession = $_SESSION['LoggedInUser'];
} else {
    $vendorBySession = "";
}

if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $ShareUrl = "https://";
else
    $ShareUrl = "http://";
// Append the host(domain name, ip) to the ShareURL.   
$ShareUrl .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the ShareURL   
$ShareUrl .= $_SERVER['REQUEST_URI'];

if (isset($_GET['deal_id'])) {
    $id = $_GET['deal_id'];
    $getDealDetQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `id`='$id' ");
    $getDealsDet = mysqli_fetch_array($getDealDetQ);
    $vendDetQ = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$getDealsDet[vendor_id]' ");
    $vendDetQ = mysqli_fetch_array($vendDetQ);
    // print_r($getDealsDet);
    $getDealImgDetQ = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$getDealsDet[id]' ");
} else if (isset($_GET['ven_id'])) {
    $getDealDetQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `vendor_id`='$id' ");
    $getDealsDet = mysqli_fetch_array($getDealDetQ);
    $vendDetQ = mysqli_query($con, "SELECT * FROM `vendor_brand` WHERE `vendor_id`='$getDealsDet[vendor_id]' ");
    $vendDetQ = mysqli_fetch_array($vendDetQ);
    // print_r($getDealsDet);
    $getDealImgDetQ = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$getDealsDet[id]' ");
} else {
    header('location:index.php');
}


$dealGrabcheckQ = mysqli_query($con, "SELECT * FROM `deals_order` where `user_id`='$vendorBySession' AND `deal_id`='$id' ");
$dealGrabcheck = mysqli_num_rows($dealGrabcheckQ);


if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$DealipQSe = mysqli_query($con, "SELECT * FROM `deal_views` WHERE `ip`='$ip'");
$Dipew = mysqli_num_rows($DealipQSe);
$DealviQSe = mysqli_query($con, "SELECT * FROM `deal_views` WHERE `deal_id`='$id'");
$DView = mysqli_num_rows($DealviQSe);
if ($Dipew == 0) {
    $DealviQ = mysqli_query($con, "INSERT INTO `deal_views`(`ip`, `deal_id`) VALUES ('$ip','$id')");
    $DealviQAdd = mysqli_query($con, "UPDATE `offer_deals` SET `view`='$DView' WHERE `id`='$id'");
}

?>



<style>

      .share__wrapper {
  display: flex;
  margin: 2rem 0;
  z-index: 99; 
}

.share__wrapper button {
    background-color: transparent;
    border: 1px solid #dfdfdf;
    height: 35px;
    width: 35px;
    border-radius: 20px;
    padding: 5px;
    line-height: 0;
    margin: 0 5px;
}

.share__title {
  align-self: flex-end;
  margin-bottom: 0;
  font-size: 1.25rem;
}

.share__list button {
  background-color: transparent;
}

.share__list {
  display: flex;
  padding: 0;
  flex: 1;
  margin: 0;
}

li.share__item {
  list-style-type: none !important;
}

.share__link {
  border: none;
}

.share__link>* {
  pointer-events: none;
}

    .shrtdeschd {
        font-weight: 600;
        font-size: 13px;
    }

    .outStock {
        position: absolute;
        z-index: 111;
        width: 100%;
        height: auto;
        font-size: 20px;
        font-weight: 600;
        text-align: center;
    }

    .comment-form h4 {
        font-size: 18px;
        margin-bottom: 8px !important;
        color: indianred;
        text-transform: uppercase;
    }

    label.star {
        float: right;
        padding: 8px 10px 3px 0;
        font-size: 19px;
        color: #444;
        transition: all .2s;
    }

    label {
        margin-bottom: 5px;
    }

    input.star:checked~label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
    }

    input.star-5:checked~label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952;
    }

    input.star-1:checked~label.star:before {
        color: #F62;
    }

    label.star:before {
        content: '\f006';
        font-family: FontAwesome;
    }

    input.star {
        display: none;
    }


    .comment-form .form-group {
        margin-bottom: 10px;
    }

    .comment-form textarea {
        min-height: 120px;
        padding-top: 15px;
        font-size: 14px;
    }

    .comment-form .form-group {
        margin-bottom: 10px;
    }

    .button-contactForm {
        font-size: 16px;
        font-weight: 500;
        padding: 10px 30px;
        color: #ffffff;
        background-color: #ffb53a;
        border: 1px solid #ffb53a;
        background-image: linear-gradient(45deg, #ffb53a, #0a0a0a24);
        border-radius: 10px;
    }

    .avatar {
        position: relative;
        display: inline-block;
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1.25rem;
        margin-top: 33px;
    }

    .avatar-img,
    .avatar-initials,
    .avatar-placeholder {
        width: 100%;
        height: 100%;
        border-radius: inherit;
    }

    .avatar-img {
        display: block;
        -o-object-fit: cover;
        object-fit: cover;
    }

    .avatar-initials {
        position: absolute;
        top: 0;
        left: 0;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        -ms-flex-pack: center;
        justify-content: center;
        color: #fff;
        line-height: 0;
        background-color: #a0aec0;
    }

    .left_deta {
        display: flex;
    }

    .comment-meta.d-flex.align-items-baseline {
        justify-content: space-between;
    }

    .stars {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .stars i {
        font-size: 20px;
        color: #b5b8b1;
        transition: all 0.2s;
        font-family: 'FontAwesome';
        font-style: inherit;
    }

    .stars i.active {
        color: #ffb851;
        transform: scale(1.2);
    }

    .rating-box {
        padding: 25px 50px;
        background-color: #f1f1f1;
        border-radius: 25px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .slick-slide img {
        display: block;
        width: 100%;
        height: 100%;
    }

    .single-nav-thumb .slick-slide.slick-current.slick-active .single-slide {
        border: 2px solid #ffb53a;
        height: 100px;
        width: 90% !important;
    }

    .single-nav-thumb .single-slide {
        height: 100px;
        width: 90% !important;
    }

    .single-product-scroll .slick-arrow {
        top: 50%;
    }

    .single-product-scroll .slick-arrow.slick-prev {
        left: -15px;
        right: auto;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0px 1px 3px 1px #afabab;
    }

    .single-product-scroll .slick-arrow.slick-next {
        right: -15px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0px 1px 3px 1px #afabab;
    }

    button#grebDeal {
        width: 98%;
    }
</style>

<link rel="stylesheet" href="assets/css/product-detail.css">
<!-- Sart Single product -->
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
                                <div class="col-lg-7">
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
                                <div class="col-lg-5">
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
                                                    <?php
                                                    $currentSrbTime = date("Y-m-d H:i");
                                                    $DealDteTime = $getDealsDet['offer_start_date'] . ' ' . $getDealsDet['offer_start_time'];




                                                    if ((strtotime($DealDteTime) > strtotime($currentSrbTime))) {

                                                    ?>
                                                        <?= ($dealGrabcheck < 2) ? '<div class="ec-single-cart ">
                                <button class="btn btn-primary my-btn-1 grabadeal" id="grebDeal" data-value="' . $getDealsDet['id'] . '">Pre Book Deal</button>
                                <label class="pl-2 msllolbd">Only 2 Deals For A User</label>
                            </div>' : '<div class="ec-single-cart " style="    cursor: not-allowed;">
                            <button class="btn btn-primary my-btn-1 grabadeal" disabled id="grebDeal" data-value="' . $getDealsDet['id'] . '">Pre Book Deal</button>
                            <label class="pl-2 msllolbd">Only 2 Deals For A User</label>
                        </div>'; ?>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <?= ($dealGrabcheck < 2) ? '<div class="ec-single-cart ">
                                <button class="btn btn-primary my-btn-1 grabadeal" id="grebDeal" data-value="' . $getDealsDet['id'] . '">Grab The Deal</button>
                                <label class="pl-2 msllolbd">Only 2 Deals For A User</label>
                            </div>' : '<div class="ec-single-cart " style="    cursor: not-allowed;">
                            <button class="btn btn-primary my-btn-1 grabadeal" disabled id="grebDeal" data-value="' . $getDealsDet['id'] . '">Grab The Deal</button>
                            <label class="pl-2 msllolbd">Only 2 Deals For A User</label>
                        </div>'; ?>
                                                    <?php
                                                    }

                                                    ?>


                                                    <div class="ec-single-cart ">
                                                        <div class="mystoredivdtl">


                                                            <a href="javascript:void(0);">
                                                                <a href="listing.php?<?= $urltoken ?>&<?= $urltoken ?>&&vendor_id=<?= $vendDetQ['vendor_id'] ?>&&<?= $urltoken ?>&<?= $urltoken ?>" class="btn btn-primary visitstore">Visit
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
                                            <div class="ec-single-social">

                                                <div class="share__wrapper align-items-center">
                                                    <div class="share-cntr d-flex align-items-center">
                                                        <i class="fa fa-share-alt me-2"></i>
                                                        <h6>Share</h6>
                                                    </div>
                                                    <button class="share__link  share__link--facebook">
                                                        <img src="assets/images/facebook.svg" alt="fb-logo">
                                                        <span class="sr-only">Share on Facebook</span>
                                                    </button>
                                                    <button class="share__link share__link--whatsapp">
                                                        <img src="assets/images/whatsapp.svg" width="20px" alt="wa-logo">
                                                        <span class="sr-only">Share on WhatsApp</span>
                                                    </button>
                                                </div>


                                                <!--<strong>Share: </strong>-->
                                                <!--<ul class="mb-0">-->


                                                <!-- Your share button code -->
                                                <!--    <div class="fb-share-button" data-href="<?= rawurlencode($ShareUrl) ?>" data-layout="button">-->
                                                <!--    </div>-->
                                                <!--    <li class="list-inline-item whatsapp"><a href="https://api.whatsapp.com/send?text=<?= rawurlencode($ShareUrl) ?>" data-action="share/whatsapp/share" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=800');return false;" target="_blank" title="Share on whatsapp"><i class="fa fa-whatsapp"></i></a>-->
                                                <!--    </li>-->
                                                <!--</ul>-->
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
                        <div class="col-md-7">
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
                                <div>
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">

                                                <form class="form-contact addReview comment_form" action="javascript:void(0);" method="POST" id="addReview">
                                                    <input type="hidden" id="dealIdInp" value="<?= (isset($_GET['deal_id'])) ? '' . $_GET['deal_id'] . '' : ''; ?>">

                                                    <input type="hidden" id="userId" value="<?= (isset($_SESSION['LoggedInUser'])) ? '' . $_SESSION['LoggedInUser'] . '' : ''; ?>">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="comment-form-rating">
                                                                    <div class="star" style="float:left">
                                                                        <input class="star star-5" id="star-5" type="radio" name="starRating">
                                                                        <label class="star star-5" for="star-5"></label>
                                                                        <input class="star star-4" id="star-4" type="radio" name="starRating">
                                                                        <label class="star star-4" for="star-4"></label>
                                                                        <input class="star star-3" id="star-3" type="radio" name="starRating">
                                                                        <label class="star star-3" for="star-3"></label>
                                                                        <input class="star star-2" id="star-2" type="radio" name="starRating">
                                                                        <label class="star star-2" for="star-2"></label>
                                                                        <input class="star star-1" id="star-1" type="radio" name="starRating">
                                                                        <label class="star star-1" for="star-1"></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea name="commentArea" id="commentArea" class="form-control w-100" cols="30" rows="4" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" id="addCommentBtn" class="button button-contactForm">Submit
                                                            Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <?php

                            $i = 1;
                            $fetchCommentQ = $fetchCommentQ = mysqli_query($con, "SELECT c.*, u.user_name, u.first_name, u.last_name FROM comments c, user u WHERE c.user_id=u.id AND c.deal_id='$id' AND c.status='1' AND c.trash='0'");


                            while ($commnets = mysqli_fetch_assoc($fetchCommentQ)) {
                                $rating = $commnets['rating'];

                                $insDate = $commnets['ins_date'];

                                $now1 = date('Y-m-d'); // or your date as well
                                $now = strtotime($now1);
                                $your_date = strtotime($insDate);
                                $datediff = $now - $your_date;
                                $daysPast = round($datediff / (60 * 60 * 24));
                            ?>


                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="container">
                                        <div class="row mb-4">
                                            <div class="col-lg-12">
                                                <div class="comments">
                                                    <div class="comment d-flex mb-4">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar avatar-sm rounded-circle">
                                                                <img class="avatar-img" src="assets/images/user/1.png" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-2 ms-sm-3">
                                                            <div class="comment-meta d-flex align-items-baseline">
                                                                <div class="left_deta">
                                                                    <h6 class="me-2"><?= $commnets['first_name'] . ' ' . $commnets['last_name']; ?> </h6>
                                                                    <span class="text-muted"><?= $daysPast ?>d</span>
                                                                </div>
                                                                <div class="stars">
                                                                    <?php if ($rating == '5') { ?>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                    <?php } else if ($rating == '4') { ?>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                    <?php  } else if ($rating == '3') { ?>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star"></i>
                                                                        <i class="fa-solid fa-star"></i>
                                                                    <?php  } else if ($rating == '2') { ?>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                    <?php  } else if ($rating == '1') { ?>
                                                                        <i class="fa-solid fa-star active"></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                        <i class="fa-solid fa-star "></i>
                                                                    <?php  } ?>

                                                                </div>
                                                            </div>
                                                            <div class="comment-body">
                                                                <?= $commnets['comments']; ?>
                                                            </div>


                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <?php $i++;
                            } ?>



                        </div>
                        <div class="col-md-5">
                            <div class="simillar_ofr">
                                <div class="ec-sb-slider-title mytlt">
                                    <span>Similar Deals</span>
                                </div>
                                <div class="similardispflex ">
                                    <?php

                                    $simipostQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND `status`='Active' AND `published`='1' AND `is_deleted`='0' AND (deal_times>0 OR deal_times='n/a') AND (`offer_cat`='$getDealsDet[offer_cat]' ) AND `id`!='$id' ");
                                    while ($simipost = mysqli_fetch_array($simipostQ)) {
                                    ?>

                                        <div class="ec-product-content" onclick="location.href='deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $simipost['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>'">
                                            <div class="ec-product-inner">
                                                <div class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $simipost['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>" class="image h-100">
                                                            <img class="main-image" src="upload/deals-img/<?= $simipost['offer_img'] ?>" alt="Product" />
                                                            <img class="hover-image" src="upload/deals-img/<?= $simipost['offer_img'] ?>" alt="Product" />
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ec-pro-content justify-content-center">
                                                    <a href="deal-detail.php?<?= $urltoken ?>&<?= $urltoken ?>&&deal_id=<?= $simipost['id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>">
                                                        <h6 class="ec-pro-stitle"><?= $simipost['offer_title'] ?></h6>
                                                    </a>

                                                    <div class="ec-pro-rat-price m-0">
                                                        <div class="remaining">
                                                            <span><strong><?= ($simipost['deal_times'] == "n/a") ? 'Unlimited' : '' . $simipost['deal_times'] . ' Remaining' ?></strong></span>
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
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End Single product -->

<!-- Related Product Start -->

<!-- Related Product end -->

<?php include('includes/footer.php'); ?>


<script>
    window.onload = setShareLinks;

    function setShareLinks() {
        var pageUrl = encodeURIComponent(document.URL);
        var pageTitle = encodeURIComponent(document.title); 
        document.addEventListener('click', function(event) {
            let url = null;

            if (event.target.classList.contains('share__link--facebook')) {
                url = "https://www.facebook.com/sharer.php?u=" + pageUrl;
                socialWindow(url, 570, 570);
            }

            if (event.target.classList.contains('share__link--whatsapp')) {
                url = "whatsapp://send?text=" + pageTitle + "%0A%0A" + pageUrl;
                socialWindow(url, 570, 450);
            }

        }, false);
    }

    function socialWindow(url, width, height) {
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = "menubar=no,toolbar=no,status=no,width=" + width + ",height=" + height + ",top=" + top + ",left=" + left;
        window.open(url, "", params);
    }
</script>


<script src="assets/js/countdown.js"></script>
<script>
    $('.star').on('click', function(e) {
        var rating = e.target;
        $('.star').removeClass('markedStar')
        $(rating).addClass('markedStar')

    })
    $("#addCommentBtn").on('click', function() {
        if (isloggined() == "true") {
            var comment = $('#commentArea').val()
            var venId = $('#userId').val();
            var dealId = $('#dealIdInp').val();
            var rating = document.querySelector('.markedStar');

            if (rating == undefined) {
                swicon = "warning";
                msg = "Please add rating first";
                srbSweetAlret(msg, swicon);
            } else if (comment == '') {
                swicon = "warning";
                msg = "Please add comment first";
                srbSweetAlret(msg, swicon);
            } else {
                var ratingInp = $('.markedStar').attr('id');
                var star = ratingInp.split('-')[1];

                $.ajax({
                    url: 'ajax/comment.php',
                    type: 'POST',
                    data: {
                        type: 'addComment',
                        star: star,
                        comment: comment,
                        venId: venId,
                        dealId: dealId
                    },
                    beforeSend: function() {
                        $("#addCommentBtn").text("Submitting...");
                    },
                    complete: function() {
                        $("#addCommentBtn").text("Submit Review");
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            swicon = "success";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);

                        } else {
                            swicon = "warning";
                            msg = data.message;
                            srbSweetAlret(msg, swicon);
                            $("#addCommentBtn").text("Submit Review");
                        }

                    }

                });
            }

        } else {
            const Toast = Swal.fire({
                title: 'To add review, you have to Register or Log in first.',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Login',
                denyButtonText: `Register`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = 'login.php?<?= $urltoken ?>&<?= $urltoken ?>&url=' + window
                        .location.href + "&<?= $urltoken ?>&<?= $urltoken ?>";
                } else if (result.isDenied) {
                    window.location.href = 'register.php?<?= $urltoken ?>&<?= $urltoken ?>&url=' + window
                        .location.href + "&<?= $urltoken ?>&<?= $urltoken ?>";
                }
            })
        }

    })

    function isloggined() {

        let isloggined;
        $.ajax({
            url: "ajax/login.php",
            type: "POST",
            async: false,
            data: {
                type: 'isloggined'
            },
            success: function(data) {

                if (data) {
                    isloggined = data;
                } else {
                    isloggined = data;
                }
            }
        });

        return isloggined;
    }

    $(document).on("click", "#grebDeal", function() {

        if (isloggined() == "true") {
            $("#grebDeal").text("Please Wait...");
            $("#grebDeal").attr("disabled", "disabled");
            var DeAlId = $(this).attr('data-value');
            var UserId = "<?= $vendorBySession ?>";
            $.ajax({
                url: "ajax/grab-deal.php",
                type: "POST",
                async: false,
                data: {
                    DeAlId: DeAlId,
                    UserId: UserId,
                    type: 'grabDeal'
                },
                beforeSend: function() {
                    $("#grebDeal").text("Please Wait...");
                    $("#grebDeal").attr("disabled", "disabled");
                },
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status) {
                        swicon = "success";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                        location.href = data.url;
                    } else {
                        swicon = "warning";
                        msg = data.message;
                        srbSweetAlret(msg, swicon);
                    }
                }
            });

        } else {
            const Toast = Swal.fire({
                title: 'To avail the Deal , you have to Register or Log in first.',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Login',
                denyButtonText: `Register`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    window.location.href = 'login.php?<?= $urltoken ?>&<?= $urltoken ?>&url=' + window
                        .location.href + "&<?= $urltoken ?>&<?= $urltoken ?>";
                } else if (result.isDenied) {
                    window.location.href = 'register.php?<?= $urltoken ?>&<?= $urltoken ?>&url=' + window
                        .location.href + "&<?= $urltoken ?>&<?= $urltoken ?>";
                }
            })
        }
    });
</script>
<script>
    $(document).ready(function() {
        $(".single-product-cover").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: !0,
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
    $(document).ready(function() {
        $(".similardispflex").slick({
            rows: 4,
            dots: !1,
            arrows: !0,
            infinite: !0,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        rows: 2,
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        dots: !1
                    },
                },
                {
                    breakpoint: 479,
                    settings: {
                        rows: 2,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        dots: !1
                    },
                },
            ],
        });
    });
</script>


<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEPH7olpEltXbeZaoclKRKI-MppKsTPb0&libraries=places&callback=initMap" async defer></script>
<script>
    var input = document.getElementById('autocomplete');
    <?php
    $vendor = $vendDetQ['vendor_id'];
    $venderLoc = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `vendor_brand`  WHERE `vendor_id`='$vendor ' "));

    ?>

    function initMap() {
        var geocoder;
        var autocomplete;

        geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: <?= $venderLoc['store_lat'] ?>,
                lng: <?= $venderLoc['store_lng'] ?>,
            },
            zoom: 15,
            mapTypeControl: false,
        });
        var marker = new google.maps.Marker({
            position: {
                lat: <?= $venderLoc['store_lat'] ?>,
                lng: <?= $venderLoc['store_lng'] ?>,
            },
            map: map,

        });
    }
</script>
<!-- <script>
const stars = document.querySelectorAll('.stars i');
const starsNone = document.querySelector('.rating-box');

stars.forEach((star, index1) => {
    star.addEventListener('click', () => {
        stars.forEach((star, index2) => {
            index1 >= index2 ?
                star.classList.add('active') :
                star.classList.remove('active');
        });
    });
});
</script> -->