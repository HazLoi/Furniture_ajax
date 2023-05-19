<?php

class checkout
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function insertInvoice($id)
	{
		$date = new DateTime('now');
		$dateFix = $date->format('Y-m-d');

		$query = "INSERT INTO hoa_don (maHD, id, ngay, tongtien, tinhtrang)
		VALUES (null, $id, '$dateFix', 0, 1)";

		$this->db->exec($query);
		// lấy mã hóa đơn mới nhất
		$select = "SELECT maHD FROM hoa_don ORDER BY maHD DESC limit 1";
		$int = $this->db->getInstance($select);
		return $int[0];
	}

	public function insertInvoiceDetails($maHD, $maSP, $tenSP, $soluongmua, $dongia, $thanhtien)
	{
		$insert = "INSERT INTO ct_hoadon (maHD, maSP, tenSP, soluongmua, dongia, thanhtien) 
		VALUES ($maHD, $maSP, '$tenSP', '$soluongmua', $dongia, $thanhtien)";

		$result = $this->db->exec($insert);
		return $result;
	}

	public function updateInvoiceTotal($maHD, $tongtien)
	{
		$query = "UPDATE hoa_don SET tongtien = '$tongtien' WHERE maHD = $maHD";

		$return = $this->db->exec($query);

		return $return;
	}

	public function saveInvoiceInfomation($idInvoice, $idCustomer, $fullname, $phone, $email, $companyName, $address1, $address2, $city, $note)
	{
		$insert = "INSERT INTO thanh_toan (maHD, id, tenKH, sdt, email, congty, diachi1, diachi2, thanhpho, ghichu)
			VALUES ($idInvoice, $idCustomer, '$fullname', '$phone', '$email', '$companyName', '$address1', '$address2', '$city', '$note')";
		$result =  $this->db->exec($insert);

		return $result;
	}
}
