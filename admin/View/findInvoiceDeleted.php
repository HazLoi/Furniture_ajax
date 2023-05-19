<div class="container-fluid">
	<div class="">
		<div class="">
			<a href="javascript:filterInvoiceDeletedByStatus('all')" class="btn btn-secondary m-1">Xem tất cả</a>
			<?php
			$admin = new admin();
			$getAllStatus = $admin->getAllStatusInvoice();
			while ($set = $getAllStatus->fetch()) {
			?>
				<a href="javascript:filterInvoiceDeletedByStatus(<?= $set['maTTHD'] ?>)" class="btn btn-secondary m-1"><?= $set['ten'] ?></a>
			<?php } ?>
		</div>
	</div>
	<hr class="sidebar-divider d-none d-md-block">
	<div class="row mt-3 findInvoiceDeleted">
		<?php include "include/ad-findInvoiceDeleted.php" ?>
	</div>
</div>