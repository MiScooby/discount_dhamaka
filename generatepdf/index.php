<?php

// print_r(Invoice_data);die();


//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
// rgb(82, 145, 201) new color
// Include the main TCPDF library (search for installation path).
require_once('TCPDF/tcpdf.php');

$getInovceDataR = Invoice_data;
$vendor_id = $getInovceDataR['id'];
$dateOfInvoice = $getInovceDataR['payment_date'];
$expDateOfInvoice = '12/01/2027';
$vendorName = $getInovceDataR['merchant_bus_name'];
$vendorAddress = $getInovceDataR['address_1'];
$vendorEmail = $getInovceDataR['email_id'];
$invoiceDate = $getInovceDataR['date_time'];
$ordernumber = $getInovceDataR['order_id'];
$gstNumber = $getInovceDataR['gst_num'];
$planType = $getInovceDataR['plan_type'];
$planDays = $getInovceDataR['plan_days'];
$planAmout = $getInovceDataR['plan_amnt'];
$planName = $getInovceDataR['plan_name'];

// $expDateOfInvoice = $invoiceDate + $planDays;
$stop_date = new DateTime($invoiceDate);
$stop_date->format('Y-m-d'); 
$stop_date->modify('+'.$planDays.' day');
$expDateOfInvoice = $stop_date->format('Y-m-d');

$stop_date = new DateTime($invoiceDate);
$stop_date->format('Y-m-d'); 
$stop_date->modify('+30 day');
$stop_date->format('Y-m-d');

$Name = 'Discount Dhamaka';
$email = "discountdhamaka@example.com";
$address = "this is address of discount dhamaka";

$image = '<img src="https://maishainfotech.com/assets/images/logo/logo.png" alt="">';


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

class MYPDF extends TCPDF {

  // Page footer
  public function Footer() {
      // Position at 15 mm from bottom
      $this->SetY(-15);
      // Set font
      $this->SetFont('helvetica', 'I', 12);
      // Page number
      $this->Cell(0, 10, 'Invoice was created on a computer and is valid without the signature and seal.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
// $pdf->setPrintFooter(false);
// $pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);



// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('../generatepdf/font/arial.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, 'B', 14);
// add a page
$pdf->AddPage();
$pdf->writeHTMLCell(30, 50, 10, 10, $image);


$pdf->SetTextColor(82, 145, 201);
$pdf->MultiCell(55, 5, $Name, 0, 'R', 0, 1, 135, 8, true);
$pdf->SetTextColor(134, 134, 134);
$pdf->SetFont($fontname, '', 10);
$pdf->MultiCell(55, 5,  $address, 0, 'R', 0, 1, 135, 15, true);
$pdf->MultiCell(55, 5, $email, 0, 'R', 0, 1, 135, 25, true);


$pdf->SetLineStyle(array('width' => 0.1, 'color' => array(134, 134, 134)));
$pdf->Line(15, 35, 190, 35);
$pdf->MultiCell(75, 5, 'INVOICE TO:' , 0, 'L', 0, 1, 15, 53, true);
$pdf->SetFont($fontname, '', 16);
$pdf->SetTextColor(76, 82, 88);
$pdf->MultiCell(45, 5, $vendorName, 0, 'L', 0, 1, 15, 58, true);
$pdf->SetFont($fontname, '', 12);
$pdf->SetTextColor(134, 134, 134);
$pdf->MultiCell(75, 5, $vendorAddress, 0, 'L', 0, 1, 15, 65, true);
$pdf->SetTextColor(82, 145, 201);
$pdf->MultiCell(75, 5, $vendorEmail, 0, 'L', 0, 1, 15, 80, true);
$pdf->SetFont($fontname, 'B', 13);

$pdf->MultiCell(60, 5,  $invoiceName, 0, 'R', 0, 1, 130, 53, true);
$pdf->SetTextColor(134, 134, 134);
$pdf->SetFont($fontname, '', 10);
$pdf->MultiCell(55, 5,  "Date of Invoice: " . $dateOfInvoice, 0, 'R', 0, 1, 135, 60, true);
$pdf->MultiCell(55, 5,  "Exp Date: " . $expDateOfInvoice, 0, 'R', 0, 1, 135, 65, true);

$pdf->SetFont($fontname, '', 14);
$pdf->SetTextColor(76, 82, 88);
$pdf->SetLineStyle(array('width' => 0.1, 'color' => array(134, 134, 134)));

 $html = <<<EOD
 <table cellspacing="1" cellpadding="9">
     <tr style="background-color:#ebebeb; border-bottom:#dadada; color: #5A5A5A;">
         <td colspan="1">#</td>
         <td colspan="8">Description</td>
         <td colspan="2">Total</td>
     </tr>
    
     <tr style="border: 1px solid #dadada; ">
         <td colspan="1">04</td>
         <td colspan="8"> $planType Vendor $planName   Membership ($planDays days)
       </td>

         <td colspan="2">$$planAmout</td>
     </tr>
     <tr>
     <td colspan="6"></td>
     </tr>
     <tr style="font-size:12px; padding: 20px;">
     <td colspan="6"></td>
 <td colspan="3" style="border: 1px solid grey;"><span >EXTRA CHARGES</span></td>
 <td colspan="3" style="border: 1px solid grey;">$00.00</td>
 </tr>
 <tr style="font-size:12px; padding: 20px;">
 <td colspan="6"></td>
 <td colspan="3" style="border: 1px solid grey;"><span >DISCOUNT</span></td>
 <td colspan="3" style="border: 1px solid grey;">$00.00</td>
 </tr>
 
   <tr style="font-size:12px; padding: 20px;">
         <td colspan="6"></td>
     <td colspan="3" style="border: 1px solid grey;"><span >SUBTOTAL</span></td>
     <td colspan="3" style="border: 1px solid grey;">$$planAmout</td>
     </tr>
     <tr style=" font-size:12px;">
     <td colspan="6" ></td>
 <td style = "color: rgb(82, 145, 201); border: 1px solid grey;" colspan="3"><h3>TOTAL</h3></td>
 <td style = "color: rgb(82, 145, 201); border: 1px solid grey;" colspan="3"><h3>$$planAmout</h3></td>
 </tr>

 </table>
 EOD;

// $pdf->MultiCell(45, 5,  "No. : " . $invoiceNumber, 0, 'L', 0, 1, 160, 55, true);
// $pdf->MultiCell(45, 5,  "Date : " . $invoiceDate, 0, 'L', 0, 1, 160, 65, true);
$pdf->MultiCell(45, 5,  "", 0, 'L', 0, 1, 160, 95, true);

$pdf->writeHTML($html, true, false, false, true, '');

$pdf->SetY(265);
// Page number
// $pdf->SetFont($fontname, '', 14);
// $pdf->MultiCell(195, 5,  "Invoice was created on a computer and is valid without the signature and seal.", 0, 'L', 0, 1, 170, 0, true);
$pdf->setFooterFont(Array($fontname, 'this is footer', 14));


// $pdf->MultiCell(55, 5, 'Address : '. $address, 0, 'L', 0, 1, 150, 20, true);


// ---------------------------------------------------------

//Close and output PDF document
// $folder = '../pdf/';
// $pdf->Output(__DIR__ . $folder.'example_001.pdf', 'F');


// $pdf->Output(__DIR__ . '/../pdf/invoice_'.$ordernumber.'.pdf', 'F');
// $pdf->Output();

//============================================================+
// END OF FILE
//============================================================+