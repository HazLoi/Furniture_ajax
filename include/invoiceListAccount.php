<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

if (empty($_GET['action'])) {
	session_start();
}

$ac = 0;
if (!empty($_POST['status']) && $_POST['status'] != '') {
	$ac = 1;
} else if (!empty($_GET['status']) && $_GET['status'] != '') {
	$ac = 2;
}
?>
<table class="table table-striped" style="font-size: 18px;">
	<thead>
		<tr>
			<th>Mã INV</th>
			<th>Ngày</th>
			<th>Tổng tiền</th>
			<th>Tình trạng</th>
			<th></th>
		</tr>
	</thead>
	
	<?php
	$user = new user();
	if ($ac == 0) {
		$result = $user->getInvoiceByCustomerId($_SESSION['id']);
	} else if ($ac == 1) {
		$result = $user->getStatusInvoiceAccount($_SESSION['id'], $_POST['status']);
	} else if ($ac == 2) {
		$result = $user->getStatusInvoiceAccount($_SESSION['id'], $_GET['status']);
	}
	while ($get = $result->fetch()) {
	?>
		<tr>
			<th><?php echo $get['maHD'] ?></th>
			<th><?php $date = new DateTime($get['ngay']);
					$dateFix = $date->format('d/m/Y');
					echo $dateFix ?></th>
			<th><?php echo number_format($get['tongtien'], 0, ',', '.') . 'đ'; ?></th>
			<?php
			switch ($get['tinhtrang']) {
				case 1:
					echo '<th class="text-dark">Đang xử lý</th>';
					break;
				case 2:
					echo '<th class="text-warning">Đang vận chuyển</th>';
					break;
				case 3:
					echo '<th class="text-success">Đã thanh toán</th>';
					break;
				case 4:
					echo '<th class="text-danger">Đã hủy đơn</th>';
					break;
				case 5:
					echo '<th class="text-danger">Trả đơn hàng</th>';
					break;
				case 6:
					echo '<th class="text-info">Đã nhận hàng</th>';
					break;
			}
			?>
			<th class="d-flex">
				<a href="index.php?printPDF=printPDFInvoice&maHD=<?php echo $get['maHD'] ?>" class="btn btn-info" target="_blank">Xem PDF</a>

				<a href="javascript:viewInvoiceDetail(<?= $get['maHD'] ?>,<?php if (isset($_POST['status']) && $_POST['status'] != '') {
																									echo $_POST['status'];
																								} else if (isset($_GET['status']) && $_GET['status'] != '') {
																									echo $_GET['status'];
																								} ?>)" class="btn btn-info" title="Xem hóa đơn"><i class="fa fa-eye"></i></a>
				<?php if ($get['tinhtrang'] == 1) { ?>
					<a href="javascript:deleteInvoice(<?= $get['maHD'] ?>,<?php if (isset($_POST['status']) && $_POST['status'] != '') {
																								echo $_POST['status'];
																							} else if (isset($_GET['status']) && $_GET['status'] != '') {
																								echo $_GET['status'];
																							} ?>)" class="btn btn-danger" title="Hủy đơn hàng"><i class="fa fa-trash"></i></a>
				<?php }
				if ($get['tinhtrang'] == 6) { ?>
					<a href="javascript:checkInvoice(<?= $get['maHD'] ?>,<?php if (isset($_POST['status']) && $_POST['status'] != '') {
																								echo $_POST['status'];
																							} else if (isset($_GET['status']) && $_GET['status'] != '') {
																								echo $_GET['status'];
																							} ?>)" class="btn btn-success" title="Đã thanh toán"><i class="fa fa-check"></i></a>
				<?php } ?>
			</th>
		</tr>
	<?php } ?>
</table>