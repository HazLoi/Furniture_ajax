<?php
class admin
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function changePassword($idAdmin, $password, $passwordNew)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$select = "SELECT matkhau FROM admin WHERE id = $idAdmin";
		$passwordOld = $this->db->getInstance($select)['matkhau'];
		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";

		$mk2 = md5($mahoa1 . $passwordNew . $mahoa2);
		$mk1 = md5($mahoa1 . $password . $mahoa2);
		//bắt đầu đổi mật khẩu
		if ($passwordOld != $mk2) {
			if ($passwordOld == $mk1) {
				$update = "UPDATE admin SET matkhau = '$mk2', ngaycapnhat = '$dateFix' WHERE id = $idAdmin";
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

	public function getRoleAdmin($idAdmin)
	{
		$select = "SELECT * FROM admin WHERE id = $idAdmin";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function checkUserName($userName)
	{
		$select = "SELECT * FROM admin WHERE tendn = '$userName'";
		$result = $this->db->getInstance($select);
		return $result;
	}

	public function updateImageAdmin($id, $imageName)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$update = "UPDATE admin SET anh = '$imageName', ngaycapnhat = '$dateFix' WHERE id = '$id'";

		$result = $this->db->exec($update);
		return $result;
	}

	public function loginAdmin($email, $password)
	{
		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$query = "SELECT * FROM admin WHERE tendn = '$email' and matkhau = '$mk' and trangthai = 1";
		} else {
			$query = "SELECT * FROM admin WHERE email = '$email' and matkhau = '$mk' and trangthai = 1";
		}

		$result = $this->db->getInstance($query);

		if ($result) {
			$update = "UPDATE admin SET hoatdong = 1 WHERE id = {$result['id']}";
			$this->db->exec($update);
		}

		return $result;
	}

	public function existsEmailAdmin($email)
	{
		$select = "SELECT * FROM admin WHERE email = '$email' and i_delete = 1";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function existsEmailCustomer($email)
	{
		$select = "SELECT * FROM nguoi_dung WHERE email = '$email'";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function saveInfoAdmin($id, $fullname, $date, $email, $gender, $address, $phone)
	{
		$dateNow = new DateTime('now');
		$dateFix = $dateNow->format('Y-m-d');

		$update = "UPDATE admin SET hovaten = '$fullname', ngaysinh = '$date', email = '$email', gioitinh = '$gender', diachi = '$address', sdt = '$phone', ngaycapnhat = '$dateFix' WHERE id = $id";

		$result = $this->db->getList($update);

		return $result;
	}

	public function getInfoAdmin($id)
	{
		$select = "SELECT * FROM admin WHERE id = $id";

		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getAllProduct()
	{
		if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'az') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE a.i_delete = 1 and loai = maLoai ORDER BY a.maSP";
		} else if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'za') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE a.i_delete = 1 and loai = maLoai ORDER BY a.maSP DESC";
		} else {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE a.i_delete = 1 and loai = maLoai ORDER BY a.maSP DESC";
		}
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllProductExport()
	{
		$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getProductForCategory($loai)
	{
		if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'az') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and tenloai = '$loai' and a.i_delete = 1 ORDER BY a.maSP";
		} else if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'za') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and tenloai = '$loai' and a.i_delete = 1 ORDER BY a.maSP DESC";
		} else {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and tenloai = '$loai' and a.i_delete = 1 ";
		}

		$result = $this->db->getList($select);
		return $result;
	}

	public function getProductSearchByName($ten)
	{
		if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'az') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and ten like '%$ten%' and a.i_delete = 1 ORDER BY a.maSP";
		} else if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'za') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and ten like '%$ten%' and a.i_delete = 1 ORDER BY a.maSP DESC";
		} else {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and ten like '%$ten%' and a.i_delete = 1 ";
		}


		$result = $this->db->getList($select);

		return $result;
	}

	public function getProductSearchById($maSP)
	{
		$maSP = intval($maSP);
		if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'az') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and maSP = $maSP  and a.i_delete = 1 ORDER BY a.maSP";
		} else if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'za') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and maSP = $maSP  and a.i_delete = 1 ORDER BY a.maSP DESC";
		} else {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and maSP = $maSP  and a.i_delete = 1 ";
		}


		$result = $this->db->getList($select);

		return $result;
	}

	public function getProductSearchByStatus($status)
	{
		if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'az') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and a.trangthai = $status and a.i_delete = 1 ORDER BY a.maSP";
		} else if (isset($_POST['sortProduct']) && $_POST['sortProduct'] == 'za') {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and a.trangthai = $status and a.i_delete = 1 ORDER BY a.maSP DESC";
		} else {
			$select = "SELECT a.*, b.tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and a.trangthai = $status and a.i_delete = 1 ";
		}


		$result = $this->db->getList($select);

		return $result;
	}

	public function addProductDatabase($productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale)
	{
		$productName = trim(htmlspecialchars($productName, ENT_QUOTES, 'UTF-8'));
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insert = "INSERT INTO sanpham (ten, loai, anh, dongia, giamgia, thoigiangiamgia,motangan, mota, tonkho, daban, danhgia, yeuthich, ngaythem,trangthai)
			VALUES ('$productName', '$category', '$image', $price, $sale, '$dateSale', '$descriptionShort', '$descriptionLong', '$instock', '$selled', $rate, '$like', '$dateFix', 0)";

		$result = $this->db->exec($insert);
		// lưu vào thông báo
		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}', 'Thêm sản phẩm mới', '$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên sản phẩm: $productName')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//
		return $result;
	}

	public function editProductDatabase($productId, $productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$update = "UPDATE sanpham SET ten = :productName, loai = :category, anh = :image, giamgia = :sale, thoigiangiamgia = :dateSale, dongia = :price, tonkho = :instock, daban = :selled, danhgia = :rate, yeuthich = :like, mota = :descriptionLong, motangan = :descriptionShort, ngaycapnhat = :dateFix, trangthai = 0 WHERE maSP = :productId";

		$statement = $this->db->prepare($update);
		$statement->bindValue(':productName', $productName, PDO::PARAM_STR);
		$statement->bindValue(':category', $category, PDO::PARAM_STR);
		$statement->bindValue(':image', $image, PDO::PARAM_STR);
		$statement->bindValue(':sale', $sale, PDO::PARAM_INT);
		$statement->bindValue(':dateSale', $dateSale, PDO::PARAM_STR);
		$statement->bindValue(':price', $price, PDO::PARAM_INT);
		$statement->bindValue(':instock', $instock, PDO::PARAM_STR);
		$statement->bindValue(':selled', $selled, PDO::PARAM_STR);
		$statement->bindValue(':rate', $rate, PDO::PARAM_STR);
		$statement->bindValue(':like', $like, PDO::PARAM_STR);
		$statement->bindValue(':descriptionLong', $descriptionLong, PDO::PARAM_STR);
		$statement->bindValue(':descriptionShort', $descriptionShort, PDO::PARAM_STR);
		$statement->bindValue(':dateFix', $dateFix, PDO::PARAM_STR);
		$statement->bindValue(':productId', $productId, PDO::PARAM_INT);

		$result = $statement->execute();

		$update1 = "UPDATE sanpham SET ten = '$productName', loai = '$category', anh = '$image', giamgia = '$sale', thoigiangiamgia = '$dateSale', dongia = '$price', tonkho = '$instock', daban = '$selled', danhgia = '$rate', yeuthich = '$like', mota = '$descriptionLong', motangan = '$descriptionShort', ngaycapnhat = '$dateFix', trangthai = 0 WHERE maSP = '$productId'";

		// lưu vào thông báo
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên sản phẩm: $productName')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update1\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//
		return $result;
	}


	public function editProductDatabaseNoImage($productId, $productName, $category, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$update = "UPDATE sanpham SET ten = :productName, loai = :category, giamgia = :sale, thoigiangiamgia = :dateSale, dongia = :price, tonkho = :instock, daban = :selled, danhgia = :rate, yeuthich = :like, mota = :descriptionLong, motangan = :descriptionShort, ngaycapnhat = :dateFix, trangthai = 0 WHERE maSP = :productId";

		$statement = $this->db->prepare($update);
		$statement->bindValue(':productName', $productName, PDO::PARAM_STR);
		$statement->bindValue(':category', $category, PDO::PARAM_STR);
		$statement->bindValue(':sale', $sale, PDO::PARAM_INT);
		$statement->bindValue(':dateSale', $dateSale, PDO::PARAM_STR);
		$statement->bindValue(':price', $price, PDO::PARAM_INT);
		$statement->bindValue(':instock', $instock, PDO::PARAM_STR);
		$statement->bindValue(':selled', $selled, PDO::PARAM_STR);
		$statement->bindValue(':rate', $rate, PDO::PARAM_STR);
		$statement->bindValue(':like', $like, PDO::PARAM_STR);
		$statement->bindValue(':descriptionLong', $descriptionLong, PDO::PARAM_STR);
		$statement->bindValue(':descriptionShort', $descriptionShort, PDO::PARAM_STR);
		$statement->bindValue(':dateFix', $dateFix, PDO::PARAM_STR);
		$statement->bindValue(':productId', $productId, PDO::PARAM_INT);

		$result = $statement->execute();

		$update1 = "UPDATE sanpham SET ten = '$productName', loai = '$category', giamgia = '$sale', thoigiangiamgia = '$dateSale', dongia = '$price', tonkho = '$instock', daban = '$selled', danhgia = '$rate', yeuthich = '$like', mota = '$descriptionLong', motangan = '$descriptionShort', ngaycapnhat = '$dateFix', trangthai = 0 WHERE maSP = '$productId'";

		// lưu vào thông báo
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên sản phẩm: $productName')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update1\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//
		return $result;
	}

	public function deleteProductDatabase($productId)
	{
		$select = "SELECT ten FROM sanpham WHERE maSP = $productId";
		$productName = $this->db->getInstance($select)['ten'];

		$query = "UPDATE sanpham SET trangthai = 0 WHERE maSP = $productId";

		$result = $this->db->exec($query);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Ẩn sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên sản phẩm: $productName')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$query\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function findProductById($productId)
	{
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and maSP = $productId and a.i_delete = 1 ";
		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getAllCustomer()
	{
		$select = "SELECT * FROM nguoi_dung WHERE i_delete = 1";
		$result = $this->db->getList($select);
		return $result;
	}
	public function getCustomerByEmail($email)
	{
		$select = "SELECT * FROM nguoi_dung WHERE email like '%$email%@gmail.com' and i_delete = 1";
		$result = $this->db->getList($select);
		return $result;
	}
	public function getCustomerById($idCustomer)
	{
		$select = "SELECT * FROM nguoi_dung WHERE id like '%$idCustomer%' and i_delete = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function addCustomer($fname, $lname, $email, $password)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$fullname = trim($fname) . " " . trim($lname);

		$insert = "INSERT INTO nguoi_dung (ho, ten, hovaten, email, matkhau, trangthai) VALUES ('$fname', '$lname', '$fullname', '$email', '$mk', 1)";

		$result = $this->db->exec($insert);

		// lưu vào thông báo
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Thêm tài khoản khách hàng mới','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email khách hàng: $email')'";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getAllCustomerExport()
	{
		$select = "SELECT * FROM nguoi_dung";
		$result = $this->db->getList($select);
		return $result;
	}

	public function findCustomerById($idCustomer)
	{
		$select = "SELECT * FROM nguoi_dung WHERE id = $idCustomer and i_delete = 1";
		return $this->db->getInstance($select);
	}

	public function findAdminById($adminId)
	{
		$select = "SELECT a.*, b.quyen FROM admin a, phan_quyen b WHERE a.maQuyen = b.maQuyen and id = $adminId and a.i_delete = 1 ";
		return $this->db->getInstance($select);
	}

	public function deleteAdmin($idAdmin)
	{
		$delete = "UPDATE admin SET trangthai = 0 WHERE id = $idAdmin";

		$result = $this->db->exec($delete);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT email FROM admin WHERE id = $idAdmin";
		$email = $this->db->getInstance($select)['email'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Ẩn tài khoản quản trị','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email quản trị: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function deleteCustomer($idCustomer)
	{
		$delete = "UPDATE nguoi_dung SET trangthai = 0 WHERE id = $idCustomer";

		$result = $this->db->exec($delete);

		// lưu vào thông báo

		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT email FROM nguoi_dung WHERE id = $idCustomer";
		$email = $this->db->getInstance($select)['email'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Ẩn tài khoản khách hàng','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email khách hàng: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function updateCustomer($idCustomer, $email, $phone, $fname, $lname, $password, $birth, $address)
	{
		if (!empty($password) && intval($password) != '') {
			$mahoa1 = "!%HazKing@";
			$mahoa2 = "!^HazHonTu*";
			$mk = md5($mahoa1 . $password . $mahoa2);

			$update = "UPDATE nguoi_dung SET ho = '$fname', ten='$lname', sdt = '$phone', email = '$email', matkhau = '$mk', ngaysinh = '$birth', diachi = '$address' WHERE id = $idCustomer";
		} else {
			$update = "UPDATE nguoi_dung SET ho = '$fname', ten='$lname', sdt = '$phone', email = '$email', ngaysinh = '$birth', diachi = '$address' WHERE id = $idCustomer";
		}

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật tài khoản khách hàng','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email khách hàng: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getAllRole()
	{
		$select = "SELECT * FROM phan_quyen WHERE trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getRoleByName($roleName)
	{
		$select = "SELECT * FROM phan_quyen WHERE quyen = '$roleName'";
		$result = $this->db->getInstance($select);
		return $result;
	}


	public function getAllAdmin()
	{
		$select = "SELECT a.*, quyen FROM admin as a, phan_quyen as b WHERE a.maQuyen = b.maQuyen and a.i_delete = 1 ";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAdminByRole($role)
	{
		$select = "SELECT a.*, quyen FROM admin as a, phan_quyen as b WHERE a.maQuyen = b.maQuyen and a.maQuyen = $role and a.i_delete = 1 ";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAdminByIdAdmin($idAdmin)
	{
		$select = "SELECT a.*, quyen FROM admin as a, phan_quyen as b WHERE a.maQuyen = b.maQuyen and a.id like '$idAdmin%' and a.i_delete = 1 ";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAdminByEmail($email)
	{
		$select = "SELECT a.*, quyen FROM admin as a, phan_quyen as b WHERE a.maQuyen = b.maQuyen and email like '%$email%@gmail.com' and a.i_delete = 1 ";
		$result = $this->db->getList($select);
		return $result;
	}


	public function addAdmin($fname, $lname, $email, $password, $phone, $role, $userName)
	{
		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);

		$fullname = trim($fname) . " " . trim($lname);

		$insert = "INSERT INTO admin (ho, ten, hovaten, sdt, email, tendn, matkhau, maQuyen, trangthai) VALUES ('$fname', '$lname', '$fullname', '$phone', '$email', '$userName', '$mk', $role, 1)";

		$result = $this->db->exec($insert);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Thêm tài khoản quản trị mới','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email quản trị: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getAllAdminExport()
	{
		$select = "SELECT a.*, quyen FROM admin as a, phan_quyen as b WHERE a.maQuyen != 0 and a.maQuyen = b.maQuyen";
		$result = $this->db->getList($select);
		return $result;
	}

	public function updateAdmin($idAdmin, $email, $phone, $fname, $lname, $role, $password, $birth, $address, $userName)
	{
		if (!empty($password) && $password != '') {
			$mahoa1 = "!%HazKing@";
			$mahoa2 = "!^HazHonTu*";
			$mk = md5($mahoa1 . $password . $mahoa2);

			$update = "UPDATE admin SET ho = '$fname', ten='$lname', sdt = '$phone', email = '$email', maQuyen = $role, matkhau = '$mk', ngaysinh = '$birth', diachi = '$address', tendn = '$userName' WHERE id = $idAdmin";
		} else {
			$update = "UPDATE admin SET ho = '$fname', ten='$lname', sdt = '$phone', email = '$email', maQuyen = $role, ngaysinh = '$birth', diachi = '$address', tendn = '$userName' WHERE id = $idAdmin";
		}
		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật tài khoản admin','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email quản trị: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getAllNews()
	{
		$select = "SELECT * FROM tin_tuc WHERE i_delete = 1  ORDER BY maTT DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllNewsExport()
	{
		$select = "SELECT * FROM tin_tuc";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getNewsById($id)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT = $id and i_delete = 1  ORDER BY maTT DESC";
		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getNewsByTT($tt)
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang = $tt and i_delete = 1  ORDER BY maTT DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getNewsBySearch($search)
	{
		$select = "SELECT * FROM tin_tuc WHERE tenTT like '%$search%' and i_delete = 1  ORDER BY maTT DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function editNews($newsId, $title, $date, $imageName, $content, $detail)
	{
		$dateNow = new DateTime('now');
		$dateFix = $dateNow->format('Y-m-d');

		$update = "UPDATE tin_tuc SET tenTT = '$title',anh = '$imageName', ngay = '$date', noidung = '$content', chitiet = '$detail', ngaycapnhat = '$dateFix', tinhtrang = 2 WHERE maTT = $newsId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật tin tức','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tiêu đề tin tức: $title')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function editNewsNoImage($newsId, $title, $date, $content, $detail)
	{
		$dateNow = new DateTime('now');
		$dateFix = $dateNow->format('Y-m-d');

		$update = "UPDATE tin_tuc SET tentT = '$title', ngay = '$date', noidung = '$content', chitiet = '$detail', ngaycapnhat = '$dateFix', tinhtrang = 2 WHERE maTT = $newsId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật tin tức','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tiêu đề tin tức: $title')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function addNews($title, $date, $image, $content)
	{
		$insert = "INSERT INTO tin_tuc (tenTT, anh, ngay, noidung, tinhtrang)

		VALUES ('$title', '$image', '$date', '$content', 2)";

		$result = $this->db->exec($insert);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Thêm tin tức mới','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tiêu đề tin tức: $title')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function deleteNews($newsId)
	{
		$delete = "UPDATE tin_tuc SET tinhtrang = 2 WHERE maTT = $newsId";

		$result = $this->db->exec($delete);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT tenTT FROM tin_tuc WHERE maTT = $newsId";
		$title = $this->db->getInstance($select)['tenTT'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Ẩn tin tức','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tiêu đề tin tức: $title')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function dropNews($newsId)
	{
		$delete = "UPDATE tin_tuc SET i_delete = 0 WHERE maTT = $newsId";

		$result = $this->db->exec($delete);

		// lưu vào thông báo

		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT tenTT FROM tin_tuc WHERE maTT = $newsId";
		$title = $this->db->getInstance($select)['tenTT'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn tin tức','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tiêu đề tin tức: $title')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function restoreNews($newsId)
	{
		$delete = "UPDATE tin_tuc SET tinhtrang = 1 WHERE maTT = $newsId";

		$result = $this->db->exec($delete);

		// lưu vào thông báo

		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT tenTT FROM tin_tuc WHERE maTT = $newsId";
		$title = $this->db->getInstance($select)['tenTT'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục tin tức','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tiêu đề tin tức: $title')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getAllInvoice()
	{
		$select = "SELECT a.*, b.id, b.anh, b.hovaten FROM hoa_don as a, nguoi_dung as b WHERE a.id = b.id and a.i_delete = 1  ORDER BY maHD DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllStatusInvoice()
	{
		$select = "SELECT * FROM tt_hoadon";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getStatusInvoiceList($status)
	{
		$select = "SELECT a.*, b.id, b.anh, b.hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and a.tinhtrang = $status and a.i_delete = 1  ORDER BY maHD DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getInvoiceByCustomerName($name)
	{
		$select = "SELECT a.*, b.id, b.anh, b.hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and b.hovaten like '%$name%' and a.i_delete = 1 ORDER BY maHD DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getInvoiceByInvoiceId($id)
	{
		$select = "SELECT a.*, b.id, b.anh, b.hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and a.maHD like '%$id%' and a.i_delete = 1  ORDER BY maHD DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getAllInfoInvoices()
	{
		$select = "SELECT b.*, a.tinhtrang, a.trangthai, a.ngaycapnhat, a.ngay, a.tongtien FROM hoa_don as a, thanh_toan as b WHERE a.maHD = b.maHD and a.i_delete = 1 ";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllInfoInvoicesExport()
	{
		$select = "SELECT b.*, a.tinhtrang, a.trangthai, a.ngaycapnhat, a.ngay, a.tongtien FROM hoa_don as a, thanh_toan as b WHERE a.maHD = b.maHD";
		$result = $this->db->getList($select);
		return $result;
	}

	public function deleteInvoice($invoiceId)
	{
		$delete = "UPDATE hoa_don SET trangthai = 0 WHERE maHD = $invoiceId";

		$result = $this->db->exec($delete);

		// lưu vào thông báo

		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT maHD, hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $invoiceId";
		$maHD = $this->db->getInstance($select)['maHD'];
		$hovaten = $this->db->getInstance($select)['hovaten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Ẩn hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Tên khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function deleteInvoiceDetail($productId, $invoiceId)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		//Đếm số lượng sản phẩm có trạng thái = 1 trong hóa đơn
		$countStatus = 0;
		$getStatusProductInvoice = $this->getStatusProductInvoice($invoiceId);
		while ($get = $getStatusProductInvoice->fetch()) {
			if ($get['trangthai'] == 1) {
				$countStatus++;
			}
		}

		if ($countStatus > 1) {
			//cập nhật sản phẩm
			$update = "UPDATE ct_hoadon SET trangthai = 0 WHERE maHD = $invoiceId and maSP = $productId";
			$result = $this->db->exec($update);

			//Tính lại giá tiền khi cập nhật sản phẩm
			$total = 0;
			$getProductInvoiceById = $this->getProductInvoiceById($invoiceId);
			while ($get = $getProductInvoiceById->fetch()) {
				$total += $get['thanhtien'];
			}
			if ($result) {
				//Cập nhật lại hóa đơn
				$update2 = "UPDATE hoa_don SET tongtien = $total, ngaycapnhat = '$dateFix' WHERE maHD = $invoiceId";
				$this->db->exec($update2);
				echo json_encode(array(
					'status' => 1,
					'message' => 'Ẩn sản phẩm thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Ẩn sản phẩm thất bại'
				));
			}
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Phải tồn tại ít nhất một sản phẩm'
			));
		}
	}

	public function restoreInvoiceDetail($productId, $invoiceId)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		//cập nhật sản phẩm
		$update = "UPDATE ct_hoadon SET trangthai = 1 WHERE maHD = $invoiceId and maSP = $productId";
		$result = $this->db->exec($update);

		//Tính lại giá tiền khi cập nhật sản phẩm
		$total = 0;
		$getProductInvoiceById = $this->getProductInvoiceById($invoiceId);
		while ($get = $getProductInvoiceById->fetch()) {
			$total += $get['thanhtien'];
		}
		if ($result) {
			$update2 = "UPDATE hoa_don SET tongtien = $total, ngaycapnhat = '$dateFix' WHERE maHD = $invoiceId";
			$this->db->exec($update2);
			echo json_encode(array(
				'status' => 1,
				'message' => 'Khôi phục sản phẩm thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Khôi phục sản phẩm thất bại'
			));
		}
	}

	public function editInvoice($invoiceId, $productId, $quantity, $price)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$totalProduct = $quantity * $price;
		$updateOneProduct = "UPDATE ct_hoadon SET soluongmua = $quantity, thanhtien = $totalProduct WHERE maHD = $invoiceId and maSP = $productId";
		$result = $this->db->exec($updateOneProduct);

		if ($result) {
			$admin = new admin();
			$getProductInvoiceById = $admin->getInvoiceDetailById($invoiceId);
			$totalInvoice = 0;
			while ($get = $getProductInvoiceById->fetch()) {
				$totalInvoice += $get['thanhtien'];
			}

			$updateTotalInvoice = "UPDATE hoa_don SET tongtien = $totalInvoice, ngaycapnhat = '$dateFix' WHERE maHD = $invoiceId";
			$this->db->exec($updateTotalInvoice);

			//trả về
			echo json_encode(array(
				'status' => 1,
				'message' => "Cập nhật sản phẩm thành công",
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => "Cập nhật sản phẩm thất bại",
			));
		}

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT maHD, hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $invoiceId";
		$maHD = $this->db->getInstance($select)['maHD'];
		$hovaten = $this->db->getInstance($select)['hovaten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Tên khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$updateOneProduct\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//
	}

	public function editTT($tinhtrang, $invoiceId)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$update = "UPDATE hoa_don SET tinhtrang = $tinhtrang, ngaycapnhat = '$dateFix' WHERE maHD = $invoiceId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT maHD, hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $invoiceId";
		$maHD = $this->db->getInstance($select)['maHD'];
		$hovaten = $this->db->getInstance($select)['hovaten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật mục tình trạng hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Tên khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function editCompany($companyName, $invoiceId)
	{
		$update = "UPDATE thanh_toan a, hoa_don b SET congty = '$companyName' WHERE a.id = b.id and a.maHD = $invoiceId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT maHD, hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $invoiceId";
		$maHD = $this->db->getInstance($select)['maHD'];
		$hovaten = $this->db->getInstance($select)['hovaten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật mục công ty hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Tên khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function editAddress1($address, $invoiceId)
	{
		$update = "UPDATE thanh_toan a, hoa_don b SET diachi1 = '$address' WHERE a.id = b.id and a.maHD = $invoiceId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT maHD, hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $invoiceId";
		$maHD = $this->db->getInstance($select)['maHD'];
		$hovaten = $this->db->getInstance($select)['hovaten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật mục địa chỉ hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Tên khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function editAddress2($address, $invoiceId)
	{
		$update = "UPDATE thanh_toan a, hoa_don b SET diachi2 = '$address' WHERE a.id = b.id and a.maHD = $invoiceId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT maHD, hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $invoiceId";
		$maHD = $this->db->getInstance($select)['maHD'];
		$hovaten = $this->db->getInstance($select)['hovaten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật địa chỉ phụ hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Tên khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function editNote($note, $invoiceId)
	{
		$update = "UPDATE thanh_toan SET ghichu = '$note' WHERE maHD = $invoiceId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT maHD, hovaten FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $invoiceId";
		$maHD = $this->db->getInstance($select)['maHD'];
		$hovaten = $this->db->getInstance($select)['hovaten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật mục ghi chú hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Tên khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function deleteProductInInvoice($invoiceId, $productId)
	{
		$delete = "UPDATE ct_hoadon SET trangthai = 0 and maHD = $invoiceId and maSP = $productId";
		$this->db->exec($delete);

		$admin = new admin();
		$result = $admin->getProductInvoiceById($invoiceId);
		$totalInvoice = 0;
		while ($get = $result->fetch()) {
			$totalInvoice += $get['thanhtien'];
		}

		if ($totalInvoice > 0) {
			$updateTotalInvoice = "UPDATE hoa_don SET tongtien = $totalInvoice WHERE maHD = $invoiceId";
			$this->db->exec($updateTotalInvoice);
			return 1;
		} elseif ($totalInvoice !== false) {
			$delete = "UPDATE hoa_don SET trangthai = 0 WHERE maHD = $invoiceId";
			$this->db->exec($delete);
			return 0;
		}
	}

	public function getInvoiceById($invoiceId)
	{
		$select = "SELECT b.*, a.ngay, a.tongtien, a.tinhtrang, c.ten, d.trahang
		FROM hoa_don as a, thanh_toan as b, tt_hoadon as c, ct_hoadon as d
		WHERE d.maHD = a.maHD and d.maHD = b.maHD and a.id = b.id and b.maHD = a.maHD and b.maHD = $invoiceId and c.maTTHD = a.tinhtrang and a.i_delete = 1";

		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getProductInvoiceById($invoiceId)
	{
		$select = "SELECT c.maSP, c.tenSP, c.soluongmua, c.dongia, c.thanhtien, d.anh, e.tinhtrang, c.trahang
		FROM ct_hoadon as c, sanpham as d, hoa_don as e
		WHERE c.maSP = d.maSP and c.maHD = $invoiceId and e.maHD = c.maHD and c.trangthai = 1 and c.i_delete = 1 ";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getStatusProductInvoice($invoiceId)
	{
		$select = "SELECT c.maSP, c.tenSP, c.soluongmua, c.dongia, c.thanhtien, d.anh, c.trangthai
		FROM ct_hoadon as c, sanpham as d 
		WHERE c.maSP = d.maSP and c.maHD = $invoiceId";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getInvoiceDetailById($invoiceId)
	{
		$select = "SELECT c.maSP, c.tenSP, c.soluongmua, c.thanhtien, d.anh, c.trangthai, d.giamgia, c.dongia, c.trahang, e.tinhtrang
		FROM ct_hoadon as c, sanpham as d, hoa_don as e
		WHERE c.maSP = d.maSP and c.maHD = $invoiceId and e.maHD = c.maHD and e.i_delete = 1 ";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getReasonReturnProduct($invoiceId, $productId)
	{
		$select = "SELECT * FROM trahang_hoadon WHERE maHD = $invoiceId and maSP = $productId";

		$result = $this->db->getList($select);

		return $result;
	}


	public function getAllCategory()
	{
		$select = "SELECT * FROM loai_sanpham WHERE i_delete = 1 ";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getCategoryById($categoryId)
	{
		$select = "SELECT * FROM loai_sanpham WHERE maLoai = $categoryId and i_delete = 1 ";
		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getCategoryByName($categoryName)
	{
		$select = "SELECT * FROM loai_sanpham WHERE tenloai = '$categoryName' and i_delete = 1 ";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function addCategory($categoryName)
	{
		$insert = "INSERT INTO loai_sanpham (tenloai) VALUES ('$categoryName')";

		$result = $this->db->exec($insert);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Thêm loại sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên loại sản phẩm: $categoryName')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function deleteCategory($categoryId)
	{
		$delete = "UPDATE loai_sanpham SET trangthai = 0 WHERE maLoai = $categoryId";
		$delete2 = "UPDATE sanpham SET trangthai = 0 WHERE loai = $categoryId";
		$result = $this->db->exec($delete);
		if ($result) {
			$this->db->exec($delete2);

			//trả về
			echo json_encode(array(
				'status' => 1,
				'message' => 'Ẩn loại sản phẩm thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Ẩn loại sản phẩm thất bại'
			));
		}
		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT tenloai FROM loai_sanpham WHERE maLoai = $categoryId";
		$tenloai = $this->db->getInstance($select)['tenloai'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Ẩn loại sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên loại sản phẩm: $tenloai')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//
	}

	public function restoreCategory($categoryId)
	{
		$delete = "UPDATE loai_sanpham SET trangthai = 1 WHERE maLoai = $categoryId";
		$delete2 = "UPDATE sanpham SET trangthai = 1 WHERE loai = $categoryId";
		$result = $this->db->exec($delete);
		if ($result) {
			$this->db->exec($delete2);

			//trả về

			echo json_encode(array(
				'status' => 1,
				'message' => 'Khôi phục loại sản phẩm thành công'
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => 'Khôi phục loại sản phẩm thất bại'
			));
		}

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT tenloai FROM loai_sanpham WHERE maLoai = $categoryId";
		$tenloai = $this->db->getInstance($select)['tenloai'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục loại sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên loại sản phẩm: $tenloai')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
	}

	public function dropCategory($categoryId)
	{
		$select = "SELECT count(*) as qty, tenloai FROM sanpham a, loai_sanpham b WHERE loai = maLoai and loai = $categoryId";
		$a = $this->db->getInstance($select)['tenloai'];
		$b = $this->db->getInstance($select)['qty'];
		if ($b != 0) {
			echo json_encode(array(
				'status' => 0,
				'message' => "Loại $a vẫn còn $b sản phẩm"
			));
		} else {
			$delete = "UPDATE loai_sanpham SET i_delete = 0 WHERE maLoai = $categoryId";
			$result = $this->db->exec($delete);

			// lưu vào thông báo
			$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
			$dateFix = $date->format('Y-m-d H:i:s');

			$select = "SELECT tenloai FROM loai_sanpham WHERE maLoai = $categoryId";
			$tenloai = $this->db->getInstance($select)['tenloai'];

			$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn loại sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên loại sản phẩm: $tenloai')";

			$this->db->exec($insertNotify);

			$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
			$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

			$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

			$this->db->exec($updateNotify);
			//

			if ($result) {
				//trả về
				echo json_encode(array(
					'status' => 1,
					'message' => 'Xóa loại sản phẩm thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Xóa loại sản phẩm thất bại'
				));
			}
		}
	}



	public function editCategory($categoryId, $categoryName)
	{
		$update = "UPDATE loai_sanpham SET tenloai = '$categoryName', trangthai = 0 WHERE maLoai = $categoryId";


		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật loại sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên loại sản phẩm: $categoryName')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getAllComment()
	{
		$select = "SELECT * FROM comments WHERE trangthai = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getQtyCommentByProductId($productId)
	{
		$select = "SELECT count(*) as 'soluong' FROM binh_luan WHERE maSP = $productId and i_delete = 1";

		$result = $this->db->getInstance($select);
		return $result;
	}

	public function getCommentProduct($productId, $rate)
	{
		if ($rate != '') {
			$select = "SELECT * FROM binh_luan WHERE maSP = $productId and danhgia = $rate and i_delete = 1 ORDER BY maBL DESC";
		} else {
			$select = "SELECT * FROM binh_luan WHERE maSP = $productId and i_delete = 1 ORDER BY maBL DESC";
		}

		$result = $this->db->getList($select);

		return $result;
	}

	public function deleteCommentProduct($productId, $idComment)
	{
		$select = "UPDATE binh_luan SET trangthai = 0 WHERE maSP = $productId AND maBL = $idComment";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT binhluan FROM binh_luan WHERE maSP = $productId and maBL = $idComment";
		$binhluan = $this->db->getInstance($select1)['binhluan'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Ẩn bình luận','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã sản phẩm: $productId. Nội dung: $binhluan')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function dropCommentProduct($productId, $idComment)
	{
		$select = "UPDATE binh_luan SET i_delete = 0 WHERE maSP = $productId AND maBL = $idComment";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT binhluan FROM binh_luan WHERE maSP = $productId and maBL = $idComment";
		$binhluan = $this->db->getInstance($select1)['binhluan'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn bình luận','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã sản phẩm: $productId. Nội dung: $binhluan')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function restoreCommentProduct($productId, $idComment)
	{
		$select = "UPDATE binh_luan SET trangthai = 1 WHERE maSP = $productId AND maBL = $idComment";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT binhluan FROM binh_luan WHERE maSP = $productId and maBL = $idComment";
		$binhluan = $this->db->getInstance($select1)['binhluan'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục bình luận','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã sản phẩm: $productId. Nội dung: $binhluan')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getAllContact()
	{
		$select = "SELECT * FROM lienhe WHERE i_delete = 1 ORDER BY maLH DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function editContact($idContact, $author, $subject, $email, $content)
	{
		$content = trim($content);
		$select = "UPDATE lienhe SET tacgia = '$author', chude = '$subject' , email ='$email', noidung = '$content' WHERE maLH = $idContact";

		$result = $this->db->getList($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Cập nhật thư','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email người liên hệ: $email. Chủ đề: $subject. Nội dung: $content')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function getInfoContact($idContact)
	{
		$select = "SELECT * FROM lienhe WHERE maLH = $idContact and i_delete = 1 ";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function getAllContactExport()
	{
		$select = "SELECT * FROM lienhe";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getContactByEmail($email)
	{
		$select = "SELECT * FROM lienhe WHERE email like '%$email%' and i_delete = 1 ORDER BY maLH DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getContactBySubject($subject)
	{
		$select = "SELECT * FROM lienhe WHERE chude LIKE '%$subject%' and i_delete = 1 ORDER BY maLH DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getEmailSendContact()
	{
		$select = "SELECT email FROM lienhe WHERE i_delete = 1 GROUP BY email ";

		$result = $this->db->getList($select);

		return $result;
	}

	public function updateRepContact($contactId, $author, $content, $repcontent)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$update = "UPDATE lienhe SET phanhoi = '$repcontent', ngayphanhoi = '$dateFix', trangthai = 2 WHERE maLH = $contactId";

		$result = $this->db->exec($update);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT email, chude FROM lienhe WHERE maLH = $contactId";
		$email = $this->db->getInstance($select1)['email'];
		$subject = $this->db->getInstance($select1)['chude'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Phản hồi thư được','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email người gửi: $email. Chủ đề: $subject'. Nội dung: $content. Phản hồi: $repcontent)";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$update\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function dropContact($contactId)
	{
		$delete = "UPDATE lienhe SET i_delete = 0 WHERE maLH = $contactId";

		$result = $this->db->exec($delete);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT email, chude, noidung FROM lienhe WHERE maLH = $contactId";
		$email = $this->db->getInstance($select)['email'];
		$subject = $this->db->getInstance($select)['chude'];
		$content = $this->db->getInstance($select)['noidung'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn thư','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email người gửi: $email. Chủ đề: $subject. Nội dung: $content')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}



	public function thongKeTheoMY($month, $year)
	{
		$select = "SELECT a.ten, sum(soluongmua) as soluongmua FROM sanpham a, ct_hoadon b, hoa_don c WHERE a.maSP = b.maSP and c.maHD = b.maHD and month(ngay) = $month and year(ngay) = $year group by a.ten";

		$result = $this->db->getlist($select);

		return  $result;
	}

	public function thongKeTheoDMY($day, $month, $year)
	{
		$select = "SELECT a.ten, sum(soluongmua) as soluongmua FROM sanpham a, ct_hoadon b, hoa_don c WHERE a.maSP = b.maSP and c.maHD = b.maHD and day(ngay) = $day and month(ngay) = $month and year(ngay) = $year group by a.ten";

		$result = $this->db->getlist($select);

		return  $result;
	}

	public function thongKeTheoQuy($quy, $year)
	{

		$start_date = '';
		$end_date = '';

		// Tính ngày bắt đầu và ngày kết thúc của quý
		switch ($quy) {
			case 1:
				$start_date = $year . '-01-01';
				$end_date = $year . '-03-31';
				break;
			case 2:
				$start_date = $year . '-04-01';
				$end_date = $year . '-06-30';
				break;
			case 3:
				$start_date = $year . '-07-01';
				$end_date = $year . '-09-30';
				break;
			case 4:
				$start_date = $year . '-10-01';
				$end_date = $year . '-12-31';
				break;
			default:
				return null;
				break;
		}

		// Lấy thông tin sản phẩm bán được trong quý
		$select = "SELECT a.ten, SUM(b.soluongmua) AS soluongmua, c.ngay FROM sanpham a, ct_hoadon b, hoa_don c WHERE a.maSP = b.maSP AND c.maHD = b.maHD AND c.ngay >= '$start_date' AND c.ngay <= '$end_date' and year(c.ngay) = $year GROUP BY a.ten";

		$result = $this->db->getlist($select);

		return $result;
	}



	public function getAllAdminDeleted()
	{
		$select = "SELECT * FROM admin as a, phan_quyen as b WHERE a.maQuyen != 0 and a.maQuyen = b.maQuyen and a.trangthai = 0";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllCustomerDeleted()
	{
		$select = "SELECT * FROM admin as a, phan_quyen as b WHERE a.maQuyen = 0 and a.maQuyen = b.maQuyen and a.trangthai = 0";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllProductDeleted()
	{
		$select = "SELECT * FROM sanpham a, loai_sanpham b WHERE loai = maLoai and a.trangthai = 0 ORDER BY a.maSP DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllCategoryDeleted()
	{
		$select = "SELECT * FROM loai_sanpham WHERE trangthai = 0";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllInvoiceDeleted()
	{
		$select = "SELECT * FROM hoa_don as a, admin as b WHERE a.id = b.id and a.trangthai = 0 ORDER BY maHD DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllContactDeleted()
	{
		$select = "SELECT * FROM lienhe WHERE trangthai = 0 ORDER BY maLH DESC";
		$result = $this->db->getList($select);
		return $result;
	}

	public function restoreAdmin($idAdmin)
	{
		$select = "UPDATE admin SET trangthai = 1 WHERE id = $idAdmin";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT email FROM admin WHERE id = $idAdmin";
		$email = $this->db->getInstance($select1)['email'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục tài khoản quản trị','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email quản trị: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function restoreCustomer($idCustomer)
	{
		$select = "UPDATE nguoi_dung SET trangthai = 1 WHERE id = $idCustomer";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT email FROM nguoi_dung WHERE id = $idCustomer";
		$email = $this->db->getInstance($select1)['email'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục tài khoản người dùng','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email người dùng: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function restoreProduct($idProduct)
	{
		$select = "UPDATE sanpham SET trangthai = 1 WHERE maSP = $idProduct";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT ten FROM sanpham WHERE maSP = $idProduct";
		$ten = $this->db->getInstance($select1)['ten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên sản phẩm: $ten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function restoreInvoice($idInvoice)
	{
		$select = "UPDATE hoa_don SET trangthai = 1 WHERE maHD = $idInvoice";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT hovaten, maHD FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and maHD = $idInvoice";
		$hovaten = $this->db->getInstance($select1)['hovaten'];
		$maHD = $this->db->getInstance($select1)['maHD'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục hóa đơn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn $maHD. Khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function restoreContact($idContact)
	{
		$select = "UPDATE lienhe SET trangthai = 1 WHERE maLH = $idContact";

		$result = $this->db->exec($select);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT email, chude, noidung FROM lienhe WHERE maLH = $idContact";
		$email = $this->db->getInstance($select1)['email'];
		$content = $this->db->getInstance($select1)['noidung'];
		$subject = $this->db->getInstance($select1)['chude'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Khôi phục thư','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email người gửi: $email. Chủ đề: $subject. Nội dung: $content')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$select\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function dropAdmin($idAdmin)
	{
		$delete = "UPDATE admin SET i_delete = 0 WHERE id = $idAdmin";

		$select = "SELECT * FROM admin WHERE id = $idAdmin";
		$a = $this->db->getInstance($select);

		$result = $this->db->exec($delete);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select1 = "SELECT email FROM admin WHERE id = $idAdmin";
		$email = $this->db->getInstance($select1)['email'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn tài khoản quản trị','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email quản trị: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}



	public function dropCustomer($idCustomer)
	{
		$delete = "UPDATE nguoi_dung SET i_delete = 0 WHERE id = $idCustomer";

		$select = "SELECT * FROM nguoi_dung WHERE id = $idCustomer";
		$a = $this->db->getInstance($select);

		$result = $this->db->exec($delete);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT email FROM nguoi_dung WHERE id = $idCustomer";
		$email = $this->db->getInstance($select)['email'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn tài khoản khách hàng','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email khách hàng: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//


		return $result;
	}

	public function dropProduct($idProduct)
	{
		$delete = "UPDATE sanpham SET i_delete = 0 WHERE maSP = $idProduct";

		$result = $this->db->exec($delete);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT ten FROM sanpham WHERE maSP = $idProduct";
		$ten = $this->db->getInstance($select)['ten'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn sản phẩm','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên sản phẩm: $ten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function dropInvoice($idInvoice)
	{
		$delete = "UPDATE hoa_don SET i_delete = 0 WHERE maHD = $idInvoice";

		$result = $this->db->exec($delete);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$select = "SELECT hovaten, maHD FROM hoa_don a, nguoi_dung b WHERE a.id = b.id and a.maHD = $idInvoice";
		$hovaten = $this->db->getInstance($select)['hovaten'];
		$maHD = $this->db->getInstance($select)['maHD'];

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Xóa vĩnh viễn','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Mã hóa đơn: $maHD. Khách hàng: $hovaten')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$delete\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function importProducts($productImage, $productName, $category, $price, $instock, $descriptionShort, $descriptionLong)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$insert = "INSERT INTO sanpham (ten, loai, anh, dongia, motangan, mota, tonkho, ngaythem, trangthai)
		VALUES ('$productName', $category, '$productImage', '$price', '$descriptionShort', '$descriptionLong' , '$instock', '$dateFix', 0)";

		$result = $this->db->exec($insert);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Thêm sản phẩm mới','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Tên sản phẩm: $productName')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	public function importAdmin($fname, $lname, $email, $password, $phone, $roleId)
	{
		$fullname = trim($fname) . " " . trim($lname);

		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d');

		$mahoa1 = "!%HazKing@";
		$mahoa2 = "!^HazHonTu*";
		$mk = md5($mahoa1 . $password . $mahoa2);


		$insert = "INSERT INTO admin (ho, ten, hovaten, sdt, email, matkhau, maQuyen, ngaydk)
		VALUES ('$fname', '$lname', '$fullname', '$phone', '$email', '$mk', '$roleId', '$dateFix')";

		$result = $this->db->exec($insert);

		// lưu vào thông báo
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('{$_SESSION['id_admin']}', '{$_SESSION['fullname_admin']}','Thêm tài khoản quản trị','$dateFix', '{$_SESSION['image_admin']}', '$result', 'Email quản trị: $email')";

		$this->db->exec($insertNotify);

		$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
		$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

		$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

		$this->db->exec($updateNotify);
		//

		return $result;
	}

	// thông báo khi có ai đố tác đụng đến dữ liệu web - thêm - xóa - sửa

	public function getAllNotify()
	{
		$select = "SELECT a.*, b.email, b.sdt FROM thongbao a, admin b WHERE a.id = b.id and a.i_delete = 1 ORDER BY maTB DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getNotifyByDay($day)
	{
		$dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateInput = new DateTime($day, new DateTimeZone('Asia/Ho_Chi_Minh'));

		$Y = $dateInput->format('Y');
		$M = $dateInput->format('m');
		$D = $dateInput->format('d');

		$YNow = $dateNow->format('Y');
		$MNow = $dateNow->format('m');
		$DNow = $dateNow->format('d');

		if ($Y >= $YNow) {
			$Y = $YNow;
			if ($M >= $MNow) {
				$M = $MNow;
				if ($D >= $DNow) {
					$D = $DNow;
				}
			}
		} else if ($Y < 2023) {
			$Y = 2023;
			if ($M >= $MNow) {
				$M = $MNow;
				if ($D >= $DNow) {
					$D = $DNow;
				}
			}
		}

		$select = "SELECT a.*, b.email, b.sdt FROM thongbao a, admin b WHERE YEAR(ngay) = $Y and MONTH(ngay) = $M and DAY(ngay) = $D and a.id = b.id and a.i_delete = 1 ORDER BY maTB DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getLimitNotify()
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('d');

		$select = "SELECT * FROM thongbao WHERE i_delete = 1 and DAY(ngay) = '$dateFix' ORDER BY maTB DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getNotifyToDay()
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('d');
		// echo $dateFix;	
		$select = "SELECT * FROM thongbao WHERE DAY(ngay) = '$dateFix' and i_delete = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function dropAllNotify()
	{
		$select = "DELETE FROM thongbao";

		$result = $this->db->exec($select);

		return $result;
	}

	public function getNotifyContactByDay($day)
	{
		$dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateInput = new DateTime($day, new DateTimeZone('Asia/Ho_Chi_Minh'));

		$Y = $dateInput->format('Y');
		$M = $dateInput->format('m');
		$D = $dateInput->format('d');

		$YNow = $dateNow->format('Y');
		$MNow = $dateNow->format('m');
		$DNow = $dateNow->format('d');

		if ($Y >= $YNow) {
			$Y = $YNow;
			if ($M >= $MNow) {
				$M = $MNow;
				if ($D >= $DNow) {
					$D = $DNow;
				}
			}
		} else if ($Y < 2023) {
			$Y = 2023;
			if ($M >= $MNow) {
				$M = $MNow;
				if ($D >= $DNow) {
					$D = $DNow;
				}
			}
		}

		$select = "SELECT a.*, b.email, b.sdt FROM thongbao a, admin b WHERE YEAR(ngay) = $Y and MONTH(ngay) = $M and DAY(ngay) = $D and a.id = b.id and a.i_delete = 1 ORDER BY maTB DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getLimitNotifyContact()
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('d');

		$select = "SELECT * FROM lienhe WHERE i_delete = 1 and DAY(ngaygui) = '$dateFix' ORDER BY maLH DESC";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getNotifyContactToDay()
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('d');
		// echo $dateFix;	
		$select = "SELECT * FROM lienhe WHERE DAY(ngaygui) = '$dateFix' and i_delete = 1";

		$result = $this->db->getList($select);

		return $result;
	}
}
