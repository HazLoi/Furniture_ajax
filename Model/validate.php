<?php
class validate
{
	private $db = null;
	public function __construct()
	{
		$this->db = new connect();
	}

	public function contactValidate($fullname, $email, $subject, $message)
	{
		function contact($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$fullname = contact($fullname);
		$email = contact($email);
		$subject = contact($subject);
		$message = contact($message);

		$_SESSION['fullnameErrorContact'] = $_SESSION['emailErrorContact'] = $_SESSION['subjectErrorContact'] = $_SESSION['messageErrorContact'] = "";

		// if (empty($fullname)) {
		// 	$_SESSION['fullnameErrorContact'] = "Tên không được để trống";
		// } else {
		// 	$fullname_pattern = "/^[\w\s][^\d]+$/";
		// 	if (!preg_match($fullname_pattern, $fullname)) {
		// 		$_SESSION['fullnameErrorContact'] = "Tên không hợp lệ";
		// 	} else {
		// 		$_SESSION['fullnameErrorContact'] = "";
		// 	}
		// }

		if (empty($fullname)) {
			$_SESSION['fullnameErrorContact'] = "Tên của bạn không được để trống";
		} else {
			$fullname_pattern = "/^[a-zA-Z\s\D]+$/";
			if (!preg_match($fullname_pattern, $fullname)) {
				$_SESSION['fullnameErrorContact'] = "Tên không được có số ";
			} else {
				$_SESSION['fullnameErrorContact'] = "";
			}
		}

		if (empty($email)) {
			$_SESSION['emailErrorContact'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorContact'] = "Email không hợp lệ";
			} else {
				$_SESSION['emailErrorContact'] = "";
			}
		}

		if (empty($subject)) {
			$_SESSION['subjectErrorContact'] = "Vui lòng nhập chủ đề";
		} else {
			$_SESSION['subjectErrorContact'] = "";
		}

		if (empty($message)) {
			$_SESSION['messageErrorContact'] = "Nội dung không được để trống";
		} else {
			$_SESSION['messageErrorContact'] = "";
		}

		if ($_SESSION['fullnameErrorContact'] == "" && $_SESSION['emailErrorContact'] == "" && $_SESSION['subjectErrorContact'] == "" && $_SESSION['messageErrorContact'] == "") {
			return 1;
		}
	}

	public function checkoutValidate($fname, $lname, $address1, $city, $country, $code, $email, $phone)
	{
		function checkout($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$fname = checkout($fname);
		$lname = checkout($lname);
		$address1 = checkout($address1);
		$city = checkout($city);
		$country = checkout($country);
		$code = checkout($code);
		$email = checkout($email);
		$phone = checkout($phone);
		//Tạo để lưu lỗi vào session
		$_SESSION['fnameErrorCheckout'] = "";
		$_SESSION['lnameErrorCheckout'] = "";
		$_SESSION['address1ErrorCheckout'] = "";
		$_SESSION['cityErrorCheckout'] = "";
		$_SESSION['countryErrorCheckout'] = "";
		$_SESSION['codeErrorCheckout'] = "";
		$_SESSION['emailErrorCheckout'] = "";
		$_SESSION['phoneErrorCheckout'] = "";

		if (empty($fname)) {
			$_SESSION['fnameErrorCheckout'] = "Họ của bạn không được để trống";
		} else {
			$fname_pattern = "/\d/";
			if (preg_match($fname_pattern, $fname)) {
				$_SESSION['fnameErrorCheckout'] = "Họ của bạn không được có số ";
			} else {
				$_SESSION['fnameErrorCheckout'] = "";
			}
		}

		if (empty($lname)) {
			$_SESSION['lnameErrorCheckout'] = "Tên của bạn không được để trống";
		} else {
			$lname_pattern = "/\d/";
			if (preg_match($lname_pattern, $lname)) {
				$_SESSION['lnameErrorCheckout'] = "Tên của bạn không được có số ";
			} else {
				$_SESSION['lnameErrorCheckout'] = "";
			}
		}

		if (empty($address1)) {
			$_SESSION['address1ErrorCheckout'] = "Địa chỉ không được để trống";
		}

		if (empty($city)) {
			$_SESSION['cityErrorCheckout'] = "Tỉnh / Thành phố không được để trống";
		}

		if ($country == "null") {
			$_SESSION['countryErrorCheckout'] = "Khu vực / Quốc gia không được để trống";
		}

		if (empty($code)) {
			$_SESSION['codeErrorCheckout'] = "Mã bưu điện / Zip không được để trống";
		}

		if (empty($email)) {
			$_SESSION['emailErrorCheckout'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorCheckout'] = "Email không hợp lệ";
			} else {
				$_SESSION['emailErrorCheckout'] = "";
			}
		}

		if (empty($phone)) {
			$_SESSION['phoneErrorCheckout'] = "Số điện thoại không được để trống";
		} else {
			$phone_pattern = "/^[0]{1}\d{9,10}$/";
			if (!preg_match($phone_pattern, $phone)) {
				$_SESSION['phoneErrorCheckout'] = "Số điện thoại không hợp lệ";
			} else {
				$_SESSION['phoneErrorCheckout'] = "";
			}
		}


		if (
			$_SESSION['lnameErrorCheckout'] == "" &&
			$_SESSION['fnameErrorCheckout'] == "" &&
			$_SESSION['address1ErrorCheckout'] == "" &&
			$_SESSION['cityErrorCheckout'] == "" &&
			$_SESSION['countryErrorCheckout'] == "" &&
			$_SESSION['codeErrorCheckout'] == "" &&
			$_SESSION['emailErrorCheckout'] == "" &&
			$_SESSION['phoneErrorCheckout'] == ""
		) {
			return 1;
		}
	}

	public function checkComment($fname, $lname, $email, $content, $rating)
	{
		function comment($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$fname = comment($fname);
		$lname = comment($lname);
		$email = comment($email);
		$content = comment($content);
		$rating = comment($rating);
		//Tạo để lưu lỗi vào session
		$_SESSION['fnameErrorComment'] = "";
		$_SESSION['lnameErrorComment'] = "";
		$_SESSION['emailErrorComment'] = "";
		$_SESSION['contentErrorComment'] = "";
		$_SESSION['ratingErrorComment'] = "";

		if (empty($fname)) {
			$_SESSION['fnameErrorComment'] = "Họ của bạn không được để trống";
		} else {
			$fname_pattern = "/\d/";
			if (preg_match($fname_pattern, $fname)) {
				$_SESSION['fnameErrorComment'] = "Họ của bạn không được có số ";
			} else {
				$_SESSION['fnameErrorComment'] = "";
			}
		}

		if (empty($lname)) {
			$_SESSION['lnameErrorComment'] = "Tên của bạn không được để trống";
		} else {
			$lname_pattern = "/\d/";
			if (preg_match($lname_pattern, $lname)) {
				$_SESSION['lnameErrorComment'] = "Tên của bạn không được có số ";
			} else {
				$_SESSION['lnameErrorComment'] = "";
			}
		}

		if (empty($content)) {
			$_SESSION['contentErrorComment'] = "Nội dung không được để trống";
		} else {
			$_SESSION['contentErrorComment'] = "";
		}

		if (empty($rating)) {
			$_SESSION['ratingErrorComment'] = "Vui lòng đánh giá sản phẩm";
		} else {
			$_SESSION['ratingErrorComment'] = "";
		}

		if (empty($email)) {
			$_SESSION['emailErrorComment'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorComment'] = "Email không hợp lệ";
			} else {
				$_SESSION['emailErrorComment'] = "";
			}
		}

		if (
			$_SESSION['fnameErrorComment'] == "" &&
			$_SESSION['lnameErrorComment'] == "" &&
			$_SESSION['contentErrorComment'] == "" &&
			$_SESSION['ratingErrorComment'] == "" &&
			$_SESSION['emailErrorComment'] == ""
		) {
			return 1;
		}
	}

	// public function checkSaveInfoAccount($fullname, $date, $email, $address, $phone, $zip)
	// {
	// 	function infoAccount($data)
	// 	{
	// 		$data = trim($data); // bỏ khoảng trống 2 đầu
	// 		$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
	// 		$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
	// 		return $data;
	// 	}

	// 	$phone = infoAccount($phone);
	// 	$zip = infoAccount($zip);
	// 	$fullname = infoAccount($fullname);
	// 	$date = infoAccount($date);
	// 	$email = infoAccount($email);
	// 	$address = infoAccount($address);
	// 	//Tạo để lưu lỗi vào session
	// 	$_SESSION['fullnameErrorSaveInfoAccount'] = "";
	// 	$_SESSION['phoneErrorSaveInfoAccount'] = "";
	// 	$_SESSION['emailErrorSaveInfoAccount'] = "";
	// 	$_SESSION['addressErrorSaveInfoAccount'] = "";
	// 	$_SESSION['dateErrorSaveInfoAccount'] = "";

	// 	if (empty($fullname)) {
	// 		$_SESSION['fullnameErrorSaveInfoAccount'] = "Họ và tên không được để trống";
	// 	} else {
	// 		$fullname_pattern = "/\d/";
	// 		if (preg_match($fullname_pattern, $fullname)) {
	// 			$_SESSION['fullnameErrorSaveInfoAccount'] = "Họ và tên không được có số ";
	// 		} else {
	// 			$_SESSION['fullnameErrorSaveInfoAccount'] = "";
	// 		}
	// 	}

	// 	if (empty($date)) {
	// 		$_SESSION['dateErrorSaveInfoAccount'] = "Ngày sinh không được để trống";
	// 	} else {
	// 		$_SESSION['dateErrorSaveInfoAccount'] = "";
	// 	}

	// 	if (empty($address)) {
	// 		$_SESSION['addressErrorSaveInfoAccount'] = "Địa chỉ không được để trống";
	// 	} else {
	// 		$_SESSION['addressErrorSaveInfoAccount'] = "";
	// 	}

	// 	if (empty($zip)) {
	// 		$_SESSION['zipErrorSaveInfoAccount'] = "Mã zip không được để trống";
	// 	} else {
	// 		if (strlen($zip) < 5) {
	// 			$_SESSION['zipErrorSaveInfoAccount'] = "Mã zip không hợp lệ";
	// 		} else {
	// 			$_SESSION['zipErrorSaveInfoAccount'] = "";
	// 		}
	// 	}

	// 	if (empty($email)) {
	// 		$_SESSION['emailErrorSaveInfoAccount'] = "Email không được để trống";
	// 	} else {
	// 		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	// 			$_SESSION['emailErrorSaveInfoAccount'] = "Email không hợp lệ";
	// 		} else {
	// 			$_SESSION['emailErrorSaveInfoAccount'] = "";
	// 		}
	// 	}

	// 	if (empty($phone)) {
	// 		$_SESSION['phoneErrorSaveInfoAccount'] = "Số điện thoại không được để trống";
	// 	} else {
	// 		$phone_pattern = "/^[0]{1}\d{9,10}$/";
	// 		if (!preg_match($phone_pattern, $phone)) {
	// 			$_SESSION['phoneErrorSaveInfoAccount'] = "Số điện thoại không hợp lệ";
	// 		} else {
	// 			$_SESSION['phoneErrorSaveInfoAccount'] = "";
	// 		}
	// 	}

	// 	if (
	// 		$_SESSION['fullnameErrorSaveInfoAccount'] == "" &&
	// 		$_SESSION['dateErrorSaveInfoAccount'] == "" &&
	// 		$_SESSION['addressErrorSaveInfoAccount'] == "" &&
	// 		$_SESSION['phoneErrorSaveInfoAccount'] == "" &&
	// 		$_SESSION['zipErrorSaveInfoAccount'] == "" &&
	// 		$_SESSION['emailErrorSaveInfoAccount'] == ""
	// 	) {
	// 		return 1;
	// 	}
	// }

	public function checkChangePassword($password, $passwordNew, $passwordRenew)
	{
		function changepassword($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$password = changepassword($password);
		$passwordNew = changepassword($passwordNew);
		$passwordRenew = changepassword($passwordRenew);
		//Tạo để lưu lỗi vào session
		$_SESSION['passwordErrorChangePassword'] = "";
		$_SESSION['passwordNewErrorChangePassword'] = "";
		$_SESSION['passwordRenewErrorChangePassword'] = "";


		if (empty($password)) {
			$_SESSION['passwordErrorChangePassword'] = "Vui lòng nhập mật khẩu";
		} else {
			$_SESSION['passwordErrorChangePassword'] = "";
		}

		if (empty($passwordNew)) {
			$_SESSION['passwordNewErrorChangePassword'] = "Vui lòng nhập mật khẩu";
		} else {
			$passwordNew_pattern = "/^[a-zA-Z0-9]{5,}$/";
			if (!preg_match($passwordNew_pattern, $passwordNew)) {
				$_SESSION['passwordNewErrorChangePassword'] = "Mật khẩu phải có độ dài từ 5 ký tự trở lên";
			} elseif (strlen($passwordNew) > 30) {
				$_SESSION['passwordNewErrorChangePassword'] = "Mật khẩu không được vượt quá 30 ký tự";
			} else {
				$_SESSION['passwordNewErrorChangePassword'] = "";
			}
		}

		if ($passwordNew != $passwordRenew) {
			$_SESSION['passwordRenewErrorChangePassword'] = "Mật khẩu không hợp lệ";
		} else {
			$_SESSION['passwordRenewErrorChangePassword'] = "";
		}



		if (
			$_SESSION['passwordErrorChangePassword'] == "" &&
			$_SESSION['passwordNewErrorChangePassword'] == "" &&
			$_SESSION['passwordRenewErrorChangePassword'] == ""
		) {
			return 1;
		}
	}

	public function checkAddCategory($categoryName)
	{
		function addcategory($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$categoryName = addcategory($categoryName);
		//Tạo để lưu lỗi vào session
		$_SESSION['categoryNameErrorAddCategory'] = "";

		if (empty($categoryName)) {
			$_SESSION['categoryNameErrorAddCategory'] = "Tên loại không được để trống";
		} else {
			$categoryName_pattern = "/\d/";
			if (preg_match($categoryName_pattern, $categoryName)) {
				$_SESSION['categoryNameErrorAddCategory'] = "Tên loại không được có số ";
			} else {
				$_SESSION['categoryNameErrorAddCategory'] = "";
			}
		}

		if (
			$_SESSION['categoryNameErrorAddCategory'] == ""
		) {
			return 1;
		}
	}

	public function checkEditCategory($categoryName)
	{
		function editcategory($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$categoryName = editcategory($categoryName);
		//Tạo để lưu lỗi vào session
		$_SESSION['categoryNameErrorEditCategory'] = "";



		if (empty($categoryName)) {
			$_SESSION['categoryNameErrorEditCategory'] = "Tên loại không được để trống";
		} else {
			$categoryName_pattern = "/\d/";
			if (preg_match($categoryName_pattern, $categoryName)) {
				$_SESSION['categoryNameErrorEditCategory'] = "Tên loại không được có số ";
			} else {
				$_SESSION['categoryNameErrorEditCategory'] = "";
			}
		}

		if (
			$_SESSION['categoryNameErrorEditCategory'] == ""
		) {
			return 1;
		}
	}

	public function checkResetPassword($password, $repassword)
	{
		function resetpassword($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$password = resetpassword($password);
		$repassword = resetpassword($repassword);
		//Tạo để lưu lỗi vào session
		$_SESSION['passwordErrorResetPassword'] = "";
		$_SESSION['repasswordErrorResetPassword'] = "";

		if (empty($password)) {
			$_SESSION['passwordErrorResetPassword'] = "Vui lòng nhập mật khẩu";
		} else {
			$password_pattern = "/^[a-zA-Z0-9]{5,}$/";
			if (!preg_match($password_pattern, $password)) {
				$_SESSION['passwordErrorResetPassword'] = "Mật khẩu phải có độ dài từ 5 ký tự trở lên";
			} elseif (strlen($password) > 30) {
				$_SESSION['passwordErrorResetPassword'] = "Mật khẩu không được vượt quá 30 ký tự";
			} else {
				$_SESSION['passwordErrorResetPassword'] = "";
			}
		}

		if ($password != $repassword) {
			$_SESSION['repasswordErrorResetPassword'] = "Mật khẩu nhập lại không đúng";
		} else {
			$_SESSION['repasswordErrorResetPassword'] = "";
		}

		if (
			$_SESSION['passwordErrorResetPassword'] == "" &&
			$_SESSION['repasswordErrorResetPassword'] == ""
		) {
			return 1;
		}
	}






	public function checkAddProductName($productName)
	{
		$query = "SELECT * FROM sanpham WHERE ten = '$productName'";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsProductName($productId, $productName)
	{
		$query = "SELECT * FROM sanpham WHERE maSP != $productId and ten = '$productName'";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsInvoice($invoiceId)
	{
		$query = "SELECT * FROM hoa_don WHERE maHD = $invoiceId";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsCustomer($customerId)
	{
		$query = "SELECT * FROM nguoi_dung WHERE id = $customerId";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsProduct($productId)
	{
		$query = "SELECT * FROM sanpham WHERE maSP = $productId";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsNews($newsId)
	{
		$query = "SELECT tenTT FROM tin_tuc WHERE maTT = $newsId";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsCategoryName($categoryId, $categoryName)
	{
		$query = "SELECT tenloai FROM loai_sanpham WHERE maLoai != $categoryId and tenloai = '$categoryName'";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsCategory($categoryId)
	{
		$query = "SELECT tenloai FROM loai_sanpham WHERE maLoai = $categoryId";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsEmail($email)
	{
		$query = "SELECT * FROM nguoi_dung WHERE email = '$email'";
		$result = $this->db->getInstance($query);
		return $result;
	}

	public function checkExistsSubscribeEmail($email)
	{
		$query = "SELECT * FROM email_dktruoc WHERE email = '$email'";
		$result = $this->db->getInstance($query);
		return $result;
	}
}
