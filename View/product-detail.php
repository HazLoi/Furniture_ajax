<style>
    #content-error{
        color: red;
    }
    .star-rating {
        margin: 25px 0 0px;
        font-size: 0;
        white-space: nowrap;
        display: inline-block;
        width: 175px;
        height: 35px;
        overflow: hidden;
        position: relative;
        background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjREREREREIiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
        background-size: contain;
    }

    .star-rating i {
        opacity: 0;
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 20%;
        z-index: 1;
        background: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iMjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMjAgMjAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDIwIDIwIiB4bWw6c3BhY2U9InByZXNlcnZlIj48cG9seWdvbiBmaWxsPSIjRkZERjg4IiBwb2ludHM9IjEwLDAgMTMuMDksNi41ODMgMjAsNy42MzkgMTUsMTIuNzY0IDE2LjE4LDIwIDEwLDE2LjU4MyAzLjgyLDIwIDUsMTIuNzY0IDAsNy42MzkgNi45MSw2LjU4MyAiLz48L3N2Zz4=');
        background-size: contain;
    }

    .star-rating input {
        /* -moz-appearance: none; */
        /* -webkit-appearance: none; */
        opacity: 0;
        display: inline-block;
        width: 20%;
        height: 100%;
        margin: 0;
        padding: 0;
        z-index: 2;
        position: relative;
    }

    .star-rating input:hover+i,
    .star-rating input:checked+i {
        opacity: 1;
    }

    .star-rating i~i {
        width: 40%;
    }

    .star-rating i~i~i {
        width: 60%;
    }

    .star-rating i~i~i~i {
        width: 80%;
    }

    .star-rating i~i~i~i~i {
        width: 100%;
    }
</style>
<?php
$product = new product();
$now = time();
if (empty($_SESSION['product_' . $maSP])) {
    $_SESSION['product_' . $maSP] = $maSP;
    $_SESSION['timeView_' . $maSP] = $now + 600;
    $view = $product->getViewProduct($maSP);
    $product->updateViewProduct($maSP, $view);
} else {
    if ($now > $_SESSION['timeView_' . $maSP]) {
        unset($_SESSION['product_' . $maSP]);
        unset($_SESSION['timeView_' . $maSP]);
    }
}
?>
<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
    <div class="auto-container">
        <h2>Chi tiết sản phẩm</h2>
        <ul class="page-breadcrumb">
            <li><a href="index.php?action=home">home</a></li>
            <li>Chi tiết sản phẩm</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!--Shop Single Section-->
<section class="shop-single-section">
    <div class="auto-container">

        <div class="shop-single">
            <div class="product-details">

                <!--Basic Details-->
                <form id="formAddToCart" method="post">
                    <input type="hidden" name="maSP" id="" value="<?php echo $maSP ?>">
                    <input type="hidden" name="mausac" id="" value="<?php echo $mausac ?>">
                    <input type="hidden" name="kichthuoc" id="" value="<?php echo $kichthuoc ?>">
                    <div class="basic-details">
                        <div class="row clearfix">
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <figure class="image-box"><a href="assets/images/product/<?php echo $anh ?>" class="lightbox-image" title="Image Caption Here"><img src="assets/images/product/<?php echo $anh ?>" alt=""></a></figure>
                            </div>
                            <div class="info-column col-lg-6 col-md-12 col-sm-12">
                                <div class="inner-column">
                                    <h4><?php echo $ten ?></h4>
                                    <div class="text"><?php echo $motangan ?></div>
                                    <div class="price">Lượt xem: <?php echo $luotxem ?></div>
                                    <div class="price">Đơn giá :
                                        <span>
                                            <?php
                                            $dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                                            $dateNowFix = $dateNow->format('d/m/Y');
                                            $dateSale = new DateTime($dateSale, new DateTimeZone('Asia/Ho_Chi_Minh'));
                                            $dateSaleFix = $dateSale->format('d/m/Y');
                                            if ($giamgia > 0) {
                                                if ($dateNow <= $dateSale) {

                                                    $diff = $dateNow->diff($dateSale);
                                                    $days = $diff->days;
                                                    if ($days == 0) {
                                                        $dateShow = ' 1 đêm duy nhất, mại dô mại dô';
                                                    } else if ($days > 0 && $days < 30) {
                                                        $dateShow = $days . ' ngày giảm giá';
                                                    } else if ($days >= 30 && $days <= 365) {
                                                        $month = floor($days / 30);
                                                        $dateShow = $month . ' tháng giảm giá';
                                                    } else if ($days > 365) {
                                                        $years = floor($days / 365);
                                                        $months = floor(($days % 365) / 30);
                                                        $dateShow = $years . ' năm ' . $months . ' tháng giảm giá';
                                                    }

                                                    if ($giamgia > 0) {
                                                        echo number_format($giamgia, 0, ',', '.') . ' đ';
                                                        echo '<s class="ml-3 text-danger">' . number_format($dongia, 0, ',', '.') . ' đ</s><br><br>';
                                                        echo '<b class="text-danger">Còn ' . $dateShow . '<b>';
                                                    }
                                                } else {
                                                    echo number_format($dongia, 0, ',', '.') . ' đ';
                                                }
                                            } else {
                                                echo number_format($dongia, 0, ',', '.') . ' đ';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                    <!-- <div class="price">Màu sắc :
                                        <span><?php echo $mausac ?></span>
                                    </div>
                                    <div class="price">Kích thước :
                                        <span><?php echo $kichthuoc ?></span>
                                    </div> -->
                                    <?php
                                    if ($tonkho > 0) {
                                    ?>
                                        <div class="other-options clearfix">
                                            <div class="item-quantity"><label class="field-label">Số lượng :</label><input class="quantity-spinner bg-light" type="text" style="font-size: 22px" value="1" name="soluong"></div>
                                            <button class="theme-btn cart-btn">Thêm vào giỏ hàng</button>
                                        </div>
                                    <?php } else { ?>
                                        <a class="btn text-light p-3" style="font-size: 20px; background: #dfb162">Hết hàng</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--Basic Details-->

                <!--Product Info Tabs-->
                <div class="product-info-tabs">
                    <!--Product Tabs-->
                    <div class="prod-tabs tabs-box">

                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#prod-details" class="tab-btn <?php if (empty($_GET['get']) && empty($_GET['act'])) echo 'active-btn' ?>">Mô tả sản phẩm</li>
                            <!-- <li data-tab="#prod-spec" class="tab-btn">Specification</li> -->
                            <li data-tab="#prod-reviews" class="tab-btn <?php if (($_GET['get'] == 'comment') || ($_GET['act'] == 'page')) echo 'active-btn' ?>">Bình luận (<?php $comment = new comment();
                                                                                                                                                                            $quantityComment = $comment->getQtyCommentByProductId($maSP);
                                                                                                                                                                            echo $quantityComment['soluong'] ?>)</li>
                        </ul>

                        <!--Tabs Container-->
                        <div class="tabs-content">

                            <!--Tab / Active Tab-->
                            <div class="tab <?php if (empty($_GET['get']) && empty($_GET['act'])) echo 'active-tab' ?>" id="prod-details">
                                <div class="content">
                                    <p><?php echo $mota ?></p>
                                </div>
                            </div>

                            <!--Tab-->
                            <div class="tab <?php if ((isset($_GET['get']) && $_GET['get'] == 'comment') || (isset($_GET['act']) && $_GET['act'] == 'page')) echo 'active-tab' ?>" id="prod-reviews">
                                <h5 class="title">Bình luận sản phẩm</h5>
                                <!--Reviews Container-->
                                <div class='contentComment'>
                                    <?php include "include/contentComment.php" ?>
                                </div>

                                <!-- Comment Form -->
                                <?php
                                $user = new user();
                                if (isset($_SESSION['id'])) {
                                    $checkUserCommentProduct = $user->checkUserCommentProduct($_SESSION['id'], $maSP);
                                    if ($checkUserCommentProduct) {
                                ?>
                                        <div class="shop-comment-form">
                                            <h2>Thêm bình luận của bạn</h2>
                                            <form id="formCommentProduct">
                                                <div class="rating-box">
                                                    <div class="text"> Đánh giá:</div>
                                                    <span class="star-rating">
                                                        <input type="radio" name="rating" value="1"><i></i>
                                                        <input type="radio" name="rating" value="2"><i></i>
                                                        <input type="radio" name="rating" value="3"><i></i>
                                                        <input type="radio" name="rating" value="4"><i></i>
                                                        <input type="radio" name="rating" value="5"><i></i>
                                                    </span><br>
                                                    <span class="ratingCheck text-danger"></span>
                                                </div>

                                                <div class="row clearfix">
                                                    <input type="hidden" name="fname" id="" value="<?= $_SESSION['fname'] ?>">
                                                    <input type="hidden" name="lname" id="" value="<?= $_SESSION['lname'] ?>">
                                                    <input type="hidden" name="email" id="" value="<?= $_SESSION['email'] ?>">
                                                    <input type="hidden" name="maSP" id="" value="<?= $maSP ?>">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <label>Nội dung <span class="maxlenght">(1000)</span><sup class="text-danger">*</sup></label>
                                                        <textarea name="content" placeholder="Nội dung"></textarea>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                                        <button class="theme-btn btn-style-four" name="submit-form"><span class="txt">Submit now</span></button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    <?php } else { ?>
                                        <p class="h4">Vui lòng mua sản phẩm để có thể bình luận</p>
                                    <?php }
                                } else {  ?>
                                    <p class="h4">Vui lòng mua sản phẩm để có thể bình luận</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Product Info Tabs-->
            </div>
        </div>
    </div>
</section>
<!--End Shop Single Section-->

<!-- Related Products -->
<section class="related-products">
    <div class="auto-container">
        <!--Sec Title-->
        <div class="title-box">
            <h2>Sản phẩm khác</h2>
        </div>

        <div class="row clearfix">

            <?php
            $sp = new product();
            $result = $sp->relatedProducts($loai, $_GET['maSP']);
            while ($get = $result->fetch()) {
            ?>
                <div class="shop-item col-lg-3 col-md-6 col-sm-12">
                    <div class="inner-box">
                        <div class="image">
                            <a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><img src="assets/images/product/<?php echo $get['anh'] ?>" alt="" /></a>
                            <div class="overlay-box">
                                <ul class="option-box">
                                    <li><a href="javascript:wishlist(<?= $get['maSP'] ?>, <?= $_SESSION['id'] ?>)"><i class="far fa-heart"></i></a></li>
                                    <li>
                                        <form class="formAddToCartInShop" method="post">
                                            <input type="hidden" name="maSP" value="<?= $get['maSP'] ?>">
                                            <input type="hidden" name="mausac" value="<?= $get['mausac'] ?>">
                                            <input type="hidden" name="kichthuoc" value="<?= $get['kichthuoc'] ?>">
                                            <input type="hidden" name="soluong" value="1">
                                            <input type="hidden" name="trang" value="<?= $currentPage ?>">
                                            <button id="btnAddToCartInShop" value="<?= $get['maSP'] ?>">
                                                <span class="fa fa-shopping-bag"></span>
                                            </button>
                                        </form>
                                    </li>
                                    <li><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><span class="fa fa-search"></span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="lower-content">
                            <h3><a href="index.php?action=product-detail&maSP=<?php echo $get['maSP'] ?>"><?php echo $get['ten'] ?></a></h3>
                            <?php $dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                            $dateSale = new DateTime($get['thoigiangiamgia'], new DateTimeZone('Asia/Ho_Chi_Minh'));
                            if ($get['giamgia'] > 0 && $dateNow <= $dateSale) {  ?>
                                <div class="price"><?php echo number_format($get['giamgia'], 0, ',', '.') . ' đ'; ?></div>
                                <s class="price text-danger"><?php echo number_format($get['dongia'], 0, ',', '.') . ' đ'; ?></s>
                            <?php } else { ?>
                                <div class="price"><?php echo number_format($get['dongia'], 0, ',', '.') . ' đ'; ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>
</section>