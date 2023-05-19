<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/4.jpg)">
	<div class="auto-container">
		<h2>Chi tiết hóa đơn</h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Chi tiết hóa đơn</li>
		</ul>
	</div>
</section>
<!--End Page Title-->

<div class="row">
	<div class="col-12 mt-5">
		<?php
		$invoice = new invoice();
		$getAllStatus = $invoice->getAllStatusInvoice();
		while ($set = $getAllStatus->fetch()) {
		?>
			<a href="javascript:filterInvoiceByStatus(<?= $set['maTTHD'] ?>,<?= $_POST['id'] ?>)" class="btn btn-secondary col-lg-1 col-md-3 col-sm-3 	"><?= $set['ten'] ?></a>
		<?php } ?>
	</div>
</div>
<hr class="sidebar-divider d-none d-md-block">
<div class="container-fluid my-5">
	<div class="row">
		<div class="col-lg-4 col-md-12 col-sm-12 border-right invoiceListAccount" style="overflow: auto; height: 553px">
			<?php include "include/invoiceListAccount.php" ?>
		</div>
		<div class="col-lg-8 col-md-12 col-sm-12 invoiceDetail">
			<?php include "include/invoiceDetail.php" ?>
		</div>
	</div>
</div>