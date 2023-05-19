<div class="container-fluid">
	<button id="exportNews" class="btn btn-success">Xuất dữ liệu ra file excel</button>
	<hr class="sidebar-divider d-none d-md-block">
	<div class="">
		<a href="javascript:adminFilterNewsByTT('all')" class="btn btn-info text-white">Tất cả</a>
		<a href="javascript:adminFilterNewsByTT(1)" class="btn btn-info text-white">Tin tức hiện</a>
		<a href="javascript:adminFilterNewsByTT(2)" class="btn btn-info text-white">Tin tức ẩn</a>
	</div>
	<hr class="sidebar-divider d-md-block">
	Tiêu đề
	<input name="search" type="text" class="my-3 form-control bg-light border-1 small searchTitleNews" placeholder="Tìm kiếm tiêu đề tin tức" autocomplete="off" spellcheck="false">
	<hr class="sidebar-divider d-none d-md-block">
	<div class="row mt-3 newsList">
		<?php include "include/ad-newsList.php" ?>
	</div>
</div>