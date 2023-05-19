<?php
include_once 'a-dhAjax.php';

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'dropAll') {
		$admin = new admin();
		$dropAll = $admin->dropAllNotify();
		if ($dropAll) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Xóa thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Xóa thất bại vui lòng xem lỗi'
			));
		}
	}
}
