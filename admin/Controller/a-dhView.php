<?php
$admin = new admin();
$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
$action = "home";
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}
switch ($action) {
	case 'home':
		include 'dh-admin-page.php';
		break;
	case 'export':
		include 'export.php';
		break;
	case 'login':
		include 'View/login.php';
		break;
	case 'admin-page':
		include 'dh-admin-page.php';
		break;
	case 'changePassword':
		include 'View/changePassword.php';
		break;
	case 'myAccount':
		if (isset($_GET['get']) && $_GET['get'] == 'updateImageAdmin') {
			$code = '';
			$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$charactersLength = strlen($characters);
			$codeLength = 8;
			for ($i = 0; $i < $codeLength; $i++) {
				$code .= $characters[rand(0, $charactersLength - 1)];
			}
			$imageExtension = strtolower(pathinfo($_FILES['imageAccount']['name'], PATHINFO_EXTENSION));
			$saveImageName = $code . "." . $imageExtension;

			$admin = new admin();
			$result = $admin->updateImageAdmin($_SESSION['id_admin'], $saveImageName);
			if ($result) {
				$addImage = new addImage();
				$result1 = $addImage->addImageAccount($_FILES['imageAccount'], $saveImageName, $_SESSION['image_admin']);

				$_SESSION['image_admin'] = $saveImageName;
				// die;
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
			} else {
				// die;
				echo "<script>alert('Đã có lỗi xãy ra trong quá trình xử lý')</script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
			}
		}
		include "View/myAccount.php";
		break;
	case 'logout':
		$conn = new connect();
		$update = "UPDATE admin SET hoatdong = 0 WHERE id = {$_SESSION['id_admin']}";
		$conn->exec($update);
		unset($_SESSION['id_admin']);
		unset($_SESSION['fullname_admin']);
		unset($_SESSION['email_admin']);
		unset($_SESSION['lname_admin']);
		unset($_SESSION['fname_admin']);
		unset($_SESSION['phone_admin']);
		unset($_SESSION['image_admin']);
		unset($_SESSION['gender_admin']);
		echo '<meta http-equiv="refresh" content="0; url=./"/>';
		break;
	default:
		echo '<meta http-equiv="refresh" content="0; url=./"/>';
		break;
}
