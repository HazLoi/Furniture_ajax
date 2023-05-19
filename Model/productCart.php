<?php

class productCart
{
	public function addToCart($maSP, $mausac, $kichthuoc, $soluong)
	{
		$sp = new product();

		$result = $sp->checkProductId($maSP);

		$ten = $result['ten'];
		$anh = $result['anh'];
		$tonkho = $result['tonkho'];
		$daban = $result['daban'];
		$yeuthich = $result['yeuthich'];
		$danhgia = $result['danhgia'];
		if ($result['giamgia'] > 0) {
			$dongia = $result['giamgia'];
		} else {
			$dongia = $result['dongia'];
		}
		$loai = $result['loai'];
		$thanhtien = $dongia * $soluong;
		$kiemtra = 0;

		if (isset($_SESSION['productCart']) && count($_SESSION['productCart']) > 0) {
			foreach ($_SESSION['productCart'] as $key => $item) {
				if ($maSP == $item['maSP'] && $mausac == $item['mausac'] && $kichthuoc == $item['kichthuoc']) {
					$kiemtra = 1;
					$sp = new product();
					if (($_SESSION['productCart'][$key]['soluong'] + $soluong) <= $tonkho) {
						$_SESSION['productCart'][$key]['soluong'] += $soluong;
						$_SESSION['productCart'][$key]['thanhtien'] = $_SESSION['productCart'][$key]['soluong'] * $_SESSION['productCart'][$key]['dongia'];
						echo json_encode(array(
							'status' => 1,
							'message' => 'Thêm sản phẩm thành công',
							'count' => count($_SESSION['productCart'])
						));
						exit;
					} else {
						echo json_encode(array(
							'status' => 0,
							'message' => "$ten chỉ còn $tonkho sản phẩm"
						));
						exit;
					}
				}
			}
		}

		if ($kiemtra == 0) {
			if ($soluong <= 0) {
				echo json_encode(array(
					'status' => 0,
					'message' => "số lượng không hợp lệ"
				));
				exit;
			} else {
				if ($tonkho > 0) {
					if ($soluong <= $tonkho) {
						$item = array(
							'maSP' => $maSP,
							'ten' => $ten,
							'anh' => $anh,
							'loai' => $loai,
							'dongia' => $dongia,
							'soluong' => $soluong,
							'mausac' => $mausac,
							'kichthuoc' => $kichthuoc,
							'thanhtien' => $thanhtien
						);
						$_SESSION['productCart'][] = $item;
						echo json_encode(array(
							'status' => 1,
							'message' => 'Thêm sản phẩm thành công',
							'count' => count($_SESSION['productCart'])
						));
						exit;
					} else {
						echo json_encode(array(
							'status' => 0,
							'message' => "$ten chỉ còn $tonkho sản phẩm",
						));
						exit;
					}
				} else {
					echo json_encode(array(
						'status' => 0,
						'message' => "$ten đã hết hàng",
					));
					exit;
				}
			}
		}
	}

	public function tongTien()
	{
		$tongtien = 0;
		if (isset($_SESSION['productCart'])) {
			foreach ($_SESSION['productCart'] as $item) {
				$tongtien += $item['thanhtien'];
			}
		}

		return $tongtien;
	}

	public function updateProduct($soluongmoi, $vitri, $maSP)
	{
		if ($soluongmoi <= 0) {
			$this->deleteProduct($vitri);
		} else {
			$sp = new product();
			$checkTonKho = $sp->checkInStock($maSP);
			$name = $_SESSION['productCart'][$vitri]['ten'];
			if ($soluongmoi <= $checkTonKho) {
				$_SESSION['productCart'][$vitri]['soluong'] = $soluongmoi;
				$newTotal = $_SESSION['productCart'][$vitri]['soluong'] * $_SESSION['productCart'][$vitri]['dongia'];
				$_SESSION['productCart'][$vitri]['thanhtien'] = $newTotal;
				return 1;
			} else {
				return 0;
			}
		}
	}

	public function deleteProduct($vitri)
	{
		array_splice($_SESSION['productCart'], $vitri, 1);
	}

	public function deleteProductCart()
	{
		array_splice($_SESSION['productCart'], 0, count($_SESSION['productCart']));
	}
}
