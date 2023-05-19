<?php
if (empty($_GET['action'])) {
	session_start();
}
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

?>
<div class="col-lg-10 col-md-12 col-sm-12">

	<div class="table-outer">
		<table class="cart-table">
			<thead class="cart-header">
				<tr>
					<th>Ảnh sản phẩm</th>
					<th class="prod-column">Tên</th>
					<th class="price">Đơn giá</th>
					<th>Số lượng</th>
					<th>Thành tiền</th>
					<th>&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($_SESSION['productCart']) && count($_SESSION['productCart']) > 0) {
					for ($i = 0; $i < count($_SESSION['productCart']); $i++) { ?>
						<tr id="shoppingCart">
							<td class="prod-column" id="maSP">
								<div class="column-box">
									<a href="index.php?action=product-detail&maSP=<?php echo $_SESSION['productCart'][$i]['maSP'] ?>"><img style="width: 150px;" src="assets/images/product/<?php echo $_SESSION['productCart'][$i]['anh'] ?>" alt=""></a>
								</div>
								<input type="hidden" name="maSP" value="<?php echo $_SESSION['productCart'][$i]['maSP'] ?>">
							</td>
							<td>
								<h4 class="prod-title" style="font-size: 20px"><?php echo $_SESSION['productCart'][$i]['ten'] ?></h4>
							</td>
							<td class="sub-total"><?php echo 
							number_format($_SESSION['productCart'][$i]['dongia'] , 0, ',', '.') . 'đ';						
							?></td>
							<td class="qty">
								<div class="item-quantity">
									<input class="form-control" onblur="javascript:updateQtyProductCart(this.value, <?= $_SESSION['productCart'][$i]['maSP'] ?> , <?= $i ?>)" type="text" value="<?php echo $_SESSION['productCart'][$i]['soluong'] ?>" name="soluong[]">
								</div>
							</td>
							<td class="total-price"><?php echo 
							number_format($_SESSION['productCart'][$i]['thanhtien'], 0, ',', '.') . 'đ';
							 ?></td>
							<td>
								<a href="javascript:deleteProductInCart(<?= $i ?>)" class="border-0" style="background: none">
									<span style="font-size: 24px" class="fas fa-trash-alt text-danger"></span>
								</a>
							</td>
						</tr> <?php }
						} else { ?>
					<tr>
						<td colspan='6' class='text-dark' style='font-size: 24px'>
							Hiện không có bất kỳ sản phẩm nào trong giở hàng!!
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<div class="cart-options clearfix">

		<div class="pull-right">
			<div class="form-group clearfix text-white">
				<a href="javascript:deleteAllProductCart()" class="btn btn-danger">Xóa toàn bộ</a>
			</div>
		</div>

		<!-- <div class="pull-left">
                        <div class="apply-coupon clearfix">
                            <div class="form-group clearfix">
                                <input type="text" name="coupon-code" value="" placeholder="Phiếu giảm giá">
                            </div>
                            <div class="form-group clearfix">
                                <button type="button" class="theme-btn coupon-btn">Sử dụng</button>
                            </div>
                        </div>
                    </div> -->
	</div>
</div>

<div class="col-lg-2 col-md-12 col-sm-12">
	<div class="row clearfix">

		<!-- <div class="column col-lg-7 col-md-5 col-sm-12">
                    </div> -->

		<!-- <div class="column col-lg-5 col-md-7 col-sm-12"> -->
		<div class="col-md-12 col-sm-12">
			<!--Totals Table-->
			<ul class="totals-table">
				<li>
					<h3>Tổng tiền giỏ hàng</h3>
				</li>
				<?php $sp = new productCart();
				$tongtien = $sp->tongTien();
				?>
				<li class="clearfix"><span class="col">Thành tiền</span><span class="col"><?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?></span></li>
				<li class="clearfix total"><span class="col">Tổng tiền</span><span class="col price"><?php echo number_format($tongtien, 0, ',', '.') . 'đ'; ?></span></li>
				<li class="text-right"><a href="index.php?action=checkout" style="font-size: 17px" type="submit" class="theme-btn proceed-btn">&nbsp;&nbsp;&nbsp; Thanh toán &nbsp;&nbsp;&nbsp;</a></li>
			</ul>
		</div>
	</div>
</div>