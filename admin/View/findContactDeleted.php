<div class="container-fluid">
	<div class="row mt-3">
		<table class="table table-borderless">
			<thead>
				<tr>
					<th>Mã liên hệ</th>
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
				$adminList = $admin->getAllContactDeleted();
				while ($get = $adminList->fetch()) {
				?>
					<tr>
						<td><?php echo $get['maLH'] ?></td>
						<td><?php echo $get['tacgia'] ?></td>
						<td><?php echo $get['email'] ?></td>
						<td><?php echo $get['chude'] ?></td>
						<td><?php echo $get['noidung'] ?></td>
						<td class="d-flex" style="font-size: 18px">
							<a class="btn btn-primary" href="index.php?action=admin-page&act=findContactDeleted&get=submit&id=<?= $get['maLH'] ?>">Kích hoạt lại</a>
							<a class="btn btn-danger" href="index.php?action=admin-page&act=findContactDeleted&get=delete&id=<?= $get['maLH'] ?>">Tạm biệt</a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>