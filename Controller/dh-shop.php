<?php
$product = new product();
$allProduct = $product->getAllProduct();
$count = $allProduct->rowCount();
$limit = 8;

$p = new page();
$page = $p->findPage($count, $limit);

if (isset($_GET['page']) && $_GET['page'] <= 0 || isset($_GET['page']) && $_GET['page'] > $page) {
	include_once "View/404.php";
} else {
	include_once "View/shop.php";
}

if (isset($_GET['act']) && $_GET['act'] == 'wishlist') {
	if (isset($_SESSION['id'])) {
		$user = new user();
		$user->addWishlist($_SESSION['id'], $_GET['maSP']);
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=shop"/>';
	} else {
		echo "<script>alert('Cần đăng nhập để lưu sản phẩm')</script>";
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=login-account"/>';
	}
}
