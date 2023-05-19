<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
?>
<table class="table table-striped" style="font-size: 18px;">
	<thead>
		<tr>
			<th>##</th>
			<th>Ảnh</th>
			<th>Tên sản phẩm</th>
			<th>Số lượng</th>
			<th>Đơn giá</th>
			<th>Thành tiền</th>
			<th></th>
		</tr>
	</thead>
	<tbody style="overflow-y: auto; max-height: 500px;">
		<?php
		$invoice = new invoice();
		if (isset($_POST['id']) && $_POST['id'] != '') {
			$result = $invoice->getProductInvoiceById($_POST['id']);
		} else if (isset($_GET['id']) && $_GET['id']) {
			$result = $invoice->getProductInvoiceById($_GET['id']);
		}
		$i = 1;
		while ($get = $result->fetch()) {
		?>
			<tr>
				<th><?= $i++ ?></th>
				<th><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img width="150px" src="assets/images/product/<?php echo $get['anh'] ?>" alt=""></a></th>
				<th><?= $get['tenSP'] ?></th>
				<th><?= $get['soluongmua'] ?></th>
				<th><?= number_format($get['dongia'], 0, ',', '.') . 'đ'; ?></th>
				<th><?= number_format($get['thanhtien'], 0, ',', '.') . 'đ'; ?></th>
				<th>
					<?php if ($get['tinhtrang'] == 5 || $get['trahang'] == 2) { ?>
						<span class="text-danger">Trả hàng</span>
					<?php } else if ($get['tinhtrang'] == 6) { ?>
						<a href="index.php?action=returnProduct&maHD=<?= $_POST['id'] ?>&id=<?= $get['maSP'] ?>" class="btn btn-danger" title="Trả hàng"><i class="fa fa-reply"></i></a>
					<?php } ?>
				</th>
			</tr>
		<?php } ?>
	</tbody>

</table>