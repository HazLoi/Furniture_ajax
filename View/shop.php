<!--Shop Banner Section-->
<section class="shop-banner-section" style="background-image:url(assets/images/background/8.jpg);">
    <div class="auto-container">

        <!-- Content Box -->
        <div class="content-box">
            <div class="box-inner">
                <h2>Nội thất hiện đại</h2>
                <!-- <div class="text">Leverage agile frameworks to provide a robust synopsis for high level overviews.
                    Iterative approaches to corporate strategy foster collaborative.</div> -->
                <div class="text">Tận dụng các khuôn khổ linh hoạt để cung cấp một bản tóm tắt mạnh mẽ cho các tổng quan cấp cao. Các cách tiếp cận lặp đi lặp lại đối với chiến lược của công ty thúc đẩy sự hợp tác.</div>
                <!-- <a href="index.php?action=product-detail" class="theme-btn btn-style-one"><span class="txt">Mua ngay</span></a> -->
            </div>
        </div>

    </div>
</section>
<!--End Shop Banner Section-->

<!--Shop Features Section-->
<section class="shop-features-section">
    <div class="auto-container">
        <div class="row clearfix">
            <!--Feature Block-->
            <div class="shop-feature-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="icon-box">
                        <span class="icon flaticon-delivery-truck"></span>
                    </div>
                    <h3><a href="index.php?action=404">Miến phí giao hàng</a></h3>
                    <div class="text">Duis aute irure dolor in reprehend erit in voluptate velit esse cillu.</div>
                </div>
            </div>

            <!--Feature Block-->
            <div class="shop-feature-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="icon-box">
                        <span class="icon flaticon-tag"></span>
                    </div>
                    <h3><a href="index.php?action=404">Giảm giá 15%</a></h3>
                    <div class="text">Duis aute irure dolor in reprehend erit in voluptate velit esse cillu.</div>
                </div>
            </div>

            <!--Feature Block-->
            <div class="shop-feature-block col-lg-4 col-md-6 col-sm-12">
                <div class="inner-box">
                    <div class="icon-box">
                        <span class="icon flaticon-store-new-badges"></span>
                    </div>
                    <h3><a href="index.php?action=404">Mới nhất</a></h3>
                    <div class="text">Duis aute irure dolor in reprehend erit in voluptate velit esse cillu.</div>
                </div>
            </div>

        </div>
    </div>
</section>
<!--End Shop Features Section-->

<!--Shop Section-->
<section class="shop-section">
    <div class="auto-container">
        <!--Sec Title-->
        <div class="title-box">
            <h2>Danh sách sản phẩm</h2>
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                        <aside class="sidebar">

                            <!-- Search -->
                            <div class="sidebar-widget search-box">
                                <form method="post" id="searchProductShop">
                                    <div class="form-group">
                                        <input class="searchProductShop" type="search" name="productSearch" autocomplete="off" spellcheck="false" placeholder="Tìm kiếm sản phẩm">
                                        <button><span class="icon fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>

                            <!--Blog Category Widget-->
                            <div class="sidebar-widget sidebar-blog-category">
                                <div class="sidebar-title">
                                    <h2>Loại sản phẩm</h2>
                                </div>
                                <ul class="cat-list">
                                    <?php
                                    $product = new product();
                                    $categories = $product->getAllCategory();
                                    while ($get = $categories->fetch()) :
                                        $tenloai = $get['tenloai'];
                                    ?>
                                        <li>
                                            <a href="javascript:filterProductByCategory('<?= $get['tenloai'] ?>',<?= isset($_POST['page']) ? $_POST['page'] : 1 ?>)">
                                                <?php echo $get['tenloai'] ?> - (<?php echo $get['tongSP'] ?>)
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                            <!-- Popular Posts -->
                            <div class="sidebar-widget popular-posts">
                                <div class="sidebar-title">
                                    <h2>Tin tức mới nhất</h2>
                                </div>

                                <?php
                                $news = new news();
                                $result = $news->getNewsOnePage(0, 4);
                                while ($get = $result->fetch()) :
                                ?>
                                    <article class="post">
                                        <div class="post-thumb"><a href="index.php?action=blog-detail&id=<?= $get['maTT'] ?>"><img src="assets/images/resource/<?php echo $get['anh'] ?>" alt=""></a></div>
                                        <div class="text"><a href="index.php?action=blog-detail&id=<?= $get['maTT'] ?>"><?php echo $get['tenTT'] ?></a></div>
                                        <div class="post-info">
                                            <?php
                                            $date = new DateTime($get['ngay']);
                                            $dateFix = $date->format('d/m/Y');
                                            echo $dateFix;
                                            ?>
                                        </div>
                                    </article>
                                <?php endwhile; ?>

                            </div>
                        </aside>
                    </div>

                    <div class="col-lg-9 col-md-12 col-sm-12 product-container">
                        <div class="d-flex justify-content-end">
                            <div>
                                <select class="form-control sortProductByPrice">
                                    <option value="rs">Lọc giá sản phẩm</option>
                                    <option value="az">Từ thấp đến cao</option>
                                    <option value="za">Từ cao xuống thấp</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row clearfix contentShop">                       
                            <?php include "./include/contentShop.php" ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>