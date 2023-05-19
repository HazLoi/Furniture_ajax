<form action="index.php?action=admin-page&act=editAdmin&get=edit&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
	<a href="index.php?action=admin-page&act=adminList" class="btn btn-primary">Quay lại</a>
	<hr>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 m-auto">

			<div class="row">
				<div class="form-group col-lg-6">
					<label for="fname">Họ người dùng</label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['fname']) && $_POST['fname'] != '') {
																		echo $_POST['fname'];
																	} else {
																		echo $fname;
																	} ?>" type="text" name="fname" autocomplete="off" spellcheck="false">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['fnameErrorAdminEditAdmin']; ?></span>
				</div>

				<div class="form-group col-lg-6">
					<label for="lname">Tên người dùng</label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['lname']) && $_POST['lname'] != '') {
																		echo $_POST['lname'];
																	} else {
																		echo $lname;
																	} ?>" type="text" name="lname" autocomplete="off" spellcheck="false">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['lnameErrorAdminEditAdmin']; ?></span>
				</div>
			</div>

			<div class="form-group">
				<label for="birth">Ngày Sinh</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['birth']) && $_POST['birth'] != '') {
																	echo $_POST['birth'];
																} else {
																	echo $birth;
																} ?>" type="date" autocomplete="off" spellcheck="false" value="0" name="birth">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['birthErrorAdminEditAdmin']; ?></span>
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['email']) && $_POST['email'] != '') {
																	echo $_POST['email'];
																} else {
																	echo $emailBefore;
																} ?>" type="text" value="0" name="email" autocomplete="off" spellcheck="false">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['emailErrorAdminEditAdmin']; ?></span>
			</div>

			<div class="form-group">
				<label for="userName">Tên đăng nhập</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['userName']) && $_POST['userName'] != '') {
																	echo $_POST['userName'];
																} else {
																	echo $userNameBefore;
																} ?>" type="text" value="0" name="userName" autocomplete="off" spellcheck="false">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['userNameErrorAdminEditAdmin']; ?></span>
			</div>

			<div class="form-group">
				<label for="phone">Số điện thoại</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['phone']) && $_POST['phone'] != '') {
																	echo $_POST['phone'];
																} else {
																	echo $phone;
																} ?>" type="text" value="0" name="phone" autocomplete="off" spellcheck="false">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['phoneErrorAdminEditAdmin']; ?></span>
			</div>

			<div class="form-group">
				<label for="password">Mật khẩu</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['password']) && $_POST['password'] != '') {
																	echo $_POST['password'];
																} ?>" type="password" value="0" name="password" id="passwordEdit">
				<button class="border-0" style="background: none;" type="button" onclick="showPassEdit()">
					<span id="showPassEdit">Hiện mật khẩu</span>
				</button>
			</div>

			<div class="form-group">
				<label for="role">Phân quyền</label>
				<select class="form-control" name="role">
					<?php
					$admin = new admin();
					$result = $admin->getAllRole();
					while ($get = $result->fetch()) {
					?>
						<option <?= ($roleId == $get['maQuyen']) ? 'selected' : '' ?> value="<?php echo $get['maQuyen'] ?>">
							<?php if ($roleId == $get['maQuyen']) {
								echo $roleName;
							} else {
								echo $get['quyen'];
							} ?></option>
					<?php } ?>
				</select>
			</div>

			<div class="form-group">
				<label for="address">Địa chỉ</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['address']) && $_POST['address'] != '') {
																	echo $_POST['address'];
																} else {
																	echo $address;
																} ?>" type="text" autocomplete="off" spellcheck="false" value="0" name="address">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['addressErrorAdminEditAdmin']; ?></span>
			</div>

			<button class="btn btn-primary">Cập nhật tài khoản</button>
		</div>
	</div>
</form>