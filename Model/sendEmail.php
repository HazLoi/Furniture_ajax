<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

class sendEmail
{
    public function sendContentContact($name, $email, $subject, $message)
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
            $mail->setFrom($email);
            $mail->addAddress('furniture@gmail.com', "Furniture Shop"); // Add a recipient
            // $mail->addAddress('ellen@example.com');                  // Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');             // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');        // Optional name

            // Content
            $mail->isHTML(true);                                         // Set email format to HTML
            $mail->Subject = "Contact: " . $subject;
            $mail->Body    = "Tên người gửi: $name <br>Email: $email<br>Nội dung: $message";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return 1;
        } catch (Exception $e) {
            // echo "<script> alert('Không thể gửi: {$mail->ErrorInfo}') </script>";
            return 0;
        }
    }

    public function emailSignup($email)
    {
        $db = new connect();

        $insert = "INSERT INTO emailsignup (id, email) VALUES (null, '$email')";

        $db->exec($insert);
    }

    public function checkEmail($email)
    {
        $db = new connect();

        $select = "SELECT email FROM emailsignup WHERE email = '$email' ";

        $result = $db->getInstance($select);

        return $result[0];
    }

    public function sendEmailCheckout($id, $maHD, $email)
    {
        $db = new connect();
        $select = "SELECT a.maHD, b.maSP, b.tenSP, b.soluongmua, b.dongia ,b.thanhtien, a.tongtien FROM hoa_don as a, ct_hoadon as b WHERE a.id = $id and a.maHD = b.maHD and b.maHD = $maHD ORDER BY a.maHD";
        $result = $db->getlist($select);

        $message = "
            <html>
            <head>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
                    integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>
            </head>
            <body>
                <h2><b>Cảm ơn quý khách đã đặt hàng</b></h2>
                <h2><b>Mã hóa đơn của bạn là INV-$maHD</b></h2>
                <table style='table-layout: fixed; width: 100%; border: 1px solid; border-collapse: separate; border-spacing: 0; text-align: center; font-size: 18px'>
                    <thead>
                        <tr>
                            <th style='border: 1px solid;'>Mã sản phẩm</th>
                            <th style='border: 1px solid;'>Tên sản phẩm</th>
                            <th style='border: 1px solid;'>Số lượng mua</th>
                            <th style='border: 1px solid;'>Đơn giá</th>
                            <th style='border: 1px solid;'>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        {ITEMS}
                    </tbody>
                </table>
                <h2><b>Tổng tiền hóa đơn: {TOTAL}</b></h2>
            </body>
            </html>
        ";

        $x = '';
        $total = 0;
        while ($set = $result->fetch()) {
            $x .= "<tr>";
            $x .= "<th style='border: 1px solid;'>" . $set["maSP"] . "</th>";
            $x .= "<td style='border: 1px solid;'>" . $set["tenSP"] . "</td>";
            $x .= "<td style='border: 1px solid;'>" . $set["soluongmua"] . "</td>";
            $x .= "<td style='border: 1px solid;'>" . number_format($set["dongia"], 0, ',', '.') . ' đ' . "</td>";
            $x .= "<td style='border: 1px solid;'>" . number_format($set["thanhtien"], 0, ',', '.') . ' đ' . "</td>";
            $x .= "</tr>";
            $total = number_format($set['tongtien'], 0, ',', '.') . ' đ';
        }

        // Merge the invoice data with the HTML template
        $invoice = str_replace('{ITEMS}', $x, $message);
        $invoice = str_replace('{TOTAL}', $total, $invoice);

        $mail = new PHPMailer(true);

        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'otakushi02@gmail.com';                 // SMTP username
            $mail->Password   = 'ijxgntrtzhwknhir';                     // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 465;                                    // TCP port to connect to

            // Recipients
            $mail->setFrom('furniture@gmail.com', "Furniture Shop");
            $mail->addAddress($email); // Add a recipient

            // Content
            $mail->isHTML(true);                                         // Set email format to HTML
            $mail->Subject = "Invoice Furniture";
            $mail->Body    = $invoice;

            $mail->send();

            return 1;
        } catch (Exception $e) {
            return 0;
        }
    }
}
