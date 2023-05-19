<?php
$action = "home";
if (isset($_GET['action'])) {
	$action = $_GET['action'];
}

switch ($action) {
	case "privacy-policy":
		include_once "View/privacy-policy.php";
		break;
	case "terms":
		include_once "View/terms.php";
		break;
	case "home":
		include_once "dh-home.php";
		break;
	case "about":
		include_once "dh-about.php";
		break;
	case "contact":
		include_once "View/contact.php";
		break;
	case "blog":
		include_once "dh-blog.php";
		break;
	case "blog-2":
		include_once "dh-blog-2.php";
		break;
	case "blog-detail":
		include_once "dh-blog-detail.php";
		break;
	case "checkout":
		if (isset($_SESSION['productCart']) && count($_SESSION['productCart']) > 0) {
			include_once "View/checkout.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=cart-page"/>';
		}
		break;
	case "shop":
		include_once "dh-shop.php";
		break;
		// add - remove - update
	case "cart-page":
		include_once "View/cart-page.php";
		break;
	case "product-detail":
		include_once "dh-product-detail.php";
		break;
	case "projects":
		include_once "dh-projects.php";
		break;
	case "login-account":
		if (empty($_SESSION['id'])) {
			include_once "View/login-account.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		}
		break;
	case "register-account":
		if (empty($_SESSION['id'])) {
			include_once "View/register-account.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		}
		break;
	case "myAccount":
		if (!empty($_SESSION['id']) && $_SESSION['id'] != '') {
			if (isset($_GET['get']) && $_GET['get'] == 'updateImageAccount') {
				// echo "<br>";
				// print_r($_FILES);
				// echo "</br>";
				if (isset($_FILES['imageAccount']['name']) && $_FILES['imageAccount']['name'] != '') {
					$code = '';
					$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
					$charactersLength = strlen($characters);
					$codeLength = 8;
					for ($i = 0; $i < $codeLength; $i++) {
						$code .= $characters[rand(0, $charactersLength - 1)];
					}
					$imageExtension = strtolower(pathinfo($_FILES['imageAccount']['name'], PATHINFO_EXTENSION));
					$saveImageName = $code . "." . $imageExtension;

					$user = new user();
					$result = $user->updateImageAccount($_SESSION['id'], $saveImageName);
					if ($result) {
						$addImage = new addImage();
						$result1 = $addImage->addImageAccount($_FILES['imageAccount'], $saveImageName, $_SESSION['image']);

						$_SESSION['image'] = $saveImageName;
						// die;
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
					} else {
						// die;
						echo "<script>alert('Đã có lỗi xãy ra trong quá trình xử lý')</script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
					}
				} else {
					echo "<script>alert('Bạn chưa chọn ảnh để cập nhật!!')</script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
				}
			}
			include_once "View/myAccount.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		}
		break;
	case "invoiceDetail":
		if (!empty($_SESSION['id']) && $_SESSION['id'] != '') {
			include_once "dh-invoiceDetail.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		}
		break;
	case "returnProduct":
		if (isset($_GET['id']) && intval($_GET['id'])) {
			include "View/returnProduct.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		}
		break;
	case "reset-password":
		include_once "dh-reset-password.php";
		break;

		// services
	case "services-dark":
		include_once "dh-services-dark.php";
		break;
	case "services-light":
		include_once "dh-services-light.php";
		break;
	case "commercial-interior":
		include_once "services/dh-commercial-interior.php";
		break;
	case "false-celling-design":
		include_once "services/dh-false-celling-design.php";
		break;
	case "hospitality-design":
		include_once "services/dh-hospitality-design.php";
		break;
	case "modern-furniture":
		include_once "services/dh-modern-furniture.php";
		break;
	case "modular-kitchen":
		include_once "services/dh-modular-kitchen.php";
		break;
	case "office-interior":
		include_once "services/dh-office-interior.php";
		break;
	case "residental-interior":
		include_once "services/dh-residental-interior.php";
		break;
	case "wardrobe":
		include_once "services/dh-wardrobe.php";
		break;
		// Not found
	case "404":
		include_once "View/404.php";
		break;
	case "logout-account":
		$user = new user();
		$user->logout();
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
		break;
	case "subscribe":
		if (empty($_POST['email'])) {
			echo "<script> alert('Vui lòng nhập email') </script>";
			include 'View/home.php';
		} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo "<script> alert('Email không hợp lệ') </script>";
			include 'View/home.php';
		} else {
			$validate = new validate();
			$checkEmailSubscribe = $validate->checkExistsSubscribeEmail($_POST['email']);
			if (empty($checkEmailSubscribe)) {
				$user = new user();
				$emailSubscribe = $user->emailSubscribe($_POST['email']);
				if ($emailSubscribe) {
					echo "<script> alert('Đăng ký thành công') </script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
				} else {
					echo "<script> alert('Đã xãy ra lỗi trong quá trình đăng ký!!') </script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
				}
			} else {
				echo "<script> alert('Email đã tồn tại') </script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=home"/>';
			}
		}
		break;

	default:
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
		break;
}
