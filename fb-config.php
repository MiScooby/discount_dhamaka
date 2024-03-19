<?php

require_once 'fb-vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '681751543414562',
  'app_secret'     => '7823f43c01991a817e3b354b10e32114',
  'default_graph_version'  => 'v2.10'
]);

$facebook_output = '';
$facebook_helper = $facebook->getRedirectLoginHelper();
?>
