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
if (isset($_POST['type']) && $_POST['type'] != 'all') {
	$ac = 1;
} else if (isset($_GET['type']) && $_GET['type'] != 'all') {
	$ac = 2;
} else if (isset($_POST['search']) && $_POST['search'] != '') {
	$ac = 3;
} else if (isset($_POST['nameType']) && $_POST['nameType'] != '') {
	$ac = 4;
} else if (isset($_GET['nameType']) && $_GET['nameType'] != '') {
	$ac = 5;
} else {
	$ac = 0;
}

?>

<table class="table table-striped">
	<thead>
		<tr>
			<th>##</th>
			<th>Tiêu đề</th>
			<th>Ảnh</th>
			<th>Ngày</th>
			<th>Nội dung</th>
			<th>Loại</th>
			<th>Chi tiết</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$admin = new admin();
		switch ($ac) {
			case 0:
				$newsList = $admin->getAllNews();
				break;
			case 1:
				$newsList = $admin->getNewsByTT($_POST['type']);
				break;
			case 2:
				$newsList = $admin->getNewsByTT($_GET['type']);
				break;
			case 3:
				$newsList = $admin->getNewsBySearch($_POST['search']);
				break;
			case 4:
				$newsList = $admin->getNewsByNameType($_POST['nameType']);
				break;
			case 5:
				$newsList = $admin->getNewsByNameType($_GET['nameType']);
				break;
		}
		$i = 1;
		while ($get = $newsList->fetch()) {
		?>
			<tr>
				<td><?php echo $i++ . '-N' . $get['maTT'] ?></td>
				<td><?php echo $get['tenTT'] ?></td>
				<td style="width: 100px"><a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>"><img width="100%" src="../assets/images/resource/<?php echo $get['anh'] ?>" alt=""></a></td>
				<td><?php
						$date = new DateTime($get['ngay']);
						$dateFix = $date->format('d/m/Y');
						echo $dateFix;
						?></td>
				<td style="width: 40%;"><?php
												$max_length = 200;
												$truncated_content = (strlen($get['noidung']) > $max_length) ? substr($get['noidung'], 0, $max_length) . "..." : $get['noidung'];
												echo $truncated_content ?></td>
				<td><?php
						$nameType = $admin->checkNewsType($get['loai']);
						if (is_array($nameType)) {
							echo $nameType['tenloai'];
						} else {
							echo '';
						} ?></td>
				<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalViewNews<?php echo $get['maTT'] ?>">Xem</button></td>
				<td style="font-size: 18px" class="col-lg-1 col-md-2 col-sm-3">
					<?php if ($role == 1 || $role == 3) {
						if ($get['tinhtrang'] == 1) {
					?>
							<a href="javascript:adminDeleteNews(<?= $get['maTT'] ?>,'<?php if (!empty($_POST['nameType'])) {
																											echo $_POST['nameType'];
																										} else if (!empty($_GET['nameType'])) {
																											echo $_GET['nameType'];
																										} ?>',<?php if (isset($_POST['type']) && $_POST['type'] != 'all') {
																													echo $_POST['type'];
																												} else if (isset($_GET['type']) && $_GET['type'] != 'all') {
																													echo $_GET['type'];
																												} ?>)" class="btn btn-secondary col-lg-12 col-md-12 col-sm-12">Ẩn tin tức</a>
						<?php }
						if ($get['tinhtrang'] == 2) { ?>
							<a class="btn btn-primary col-lg-12 col-md-12 col-sm-12" href="javascript:adminRestoreNews(
								<?= $get['maTT'] ?>,
								'<?php if (!empty($_POST['nameType'])) {
										echo $_POST['nameType'];
									} else if (!empty($_GET['nameType'])) {
										echo $_GET['nameType'];
									} ?>',
									<?php if (isset($_POST['type']) && $_POST['type'] != 'all') {
										echo $_POST['type'];
									} else if (isset($_GET['type']) && $_GET['type'] != 'all') {
										echo $_GET['type'];
									} ?>)">Khôi phục</a>
					<?php }
					} ?>
					<?php if ($role == 1 || $role == 3 || $role == 5) { ?>
						<a href="index.php?action=admin-page&act=editNews&maTT=<?php echo $get['maTT'] ?>" class="btn btn-warning col-lg-12 col-md-12 col-sm-12">Sửa tin tức</a>
					<?php }
					if ($role == 1) { ?>
						<a class="btn btn-danger col-lg-12 col-md-12 col-sm-12" href="javascript:adminDropNews(
							<?= $get['maTT'] ?>,
						'<?php if (!empty($_POST['nameType'])) {
								echo $_POST['nameType'];
							} else if (!empty($_GET['nameType'])) {
								echo $_GET['nameType'];
							} ?>',
							<?php if (isset($_POST['type']) && $_POST['type'] != 'all') {
								echo $_POST['type'];
							} else if (isset($_GET['type']) && $_GET['type'] != 'all') {
								echo $_GET['type'];
							} ?>)">Xóa tin tức</a>
					<?php } ?>
				</td>
			</tr>
			<!-- Modal -->
			<div class="modal fade" id="modalViewNews<?php echo $get['maTT'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Chi tiết tin tức</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<?php echo $get['chitiet'] ?>
						</div>
					</div>
				</div>
			</div>
			<!-- end modal-->
		<?php } ?>
	</tbody>
</table>