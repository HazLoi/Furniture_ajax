<?php
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

class resetPassword
{
	public function sendCodeResetPassword($email, $fullname)
	{
		$code = '';
		$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$charactersLength = strlen($characters);
		$codeLength = 8;
		for ($i = 0; $i < $codeLength; $i++) {
			$code .= $characters[rand(0, $charactersLength - 1)];
		}

		$message = "
		 <p>Bạn đã yêu cầu lấy lại mật khẩu qua email <strong>$email</strong>.</p>
		 <p>Vui lòng nhập mã xác minh sau để lấy lại mật khẩu <strong>$code</strong>.</p>    
		 <p>Mã code chỉ có hiệu lực trong 5 phút.</p>
		 ";

		$_SESSION['emailResetPassword'] = $email;
		$_SESSION['codeResetPassword'] = $code;

		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('i');
		$_SESSION['timeSendCode'] = $dateFix;
		
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
			$mail->Subject = "Code to reset your password";
			$mail->Body    = "<p>Xin chào <strong>$fullname</strong></p>" . $message;
			// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo "<script> alert('Code đã được gửi vào gmail') </script>";
		} catch (Exception $e) {
			// echo "<script> alert('Lỗi không thể gửi: {$mail->ErrorInfo}') </script>";
			echo "<script> alert('Đã xảy ra lỗi vui lòng gửi lại email!!') </script>";
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password"/>';
		}
	}
}
