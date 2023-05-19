<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

class sendEmail
{
    public function repContact($author, $email, $subject, $content, $repcontent)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'otakushi02@gmail.com';                 // SMTP username
            $mail->Password   = 'ijxgntrtzhwknhir';                     // SMTP password
            $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('furniture@gmail.com', "Furniture Shop"); 
            $mail->addAddress($email); // Add a recipient
            // $mail->addAddress('ellen@example.com');                  // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');             // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');        // Optional name

            // Content
            $mail->isHTML(true);                                         // Set email format to HTML
            $mail->Subject = "Furniture";
            $mail->Body    = "Tin nhắn của bạn: $content <br>Phản hồi: $repcontent";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return 1;
        } catch (Exception $e) {
            // echo "<script> alert('Không thể gửi: {$mail->ErrorInfo}') </script>";
            return 0;
        }
    }
}
