<style>

</style>
<div class="container-fluid">
	<?php
	$admin = new admin();
	$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
	if ($role != 2) { ?>
		<button id="exportContact" class="btn btn-success">Xuất dữ liệu ra file excel</button>
	<?php } ?>
	<hr class="sidebar-divider d-md-block">
		Chủ đề
	<input name="search" type="text" class="my-3 form-control bg-light border-1 small formSearchSubjectContact" placeholder="Tìm kiếm theo chủ đề" autocomplete="off" spellcheck="false">
	Email
	<input name="search" type="text" class="my-3 form-control bg-light border-1 small formSearchEmailContact" placeholder="Tìm kiếm theo email" autocomplete="off" spellcheck="false">

	<div class="row">
		<div class="col-lg-12 col-md-10 col-sm-12 w-100 contentContact">
			<?php include "include/ad-contact.php" ?>
		</div>
	</div>

</div>