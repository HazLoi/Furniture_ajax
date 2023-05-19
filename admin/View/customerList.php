<div class="container-fluid">
	<?php
	$admin = new admin();
	$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
	if ($role == 1 || $role == 3) { ?>
		<button id="exportCustomer" class="btn btn-success">Xuất dữ liệu ra file excel</button>
	<?php } ?>
	<hr class="sidebar-divider d-md-block">
	<div class="d-flex">
		<button class="btn btn-primary mr-1" id="searchEmail">Tìm theo email</button>
		<button class="btn btn-primary mr-1" id="searchId">Tìm theo mã</button>
	</div>

	<form class="d-none form-inline navbar-search my-2 searchCustomerByEmail" id="f1" method="post">
		<div class="input-group">
			<input name="searchByEmail" type="search" class="form-control bg-light border-1 inpSearchCustomerByEmail" placeholder="Nhập email tài khoản" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<form class="d-none form-inline navbar-search my-2 searchCustomerById" id="f2" method="post">
		<div class="input-group">
			<input name="searchById" type="search" class="form-control bg-light border-1 inpSearchCustomerById" placeholder="Nhập mã tài khoản" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>


	<hr class="sidebar-divider d-md-block">
	<div class="row mt-3 customerList">
		<?php include "include/ad-customerList.php" ?>
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