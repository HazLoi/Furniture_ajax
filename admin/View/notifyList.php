<div class="container-fluid">

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Bảng cập nhật tất cả thông báo</h6><br>
			<a href="javascript:adminDropAllNotify()" class="btn btn-danger">Xóa toàn bộ thông báo</a>
		</div>
		<hr class="sidebar-divider d-md-block">
		<div class="col-12">
			<p>Link vào database: <a href="http://localhost/phpmyadmin/index.php?route=/database/structure&db=furniture" target="_blank">database</a></p>
		</div>
		<hr class="sidebar-divider d-md-block">
		<div class="col-lg-4 col-md-5 col-sm-6">
			<h5>Xem thông báo theo ngày</h5>
			<!-- <form class="formFilterNotify" method="post"> -->
				<input class="form-control formFilterNotify" type="date" name="day" value="<?php if (isset($_POST['day']) && $_POST['day'] != '') {
																									echo $_POST['day'];
																								} ?>">
				<!-- <button class="btn btn-info mt-1">Xem</button> -->
			<!-- </form> -->
		</div>
		<hr class="sidebar-divider d-md-block">
		<div class="card-body">
			<div class="table-responsive notifyList">
				<?php include "include/ad-notifyList.php" ?>
			</div>
		</div>
	</div>

</div>