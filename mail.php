<?php  
use phpmailer\PHPMailer\PHPMailer;
use phpmailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
function mailTo($to,$name,$body){

    $mail = new PHPMailer();

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'deedupdate@outlook.com';
    $mail->Password = 'upworkBernard69*';
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587; // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
        );
    
    // Email content
    $mail->setFrom('deedupdate@outlook.com', 'B-chain');
    $mail->addAddress($to, $name);
    $mail->Subject = 'B-Chain';
    $mail->Body = $body;
    
    $mail->send();

}

?>