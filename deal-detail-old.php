<?php include('includes/header.php');
if (isset($_GET['deal_id'])) {
    $id = $_GET['deal_id'];
    $getDealDetQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE `id`='$id' ");
    $getDealsDet = mysqli_fetch_array($getDealDetQ);
    // print_r($getDealsDet);
    $getDealImgDetQ = mysqli_query($con, "SELECT * FROM `deals_img` WHERE `deal_id`='$getDealsDet[id]' ");
}
?>
<link rel="stylesheet" href="assets/css/product-detail.css">



<!-- Sart Single product -->
<section class="ec-page-content section-space-p">
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
                            <div class="single-pro-desc single-pro-desc-no-sidebar">
                                <div class="single-pro-content">
                                    <h5 class="ec-single-title"><?= $getDealsDet['offer_title']?></h5>
                                    <div class="ec-single-rating-wrap">
                                        <div class="ec-single-rating">
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star fill"></i>
                                            <i class="ecicon eci-star-o"></i>
                                        </div>
                                        <span class="ec-read-review"><span class="prscnt">0%</span> of <strong>0</strong> customers recommended <span><i class="fa fa-thumbs-up"></i></span> <span><i class="fa fa-thumbs-down"></i></span></span>
                                    </div>
                                    <div class="ec-single-desc"><?= $getDealsDet['offer_desc']?></div>

                                    <div class="ec-single-sales">
                                        <div class="ec-single-sales-inner">
                                            <div class="ec-single-sales-title">sales accelerators</div>
                                            <div class="ec-single-sales-progress">
                                                <span class="ec-single-progress-desc">Offer Redeem Items! <span>left <?= $getDealsDet['deal_times']?></span> in
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
                                                    <img src="assets/images/favicon/favicon-8.png" alt="store image" class="storimgdtl">

                                                    <a href="javascript:void(0);">
                                                        <button class="btn btn-primary visitstore">Visit To Maisha Infotech</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ec-single-price-stoke">
                                        <div class="ec-single-price">
                                            <span class="ec-single-ps-title">Address</span>
                                            <span class="new-price">101 & 102, 1st floor, D-mall, Netaji Subhash Place, Delhi 110034</span>
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
                    <div class="col-md-8">
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
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                Lorem Ipsum has been the industry's standard dummy text ever since the
                                                1500s, when an unknown printer took a galley of type and scrambled it to
                                                make a type specimen book. It has survived not only five centuries, but also
                                                the leap into electronic typesetting, remaining essentially unchanged.
                                            </p>
                                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
                                            <ul>
                                                <li>Any Product types that You want - Simple, Configurable</li>
                                                <li>Downloadable/Digital Products, Virtual Products</li>
                                                <li>Inventory Management with Backordered items</li>
                                                <li>Flatlock seams throughout.</li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="simillar_ofr">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="section-title">
                                        <h2 class="ec-title">Similar Offers</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="similardispflex">
                                <div class="ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="javascript:void(0);" class="image">
                                                    <img class="main-image" src="assets/images/product-image/3.png" alt="Product" />
                                                    <img class="hover-image" src="assets/images/product-image/3.png" alt="Product" />
                                                </a>
                                                <span class="flags">
                                                    <span class="sale">Sale</span>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <a href="javascript:void(0);">
                                                <h6 class="ec-pro-stitle">5% flat Cashback</h6>
                                            </a>
                                            <h5 class="ec-pro-title"><a href="javascript:void(0);">Winter Sale Personalised Gifts</a></h5>
                                            <div class="ec-pro-rat-price">
                                                <span class="ec-price">
                                                    <span class="new-price">$650.00</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="javascript:void(0);" class="image">
                                                    <img class="main-image" src="assets/images/product-image/4.png" alt="Product" />
                                                    <img class="hover-image" src="assets/images/product-image/4.png" alt="Product" />
                                                </a>
                                                <span class="flags">
                                                    <span class="new">New</span>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <a href="javascript:void(0);">
                                                <h6 class="ec-pro-stitle">60% Cashback</h6>
                                            </a>
                                            <h5 class="ec-pro-title"><a href="javascript:void(0);">New York Home Fragrance Sale</a></h5>
                                            <div class="ec-pro-rat-price">
                                                <span class="ec-price">
                                                    <span class="new-price">$20.00</span>
                                                    <span class="old-price">$21.00</span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ec-product-content">
                                    <div class="ec-product-inner">
                                        <div class="ec-pro-image-outer">
                                            <div class="ec-pro-image">
                                                <a href="javascript:void(0);" class="image">
                                                    <img class="main-image" src="assets/images/product-image/5.png" alt="Product" />
                                                    <img class="hover-image" src="assets/images/product-image/5.png" alt="Product" />
                                                </a>
                                                <span class="flags">
                                                    <span class="sale">Sale</span>
                                                </span>

                                            </div>
                                        </div>
                                        <div class="ec-pro-content">
                                            <a href="javascript:void(0);">
                                                <h6 class="ec-pro-stitle">14% Cashback</h6>
                                            </a>
                                            <h5 class="ec-pro-title"><a href="javascript:void(0);">Calvin Klein - Sale Styles</a></h5>
                                            <div class="ec-pro-rat-price">
                                                <span class="ec-price">
                                                    <span class="new-price">$50.00</span>
                                                    <span class="old-price">$60.00</span>
                                                </span>
                                            </div>
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
<!-- End Single product -->

<!-- Related Product Start -->

<!-- Related Product end -->

<?php include('includes/footer.php'); ?>
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