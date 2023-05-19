<?php
include_once 'a-dhAjax.php';

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'deleteInvoice') {
		$admin = new admin();
		$result = $admin->deleteInvoice($_POST['maHD']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Ẩn hóa đơn thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Ẩn hóa đơn thất bại'
			));
		}
	}
	if ($_GET['act'] == 'dropInvoice') {
		$admin = new admin();
		$result = $admin->dropInvoice($_POST['maHD']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Xóa hóa đơn thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Xóa hóa đơn thất bại'
			));
		}
	}
	if ($_GET['act'] == 'restoreInvoice') {
		$admin = new admin();
		$result = $admin->restoreInvoice($_POST['maHD']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Khôi phục hóa đơn thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Khôi phục hóa đơn thất bại'
			));
		}
	}
}
