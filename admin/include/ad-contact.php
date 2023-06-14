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
if (isset($_POST['email']) && $_POST['email'] != 'all') {
	$ac = 1;
} else if (isset($_GET['email']) && $_GET['email'] != 'all') {
	$ac = 2;
} else if (isset($_POST['subject']) && $_POST['subject'] != '') {
	$ac = 3;
} else if (isset($_GET['subject']) && $_GET['subject'] != '') {
	$ac = 4;
}

?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>##</th>
			<th>Người gửi</th>
			<th>Email</th>
			<th>Chủ đề</th>
			<th>Nội dung</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$admin = new admin();
		if ($ac == 0) {
			$newsList = $admin->getAllContact();
		} elseif ($ac == 1) {
			$newsList = $admin->getContactByEmail(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'));
		} elseif ($ac == 2) {
			$newsList = $admin->getContactByEmail(htmlspecialchars($_GET['email'], ENT_QUOTES, 'UTF-8'));
		} elseif ($ac == 3) {
			$newsList = $admin->getContactBySubject(htmlspecialchars($_POST['subject'], ENT_QUOTES, 'UTF-8'));
		} elseif ($ac == 4) {
			$newsList = $admin->getContactBySubject(htmlspecialchars($_GET['subject'], ENT_QUOTES, 'UTF-8'));
		}
		$i = 1;
		while ($get = $newsList->fetch()) {
		?>
			<tr>
				<td><?php echo $i++ . '-C' . $get['maLH'] ?></td>
				<td><?php echo $get['tacgia'] ?></td>
				<td><?php echo $get['email'] ?></td>
				<td><?php echo $get['chude'] ?></td>
				<td><?php echo $get['noidung'] ?></td>
				<td style="font-size: 18px" class="col-lg-1 col-md-2 col-sm-3">
					<?php
					if ($role != 2) {
						if ($get['trangthai'] == 1) { ?>
							<a href="index.php?action=admin-page&act=repContact&maLH=<?= $get['maLH'] ?>" class="btn btn-info col-lg-12 col-md-12 col-sm-12">Trả lời</a>
						<?php } else { ?>
							<button class="btn btn-success col-lg-12 col-md-12 col-sm-12" data-toggle="modal" data-target="#modalViewRepContact<?php echo $get['maLH'] ?>">Đã phản hồi</button>
							<!-- Modal-->
							<div class="modal fade" id="modalViewRepContact<?php echo $get['maLH'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Tin nhắn phản hồi -
												<?php
												$date = new DateTime($get['ngayphanhoi'], new DateTimeZone('Asia/Ho_Chi_Minh'));
												$dateFix = $date->format('d/m/Y');
												echo $dateFix;
												?>
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<?= $get['phanhoi'] ?>
										</div>
									</div>
								</div>
							</div>
							<!-- end modal-->
						<?php }
					}
					if ($role == 1) { ?>
						<a class="btn btn-danger col-lg-12 col-md-12 col-sm-12" href="javascript:adminDropContact(<?= $get['maLH'] ?>,
						'<?php if (isset($_POST['email']) && $_POST['email'] != 'all') {
								echo $_POST['email'];
							} else if (isset($_GET['email']) && $_GET['email'] != 'all') {
								echo $_GET['email'];
							} else {
								echo 'all';
							} ?>',
							'<?php if (isset($_POST['subject']) && $_POST['subject'] != '') {
									echo $_POST['subject'];
								} else if (isset($_GET['subject']) && $_GET['subject'] != '') {
									echo $_GET['subject'];
								} ?>')">Xóa thư</a>
					<?php } ?>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>