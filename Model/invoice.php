<?php
class invoice
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getAllStatusInvoice()
	{
		$select = "SELECT * FROM tt_hoadon";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getProductInvoiceById($invoiceId)
	{
		$select = "SELECT c.maSP, c.tenSP, c.soluongmua, c.dongia, c.thanhtien, d.anh, e.tinhtrang, c.trahang
		FROM ct_hoadon as c, sanpham as d, hoa_don as e
		WHERE c.maSP = d.maSP and c.maHD = $invoiceId and e.maHD = c.maHD and c.trangthai = 1";

		$result = $this->db->getList($select);
		return $result;
	}
}
