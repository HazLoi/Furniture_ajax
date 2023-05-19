<form action="index.php?action=admin-page&act=addProduct&get=add" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 m-auto">
			<div class="form-group">
				<label for="productName">Tên sản phẩm</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['productName']) && $_POST['productName'] != '') echo $_POST['productName'] ?>" type="text" name="productName">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['productNameErrorAdminAddProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="category">Loại sản phẩm</label>
				<select class="form-control" name="category">
					<?php
					$admin = new admin();
					$categories = $admin->getAllCategory();
					while ($get = $categories->fetch()) {
					?>
						<option value="<?php echo $get['maLoai'] ?>"><?php echo $get['tenloai'] ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label for="image">Ảnh</label>
				<input class="form-control" type="file" name="image">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['imageErrorAdminAddProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="price">Đơn giá</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['price']) && $_POST['price'] != '') {echo $_POST['price'];}else{echo '0';} ?>" type="number" name="price">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['priceErrorAdminAddProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="sale">Giảm giá</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['sale']) && $_POST['sale'] != '') {echo $_POST['sale'];}else{echo '0';} ?>" type="number" name="sale">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['saleErrorAdminAddProduct']; ?></span>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 m-auto">
			
			<div class="form-group">
				<label for="dateSale">Thời hạn hết giảm giá</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['dateSale']) && $_POST['dateSale'] != '') {echo $_POST['dateSale'];}else{echo '0';} ?>" type="date" name="dateSale">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['dateSaleErrorAdminAddProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="instock">Tồn kho</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['instock']) && $_POST['instock'] != '') {echo $_POST['instock'];}else{echo '0';} ?>" type="number" name="instock">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['instockErrorAdminAddProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="selled">Đã bán</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['selled']) && $_POST['selled'] != '') {echo $_POST['selled'];}else{echo '0';} ?>" type="number" name="selled">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['selledErrorAdminAddProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="rate">Đánh giá</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['rate']) && $_POST['rate'] != '') {echo $_POST['rate'];}else{echo '0';} ?>" type="number" name="rate">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['rateErrorAdminAddProduct']; ?></span>
			</div>

			<div class="form-group">
				<label for="like">Yêu thích</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['like']) && $_POST['like'] != '') {echo $_POST['like'];}else{echo '0';} ?>" type="number" name="like">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['likeErrorAdminAddProduct']; ?></span>
			</div>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 form-group">
			<label for="descriptionShort">Mô tả ngắn</label>
			<textarea class="form-control" style="resize: none; height: 700px" type="text" name="descriptionShort" id="description"><?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['descriptionShort']) && $_POST['descriptionShort'] != '') echo $_POST['descriptionShort'] ?></textarea>
			<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['descriptionShortErrorAdminAddProduct']; ?></span>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 form-group">
			<label for="descriptionLong">Mô tả chi tiết</label>
			<textarea class="form-control" style="resize: none; height: 700px" type="text" name="descriptionLong" id="description"><?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['descriptionLong']) && $_POST['descriptionLong'] != '') echo $_POST['descriptionLong'] ?></textarea>
			<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['descriptionLongErrorAdminAddProduct']; ?></span>
		</div>
	</div>
	<hr>
	<button class="btn btn-primary float-right mb-5">Thêm sản phẩm</button>
</form>