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
if (!empty($_POST['category']) && $_POST['category'] != 'all') {
	$ac = 1;
} else if (!empty($_GET['category']) && $_GET['category'] != 'all') {
	$ac = 2;
} else if (!empty($_POST['searchByName']) && $_POST['searchByName'] != '') {
	$ac = 3;
} else if (!empty($_GET['searchByName']) && $_GET['searchByName'] != '') {
	$ac = 4;
} else if (!empty($_POST['searchById']) && $_POST['searchById'] != '') {
	$ac = 5;
} else if (!empty($_GET['searchById']) && $_GET['searchById'] != '') {
	$ac = 6;
} else if (!empty($_POST['productStatus']) && $_POST['productStatus'] != 1 || !empty($_GET['productStatus']) && $_GET['productStatus'] != 1) {
	$ac = 7;
} else if (!empty($_POST['productStatus']) && $_POST['productStatus'] == 1 || !empty($_GET['productStatus']) && $_GET['productStatus'] == 1) {
	$ac = 8;
}

$admin = new admin();
?>
<table class="table">
	<thead>
		<tr>
			<th>##</th>
			<th style="width: 20%;">Ảnh sản phẩm</th>
			<th>Tên sản phẩm</th>
			<th>Loại sản phẩm</th>
			<th>Đơn giá</th>
			<th>Giảm giá</th>
			<th>Ngày hết giảm giá</th>
			<!-- <th>Màu sắc</th> -->
			<!-- <th>Kích thước</th> -->
			<th>Tồn kho</th>
			<th>Đã bán</th>
			<th>Đánh giá</th>
			<th>Yêu thích</th>
			<th>Lượt xem</th>
			<th>Bình luận</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		switch ($ac) {
			case 0:
				$productList = $admin->getAllProduct();
				break;
			case 1:
				$productList = $admin->getProductForCategory($_POST['category']);
				break;
			case 2:
				$productList = $admin->getProductForCategory($_GET['category']);
				break;
			case 3:
				$productList = $admin->getProductSearchByName(htmlspecialchars($_POST['searchByName'], ENT_QUOTES, 'UTF-8'));
				break;
			case 4:
				$productList = $admin->getProductSearchByName(htmlspecialchars($_GET['searchByName'], ENT_QUOTES, 'UTF-8'));
				break;
			case 5:
				$productList = $admin->getProductSearchById(htmlspecialchars($_POST['searchById'], ENT_QUOTES, 'UTF-8'));
				break;
			case 6:
				$productList = $admin->getProductSearchById(htmlspecialchars($_GET['searchById'], ENT_QUOTES, 'UTF-8'));
				break;
			case 7:
				$productList = $admin->getProductSearchByStatus(0);
				break;
			case 8:
				$productList = $admin->getProductSearchByStatus(1);
				break;
			default:
				$productList = $admin->getAllProduct();
				break;
		}
		$i = 1;
		while ($get = $productList->fetch()) {
		?>
			<tr>
				<td><?php echo $i++ . '-P' . $get['maSP'] ?></td>
				<td><a href="/index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img width="150px" src="../assets/images/product/<?php echo $get['anh'] ?>" alt=""></a></td>
				<td><?php echo $get['ten'] ?></td>
				<td><?php echo $get['tenloai'] ?></td>
				<td><?php echo number_format($get['dongia'], 0, ',', '.') . 'đ'; ?></td>
				<td><?php echo number_format($get['giamgia'], 0, ',', '.') . 'đ'; ?></td>
				<td><?php
						if ($get['giamgia'] > 0) {
							$date = new DateTime($get['thoigiangiamgia'], new DateTimeZone('Asia/Ho_Chi_Minh'));
							$dateFix = $date->format('d/m/Y');
							echo $dateFix;
						} else {
							echo 0;
						}
						?></td>
				<!-- <td><?php echo $get['mausac'] ?></td> -->
				<!-- <td><?php echo $get['kichthuoc'] ?></td> -->
				<td><?php echo $get['tonkho'] ?></td>
				<td><?php echo $get['daban'] ?></td>
				<td><?php echo $get['danhgia'] ?></td>
				<td><?php echo $get['yeuthich'] ?></td>
				<td><?php echo $get['luotxem'] ?></td>
				<td>
					<a href="index.php?action=admin-page&act=commentList&maSP=<?= $get['maSP'] ?>" class="btn btn-info">
						Xem <?php $comment = new admin();
								$qtyCommentByProductId = $comment->getQtyCommentByProductId($get['maSP']);
								echo $qtyCommentByProductId['soluong'] ?>
					</a>
				</td>
				<td style="font-size: 18px" class="col-lg-1 col-md-2 col-sm-3">
					<button type="button" class="btn btn-info col-lg-12 col-sm-12 col-md-12" data-toggle="modal" data-target="#modalViewProduct<?php echo $get['maSP'] ?>">Xem mô tả</button>
					<?php if ($role == 1 || $role == 3) {
						if ($get['trangthai'] == 1) { ?>
							<a href="javascript:adminDeleteProduct(
							<?= $get['maSP'] ?>,
							'<?php if (!empty($_POST['category']) && $_POST['category'] != 'all') {
									echo $_POST['category'];
								} else if (!empty($_GET['category']) && $_GET['category'] != 'all') {
									echo $_GET['category'];
								} ?>',
							'<?php if (!empty($_POST['searchByName']) && $_POST['searchByName'] != '') {
									echo $_POST['searchByName'];
								} else if (!empty($_GET['searchByName']) && $_GET['searchByName'] != '') {
									echo $_GET['searchByName'];
								} ?>',
							<?php if (!empty($_POST['productStatus']) && $_POST['productStatus'] != '') {
								echo $_POST['productStatus'];
							} else if (!empty($_GET['productStatus']) && $_GET['productStatus'] != '') {
								echo $_GET['productStatus'];
							} ?>)" class="btn btn-secondary col-lg-12 col-sm-12 col-md-12">
								Ẩn sản phẩm
							</a>
						<?php }
						if ($get['trangthai'] == 0) { ?>
							<a href="javascript:adminRestoreProduct(
							<?= $get['maSP'] ?>,
							'<?php if (!empty($_POST['category']) && $_POST['category'] != 'all') {
									echo $_POST['category'];
								} else if (!empty($_GET['category']) && $_GET['category'] != 'all') {
									echo $_GET['category'];
								} ?>',
							'<?php if (!empty($_POST['searchByName']) && $_POST['searchByName'] != '') {
									echo $_POST['searchByName'];
								} else if (!empty($_GET['searchByName']) && $_GET['searchByName'] != '') {
									echo $_GET['searchByName'];
								} ?>',
							<?php if (!empty($_POST['productStatus']) && $_POST['productStatus'] != '') {
								echo $_POST['productStatus'];
							} else if (!empty($_GET['productStatus']) && $_GET['productStatus'] != '') {
								echo $_GET['productStatus'];
							} ?>)" class="btn btn-primary col-lg-12 col-sm-12 col-md-12">
								Khôi phục
							</a>
						<?php }
					}
					if ($role == 1 || $role == 3 || $role == 5) { ?>
						<a href="index.php?action=admin-page&act=editProduct&maSP=<?php echo $get['maSP'] ?>" class="btn btn-warning col-lg-12 col-sm-12 col-md-12">Sửa sản phẩm</a>
					<?php }
					if ($role == 1) { ?>
						<a class="btn btn-danger col-lg-12 col-sm-12 col-md-12" href="javascript:adminDropProduct(
							<?= $get['maSP'] ?>,
							'<?php if (!empty($_POST['category']) && $_POST['category'] != 'all') {
									echo $_POST['category'];
								} else if (!empty($_GET['category']) && $_GET['category'] != 'all') {
									echo $_GET['category'];
								} ?>',
							'<?php if (!empty($_POST['searchByName']) && $_POST['searchByName'] != '') {
									echo $_POST['searchByName'];
								} else if (!empty($_GET['searchByName']) && $_GET['searchByName'] != '') {
									echo $_GET['searchByName'];
								} ?>',
							<?php if (!empty($_POST['productStatus']) && $_POST['productStatus'] != '') {
								echo $_POST['productStatus'];
							} else if (!empty($_GET['productStatus']) && $_GET['productStatus'] != '') {
								echo $_GET['productStatus'];
							} ?>)" title="Xóa">
							Xóa sản phẩm
						</a>
					<?php } ?>
				</td>
			</tr>
			<!-- Modal-->
			<div class="modal fade" id="modalViewProduct<?php echo $get['maSP'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Mô tả sản phẩm</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?= $get['mota'] ?>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal-->
		<?php } ?>
	</tbody>
</table>