<div class="container-fluid">
	<?php
	$admin = new admin();
	$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
	if ($role == 1) { ?>
		<button id="exportAdmin" class="btn btn-success">Xuất dữ liệu ra file excel</button>
		<!-- <a href="index.php?export=admin" class="btn btn-success">Xuất dữ liệu ra file excel</a> -->
	<?php } ?>
	<hr class="sidebar-divider d-md-block">
	<form class="m-auto" action="index.php?action=admin-page&act=importAdmin" method="post" enctype="multipart/form-data">
		<input class="" type="file" name="fileImport">
		<button class="btn btn-primary">Thêm tài khoản</button>
	</form>
	<hr class="sidebar-divider d-md-block">
	<div class="d-flex">
		<button class="btn btn-primary mr-1" id="searchEmail">Tìm theo email</button>
		<button class="btn btn-primary mr-1" id="searchId">Tìm theo mã</button>
	</div>

	<form class="d-none form-inline navbar-search my-2 searchAdminByEmail" id="f1" method="post">
		<div class="input-group">
			<input name="searchByEmail" type="search" class="form-control bg-light border-1 inpSearchAdminByEmail" placeholder="Nhập email tài khoản" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<form class="d-none form-inline navbar-search my-2 searchAdminById" id="f2" method="post">
		<div class="input-group">
			<input name="searchById" type="search" class="form-control bg-light border-1 inpSearchAdminById" placeholder="Nhập mã tài khoản" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>


	<hr class="sidebar-divider d-md-block">
	<a class="btn btn-info" href="javascript:filterAdminByRole('all')">Tất cả</a>
	<?php
	$admin = new admin();
	$result = $admin->getAllRole();
	while ($get = $result->fetch()) :
	?>
		<a class="btn btn-info" href="javascript:filterAdminByRole(<?= $get['maQuyen'] ?>)"><?= $get['quyen'] ?></a>
	<?php endwhile; ?>
	<hr class="sidebar-divider d-none d-md-block">
	<div class="row mt-3 adminList">
		<?php include "include/ad-adminList.php" ?>
	</div>
</div>

<script>
	const searchEmail = document.getElementById('searchEmail');
	const searchId = document.getElementById('searchId');
	const f1 = document.getElementById('f1');
	const f2 = document.getElementById('f2');

	searchEmail.addEventListener('click', () => {
		f1.classList.add('d-inline-block');
		// xóa class hiện form => ẩn
		f2.classList.remove('d-inline-block');
		//
		// searchEmail.classList.add('d-none');
		// searchId.classList.remove('d-none');
	})

	searchId.addEventListener('click', () => {
		f2.classList.add('d-inline-block');
		// xóa class hiện form => ẩn
		f1.classList.remove('d-inline-block');
		//
		// searchId.classList.add('d-none');
		// searchEmail.classList.remove('d-none');
	})
</script>