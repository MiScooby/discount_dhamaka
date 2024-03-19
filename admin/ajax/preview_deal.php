<?php include('config.php');
require_once('../../vendor2/autoload.php');
$deal_Id = $_POST['dealid11'];

$deal_sts = $_POST['dealsts11'];

$GtNum = mysqli_fetch_array(mysqli_query($con, "SELECT od.id, od.deal_code, od.offer_title, v.f_name, v.cp_c_code, v.cp_num FROM offer_deals od, vendor v WHERE od.vendor_id=v.id AND od.id=$deal_Id"));

$deal_code = $GtNum['deal_code'];
$offer_title = $GtNum['offer_title'];
$f_name = $GtNum['f_name'];
$c_code = $GtNum['cp_c_code'];
$mobile_num = $GtNum['cp_num'];

$dealfinal_sql = mysqli_query($con, "UPDATE `offer_deals` SET `published`='1', `status`='$deal_sts' WHERE `id`='$deal_Id'");

if ($dealfinal_sql) {
    echo 1;
    $number = $c_code . $mobile_num;
    $client = new \GuzzleHttp\Client();

    $response = $client->request('POST', 'https://control.msg91.com/api/v5/flow/', [
        'body' => '{"template_id":"64103786d6fc05291c29e6e2","sender":"DISDMK","short_url":"0","mobiles":"' . $number . '","var1":"' . $f_name . '", "var2":"' . $offer_title . '", "var3":"' . $deal_code . '"}',
        'headers' => [
            'Authkey' => '315115ArcXDoIizG5e2d5582P1',
            'accept' => 'application/json',
            'content-type' => 'application/json',
        ],
    ]);
    // echo $response->getBody();
} else {
    echo 0;
}
