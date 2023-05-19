<?php
$product = new news();
$now = time();
if (empty($_SESSION['news_' . $_GET['id']])) {
    $_SESSION['news_' . $_GET['id']] = $_GET['id'];
    $_SESSION['timeView_' . $_GET['id']] = $now + 600;
    $view = $product->getViewNews($_GET['id']);
    $product->updateViewNews($_GET['id'], $view);
} else {
    if ($now > $_SESSION['timeView_' . $_GET['id']]) {
        unset($_SESSION['news_' . $_GET['id']]);
        unset($_SESSION['timeView_' . $_GET['id']]);
    }
}
?>
<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
    <div class="auto-container">
        <h2>Tin tức</h2>
        <ul class="page-breadcrumb">
            <li><a href="index.php?action=home">home</a></li>
            <li>Tin tức</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <?php
            $news = new news();
            $result = $news->getNewsDetail($_GET['id']);
            while ($get = $result->fetch()) {
            ?>
                <!--Content Side / Blog Classic -->
                <div class="content-side col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    <div class="blog-single padding-right">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img src="assets/images/resource/<?php echo $get['anh'] ?>" alt="">
                                </figure>
                                <span class="date"> <?php
                                                    $date = new DateTime($get['ngay']);
                                                    $dateFix = $date->format('d / m / Y');
                                                    echo $dateFix." -- Lượt xem: ".$get['luotxem'];
                                                    ?></span>
                            </div>
                            <div class="lower-content">
                                <div class="lower-box">
                                    <h3><?php echo $get['tenTT'] ?></h3>
                                    <div class="text">
                                        <p><?php echo $get['chitiet'] ?></p>
                                        <!-- <h4>Two Column Text Sample</h4> -->
                                        <div class="row clearfix">
                                            <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                            <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
                                                impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                                                assumenda est.</p>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
                                                impedit quo minus id quod maxime placeat facere possimus, omnis voluptas
                                                assumenda est.</p>
                                        </div> -->
                                        </div>
                                        <!-- <p>Here is main text quis nostrud exercitation ullamco laboris nisi here is itealic
                                        text ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit
                                        in voluptate velit esse cillum dolore eu fugiat nulla rure dolor in
                                        reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                        Excepteur sint occaecat <a href="index.php?action=404">here is link</a> cupidatat non proident,
                                        sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!--Comments có reply-->
                        <!-- <div class="comments-area">
                            <div class="group-title">
                                <h2>Comments 4</h2>
                            </div>
                            <div class="inner-box">
                                <div class="comment-box">
                                    <div class="comment">
                                        <div class="author-thumb"><img src="assets/images/resource/author-1.jpg" alt=""></div>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix"><strong>Sarah john</strong></div>
                                            <div class="text">Capitalize on low hanging fruit to identify a ballpark value
                                                added activity to beta test. Override the digital divide with additional
                                                clickthroughs from DevOps.</div>
                                            <ul class="post-info">
                                                <li>08 Feb, 2019</li>
                                                <li><a href="index.php?action=404">Reply</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="comment-box">
                                    <div class="comment">
                                        <div class="author-thumb"><img src="assets/images/resource/author-2.jpg" alt=""></div>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix"><strong>Robert john</strong></div>
                                            <div class="text">Capitalize on low hanging fruit to identify a ballpark value
                                                added activity to beta test. Override the digital divide with additional
                                                clickthroughs from DevOps.</div>
                                            <ul class="post-info">
                                                <li>08 Feb, 2019</li>
                                                <li><a href="index.php?action=404">Reply</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="comment-box">
                                    <div class="comment">
                                        <div class="author-thumb"><img src="assets/images/resource/author-1.jpg" alt=""></div>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix"><strong>Sarah john</strong></div>
                                            <div class="text">Capitalize on low hanging fruit to identify a ballpark value
                                                added activity to beta test. Override the digital divide with additional
                                                clickthroughs from DevOps.</div>
                                            <ul class="post-info">
                                                <li>08 Feb, 2019</li>
                                                <li><a href="index.php?action=404">Reply</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="comment reply-comment">
                                        <div class="author-thumb"><img src="assets/images/resource/author-2.jpg" alt=""></div>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix"><strong>Robert john</strong></div>
                                            <div class="text">Capitalize on low hanging fruit to identify a ballpark value
                                                added activity to beta test. Override the digital divide with additional
                                                clickthroughs from DevOps.</div>
                                            <ul class="post-info">
                                                <li>08 Feb, 2019</li>
                                                <li><a href="index.php?action=404">Reply</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <div class="comment-box">
                                    <div class="comment">
                                        <div class="author-thumb"><img src="assets/images/resource/author-1.jpg" alt=""></div>
                                        <div class="comment-inner">
                                            <div class="comment-info clearfix"><strong>Sarah john</strong></div>
                                            <div class="text">Capitalize on low hanging fruit to identify a ballpark value
                                                added activity to beta test. Override the digital divide with additional
                                                clickthroughs from DevOps.</div>
                                            <ul class="post-info">
                                                <li>08 Feb, 2019</li>
                                                <li><a href="index.php?action=404">Reply</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> -->
                        <!--End-->
                    </div>
                </div>
            <?php } ?>

            <!--Sidebar Side-->
            <div class="sidebar-side col-xl-3 col-lg-4 col-md-12 col-sm-12">
                <aside class="sidebar">

                    <!--Blog Category Widget-->
                    <!-- <div class="sidebar-widget sidebar-blog-category">
                        <div class="sidebar-title">
                            <h2>Categories</h2>
                        </div>
                        <ul class="cat-list">
                            <?php
                            $product = new product();

                            $result = $product->getAllCategory();
                            while ($get = $result->fetch()) {
                            ?>
                                <li><a href="index.php?action=shop"><?php echo $get['tenloai'] . " - (" . $get['tongSP'] . ")" ?></a></li>
                            <?php } ?>
                        </ul>
                    </div> -->

                    <!-- Popular Posts -->
                    <div class="sidebar-widget popular-posts">
                        <div class="sidebar-title">
                            <h2>Tin tức mới</h2>
                        </div>

                        <?php
                        $news = new news();
                        $result = $news->getNewsDetailPage(0, 4, $_GET['id']);
                        while ($get = $result->fetch()) {
                        ?>
                            <article class="post">
                                <figure class="post-thumb"><a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>"><img src="assets/images/resource/<?php echo $get['anh'] ?>" alt=""></a></figure>
                                <div class="text"><a href="index.php?action=blog-detail&id=<?php echo $get['maTT'] ?>"><?= $get['tenTT'] ?></a></div>
                                <div class="post-info">
                                    <?php
                                    $date = new DateTime($get['ngay']);
                                    $dateFix = $date->format('d / m / Y');
                                    echo $dateFix;
                                    ?>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>