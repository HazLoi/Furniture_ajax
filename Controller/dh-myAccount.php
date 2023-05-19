<?php
if (isset($_SESSION['id']) && $_SESSION['id'] != '') {
	$user = new user();
	$result = $user->getInfoByCustomerId($_SESSION['id']);
	$fname = $result['ho'];
	$lname = $result['ten'];
	$fullname = $result['hovaten'];
	$email = $result['email'];
	$phone = $result['sdt'];
	$address = $result['diachi'];
	$date = $result['ngaysinh'];
	$gender = $result['gioitinh'];
	include_once "View/myAccount.php";
} else {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
}
