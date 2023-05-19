<?php
include_once 'a-dhAjax.php';

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'deleteAdmin') {
		$admin = new admin();
		$result = $admin->deleteAdmin($_POST['id']);
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
	if ($_GET['act'] == 'dropAdmin') {
		$admin = new admin();
		$result = $admin->dropAdmin($_POST['id']);
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
	if ($_GET['act'] == 'restoreAdmin') {
		$admin = new admin();
		$result = $admin->restoreAdmin($_POST['id']);
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
