<?php
include_once 'a-dhAjax.php';

$admin = new admin();
$sendEmail = new sendEmail();
if (isset($_GET['act'])) {
	if ($_GET['act'] == 'repContact') {
		$authorSend = $_POST['authorSend'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$content = $_POST['content'];
		$repcontent = $_POST['repcontent'];
		$contactId = $_POST['contactId'];

		$result = $sendEmail->repContact($authorSend, $email, $subject, $content, $repcontent);

		if ($result == 1) {
			$updateRepContact = $admin->updateRepContact($contactId, $authorSend, $content, $repcontent);

			if ($updateRepContact !== false) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Gửi thư thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Đã có lỗi xãy ra trong quá trình lưu'
				));
			}
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Đã có lỗi trong quá trình gửi đi'
			));
		}
	}

	if ($_GET['act'] == 'dropContact') {
		$result = $admin->dropContact($_POST['maLH']);
		if ($result) {
			echo json_encode(array(
				'status' => 1,
				'message' => 'Xóa thư liên hệ thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Xóa thư liên hệ thất bại'
			));
		}
	}
}
