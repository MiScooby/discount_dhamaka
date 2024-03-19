<?php

$username = "discountdha_main";
$password = "sr7UKwStG&u5";
$server = "localhost";
$db = "discountdha_main";

$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

$base_url = "https://discountdhamaka.com/";
// $base_url = "http://localhost/discount-dhamaka/";

date_default_timezone_set("Asia/Kolkata");

$str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
$urltoken = substr(str_shuffle($str), 0, 40);


$token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'.round(microtime(true));
$userTok = substr(str_shuffle($str), 0, 24);


function encrypt_decrypt( $string, $action = 'encrypt' ){

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'CI_1_0123_KG'; // user define private key
        $secret_iv = 'vAidg545222g27'; // user define secret key
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 ); // sha256 is hash_hmac_algo
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt( json_encode( $string ), $encrypt_method, $key, 0, $iv );
            $output = base64_encode( $output );
        } else if ( $action == 'decrypt' ) {
            $output = json_decode( openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv ) );
        }
        return $output;
}


function authChecker($controller = 'admin', $function_name)
{
    global $con;
   
    try {
        if (is_array($function_name) && !empty($function_name)) {
            $InUser = $_SESSION['usertoken'];
            $AdminUserRoleid = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `ec_employee` WHERE `email`='$InUser' "))['role_id'];
            $role_id = $AdminUserRoleid ?? 'not_found';
            
            if ($role_id) {
                $getRolesInfoQuery = "SELECT * FROM ec_roles_type WHERE id = $role_id";
                $getRolesInfoResult = mysqli_query($con, $getRolesInfoQuery);
                $getRolesInfo = mysqli_fetch_assoc($getRolesInfoResult);
               
                if ($getRolesInfo) {
                    if ($getRolesInfo['vip'] == 'yes') {
                        return true; // ALL OK || VIP USER or SUPER ADMIN
                    }
                }
       
                $frontFunctionsQuery = "SELECT * FROM ec_functions WHERE controller_name = '$controller' AND function_name IN ('" . implode("','", $function_name) . "')";
                $frontFunctionsResult = mysqli_query($con, $frontFunctionsQuery);
                $frontFunctions = [];
                while ($row = mysqli_fetch_assoc($frontFunctionsResult)) {
                    $frontFunctions[] = $row;
                }
               
                if ($frontFunctions) {
                    $accessIDs = array_column($frontFunctions, 'id');
                    $userPermissionQuery = "SELECT function_id FROM ec_set_permission WHERE role_id = $role_id";
                    $userPermissionResult = mysqli_query($con, $userPermissionQuery);
                    $userPermission = mysqli_fetch_assoc($userPermissionResult);
                   
                    if ($userPermission) {
                        $functionStringList = $userPermission['function_id'];
                        $function_ARRAY = explode(',', $functionStringList);
                       
                        if (count(array_intersect($accessIDs, $function_ARRAY)) > 0) {
                            return true; // ALL OK
                        } else {
                            return false; // false;
                        }
                    } else {
                        return false; // Permission ID Not Found
                    }
                } else {
                    return false; // Function ID Not Found
                }
            } else {
                return false; // Role ID Not Found
            }
        } else {
            return false;
        }
    } catch (\Exception $e) {
        return false;
    }
}
/*

    var_dump(authChecker('admin', ['edit_category']));
*/

function noAccessPage(){
    try{
        
        echo "<script>window.location.href='no-access.php'</script>";
        
    }catch(Exception $e){
        echo '<h1>Exception</h1>';
        echo '<p>'.$e->getMessage().'</p>';
    }

}


function noAccessPage1(){
    try{
        
        echo "<script>window.location.href='../no-access.php'</script>";
        
    }catch(Exception $e){
        echo '<h1>Exception</h1>';
        echo '<p>'.$e->getMessage().'</p>';
    }

}