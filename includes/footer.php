<!-- Footer Start -->
<footer class="ec-footer">

    <div class="footer-container">
        <div class="footer-top section-space-footer-p">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12  ec-footer-cont-social">
                        <div class="ec-footer-contact mb-2">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">Contact</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">

                                        <li class="ec-footer-link ec-foo-mail"><span><img src="assets/images/icons/foo-mail.svg" class="svg_img foo_svg" alt="" /></span><a href="mailto:support@discountdhamaka.com">support@discountdhamaka.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ec-footer-social ">
                            <div class="ec-footer-widget">

                                <div class="mb-2">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link"><a href="#">
                                                <img src="assets/images/android-download.png" width="120px" alt="">
                                            </a></li>
                                        <li class="ec-footer-link ml-1"><a href="#">
                                                <img src="assets/images/app-store.png" width="120px" alt=""> </a></li>

                                    </ul>
                                </div>

                                <div class="ec-footer-links">
                                    <ul class="align-items-center social-med">
                                        <li class="ec-footer-link"><a href="#"><i class="ecicon eci-instagram" aria-hidden="true"></i></a></li>
                                        <li class="ec-footer-link"><a href="#"><i class="ecicon eci-twitter-square" aria-hidden="true"></i></a></li>
                                        <li class="ec-footer-link"><a href="#"><i class="ecicon eci-facebook-square" aria-hidden="true"></i></a></li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12  ec-footer-cat">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">Company</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">
                                    <li class="ec-footer-link"><a href="about-us.php">About Us</a></li>
                                    <li class="ec-footer-link"><a href="terms-condition.php">Terms & Condition</a></li>
                                    <li class="ec-footer-link"><a href="privacy-policy.php">Privacy Policy</a></li>
                                    <li class="ec-footer-link"><a href="refund-cancellation.php">Refund & Cancellation Policy</a></li>
                                    <li class="ec-footer-link"><a href="contact-us.php">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12  ec-footer-account">
                        <div class="ec-footer-widget">
                            <h4 class="ec-footer-heading">More</h4>
                            <div class="ec-footer-links">
                                <ul class="align-items-center">

                                    <li class="ec-footer-link"><a href="how-it-works.php">How It Works?</a></li>
                                    <li class="ec-footer-link"><a href="faq.php">FAQ</a></li>
                                  
                                    <li class="ec-footer-link"><a href="brands.php">Brands</a></li>
                                   

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12  ec-footer-cont-social">
                        <div class="ec-footer-contact mb-3">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading">List Your Business</h4>
                                <div class="ec-footer-links">
                                    <ul class="align-items-center">
                                        <li class="ec-footer-link">
                                            <p>Discount Dhamaka provides best platform for exclusive deals in your area.</p>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ec-footer-social">
                            <div class="ec-footer-widget">
                                <h4 class="ec-footer-heading marg-b-0 s-head">Follow Us</h4>
                                <div class="ec-footer-links">

                                    <?php
                                    if (!isset($_SESSION['LoggedInVendor'])) {
                                    ?>
                                        <ul class="align-items-center" style="flex-wrap: nowrap;">
                                            <li class="ec-footer-link"><a href="business.php" class="lybtn"> List Your Business</a></li>
                                            <li class="ec-footer-link"><a href="login.php?<?= $urltoken . $urltoken ?>&vendorlogin&<?= $urltoken . $urltoken ?>" class="lybtn"> Vendor Login</a></li>
                                        </ul>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">

                    <!-- Footer Copyright Start -->
                    <div class="footer-copy">
                        <div class="footer-bottom-copy ">
                            <div class="ec-copy">Copyrights @ 2023. All rights reserved by <a href="javascript:;">Discount Dhamaka</a></div>
                        </div>
                    </div>
                    <!-- Footer Copyright End -->

                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->





<!-- Footer navigation panel for responsive display -->
<style>
    .mybell {
        font-size: 24px;
        color: #72706d;
    }

    
</style>
<div class="ec-nav-toolbar">
    <div class="container">
        <div class="ec-nav-panel">
            <div class="ec-side-cart-overlay"></div>

            <div class="ec-nav-panel-icons">
                <a href="index.php" class="ec-header-btn"><img src="assets/images/icons/home.svg" class="svg_img header_svg" alt="icon" /></a>
            </div>

            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-catmenu-hny" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><img src="assets/images/icons/filter.svg?v1.1" class="svg_img header_svg" alt="icon" /></a>
            </div>

            <div class="ec-nav-panel-icons">
                <a href="#ec-mobile-catmenu" class="navbar-toggler-btn ec-header-btn ec-side-toggle" class="ec-header-btn"><img src="assets/images/icons/menu.svg" class="svg_img header_svg" alt="icon" /></a>
            </div>

            <div class="ec-nav-panel-icons">
                <a href="<?= (isset($_SESSION['LoggedInVendor'])) ? 'vendor-profile.php' : 'profile.php'; ?>" class="ec-header-btn d-lg-none">
                    <img src="assets/images/icons/user.svg" class="svg_img header_svg" alt="icon" />
                </a>
            </div>

            <div class="ec-nav-panel-icons">
                <a href="<?= ($_SESSION['LoggedInMobile'] != 'yes') ? 'javascript:void();' : 'notification.php'; ?>" class="ec-header-btn"><img src="assets/images/icons/notification.svg" class="svg_img header_svg" alt="icon" /></a>
            </div>

        </div>
    </div>
</div>
<!-- Footer navigation panel for responsive display end -->

 

<!-- Vendor JS -->
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/vendor/jquery.notify.min.js"></script>
<script src="assets/js/vendor/jquery.bundle.notify.min.js"></script>
<script src="assets/js/vendor/popper.min.js"></script>
<script src="assets/js/vendor/bootstrap.min.js"></script>
<script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>

<!--Plugins JS-->

<script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
<script src="assets/js/plugins/swiper-bundle.min.js"></script>
<script src="assets/js/plugins/countdownTimer.min.js"></script>
<script src="assets/js/plugins/nouislider.js"></script>
<script src="assets/js/plugins/scrollup.js"></script>
<script src="assets/js/plugins/jquery.zoom.min.js"></script>
<script src="assets/js/plugins/slick.min.js"></script>
<script src="assets/js/plugins/owl.carousel.min.js"></script>
<script src="assets/js/plugins/infiniteslidev2.js"></script>
<script src="assets/js/plugins/click-to-call.js"></script>
<script src="assets/sweetalert2/sweetalert2.min.js"></script>
<!-- Main Js -->
<script src="assets/js/vendor/index.js"></script>
<script src="assets/js/custom.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function logout() {

        $.ajax({
            url: "ajax/logout.php",
            type: "POST",
            async: false,
            success: function(data) {
            data = JSON.parse(data);
                location.href = data.url;
            }

        });

    }
    $(document).ready(function() {
        $(document).ready(function() {
            $('.select_2_1').select2();
        });

        $(document).on("click", ".anc_click", function() {

            var dealtype = $(this).attr("data-id");

            // alert(dealtype)

            $('html, body').animate({
                scrollTop: $(dealtype).offset().top
            }, 200);

            $(dealtype).addClass("hi_light");

            setTimeout(function() {
                $(dealtype).removeClass('hi_light');
            }, 7000);

        });

        $(window).scroll(function() {
            if ($(window).scrollTop() >= 100) {
                $('.myheadercat_sec').addClass('anc_fixed');
            } else {
                $('.myheadercat_sec').removeClass('anc_fixed');
            }
        });
        $(window).scroll(function() {
            if ($(window).scrollTop() >= 100) {
                $('.myheadercat_sec_hny').addClass('anc_fixed_hn');
            } else {
                $('.myheadercat_sec_hny').removeClass('anc_fixed_hn');
            }
        });
    });
</script>
<script>
    function srbSweetAlret(msg, swicon) {
        msg = msg;
        swicon = swicon;
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: swicon,
            title: msg
        })
    }
</script>

<script>
    var typingTimer;
    var doneTypingInterval = 350;
    var $input = $('#searchFiledTop'); //#myInput

    $input.on('keyup', function() {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(doneTyping, doneTypingInterval);
    });

    $input.on('keydown', function() {
        clearTimeout(typingTimer);
    });

    function doneTyping() {
        var serchFild = $("#searchFiledTop").val();
        if(serchFild == ""){
             $("#searchResult").hide();
        }else{
        $.ajax({
            context: this,
            url: "ajax/livesearch.php",
            type: 'post',
            async: false,
            data: {
                serchFild: serchFild
            },
            success: function(data) {
                data = JSON.parse(data);
                $("#searchResult").show();
                $("#searchResult").html(data.result);
            }

        });
        }
    }
</script>

<script>
    // $(document).on("keyup", "#searchFiledTop", function() {
    //     var serchFild = $(this).val();
    //     if (serchFild != "") {
    //         $.ajax({
    //             context: this,
    //             url: "ajax/livesearch.php",
    //             type: 'get',
    //             async: false,
    //             data: {
    //                 serchFild: serchFild
    //             },
    //             success: function(data) {
    //                 data = JSON.parse(data);
    //                 $("#searchResult").show();
    //                 $("#searchResult").html(data.result);
    //             }

    //         });
    //     } else {
    //         $("#searchResult").hide();
    //     }
    // });
</script>
</body>

</html>