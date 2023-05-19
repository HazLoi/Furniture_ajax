<style>
	label.error{
		color: red;
		font-size: 16px;
	}
</style>
<form class="mt-5" id="changePasswordAdmin" method="post">
	<h1 class="text-center">Đổi mật khẩu</h1>
	<div class="form-group row">
		<div class="col-lg-5 col-md-6 col-sm-12 m-auto">
			<label for="" class="h5">Mật khẩu cũ</label>
			<input class="form-control" type="password" name="password" id="passwordOld" placeholder="Nhập mật khẩu cũ" autocomplete="off" spellcheck="false">
			<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassOld()">
				<span id="showPassOld">Hiện mật khẩu</span>
			</button>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-lg-5 col-md-6 col-sm-12 m-auto">
			<label for="" class="h5">Mật khẩu mới</label>
			<input class="form-control" type="password" name="passwordNew" id="passwordNew" placeholder="Nhập mật khẩu mới" autocomplete="off" spellcheck="false">
			<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassNew()">
				<span id="showPassNew">Hiện mật khẩu</span>
			</button>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-lg-5 col-md-6 col-sm-12 m-auto">
			<label for="" class="h5">Nhập lại mật khẩu mới</label>
			<input class="form-control" type="password" name="passwordRenew" id="passwordRenew" placeholder="Nhập lại mật khẩu" autocomplete="off" spellcheck="false">
			<button class="border-0 mt-2" style="background: none;" type="button" onclick="showPassRenew()">
				<span id="showPassRenew">Hiện mật khẩu</span>
			</button>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-lg-5 col-md-6 col-sm-12 m-auto">
			<button class="btn btn-success">Thay đổi mật khẩu</button>
		</div>
	</div>
</form>
