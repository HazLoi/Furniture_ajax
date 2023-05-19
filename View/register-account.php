    <!--Page Title-->
    <section class="page-title" style="background-image:url(assets/images/background/2.jpg)">
    	<div class="auto-container">
    		<h2>Đăng ký</h2>
    		<ul class="page-breadcrumb">
    			<li><a href="index.php?action=home">home</a></li>
    			<li>Đăng ký</li>
    		</ul>
    	</div>
    </section>

    <!--End Page Title-->
    <section>
    	<div class="auto-container my-5" style="font-size: 16px">
    		<h1 class="text-center title-page">Đăng ký tài khoản</h1>
    		<form class="col-lg-6 col-md-6 col-sm-12 m-auto" method="post" id="formRegister">

    			<div class="form-group row">
    				<div class="col-lg-6 col-md-6 col-sm-12">
    					<label for="fname">Họ</label>
    					<input class="form-control" type="text" name="fname" autocomplete="off" spellcheck="false" placeholder="Nhập họ của bạn">

    				</div>
    				<div class="col-lg-6 col-md-6 col-sm-12">
    					<label for="lname">Tên</label>
    					<input class="form-control" type="text" name="lname" autocomplete="off" spellcheck="false" placeholder="Nhập tên của bạn">

    				</div>
    			</div>

    			<div class="form-group">
    				<label for="email">Email</label>
    				<input class="form-control" type="text" name="email" autocomplete="off" spellcheck="false" placeholder="Nhập email của bạn">

    			</div>

    			<div class="form-group">
    				<label for="phoneNumber">Số điện thoại</label>
    				<input class="form-control" type="text" name="phoneNumber" autocomplete="off" spellcheck="false" placeholder="Nhập số điện thoại của bạn">

    			</div>

    			<div class="form-group">
    				<label for="password">Mật khẩu</label>
    				<input class="form-control" type="password" name="password" id="password" autocomplete="off" spellcheck="false" placeholder="Nhập mật khẩu">

    				<div>
    					<button class="border-0" style="background: none;" type="button" onclick="showPass()">
    						<span id="showPass">Hiện mật khẩu</span></button>
    				</div>
    			</div>

    			<div class="form-group">
    				<label for="repassword">Nhập lại mật khẩu</label>
    				<input class="form-control" type="password" name="repassword" id="repassword" autocomplete="off" spellcheck="false" placeholder="Nhập lại mật khẩu">

    				<div>
    					<button class="border-0" style="background: none;" type="button" onclick="showRePass()">
    						<span id="showRePass">Hiện mật khẩu</span></button>
    				</div>
    			</div>

    			<div class="d-flex justify-content-between">
    				<div>
    					<button class="btn btn-info">
    						Đăng ký tài khoản
    					</button>
    				</div>
    				<div>
    					<a href="index.php?action=login-account" class="btn btn-primary">Đã có tài khoản</a>
    				</div>
    			</div>
    		</form>
    	</div>
    </section>