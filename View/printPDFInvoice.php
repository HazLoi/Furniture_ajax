<?php
include_once "../Controller/a-dhModel.php";
require_once '../vendor/autoload.php';

// Tạo một đối tượng mPDF
$mpdf = new \Mpdf\Mpdf();

// Bắt đầu bộ đệm đầu ra
ob_start();

// Gọi tệp PHP và lấy dữ liệu từ đó
include 'infoInvoicePDF.php';
$phpContent = ob_get_clean();

// Thêm nội dung từ tệp PHP vào tài liệu PDF
$mpdf->WriteHTML($phpContent);
// Lưu tệp PDF
$mpdf->Output('hoadon.pdf', 'D');
