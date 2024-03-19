<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('1039272015800-ps9thae69neqvju16qqrndvji3r28do4.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://micodetest.com/discount-dhamaka/profile.php');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>