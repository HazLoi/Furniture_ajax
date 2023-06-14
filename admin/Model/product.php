<?php
class product
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getAllProduct()
	{
		$select = "SELECT * FROM sanpham WHERE trangthai = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getProductOnePage($start, $limit)
	{

		$select = "SELECT * FROM sanpham WHERE trangthai = 1 and i_delete = 1 limit $start , $limit ";

		$result = $this->db->getList($select);

		return $result;
	}

	public function checkProductId($maSP)
	{
		$select = "SELECT * FROM sanpham WHERE maSP = '$maSP' and trangthai = 1";

		$result = $this->db->getInstance($select);

		return $result;
	}

	public function checkInStock($maSP)
	{

		$query = "SELECT tonkho FROM sanpham WHERE maSP = $maSP and trangthai = 1";

		$result = $this->db->getInstance($query);

		return $result[0];
	}

	public function relatedProducts($loai, $maSP)
	{
		$select = "SELECT * FROM sanpham WHERE maSP != $maSP and loai = '$loai' and trangthai = 1 limit 4";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getProductForSearch($productSearch, $start , $limit)
	{
		$select = "SELECT * FROM sanpham WHERE ten like '%$productSearch%' and trangthai = 1 and i_delete = 1 limit $start , $limit";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllProductForSearch($productSearch)
	{
		$select = "SELECT * FROM sanpham WHERE ten like '%$productSearch%' and trangthai = 1 and i_delete = 1";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getProductForCategory($category, $start , $limit)
	{
		$select = "SELECT * FROM sanpham as a, loai_sanpham as b WHERE loai = maLoai and tenloai = '$category'  and a.trangthai = 1 and a.i_delete = 1 limit $start , $limit";

		$result = $this->db->getList($select);
		
		return $result;
	}

	public function getAllProductForCategory($category)
	{
		$select = "SELECT * FROM sanpham as a, loai_sanpham as b WHERE loai = maLoai and tenloai = '$category'  and a.trangthai = 1 and a.i_delete = 1";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getAllCategory()
	{
		$select = "SELECT maLoai, tenloai, count(maSP) as 'tongSP' FROM loai_sanpham a, sanpham b WHERE maLoai = loai and b.trangthai = 1 and a.trangthai = 1 and a.i_delete = 1 GROUP BY maLoai";
		$result = $this->db->getList($select);
		return $result;
	}
}
