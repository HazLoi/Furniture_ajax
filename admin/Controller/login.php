<?php
include_once 'a-dhAjax.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
	// echo 1123;
	$email = $_POST['email'];
	$password = $_POST['password'];
	$login = new admin();
	$result = $login->loginAdmin($email, $password);

	if (!empty($result)) {
		// đăng nhập thành công và lưu thông tin người dùng
		$_SESSION['id_admin'] = $result['id'];
		$_SESSION['fullname_admin'] = $result['hovaten'];
		$_SESSION['email_admin'] = $result['email'];
		$_SESSION['lname_admin'] = $result['ten'];
		$_SESSION['fname_admin'] = $result['ho'];
		$_SESSION['phone_admin'] = $result['sdt'];
		$_SESSION['image_admin'] = $result['anh'];
		$_SESSION['gender_admin'] = $result['gioitinh'];
		echo json_encode(array(
			'status' => 1,
			'message' => 'Đăng nhập thành công'
		));
	} else {
		echo json_encode(array(
			'status' => 2,
			'message' => 'Tài khoản hoặc mật khẩu không đúng'
		));
	}
} else {
	echo json_encode(array(
		'status' => 0,
		'message' => 'Thông tin không hợp lệ'
	));
}
