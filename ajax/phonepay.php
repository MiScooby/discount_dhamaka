<?php include('../admin/ajax/config.php');
include('../sendmail.php');
require_once('../vendor2/autoload.php');
if (isset($_POST['type']) && $_POST['type'] == "AddPayMnetID") {
    $LoginVendorId = $_POST['LoginVendorId'];
    $amount = $_POST['planAmnt'];
    $orderId = $_POST['orderId'];
    $merchantKey = '875126e4-5a13-4dae-ad60-5b8c8b629035';
    $data = array(
        "merchantId" => "PGTESTPAYUAT93",
        "merchantTransactionId" => $orderId,
        "merchantUserId" => $LoginVendorId,
        "amount" => $amount * 100,
        "redirectUrl" => $base_url."ajax/memorder-suc.php",
        "redirectMode" => "POST",
        "callbackUrl" => $base_url."ajax/memorder-suc.php",
        "mobileNumber" => "8800332955",

        "paymentInstrument" => array(
            "type" => "PAY_PAGE"
        )
    );
    // Convert the Payload to JSON and encode as Base64
    $payloadMain = base64_encode(json_encode($data));

    $payload = $payloadMain . "/pg/v1/pay" . $merchantKey;
    $Checksum = hash('sha256', $payload);
    $Checksum = $Checksum . '###1';

    //X-VERIFY  -	SHA256(base64 encoded payload + "/pg/v1/pay" + salt key) + ### + salt index

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'request' => $payloadMain
        ]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $Checksum,
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo 'paymentfailed.php?cURLError=' . $err;
    } else {
        // echo $response;

        $responseData = json_decode($response, true);
        $url = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
        echo $url;
    }
}



if (isset($_POST['type']) && $_POST['type'] == "AddLMDPayMnetID") {
    $LoginVendorId = $_POST['LoginVendorId'];
    $amount = $_POST['planAmnt'];
    $orderId = $_POST['orderId'];
    $merchantKey = '875126e4-5a13-4dae-ad60-5b8c8b629035';
    $data = array(
        "merchantId" => "PGTESTPAYUAT93",
        "merchantTransactionId" => $orderId,
        "merchantUserId" => $LoginVendorId,
        "amount" => $amount * 100,
        "redirectUrl" => $base_url."ajax/lmdorder-suc.php",
        "redirectMode" => "POST",
        "callbackUrl" => $base_url."ajax/lmdorder-suc.php",
        "mobileNumber" => "8800332955",

        "paymentInstrument" => array(
            "type" => "PAY_PAGE"
        )
    );
    // Convert the Payload to JSON and encode as Base64
    $payloadMain = base64_encode(json_encode($data));

    $payload = $payloadMain . "/pg/v1/pay" . $merchantKey;
    $Checksum = hash('sha256', $payload);
    $Checksum = $Checksum . '###1';

    //X-VERIFY  -	SHA256(base64 encoded payload + "/pg/v1/pay" + salt key) + ### + salt index

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode([
            'request' => $payloadMain
        ]),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $Checksum,
            "accept: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo 'paymentfailed.php?cURLError=' . $err;
    } else {
        // echo $response;

        $responseData = json_decode($response, true);
        $url = $responseData['data']['instrumentResponse']['redirectInfo']['url'];
        echo $url;
    }
}