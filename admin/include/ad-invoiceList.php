<?php
if (empty($_GET['act'])) {
	session_start();
}

set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$admin = new admin();
$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];

$ac = 0;
if (isset($_POST['maTTHD']) && $_POST['maTTHD'] != 'all') {
	$ac = 1;
} else if (isset($_GET['maTTHD']) && $_GET['maTTHD'] != 'all') {
	$ac = 2;
} else if (isset($_POST['searchByCustomerName']) && $_POST['searchByCustomerName'] != '') {
	$ac = 3;
} else if (isset($_GET['searchByCustomerName']) && $_GET['searchByCustomerName'] != '') {
	$ac = 4;
} else if (isset($_POST['searchById']) && $_POST['searchById'] != '') {
	$ac = 5;
} else if (isset($_GET['searchById']) && $_GET['searchById'] != '') {
	$ac = 6;
}
?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>##</th>
			<!-- <th>Mã khách hàng</th> -->
			<th>Tên khách hàng</th>
			<th>Ảnh</th>
			<th>Ngày</th>
			<th>Tổng tiền</th>
			<th>Tình trạng</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$admin = new admin();
		switch ($ac) {
			case 0:
				$invoiceList = $admin->getAllInvoice();
				break;
			case 1:
				$invoiceList = $admin->getStatusInvoiceList($_POST['maTTHD']);
				break;
			case 2:
				$invoiceList = $admin->getStatusInvoiceList($_GET['maTTHD']);
				break;
			case 3:
				$invoiceList = $admin->getInvoiceByCustomerName(htmlspecialchars($_POST['searchByCustomerName'], ENT_QUOTES, 'UTF-8'));
				break;
			case 4:
				$invoiceList = $admin->getInvoiceByCustomerName(htmlspecialchars($_GET['searchByCustomerName'], ENT_QUOTES, 'UTF-8'));
				break;
			case 5:
				$invoiceList = $admin->getInvoiceByInvoiceId(htmlspecialchars($_POST['searchById'], ENT_QUOTES, 'UTF-8'));
				break;
			case 6:
				$invoiceList = $admin->getInvoiceByInvoiceId(htmlspecialchars($_GET['searchById'], ENT_QUOTES, 'UTF-8'));
				break;
		}
		$i = 1;
		while ($get = $invoiceList->fetch()) {
		?>
			<tr>
				<td><?php echo $i++.'-I'.$get['maHD'] ?></td>
				<!-- <td><?php echo $get['id'] ?></td> -->
				<td><?php echo $get['hovaten'] ?></td>
				<td>
					<?php if (isset($get['anh']) && $get['anh'] != '') { ?>
						<div style="width: 100px; height: 100px; background-image: url('../assets/images/imageAccount/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
					<?php } else { ?>
						<div style="width: 100px; height: 100px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
					<?php } ?>
				</td>
				<td><?php $date = new DateTime($get['ngay']);
						$dateFix = $date->format('d/m/Y');
						echo $dateFix;  ?></td>
				<td><?php echo number_format($get['tongtien'], 0, ',', '.') . 'đ'; ?></td>
				<td>
					<?php
					switch ($get['tinhtrang']) {
						case 1:
							echo '<span class="btn btn-dark">Đang xử lý</span>';
							break;
						case 2:
							echo '<span class="btn btn-warning">Đang vận chuyển</span>';
							break;
						case 3:
							echo '<span class="btn btn-success">Đã thanh toán</span>';
							break;
						case 4:
							echo '<span class="btn btn-danger">Đã hủy đơn</span>';
							break;
						case 5:
							echo '<span class="btn btn-danger">Trả đơn hàng</span>';
							break;
						case 6:
							echo '<span class="btn btn-info">Đã nhận hàng</span>';
							break;
					}
					?>
				</td>
				<td style="font-size: 18px" class="col-lg-1 col-md-2 col-sm-3">
					<?php if ($role == 1 || $role == 3) { ?>
						<?php if ($get['trangthai'] == 1) { ?>
							<a href="javascript:adminDeleteInvoice(<?= $get['maHD'] ?>,
							'<?php if (isset($_POST['searchByCustomerName']) && $_POST['searchByCustomerName'] != '') {
									echo $_POST['searchByCustomerName'];
								} else if (isset($_GET['searchByCustomerName']) && $_GET['searchByCustomerName'] != '') {
									echo $_GET['searchByCustomerName'];
								} ?>',
							<?php if (!empty($_POST['maTTHD']) && $_POST['maTTHD'] != 'all') {
								echo $_POST['maTTHD'];
							} else if (!empty($_GET['maTTHD']) && $_GET['maTTHD'] != 'all') {
								echo $_GET['maTTHD'];
							} ?>)" class="btn btn-secondary col-lg-12 col-md-12 col-sm-12">
								Ẩn hóa đơn
							</a>
						<?php }
						if ($get['trangthai'] == 0) { ?>
							<a href="javascript:adminRestoreInvoice(
								<?= $get['maHD'] ?>,
							'<?php if (isset($_POST['searchByCustomerName']) && $_POST['searchByCustomerName'] != '') {
									echo $_POST['searchByCustomerName'];
								} else if (isset($_GET['searchByCustomerName']) && $_GET['searchByCustomerName'] != '') {
									echo $_GET['searchByCustomerName'];
								} ?>',
							<?php if (!empty($_POST['maTTHD']) && $_POST['maTTHD'] != 'all') {
								echo $_POST['maTTHD'];
							} else if (!empty($_GET['maTTHD']) && $_GET['maTTHD'] != 'all') {
								echo $_GET['maTTHD'];
							} ?>)" class="btn btn-info col-lg-12 col-md-12 col-sm-12">
								Khôi phục
							</a>

						<?php } ?>

						<form action="index.php?action=admin-page&act=editInvoice" method="post">
							<input type="hidden" name="maHD" value="<?php echo $get['maHD'] ?>">
							<button class="btn btn-warning col-lg-12 col-md-12 col-sm-12">Sửa hóa đơn</button>
						</form>

					<?php }
					if ($role == 1) { ?>
						<a class="btn btn-danger col-lg-12 col-md-12 col-sm-12" href="javascript:adminDropInvoice(
							<?= $get['maHD'] ?>,
							'<?php if (isset($_POST['searchByCustomerName']) && $_POST['searchByCustomerName'] != '') {
									echo $_POST['searchByCustomerName'];
								} else if (isset($_GET['searchByCustomerName']) && $_GET['searchByCustomerName'] != '') {
									echo $_GET['searchByCustomerName'];
								} ?>',
							<?php if (!empty($_POST['maTTHD']) && $_POST['maTTHD'] != 'all') {
								echo $_POST['maTTHD'];
							} else if (!empty($_GET['maTTHD']) && $_GET['maTTHD'] != 'all') {
								echo $_GET['maTTHD'];
							} ?>)">Xóa hóa đơn</a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>