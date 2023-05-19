<?php
include_once 'a-dhAjax.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$companyName = $_POST['companyName'];
$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$note = $_POST['note'];


$i = 0;

$checkout = new checkout();
$idInvoice = $checkout->insertInvoice($_SESSION['id']);
$total = 0;
if ($idInvoice) {
	foreach ($_SESSION['productCart'] as $key => $item) {
		$insertInvoiceDetails = $checkout->insertInvoiceDetails($idInvoice, $item['maSP'], $item['ten'], $item['soluong'], $item['dongia'], $item['thanhtien']);
		$total += $item['thanhtien'];
	}

	if ($insertInvoiceDetails) {
		$a = $checkout->saveInvoiceInfomation($idInvoice, $_SESSION['id'], $_SESSION['fullname'], $phone, $email, $companyName, $address1, $address2, $city, $note);
		$b = $checkout->updateInvoiceTotal($idInvoice, $total);

		($a) ? $a = 1 : $a = 0;
		($b) ? $b = 1 : $b = 0;
		$i = $a + $b;
		if ($i == 2) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Đặt hàng thành công'
			));
			array_splice($_SESSION['productCart'], 0, count($_SESSION['productCart']));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Đã có lỗi xãy ra'
			));
		}
	} else {
		echo json_encode(array(
			'status' => 0,
			'message' => 'Hãy báo với dịch vụ chăm sóc khách hàng'
		));
	}
} else {
	echo json_encode(array(
		'status' => 0,
		'message' => 'Hãy báo với dịch vụ chăm sóc khách hàng'
	));
}
