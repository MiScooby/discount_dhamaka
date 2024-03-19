<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

class HttpMail{
    private $mail = null;
    private $to;
    private $username = "info@discountdhamaka.in";
    private $password = 'zuwgqxkcrjychxfz';
    private $host = "smtp.gmail.com";
    private $port = 587;
    
    public function __construct($to){
        $this->mail = new PHPMailer();
        $this->to = $to;
    }

    public function send($title,$subject,$content){
        return $this->sendMail($title,$subject,$content);
    }
    
    private function sendMail($title,$subject,$content){
        
        $this->mail->IsSMTP();
        $this->mail->SMTPDebug = 0;
        $this->mail->SMTPAuth = TRUE;
        $this->mail->SMTPSecure = "tls";
        $this->mail->Port     = $this->port;
        $this->mail->CharSet = 'utf-8';
        $this->mail->Username = $this->username;
        $this->mail->Password = $this->password;
        $this->mail->Host     = $this->host;
        $this->mail->Mailer   = "smtp";
        $this->mail->CharSet = 'utf-8';
        $this->mail->SetFrom($this->username,$title);

        if(is_array($this->to)){
            foreach($this->to as $value){
                $this->mail->AddAddress($value);
            }
        }else{
            $this->mail->AddAddress($this->to);
        }

        $this->mail->Subject = $subject;
        $this->mail->WordWrap   = 80;
        $this->mail->MsgHTML($content);
        $this->mail->IsHTML(true);
        
        if($this->mail->Send()) {
            return 1;
        } else {
            return 0;
        }
    }
    
}

?>