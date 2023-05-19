<?php
include 'a-dhAjax.php';

if (empty($_SESSION['productCart'])) {
	$_SESSION['productCart'] = array();
}

if (isset($_GET['act'])) {
	if ($_GET['act'] == "addToCart") {
		if (isset($_POST['maSP'])) {
			$maSP = $_POST['maSP'];
			$mausac = $_POST['mausac'];
			$kichthuoc = $_POST['kichthuoc'];
			$soluong = $_POST['soluong'];
			$sp = new productCart();
			$sp->addToCart($maSP, $mausac, $kichthuoc, $soluong);
		}
	}

	if ($_GET['act'] == "deleteProduct") {
		if (isset($_POST['index'])) {
			$sp = new productCart();
			$sp->deleteProduct($_POST['index']);
			echo json_encode(array(
				'status' => 1,
				'count' => count($_SESSION['productCart']),
			));
		} else {
			echo json_encode(array(
				'status' => 0,
			));
		}
	}

	if ($_GET['act'] == "updateProduct") {
		$quantityNew = intval($_POST['soluong']);
		$productId = $_POST['maSP'];
		$index = $_POST['vitri'];
		//kiểm tra sản phẩm tồn kho
		$sp = new product();
		$checkTonKho = $sp->checkInStock($productId);
		//lấy thông tin sản phẩm
		$db = new connect();
		$select = "SELECT * FROM sanpham WHERE maSP = $productId";
		$result = $db->getInstance($select);
		$instock = $result['tonkho'];
		$productName = $result['ten'];
		//bắt đầu thực hiện thay đổi số lượng và tổng tiền trong giỏ hàng
		if ($quantityNew > 0) {
			if ($quantityNew > $checkTonKho) {
				echo json_encode(array(
					'status' => 0,
					'message' => "$productName chi còn $instock sản phẩm"
				));
			} else {
				$sp = new productCart();
				$udpateProduct = $sp->updateProduct($quantityNew, $index, $productId);
				if ($udpateProduct == 1) {
					echo json_encode(array(
						'status' => 1,
						'message' => "Cập nhật sản phẩm thành công"
					));
				} else {
					echo json_encode(array(
						'status' => 0,
						'message' => "Đã có lỗi xãy ra"
					));
				}
			}
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => "Số lượng nhập không hợp lệ"
			));
		}
	}

	if ($_GET['act'] == "deleteAllProductCart") {
		if (isset($_SESSION['productCart']) && count($_SESSION['productCart']) > 0) {
			$sp = new productCart();
			$sp->deleteProductCart();
			echo json_encode(array(
				'status' => 1,
				'message' => "Xóa giỏ hàng thành công",
				'count' => count($_SESSION['productCart']),
			));
		} else {
			echo json_encode(array(
				'status' => 0,
				'message' => "Không có sản phẩm nào trong giỏ hàng",
				'count' => count($_SESSION['productCart']),
			));
		}
	}
}
