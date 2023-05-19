<?php
include_once 'a-dhAjax.php';

$admin = new admin();

if (isset($_GET['act'])) {
	if ($_GET['act'] == 'deleteCategory') {
		$result = $admin->deleteCategory($_POST['maLoai']);
	}
	if ($_GET['act'] == 'restoreCategory') {
		$result = $admin->restoreCategory($_POST['maLoai']);
	}
	if ($_GET['act'] == 'dropCategory') {
		$result = $admin->dropCategory($_POST['maLoai']);
	}
}
