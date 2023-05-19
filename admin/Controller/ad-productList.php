<?php
include_once 'a-dhAjax.php';

$admin = new admin();
if (isset($_GET['act'])) {
	if (!empty($_POST['maSP']) && intval($_POST['maSP']) != '') {
		if ($_GET['act'] == 'deleteProduct') {
			$result = $admin->deleteProductDatabase($_POST['maSP']);
			if ($result) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Ẩn sản phẩm thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Ẩn sản phẩm thất bại'
				));
			}
		} else if ($_GET['act'] == 'dropProduct') {
			$result = $admin->dropProduct($_POST['maSP']);
			if ($result) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Xóa sản phẩm thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Xóa sản phẩm thất bại'
				));
			}
		} else if ($_GET['act'] == 'restoreProduct') {
			$result = $admin->restoreProduct($_POST['maSP']);
			if ($result) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Khôi phục sản phẩm thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Khôi phục sản phẩm thất bại'
				));
			}
		} else if ($_GET['act'] == 'deleteCommentProduct') {
			$result = $admin->deleteCommentProduct($_POST['maSP'], $_POST['idComment']);
			if ($result) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Ẩn bình luận thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Ẩn bình luận thất bại'
				));
			}
		} else if ($_GET['act'] == 'dropCommentProduct') {
			$result = $admin->dropCommentProduct($_POST['maSP'], $_POST['idComment']);
			if ($result) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Xóa bình luận thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Xóa bình luận thất bại'
				));
			}
		} else if ($_GET['act'] == 'restoreCommentProduct') {
			$result = $admin->restoreCommentProduct($_POST['maSP'], $_POST['idComment']);
			if ($result) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Khôi phục bình luận thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Khôi phục bình luận thất bại'
				));
			}
		}
	} else {
		echo json_encode(array(
			'status' => 0,
			'message' => 'Mã sản phẩm không tồn tại'
		));
	}
}
