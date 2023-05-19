<?php

if (empty($_GET['action'])) {
	session_start();
}

set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$ac = 0;
if (!empty($_POST['newsSearch'])) {
	$ac = 1;
}

$news = new news();

if ($ac == 0) {
	$newsAll = $news->getAllNews();
	$count = $newsAll->rowCount();
} else {
	$newsAll = $news->getAllSearchNews($_POST['newsSearch']);
	$count = $newsAll->rowCount();
}

$p = new page();
$limit = 4;
$page = $p->findPage($count, $limit);
$start = $p->findStart($limit);
$currentPage = 1;
if (isset($_POST['page']) && $_POST['page'] != '') {
	$currentPage = $_POST['page'];
} else if (isset($_GET['page']) && $_GET['page'] != '') {
	$currentPage = $_GET['page'];
}
?>
<div class="row clearfix">
	<?php
	if ($ac == 0) {
		$result = $news->getNewsOnePage($start, $limit);
	}
	if ($ac == 1) {
		$result = $news->getSearchNewsOnePage($_POST['newsSearch'], $start, $limit);
	}
	while ($get = $result->fetch()) {
	?>
		<!--News Block Two -->
		<div class="news-block-two style-two col-lg-6 col-md-12 col-sm-12">
			<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
				<div class="image">
					<div style="width: 600px; height: 400px; background-image: url('../assets/images/resource/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
				</div>
				<div class="lower-content">
					<div class="upper-box clearfix">
						<div class="posted-date">
							Ngày:
							<?php
							$date = new DateTime($get['ngay']);
							$dateFix = $date->format('d / m / Y');
							echo $dateFix;
							?>
						</div>
					</div>
					<div class="lower-box">
						<h3><a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>"><?php echo $get['tenTT'] ?></a></h3>
						<div class="text"><?php echo $get['noidung'] ?></div>
						<a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>" class="theme-btn read-more">Chi tiết</a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>

<div class="shop-pagination">
	<ul class="clearfix">
		<?php
		if ($currentPage > 1 && $page > 1) :
		?>
			<li class="first"><a href="javascript:pageNews(1,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>')"><i class="fa fa-angle-double-left"></i></a></li>
			<li class="prev"><a href="javascript:pageNews(<?php echo $currentPage - 1 ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>')"><i class="fa fa-angle-left"></i></a></li>
		<?php endif; ?>

		<?php if ($page > 1) { ?>
			<li class="active"><a href="javascript:pageNews(<?php echo $currentPage ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>')"><?php echo $currentPage ?></a></li>
		<?php } ?>

		<?php if ($currentPage < $page && $page > 1) : ?>
			<li class="next"><a href="javascript:pageNews(<?php echo $currentPage + 1 ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>')"><i class="fa fa-angle-right"></i></a></li>
			<li class="last"><a href="javascript:pageNews(<?php echo $page ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>')"><i class="fa fa-angle-double-right"></i></a></li>
		<?php endif; ?>
	</ul>
</div>