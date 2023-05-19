<?php
include_once 'a-dhAjax.php';


$fname = $_POST['fname'];
$lname = $_POST['lname'];
$phoneNumber = $_POST['phoneNumber'];
$password = $_POST['password'];
$email = $_POST['email'];

// $validate = new validate();
// $checkValue = $validate->checkRegisterAccount($fname, $lname, $nameAccount, $email, $phoneNumber, $password, $repassword);

// if ($checkValue == 1) {
$register = new user();
$checkEmailAccount = $register->existsEmailAccount($email);
if (empty($checkEmailAccount)) {
	$register->registerAccount($fname, $lname, $phoneNumber, $email, $password);
	echo json_encode(array(
		'status' => 1,
		'message' => 'Đăng ký thành công'
	));
} else {
	echo json_encode(array(
		'status' => 0,
		'message' => 'Email đã tồn tại'
	));
}
