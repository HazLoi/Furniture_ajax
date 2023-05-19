<?php
if (empty($_GET['act'])) {
	session_start();
}

set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
$admin = new admin();
$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
?>
<table class="table table-borderless">
	<thead>
		<tr>
			<th>##</th>
			<th>Tên loại</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$admin = new admin();
		$categoryList = $admin->getAllCategory();
		$i = 1;
		while ($get = $categoryList->fetch()) {
		?>
			<tr>
				<td><?php echo $i++.'-C'.$get['maLoai'] ?></td>
				<td><?php echo $get['tenloai'] ?></td>
				<td class="col-lg-1 col-md-2 col-sm-3">
					<?php if ($role == 1 || $role == 3) {
						if ($get['trangthai'] == 1) { ?>
							<a href="javascript:adminDeleteCategory(<?= $get['maLoai'] ?>)" class="btn btn-secondary col-lg-12 col-md-12 col-sm-12">Ẩn loại sản phẩm</a>
						<?php } else { ?>
							<a href="javascript:adminRestoreCategory(<?= $get['maLoai'] ?>)" class="btn btn-primary col-lg-12 col-md-12 col-sm-12">Khôi phục</a>
					<?php
						}
					} ?>

					<?php if ($role == 1 || $role == 3 || $role == 5) { ?>
						<a href="index.php?action=admin-page&act=categories&get=edit&id=<?= $get['maLoai'] ?>" class="btn btn-info col-lg-12 col-md-12 col-sm-12">Sửa loại sản phẩm</a>
					<?php } ?>

					<?php if ($role == 1) { ?>
						<a href="javascript:adminDropCategory(<?= $get['maLoai'] ?>)" class="btn btn-danger col-lg-12 col-md-12 col-sm-12">Xóa loại sản phẩm</a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>