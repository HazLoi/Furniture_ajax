<form action="index.php?action=admin-page&act=addNews&get=add" method="post" enctype="multipart/form-data" id="addNewsDatabase">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-12">

			<div class="form-group">
				<label for="title">Tiêu đề</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['title']) && $_POST['title'] != '') {
																	echo $_POST['title'];
																} ?>" type="text" name="title">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['titleErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="date">Ngày</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['date']) && $_POST['date'] != '') {
																	echo $_POST['date'];
																} ?>" type="date" name="date">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['dateErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="image">Ảnh</label><br>
				<input class="" type="file" name="image"><br>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['imageErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="date">Loại tin tức</label>
				<select name="newsType" class="form-control">
					<?php
					$admin = new admin();
					$type = $admin->getAllNewsType();
					while ($set = $type->fetch()) {
					?>
						<option value="<?= $set['maLoai'] ?>"><?= $set['tenloai'] ?></option>
					<?php } ?>
				</select>
			</div>

			<button class="btn btn-primary">Thêm tin tức</button>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-12">
			<div class="form-group">
				<label for="content">Mô tả ngắn</label>
				<textarea class="form-control" cols="10" rows="13" style="resize: none;" type="text" name="contentShort"><?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['contentShort']) && $_POST['contentShort'] != '') {
																																								echo $_POST['contentShort'];
																																							} ?></textarea>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['contentShortErrorAdminAddNews']; ?></span>
			</div>

			<div class="form-group">
				<label for="content">Chi tiết</label>
				<textarea class="form-control" cols="10" rows="13" style="resize: none;" type="text" name="contentLong" id="description"><?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['contentLong']) && $_POST['contentLong'] != '') {
																																														echo $_POST['contentLong'];
																																													} ?></textarea>
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['contentLongErrorAdminAddNews']; ?></span>
			</div>
		</div>
	</div>
</form>