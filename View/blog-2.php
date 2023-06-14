<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
	<div class="auto-container">
		<h2>Tin tức</h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Tin tức</li>
		</ul>
	</div>
</section>
<!--End Page Title-->

<!-- Our Blogs Section -->
<section class="our-blogs-section">
	<div class="auto-container">
		<label class="h3 text-dark" for="newsSearch">Nhập tin tức cần tìm</label>
		<input class="searchNews form-control col-lg-3 col-md-4 col-sm-5" type="search" name="newsSearch" placeholder="Tìm kiếm tin tức">

		<hr class="sidebar-divider d-md-block">

		<div class="row clearfix">
			<div class="col-lg-9 col-md-9 col-sm-12 contentNews">
				<?php include 'include/news.php' ?>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-12">
				<div class="sidebar-widget sidebar-blog-category">
					<div class="sidebar-title">
						<h2>Loại tin tức</h2>
					</div>
					<ul class="cat-list">
						<li><a href="javascript:findNewsByNewsType()">Xem tất cả</a></li>
						<?php
						$newsType = $news->getAllNewsType();
						while ($set = $newsType->fetch()) {
						?>
							<li>
								<a href="javascript:findNewsByNewsType(<?= $set['maLoai'] ?>)"><?= $set['tenloai'] ?></a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>

	</div>
</section>
<!-- End Our Blogs Section -->