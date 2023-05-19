<?php
$user = new user();
$result = $user->getInfoByCustomerId($_SESSION['id']);
$address = $result['diachi'];
$date = $result['ngaysinh'];
$gender = $result['gioitinh'];
?>
<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/4.jpg)">
	<div class="auto-container">
		<h2>Tài khoản của bạn </h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Tài khoản của bạn</li>
		</ul>
	</div>
</section>
<!--End Page Title-->


<div class="container my-5">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-12 border-right my-5">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

				<form action="index.php?action=myAccount&get=updateImageAccount" method="post" class="mb-2" enctype="multipart/form-data">
					<div class="d-flex mb-2 justify-content-center">
						<div class="position-relative">
							<input id="image-upload" name="imageAccount" class="d-none" type="file" onchange="previewImage(event)">
							<img id="preview" class="ml-2 rounded-circle" style="width: 70px; height: 70px;" src="<?php if (!empty($_SESSION['image'])) {if (strpos($_SESSION['image'], 'https') !== false) { echo $_SESSION['image']; } else {if (isset($_SESSION['image']) && $_SESSION['image'] != '') { echo "assets/images/imageAccount/{$_SESSION['image']}"; } else {  echo "assets/images/imageAccount/user.png";  }}} else { echo "assets/images/imageAccount/user.png";}
							?>" alt="Preview Image">

							<div class="position-absolute" style="right: 0; top: 45px">
								<label for="image-upload" style="display: inline-block"><i class="fa fa-camera" style="font-size: 18px"></i></label>
							</div>
						</div>
					</div>
					<div class="row">
						<button class="btn btn-success col-lg-6 col-md-6 col-sm-6" id="btnUpdateImageAccount" style="display: none">Xác nhận</button>
						<button type="button" onclick="exitBtn()" class="btn btn-light col-lg-6 col-md-6 col-sm-6" id="btnExitUpdateImageAccount" style="display: none">Hủy</button>
					</div>
				</form>

				<h3 class="m-auto"><?php echo	$_SESSION['fullname'] ?></h3>

				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link <?php if (!empty($_GET['get']) && $_GET['get'] == 'saveInfo') echo 'active text-success border-success' ?> " id="v-pills-infoAccount-tab" data-toggle="pill" data-target="#v-pills-infoAccount" type="button" role="tab" aria-controls="v-pills-infoAccount" aria-selected="true"><i class="fa fa-user">
					</i> Thông tin tài khoản</a>
				</button>

				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link <?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo 'active text-success border-success' ?>" id="v-pills-changePass-tab" data-toggle="pill" data-target="#v-pills-changePass" type="button" role="tab" aria-controls="v-pills-changePass" aria-selected="false"><i class="fa fa-unlock">
					</i> Thay đổi mật khẩu
				</button>
				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link" id="v-pills-invoices-tab" data-toggle="pill" data-target="#v-pills-invoices" type="button" role="tab" aria-controls="v-pills-invoices" aria-selected="false"><i class="fa fa-file-invoice">
					</i> Đơn hàng của tôi
				</button>
				<button style="border-radius: 20px; border: 1px solid gray" class="tabsBtn my-2 btn btn-light nav-link <?php if (!empty($_GET['get']) && $_GET['get'] == 'wishlist') echo 'active text-success border-success' ?>" id="v-pills-wishlist-tab" data-toggle="pill" data-target="#v-pills-wishlist" type="button" role="tab" aria-controls="v-pills-wishlist" aria-selected="false"><i class="fa fa-heart">
					</i> Danh sách yêu thích
				</button>
			</div>
		</div>
		<div class="col-lg-9 col-md-8 col-sm-12 my-5">
			<div class="tab-content" id="v-pills-tabContent">
				<div class="tab-pane fade <?php if (empty($_GET['get']) || !empty($_GET['get']) && $_GET['get'] == 'saveInfo') echo 'show active' ?>" id="v-pills-infoAccount" role="tabpanel" aria-labelledby="v-pills-infoAccount-tab">
					<h1>Thông tin tài khoản</h1>
					<form class="mt-5" id="formInfoAccount" method="post">
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Họ và tên <sup class="text-danger">*</sup></label>
								<input class="form-control" type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" placeholder="Họ và tên" autocomplete="off" spellcheck="false">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Ngày sinh <sup class="text-danger">*</sup></label>
								<input class="form-control" type="date" name="date" value="<?php echo $date ?>" autocomplete="off" spellcheck="false">
							</div>
						</div>
						<div class="form-group row my-4">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Số điện thoại <sup class="text-danger">*</sup></label><br>
								<input class="form-control" type="text" name="phone" value="<?php echo $_SESSION['phone'] ?>" autocomplete="off" spellcheck="false">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<label for="" class="h5">Email <sup class="text-danger">*</sup></label><br>
								<input class="form-control" type="text" name="email" value="<?php echo $_SESSION['email'] ?>" autocomplete="off" spellcheck="false">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="h5">Giới tính</label><br>
							<span style="font-size: 18px" class="ml-2">
								<input <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Nữ') echo 'checked' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Nữ"> Nữ</span>
							<span style="font-size: 18px" class="mx-3">
								<input <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Nam') echo 'checked' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Nam"> Nam</span>
							<span style="font-size: 18px">
								<input <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] == 'Khác') echo 'checked' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Khác"> Khác</span>
						</div>
						<div class="form-group">
							<label for="" class="h5">Địa chỉ <sup class="text-danger">*</sup></label>
							<input class="form-control" type="text" name="address" value="<?php echo $address ?>" placeholder="Địa chỉ của bạn" autocomplete="off" spellcheck="false">
						</div>

						<div class="form-group">
							<button class="btn btn-success">Cập nhật thông tin</button>
						</div>
					</form>
				</div>
				<div class="tab-pane fade <?php if (!empty($_GET['get']) && $_GET['get'] == 'changePass') echo 'show active' ?>" id="v-pills-changePass" role="tabpanel" aria-labelledby="v-pills-changePass-tab">
					<div class="row">
						<h1 class="m-auto">Thay đổi mật khẩu</h1>
					</div>
					<form class="mt-5" id="changePasswordAccount" method="post">
						<div class="form-group row">
							<div class="col-6 m-auto">
								<label for="" class="h5">Mật khẩu cũ</label>
								<input class="form-control" type="password" name="password" id="passwordOld" placeholder="Nhập mật khẩu cũ" autocomplete="off" spellcheck="false">
								<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassOld()">
									<span id="showPassOld">Hiện mật khẩu</span>
								</button><br>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-6 m-auto">
								<label for="" class="h5">Mật khẩu mới</label>
								<input class="form-control" type="password" name="passwordNew" id="passwordNew" placeholder="Nhập mật khẩu mới" autocomplete="off" spellcheck="false">
								<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassNew()">
									<span id="showPassNew">Hiện mật khẩu</span>
								</button><br>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-6 m-auto">
								<label for="" class="h5">Nhập lại mật khẩu mới</label>
								<input class="form-control" type="password" name="passwordRenew" id="passwordRenew" placeholder="Nhập lại mật khẩu" autocomplete="off" spellcheck="false">
								<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassRenew()">
									<span id="showPassRenew">Hiện mật khẩu</span>
								</button><br>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-6 m-auto">
								<button class="btn btn-success">Thay đổi mật khẩu</button>
							</div>
						</div>
					</form>
				</div>
				<div class="tab-pane fade" id="v-pills-invoices" role="tabpanel" aria-labelledby="v-pills-invoices-tab">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12" style="overflow-y: auto; height: 500px">
							<table class="table table-striped" style="font-size: 18px">
								<tr>
									<td>Mã hóa đơn</td>
									<td>Ngày</td>
									<td>Tổng tiền</td>
									<td>Tình trạng</td>
									<td></td>
								</tr>
								<?php
								$user = new user();
								$result = $user->getInvoiceByCustomerId($_SESSION['id']);
								while ($get = $result->fetch()) {
								?>
									<tr>
										<th><?php echo $get['maHD'] ?></th>
										<th><?php $date = new DateTime($get['ngay']);
												$dateFix = $date->format('d/m/Y');
												echo $dateFix ?></th>
										<th><?php echo number_format($get['tongtien'], 0, ',', '.') . 'đ'; ?></th>
										<?php
										switch ($get['tinhtrang']) {
											case 1:
												echo '<th class="text-dark">Đang xử lý</th>';
												break;
											case 2:
												echo '<th class="text-warning">Đang vận chuyển</th>';
												break;
											case 3:
												echo '<th class="text-success">Đã thanh toán</th>';
												break;
											case 4:
												echo '<th class="text-danger">Đã hủy đơn</th>';
												break;
											case 5:
												echo '<th class="text-danger">Đã trả đơn</th>';
												break;
											case 6:
												echo '<th class="text-info">Đã nhận hàng</th>';
												break;
										}
										?>
										<th>
											<form action="index.php?action=invoiceDetail" method="post">
												<input type="hidden" name="id" value="<?= $get['maHD'] ?>">
												<button class="btn btn-info">Xem</button>
											</form>
										</th>
									</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</div>
				<div class="tab-pane fade" id="v-pills-wishlist" role="tabpanel" aria-labelledby="v-pills-wishlist-tab" style="overflow-y: auto; height: 565px">
					<?php include 'include/wishlist.php' ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// Lấy tất cả các button
	const buttons = document.querySelectorAll(".tabsBtn");

	// Lặp qua từng button và thêm sự kiện click
	buttons.forEach((button) => {
		button.addEventListener("click", function() {
			// Xóa class "text-success" 'border-success' từ tất cả các button
			buttons.forEach((button) => {
				button.classList.remove('text-success', 'border-success');
			});
			// Thêm class "text-success" 'border-success' vào button được click
			this.classList.add("text-success", 'border-success');
		});
	});
</script>