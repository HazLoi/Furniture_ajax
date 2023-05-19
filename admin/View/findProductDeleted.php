<div class="container-fluid">
	<div class="d-flex row">
		<div class="col-lg-6 col-md-6 col-sm-12">
			<button class="btn btn-primary " id="searchName">Tìm theo tên</button>
			<button class="btn btn-primary " id="searchId">Tìm theo mã</button>
		</div>
	</div>

	<form class="d-none form-inline navbar-search my-2 adminSearchProductDeletedByName" id="f1" method="post">
		<div class="input-group">
			<input name="searchByName" type="search" class="form-control bg-light border-1 small" placeholder="Tìm kiếm tên sản phẩm" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<form class="d-none form-inline navbar-search my-2 adminSearchProductDeletedById" id="f2" method="post">
		<div class="input-group">
			<input name="searchById" type="search" class="form-control bg-light border-1 small" placeholder="Tìm kiếm mã sản phẩm" aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary">
					<i class="fas fa-search fa-sm"></i>
				</button>
			</div>
		</div>
	</form>

	<hr class="sidebar-divider d-none d-md-block">

	<div class="">
		<a href="javascript:adminFilterProductDeletedByCategory('all')" class="btn btn-info text-white">Tất cả</a>
		<?php
		$admin = new admin();
		$result = $admin->getAllCategory();

		while ($set = $result->fetch()) :
		?>
			<a href="javascript:adminFilterProductDeletedByCategory('<?php echo $set['tenloai'] ?>')" class="btn btn-info text-white"><?php echo $set['tenloai'] ?></a>
		<?php endwhile; ?>
	</div>
</div>

<div class="row mt-3 findProductDeleted">
	<?php include 'include/ad-findProductDeleted.php' ?>
</div>
</div>
<script>
	const searchName = document.getElementById('searchName');
	const searchId = document.getElementById('searchId');
	const f1 = document.getElementById('f1');
	const f2 = document.getElementById('f2');

	searchName.addEventListener('click', () => {
		f1.classList.add('d-sm-inline-block');
		// xóa class hiện form => ẩn
		f2.classList.remove('d-sm-inline-block');
		//
		// searchName.classList.add('d-none');
		// searchId.classList.remove('d-none');
	})

	searchId.addEventListener('click', () => {
		f2.classList.add('d-sm-inline-block');
		// xóa class hiện form => ẩn
		f1.classList.remove('d-sm-inline-block');
		//
		// searchId.classList.add('d-none');
		// searchName.classList.remove('d-none');
	})
</script>