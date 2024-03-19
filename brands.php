<?php include('includes/header.php'); ?>
<style>
    .ec-vendor-card .ec-vendor-detail {
    margin-bottom: 6px;
    padding-bottom: 0px;
    border-bottom: none;
    text-align: center;
}
</style>
   <!--  Top Vendor Section Start -->
   <section class="section section-space-p" id="vendors">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Our Brands</h2>
                        
                    </div>
                </div>
            </div>
            <div class="row margin-minus-t-15 margin-minus-b-15">
            <?php
            $brandsql = mysqli_query($con, "SELECT od.*, vb.store_name, vb.brand_logo FROM offer_deals od, vendor_brand vb WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND od.status='1' AND od.vendor_id=vb.vendor_id AND (deal_times>0 OR deal_times='n/a') GROUP BY vb.store_name ORDER BY `vb`.`store_name`");
            $brandCount = mysqli_num_rows($brandsql);
            if ($brandCount > 0) {
                while ($brandRow = mysqli_fetch_array($brandsql)) {
                    $venDealCOunt = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND `status`='1' AND `is_deleted`='0' AND (deal_times>0 OR deal_times='n/a') AND `vendor_id`='$brandRow[vendor_id]'  "));
            ?>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3 ec_ven_content" onclick="window.location.href='listing.php?<?= $urltoken ?>&<?= $urltoken ?>&vendor_id=<?= $brandRow['vendor_id'] ?>&<?= $urltoken ?>&<?= $urltoken ?>'">
                        <div class="ec-vendor-card ddn">
                            <div class="ec-vendor-detail">
                                <div class="ec-vendor-avtar">
                                    <img src="upload/vendor-doc/brand-logo/<?=$brandRow['brand_logo'];?>" alt="vendor img">
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
            }
            ?>
        </div>
        </div>
    </section>
    <!--  Top Vendor Section End -->
<?php include('includes/footer.php'); ?>