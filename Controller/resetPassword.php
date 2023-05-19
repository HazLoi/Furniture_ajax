<?php
include_once 'a-dhAjax.php';

$email = $_SESSION['emailResetPassword'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$user = new user();
$result = $user->resetPassword($email, $repassword);

if($result){
	echo json_encode(array(
		'status' => 1,
		'message' => 'Đổi mật khẩu thành công'
	));
}else{
	echo json_encode(array(
		'status' => 0,
		'message' => 'Đổi mật khẩu thất bại'
	));
}