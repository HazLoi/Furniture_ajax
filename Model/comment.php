<?php
class comment
{
	private $db = null;

	public function __construct()
	{
		$this->db = new connect();
	}

	public function insertComments($productId, $idCustomer, $fname, $lname, $email, $content, $rating, $image)
	{
		$arrayKeyCheck = ['cc', 'lz', 'điên', 'khùng', 'shit', 'cức', 'chó'];

		$fullname = trim($fname) . " " . trim($lname);
		$content = trim($content);

		$date = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
		$dateFix = $date->format('Y-m-d H:i:s');

		if ($rating > 5) {
			$rating = 5;
		} elseif ($rating < 0) {
			$rating = 1;
		}

		// Kiểm tra nếu $content chứa từ tục tiểu
		$invalidContent = false;
		foreach ($arrayKeyCheck as $key) {
			if (strpos($content, $key) !== false) {
				$invalidContent = true;
				break;
			}
		}

		if ($invalidContent) {
			$insert = "INSERT INTO binh_luan (maSP, maTG, tacgia, email, binhluan, ngay, danhgia, anh, trangthai)
		VALUES ($productId, $idCustomer, '$fullname', '$email', '$content', '$dateFix', $rating, '$image', 0)";

			$result = $this->db->exec($insert);

			$insertNotify = "INSERT INTO thongbao (id, tacgia, noidung, ngay, anh, ketqua, timkiem) VALUES ('$idCustomer', '$fullname','Bình luận tiêu cực','$dateFix', '$image', '$result', 'Bình luận của sản phẩm có mã: $productId')";

			$this->db->exec($insertNotify);

			$selectIdNewNotify = "SELECT maTB FROM thongbao ORDER BY maTB DESC limit 1";
			$idNewNotify = $this->db->getInstance($selectIdNewNotify)['maTB'];

			$updateNotify = "UPDATE thongbao SET caulenh = \"$insert\" WHERE maTB = $idNewNotify";

			$this->db->exec($updateNotify);

			if ($result) {
				echo json_encode(array(
					'status' => 2,
					'message' => 'Phát hiện thấy ngôn từ tiêu cực'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Đã có lỗi xãy ra'
				));
			}			
		} else {
			$insert = "INSERT INTO binh_luan (maSP, maTG, tacgia, email, binhluan, ngay, danhgia, anh)
		VALUES ($productId, $idCustomer, '$fullname', '$email', '$content', '$dateFix', $rating, '$image')";

			$result = $this->db->exec($insert);

			if ($result) {
				echo json_encode(array(
					'status' => 1,
					'message' => 'Gửi thành công'
				));
			} else {
				echo json_encode(array(
					'status' => 0,
					'message' => 'Đã có lỗi xãy ra'
				));
			}
			
		}
	}

	public function getCommentByProductId($productId)
	{
		$select = "SELECT * FROM binh_luan WHERE maSP = $productId and i_delete = 1 ORDER BY maBL DESC";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getCommentByProductIdOnePage($productId, $start, $limit)
	{
		$select = "SELECT * FROM binh_luan WHERE maSP = $productId and i_delete = 1 ORDER BY maBL DESC limit $start, $limit";

		$result = $this->db->getList($select);
		return $result;
	}

	public function getQtyCommentByProductId($productId)
	{
		$select = "SELECT count(*) as 'soluong' FROM binh_luan WHERE maSP = $productId and i_delete = 1 and trangthai = 1";

		$result = $this->db->getInstance($select);
		return $result;
	}
}
