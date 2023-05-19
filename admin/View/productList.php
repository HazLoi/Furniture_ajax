<div class="container-fluid">
	<button id="exportProduct" class="btn btn-success">Xuất dữ liệu ra file excel</button>
	<hr class="sidebar-divider d-md-block">
	<?php 
	$admin = new admin();
	$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
	if ($role == 1 || $role == 3 || $role == 4) { ?>
		<form class="" action="index.php?action=admin-page&act=importProducts" method="post" enctype="multipart/form-data">
			<input class="" type="file" name="fileImport">
			<button class="btn btn-primary">Chèn dữ liệu</button>
		</form>
	<?php } ?>
	<hr class="sidebar-divider d-md-block">
	<div class="d-flex justify-content-between">
		<div class="">
			<button class="btn btn-primary " id="searchName">Tìm theo tên</button>
			<button class="btn btn-primary " id="searchId">Tìm theo mã</button>
			<a href="javascript:adminFilterProductByStatus(3)" id="hiddenProduct" data-status="3" class="btn btn-primary text-white">Sản phẩm ẩn</a>
			<a href="javascript:adminFilterProductByStatus(1)" id="showProduct" data-status="1" class="btn btn-primary text-white">Sản phẩm hiện</a>
		</div>
		<div>
			<select class="form-control sortProduct">
				<option value="">Sắp xếp sản phẩm</option>
				<option value="az">Từ a đến z</option>
				<option value="za">Từ z đến a</option>
			</select>
		</div>
	</div>
	<form class="d-none form-inline navbar-search my-2 adminSearchProductByName" id="f1" method="post">
		<div class="input-group">
			<input name="searchByName" type="search" class="form-control bg-light border-1 small" placeholder="Tìm kiếm tên sản phẩm" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<form class="d-none form-inline navbar-search my-2 adminSearchProductById" id="f2" method="post">
		<div class="input-group">
			<input name="searchById" type="search" class="form-control bg-light border-1 small" placeholder="Tìm kiếm mã sản phẩm" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<hr class="sidebar-divider d-md-block">

	<div class="">
		<a href="javascript:adminFilterProductByCategory('all')" data-category="all" class="categoryProduct btn btn-info text-white">Tất cả</a>
		<?php
		$admin = new admin();
		$result = $admin->getAllCategory();

		while ($set = $result->fetch()) :
		?>
			<a href="javascript:adminFilterProductByCategory('<?php echo $set['tenloai'] ?>')" data-category="<?= $set['tenloai'] ?>" class="categoryProduct btn btn-info text-white"><?php echo $set['tenloai'] ?></a>
		<?php endwhile; ?>
	</div>

	<!-- <div class="w-25">
		<select class="form-control" id="categorySelect" onchange="adminFilterProductByCategory(this.value)">
			<option value="all">Tất cả</option>
			<?php
			$admin = new admin();
			$result = $admin->getAllCategory();

			while ($set = $result->fetch()) :
			?>
				<option value="<?php echo $set['tenloai'] ?>"><?php echo $set['tenloai'] ?></option>
			<?php endwhile; ?>
		</select>
	</div> -->


	<div class="row mt-3 productList">
		<?php include "include/ad-productList.php" ?>
	</div>
</div>

<script>
	const searchName = document.getElementById('searchName');
	const searchId = document.getElementById('searchId');
	const f1 = document.getElementById('f1');
	const f2 = document.getElementById('f2');

	searchName.addEventListener('click', () => {
		f1.classList.add('d-inline-block');
		// xóa class hiện form => ẩn
		f2.classList.remove('d-inline-block');
		//
		// searchName.classList.add('d-none');
		// searchId.classList.remove('d-none');
	})

	searchId.addEventListener('click', () => {
		f2.classList.add('d-inline-block');
		// xóa class hiện form => ẩn
		f1.classList.remove('d-inline-block');
		//
		// searchId.classList.add('d-none');
		// searchName.classList.remove('d-none');
	})
</script>