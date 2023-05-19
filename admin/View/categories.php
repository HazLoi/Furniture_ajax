<div class="container-fluid">
	<?php 
	$admin = new admin();
	$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
	if (empty($_GET['get']) || $_GET['get'] == 'add') { ?>
		<?php if ($role == 1 || $role == 3 || $role == 4) { ?>
			<form class="col-lg-12 col-md-12 col-sm-12" action="index.php?action=admin-page&act=categories&get=add" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 m-auto">

						<div class="form-group">
							<label for="categoryName">Tên loại sản phẩm</label>
							<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == 'add') {
																				echo $_POST['categoryName'];
																			} ?>" type="text" name="categoryName">
							<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == 'add') echo $_SESSION['categoryNameErrorAddCategory']; ?></span>
						</div>

						<button class="btn btn-primary">Thêm loại sản phẩm</button>
					</div>
				</div>
			</form>
		<?php }
	} elseif ($_GET['get'] == 'edit') { ?>
		<?php if ($role == 1 || $role == 3 || $role == 5) { ?>
			<form class="col-lg-12 col-md-12 col-sm-12" action="index.php?action=admin-page&act=categories&get=edit&active=edit&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-12 m-auto">

						<div class="form-group">
							<label for="categoryName">Tên loại sản phẩm</label>
							<input class="form-control" value="<?php if (isset($_GET['active']) && $_GET['active'] == 'edit') {
																				echo $_POST['categoryName'];
																			} else {
																				echo $categoryName;
																			} ?>" type="text" name="categoryName">
							<span class="text-danger"><?php if (isset($_GET['active']) && $_GET['active'] == 'edit') echo $_SESSION['categoryNameErrorEditCategory']; ?></span>
						</div>

						<button class="btn btn-primary">Cập nhật</button>
					</div>
				</div>
			</form>
	<?php }
	} ?>
	<div class="row mt-3 categoryList">
		<?php include 'include/ad-categoryList.php' ?>
	</div>
</div>