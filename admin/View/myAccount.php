<style>
	label.error {
		color: red;
		font-size: 18px;
	}
</style>
<?php
$user = new admin();
$result = $user->getInfoAdmin($_SESSION['id_admin']);
$address = $result['diachi'];
$date = $result['ngaysinh'];
?>

<div class="container my-5">
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-12 border-right my-5">
			<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				<form action="index.php?action=myAccount&get=updateImageAdmin" method="post" class="mb-2" enctype="multipart/form-data">
					<div class="d-flex mb-2 justify-content-center">
						<div class="position-relative">
							<input id="image-upload" name="imageAccount" class="d-none" type="file" onchange="previewImage(event)">
							<img src="<?php
											if (!empty($_SESSION['image_admin'])) {
												if (strpos($_SESSION['image_admin'], 'https') !== false) {
													echo $_SESSION['image_admin'];
												} else {
													echo '../assets/images/imageAccount/' . $_SESSION['image_admin'];
												}
											} else {
												echo '../assets/images/imageAccount/user.png';
											}
											?>
" id="preview" style="width: 60px; height: 60px; border-radius: 50px; background: rgb(206, 196, 196)">
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

				<h3 class="m-auto"><?php echo	$_SESSION['fullname_admin'] ?></h3>

				<button style="border-radius: 20px; border: 1px solid gray" class="my-2 btn btn-light nav-link active text-dark border-success" type="button"><i class="fa fa-user">
					</i> Thông tin tài khoản</a>
				</button>
			</div>
		</div>

		<div class="col-lg-9 col-md-8 col-sm-12 my-5">
			<div>
				<div class="tab-pane fade show active" id="v-pills-infoAccount" role="tabpanel" aria-labelledby="v-pills-infoAccount-tab">
					<h1>Thông tin tài khoản</h1>
					<form class="mt-5" id="formInfoAdmin" method="post">
						<div class="form-group row">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<span for="" class="h5">Họ và tên <sup class="text-danger">*</sup></span>
								<input class="form-control" type="text" name="fullname" value="<?php echo $_SESSION['fullname_admin'] ?>" placeholder="Họ và tên" autocomplete="off" spellcheck="false">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<span for="" class="h5">Ngày sinh <sup class="text-danger">*</sup></span>
								<input class="form-control" type="date" name="date" value="<?php echo $date ?>" autocomplete="off" spellcheck="false">
							</div>
						</div>
						<div class="form-group row my-4">
							<div class="col-lg-6 col-md-6 col-sm-12">
								<span for="" class="h5">Số điện thoại <sup class="text-danger">*</sup></span><br>
								<input class="form-control" type="text" name="phone" value="<?php echo $_SESSION['phone_admin'] ?>" autocomplete="off" spellcheck="false">
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12">
								<span for="" class="h5">Email <sup class="text-danger">*</sup></span><br>
								<input class="form-control" type="text" name="email" value="<?php echo $_SESSION['email_admin'] ?>" autocomplete="off" spellcheck="false">
							</div>
						</div>
						<div class="form-group">
							<span for="" class="h5">Giới tính</span><br>
							<span style="font-size: 18px" class="ml-2">
								<input <?= (isset($_SESSION['gender_admin']) && $_SESSION['gender_admin']) == 'Nữ' ? 'checked' : '' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Nữ"> Nữ</span>
							<span style="font-size: 18px" class="mx-3">
								<input <?= (isset($_SESSION['gender_admin']) && $_SESSION['gender_admin']) == 'Nam' ? 'checked' : '' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Nam"> Nam</span>
							<span style="font-size: 18px">
								<input <?= (isset($_SESSION['gender_admin']) && $_SESSION['gender_admin']) == 'Khác' ? 'checked' : '' ?> style="transform: scale(1.5);" type="radio" name="gender" value="Khác"> Khác</span>
						</div>
						<div class="form-group">
							<span for="" class="h5">Địa chỉ <sup class="text-danger">*</sup></span>
							<input class="form-control" type="text" name="address" value="<?php echo $address ?>" placeholder="Địa chỉ của bạn" autocomplete="off" spellcheck="false">
						</div>

						<div class="form-group">
							<button class="btn btn-success">Cập nhật thông tin</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>