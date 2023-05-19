<form action="index.php?action=admin-page&act=addCustomer&get=add" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-12 m-auto">
			<h2 class="align-items-center">Thêm tài khoản khách hàng</h2>
			<div class="row">
				<div class="form-group col-lg-6 col-md-6 col-sm-6">
					<label for="firstName">Họ <sup class="text-danger">*</sup></label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['firstName']) && $_POST['firstName'] != '') echo $_POST['firstName'] ?>" type="text" name="firstName">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['firstNameErrorAdminAddCustomer']; ?></span>
				</div>

				<div class="form-group col-lg-6 col-md-6 col-sm-6">
					<label for="lastName">Tên <sup class="text-danger">*</sup></label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['lastName']) && $_POST['lastName'] != '') echo $_POST['lastName'] ?>" type="text" name="lastName">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['lastNameErrorAdminAddCustomer']; ?></span>
				</div>
			</div>

			<div class="form-group">
				<label for="email">Email <sup class="text-danger">*</sup></label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['email']) && $_POST['email'] != '') {
																	echo $_POST['email'];
																} ?>" type="text" name="email">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['emailErrorAdminAddCustomer']; ?></span>
			</div>

			<div class="form-group">
				<label for="password">Mật khẩu <sup class="text-danger">*</sup></label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "add" && isset($_POST['password']) && $_POST['password'] != '') {
																	echo $_POST['password'];
																} ?>" type="text" name="password">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "add") echo $_SESSION['passwordErrorAdminAddCustomer']; ?></span>
			</div>
			<button class="btn btn-primary float-right m-auto mb-5">Thêm khách hàng</button>
		</div>
	</div>
</form>