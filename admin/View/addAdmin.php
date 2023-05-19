<form action="index.php?action=admin-page&act=addAdmin&get=add" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 m-auto">
			<h2 class="align-items-center">Thêm tài khoản quản lý</h2>
			<div class="row">
				<div class="form-group col-lg-6 col-md-6 col-sm-6">
					<label for="firstName">Họ <sup class="text-danger">*</sup></label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['firstName']) && $_POST['firstName'] != '') echo $_POST['firstName'] ?>" type="text" name="firstName" autocomplete="off" spellcheck="false">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['firstNameErrorAdminAddAdmin']; ?></span>
				</div>

				<div class="form-group col-lg-6 col-md-6 col-sm-6">
					<label for="lastName">Tên <sup class="text-danger">*</sup></label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['lastName']) && $_POST['lastName'] != '') echo $_POST['lastName'] ?>" type="text" name="lastName" autocomplete="off" spellcheck="false">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['lastNameErrorAdminAddAdmin']; ?></span>
				</div>
			</div>

			<div class="form-group">
				<label for="email">Email <sup class="text-danger">*</sup></label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['email']) && $_POST['email'] != '') {
																	echo $_POST['email'];
																} ?>" type="text" name="email" autocomplete="off" spellcheck="false">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['emailErrorAdminAddAdmin']; ?></span>
			</div>

			<div class="form-group">
				<label for="userName">Tên đăng nhập <sup class="text-danger">*</sup></label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['userName']) && $_POST['userName'] != '') {
																	echo $_POST['userName'];
																} ?>" type="text" name="userName" autocomplete="off" spellcheck="false">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['userNameErrorAdminAddAdmin']; ?></span>
			</div>

			<div class="form-group">
				<label for="password">Mật khẩu <sup class="text-danger">*</sup></label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['password']) && $_POST['password'] != '') {
																	echo $_POST['password'];
																} ?>" type="text" name="password" autocomplete="off" spellcheck="false">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['passwordErrorAdminAddAdmin']; ?></span>
			</div>

			<div class="form-group">
				<label for="phone">Số điện thoại <sup class="text-danger">*</sup></label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['phone']) && $_POST['phone'] != '') {
																	echo $_POST['phone'];
																} ?>" type="text" name="phone" autocomplete="off" spellcheck="false">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['phoneErrorAdminAddAdmin']; ?></span>
			</div>
 
			<div class="form-group">
				<label for="role">Phân quyền</label>
				<select class="form-control" name="role">
					<?php
					$admin = new admin();
					$result = $admin->getAllRole();
					while ($get = $result->fetch()) {
					?>
						<option value="<?php echo $get['maQuyen'] ?>"><?php echo $get['quyen']; ?></option>
					<?php } ?>
				</select>
			</div>

			<button class="btn btn-primary float-right m-auto mb-5">Thêm khách hàng</button>
		</div>
	</div>
</form>