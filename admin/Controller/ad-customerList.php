<?php
include_once 'a-dhAjax.php';

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'deleteCustomer') {
		$admin = new admin();
		$result = $admin->deleteCustomer($_POST['id']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Ẩn tài khoản thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Ẩn tài khoản thất bại'
			));
		}
	}
	if ($_GET['act'] == 'dropCustomer') {
		$admin = new admin();
		$result = $admin->dropCustomer($_POST['id']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Xóa tài khoản thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Xóa tài khoản thất bại'
			));
		}
	}
	if ($_GET['act'] == 'restoreCustomer') {
		$admin = new admin();
		$result = $admin->restoreCustomer($_POST['id']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Khôi phục tài khoản thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Khôi phục tài khoản thất bại'
			));
		}
	}
}
