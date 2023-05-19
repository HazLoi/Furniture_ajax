<?php
include_once 'a-dhAjax.php';
if (isset($_GET['act'])) {
	if ($_GET['act'] == 'saveInfo') {
		$fullname = $_POST['fullname'];
		$date = $_POST['date'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];

		$user = new user();
		$existsEmail = $user->existsEmailAccount($email);
		if ($existsEmail && $email != $_SESSION['email']) {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Email đã tồn tại'
			));
		} else {
			$result = $user->saveInfoAccount($_SESSION['id'], $fullname, $date, $email, $gender, $address, $phone);
			if (!empty($result)) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Thay đổi thông tin thành công'
				));
				$_SESSION['fullname'] = $fullname;
				$_SESSION['email'] = $email;
				$_SESSION['phone'] = $phone;
				$_SESSION['gender'] = $gender;
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Thông tin chưa thay đổi'
				));
			}
		}
	}

	if ($_GET['act'] == 'changePasswordAccount') {
		$password = $_POST['password'];
		$passwordNew = $_POST['passwordNew'];
		$passwordRenew = $_POST['passwordRenew'];

		$user = new user();
		$user->changePassword($_SESSION['id'], $password, $passwordNew);
	}

	if ($_GET['act'] == 'deleteInvoice') {
		$user = new user();
		$result = $user->deleteInvoice($_POST['id'], $_SESSION['id']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Hủy đơn hàng thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Đã có lỗi xãy ra'
			));
		}
	}

	if ($_GET['act'] == 'deleteWishlist') {
		$user = new user();
		$result = $user->deleteWishlist($_POST['id'], $_SESSION['id']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Thay đổi thông tin thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Đã có lỗi xãy ra'
			));
		}
	}
	
	if ($_GET['act'] == 'checkInvoice') {
		$user = new user();
		$result = $user->checkInvoice($_POST['id'], $_SESSION['id']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Xác nhận thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Đã có lỗi xãy ra'
			));
		}
	}
}
