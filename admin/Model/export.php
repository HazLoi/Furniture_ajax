<?php
// Đường dẫn đến file autoload.php của thư viện PhpSpreadsheet


use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class export
{
	public function exportDataProducts()
	{
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

		$fileName = 'productData-' . date('d-m-Y') . ".xlsx";
		ob_start();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');
		header('Cache-Control: max-age=0');

		ob_end_clean();

		// Save Excel file to PHP output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}

	public function exportDataAdmins()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách tài khoản quản lý");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã tài khoản');
		$sheet->setCellValue('B1', 'Họ người dùng');
		$sheet->setCellValue('C1', 'Tên ngươi dùng');
		$sheet->setCellValue('D1', 'Họ và tên');
		$sheet->setCellValue('E1', 'Giới tính');
		$sheet->setCellValue('F1', 'Số điện thoại');
		$sheet->setCellValue('G1', 'Email');
		$sheet->setCellValue('H1', 'Quyền');
		$sheet->setCellValue('I1', 'Ngày sinh');
		$sheet->setCellValue('J1', 'Địa chỉ');
		$sheet->setCellValue('K1', 'Ngày đăng ký');
		$sheet->setCellValue('L1', 'Ngày cập nhật');
		$sheet->setCellValue('M1', 'Trạng thái');
		$sheet->setCellValue('N1', 'Tên ảnh đại diện');

		$admin = new admin();
		$result = $admin->getAllAdminExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['id']);
			$sheet->setCellValue('B' . $row, $set['ho']);
			$sheet->setCellValue('C' . $row, $set['ten']);
			$sheet->setCellValue('D' . $row, $set['hovaten']);
			$sheet->setCellValue('E' . $row, $set['gioitinh']);
			$sheet->setCellValue('F' . $row, $set['sdt']);
			$sheet->setCellValue('G' . $row, $set['email']);
			$sheet->setCellValue('H' . $row, $set['quyen']);
			$sheet->setCellValue('I' . $row, $set['ngaysinh']);
			$sheet->setCellValue('J' . $row, $set['diachi']);
			$sheet->setCellValue('K' . $row, $set['ngaydk']);
			$sheet->setCellValue('L' . $row, $set['ngaycapnhat']);
			$sheet->setCellValue('M' . $row, $set['trangthai']);
			$sheet->setCellValue('N' . $row, $set['anh']);
			$row++;
		}

		$fileName = 'accountAdminData-' . date('d-m-Y') . ".xlsx";
		ob_start();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');
		header('Cache-Control: max-age=0');
		ob_end_clean();

		// Save Excel file to PHP output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}

	public function exportDataCustomers()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách tài khoản khách hàng");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã tài khoản');
		$sheet->setCellValue('B1', 'Họ người dùng');
		$sheet->setCellValue('C1', 'Tên ngươi dùng');
		$sheet->setCellValue('D1', 'Họ và tên');
		$sheet->setCellValue('E1', 'Giới tính');
		$sheet->setCellValue('F1', 'Số điện thoại');
		$sheet->setCellValue('G1', 'Email');
		$sheet->setCellValue('H1', 'Ngày sinh');
		$sheet->setCellValue('I1', 'Địa chỉ');
		$sheet->setCellValue('J1', 'Ngày đăng ký');
		$sheet->setCellValue('K1', 'Ngày cập nhật');
		$sheet->setCellValue('L1', 'Trạng thái');
		$sheet->setCellValue('M1', 'Tên ảnh đại diện');

		$admin = new admin();
		$result = $admin->getAllCustomerExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['id']);
			$sheet->setCellValue('B' . $row, $set['ho']);
			$sheet->setCellValue('C' . $row, $set['ten']);
			$sheet->setCellValue('D' . $row, $set['hovaten']);
			$sheet->setCellValue('E' . $row, $set['gioitinh']);
			$sheet->setCellValue('F' . $row, $set['sdt']);
			$sheet->setCellValue('G' . $row, $set['email']);
			$sheet->setCellValue('H' . $row, $set['ngaysinh']);
			$sheet->setCellValue('I' . $row, $set['diachi']);
			$sheet->setCellValue('J' . $row, $set['ngaydk']);
			$sheet->setCellValue('K' . $row, $set['ngaycapnhat']);
			$sheet->setCellValue('L' . $row, $set['trangthai']);
			$sheet->setCellValue('M' . $row, $set['anh']);
			$row++;
		}

		$fileName = 'accountCustomerData-' . date('d-m-Y') . ".xlsx";
		ob_start();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');
		header('Cache-Control: max-age=0');

		ob_end_clean();

		// Save Excel file to PHP output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}

	public function exportDataInfoInvoices()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách hóa đơn");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã hóa đơn');
		$sheet->setCellValue('B1', 'Mã khách hàng');
		$sheet->setCellValue('C1', 'Tên khách hàng');
		$sheet->setCellValue('D1', 'Email');
		$sheet->setCellValue('E1', 'Số điện thoại');
		$sheet->setCellValue('F1', 'Công ty');
		$sheet->setCellValue('G1', 'Địa chỉ 1');
		$sheet->setCellValue('H1', 'Địa chỉ 2');
		$sheet->setCellValue('I1', 'Thành phố');
		$sheet->setCellValue('J1', 'Ngày đặt hàng');
		$sheet->setCellValue('K1', 'Ngày cập nhật');
		$sheet->setCellValue('L1', 'Tổng tiền');
		$sheet->setCellValue('M1', 'Ghi chú');
		$sheet->setCellValue('N1', 'Tình trạng');
		$sheet->setCellValue('O1', 'Trạng thái');

		$admin = new admin();
		$result = $admin->getAllInfoInvoicesExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maHD']);
			$sheet->setCellValue('B' . $row, $set['id']);
			$sheet->setCellValue('C' . $row, $set['tenKH']);
			$sheet->setCellValue('D' . $row, $set['email']);
			$sheet->setCellValue('E' . $row, $set['sdt']);
			$sheet->setCellValue('F' . $row, $set['congty']);
			$sheet->setCellValue('G' . $row, $set['diachi1']);
			$sheet->setCellValue('H' . $row, $set['diachi2']);
			$sheet->setCellValue('I' . $row, $set['thanhpho']);
			$sheet->setCellValue('J' . $row, $set['ngay']);
			$sheet->setCellValue('K' . $row, $set['ngaycapnhat']);
			$sheet->setCellValue('L' . $row, $set['tongtien']);
			$sheet->setCellValue('M' . $row, $set['ghichu']);
			$sheet->setCellValue('N' . $row, $set['tinhtrang']);
			$sheet->setCellValue('O' . $row, $set['trangthai']);
			$row++;
		}
	
		$fileName = 'invoiceData-' . date('d-m-Y') . ".xlsx";
		ob_start();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');
		header('Cache-Control: max-age=0');

		ob_end_clean();

		// Save Excel file to PHP output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}

	public function exportDataNews()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách tin tức");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã tin tức');
		$sheet->setCellValue('B1', 'Tên tin tức');
		$sheet->setCellValue('C1', 'Ảnh tin tức');
		$sheet->setCellValue('D1', 'Ngày thực hiện');
		$sheet->setCellValue('E1', 'Nội dung');
		$sheet->setCellValue('F1', 'Chi tiết');
		$sheet->setCellValue('G1', 'Tình trạng');
		$sheet->setCellValue('H1', 'Ngày thêm');
		$sheet->setCellValue('I1', 'Ngày cập nhật');

		$admin = new admin();
		$result = $admin->getAllNewsExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maTT']);
			$sheet->setCellValue('B' . $row, $set['tenTT']);
			$sheet->setCellValue('C' . $row, $set['anh']);
			$sheet->setCellValue('D' . $row, $set['ngay']);
			$sheet->setCellValue('E' . $row, $set['noidung']);
			$sheet->setCellValue('F' . $row, $set['chitiet']);
			$sheet->setCellValue('G' . $row, $set['tinhtrang']);
			$sheet->setCellValue('H' . $row, $set['ngaythem']);
			$sheet->setCellValue('I' . $row, $set['ngaycapnhat']);
			$row++;
		}

		$fileName = 'newsData-' . date('d-m-Y') . ".xlsx";
		ob_start();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');
		header('Cache-Control: max-age=0');
		ob_end_clean();

		// Save Excel file to PHP output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}

	public function exportDataContacts()
	{
		// Tạo một đối tượng PHPExcel
		$spreadsheet = new Spreadsheet();

		// Đặt tiêu đề cho file Excel
		$spreadsheet->getProperties()->setTitle("Danh sách sản phẩm");

		// Chọn sheet đầu tiên
		// $spreadsheet->setActiveSheetIndex(0);
		$sheet = $spreadsheet->getActiveSheet();

		// Thiết lập tiêu đề cho các cột
		$sheet->setCellValue('A1', 'Mã liên hệ');
		$sheet->setCellValue('B1', 'Người liên hệ');
		$sheet->setCellValue('C1', 'Email');
		$sheet->setCellValue('D1', 'Chủ đề');
		$sheet->setCellValue('E1', 'Nội dung');
		$sheet->setCellValue('F1', 'Trạng thái');
		$sheet->setCellValue('G1', 'Ngày gửi');

		$admin = new admin();
		$result = $admin->getAllContactExport();

		$row = 2;
		while ($set = $result->fetch()) {
			$sheet->setCellValue('A' . $row, $set['maLH']);
			$sheet->setCellValue('B' . $row, $set['tacgia']);
			$sheet->setCellValue('C' . $row, $set['email']);
			$sheet->setCellValue('D' . $row, $set['chude']);
			$sheet->setCellValue('E' . $row, $set['noidung']);
			$sheet->setCellValue('F' . $row, $set['trangthai']);
			$sheet->setCellValue('G' . $row, $set['ngaygui']);
			$row++;
		}

		$fileName = 'contactData-' . date('d-m-Y') . ".xlsx";
		ob_start();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');
		header('Cache-Control: max-age=0');
		ob_end_clean();

		// Save Excel file to PHP output
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}
}
