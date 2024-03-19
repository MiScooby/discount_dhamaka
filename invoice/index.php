<?php
include('../admin/ajax/config.php');
if (isset($_GET['invoice']) && isset($_GET['type'])) {
  $invoiceNum = $_GET['invoice'];
  $type = $_GET['type'];
  if ($type == "lmd") {
    $planName = "Flash Deals Plan";
    $getData = mysqli_fetch_array(mysqli_query($con, "SELECT lmo.*, lmp.plan_name, lmp.plan_type, v.f_name, v.l_name, v.email_id, v.address_1, v.address_2, v.city, v.state, v.pin_code FROM lmd_order lmo, last_minute_deals_plan lmp, vendor v WHERE lmp.id=lmo.plan_id AND v.id=lmo.vendor_id AND lmo.order_id='$invoiceNum' ORDER BY `lmo`.`id` DESC;"));
    $dealCo = $getData['plan_deals'] . ' FLash Deals';
  } else if ($type == "mem") {
    $planName = "Memebership Plan";
    $getData = mysqli_fetch_array(mysqli_query($con, "SELECT mo.*, mp.plan_name, mp.plan_type, v.f_name, v.l_name, v.email_id, v.address_1, v.address_2, v.city, v.state, v.pin_code FROM mem_order mo, membership_plan mp, vendor v WHERE mp.id=mo.plan_id AND v.id=mo.vendor_id AND mo.order_id='$invoiceNum' ORDER BY `mo`.`id` DESC;"));
    $dealCo = $getData['plan_days'] . ' Days';

  }
} else {
  header('location:../index.php');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>Discount Dhamaka Invoice</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="srb_container">
    <div class="srb_invoice_wrap">
      <div class="srb_invoice srb_style1 srb_type1" id="srb_download_section">
        <div class="srb_invoice_in">
          <div class="srb_invoice_head srb_top_head srb_mb15 srb_align_center srb_justify-center">
            <div class="srb_invoice_center text-center">
              <div class="srb_logo"><img src="assets/img/logo.png" alt="Logo"></div>
            </div>
          </div>
          <div class="srb_invoice_info srb_mb25">
            <div class="srb_card_note srb_mobile_hide"></div>
            <div class="srb_invoice_info_list srb_white_color">
              <p class="srb_invoice_number srb_m0">Invoice No: <b><?= $getData['order_id'] ?>IN</b></p>
              <p class="srb_invoice_date srb_m0">Date: <b><?= $getData['payment_date'] ?></b></p>
            </div>
            <div class="srb_invoice_seperator srb_accent_bg"></div>
          </div>
          <div class="srb_invoice_head srb_mb10">
            <div class="srb_invoice_left">
              <p class="srb_mb2"><b class="srb_primary_color">Invoice To:</b></p>
              <p>
                <?= $getData['f_name'] . ' ' . $getData['l_name'] ?> <br>
                <?= $getData['address_1'] ?>, <?= $getData['pin_code'] ?> <br>
                <?= $getData['email_id'] ?>
              </p>
            </div>
            <div class="srb_invoice_right srb_text_right">
              <p class="srb_mb2"><b class="srb_primary_color">Pay To:</b></p>
              <p>
                <b>Discount Dhamaka</b> <br>
                Extrabucks Technologies Pvt. Ltd. <br>
                info@discountdhamaka.com
              </p>
            </div>
          </div>
          <div class="srb_table srb_style1">
            <div class="">
              <div class="srb_table_responsive">
                <table>
                  <thead>
                    <tr class="srb_accent_bg">
                      <th class="srb_width_3 srb_semi_bold srb_white_color">Plan Name</th>
                      <th class="srb_width_4 srb_semi_bold srb_white_color">Description</th>
                      <th class="srb_width_2 srb_semi_bold srb_white_color">Price</th>
                      <th class="srb_width_1 srb_semi_bold srb_white_color">Tax</th>
                      <th class="srb_width_2 srb_semi_bold srb_white_color srb_text_right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="srb_width_3">1. <?= $planName ?></td>
                      <td class="srb_width_4"><?= $getData['plan_type'] . ' ' . $getData['plan_name'] . ' ' .  $dealCo ?></td>
                      <td class="srb_width_2">₹ <?= ($getData['plan_amnt'] - $getData['plan_amnt'] * 18 / 100) ?></td>
                      <td class="srb_width_1">18%</td>
                      <td class="srb_width_2 srb_text_right">₹ <?= $getData['plan_amnt'] ?></td>
                    </tr>

                  </tbody>
                </table>
              </div>
            </div>
            <div class="srb_invoice_footer srb_border_top srb_mb15 srb_m0_md">
              <div class="srb_left_footer">
                
              </div>
              <div class="srb_right_footer">
                <table class="srb_mb15">
                  <tbody>
                    <tr class="srb_gray_bg ">
                      <td class="srb_width_3 srb_primary_color srb_bold">Subtoal</td>
                      <td class="srb_width_3 srb_primary_color srb_bold srb_text_right">₹ <?= ($getData['plan_amnt'] - $getData['plan_amnt'] * 18 / 100) ?></td>
                    </tr>
                    <tr class="srb_gray_bg">
                      <td class="srb_width_3 srb_primary_color" style="font-size: 12px; ">Tax <span class="srb_ternary_color">(18%)</span></td>
                      <td class="srb_width_3 srb_primary_color srb_text_right">+ ₹ <?= ($getData['plan_amnt'] * 18 / 100) ?></td>
                    </tr>
                    <?php if ($getData['coupon_ap'] == "yes") {
                      $getCOupon = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `coupons` WHERE `coupon_code`='$getData[coupon_code]'"));
                    ?>
                      <tr class="srb_gray_bg">
                        <td class=" srb_primary_color" style="font-size: 12px;  ">Promo Code <span style="font-size: 9px;   font-weight: 600;" class="srb_ternary_color">( <?= $getData['coupon_code'] ?> )</span> </td>
                        <td class="  srb_primary_color srb_text_right">-   ₹
                          <?php
                            if($getCOupon['offer_type'] == "Percentage"){
                              echo $coioamny =  ( $getData['plan_amnt'] * $getCOupon['offer_value'] / 100);
                            }else{
                                 
                              echo $coioamny = $getCOupon['offer_value'];

                            }
                          ?>    
                      </td>
                      </tr>
                    <?php
                    }
                    ?>

                    <tr class="srb_accent_bg">
                      <td class="srb_width_3 srb_border_top_0 srb_bold srb_f16 srb_white_color">Grand Total </td>
                      <td class="srb_width_3 srb_border_top_0 srb_bold srb_f16 srb_white_color srb_text_right">₹ <?= ($getData['plan_amnt'] - $coioamny) ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
          <div class="srb_note srb_text_center srb_font_style_normal">
            <hr class="srb_mb15">
            <p class="srb_mb2"><b class="srb_primary_color">NOTE : </b></p>
            <p class="srb_m0"><b>This Invoice was created on a computer and is valid without the signature and seal.</b> <br> Thank you for your business! We value your trust in Discount Dhamaka. If you have any questions or concerns regarding this invoice, please feel free to contact us at <a href="mailto:support@discountdhamaka.com">support@discountdhamaka.com</a> .</p>
          </div><!-- .srb_note -->
        </div>
      </div>
      <div class="srb_invoice_btns srb_hide_print">
        <a href="javascript:window.print()" class="srb_invoice_btn srb_color1">
          <span class="srb_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
              <path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
              <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
              <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
              <circle cx="392" cy="184" r="24" fill='currentColor' />
            </svg>
          </span>
          <span class="srb_btn_text">Print</span>
        </a>
        <button id="srb_download_btn" class="srb_invoice_btn srb_color2">
          <span class="srb_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
              <path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
            </svg>
          </span>
          <span class="srb_btn_text">Download</span>
        </button>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jspdf.min.js"></script>
  <script src="assets/js/html2canvas.min.js"></script>
  <script src="assets/js/main.js"></script>
  <script>
    // $('#srb_download_btn').trigger('click');
  </script>
</body>

</html>