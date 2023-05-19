<?php
include_once 'a-dhAjax.php';
if (!empty($_POST['email']) && !empty($_POST['password'])) {
	// echo 1123;
	$email = $_POST['email'];
	$password = $_POST['password'];
	$login = new user();
	$result = $login->loginAccount($email, $password);
	if (!empty($result)) {
		// đăng nhập thành công và lưu thông tin người dùng
		$_SESSION['id'] = $result['id'];
		$_SESSION['fullname'] = $result['hovaten'];
		$_SESSION['email'] = $result['email'];
		$_SESSION['lname'] = $result['ten'];
		$_SESSION['fname'] = $result['ho'];
		$_SESSION['phone'] = $result['sdt'];
		$_SESSION['image'] = $result['anh'];
		$_SESSION['gender'] = $result['gioitinh'];
		echo json_encode(array(
			'status' => 1,
			'message' => 'Đăng nhập thành công'
		));
	} else {
		echo json_encode(array(
			'status' => 0,
			'message' => 'Tài khoản hoặc mật khẩu không đúng'
		));
	}
} else {
	echo json_encode(array(
		'status' => 0,
		'message' => 'Tài khoản hoặc mật khẩu không đúng'
	));
}
