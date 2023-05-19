<?php
include_once 'a-dhAjax.php';

if (!empty($_POST['id'])) {
	$id = $_POST['id'];
	$maSP = $_POST['maSP'];

	$user = new user();
	$result = $user->addWishlist($id, $maSP);
	if ($result == 1) {
		echo json_encode(array(
			'status' => 1,
			'message' => 'Yêu thích sản phẩm'
		));
	} else {
		echo json_encode(array(
			'status' => 2,
			'message' => 'Bỏ yêu thích sản phẩm'
		));
	}
} else {
	echo json_encode(array(
		'status' => 0,
		'message' => 'Vui lòng đăng nhập để lưu sản phẩm'
	));
}
