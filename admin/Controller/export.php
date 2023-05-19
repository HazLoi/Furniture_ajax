<?php
include 'a-dhAjax.php';

use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Tạo một đối tượng Spreadsheet
$spreadsheet = new Spreadsheet();

// Đặt tiêu đề cho file Excel
$spreadsheet->getProperties()->setTitle("Danh sách sản phẩm");

// Chọn sheet đầu tiên
$spreadsheet->setActiveSheetIndex(0);
$sheet = $spreadsheet->getActiveSheet();

// Thiết lập tiêu đề cho các cột
$sheet->setCellValue('A1', 'Mã sản phẩm');
$sheet->setCellValue('B1', 'Tên sản phẩm');
$sheet->setCellValue('C1', 'Loại sản phẩm');
$sheet->setCellValue('D1', 'Ảnh sản phẩm');
$sheet->setCellValue('E1', 'Đơn giá');
$sheet->setCellValue('F1', 'Giảm giá');
$sheet->setCellValue('G1', 'Mô tả ngắn');
$sheet->setCellValue('H1', 'Mô tả chi tiết');
$sheet->setCellValue('I1', 'Màu sắc');
$sheet->setCellValue('J1', 'Kích thước');
$sheet->setCellValue('K1', 'Tồn kho');
$sheet->setCellValue('L1', 'Đã bán');
$sheet->setCellValue('M1', 'Đánh giá');
$sheet->setCellValue('N1', 'Yêu thích');
$sheet->setCellValue('O1', 'Ngày thêm');
$sheet->setCellValue('P1', 'Ngày cập nhật');
$sheet->setCellValue('Q1', 'Trạng thái');
$sheet->setCellValue('R1', 'Tên loại');

$admin = new admin();
$result = $admin->getAllProductExport();

$row = 2;
while ($set = $result->fetch()) {
	$sheet->setCellValue('A' . $row, $set['maSP']);
	$sheet->setCellValue('B' . $row, $set['ten']);
	$sheet->setCellValue('C' . $row, $set['loai']);
	$sheet->setCellValue('D' . $row, $set['anh']);
	$sheet->setCellValue('E' . $row, $set['dongia']);
	$sheet->setCellValue('F' . $row, $set['giamgia']);
	$sheet->setCellValue('G' . $row, $set['motangan']);
	$sheet->setCellValue('H' . $row, $set['mota']);
	$sheet->setCellValue('I' . $row, $set['mausac']);
	$sheet->setCellValue('J' . $row, $set['kichthuoc']);
	$sheet->setCellValue('K' . $row, $set['tonkho']);
	$sheet->setCellValue('L' . $row, $set['daban']);
	$sheet->setCellValue('M' . $row, $set['danhgia']);
	$sheet->setCellValue('N' . $row, $set['yeuthich']);
	$sheet->setCellValue('O' . $row, $set['ngaythem']);
	$sheet->setCellValue('P' . $row, $set['ngaycapnhat']);
	$sheet->setCellValue('Q' . $row, $set['trangthai']);
	$sheet->setCellValue('R' . $row, $set['tenloai']);
	$row++;
}

$fileName = 'productData-' . date('d-m-Y') . ".xls";
// Thiết lập header để trình duyệt hiển thị hộp thoại Save As
ob_clean();

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Cache-Control: max-age=0');


readFile($fileName);
ob_end_clean();
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
