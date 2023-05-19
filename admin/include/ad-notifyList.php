<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$ac = 0;
if(isset($_POST['day']) && $_POST['day'] !=''){
	$ac = 1;
}
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	<thead>
		<tr>
			<th>##</th>
			<th>Tác giả</th>
			<th>Ảnh</th>
			<th>Email</th>
			<th>Số điện thoại</th>
			<th>Nội dung</th>
			<th>Ngày</th>
			<th>Kết quả</th>
			<th>Mã/Tên tìm kiếm</th>
			<th>Câu lệnh</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$admin = new Admin();
		if($ac == 0){
			$result = $admin->getAllNotify();
		}else if($ac == 1){
			$result = $admin->getNotifyByDay($_POST['day']);			
		}
		$i = 1;
		while ($get = $result->fetch()) :
		?>
			<tr>
				<td><?= $i++.'-N'.$get['maTB'] ?></td>
				<td><?= $get['tacgia'] ?></td>
				<td>
					<?php
					if (!empty($get['anh'])) {
						if (strpos($get['anh'], 'https') !== false) { ?>
							<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
							<?php } else {
							if (isset($get['anh']) && $get['anh'] != '') { ?>
								<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('../assets/images/imageAccount/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
							<?php } else { ?>
								<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
						<?php }
						}
					} else { ?>
						<div class="rounded-circle" style="width: 80px; height: 80px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
					<?php }
					?>
				</td>
				<td><?= $get['email'] ?></td>
				<td><?= $get['sdt'] ?></td>
				<td><?= $get['noidung'] ?></td>
				<td><?php
						$date = new DateTime($get['ngay'], new DateTimeZone('Asia/Ho_Chi_Minh'));
						$dateFix = $date->format('d-m-Y H:i:s');
						echo $dateFix;
						?></td>
				<td><?= $get['ketqua'] ?></td>
				<td><?= $get['timkiem'] ?></td>
				<td>
					<div class="d-flex justify-content-center align-items-center">
						<button class="btn btn-primary" data-toggle="modal" data-target="#modalCodeSQL<?php echo $get['maTB'] ?>">Xem</button>
						<!-- Modal-->
						<div class="modal fade" id="modalCodeSQL<?php echo $get['maTB'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Câu lệnh thực thi</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<?= $get['caulenh'] ?>
									</div>
								</div>
							</div>
						</div>
						<!-- end modal-->
					</div>
				</td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>