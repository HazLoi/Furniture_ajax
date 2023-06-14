<?php

if (empty($_GET['action'])) {
	session_start();
}

set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$ac = 0;
if (!empty($_POST['newsSearch']) && $_POST['newsSearch'] != '') {
	$ac = 1;
} else if (!empty($_POST['newsType']) && $_POST['newsType'] != '') {
	$ac = 2;
}

$news = new news();

if ($ac == 0) {
	$newsAll = $news->getAllNews();
} else if ($ac == 1) {
	$newsAll = $news->getAllSearchNews($_POST['newsSearch']);
} else if ($ac == 2) {
	$newsAll = $news->getAllNewsByType($_POST['newsType']);
}

$count = $newsAll->rowCount();
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

<div class="row">
	<?php

	switch ($ac) {
		case 0:
			$result = $news->getNewsOnePage($start, $limit);
			break;
		case 1:
			$result = $news->getSearchNewsOnePage($_POST['newsSearch'], $start, $limit);
			break;
		case 2:
			$result = $news->getTypeNewsOnePage($_POST['newsType'], $start, $limit);
			break;
	}
	while ($get = $result->fetch()) {
	?>
		<!--News Block Two -->
		<div class="news-block-two style-two col-lg-6 col-md-6 col-sm-6 ">
			<div class="inner-box wow fadeInLeft bg-light" data-wow-delay="0ms" data-wow-duration="1500ms">
				<div class="image">
					<div style="width: 420px; height: 200px; background-image: url('../assets/images/resource/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
				</div>
				<div class="lower-content">
					<div class="upper-box clearfix">
						<div class="posted-date" style="font-size: 18px">
							Ngày:
							<?php
							$date = new DateTime($get['ngay']);
							$dateFix = $date->format('d / m / Y');
							echo $dateFix;
							?>
						</div>
					</div>
					<div class="lower-box">
						<h5><a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>" class="text-dark text-"><?php echo $get['tenTT'] ?></a></h5>
						<div class="text"><?php
												$max_length = 100;
												$truncated_content = (strlen($get['noidung']) > $max_length) ? substr($get['noidung'], 0, $max_length) . "..." : $get['noidung'];
												echo $truncated_content;
												?></div>
						<div>
							<a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>" class="theme-btn read-more">Chi tiết</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>


<div class="shop-pagination col-12">
	<ul class="clearfix">
		<?php
		if ($currentPage > 1 && $page > 1) :
		?>
			<li class="first"><a href="javascript:pageNews(1,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>',<?= isset($_POST['newsType']) ? $_POST['newsType'] : '' ?>)"><i class="fa fa-angle-double-left"></i></a></li>
			<li class="prev"><a href="javascript:pageNews(<?php echo $currentPage - 1 ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>',<?= isset($_POST['newsType']) ? $_POST['newsType'] : '' ?>)"><i class="fa fa-angle-left"></i></a></li>
		<?php endif; ?>

		<?php if ($page > 1) { ?>
			<li class="active"><a href="javascript:pageNews(<?php echo $currentPage ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>',<?= isset($_POST['newsType']) ? $_POST['newsType'] : '' ?>)"><?php echo $currentPage ?></a></li>
		<?php } ?>

		<?php if ($currentPage < $page && $page > 1) : ?>
			<li class="next"><a href="javascript:pageNews(<?php echo $currentPage + 1 ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>',<?= isset($_POST['newsType']) ? $_POST['newsType'] : '' ?>)"><i class="fa fa-angle-right"></i></a></li>
			<li class="last"><a href="javascript:pageNews(<?php echo $page ?>,'<?= (!empty($_POST['newsSearch'])) ? $_POST['newsSearch'] : '' ?>',<?= isset($_POST['newsType']) ? $_POST['newsType'] : '' ?>)"><i class="fa fa-angle-double-right"></i></a></li>
		<?php endif; ?>
	</ul>
</div>