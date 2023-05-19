<?php
if (empty($_GET['action'])) {
	session_start();
}

set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$comment = new comment();
if (isset($_POST['maSP'])) {
	$getAllCommentByProductId =  $comment->getCommentByProductId($_POST['maSP']);
} else if (isset($_GET['maSP'])) {
	$getAllCommentByProductId =  $comment->getCommentByProductId($_GET['maSP']);
}
$count =  $getAllCommentByProductId->rowCount();

$p = new page();
$limit = 5;
$page = $p->findPage($count, $limit);
$start = $p->findStart($limit);

$currentPage = 1;
if (isset($_POST['page']) && $_POST['page'] != '') {
	$currentPage = $_POST['page'];
} else if (isset($_GET['page']) && $_GET['page'] != '') {
	$currentPage = $_GET['page'];
}
?>
<div class="comments-area">
	<div class="d-flex justify-content-end">
		<?php if (empty($_GET['act']) || isset($_GET['act']) && $_GET['act'] == 'page') { ?>
			<div class="shop-pagination">
				<ul class="clearfix">
					<?php
					if ($currentPage > 1 && $page > 1) :
					?>
						<li class="first"><a href="javascript:pageComment(
							<?php if (isset($_POST['maSP'])) {
								echo $_POST['maSP'];
							} else if (isset($_GET['maSP'])) {
								echo $_GET['maSP'];
							} ?>,1)"><i class="fa fa-angle-double-left"></i></a></li>
						<li class="prev"><a href="javascript:pageComment(
							<?php if (isset($_POST['maSP'])) {
								echo $_POST['maSP'];
							} else if (isset($_GET['maSP'])) {
								echo $_GET['maSP'];
							} ?>,<?= $currentPage - 1 ?>)"><i class="fa fa-angle-left"></i></a></li>
					<?php endif; ?>

					<?php if ($page > 1) { ?>
						<li class="active"><a href="javascript:pageComment(
							<?php if (isset($_POST['maSP'])) {
								echo $_POST['maSP'];
							} else if (isset($_GET['maSP'])) {
								echo $_GET['maSP'];
							} ?>,<?= $currentPage ?>)"><?php echo $currentPage ?></a></li>
					<?php } ?>

					<?php if ($currentPage < $page && $page > 1) : ?>
						<li class="next"><a href="javascript:pageComment(
							<?php if (isset($_POST['maSP'])) {
								echo $_POST['maSP'];
							} else if (isset($_GET['maSP'])) {
								echo $_GET['maSP'];
							} ?>,<?= $currentPage + 1 ?>)"><i class="fa fa-angle-right"></i></a></li>
						<li class="last"><a href="javascript:pageComment(
							<?php if (isset($_POST['maSP'])) {
								echo $_POST['maSP'];
							} else if (isset($_GET['maSP'])) {
								echo $_GET['maSP'];
							} ?>,<?= $page ?>)"><i class="fa fa-angle-double-right"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
		<?php } else { ?>

		<?php } ?>
	</div>
	<!--Comment Box-->
	<?php
	$comment = new comment();
	if (isset($_POST['maSP'])) {
		$result = $comment->getCommentByProductIdOnePage($_POST['maSP'], $start, $limit);
	} else if (isset($_GET['maSP'])) {
		$result = $comment->getCommentByProductIdOnePage($_GET['maSP'], $start, $limit);
	}

	while ($get = $result->fetch()) {
	?>
		<div class="comment-box">
			<div class="comment">
				<?php if ($get['trangthai'] == 1) { ?>
					<div class="author-thumb d-flex justify-content-center align-items-center">
						<?php
						if (!empty($get['anh'])) {
							if (strpos($get['anh'], 'https') !== false) { ?>
								<div title='<?= $get['tacgia'] ?>' style="width: 60px; height: 60px; background-image: url('<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
								<?php } else {
								if (isset($get['anh']) && $get['anh'] != '') { ?>
									<div title='<?= $get['tacgia'] ?>' style="width: 60px; height: 60px; background-image: url('../assets/images/imageAccount/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
								<?php } else { ?>
									<div title='<?= $get['tacgia'] ?>' style="width: 60px; height: 60px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
							<?php }
							}
						} else { ?>
							<div title='<?= $get['tacgia'] ?>' style="width: 60px; height: 60px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
						<?php }
						?>
					</div>
					<div class="comment-inner">
						<div class="comment-info clearfix">
							<?php
							$dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
							$dateNowFix = $dateNow->format('d/m/Y');
							$dateComment = new DateTime($get['ngay'], new DateTimeZone('Asia/Ho_Chi_Minh'));
							$dateCommentFix = $dateComment->format("d/m/Y");
							//Tính khoảng cách giữa ngày hiện tại và ngày viết bình luận sản phẩm
							$diff = $dateNow->diff($dateComment);
							$days = $diff->days;
							if ($days == 0) {
								$h = $diff->h;
								$m = $diff->i;
								if ($h == 0) {
									if ($m == 0) {
										$dateShow = '1 phút trước';
									} else {
										$dateShow = $m . ' phút trước';
									}
								} else {
									$dateShow = $h . ' giờ ' . $m . ' phút trước';
								}
							} else if ($days > 0 && $days < 30) {
								$dateShow = $days . ' ngày trước';
							} else if ($days >= 30 && $days < 365) {
								$days = floor($days / 30);
								$dateShow = $days . ' tháng trước';
							} else if ($days >= 365) {
								$days = floor($days / 365);
								$dateShow = $days . ' năm trước';
							}
							echo $get['tacgia'] . " - " . $dateCommentFix . " - " . $dateShow;
							?>
						</div>
						<div class="rating">
							<?php for ($i = 0; $i < $get['danhgia']; $i++) { ?>
								<span class="fa fa-star"></span>
							<?php  } ?>
						</div>
						<div class="mt-2 text-dark" style="font-size: 18px"> - <strong><?php echo $get['binhluan'] ?></strong></div>
					</div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</div>