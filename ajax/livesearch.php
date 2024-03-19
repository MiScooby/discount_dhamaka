<?php include('../admin/ajax/config.php');

$serchFild = $_POST['serchFild'];


// deal 
$serchFildQ = mysqli_query($con, "SELECT * FROM `offer_deals` WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND `status`='Active' AND published='1' AND `deal_times`> 0 AND `offer_title` LIKE '%{$serchFild}%'");
$serchFildCount = mysqli_num_rows($serchFildQ);

// brand 
$serchFildQ2 = mysqli_query($con, "SELECT vb.store_name, vb.vendor_id, od.id FROM vendor_brand vb, offer_deals od WHERE vb.vendor_id  = od.vendor_id AND vb.status='Active'  AND  CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW() AND od.published='1' AND od.status='Active' AND (od.deal_times>0 OR od.deal_times='n/a') AND  vb.store_name LIKE '%{$serchFild}%' GROUP BY vb.vendor_id");
$serchFildCount2 = mysqli_num_rows($serchFildQ2);

// category 
$serchFildQCat = mysqli_query($con, "SELECT c.cat_name, c.id FROM category c, offer_deals od WHERE CONCAT(od.offer_end_date,' ',od.offer_end_time,':00') > NOW() AND c.id=od.offer_cat AND c.status='Active' AND od.published='1' AND od.status='Active'  AND c.cat_name LIKE '%{$serchFild}%' GROUP BY c.cat_name");
$serchFildCountCat = mysqli_num_rows($serchFildQCat);

// location 
$serchFildQLoc = mysqli_query($con, "SELECT l.locality, l.id FROM offer_deals od, vendor_brand vb, locality l WHERE CONCAT(`offer_end_date`,' ',`offer_end_time`,':00') > NOW() AND (deal_times>0 OR deal_times='n/a') AND od.vendor_id=vb.vendor_id AND l.locality=vb.store_locality AND od.published='1' AND od.status='Active' AND l.locality LIKE '%{$serchFild}%' GROUP BY l.locality;
");
$serchFildCountLoc = mysqli_num_rows($serchFildQLoc);


$data['result'] = '<div class="autocomplete"><ul> '; 

if ($serchFildCount > 0 ) {
    $data['status'] = true;        
            while ($getSerchRes = mysqli_fetch_array($serchFildQ)) {          
              $data['result'].=' <a href="deal-detail.php?'.$urltoken.'&'.$urltoken.'&&deal_id='.$getSerchRes['id'].'&'.$urltoken.'&'.$urltoken.'"><li><p>'.$getSerchRes['offer_title'].'</p> <span>deal</span></li></a> ' ;          
            }
} else if ($serchFildCount2 > 0 ) {
    $data['status'] = true;   
            while ($getSerchRes2 = mysqli_fetch_array($serchFildQ2)) {          
              $data['result'].=' <a href="listing.php?'.$urltoken.'&'.$urltoken.'&&vendor_id='.$getSerchRes2['vendor_id'].'&'.$urltoken.'&'.$urltoken.'"><li><p>'.$getSerchRes2['store_name'].'</p> <span>brand</span></li></a> ';          
            }
        
} else if ($serchFildCountCat > 0 ) {
  $data['status'] = true;   
          while ($getSerchRescat = mysqli_fetch_array($serchFildQCat)) {          
            $data['result'].=' <a href="listing.php?'.$urltoken.'&'.$urltoken.'&&cat_id='.$getSerchRescat['id'].'&'.$urltoken.'&'.$urltoken.'"><li><p>'.$getSerchRescat['cat_name'].'</p> <span>category</span></li></a> ';          
          }
      
} else if ($serchFildCountLoc > 0 ) {
  $data['status'] = true;   
          while ($getSerchResLoc = mysqli_fetch_array($serchFildQLoc)) {          
            $data['result'].=' <a href="listing.php?'.$urltoken.'&'.$urltoken.'&&loc_id='.$getSerchResLoc['id'].'&'.$urltoken.'&'.$urltoken.'"><li><p>'.$getSerchResLoc['locality'].'</p><span>Location</span></li></a> ';          
          }    
} else if($serchFildCount == 0 && $serchFildCount2 == 0) {
    $data['status'] = false;
    $data['result'] = '<div class="autocomplete"><div class="oops"><h4>Oops No Deal Found</h4></div></div>';
} else{
  $data['result'].='</ul></div>';
}

echo json_encode($data);
