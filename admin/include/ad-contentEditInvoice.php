<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$admin = new admin();
if (!empty($_GET['maHD']) && $_GET['maHD'] != '') {
	$result = $admin->getInvoiceById($_GET['maHD']);
	$_SESSION['copyMaHD'] = $_GET['maHD'];
} else if (!empty($_POST['maHD']) && $_POST['maHD'] != '') {
	$result = $admin->getInvoiceById($_POST['maHD']);
	$_SESSION['copyMaHD'] = $_POST['maHD'];
} else {
	$result = $admin->getInvoiceById($_SESSION['copyMaHD']);
}
$maHD = $result['maHD'];
$hovaten = $result['tenKH'];
$tinhtrang = $result['tinhtrang'];
$tongtien = $result['tongtien'];
$sdt = $result['sdt'];
$email = $result['email'];
$ngay = $result['ngay'];
$tentinhtrang = $result['ten'];
$congty = $result['congty'];
$diachi1 = $result['diachi1'];
$diachi2 = $result['diachi2'];
$ghichu = $result['ghichu'];
?>
<table class="table table-borderless" style="font-size: 18px">
	<thead>
		<tr>
			<th>Hóa đơn<br> <?php echo $maHD ?></th>
			<th>Tổng tiền<br> <?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?></th>
			<th>Ngày đặt hàng<br> <?php
											$date = new DateTime($ngay);
											$dateFix = $date->format('d/m/Y');
											echo $dateFix;   ?>
			</th>
			<th>Tên khách hàng<br> <?php echo $hovaten ?></th>
			<th>Số điện thoại<br> <?php echo $sdt ?></th>
			<th>Email<br> <?php echo $email ?></th>
			<th>
				<input type="hidden" name="maHD" value="<?php if (!empty($_GET['maHD']) && $_GET['maHD'] != '') {
																			echo $_GET['maHD'];
																		} else if (!empty($_POST['maHD']) && $_POST['maHD'] != '') {
																			echo $_POST['maHD'];
																		} else {
																			echo $_SESSION['copyMaHD'];
																		} ?>">
						
				<select class="form-control" name="editTinhtrang">
					<?php
					$result = $admin->getAllStatusInvoice();
					while ($get = $result->fetch()) {
					?>
						<option <?= ($tinhtrang == $get['maTTHD']) ? 'selected' : '' ?> value="<?= $get['maTTHD'] ?>">
							<?= ($tinhtrang == $get['maTTHD']) ? $tentinhtrang : $get['ten'] ?>
						</option>
					<?php } ?>
				</select>
			</th>
			<th></th>
		</tr>
		<tr>
			<th id="fakeFormEditCompanyName">
				<label for="">Công ty</label>
				<input class="form-control" type="text" name="editCompanyName" value="<?= $congty ?>" autocomplete="off" spellcheck="false">
			</th>
			<th id="fakeFormEditAddress1" colspan="3">
				<label for="">Địa chỉ</label>
				<input class="form-control" type="text" name="editAddress1" value="<?= $diachi1 ?>" autocomplete="off" spellcheck="false">
			</th>
			<th id="fakeFormEditAddress2" colspan="2">
				<input class="form-control" type="text" name="editAddress2" value="<?= $diachi2 ?>" autocomplete="off" spellcheck="false">
			</th>
			<th id="fakeFormEditNote">
				<button type="button" class="btn btn-info form-control" data-toggle="modal" data-target="#modalViewNote">Ghi chú</button>
				<!-- Modal-->
				<div class="modal fade" id="modalViewNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Ghi chú đơn hàng</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<form id="formEditNote" method="POST">
								<div class="modal-body">
									<input type="hidden" name="maHD" value="<?= $maHD ?>">
									<input name="noteInvoice" id="noteInvoice" value="<?= $ghichu ?>"></input>
								</div>
								<div class="modal-footer">
									<button class="btn btn-info">Cập nhật thông tin</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- end modal-->
			</th>
			<th></th>
		</tr>
		<tr>
			<th>Mã sản phẩm</th>
			<th>Ảnh</th>
			<th>Tên sản phẩm</th>
			<th>Số lượng mua</th>
			<th>Đơn giá</th>
			<th>Thành tiền</th>
			<th>Tình trạng</th>
			<th></th>
		</tr>
	</thead>
	<tbody class="contentEditInvoice">
		<?php
		$admin = new admin();
		if (isset($_POST['maHD'])) {
			$invoiceDetails = $admin->getInvoiceDetailById($_POST['maHD']);
		} else {
			$invoiceDetails = $admin->getInvoiceDetailById($maHD);
		}
		while ($get = $invoiceDetails->fetch()) {
		?>
			<tr>
				<td>
					<?php echo $get['maSP'] ?>
					<input type="hidden" name="maSP" value="<?php echo $get['maSP'] ?>">
				</td>
				<td><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img width="100px" src="../assets/images/product/<?php echo $get['anh'] ?>" alt=""></a></td>
				<td><?php echo $get['tenSP'] ?></td>
				<td><input class="form-control" type="number" name="soluong" onblur="javascript:updateQtyProductInvoiceDetail(this.value, <?= $get['maSP'] ?>, <?= $maHD ?>, <?= $get['dongia'] ?>)" value="<?php echo $get['soluongmua'] ?>" <?php if ($get['tinhtrang'] != 1) {
																																																																															echo 'disabled';
																																																																														} ?>></td>
				<td>
					<input type="hidden" name="dongia" value="<?php echo $get['dongia'] ?>">
					<?php echo number_format($get['dongia'], 0, ',', '.') . 'đ'; ?>
				</td>
				<td><?php echo number_format($get['thanhtien'], 0, ',', '.') . 'đ'; ?></td>
				<td>
					<?php if ($get['trahang'] == 2) { ?>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalViewReason-<?php echo $get['maSP'] ?>">Đã trả hàng</button>
						<!-- Modal-->
						<div class="modal fade" id="modalViewReason-<?php echo $get['maSP'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-lg modal-dialog-centered m-auto" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Lý do trả hàng</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<?php
										$getReasonReturnProduct = $admin->getReasonReturnProduct($maHD, $get['maSP']);
										while ($set = $getReasonReturnProduct->fetch()) {
										?>
											<div class="d-flex justify-content-center">
												<img style="width: 150px" src="../assets/images/returnProduct/<?= $set['anh'] ?>" alt="Ảnh chứng minh">
											</div>
											<hr>
											<p><?= $set['lydo'] ?></p>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<!-- end modal-->
					<?php } else {
						switch ($get['tinhtrang']) {
							case 1:
								echo '<span class="btn btn-dark">Đang xử lý</span>';
								break;
							case 2:
								echo '<span class="btn btn-warning">Đang vận chuyển</span>';
								break;
							case 3:
								echo '<span class="btn btn-success">Đã thanh toán</span>';
								break;
							case 4:
								echo '<span class="btn btn-danger">Đã hủy đơn</span>';
								break;
							case 5:
								echo '<span class="btn btn-danger">Trả đơn hàng</span>';
								break;
							case 6:
								echo '<span class="btn btn-info">Đã nhận hàng</span>';
								break;
						}
					} ?>
				</td>
				<td style="font-size: 18px" class="d-flex">
					<!-- <?php if ($get['trangthai'] == 1) { ?>
							<a href="javascript:deleteInvoiceDetail(<?= $get['maSP'] ?>, <?= $maHD ?>)" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
						<?php } else { ?>
							<a href="javascript:restoreInvoiceDetail(<?= $get['maSP'] ?>, <?= $maHD ?>)" class="btn btn-primary"><i class="fa-solid fa-rotate"></i></a>
						<?php } ?> -->
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<!-- </div> -->