<?php
class user
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function checkUserCommentProduct($id, $maSP)
	{
		$select = "SELECT maSP FROM ct_hoadon a, hoa_don b WHERE a.maHD = b.maHD and b.tinhtrang = 3 and b.id = $id and a.maSP = $maSP";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function registerAccount($fname, $lname, $phoneNumber, $email, $password)
	{
		$fullName = trim($fname) . " " . trim($lname);

		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');


		$insert = "INSERT INTO nguoi_dung (ho, ten, hovaten, gioitinh, sdt, email, matkhau, ngaydk) 
		VALUES ('$fname', '$lname', '$fullName', 'Khác', '$phoneNumber', '$email', '$mk', '$dateFix')";

		$result = $this->db->exec($insert);
		return $result;
	}

	public function existsEmailAccount($email)
	{
		$query = "SELECT * FROM nguoi_dung WHERE email = '$email'";

		$result = $this->db->getInstance($query);

		return $result;
	}

	public function loginAccount($email, $password)
	{
		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$query = "SELECT * FROM nguoi_dung WHERE email = '$email' and matkhau = '$mk' and trangthai = 1 ";

		$result = $this->db->getInstance($query);
		return $result;
	}

	public function logout()
	{
		if (isset($_SESSION['id_fb'])) {
			unset($_SESSION['id']);
			unset($_SESSION['fullname']);
			unset($_SESSION['email']);
			unset($_SESSION['lname']);
			unset($_SESSION['fname']);
			unset($_SESSION['phone']);
			unset($_SESSION['image']);
			unset($_SESSION['gender']);
			unset($_SESSION['id_fb']);
			if (isset($_SESSION['cartProdcut']) && count($_SESSION['cartProduct']) > 0) {
				array_splice($_SESSION['cartProduct'], 0, count($_SESSION['cartProduct']));
			}
		} else if (isset($_SESSION['token'])) {
			unset($_SESSION['id']);
			unset($_SESSION['fullname']);
			unset($_SESSION['email']);
			unset($_SESSION['lname']);
			unset($_SESSION['fname']);
			unset($_SESSION['phone']);
			unset($_SESSION['image']);
			unset($_SESSION['gender']);
			unset($_SESSION['token']);
			if (isset($_SESSION['cartProdcut']) && count($_SESSION['cartProduct']) > 0) {
				array_splice($_SESSION['cartProduct'], 0, count($_SESSION['cartProduct']));
			}
		} else {
			unset($_SESSION['id']);
			unset($_SESSION['fullname']);
			unset($_SESSION['email']);
			unset($_SESSION['lname']);
			unset($_SESSION['fname']);
			unset($_SESSION['phone']);
			unset($_SESSION['image']);
			unset($_SESSION['token']);
			if (isset($_SESSION['cartProdcut']) && count($_SESSION['cartProduct']) > 0) {
				array_splice($_SESSION['cartProduct'], 0, count($_SESSION['cartProduct']));
			}
		}
	}

	public function getInfoByCustomerId($customerId)
	{
		$select = "SELECT * FROM nguoi_dung WHERE id = $customerId";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function getInfoGGByCustomerId($token)
	{
		$select = "SELECT * FROM nguoi_dung WHERE token = '$token'";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function getInfoFBByCustomerId($id_fb)
	{
		$select = "SELECT * FROM nguoi_dung WHERE id_fb = '$id_fb'";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function getInfoCheckoutByCustomerId($customerId)
	{
		$select = "SELECT a.*, b.ho, b.ten FROM thanh_toan as a, nguoi_dung as b WHERE a.id = b.id and a.id = $customerId ORDER BY id DESC";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function saveInfoAccount($customerId, $fullname, $date, $email, $gender, $address, $phone)
	{
		$dateNow = new DateTime('now');
		$dateFix = $dateNow->format('Y-m-d');

		$update = "UPDATE nguoi_dung SET hovaten = '$fullname', ngaysinh = '$date', email = '$email', gioitinh = '$gender', diachi = '$address', sdt = '$phone', ngaycapnhat = '$dateFix' WHERE id = $customerId";


		$result = $this->db->exec($update);
		return $result;
	}

	public function changePassword($customerId, $password, $passwordNew)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$select = "SELECT matkhau FROM nguoi_dung WHERE id = $customerId";
		$passwordOld = $this->db->getInstance($select)['matkhau'];
		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";

		$mk2 = md5($mahoa1 . $passwordNew . $mahoa2);
		$mk1 = md5($mahoa1 . $password . $mahoa2);
		//bắt đầu đổi mật khẩu
		if ($passwordOld != $mk2) {
			if ($passwordOld == $mk1) {
				$update = "UPDATE nguoi_dung SET matkhau = '$mk2', ngaycapnhat = '$dateFix' WHERE id = $customerId";
				$result = $this->db->exec($update);
				if ($result != false) {
					echo json_encode(array(
						'status' => 1,
						'message' => "Thay đổi thông tin thành công"
					));
				} else {
					echo json_encode(array(
						'status' => 0,
						'message' => "Đã có lỗi xãy ra"
					));
				}
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Mật khẩu cũ không chính xác'
				));
			}
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => "Mật khẩu trùng mật khẩu cũ"
			));
		}
	}

	public function getInvoiceByCustomerId($customerId)
	{
		$select = "SELECT hoa_don.*, ten FROM hoa_don, tt_hoadon WHERE id = $customerId and trangthai = 1 and tinhtrang = maTTHD and hoa_don.tongtien > 0 ORDER BY maHD DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getStatusInvoiceAccount($customerId, $status)
	{
		$select = "SELECT hoa_don.*, ten FROM hoa_don, tt_hoadon WHERE id = $customerId and trangthai = 1 and tinhtrang = maTTHD and hoa_don.tongtien > 0 and hoa_don.tinhtrang = $status ORDER BY maHD DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function addWishlist($customerId, $productId)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$select = "SELECT * FROM yeu_thich WHERE id = $customerId and maSP = $productId";
		$checkExists = $this->db->getInstance($select);

		if (empty($checkExists)) {
			$insert = "INSERT INTO yeu_thich (maSP, id, ngay) VALUES ($productId, $customerId, '$dateFix')";
			$this->db->exec($insert);
			return 1;
		} else {
			$delete = "DELETE FROM yeu_thich WHERE id = $customerId AND maSP = $productId";
			$this->db->exec($delete);
			return 2;
		}
	}

	public function getWishlist($customerId)
	{
		$select = "SELECT maYT,b.* FROM yeu_thich as a, sanpham as b WHERE a.maSP = b.maSP and a.id = $customerId";

		$result = $this->db->getList($select);

		return $result;
	}

	public function deleteWishlist($wishlistId, $customerId)
	{
		$delete = "DELETE FROM yeu_thich WHERE maYT = $wishlistId and id = $customerId";

		$result = $this->db->exec($delete);

		return $result;
	}

	public function resetPassword($email, $password)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$update = "UPDATE nguoi_dung SET matkhau = '$mk', ngaycapnhat = '$dateFix' WHERE email = '$email'";

		$result = $this->db->exec($update);
		return $result;
	}

	public function emailSubscribe($email)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$insert = "INSERT INTO email_dktruoc (email, ngaydk) 
		VALUES ('$email', '$dateFix')";

		$result = $this->db->exec($insert);
		return $result;
	}

	public function updateImageAccount($idCustomer, $imageName)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$update = "UPDATE nguoi_dung SET anh = '$imageName', ngaycapnhat = '$dateFix' WHERE id = '$idCustomer'";

		$result = $this->db->exec($update);
		return $result;
	}

	public function deleteInvoice($id, $idCustomer)
	{
		$update = "UPDATE hoa_don SET tinhtrang = 4 WHERE maHD = $id and id = $idCustomer";

		$result = $this->db->exec($update);

		return $result;
	}

	public function checkInvoice($id, $idCustomer)
	{
		$update = "UPDATE hoa_don SET tinhtrang = 3 WHERE maHD = $id and id = $idCustomer";

		$result = $this->db->exec($update);

		return $result;
	}

	public function insertReturnProduct($maHD, $maSP, $idCustomer, $imageName, $content, $file)
	{

		$checkReturnProduct = $this->checkReturnProduct($maHD, $maSP, $idCustomer);
		if ($checkReturnProduct) {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Sản phẩm đã được trả'
			));
		} else {
			$code = '';
			$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
			$charactersLength = strlen($characters);
			$codeLength = 8;
			for ($i = 0; $i < $codeLength; $i++) {
				$code .= $characters[rand(0, $charactersLength - 1)];
			}
			$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
			$saveImageName = $code . "." . $imageExtension;


			$insert = "INSERT INTO trahang_hoadon (maHD, maSP, id, anh, lydo)
			VALUES ($maHD, $maSP, $idCustomer, '$saveImageName', '$content')";

			$result = $this->db->exec($insert);


			if ($result) {

				$addImage = new addImage();
				$addImage->saveImageReturnProduct($file, $saveImageName);

				$update = "UPDATE ct_hoadon SET trahang = 2 WHERE maSP = $maSP and maHD = $maHD";
				$this->db->exec($update);

				$checkQtyReturnProduct = $this->checkQtyReturnProduct($maHD);

				$updateTotalInoice = "UPDATE hoa_don SET tongtien = {$checkQtyReturnProduct['tongtien']} WHERE maHD = $maHD";
				$this->db->exec($updateTotalInoice);


				if ($checkQtyReturnProduct['soluong'] == 0) {
					$updateInvoice = "UPDATE hoa_don SET tinhtrang = 5 WHERE maHD = $maHD";
					$this->db->exec($updateInvoice);
				}

				echo json_encode(array(
					'status' => 1,
					'message' => 'Đã gửi thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Đã xãy ra lỗi vui lòng quay lại sau'
				));
			}
		}
	}

	public function checkReturnProduct($maHD, $maSP, $idCustomer)
	{
		$select = "SELECT * FROM trahang_hoadon WHERE maHD = $maHD AND maSP = $maSP AND id = $idCustomer";
		$result = $this->db->getInstance($select);
		return $result;
	}

	public function checkQtyReturnProduct($maHD)
	{
		$select = "SELECT count(*) as soluong , sum(thanhtien) as tongtien FROM ct_hoadon WHERE maHD = $maHD and trahang != 2";
		$result = $this->db->getInstance($select);
		return $result;
	}
}
