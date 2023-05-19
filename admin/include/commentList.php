<?php
if (empty($_GET['act'])) {
	session_start();
}

set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$admin = new admin();
$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];

$ac = 0;
if (isset($_POST['rate']) && $_POST['rate'] != '') {
	$ac = 1;
} else if (isset($_GET['rate']) && $_GET['rate'] != '') {
	$ac = 2;
} else {
	$ac = 0;
}
?>
<div class="container-fluid">

	<div class="">
		<a href="javascript:commentByRate('',<?php if (isset($_GET['maSP'])) {
																echo $_GET['maSP'];
															} else if ($_POST['maSP']) {
																echo $_POST['maSP'];
															} ?>)" class="btn btn-info text-white">Tất cả</a>
		<a href="javascript:commentByRate(1,<?php if (isset($_GET['maSP'])) {
															echo $_GET['maSP'];
														} else if ($_POST['maSP']) {
															echo $_POST['maSP'];
														} ?>)" class="btn btn-info text-white">1 <span class="fa fa-star"></span></a>
		<a href="javascript:commentByRate(2,<?php if (isset($_GET['maSP'])) {
															echo $_GET['maSP'];
														} else if ($_POST['maSP']) {
															echo $_POST['maSP'];
														} ?>)" class="btn btn-info text-white">2 <span class="fa fa-star"></span></a>
		<a href="javascript:commentByRate(3,<?php if (isset($_GET['maSP'])) {
															echo $_GET['maSP'];
														} else if ($_POST['maSP']) {
															echo $_POST['maSP'];
														} ?>)" class="btn btn-info text-white">3 <span class="fa fa-star"></span></a>
		<a href="javascript:commentByRate(4,<?php if (isset($_GET['maSP'])) {
															echo $_GET['maSP'];
														} else if ($_POST['maSP']) {
															echo $_POST['maSP'];
														} ?>)" class="btn btn-info text-white">4 <span class="fa fa-star"></span></a>
		<a href="javascript:commentByRate(5,<?php if (isset($_GET['maSP'])) {
															echo $_GET['maSP'];
														} else if ($_POST['maSP']) {
															echo $_POST['maSP'];
														} ?>)" class="btn btn-info text-white">5 <span class="fa fa-star"></span></a>
	</div>
	<div class="row mt-3">
		<table class="table">
			<thead>
				<tr>
					<th>Mã bình luận</th>
					<th>Tác giả</th>
					<th>Email</th>
					<th>Nội dung</th>
					<th>Ngày</th>
					<th>Đánh giá</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$admin = new admin();
				switch ($ac) {
					case 0:
						if (isset($_GET['maSP']) && $_GET['maSP'] != '') {
							$comments = $admin->getCommentProduct($_GET['maSP'], '');
						} else if (isset($_POST['maSP']) && $_POST['maSP'] != '') {
							$comments = $admin->getCommentProduct($_POST['maSP'], '');
						}
						break;
					case 1:
						if (isset($_GET['maSP']) && $_GET['maSP'] != '') {
							$comments = $admin->getCommentProduct($_GET['maSP'], $_POST['rate']);
						} else if (isset($_POST['maSP']) && $_POST['maSP'] != '') {
							$comments = $admin->getCommentProduct($_POST['maSP'], $_POST['rate']);
						}

						break;
					case 2:
						if (isset($_GET['maSP']) && $_GET['maSP'] != '') {
							$comments = $admin->getCommentProduct($_GET['maSP'], $_GET['rate']);
						} else if (isset($_POST['maSP']) && $_POST['maSP'] != '') {
							$comments = $admin->getCommentProduct($_POST['maSP'], $_GET['rate']);
						}

						break;
					default:
						if (isset($_GET['maSP']) && $_GET['maSP'] != '') {
							$comments = $admin->getCommentProduct($_GET['maSP'], '');
						} else if (isset($_POST['maSP']) && $_POST['maSP'] != '') {
							$comments = $admin->getCommentProduct($_POST['maSP'], '');
						}
						break;
				}
				while ($get = $comments->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maBL'] ?></td>
						<td><?php echo $get['tacgia'] ?></td>
						<td><?php echo $get['email'] ?></td>
						<td><?php echo $get['binhluan'] ?></td>
						<td><?php $date = new DateTime('now');
								$dateFix = $date->format('d/m/Y');
								echo $dateFix ?></td>
						<td class="text-warning"><?php for ($i = 0; $i < $get['danhgia']; $i++) { ?>
								<span class="fa fa-star"></span>
							<?php  } ?>
						</td>
						<td style="font-size: 18px" class="col-lg-1 col-md-2 col-sm-3">
							<?php if ($role == 1 || $role == 3) {
								if ($get['trangthai'] == 1) {
							?>
									<a href="javascript:deleteCommentProduct(<?php if (isset($_GET['maSP'])) {
																								echo $_GET['maSP'];
																							} else if ($_POST['maSP']) {
																								echo $_POST['maSP'];
																							} ?>, <?= $get['maBL'] ?>,<?php if (isset($_POST['rate'])) {
																																	echo $_POST['rate'];
																																} else if (isset($_GET['rate'])) {
																																	echo $_GET['rate'];
																																} ?>)" class="btn btn-secondary col-lg-12 col-sm-12 col-md-12">Ẩn bình luận</a>
								<?php }
								if ($get['trangthai'] == 0) { ?>
									<a href="javascript:restoreCommentProduct(<?php if (isset($_GET['maSP'])) {
																								echo $_GET['maSP'];
																							} else if ($_POST['maSP']) {
																								echo $_POST['maSP'];
																							} ?>, <?= $get['maBL'] ?>,<?php if (isset($_POST['rate'])) {
																																	echo $_POST['rate'];
																																} else if (isset($_GET['rate'])) {
																																	echo $_GET['rate'];
																																} ?>)" class="btn btn-primary col-lg-12 col-sm-12 col-md-12">Khôi phục</a>
								<?php }
							}
							if ($role == 1) { ?>
								<a href="javascript:dropCommentProduct(<?php if (isset($_GET['maSP'])) {
																						echo $_GET['maSP'];
																					} else if ($_POST['maSP']) {
																						echo $_POST['maSP'];
																					} ?>, <?= $get['maBL'] ?>,<?php if (isset($_POST['rate'])) {
																															echo $_POST['rate'];
																														} else if (isset($_GET['rate'])) {
																															echo $_GET['rate'];
																														} ?>)" class="btn btn-danger col-lg-12 col-sm-12 col-md-12">Xóa bình luận</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>