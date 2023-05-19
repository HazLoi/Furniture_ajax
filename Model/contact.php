<?php
class contact
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function getAllContact()
	{
		$select = "SELECT * FROM lienhe";

		$result = $this->db->getList($select);

		return $result;
	}

	public function insertContact($fullname, $email, $subject, $content)
	{
		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		if(isset($_SESSION['image']) && $_SESSION['image'] != ''){
			$insert = "INSERT INTO lienhe (tacgia, email, chude, noidung, ngaygui, anh) VALUES ('$fullname', '$email', '$subject', '$content', '$dateFix', '{$_SESSION['image']}')";
		}else{
			$insert = "INSERT INTO lienhe (tacgia, email, chude, noidung, ngaygui) VALUES ('$fullname', '$email', '$subject', '$content', '$dateFix')";
		}
			
		$result = $this->db->exec($insert);

		return $result;
	}
}
