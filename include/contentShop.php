<?php
if (empty($_GET['action'])) {
	session_start();
}

set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$ac = 0;
if (!empty($_POST['productSearch']) && $_POST['productSearch'] != '') {
	$ac = 1;
} else if (!empty($_POST['category'])) {
	$ac = 2;
}

$product = new product();
$p = new page();
$limit = 16;
$start = $p->findStart($limit);

if ($ac == 0) {
	$rowCount = $product->getAllProduct();
	$count = $rowCount->rowCount();
} else if ($ac == 1) {
	$rowCount = $product->getAllProductForSearch(htmlspecialchars($_POST['productSearch'], ENT_QUOTES, 'UTF-8'));
	$count = $rowCount->rowCount();
} else if ($ac == 2) {
	$rowCount = $product->getAllProductForCategory($_POST['category']);
	$count = $rowCount->rowCount();
}


$page = $p->findPage($count, $limit);

$currentPage = 1;
if (isset($_POST['page']) && $_POST['page'] != '') {
	$currentPage = $_POST['page'];
} else if (isset($_GET['page']) && $_GET['page'] != '') {
	$currentPage = $_GET['page'];
}

if ($ac == 0) {
	$result = $product->getProductOnePage($start, $limit);
} else if ($ac == 1) {
	$result = $product->getProductForSearch(htmlspecialchars($_POST['productSearch'], ENT_QUOTES, 'UTF-8'), $start, $limit);
} else if ($ac == 2) {
	$result = $product->getProductForCategory($_POST['category'], $start, $limit);
}
$checkQtyProduct = $result->rowCount();
if ($checkQtyProduct > 0) {
	while ($set = $result->fetch()) {
?>
		<div class="shop-item col-lg-3 col-md-6 col-sm-12">
			<div class="inner-box" style="min-height: 300px">
				<div class="image">
					<a href="index.php?action=product-detail&maSP=<?php echo $set['maSP'] ?>">
						<img style="height: 150px;width: 180px" src="assets/images/product/<?php echo $set['anh'] ?>" alt="" />
					</a>
					<div class="overlay-box">
						<ul class="option-box">
							<li>
								<?php
								if (isset($_SESSION['id'])) {
									//kiểm tra có thêm vào mục yêu thích chưa?
									$checkWishList = $product->checkWishList($_SESSION['id'], $set['maSP']);
									$textDanger = '';
									if ($checkWishList) {
										$textDanger = 'text-danger';
									} else {
										$textDanger = '';
									}
								}
								?>
								<a href="javascript:wishlist(<?= $set['maSP'] ?>, <?= isset($_SESSION['id']) ? $_SESSION['id'] : '' ?>)">
									<i class="fa fa-heart <?= isset($_SESSION['id']) ? $textDanger : '' ?>"></i>
								</a>
							</li>
							<li>
								<form class="formAddToCartInShop" method="post">
									<input type="hidden" name="maSP" value="<?= $set['maSP'] ?>">
									<input type="hidden" name="mausac" value="<?= $set['mausac'] ?>">
									<input type="hidden" name="kichthuoc" value="<?= $set['kichthuoc'] ?>">
									<input type="hidden" name="soluong" value="1">
									<input type="hidden" name="trang" value="<?= $currentPage ?>">
									<button id="btnAddToCartInShop" value="<?= $set['maSP'] ?>">
										<span class="fa fa-shopping-bag"></span>
									</button>
								</form>
							</li>
							<li><a href="index.php?action=product-detail&maSP=<?php echo $set['maSP'] ?>"><span class="fa fa-search"></span></a></li>
						</ul>
					</div>
					<?php
					$dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
					$dateProduct = new DateTime($set['ngaythem'], new DateTimeZone('Asia/Ho_Chi_Minh'));
					$diff = $dateNow->diff($dateProduct);
					$days = $diff->days;
					if ($days <= 20) :
					?>
						<div class="tag-banner">New</div>
					<?php endif; ?>
				</div>
				<div class="lower-content">
					<h3><a href="index.php?action=product-detail&maSP=<?php echo $set['maSP'] ?>"><?php echo $set['ten'] ?></a></h3>
					<div class="price"> <?php
												$dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
												$dateSale = new DateTime($set['thoigiangiamgia'], new DateTimeZone('Asia/Ho_Chi_Minh'));
												if ($set['giamgia'] > 0 && $dateNow <= $dateSale) { ?>
							<div class="price"><?php echo number_format($set['giamgia'], 0, ',', '.') . ' đ'; ?></div>
							<s class="price text-danger"><?php echo number_format($set['dongia'], 0, ',', '.') . ' đ'; ?></s>
						<?php } else { ?>
							<div class="price"><?php echo number_format($set['dongia'], 0, ',', '.') . ' đ'; ?></div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>


<?php } else { ?>
	<h1 class="m-auto">Sản phẩm bạn tìm kiếm không tồn tại</h1>
<?php } ?>

<div class="shop-pagination changePageShop">
	<ul class="clearfix">
		<?php
		if ($currentPage > 1 && $page > 1) :
		?>
			<li class="first"><a href="javascript:pageShop(1,'<?= isset($_POST['category']) ? $_POST['category'] : '' ?>','<?= isset($_POST['productSearch']) ? $_POST['productSearch'] : '' ?>','<?php if (isset($_POST['sortProductByPrice'])) echo $_POST['sortProductByPrice'] ?>')"><i class="fa fa-angle-double-left"></i></a></li>
			<li class="prev"><a href="javascript:pageShop(<?php echo $currentPage - 1 ?>,'<?= isset($_POST['category']) ? $_POST['category'] : '' ?>','<?= isset($_POST['productSearch']) ? $_POST['productSearch'] : '' ?>','<?php if (isset($_POST['sortProductByPrice'])) echo $_POST['sortProductByPrice'] ?>')"><i class="fa fa-angle-left"></i></a></li>
		<?php endif; ?>

		<li class="active"><a href="javascript:pageShop(<?php echo $currentPage ?>,'<?= isset($_POST['category']) ? $_POST['category'] : '' ?>','<?= isset($_POST['productSearch']) ? $_POST['productSearch'] : '' ?>','<?php if (isset($_POST['sortProductByPrice'])) echo $_POST['sortProductByPrice'] ?>')"><?php echo $currentPage ?></a></li>

		<?php if ($currentPage < $page && $page > 1) : ?>
			<li class="next"><a href="javascript:pageShop(<?php echo $currentPage + 1 ?>,'<?= isset($_POST['category']) ? $_POST['category'] : '' ?>','<?= isset($_POST['productSearch']) ? $_POST['productSearch'] : '' ?>','<?php if (isset($_POST['sortProductByPrice'])) echo $_POST['sortProductByPrice'] ?>')"><i class="fa fa-angle-right"></i></a></li>
			<li class="last"><a href="javascript:pageShop(<?php echo $page ?>,'<?= isset($_POST['category']) ? $_POST['category'] : '' ?>','<?= isset($_POST['productSearch']) ? $_POST['productSearch'] : '' ?>','<?php if (isset($_POST['sortProductByPrice'])) echo $_POST['sortProductByPrice'] ?>')"><i class="fa fa-angle-double-right"></i></a></li>
		<?php endif; ?>
	</ul>
</div>