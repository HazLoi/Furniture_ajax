<div class="container-fluid">
	<?php 
	$admin = new admin();
	$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
	if ($role == 1 || $role == 3) { ?>
		<button id="exportInvoice" class="btn btn-success">Xuất dữ liệu ra file excel</button>
	<?php } ?>
	<hr class="sidebar-divider d-md-block">
	<div class="d-flex">
		<button class="btn btn-primary mr-1" id="searchCustomerName">Tìm theo tên khách hàng</button>
		<button class="btn btn-primary mr-1" id="searchId">Tìm theo mã hóa đơn</button>
	</div>

	<form class="d-none form-inline navbar-search my-2 searchInvoiceByCustomerName" id="f1" method="post">
		<div class="input-group">
			<input name="searchByCustomerName" type="search" class="form-control bg-light border-1 inpSearchInvoiceByCustomerName" placeholder="Nhập tên khách hàng" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<form class="d-none form-inline navbar-search my-2 searchInvoiceById" id="f2" method="post">
		<div class="input-group">
			<input name="searchById" type="search" class="form-control bg-light border-1 inpSearchInvoiceById" placeholder="Nhập mã hóa đơn" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>
	
	<hr class="sidebar-divider d-md-block">

	<div class="">
		<div class="">
			<a href="javascript:filterInvoiceListByStatus('all')" class="btn btn-secondary m-1">Xem tất cả</a>
			<?php
			$admin = new admin();
			$getAllStatus = $admin->getAllStatusInvoice();
			while ($set = $getAllStatus->fetch()) {
			?>
				<a href="javascript:filterInvoiceListByStatus(<?= $set['maTTHD'] ?>)" class="btn btn-secondary m-1"><?= $set['ten'] ?></a>
			<?php } ?>
		</div>
	</div>
	<hr class="sidebar-divider d-md-block">
	<div class="row mt-3 invoiceList">
		<?php include "include/ad-invoiceList.php" ?>
	</div>
</div>

<script>
	const searchCustomerName = document.getElementById('searchCustomerName');
	const searchId = document.getElementById('searchId');
	const f1 = document.getElementById('f1');
	const f2 = document.getElementById('f2');

	searchCustomerName.addEventListener('click', () => {
		f1.classList.add('d-inline-block');
		// xóa class hiện form => ẩn
		f2.classList.remove('d-inline-block');
		//
		// searchCustomerName.classList.add('d-none');
		// searchId.classList.remove('d-none');
	})

	searchId.addEventListener('click', () => {
		f2.classList.add('d-inline-block');
		// xóa class hiện form => ẩn
		f1.classList.remove('d-inline-block');
		//
		// searchId.classList.add('d-none');
		// searchCustomerName.classList.remove('d-none');
	})
</script>