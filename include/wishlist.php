<?php
if (empty($_GET['action'])) {
	session_start();
}
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

?>
<table class="table table-striped" style="font-size: 18px">
	<tr>
		<td>Tên sản phẩm</td>
		<td>Ảnh</td>
		<td>Trạng thái</td>
		<td>Đơn giá</td>
		<td></td>
	</tr>
	<?php
	$user = new user();
	$result = $user->getWishlist($_SESSION['id']);
	while ($get = $result->fetch()) {
	?>
		<tr>
			<th><?php echo $get['ten'] ?></th>
			<th>
				<a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>">
					<img style="width: 150px" src="assets/images/product/<?php echo $get['anh'] ?>" alt="" />
				</a>
			</th>
			<th><?php echo ($get['tonkho'] > 0) ? '<b class="text-success">Còn hàng<b>' : '<b class="text-danger">Hết hàng<b>' ?></th>
			<th>$<?php echo $get['dongia'] ?></th>
			<th>
				<a href="javascript:deleteWishlist(<?= $get['maYT'] ?>, <?= $_SESSION['id'] ?>)" class="btn btn-danger"><i class="fa fa-trash-alt"></i></a>
			</th>
		</tr>
	<?php } ?>
</table>