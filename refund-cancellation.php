<?php include('includes/header.php');
if (isset($_GET['type']) && $_GET['type'] == 'vendor') {
    $TypeUser = "Vendor";
} else {
    $TypeUser = "User";
}
?>
<!-- header end here -->

<style>
    .terms_condition_page {
        border-top: 1px solid #f1f1f1e6;
    }

    .terms_condition_page .ec-common-wrapper {
        padding: 30px;
        border: 1px solid #ededed7a;
        max-width: 100%;
        border-radius: 15px;
        margin: 0 auto;
        background-color: #f9fffe5c;
    }

    .terms_condition_page .section-title .ec-title {
        font-family: inherit;
        font-weight: 700;
        margin-bottom: 7px;
        color: #eca207;
        letter-spacing: 0;
        position: relative;
        display: inline;
        line-height: 22px;
        letter-spacing: 0.02rem;
        text-transform: capitalize;
    }

    .ec-cms-block .ec-cms-block-title {
        margin-bottom: 5px;
        color: #455263;
        font-size: 16px;
        line-height: 24px;
        font-weight: 600;
        letter-spacing: 0;
        text-align: left;
        /* font-family: "Montserrat"; */
    }

    .terms_condition_page .ec-cms-block p {
        margin-bottom: 29px;
    }

    .ec-cms-block p {
        font-size: 13px;
        color: #777777;
        line-height: 26px;
        font-weight: 400;
        letter-spacing: 0;
        text-align: left;
        margin-bottom: 14px !important;
    }

    p:last-child {
        margin-bottom: 0;
    }

    .terms_condition_page .section-title {
        margin-bottom: 15px;
        margin-top: -3px;
        padding: 0;
        position: relative;
        padding-bottom: 10px;
        border-bottom: none;
    }

    .uldiv p {
        margin-bottom: 10px !important;
    }

    .uldiv ul li {
        line-height: 30px;
        font-size: 13px;
        font-weight: 400;
        color: #777777;
    }
</style>
 
<!-- Start Terms & Condition page -->
    <section class="ec-page-content section-space-p terms_condition_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title py-3">
                        <h2 class="ec-title">Refund & Cancellation Policy</h2>
                        <p class="sub-title mb-3">Welcome to the Discount Dhamaka marketplace</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="ec-common-wrapper">
                        <div class="col-sm-12 ec-cms-block">
                            <div class="ec-cms-block-inner">
                                <h3 class="ec-cms-block-title">Refund Policy: </h3>
                                <p>We regret to inform you that we do not offer refunds on any purchases made through our website. Once an order is placed and processed, it cannot be canceled or refunded. All sales are final.</p>
                            </div>
                        </div>
                

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Terms & Condition page -->



<!-- footer start here -->
<?php include('includes/footer.php'); ?>