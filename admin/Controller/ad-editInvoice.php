<?php
include_once 'a-dhAjax.php';

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'editTT') {
		$admin = new admin();
		$result = $admin->editTT($_POST['tinhtrang'], $_POST['maHD']);

		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Cập nhật trạng thái thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Cập nhật trạng thái thất bại'
			));
		}
		
	}
	if ($_GET['act'] == 'editCompanyName') {
		$admin = new admin();
		$result = $admin->editCompany($_POST['companyName'], $_POST['maHD']);

		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Cập nhật tên công ty thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Cập nhật tên công ty thất bại'
			));
		}
	}
	if ($_GET['act'] == 'editAddress1') {
		$admin = new admin();
		$result = $admin->editAddress1($_POST['address'], $_POST['maHD']);

		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Cập nhật địa chỉ chính thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Cập nhật địa chỉ chính thất bại'
			));
		}
	}
	if ($_GET['act'] == 'editAddress2') {
		$admin = new admin();
		$result = $admin->editAddress2($_POST['address'], $_POST['maHD']);

		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Cập nhật địa chỉ phụ thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Cập nhật địa chỉ phụ thất bại'
			));
		}
	}
	if($_GET['act'] == 'editInvoice'){
		$admin = new admin();
		$result = $admin->editNote($_POST['noteInvoice'], $_POST['maHD']);
		if($result){
			echo json_encode(array(
				'status' => 1,
				'message' => 'Cập nhật thành công'
			));
		}else{
			echo json_encode(array(
				'status' => 0,
				'message' => 'Cập nhật thất bại'
			));
		}
	}

	if ($_GET['act'] == 'deleteInvoiceDetail') {
		$admin = new admin();
		$result = $admin->deleteInvoiceDetail($_POST['maSP'], $_POST['maHD']);
	}
	if ($_GET['act'] == 'restoreInvoiceDetail') {
		$admin = new admin();
		$result = $admin->restoreInvoiceDetail($_POST['maSP'], $_POST['maHD']);
	}
	if ($_GET['act'] == 'updateQtyProductInvoiceDetail') {
		$maHD = $_POST['maHD'];
		$maSP = $_POST['maSP'];
		$soluong = $_POST['soluong'];
		$dongia = $_POST['dongia'];

		$product = new product();
		$check = $product->checkInStock($maSP);

		$db = new connect();
		$select = "SELECT tenSP FROM ct_hoadon WHERE maHD = $maHD and maSP = $maSP";
		$a = $db->getInstance($select);
		$tenSP = $a['tenSP'];

		if ($soluong >= 0) {
			if ($soluong <= $check) {
				$admin = new admin();
				$edit =  $admin->editInvoice($maHD, $maSP, $soluong, $dongia);
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => "$tenSP chỉ còn $check sản phẩm",
				));
			}
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => "Nhập số lượng không hợp lệ",
			));
		}
	}
}
