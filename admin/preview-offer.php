<?php
session_start();
include('ajax/config.php');
if (!isset($_SESSION['usertoken'])) {
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
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">


    <title>Deal Preview Page</title>
    <meta name="keywords" content="Discount Dhamaka" />
    <meta name="description" content="Discount Dhamaka">
    <meta name="author" content="Discount Dhamaka">

    <!-- site Favicon -->
    <link rel="icon" href="../assets/images/favicon/favicon-8.png" sizes="32x32" />
    <link rel="apple-touch-icon" href="../assets/images/favicon/favicon-8.png" />
    <meta name="msapplication-TileImage" content="../assets/images/favicon/favicon-8.png" />

    <link rel="stylesheet" href="../assets/css/vendor/ecicons.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../assets/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="../assets/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins/bootstrap.css" />

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
    </style>

</head>

<input type="hidden" id="deal_sts" value="<?= $getDealsDet['status'] ?>">
<input type="hidden" id="dealId" value="<?= $id; ?>">
<section class="ec-page-content section-space-p topdivprev">
    <div class="container">
        <div class="myprev_div">

            <div class="row myrwmob" style="display:flex;align-items:center;">
                <div class="col-md-7">
                    <div class="myprehd">
                        <h3><span style="border-bottom:1px solid #5387726e;">Preview of the Deal Before Live:</span></h3>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mybtn">
                        <a href="edit_offer.php?id=<?= $id; ?>">
                            <button type="button" class="btn btn-primary visitstore backtopage"><i class="ecicon eci-arrow-left"></i> Go Back</button>
                        </a>
                        <button type="button" class="btn btn-primary save_preview">Save Preview & Live Deal</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Sart Preview Deal -->
<section class="ec-page-content section-space-p prevdivdl">
    <div class="container">
        <div class="row">
            <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">

                <!-- Single product content Start -->
                <div class="single-pro-block">
                    <div class="single-pro-inner">
                        <div class="row">
                            <div class="single-pro-img single-pro-img-no-sidebar">
                                <div class="single-product-scroll">
                                    <div class="single-product-cover">
                                        <div class="single-slide zoom-image-hover">
                                            <img class="img-responsive" src="../upload/deals-img/<?= $getDealsDet['offer_img'] ?>" alt="">
                                        </div>
                                        <?php

                                        while ($getDealImgsDet = mysqli_fetch_array($getDealImgDetQ)) {

                                        ?>
                                            <div class="single-slide zoom-image-hover">
                                                <img class="img-responsive" src="../upload/deals-img/<?= $getDealImgsDet['deal_img'] ?>" alt="">
                                            </div>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                    <div class="single-nav-thumb">
                                        <div class="single-slide">
                                            <img class="img-responsive" src="../upload/deals-img/<?= $getDealsDet['offer_img'] ?>" alt="" style="border:1px solid rgb(83 135 114 / 27%)">
                                        </div>
                                        <?php
                                        $getDealImgDetQ = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$getDealsDet[id]' ");
                                        while ($getDealImgsDet = mysqli_fetch_array($getDealImgDetQ)) {
                                        ?>
                                            <div class="single-slide" style="border: 1px solid rgb(83 135 114 / 27%);">
                                                <img class="img-responsive" src="../upload/deals-img/<?= $getDealImgsDet['deal_img'] ?>" alt="">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
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
                                        <span class="ec-read-review"><span class="prscnt"><?= $getDealsDet['rating_points'] ?></span> of <strong>5</strong> customers recommended <span><i class="fa fa-thumbs-up"></i></span> <span><i class="fa fa-thumbs-down"></i></span></span>
                                    </div>
                                    <div class="ec-single-desc"><?= $getDealsDet['offer_desc'] ?></div>

                                    <div class="ec-single-sales">
                                        <div class="ec-single-sales-inner">
                                            <div class="ec-single-sales-title">sales accelerators</div>
                                            <div class="ec-single-sales-progress">
                                                <span class="ec-single-progress-desc">Offer Redeem Items! <span>left <?= $getDealsDet['deal_times'] ?></span> in
                                                    stock</span>
                                                <span class="ec-single-progressbar"></span>
                                            </div>
                                            <div class="ec-single-sales-countdown">
                                                <div class="countdowntimer">
                                                    <span id="dealEndDate" data-value="<?= $getDealsDet['offer_end_date'] . ' ', $getDealsDet['offer_end_time'] . ':00' ?>"></span>
                                                    <span id="ec-spe-count"></span>
                                                </div>
                                                <div class="ec-single-count-desc">Time is Running Out!</div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="ec-single-qty">
                                        <div class="myflexbtndtl">
                                            <div class="ec-single-cart ">
                                                <button class="btn btn-primary my-btn-1 grabadeal">Grab A Deal</button>
                                            </div>

                                            <div class="ec-single-cart ">
                                                <div class="mystoredivdtl">


                                                    <a href="javascript:void(0);">
                                                        <button class="btn btn-primary visitstore">Visit To <?= $vendDetQ['store_name'] ?></button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ec-single-price-stoke">
                                        <div class="ec-single-price">
                                            <span class="ec-single-ps-title">Address</span>
                                            <span class="new-price"><?= $vendDetQ['store_location'] ?></span>
                                        </div>
                                        <div class="ec-single-stoke">
                                            <span class="ec-single-ps-title">Reach at</span>
                                            <span class="ec-single-sku">
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3499.8509846752786!2d77.149765815084!3d28.69410388239367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d02339e9d5589%3A0x7591a5b161c6c05d!2sMaisha%20Infotech%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1666172022760!5m2!1sen!2sin" width="100%" height="70" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ec-single-social">
                                        <strong>Share: </strong>
                                        <ul class="mb-0">
                                            <li class="list-inline-item facebook"><a href="#"><i class="ecicon eci-facebook"></i></a></li>
                                            <li class="list-inline-item twitter"><a href="#"><i class="ecicon eci-twitter"></i></a></li>
                                            <li class="list-inline-item instagram"><a href="#"><i class="ecicon eci-instagram"></i></a></li>
                                            <li class="list-inline-item whatsapp"><a href="#"><i class="ecicon eci-whatsapp"></i></a></li>
                                            <li class="list-inline-item youtube-play"><a href="#"><i class="ecicon eci-youtube-play"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Single product content End -->
                <!-- Single product tab start -->
                <div class="row">
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
</section>
<!-- End Preview Deal -->

<section class="ec-page-content section-space-p topdivprev1">
    <div class="container">
        <div class="myprev_div1">
            <a href="edit_offer.php?id=<?= $id; ?>">
                <button type="button" class="btn btn-primary visitstore backtopage"><i class="ecicon eci-arrow-left"></i> Go Back</button>
            </a>
            <button type="button" class="btn btn-primary save_preview">Save Preview & Live Deal</button>
        </div>
    </div>
</section>


<script src="../assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="../assets/js/plugins/countdownTimer.min.js"></script>
<script src="../assets/js/plugins/slick.min.js"></script>


<script>
    $(document).ready(function() {
        $(document).on("click", ".save_preview", function() {
            var mydeal_id = $("#dealId").val();
            var mydeal_sts = $("#deal_sts").val();

            $.ajax({
                url: 'ajax/preview_deal.php',
                type: 'POST',
                data: {
                    dealid11: mydeal_id,
                    dealsts11: mydeal_sts
                },
                success: function(data) {
                    if (data == 1) {
                        alert("Successfully Updated Deal...");
                        window.location.href = "view-offers.php";
                    } else {
                        location.reload();
                        alert("Deal Not Updated!");
                    }
                }
            });

        });
    });
</script>

<script>
    $("#ec-spe-count").countdowntimer({
        startDate: Date(),
        dateAndTime: $("#dealEndDate").attr('data-value'),
        labelsFormat: true,
        displayFormat: "DHMS"
    });
</script>
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