<?php


require_once './mail.class.php';

$email = "pankaj@maishainfotech.com";
$title = "this is title";
$subject = "this is subject";
$message = "<h1>hello world</h1>";


$user = new HttpMail($email);

if($user->send($title,$subject,$message)){
	echo json_encode(array('solve' => true , 'message' => 'Thank Your , Your Information Successfully submitted .'));
}else{
    echo json_encode(array('solve' => false , 'message' => 'Your Information not sent by user .'));
}


