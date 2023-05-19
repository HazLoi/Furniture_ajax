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

	public function adminAddProduct($productName, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale)
	{
		function AAP($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$productName = AAP($productName);
		$image = AAP($image);
		$price = AAP($price);
		$sale = AAP($sale);
		$instock = AAP($instock);
		$selled = AAP($selled);
		$rate = AAP($rate);
		$like = AAP($like);
		$descriptionShort = AAP($descriptionShort);
		$descriptionLong = AAP($descriptionLong);
		$dateSale = AAP($dateSale);
		//Tạo để lưu lỗi vào session
		$_SESSION['productNameErrorAdminAddProduct'] = "";
		$_SESSION['descriptionShortErrorAdminAddProduct'] = "";
		$_SESSION['imageErrorAdminAddProduct'] = "";
		$_SESSION['priceErrorAdminAddProduct'] = "";
		$_SESSION['saleErrorAdminAddProduct'] = "";
		$_SESSION['instockErrorAdminAddProduct'] = "";
		$_SESSION['selledErrorAdminAddProduct'] = "";
		$_SESSION['rateErrorAdminAddProduct'] = "";
		$_SESSION['likeErrorAdminAddProduct'] = "";
		$_SESSION['descriptionShortErrorAdminAddProduct'] = "";
		$_SESSION['dateSaleErrorAdminAddProduct'] = "";

		if (empty($productName)) {
			$_SESSION['productNameErrorAdminAddProduct'] = "Tên sản phẩm không được để trống";
		} else {
			if (strlen($productName) > 90) {
				$_SESSION['productNameErrorAdminAddProduct'] = "Tên sản phẩm không được quá 90 ký tự";
			} else {
				$_SESSION['productNameErrorAdminAddProduct'] = "";
			}
		}

		if (empty($descriptionShort)) {
			$_SESSION['descriptionShortErrorAdminAddProduct'] = "Mô tả sản phẩm không được để trống";
		} else {
			$_SESSION['descriptionShortErrorAdminAddProduct'] = "";
		}

		if (empty($descriptionLong)) {
			$_SESSION['descriptionLongErrorAdminAddProduct'] = "Mô tả sản phẩm không được để trống";
		} else {
			$_SESSION['descriptionLongErrorAdminAddProduct'] = "";
		}

		if (empty($image)) {
			$_SESSION['imageErrorAdminAddProduct'] = "Ảnh sản phẩm không được bỏ trống";
		} else {
			$_SESSION['imageErrorAdminAddProduct'] = "";
		}

		if (empty($price)) {
			$_SESSION['priceErrorAdminAddProduct'] = "Giá tiền không được để trống";
		} else {
			if ($price < 0) {
				$_SESSION['priceErrorAdminAddProduct'] = "Giá tiền không hợp lệ";
			} else {
				$_SESSION['priceErrorAdminAddProduct'] = "";
			}
		}

		if ($sale < 0) {
			$_SESSION['saleErrorAdminAddProduct'] = "Giá tiền không hợp lệ";
		} else {
			$_SESSION['saleErrorAdminAddProduct'] = "";
		}

		if ($sale > 0) {
			if (empty($dateSale)) {
				$_SESSION['dateSaleErrorAdminAddProduct'] = "Ngày hết hạn giảm giá không được để trống";
			} else {
				$input = new DateTime($dateSale);
				$date = new DateTime('now');

				$diff = $date->diff($input);

				if ($diff->invert === 0 && $diff->days > 60) {
					$_SESSION['dateSaleErrorAdminAddProduct'] = "Tính từ ngày hiện tại ngày hết hạn giảm giá không quá 2 tháng";
				} else {
					$_SESSION['dateSaleErrorAdminAddProduct'] = "";
				}
			}
		}

		if (empty($instock)) {
			$_SESSION['instockErrorAdminAddProduct'] = "Số lượng tồn kho không được để trống";
		} else {
			if ($instock < 0) {
				$_SESSION['instockErrorAdminAddProduct'] = "Số  lượng tồn kho không hợp lệ";
			} else {
				$_SESSION['instockErrorAdminAddProduct'] = "";
			}
		}

		if ($selled < 0) {
			$_SESSION['selledErrorAdminAddProduct'] = "Số lượng đã bán không hợp lệ";
		} else {
			$_SESSION['selledErrorAdminAddProduct'] = "";
		}

		if ($rate < 0 || $rate > 5) {
			$_SESSION['rateErrorAdminAddProduct'] = "Đánh giá không hợp lệ";
		} else {
			$_SESSION['rateErrorAdminAddProduct'] = "";
		}

		if ($like < 0) {
			$_SESSION['likeErrorAdminAddProduct'] = "Lượt thích không hợp lệ";
		} else {
			$_SESSION['likeErrorAdminAddProduct'] = "";
		}


		if (
			$_SESSION['productNameErrorAdminAddProduct'] == "" &&
			$_SESSION['imageErrorAdminAddProduct'] == "" &&
			$_SESSION['priceErrorAdminAddProduct'] == "" &&
			$_SESSION['saleErrorAdminAddProduct'] == "" &&
			$_SESSION['instockErrorAdminAddProduct'] == "" &&
			$_SESSION['selledErrorAdminAddProduct'] == "" &&
			$_SESSION['rateErrorAdminAddProduct'] == "" &&
			$_SESSION['descriptionShortErrorAdminAddProduct'] == "" &&
			$_SESSION['descriptionLongErrorAdminAddProduct'] == "" &&
			$_SESSION['dateSaleErrorAdminAddProduct'] ==  "" &&
			$_SESSION['likeErrorAdminAddProduct'] == ""
		) {
			return 1;
		}
	}

	public function adminEditProduct($productName, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale)
	{
		function AEP($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$productName = AEP($productName);
		$price = AEP($price);
		$sale = AEP($sale);
		$instock = AEP($instock);
		$selled = AEP($selled);
		$rate = AEP($rate);
		$like = AEP($like);
		$descriptionShort = AEP($descriptionShort);
		$descriptionLong = AEP($descriptionLong);
		$dateSale = AEP($dateSale);
		//Tạo để lưu lỗi vào session
		$_SESSION['productNameErrorAdminEditProduct'] = "";
		$_SESSION['descriptionShortErrorAdminEditProduct'] = "";
		$_SESSION['priceErrorAdminEditProduct'] = "";
		$_SESSION['saleErrorAdminEditProduct'] = "";
		$_SESSION['instockErrorAdminEditProduct'] = "";
		$_SESSION['selledErrorAdminEditProduct'] = "";
		$_SESSION['rateErrorAdminEditProduct'] = "";
		$_SESSION['likeErrorAdminEditProduct'] = "";
		$_SESSION['descriptionShortErrorAdminEditProduct'] = "";
		$_SESSION['descriptionLongErrorAdminEditProduct'] = "";
		$_SESSION['dateSaleErrorAdminEditProduct'] = "";

		if (empty($productName)) {
			$_SESSION['productNameErrorAdminEditProduct'] = "Tên sản phẩm không được để trống";
		} else {
			if (strlen($productName) > 90) {
				$_SESSION['productNameErrorAdminEditProduct'] = "Tên sản phẩm không được quá 90 ký tự";
			} else {
				$_SESSION['productNameErrorAdminEditProduct'] = "";
			}
		}

		if (empty($descriptionShort)) {
			$_SESSION['descriptionShortErrorAdminEditProduct'] = "Mô tả sản phẩm không được để trống";
		} else {
			$_SESSION['descriptionShortErrorAdminEditProduct'] = "";
		}

		if (empty($descriptionLong)) {
			$_SESSION['descriptionLongErrorAdminEditProduct'] = "Mô tả sản phẩm không được để trống";
		} else {
			$_SESSION['descriptionLongErrorAdminEditProduct'] = "";
		}

		if (empty($price)) {
			$_SESSION['priceErrorAdminEditProduct'] = "Giá tiền không được để trống";
		} else {
			if ($price < 0) {
				$_SESSION['priceErrorAdminEditProduct'] = "Giá tiền không hợp lệ";
			} else {
				$_SESSION['priceErrorAdminEditProduct'] = "";
			}
		}

		if ($sale < 0) {
			$_SESSION['saleErrorAdminEditProduct'] = "Giá tiền không hợp lệ";
		} else {
			$_SESSION['saleErrorAdminEditProduct'] = "";
		}

		if ($sale > 0) {
			if (empty($dateSale)) {
				$_SESSION['dateSaleErrorAdminEditProduct'] = "Ngày hết hạn giảm giá không được để trống";
			} else {
				$input = new DateTime($dateSale);
				$date = new DateTime('now');

				$diff = $date->diff($input);

				if ($diff->invert === 0 && $diff->days > 60) {
					$_SESSION['dateSaleErrorAdminEditProduct'] = "Tính từ ngày hiện tại ngày hết hạn giảm giá không quá 2 tháng";
				} else {
					$_SESSION['dateSaleErrorAdminEditProduct'] = "";
				}
			}
		}

		if (empty($instock)) {
			$_SESSION['instockErrorAdminEditProduct'] = "Số lượng tồn kho không được để trống";
		} else {
			if ($instock < 0) {
				$_SESSION['instockErrorAdminEditProduct'] = "Số  lượng tồn kho không hợp lệ";
			} else {
				$_SESSION['instockErrorAdminEditProduct'] = "";
			}
		}

		if ($selled < 0) {
			$_SESSION['selledErrorAdminEditProduct'] = "Số lượng đã bán không hợp lệ";
		} else {
			$_SESSION['selledErrorAdminEditProduct'] = "";
		}

		if ($rate < 0 || $rate > 5) {
			$_SESSION['rateErrorAdminEditProduct'] = "Đánh giá không hợp lệ";
		} else {
			$_SESSION['rateErrorAdminEditProduct'] = "";
		}

		if ($like < 0) {
			$_SESSION['likeErrorAdminEditProduct'] = "Lượt thích không hợp lệ";
		} else {
			$_SESSION['likeErrorAdminEditProduct'] = "";
		}


		if (
			$_SESSION['productNameErrorAdminEditProduct'] == "" &&
			$_SESSION['priceErrorAdminEditProduct'] == "" &&
			$_SESSION['saleErrorAdminEditProduct'] == "" &&
			$_SESSION['instockErrorAdminEditProduct'] == "" &&
			$_SESSION['selledErrorAdminEditProduct'] == "" &&
			$_SESSION['rateErrorAdminEditProduct'] == "" &&
			$_SESSION['descriptionShortErrorAdminEditProduct'] == "" &&
			$_SESSION['descriptionLongErrorAdminEditProduct'] == "" &&
			$_SESSION['dateSaleErrorAdminEditProduct'] == "" &&
			$_SESSION['likeErrorAdminEditProduct'] == ""
		) {
			return 1;
		}
	}

	public function adminEditCustomer($fname, $lname, $email, $phoneNumber, $address, $birth)
	{
		function AEC($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$fname = AEC($fname);
		$lname = AEC($lname);
		$email = AEC($email);
		$address = AEC($address);
		$birth = AEC($birth);
		$phoneNumber = AEC($phoneNumber);
		//Tạo để lưu lỗi vào session
		$_SESSION['fnameErrorAdminEditCustomer'] = "";
		$_SESSION['lnameErrorAdminEditCustomer'] = "";
		$_SESSION['emailErrorAdminEditCustomer'] = "";
		$_SESSION['phoneErrorAdminEditCustomer'] = "";
		$_SESSION['addressErrorAdminEditCustomer'] = "";
		$_SESSION['birthErrorAdminEditCustomer'] = "";

		if (empty($fname)) {
			$_SESSION['fnameErrorAdminEditCustomer'] = "Họ của bạn không được để trống";
		} else {
			$fname_pattern = "/\d/";
			$fname_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($fname_pattern, $fname)) {
				$_SESSION['fnameErrorAdminEditCustomer'] = "Họ của bạn không được có số ";
			} else if (preg_match($fname_no_special_char_pattern, $fname)) {
				$_SESSION['fnameErrorAdminEditCustomer'] = "Họ của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['fnameErrorAdminEditCustomer'] = "";
			}
		}

		if (empty($lname)) {
			$_SESSION['lnameErrorAdminEditCustomer'] = "Tên của bạn không được để trống";
		} else {
			$lname_pattern = "/\d/";
			$lname_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($lname_pattern, $lname)) {
				$_SESSION['lnameErrorAdminEditCustomer'] = "Tên của bạn không được có số ";
			} else if (preg_match($lname_no_special_char_pattern, $lname)) {
				$_SESSION['lnameErrorAdminEditCustomer'] = "Tên của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['lnameErrorAdminEditCustomer'] = "";
			}
		}

		if (empty($phoneNumber)) {
			$_SESSION['phoneErrorAdminEditCustomer'] = "Số điện thoại không được để trống";
		} else {
			$phone_pattern = "/^[0]{1}\d{9,10}$/";
			if (!preg_match($phone_pattern, $phoneNumber)) {
				$_SESSION['phoneErrorAdminEditCustomer'] = "Số điện thoại không hợp lệ";
			} else {
				$_SESSION['phoneErrorAdminEditCustomer'] = "";
			}
		}


		if (empty($email)) {
			$_SESSION['emailErrorAdminEditCustomer'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorAdminEditCustomer'] = "Email không hợp lệ";
			} else {
				$_SESSION['emailErrorAdminEditCustomer'] = "";
			}
		}

		if (empty($address)) {
			$_SESSION['addressErrorAdminEditCustomer'] = "Địa chỉ không được để trống";
		} else {
			$_SESSION['addressErrorAdminEditCustomer'] = "";
		}

		if (empty($birth)) {
			$_SESSION['birthErrorAdminEditCustomer'] = "Địa chỉ không được để trống";
		} else {
			$input = new DateTime($birth);
			$date = new DateTime('now');

			$diff = $date->diff($input);

			if ($diff->invert === 0) {
				$_SESSION['birthErrorAdminEditCustomer'] = "Ngày sinh không hợp lệ";
			} else {
				$_SESSION['birthErrorAdminEditCustomer'] = "";
			}
		}

		if (
			$_SESSION['fnameErrorAdminEditCustomer'] == "" &&
			$_SESSION['lnameErrorAdminEditCustomer'] == "" &&
			$_SESSION['birthErrorAdminEditCustomer'] == "" &&
			$_SESSION['addressErrorAdminEditCustomer'] == "" &&
			$_SESSION['phoneErrorAdminEditCustomer'] == "" &&
			$_SESSION['emailErrorAdminEditCustomer'] == ""
		) {
			return 1;
		}
	}

	public function checkAddCustomer($firstName, $lastName, $email, $password)
	{
		function CAC($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$firstName = CAC($firstName);
		$lastName = CAC($lastName);
		$email = CAC($email);
		$password = CAC($password);
		//Tạo để lưu lỗi vào session
		$_SESSION['firstNameErrorAdminAddCustomer'] = "";
		$_SESSION['lastNameErrorAdminAddCustomer'] = "";
		$_SESSION['emailErrorAdminAddCustomer'] = "";
		$_SESSION['passwordErrorAdminAddCustomer'] = "";

		if (empty($firstName)) {
			$_SESSION['firstNameErrorAdminAddCustomer'] = "Họ của bạn không được để trống";
		} else {
			$firstName_pattern = "/\d/";
			$firstName_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($firstName_pattern, $firstName)) {
				$_SESSION['firstNameErrorAdminAddCustomer'] = "Họ của bạn không được có số ";
			} else if (preg_match($firstName_no_special_char_pattern, $firstName)) {
				$_SESSION['firstNameErrorAdminAddCustomer'] = "Họ của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['firstNameErrorAdminAddCustomer'] = "";
			}
		}

		if (empty($lastName)) {
			$_SESSION['lastNameErrorAdminAddCustomer'] = "Tên của bạn không được để trống";
		} else {
			$lastName_pattern = "/\d/";
			$lastName_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($lastName_pattern, $lastName)) {
				$_SESSION['lastNameErrorAdminAddCustomer'] = "Tên của bạn không được có số ";
			} else if (preg_match($lastName_no_special_char_pattern, $lastName)) {
				$_SESSION['lastNameErrorAdminAddCustomer'] = "Tên của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['lastNameErrorAdminAddCustomer'] = "";
			}
		}

		if (empty($password)) {
			$_SESSION['passwordErrorAdminAddCustomer'] = "Vui lòng nhập mật khẩu";
		} else {
			$password_pattern = "/^[a-zA-Z0-9]{5,}$/";
			if (!preg_match($password_pattern, $password)) {
				$_SESSION['passwordErrorAdminAddCustomer'] = "Mật khẩu phải có độ dài từ 5 ký tự trở lên";
			} elseif (strlen($password) > 30) {
				$_SESSION['passwordErrorAdminAddCustomer'] = "Mật khẩu không được vượt quá 30 ký tự";
			} else {
				$_SESSION['passwordErrorAdminAddCustomer'] = "";
			}
		}

		if (empty($email)) {
			$_SESSION['emailErrorAdminAddCustomer'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorAdminAddCustomer'] = "Email không hợp lệ";
			} else {
				$admin = new admin();
				$checkEmail = $admin->existsEmailCustomer($email);
				if ($checkEmail) {
					$_SESSION['emailErrorAdminAddCustomer'] = "Email đã tồn tại";
				} else {
					$_SESSION['emailErrorAdminAddCustomer'] = "";
				}
			}
		}

		if (
			$_SESSION['firstNameErrorAdminAddCustomer'] == "" &&
			$_SESSION['lastNameErrorAdminAddCustomer'] == "" &&
			$_SESSION['passwordErrorAdminAddCustomer'] == "" &&
			$_SESSION['emailErrorAdminAddCustomer'] == ""
		) {
			return 1;
		}
	}

	public function checkAddAdmin($firstName, $lastName, $email, $password, $phone, $userName)
	{
		function CAA($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$firstName = CAA($firstName);
		$lastName = CAA($lastName);
		$email = CAA($email);
		$password = CAA($password);
		$phone = CAA($phone);
		$userName = CAA($userName);
		//Tạo để lưu lỗi vào session
		$_SESSION['firstNameErrorAdminAddAdmin'] = "";
		$_SESSION['lastNameErrorAdminAddAdmin'] = "";
		$_SESSION['emailErrorAdminAddAdmin'] = "";
		$_SESSION['passwordErrorAdminAddAdmin'] = "";
		$_SESSION['phoneErrorAdminAddAdmin'] = "";
		$_SESSION['userNameErrorAdminAddAdmin'] = "";

		if (empty($firstName)) {
			$_SESSION['firstNameErrorAdminAddAdmin'] = "Họ của bạn không được để trống";
		} else {
			$firstName_pattern = "/\d/";
			$firstName_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($firstName_pattern, $firstName)) {
				$_SESSION['firstNameErrorAdminAddAdmin'] = "Họ của bạn không được có số ";
			} else if (preg_match($firstName_no_special_char_pattern, $firstName)) {
				$_SESSION['firstNameErrorAdminAddAdmin'] = "Họ của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['firstNameErrorAdminAddAdmin'] = "";
			}
		}

		if (empty($lastName)) {
			$_SESSION['lastNameErrorAdminAddAdmin'] = "Tên của bạn không được để trống";
		} else {
			$lastName_pattern = "/\d/";
			$lastName_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($lastName_pattern, $lastName)) {
				$_SESSION['lastNameErrorAdminAddAdmin'] = "Tên của bạn không được có số ";
			} else if (preg_match($lastName_no_special_char_pattern, $lastName)) {
				$_SESSION['lastNameErrorAdminAddAdmin'] = "Tên của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['lastNameErrorAdminAddAdmin'] = "";
			}
		}

		if (empty($password)) {
			$_SESSION['passwordErrorAdminAddAdmin'] = "Vui lòng nhập mật khẩu";
		} else {
			$password_pattern = "/^[a-zA-Z0-9]{5,}$/";
			if (!preg_match($password_pattern, $password)) {
				$_SESSION['passwordErrorAdminAddAdmin'] = "Mật khẩu phải có độ dài từ 5 ký tự trở lên";
			} elseif (strlen($password) > 30) {
				$_SESSION['passwordErrorAdminAddAdmin'] = "Mật khẩu không được vượt quá 30 ký tự";
			} else {
				$_SESSION['passwordErrorAdminAddAdmin'] = "";
			}
		}

		if (empty($email)) {
			$_SESSION['emailErrorAdminAddAdmin'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorAdminAddAdmin'] = "Email không hợp lệ";
			} else {
				$admin = new admin();
				$existsEmail = $admin->existsEmailAdmin($email);
				if (!empty($existsEmail)) {
					$_SESSION['emailErrorAdminAddAdmin'] = "Email đã tồn tại";
				} else {
					$_SESSION['emailErrorAdminAddAdmin'] = "";
				}
			}
		}

		if (empty($phone)) {
			$_SESSION['phoneErrorAdminAddAdmin'] = "Số điện thoại không được để trống";
		} else {
			$phone_pattern = "/^[0]{1}\d{9,10}$/";
			if (!preg_match($phone_pattern, $phone)) {
				$_SESSION['phoneErrorAdminAddAdmin'] = "Số điện thoại không hợp lệ";
			} else {
				$_SESSION['phoneErrorAdminAddAdmin'] = "";
			}
		}

		if (empty($userName)) {
			$_SESSION['userNameErrorAdminAddAdmin'] = "Số điện thoại không được để trống";
		} else {
			$admin = new admin();
			$checkUserName = $admin->checkUserName($userName);
			if ($checkUserName) {
				$_SESSION['userNameErrorAdminAddAdmin'] = "Tên đăng nhập đã tồn tại";
			} else {
				$_SESSION['userNameErrorAdminAddAdmin'] = "";
			}
		}

		if (
			$_SESSION['firstNameErrorAdminAddAdmin'] == "" &&
			$_SESSION['lastNameErrorAdminAddAdmin'] == "" &&
			$_SESSION['phoneErrorAdminAddAdmin'] == "" &&
			$_SESSION['userNameErrorAdminAddAdmin'] == "" &&
			$_SESSION['passwordErrorAdminAddAdmin'] == "" &&
			$_SESSION['emailErrorAdminAddAdmin'] == ""
		) {
			return 1;
		}
	}


	public function adminEditAdmin($fname, $lname, $email, $phoneNumber, $birth, $address, $userName, $userNameBefore)
	{
		function AEA($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$fname = AEA($fname);
		$lname = AEA($lname);
		$email = AEA($email);
		$phoneNumber = AEA($phoneNumber);
		$birth = AEA($birth);
		$userName = AEA($userName);
		$userNameBefore = AEA($userNameBefore);
		$address = AEA($address);
		//Tạo để lưu lỗi vào session
		$_SESSION['fnameErrorAdminEditAdmin'] = "";
		$_SESSION['lnameErrorAdminEditAdmin'] = "";
		$_SESSION['emailErrorAdminEditAdmin'] = "";
		$_SESSION['phoneErrorAdminEditAdmin'] = "";
		$_SESSION['birthErrorAdminEditAdmin'] = "";
		$_SESSION['addressErrorAdminEditAdmin'] = "";
		$_SESSION['userNameErrorAdminEditAdmin'] = "";

		if (empty($fname)) {
			$_SESSION['fnameErrorAdminEditAdmin'] = "Họ của bạn không được để trống";
		} else {
			$fname_pattern = "/\d/";
			$fname_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($fname_pattern, $fname)) {
				$_SESSION['fnameErrorAdminEditAdmin'] = "Họ của bạn không được có số ";
			} else if (preg_match($fname_no_special_char_pattern, $fname)) {
				$_SESSION['fnameErrorAdminEditAdmin'] = "Họ của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['fnameErrorAdminEditAdmin'] = "";
			}
		}

		if (empty($lname)) {
			$_SESSION['lnameErrorAdminEditAdmin'] = "Tên của bạn không được để trống";
		} else {
			$lname_pattern = "/\d/";
			$lname_no_special_char_pattern = "/[!@#$%^&*(),.?\":{}|<>]/";
			if (preg_match($lname_pattern, $lname)) {
				$_SESSION['lnameErrorAdminEditAdmin'] = "Tên của bạn không được có số ";
			} else if (preg_match($lname_no_special_char_pattern, $lname)) {
				$_SESSION['lnameErrorAdminEditAdmin'] = "Tên của bạn không được chứa ký tự đặc biệt";
			} else {
				$_SESSION['lnameErrorAdminEditAdmin'] = "";
			}
		}

		if (empty($phoneNumber)) {
			$_SESSION['phoneErrorAdminEditAdmin'] = "Số điện thoại không được để trống";
		} else {
			$phone_pattern = "/^[0]{1}\d{9,10}$/";
			if (!preg_match($phone_pattern, $phoneNumber)) {
				$_SESSION['phoneErrorAdminEditAdmin'] = "Số điện thoại không hợp lệ";
			} else {
				$_SESSION['phoneErrorAdminEditAdmin'] = "";
			}
		}


		if (empty($email)) {
			$_SESSION['emailErrorAdminEditAdmin'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorAdminEditAdmin'] = "Email không hợp lệ";
			} else {
				$_SESSION['emailErrorAdminEditAdmin'] = "";
			}
		}

		if (empty($address)) {
			$_SESSION['addressErrorAdminEditAdmin'] = "Địa chỉ không được để trống";
		} else {
			$_SESSION['addressErrorAdminEditAdmin'] = "";
		}

		if (empty($userName)) {
			$_SESSION['userNameErrorAdminEditAdmin'] = "Tên đăng nhập không được để trống";
		} else {
			if ($userName != $userNameBefore) {
				$admin = new admin();
				$checkUserName = $admin->checkUserName($userName);
				if ($checkUserName) {
					$_SESSION['userNameErrorAdminEditAdmin'] = "Tên đăng nhập đã tồn tại";
				}
			} else {
				$_SESSION['userNameErrorAdminEditAdmin'] = "";
			}
		}

		if (empty($birth)) {
			$_SESSION['birthErrorAdminEditAdmin'] = "Ngày sinh không được để trống";
		} else {
			$input = new DateTime($birth);
			$date = new DateTime('now');

			$diff = $date->diff($input);

			if ($diff->invert === 0) {
				$_SESSION['birthErrorAdminEditAdmin'] = "Ngày sinh không hợp lệ";
			} else {
				$_SESSION['birthErrorAdminEditAdmin'] = "";
			}
		}

		if (
			$_SESSION['fnameErrorAdminEditAdmin'] == "" &&
			$_SESSION['lnameErrorAdminEditAdmin'] == "" &&
			$_SESSION['userNameErrorAdminEditAdmin'] == "" &&
			$_SESSION['phoneErrorAdminEditAdmin'] == "" &&
			$_SESSION['birthErrorAdminEditAdmin'] == "" &&
			$_SESSION['addressErrorAdminEditAdmin'] == "" &&
			$_SESSION['emailErrorAdminEditAdmin'] == ""
		) {
			return 1;
		}
	}

	public function checkAddNews($title, $date, $image, $contentShort, $contentLong)
	{
		function addnews($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$title = addnews($title);
		$date = addnews($date);
		$image = addnews($image);
		$contentShort = addnews($contentShort);
		$contentLong = addnews($contentLong);
		//Tạo để lưu lỗi vào session
		$_SESSION['titleErrorAdminAddNews'] = "";
		$_SESSION['dateErrorAdminAddNews'] = "";
		$_SESSION['imageErrorAdminAddNews'] = "";
		$_SESSION['contentLongErrorAdminAddNews'] = "";
		$_SESSION['contentShortErrorAdminAddNews'] = "";

		if (empty($title)) {
			$_SESSION['titleErrorAdminAddNews'] = "Tiêu đề không được để trống";
		} else {
			$_SESSION['titleErrorAdminAddNews'] = "";
		}


		if (empty($date)) {
			$_SESSION['dateErrorAdminAddNews'] = "Ngày không được để trống";
		} else {
			$input = new DateTime($date);
			$date = new DateTime('now');

			$diff = $date->diff($input);

			if ($diff->invert === 0 && $diff->days > 60) {
				$_SESSION['dateErrorAdminAddNews'] = "Tính từ ngày hiện tại không được vượt quá 2 tháng";
			} else {
				$_SESSION['dateErrorAdminAddNews'] = "";
			}
		}

		if (empty($image)) {
			$_SESSION['imageErrorAdminAddNews'] = "Vui lòng chọn ảnh";
		} else {
			$_SESSION['imageErrorAdminAddNews'] = "";
		}

		if (empty($contentShort)) {
			$_SESSION['contentShortErrorAdminAddNews'] = "Nội dung không được để trống";
		} else {
			$_SESSION['contentShortErrorAdminAddNews'] = "";
		}

		if (empty($contentLong)) {
			$_SESSION['contentLongErrorAdminAddNews'] = "Nội dung không được để trống";
		} else {
			$_SESSION['contentLongErrorAdminAddNews'] = "";
		}

		if (
			$_SESSION['titleErrorAdminAddNews'] == "" &&
			$_SESSION['dateErrorAdminAddNews'] == "" &&
			$_SESSION['imageErrorAdminAddNews'] == "" &&
			$_SESSION['contentLongErrorAdminAddNews'] == "" &&
			$_SESSION['contentShortErrorAdminAddNews'] == ""
		) {
			return 1;
		}
	}

	public function checkEditNews($title, $date, $content, $detail)
	{
		function editnews($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$title = editnews($title);
		$date = editnews($date);
		$content = editnews($content);
		$detail = editnews($detail);
		//Tạo để lưu lỗi vào session
		$_SESSION['titleErrorAdminEditNews'] = "";
		$_SESSION['dateErrorAdminEditNews'] = "";
		$_SESSION['contentErrorAdminEditNews'] = "";
		$_SESSION['detailErrorAdminEditNews'] = "";

		if (empty($title)) {
			$_SESSION['titleErrorAdminEditNews'] = "Tiêu đề không được để trống";
		} else {
			$_SESSION['titleErrorAdminEditNews'] = "";
		}

		if (empty($date)) {
			$_SESSION['dateErrorAdminEditNews'] = "Ngày không được để trống";
		} else {
			$input = new DateTime($date);
			$date = new DateTime('now');

			$diff = $date->diff($input);

			if ($diff->invert === 0 && $diff->days > 60) {
				$_SESSION['dateErrorAdminEditNews'] = "Tính từ ngày hiện tại không được vượt quá 2 tháng";
			} else {
				$_SESSION['dateErrorAdminEditNews'] = "";
			}
		}

		if (empty($content)) {
			$_SESSION['contentErrorAdminEditNews'] = "Nội dung không được để trống";
		} else {
			$_SESSION['contentErrorAdminEditNews'] = "";
		}

		if (empty($detail)) {
			$_SESSION['detailErrorAdminEditNews'] = "Nội dung không được để trống";
		} else {
			$_SESSION['detailErrorAdminEditNews'] = "";
		}

		if (
			$_SESSION['titleErrorAdminEditNews'] == "" &&
			$_SESSION['dateErrorAdminEditNews'] == "" &&
			$_SESSION['contentErrorAdminEditNews'] == "" &&
			$_SESSION['detailErrorAdminEditNews'] == ""
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

	public function checkSaveInfoAccount($fullname, $date, $email, $address, $phone, $zip)
	{
		function infoAccount($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$phone = infoAccount($phone);
		$zip = infoAccount($zip);
		$fullname = infoAccount($fullname);
		$date = infoAccount($date);
		$email = infoAccount($email);
		$address = infoAccount($address);
		//Tạo để lưu lỗi vào session
		$_SESSION['fullnameErrorSaveInfoAccount'] = "";
		$_SESSION['phoneErrorSaveInfoAccount'] = "";
		$_SESSION['emailErrorSaveInfoAccount'] = "";
		$_SESSION['addressErrorSaveInfoAccount'] = "";
		$_SESSION['dateErrorSaveInfoAccount'] = "";

		if (empty($fullname)) {
			$_SESSION['fullnameErrorSaveInfoAccount'] = "Họ và tên không được để trống";
		} else {
			$fullname_pattern = "/\d/";
			if (preg_match($fullname_pattern, $fullname)) {
				$_SESSION['fullnameErrorSaveInfoAccount'] = "Họ và tên không được có số ";
			} else {
				$_SESSION['fullnameErrorSaveInfoAccount'] = "";
			}
		}

		if (empty($date)) {
			$_SESSION['dateErrorSaveInfoAccount'] = "Ngày sinh không được để trống";
		} else {
			$input = new DateTime($date);
			$date = new DateTime('now');

			$diff = $date->diff($input);

			if ($diff->invert === 0) {
				$_SESSION['dateErrorSaveInfoAccount'] = "Ngày sinh không hợp lệ";
			} else {
				$_SESSION['dateErrorSaveInfoAccount'] = "";
			}
		}

		if (empty($address)) {
			$_SESSION['addressErrorSaveInfoAccount'] = "Địa chỉ không được để trống";
		} else {
			$_SESSION['addressErrorSaveInfoAccount'] = "";
		}

		if (empty($zip)) {
			$_SESSION['zipErrorSaveInfoAccount'] = "Mã zip không được để trống";
		} else {
			if (strlen($zip) < 5) {
				$_SESSION['zipErrorSaveInfoAccount'] = "Mã zip không hợp lệ";
			} else {
				$_SESSION['zipErrorSaveInfoAccount'] = "";
			}
		}

		if (empty($email)) {
			$_SESSION['emailErrorSaveInfoAccount'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorSaveInfoAccount'] = "Email không hợp lệ";
			} else {
				$_SESSION['emailErrorSaveInfoAccount'] = "";
			}
		}

		if (empty($phone)) {
			$_SESSION['phoneErrorSaveInfoAccount'] = "Số điện thoại không được để trống";
		} else {
			$phone_pattern = "/^[0]{1}\d{9,10}$/";
			if (!preg_match($phone_pattern, $phone)) {
				$_SESSION['phoneErrorSaveInfoAccount'] = "Số điện thoại không hợp lệ";
			} else {
				$_SESSION['phoneErrorSaveInfoAccount'] = "";
			}
		}

		if (
			$_SESSION['fullnameErrorSaveInfoAccount'] == "" &&
			$_SESSION['dateErrorSaveInfoAccount'] == "" &&
			$_SESSION['addressErrorSaveInfoAccount'] == "" &&
			$_SESSION['phoneErrorSaveInfoAccount'] == "" &&
			$_SESSION['zipErrorSaveInfoAccount'] == "" &&
			$_SESSION['emailErrorSaveInfoAccount'] == ""
		) {
			return 1;
		}
	}

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
		)
			return 1;
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


	public function adminEditContact($author, $subject, $email, $content)
	{
		function AECo($data)
		{
			$data = trim($data); // bỏ khoảng trống 2 đầu
			$data = stripslashes($data); // loại bỏ ký tự như dấu ', ", / để  tránh gây lỗi 
			$data = htmlspecialchars($data); // chuyển ký tự đặc biệt thành thẻ HTML tương ứng để tránh gây gây vấn đề bảo mật web
			return $data;
		}

		$author = AECo($author);
		$subject = AECo($subject);
		$email = AECo($email);
		$content = AECo($content);
		//Tạo để lưu lỗi vào session
		$_SESSION['authorErrorAdminEditContact'] = "";
		$_SESSION['subjectErrorAdminEditContact'] = "";
		$_SESSION['emailErrorAdminEditContact'] = "";
		$_SESSION['contentErrorAdminEditContact'] = "";

		if (empty($author)) {
			$_SESSION['authorErrorAdminEditContact'] = "Tên tác giả không được để trống";
		} else {
			$author_pattern = "/\d/";
			if (preg_match($author_pattern, $author)) {
				$_SESSION['authorErrorAdminEditContact'] = "Tên tác giả không được có số ";
			} else {
				$_SESSION['authorErrorAdminEditContact'] = "";
			}
		}

		if (empty($subject)) {
			$_SESSION['subjectErrorAdminEditContact'] = "Chủ đề không được để trống";
		} else {
			$_SESSION['subjectErrorAdminEditContact'] = "";
		}


		if (empty($content)) {
			$_SESSION['contentErrorAdminEditContact'] = "Nội dung không được để trống";
		} else {
			$_SESSION['contentErrorAdminEditContact'] = "";
		}


		if (empty($email)) {
			$_SESSION['emailErrorAdminEditContact'] = "Email không được để trống";
		} else {
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$_SESSION['emailErrorAdminEditContact'] = "Email không hợp lệ";
			} else {
				$_SESSION['emailErrorAdminEditContact'] = "";
			}
		}

		if (
			$_SESSION['authorErrorAdminEditContact'] == "" &&
			$_SESSION['subjectErrorAdminEditContact'] == "" &&
			$_SESSION['contentErrorAdminEditContact'] == "" &&
			$_SESSION['emailErrorAdminEditContact'] == ""
		) {
			return 1;
		}
	}






	public function checkAddProductName($productName)
	{
		$query = "SELECT * FROM sanpham WHERE ten = '$productName' and i_delete = 1";
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

	public function checkExistsAdmin($adminId)
	{
		$query = "SELECT * FROM admin WHERE id = $adminId";
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
