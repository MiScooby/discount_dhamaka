<?php include('config.php');
require_once '../../emailer/mail.class.php';
if (isset($_POST['type']) && $_POST['type'] == "addDocs") {
    $docName = $_POST['docName'];
    $addDocQ = mysqli_query($con, "INSERT INTO `documents`( `doc_name`) VALUES ('$docName')");
    if ($addDocQ) {
        $data['message'] = 'Document Added Successfully ';
        $data['status'] = true;
    } else {
        $data['message'] = 'Oops ! Error occur';
        $data['status'] = false;
    }
} else if (isset($_POST['type']) && $_POST['type'] == "statusChnage") {

    $DocId = $_POST['DocId'];
    $doc_sts = $_POST['doc_sts'];

    $chngStatus = mysqli_query($con, "UPDATE `documents` SET `status`='$doc_sts' WHERE `id`='$DocId'");

    if ($chngStatus) {
        $data['message'] = 'Status Updated';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Status Update';
        $data['status'] = false;
    }
} else if (isset($_POST['type']) && $_POST['type'] == "dltDocs") {

    $DocId = $_POST['DocId'];

    $chngStatus = mysqli_query($con, "DELETE FROM `documents` WHERE `id`='$DocId'");

    if ($chngStatus) {
        $data['message'] = 'Document Deleted';
        $data['status'] = true;
    } else {
        $data['message'] = 'Error in Document Delete';
        $data['status'] = false;
    }
} else if (isset($_POST['type']) && $_POST['type'] == "vendor_docs_upload") {

    $vId = $_POST['ven_id'];
    $gstFile = $_FILES['gstFile'];
    $pCFile = $_FILES['panCardFile'];

    $gstExt = explode('.', $gstFile['name'])[1];
    $pcFExt = explode('.', $pCFile['name'])[1];


    if (!empty($_FILES['brandApprovalFile']['tmp_name'])) {
        $bAFile = $_FILES['brandApprovalFile'];
        $baFExt = explode('.', $bAFile['name'])[1];
        $baF = 'brand_' . round(microtime(true)) . '.' . $baFExt;
    } else {
        $baF = '';
    }

    $gstF = 'gst_' . round(microtime(true)) . '.' . $gstExt;
    $pcF = 'pan_' . round(microtime(true)) . '.' . $pcFExt;

    $vendorType = mysqli_fetch_array(mysqli_query($con, "SELECT `business_type` FROM `vendor` WHERE id = '$vId'"))['business_type'];

    $insetDocs = mysqli_query($con, "INSERT INTO `vendor_document_upload` ( `vendor_id`, `vendor_type`, `gst_file`, `pan_file`, `brand_appr_file`) VALUES ( '$vId', '$vendorType', '$gstF', '$pcF', '$baF')");

    if ($insetDocs) {
        $data['message'] = 'Documents Uploaded Successfully';
        $data['status'] = true;
        $data['url'] = 'view-vendor.php?' . $urltoken . '$' . $urltoken . '&&vendor_id=' . $vId . '&&' . $urltoken . '$' . $urltoken;

        if ($baF != '') {
            move_uploaded_file($bAFile['tmp_name'], "../../upload/vendor-doc/vendor-docs/" . $baF);
        }
        move_uploaded_file($gstFile['tmp_name'], "../../upload/vendor-doc/vendor-docs/" . $gstF);
        move_uploaded_file($pCFile['tmp_name'], "../../upload/vendor-doc/vendor-docs/" . $pcF);
    } else {
        $data['message'] = 'Could not upload documents';
        $data['status'] = false;
    }
} else if (isset($_POST['type']) && $_POST['type'] == "venDocLink") {
    $vendid = $_POST['vendid'];
    $GetvendorQ = mysqli_query($con, "SELECT * FROM `vendor` WHERE `id`='$vendid'");
    $Getvendor = mysqli_fetch_array($GetvendorQ);
    $busTYpe = $Getvendor['business_type'];
    $venEmail = $Getvendor['email_id'];
    if ($busTYpe == "Multi brand") {
        $ms = 1;
    } else {
        $ms = 0;
    }
    $url = 'business_document.php?' . $urltoken . $urltoken . '&vendor_id=' . $vendid . '&' . $urltoken . '&' . $urltoken . '&ms=' . $ms . '&' . $urltoken;

    include '../../emailer_html/documents/index.php';
    $mail_title = "Discount Dhamaka";

    $mail_subject = "Discount Dhamaka Documentation";

    $user_mail = new HttpMail($venEmail);



    if ($user_mail->send($mail_title, $mail_subject, $userDealmsg)) {
        $data['message'] = 'Link Sent SuccessFully';
        $data['status'] = true;
    } else {
        $data['message'] = 'Link Not Sent SuccessFully';
        $data['status'] = false;
    }
} else if (isset($_POST['type']) && $_POST['type'] == "DltVendorDocs") {

    $docvenId = $_POST['docvenId'];
    $docType = $_POST['docType'];

    if ($docType == "gst_file") {
        $nullDocsQ = mysqli_query($con, "UPDATE `vendor_document_upload` SET `gst_file` = NULL WHERE `vendor_document_upload`.`id` = $docvenId; ");
    } elseif ($docType == "pan_file") {
        $nullDocsQ = mysqli_query($con, "UPDATE `vendor_document_upload` SET `pan_file` = NULL WHERE `vendor_document_upload`.`id` = $docvenId; ");
    } elseif ($docType == "brand_file") {
        $nullDocsQ = mysqli_query($con, "UPDATE `vendor_document_upload` SET `brand_appr_file` = NULL WHERE `vendor_document_upload`.`id` = $docvenId; ");
    }


    if ($nullDocsQ) {
        $data['message'] = 'Link Sent SuccessFully';
        $data['status'] = true;
    } else {
        $data['message'] = 'Link Not Sent SuccessFully';
        $data['status'] = false;
    }
} else if (isset($_POST['typeDoc']) && $_POST['typeDoc'] == "docUpload") {
    $DocsId = $_POST['docsID'];
    $docsTYpe = $_POST['docsTYpe'];
    $docsFIe = $_FILES['docsfile'];
    $docsext = explode('.', $docsFIe['name'])[1];
  
    $vendidIs = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `vendor_document_upload` WHERE `id`='$DocsId'"))['vendor_id'];
    
   
   
    if ($docsTYpe == 'gst_file') {
        $filex = 'gst_' . round(microtime(true)) . '.' . $docsext; 
        $uploadDocsDptQ = mysqli_query($con, "UPDATE `vendor_document_upload` SET `gst_file` = '$filex' WHERE `vendor_document_upload`.`id` = $DocsId;");

    } else if ($docsTYpe == 'pan_file') {
        $filex = 'pan_' . round(microtime(true)) . '.' . $docsext; 
        $uploadDocsDptQ = mysqli_query($con, "UPDATE `vendor_document_upload` SET `pan_file` = '$filex' WHERE `vendor_document_upload`.`id` = $DocsId;");
        
    } else if ($docsTYpe == 'brand_appr_file') {
        $filex = 'brand_' . round(microtime(true)) . '.' . $docsext; 
        $uploadDocsDptQ = mysqli_query($con, "UPDATE `vendor_document_upload` SET `brand_appr_file` = '$filex' WHERE `vendor_document_upload`.`id` = $DocsId;");
    }

    if($uploadDocsDptQ){
        move_uploaded_file($docsFIe['tmp_name'], "../../upload/vendor-doc/vendor-docs/" . $filex);
       
        $data['url'] = 'view-vendor.php?'.$urltoken.$urltoken.'&&vendor_id='.$vendidIs.'&&'.$urltoken.$urltoken ;
        $data['message'] = 'Documents Uploaded Successfully';
        $data['status'] = true;
    }else{
        $data['message'] = 'Documents Uploaded Failed..';
        $data['status'] = false;
    }
    
}

echo json_encode($data);
