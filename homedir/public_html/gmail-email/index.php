<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once __DIR__.'/vendor/phpmailer/src/Exception.php';
require_once __DIR__.'/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__.'/vendor/phpmailer/src/SMTP.php';

// attachment path

move_uploaded_file(
    $_FILES['pdf']['tmp_name'],
    // $_SERVER['DOCUMENT_ROOT'].'/./uploads/test.pdf'
    $_SERVER['DOCUMENT_ROOT'].'/Ongbata/demo-ongbata/sourse-code/uploads/test.pdf'
);

echo $_SERVER['DOCUMENT_ROOT'].'/Ongbata/demo-ongbata/sourse-code/uploads/test.pdf';

$fileAttachment = $_SERVER['DOCUMENT_ROOT'].'/Ongbata/demo-ongbata/sourse-code/uploads/test.pdf';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // smtp-mail.outlook.com smtp.gmail.com
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'nba1022015@gmail.com'; // YOUR gmail email
    $mail->Password = 'xomzurfmigxpcran'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom('nba1022015@gmail.com', 'Vuda Hotmail'); // becomethelegend@hotmail.com
    $mail->addAddress('anhvudo4988@gmail.com', 'Do Anh Vu');
    $mail->addReplyTo('nba1022015@gmail.com', 'Vuda Hotmail'); // to set the reply to

    // toidayhoc@datdia.com

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = 'Send email using Gmail SMTP and PHPMailer Attachment pdf';
    $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
    $mail->addAttachment($fileAttachment, 'vuda.pdf');
    //$mail->addAttachment('uploads/vuda.pdf', 'new.pdf');
    // CreatePDFfromHTML(title)
    $mail->send();
    echo 'Email message sent.';
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}
