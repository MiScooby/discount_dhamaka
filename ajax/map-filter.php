<?php include('../admin/ajax/config.php');

$position = array();


// $venderLocQ = mysqli_query($con, "SELECT od.vendor_id, v.latitude, v.longtitude, vb.store_name, vb.store_desc, vb.store_location FROM offer_deals od, vendor v, vendor_brand vb WHERE od.vendor_id=v.id AND v.id=vb.vendor_id GROUP BY od.vendor_id");

$filQ = "SELECT od.vendor_id, v.latitude, v.longtitude, vb.store_name, vb.store_desc, vb.store_location FROM offer_deals od, vendor v, vendor_brand vb WHERE od.vendor_id=v.id AND v.id=vb.vendor_id   ";

if (isset($_POST['cat']) && !isset($_POST['subcategory'])) {
    $cat = implode("','", $_POST['cat']);
    $filQ .= " AND  v.business_cat IN('" . $cat . "') GROUP BY od.vendor_id";
  
} else if (isset($_POST['stores'])) {
    $stores = implode("','", $_POST['stores']);
    $filQ .= "AND od.vendor_id IN ('" . $stores . "') GROUP BY od.vendor_id ";
  
} else if (isset($_POST['location'])) {
    $location = implode("','", $_POST['location']);
    $filQ .= "AND vb.store_locality IN('" . $location . "')  GROUP BY od.vendor_id";
  
}  else {
    $filQ .= "GROUP BY od.vendor_id";
    
}

$venderLocQ = mysqli_query($con, $filQ);



while ($venderLoc = mysqli_fetch_assoc($venderLocQ)) {

    $var = '<div id=\"content\"><div id=\"siteNotice\"></div><h1 id=\"firstHeading\" class=\"firstHeading\">' . $venderLoc["store_name"] . '</h1><div id=\"bodyContent\"><p>' . $venderLoc["store_location"] . '</p> <p><a href=\"listing.php?' . $urltoken . '&' . $urltoken . '&vendor_id=' . $venderLoc["vendor_id"] . '&' . $urltoken . '&' . $urltoken . '\">VISIT STORE</a></p></div></div>';
    $title = "abc";
    $position[] = array('title' => $venderLoc["store_name"], 'position' => array('lat' => $venderLoc['latitude'], 'lng' => $venderLoc['longtitude']), 'icon' => 'deal', 'content' => $var);
}

  echo json_encode($position);
// print_r($position);
?>