<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$conn = new connect();

if (isset($_GET['maHD'])) {
	$select = "SELECT b.*, a.ngay, a.tongtien, a.tinhtrang, c.ten, d.trahang
	FROM hoa_don as a, thanh_toan as b, tt_hoadon as c, ct_hoadon as d
	WHERE d.maHD = a.maHD and d.maHD = b.maHD and a.id = b.id and b.maHD = a.maHD and b.maHD = {$_GET['maHD']} and c.maTTHD = a.tinhtrang and a.i_delete = 1";
} else if (isset($_POST['maHD'])) {
	$select = "SELECT b.*, a.ngay, a.tongtien, a.tinhtrang, c.ten, d.trahang
	FROM hoa_don as a, thanh_toan as b, tt_hoadon as c, ct_hoadon as d
	WHERE d.maHD = a.maHD and d.maHD = b.maHD and a.id = b.id and b.maHD = a.maHD and b.maHD = {$_POST['maHD']} and c.maTTHD = a.tinhtrang and a.i_delete = 1";
}


$result = $conn->getInstance($select);

$maHD = $result['maHD'];
$hovaten = $result['tenKH'];
$tinhtrang = $result['tinhtrang'];
$tongtien = $result['tongtien'];
$sdt = $result['sdt'];
$email = $result['email'];
$ngay = $result['ngay'];
$tentinhtrang = $result['ten'];
$congty = $result['congty'];
$diachi1 = $result['diachi1'];
$diachi2 = $result['diachi2'];
$ghichu = $result['ghichu'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<style>
	* {
		box-sizing: border-box;
		margin: 0;
		padding: 0;
	}

	.header {
		background-color: #094d9c;
		color: white;
		display: flex;
		align-items: center;
		padding: 10px;
		justify-content: space-around;
	}

	.bg-title {
		background-color: #DEEEF6;
		padding: 10px 0px;
	}

	.body {
		padding: 10px;

	}

	table {
		border-collapse: collapse;
		width: 100%;
	}

	th,
	td {
		border: 1px solid black;
		padding: 8px;
	}

	th {
		background-color: #f2f2f2;
	}
</style>

<body class="container">

	<div class="header">
		<img src="../assets/images/logo-mobie.png" alt="logo_furnitica">
	</div>

	<div class="bg-light body">
		<h2><u>Thông tin cửa hàng</u></h2>
		<p><strong>Trang web:</strong> furniture.vn</p>
		<p><strong>Số điện thoại:</strong> 0987654321</p>
		<p><strong>Email:</strong> furniture@gmail.com</p>
		<hr style="margin: 0; padding: 0">
	</div>

	<div class="bg-light body">
		<h2><u>Thông tin khách hàng</u></h2>
		<p><strong>Mã hóa đơn:</strong> INV-<?= $maHD ?></p>
		<p><strong>Ngày đặt hàng:</strong> <?php
														$date = new DateTime($ngay, new DateTimeZone('Asia/Ho_Chi_Minh'));
														$dateFix = $date->format('d/m/Y');
														echo $dateFix;
														?>
		</p>
		<p><strong>Tên khách hàng:</strong> <?= $hovaten ?></p>
		<p><strong>Email:</strong> <?= $email ?></p>
		<p><strong>Số điện thoại:</strong> <?= $sdt ?></p>
		<p><strong>Địa chỉ:</strong> <?= $diachi1 ?></p>

		<?php if (isset($congty) && $congty != '') { ?>
			<p><strong>Công ty: <?= $congty ?></strong></p>
		<?php } ?>
		<hr style="margin: 0px 0px 5px 0px; padding: 0">
	</div>

	<div class="bg-light">
		<table>
			<tr>
				<td>STT</td>
				<td>Tên sản phẩm</td>
				<td>Số lượng</td>
				<td>Đơn giá</td>
				<td>Thành tiền</td>
			</tr>
			<?php
			if (isset($_GET['maHD'])) {
				$select1 = "SELECT c.maSP, c.tenSP, c.soluongmua, c.thanhtien, d.anh, c.trangthai, d.giamgia, c.dongia, c.trahang, e.tinhtrang
					FROM ct_hoadon as c, sanpham as d, hoa_don as e
					WHERE c.maSP = d.maSP and c.maHD = {$_GET['maHD']} and e.maHD = c.maHD and e.i_delete = 1 ";
			} else if (isset($_POST['maHD'])) {
				$select1 = "SELECT c.maSP, c.tenSP, c.soluongmua, c.thanhtien, d.anh, c.trangthai, d.giamgia, c.dongia, c.trahang, e.tinhtrang
					FROM ct_hoadon as c, sanpham as d, hoa_don as e
					WHERE c.maSP = d.maSP and c.maHD = {$_POST['maHD']} and e.maHD = c.maHD and e.i_delete = 1 ";
			}

			$result1 = $conn->getList($select1);
			$soluong = 0;
			$thanhtien = 0;
			$i = 1;
			while ($set = $result1->fetch()) :
				$soluong += $set['soluongmua'];
				$thanhtien += $set['thanhtien'];
			?>
				<tr>
					<td>
						<?php echo $i++ ?>
					</td>
					<td><?php echo $set['tenSP'] ?></td>
					<td>
						<?php echo $set['soluongmua'] ?>
					</td>
					<td>
						<?php echo number_format($set['dongia'], 0, ',', '.') . 'đ'; ?>
					</td>
					<td><?php echo number_format($set['thanhtien'], 0, ',', '.') . 'đ'; ?></td>
				</tr>
			<?php endwhile; ?>
			<tr>
				<td>Tổng</td>
				<td></td>
				<td><?= $soluong ?></td>
				<td></td>
				<td><?= number_format($thanhtien, 0, ',', '.') . 'đ'; ?></td>
			</tr>
		</table>
	</div>

	<form class="d-flex justify-content-end m-1" action="View/printPDFInvoice.php" method="post">
		<input type="hidden" name="maHD" value="<?= $maHD ?>">
		<object data="printPDFInvoice.pdf" type="application/pdf">
			<button class="btn btn-success" title="Xuất file PDF"><i class="fa fa-download"></i></button>
		</object>
	</form>

</body>

</html>