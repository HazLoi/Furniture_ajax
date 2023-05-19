<?php
if (isset($_GET['act']) && $_GET['act'] == 'send') {
	$validate = new validate();

	$result = $validate->contactValidate($_POST['fullname'], $_POST['email'], $_POST['subject'], $_POST['message']);
	if ($result == 1) {
		// ucwords : viết hoa chữ cái đầu mỗi từ trong chuỗi
		// strtolower : đưa về dạng chữ thường
		// $x = strtolower($_POST['fullname']);
		// $name = ucwords($x);

		// $email = strtolower($_POST['email']);
		$subject = $_POST['subject'];

		$z = strtolower($_POST['message']);
		$message = ucwords($z);

		$contact = new contact();
		$insertContact = $contact->insertContact($_POST['fullname'], $_POST['email'], $subject, $message);

		$send = new sendEmail();
		$send->sendContentContact($_POST['fullname'], $_POST['email'], $subject, $message);

		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=contact"/>';
	} else {
		include_once "./View/contact.php";
	}
}
include_once "./View/contact.php";
