<?php
class services
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getServiceLimit($limit)
	{
		$select = "SELECT * FROM dich_vu WHERE trangthai = 1 limit $limit";

		$result = $this->db->getList($select);

		return $result;
	}
}
