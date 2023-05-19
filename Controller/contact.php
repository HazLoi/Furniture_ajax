<?php
include_once 'a-dhAjax.php';

$subject = $_POST['subject'];
$message = $_POST['message'];

$contact = new contact();
$insertContact = $contact->insertContact($_POST['fullname'], $_POST['email'], $subject, $message);

// $send = new sendEmail();
// $sendContact = $send->sendContentContact($_POST['fullname'], $_POST['email'], $subject, $message);

if($insertContact > 0){
	echo json_encode(array(
		'status' => 1,
		'message' => 'Gửi thành công'
	));
}else{
	echo json_encode(array(
		'status' => 0,
		'message' => 'Đã có lỗi xãy ra'
	));
}

