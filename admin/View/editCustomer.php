<form action="index.php?action=admin-page&act=editCustomer&get=edit&id=<?php echo $_GET['id'] ?>" method="post" enctype="multipart/form-data">
	<a href="index.php?action=admin-page&act=customerList" class="btn btn-primary">Quay lại</a>
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
																	} ?>" type="text" autocomplete="off" spellcheck="false" name="fname">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['fnameErrorAdminEditCustomer']; ?></span>
				</div>

				<div class="form-group col-lg-6">
					<label for="lname">Tên người dùng</label>
					<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['lname']) && $_POST['lname'] != '') {
																		echo $_POST['lname'];
																	} else {
																		echo $lname;
																	} ?>" type="text" autocomplete="off" spellcheck="false" name="lname">
					<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['lnameErrorAdminEditCustomer']; ?></span>
				</div>
			</div>

			<div class="form-group">
				<label for="birth">Ngày Sinh</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['birth']) && $_POST['birth'] != '') {
																	echo $_POST['birth'];
																} else {
																	echo $birth;
																} ?>" type="date" autocomplete="off" spellcheck="false" value="0" name="birth">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['birthErrorAdminEditCustomer']; ?></span>
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['email']) && $_POST['email'] != '') {
																	echo $_POST['email'];
																} else {
																	echo $emailBefore;
																} ?>" type="text" autocomplete="off" spellcheck="false" value="0" name="email">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['emailErrorAdminEditCustomer']; ?></span>
			</div>

			<div class="form-group">
				<label for="password">Mật khẩu</label>
				<input class="form-control" type="text" autocomplete="off" spellcheck="false" name="password">
			</div>

			<div class="form-group">
				<label for="phone">Số điện thoại</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['phone']) && $_POST['phone'] != '') {
																	echo $_POST['phone'];
																} else {
																	echo $phone;
																} ?>" type="text" autocomplete="off" spellcheck="false" value="0" name="phone">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['phoneErrorAdminEditCustomer']; ?></span>
			</div>

			<div class="form-group">
				<label for="address">Địa chỉ</label>
				<input class="form-control" value="<?php if (isset($_GET['get']) && $_GET['get'] == "edit" && isset($_POST['address']) && $_POST['address'] != '') {
																	echo $_POST['address'];
																} else {
																	echo $address;
																} ?>" type="text" autocomplete="off" spellcheck="false" value="0" name="address">
				<span class="text-danger"><?php if (isset($_GET['get']) && $_GET['get'] == "edit") echo $_SESSION['addressErrorAdminEditCustomer']; ?></span>
			</div>

			<button class="btn btn-primary">Cập nhật tài khoản</button>
		</div>
	</div>
</form>