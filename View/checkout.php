<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
    <div class="auto-container">
        <h2>Thanh toán</h2>
        <ul class="page-breadcrumb">
            <li><a href="index.php?action=home">home</a></li>
            <li>Thanh toán</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!--Checkout Page-->
<div class="checkout-page">
    <div class="auto-container">

        <!--Default Links-->
        <?php if (empty($_SESSION['id'])) { ?>
            <ul class="default-links">
                <li>Nếu bạn chưa có tài khoản: <a href="index.php?action=register-account">Đăng ký</a></li>
            </ul>
        <?php } else { ?>
            <!--Billing Details-->
            <div class="billing-details">
                <div class="shop-form">
                    <form method="post" id="formCheckout">
                        <div class="row clearfix">
                            <div class="col-lg-7 col-md-12 col-sm-12">

                                <div class="title-box">
                                    <h2>Chi tiết thanh toán</h2>
                                </div>
                                <div class="billing-inner">
                                    <?php if (isset($_SESSION['id'])) {
                                        $user = new user();
                                        $result = $user->getInfoByCustomerId($_SESSION['id']);
                                        $fname = $result['ho'];
                                        $lname = $result['ten'];
                                        $address = $result['diachi'];
                                    ?>
                                        <div class="row clearfix">
                                            <!--Form Group-->
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <div class="field-label">Họ <sup>*</sup></div>
                                                <input type="text" name="fname" value="<?php echo $fname ?>" placeholder="Họ">

                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <div class="field-label">Tên <sup>*</sup></div>
                                                <input type="text" name="lname" value="<?php echo $lname ?>" placeholder="Tên">

                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Tên công ty </div>
                                                <input type="text" name="companyName" placeholder="Tên công ty">
                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Địa chỉ <sup>*</sup></div>
                                                <input type="text" name="address1" value="<?php echo $address ?>" placeholder="Địa chỉ">


                                                <input class="address-two" type="text" name="address2" placeholder="Căn hộ, Đơn vị phù hợp, vv (tùy chọn)">
                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Tỉnh / Thành phố <sup>*</sup></div>
                                                <input type="text" name="city" placeholder="Tỉnh / Thành phố ">

                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <div class="field-label">Địa chỉ email <sup>*</sup></div>
                                                <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>" placeholder="Địa chỉ email">

                                            </div>

                                            <!--Form Group-->
                                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                <div class="field-label">Số điện thoại <sup>*</sup></div>
                                                <input type="text" name="phone" value="<?php echo $_SESSION['phone'] ?>" placeholder="Số điện thoại">

                                            </div>

                                            <div class="form-group title-box col-md-12 col-xs-12">
                                                <h2>Ghi chú</h2>
                                            </div>

                                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                <div class="field-label">Ghi chú đặt hàng</div>
                                                <textarea id="contactMessage" name="note" placeholder="Lưu ý về đơn đặt hàng của bạn. ví dụ. lưu ý đặc biệt cho giao hàng"></textarea>
                                            </div>

                                        </div>
                                    <?php } else { ?>
                                        <div class="row clearfix">
                                            <h1>Bạn cần đăng nhập để tiến hành thanh toán</h1>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-12 col-sm-12">
                                <div class="title-box">
                                    <h2>Hóa đơn của bạn</h2>
                                </div>
                                <div class="">
                                    <div >
                                        <div style="overflow-y: auto; max-height: 600px">
                                            <table class="table table-hover" style="font-size: 15px">
                                                <thead>
                                                    <tr>
                                                        <th>Sản phẩm</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Thành tiền</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="overflow-y: auto; max-height: 690px;">
                                                    <?php for ($i = 0; $i < count($_SESSION['productCart']); $i++) { ?>
                                                        <tr>
                                                            <th><?php echo $_SESSION['productCart'][$i]['ten'] ?></th>
                                                            <th><?php echo $_SESSION['productCart'][$i]['soluong'] ?></th>
                                                            <th><?php echo
                                                                number_format($_SESSION['productCart'][$i]['dongia'], 0, ',', '.') . 'đ'; ?></th>
                                                            <th><?php echo
                                                                number_format($_SESSION['productCart'][$i]['thanhtien'], 0, ',', '.') . 'đ'; ?></th>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>                                           
                                            </table>
                                        </div>
                                    </div>


                                    <div class="place-order">
                                        <div class="btn btn-light w-100 my-3 p-2">Tổng tiền thanh toán: <?php
                                                                    $total = new productCart();
                                                                    echo number_format($total->tongTien(), 0, ',', '.') . 'đ';
                                                                    ?>
                                        </div>
                                        <?php if (isset($_SESSION['id'])) { ?>
                                            <button class="theme-btn order-btn">Đặt hàng</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</div>