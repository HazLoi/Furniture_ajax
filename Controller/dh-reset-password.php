<?php
$_SESSION['sendCodeComplete'] = 0;
if (isset($_GET['act'])) {
	if ($_GET['act'] == 'reset') {
		if (!empty($_POST['email'])) {
			$validate = new validate();
			$result = $validate->checkExistsEmail($_POST['email']);
			if (!empty($result)) {
				$sendEmail = new resetPassword();
				$send  = $sendEmail->sendCodeResetPassword($_POST['email'], $result['hovaten']);
				include_once "View/reset-password.php";
			} else {
				echo '<script>alert("Email chưa được đăng ký")</script>';
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password"/>';
			}
		} else {
			echo '<script>alert("Vui lòng nhập email")</script>';
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password"/>';
		}
	}

	if ($_GET['act'] == 'submit') {
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('i');

		$a = $dateFix - $_SESSION['timeSendCode'];
		if ($a <= 5) {
			$code = $_POST['code'];
			if ($code == $_SESSION['codeResetPassword']) {
				$_SESSION['codeResetPassword'] = '';
				$_SESSION['sendCodeComplete'] = 1;
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password&act=complete"/>';
			} else {
				echo '<script>alert("Mã code không hợp lệ")</script>';
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password&act=complete"/>';

			}
		} else {
			$_SESSION['codeResetPassword'] = '';
			echo '<script>alert("Mã code đã hết hiệu lực")</script>';
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=reset-password"/>';
		}
	}

	if ($_GET['act'] == 'complete') {
		if (isset($_GET['get']) && $_GET['get'] == 'changePass') {
			include_once "View/reset-password.php";
		} else {
			include_once "View/reset-password.php";
		}
	}
} else {
	include_once "View/reset-password.php";
}
