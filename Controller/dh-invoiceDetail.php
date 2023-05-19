<?php
if (isset($_POST['id']) && $_POST['id'] != '') {
	$validate = new validate();
	$check = $validate->checkExistsInvoice($_POST['id']);
	if (!empty($check)) {
		include_once 'View/invoiceDetail.php';
	} else {
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
	}
} else {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=myAccount"/>';
}
