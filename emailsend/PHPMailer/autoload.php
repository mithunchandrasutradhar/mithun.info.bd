<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function sendMail($to, $subject, $body)
{
  $mail = new PHPMailer(true);

  try {
    $mail->SMTPSecure = 'tls';
    
$mail->SMTPDebug = 1; 
    
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Commented out for production
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'bayejidhossain47@gmail.com';
    $mail->Password   = 'fijzfzusszfsakud'; // Use your App Password here
    $mail->Port       = 587;

    $mail->setFrom('bayejidhossain47@gmail.com', 'Software Company');
    $mail->addAddress($to);

    $mail->isHTML(true);
    $mail->Subject =  $subject;
    $mail->Body    =  $body;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    return true;
  } catch (Exception $e) {
     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    // return false;
  }
}
