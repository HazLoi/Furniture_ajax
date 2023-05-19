<?php
include 'a-dhAjax.php';
if (isset($_GET['act'])) {
	if ($_GET['act'] == 'saveInfo') {
		$fullname = $_POST['fullname'];
		$date = $_POST['date'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];

		$user = new admin();
		$existsEmail = $user->existsEmailAdmin($email);
		if ($existsEmail && $email != $_SESSION['email_admin']) {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Email đã tồn tại'
			));
		} else {
			$result = $user->saveInfoAdmin($_SESSION['id_admin'], $fullname, $date, $email, $gender, $address, $phone);
			if (!empty($result)) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Thay đổi thông tin thành công'
				));
				$_SESSION['fullname_admin'] = $fullname;
				$_SESSION['email_admin'] = $email;
				$_SESSION['phone_admin'] = $phone;
				$_SESSION['gender_admin'] = $gender;
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Thông tin chưa thay đổi'
				));
			}
		}
	}

	if ($_GET['act'] == 'changePasswordAdmin') {
		$password = $_POST['password'];
		$passwordNew = $_POST['passwordNew'];
		$passwordRenew = $_POST['passwordRenew'];

		$admin = new admin();
		$admin->changePassword($_SESSION['id_admin'], $password, $passwordNew);
	}
}
