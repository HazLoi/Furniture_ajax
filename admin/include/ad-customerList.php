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
if (isset($_POST['searchByEmail']) && $_POST['searchByEmail'] != '') {
	$ac = 1;
} else if (isset($_GET['searchByEmail']) && $_GET['searchByEmail'] != '') {
	$ac = 2;
} else if (isset($_POST['searchById']) && $_POST['searchById'] != '') {
	$ac = 3;
} else if (isset($_GET['searchById']) && $_GET['searchById'] != '') {
	$ac = 4;
}
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>##</th>
			<th>Ảnh</th>
			<th>Họ và tên</th>
			<th>Email</th>
			<th>Số điện thoại</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$admin = new admin();
		switch ($ac) {
			case 0:
				$customerList = $admin->getAllCustomer();
				break;
			case 1:
				$customerList = $admin->getCustomerByEmail(htmlspecialchars($_POST['searchByEmail'], ENT_QUOTES, 'UTF-8'));
				break;
			case 2:
				$customerList = $admin->getCustomerByEmail(htmlspecialchars($_GET['searchByEmail'], ENT_QUOTES, 'UTF-8'));
				break;
			case 3:
				$customerList = $admin->getCustomerById(htmlspecialchars($_POST['searchById'], ENT_QUOTES, 'UTF-8'));
				break;
			case 4:
				$customerList = $admin->getCustomerById(htmlspecialchars($_GET['searchById'], ENT_QUOTES, 'UTF-8'));
				break;
		}
		$i = 1;
		while ($get = $customerList->fetch()) {
		?>
			<tr>
				<td><?php echo $i++.'-C'.$get['id'] ?></td>
				<td>
				<?php
					if (!empty($get['anh'])) {
						if (strpos($get['anh'], 'https') !== false) { ?>
							<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
							<?php } else {
							if (isset($get['anh']) && $get['anh'] != '') { ?>
								<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('../assets/images/imageAccount/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
							<?php } else { ?>
								<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
						<?php }
						}
					} else { ?>
						<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
					<?php }
					?>
				</td>
				<td><?php echo $get['hovaten'] ?></td>
				<td><?php echo $get['email'] ?></td>
				<td><?php echo $get['sdt'] ?></td>
				<td style="font-size: 18px" class="col-lg-1 col-md-2 col-sm-3">
					<?php if ($role == 1 || $role == 3) { ?>
						<?php if ($get['trangthai'] == 1) { ?>
							<a href="javascript:adminDeleteCustomer(
								<?= $get['id'] ?>,
							'<?php if (isset($_POST['searchByEmail']) && $_POST['searchByEmail'] != '') {
									echo $_POST['searchByEmail'];
								} else if (isset($_GET['searchByEmail']) && $_GET['searchByEmail'] != '') {
									echo $_GET['searchByEmail'];
								} ?>')" class="btn btn-secondary col-lg-12 col-md-12 col-sm-12">
								Ẩn tài khoản	
							</a>
						<?php }
						if ($get['trangthai'] == 0) { ?>
							<a href="javascript:adminRestoreCustomer(
								<?= $get['id'] ?>,
							'<?php if (isset($_POST['searchByEmail']) && $_POST['searchByEmail'] != '') {
									echo $_POST['searchByEmail'];
								} else if (isset($_GET['searchByEmail']) && $_GET['searchByEmail'] != '') {
									echo $_GET['searchByEmail'];
								} ?>')" class="btn btn-info col-lg-12 col-md-12 col-sm-12">
								Khôi phục	
							</a>
						<?php } ?>

						<a href="index.php?action=admin-page&act=editCustomer&id=<?php echo $get['id'] ?>" class="btn btn-warning col-lg-12 col-md-12 col-sm-12">Sửa tài khoản</a>

						<a class="btn btn-danger col-lg-12 col-md-12 col-sm-12" href="javascript:adminDropCustomer(
							<?= $get['id'] ?>,
						'<?php if (isset($_POST['searchByEmail']) && $_POST['searchByEmail'] != '') {
								echo $_POST['searchByEmail'];
							} else if (isset($_GET['searchByEmail']) && $_GET['searchByEmail'] != '') {
								echo $_GET['searchByEmail'];
							} ?>')">
								Xóa tài khoản
							</a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>