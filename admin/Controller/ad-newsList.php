<?php
include_once 'a-dhAjax.php';

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'deleteNews') {
		$admin = new admin();
		$result = $admin->deleteNews($_POST['maTT']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Ẩn tin tức thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Ẩn tin tức thất bại'
			));
		}
	}
	if ($_GET['act'] == 'dropNews') {
		$admin = new admin();
		$result = $admin->dropNews($_POST['maTT']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Xóa tin tức thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Xóa tin tức thất bại'
			));
		}
	}
	if ($_GET['act'] == 'restoreNews') {
		$admin = new admin();
		$result = $admin->restoreNews($_POST['maTT']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Khôi phục tin tức thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Khôi phục tin tức thất bại'
			));
		}
	}
}
