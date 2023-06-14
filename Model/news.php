<?php
class news
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getAllNewsByType($type){
		$select = "SELECT * FROM tin_tuc WHERE loai = $type and tinhtrang = 1 and i_delete = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getTypeNewsOnePage($type, $start, $limit){
		$select = "SELECT * FROM tin_tuc WHERE loai = $type and tinhtrang = 1 and i_delete = 1 ORDER BY ngay DESC limit $start, $limit";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getAllNewsType(){
		$select = "SELECT a.*, count(loai) as soluong FROM loai_tintuc a, tin_tuc b WHERE a.i_delete = 1 and b.i_delete = 1 and loai = maLoai GROUP BY maLoai HAVING COUNT(loai) > 0";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getViewNews($newsId)
	{
		$select = "SELECT luotxem FROM tin_tuc WHERE maTT = $newsId";

		$result = $this->db->getInstance($select)['luotxem'];

		return $result;
	}

	public function updateViewNews($newsId, $view)
	{
		$view += 1;
		$update = "UPDATE tin_tuc SET luotxem = $view WHERE maTT = $newsId";
		
		$result = $this->db->exec($update);

		return $result;
	}

	public function getAllNews()
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang = 1 and i_delete = 1";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getAllSearchNews($newsSearch)
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang = 1 and i_delete = 1 and tenTT like '%$newsSearch%'";

		$result = $this->db->getList($select);

		return $result;
	}

	public function getNewsOnePage($start, $limit)
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang = 1 and i_delete = 1 ORDER BY ngay DESC limit $start, $limit";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getSearchNewsOnePage($newsSearch, $start, $limit)
	{
		$select = "SELECT * FROM tin_tuc WHERE tinhtrang = 1 and i_delete = 1 and tenTT like '%$newsSearch%' ORDER BY ngay DESC limit $start, $limit";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getNewsDetailPage($start, $limit, $newsId)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT != $newsId and tinhtrang = 1 and i_delete = 1 ORDER BY ngay DESC limit $start, $limit";
		$result = $this->db->getList($select);
		return $result;
	}

	public function getNewsDetail($newsId)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT = $newsId and tinhtrang = 1 and i_delete = 1";
		$result = $this->db->getList($select);
		return $result;
	}

	public function checkNewsId($newId)
	{
		$select = "SELECT * FROM tin_tuc WHERE maTT = $newId and tinhtrang = 1 and i_delete = 1";
		$result = $this->db->getInstance($select);
		return $result;
	}
}
