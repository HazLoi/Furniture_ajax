<!-- Main Slider -->
<section class="main-slider">
	<div class="slider-box">

		<!-- Banner Carousel -->
		<div class="banner-carousel owl-theme owl-carousel">
			<?php
			$product = new product();
			$a = $product->getAllHomeSlide();
			while ($homeslide = $a->fetch()) {
			?>
				<!-- Slide -->
				<div class="slide">
					<div class="image-layer" style="background-image:url(assets/images/main-slider/<?= $homeslide['anh'] ?>)"></div>
					<div class="auto-container">
						<div class="content">
							<h2 class="col-lg-8 col-md-9 col-sm-10"><?= $homeslide['tieude'] ?></h2>
							<div class="text"><?= $homeslide['noidung'] ?></div>
							<div class="btns-box">
								<a href="index.php?action=shop" class="theme-btn btn-style-one"><span class="txt"><?= $homeslide['nutbam'] ?></span></a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

	</div>
</section>
<!-- End Banner Section -->

<!-- Services Section -->
<section class="services-section">
	<div class="auto-container">
		<!-- Title Box -->
		<div class="title-box">
			<h2>Địa điểm tuyệt vời & điều giúp cải thiện <br> khám phá vẻ rạng rỡ.</h2>
		</div>

		<div class="row clearfix">
			<?php
			$x = new services();
			$result = $x->getServiceLimit(3);
			while ($row = $result->fetch()) :
			?>
				<!-- Service Block -->
				<div class="service-block col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<a href="index.php?action=residental-interior"><img src="assets/images/resource/<?php echo $row['image'] ?>" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="index.php?action=residental-interior"><?php echo $row['name'] ?></a></h3>
							<div class="text"><?php echo $row['des'] ?></div>
							<a href="index.php?action=residental-interior" class="read-more">Đọc thêm</a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>

		</div>

	</div>
</section>
<!-- End Services Section -->

<!-- Services Section Two -->
<section class="services-section-two">
	<div class="auto-container">
		<!-- Sec Title -->
		<div class="sec-title">
			<h2>Dịch vụ của chúng tôi</h2>
			<div class="text">Odes, bởi vì những nỗi buồn lớn đến với những người không biết làm thế nào để theo đuổi niềm vui với lý trí. Cũng chẳng có ai theo đuổi nỗi đau vì nó là tình yêu, mà vì họ chưa bao giờ biết theo đuổi niềm vui bằng lý trí.</div>
		</div>

		<div class="row clearfix">

			<!-- Service Block -->
			<div class="service-block-two col-lg-4 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="content">
						<div class="icon-box">
							<span class="icon flaticon-desk-1"></span>
						</div>
						<h3><a href="index.php?action=office-interior">Nội thất văn phòng</a></h3>
						<div class="text">Lorem Ipsum is simply my text of the printing and Ipsum is the Ipsum is simply.</div>
						<a href="index.php?action=office-interior" class="read-more">Chi tiết</a>
					</div>
				</div>
			</div>

			<!-- Service Block -->
			<div class="service-block-two col-lg-4 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="300ms" data-wow-duration="1500ms">
					<div class="content">
						<div class="icon-box">
							<span class="icon flaticon-house-1"></span>
						</div>
						<h3><a href="index.php?action=office-interior">Nội thất nhà ở</a></h3>
						<div class="text">Lorem Ipsum is simply my text of the printing and Ipsum is the Ipsum is simply.</div>
						<a href="index.php?action=office-interior" class="read-more">Chi tiết</a>
					</div>
				</div>
			</div>

			<!-- Service Block -->
			<div class="service-block-two col-lg-4 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="600ms" data-wow-duration="1500ms">
					<div class="content">
						<div class="icon-box">
							<span class="icon flaticon-shop"></span>
						</div>
						<h3><a href="index.php?action=office-interior">Nội thất nhà hàng</a></h3>
						<div class="text">Lorem Ipsum is simply my text of the printing and Ipsum is the Ipsum is simply.</div>
						<a href="index.php?action=office-interior" class="read-more">Chi tiết</a>
					</div>
				</div>
			</div>

			<!-- Service Block -->
			<div class="service-block-two col-lg-4 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="content">
						<div class="icon-box">
							<span class="icon flaticon-hospital"></span>
						</div>
						<h3><a href="index.php?action=office-interior">Nội thất bệnh viện</a></h3>
						<div class="text">Lorem Ipsum is simply my text of the printing and Ipsum is the Ipsum is simply.</div>
						<a href="index.php?action=office-interior" class="read-more">Chi tiết</a>
					</div>
				</div>
			</div>

			<!-- Service Block -->
			<div class="service-block-two col-lg-4 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
					<div class="content">
						<div class="icon-box">
							<span class="icon flaticon-apartment-1"></span>
						</div>
						<h3><a href="index.php?action=office-interior">Nội thất căn hộ</a></h3>
						<div class="text">Lorem Ipsum is simply my text of the printing and Ipsum is the Ipsum is simply.</div>
						<a href="index.php?action=office-interior" class="read-more">Chi tiết</a>
					</div>
				</div>
			</div>

			<!-- Service Block -->
			<div class="service-block-two col-lg-4 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInRight" data-wow-delay="600ms" data-wow-duration="1500ms">
					<div class="content">
						<div class="icon-box">
							<span class="icon flaticon-hotel"></span>
						</div>
						<h3><a href="index.php?action=office-interior">Hospitality Interior</a></h3>
						<div class="text">Lorem Ipsum is simply my text of the printing and Ipsum is the Ipsum is simply.</div>
						<a href="index.php?action=office-interior" class="read-more">Chi tiết</a>
					</div>
				</div>
			</div>

		</div>

	</div>
</section>
<!-- End Services Section Two -->

<!-- Project Section -->
<section class="project-section">
	<div class="auto-container">
		<!-- Title Box -->
		<div class="title-box">
			<h2>Dự án mới nhất của chúng tôi</h2>
		</div>
	</div>

	<div class="outer-container">

		<!--Isotope Galery-->
		<div class="sortable-masonry">

			<!--Filter-->
			<div class="filters clearfix">

				<ul class="filter-tabs filter-btns text-center clearfix">
					<li class="active filter" data-role="button" data-filter=".all">Tất cả dự án</li>
					<li class="filter" data-role="button" data-filter=".residential">Nhà ở</li>
					<li class="filter" data-role="button" data-filter=".commercial">Thương mại</li>
					<li class="filter" data-role="button" data-filter=".hospital">Khách sạn</li>
					<li class="filter" data-role="button" data-filter=".office">Văn phòng</li>
				</ul>

			</div>

			<div class="items-container row clearfix">

				<!-- Gallery Item -->
				<div class="gallery-item large-block masonry-item all hospital commercial">
					<div class="inner-box">
						<figure class="image-box">
							<img src="assets/images/gallery/1.jpg" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="index.php?action=projects-fullwidth">Modular Kitchen</a></h3>
										<a href="assets/images/gallery/1.jpg" data-fancybox="gallery-1" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
										<a href="index.php?action=projects-fullwidth" class="link"><span class="icon flaticon-unlink"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>

				<!-- Gallery Item -->
				<div class="gallery-item small-block masonry-item all hospital commercial">
					<div class="inner-box">
						<figure class="image-box">
							<img src="assets/images/gallery/2.jpg" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="index.php?action=projects-fullwidth">Modular Kitchen</a></h3>
										<a href="assets/images/gallery/2.jpg" data-fancybox="gallery-1" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
										<a href="index.php?action=projects-fullwidth" class="link"><span class="icon flaticon-unlink"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>

				<!-- Gallery Item -->
				<div class="gallery-item small-block masonry-item all residential office commercial">
					<div class="inner-box">
						<figure class="image-box">
							<img src="assets/images/gallery/3.jpg" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="index.php?action=projects-fullwidth">Modular Kitchen</a></h3>
										<a href="assets/images/gallery/3.jpg" data-fancybox="gallery-1" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
										<a href="index.php?action=projects-fullwidth" class="link"><span class="icon flaticon-unlink"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>

				<!-- Gallery Item -->
				<div class="gallery-item small-block masonry-item all commercial">
					<div class="inner-box">
						<figure class="image-box">
							<img src="assets/images/gallery/4.jpg" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="index.php?action=projects-fullwidth">Modular Kitchen</a></h3>
										<a href="assets/images/gallery/4.jpg" data-fancybox="gallery-1" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
										<a href="index.php?action=projects-fullwidth" class="link"><span class="icon flaticon-unlink"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>

				<!-- Gallery Item -->
				<div class="gallery-item large-block masonry-item all hospital office residential">
					<div class="inner-box">
						<figure class="image-box">
							<img src="assets/images/gallery/7.jpg" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="index.php?action=projects-fullwidth">Modular Kitchen</a></h3>
										<a href="assets/images/gallery/7.jpg" data-fancybox="gallery-1" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
										<a href="index.php?action=projects-fullwidth" class="link"><span class="icon flaticon-unlink"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>

				<!-- Gallery Item -->
				<div class="gallery-item small-block masonry-item all residential">
					<div class="inner-box">
						<figure class="image-box">
							<img src="assets/images/gallery/5.jpg" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="index.php?action=projects-fullwidth">Modular Kitchen</a></h3>
										<a href="assets/images/gallery/5.jpg" data-fancybox="gallery-1" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
										<a href="index.php?action=projects-fullwidth" class="link"><span class="icon flaticon-unlink"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>

				<!-- Gallery Item -->
				<div class="gallery-item small-block masonry-item all hospital office">
					<div class="inner-box">
						<figure class="image-box">
							<img src="assets/images/gallery/6.jpg" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="index.php?action=projects-fullwidth">Modular Kitchen</a></h3>
										<a href="assets/images/gallery/6.jpg" data-fancybox="gallery-1" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
										<a href="index.php?action=projects-fullwidth" class="link"><span class="icon flaticon-unlink"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>

			</div>

		</div>

		<!-- More Projects -->
		<div class="more-projects">
			<a href="index.php?action=projects" class="projects">View All Projects</a>
		</div>

	</div>
</section>
<!-- End Project Section -->

<!-- Fluid Section One -->
<section class="fluid-section-one">
	<div class="outer-container clearfix">

		<!--Content Column-->
		<div class="content-column">
			<div class="content-box">
				<h2>Thiết kế thật dễ dàng</h2>
				<div class="text">Để mang đến cho bạn một ngôi nhà bền lâu, chúng tôi chỉ mang đến cho bạn mọi thứ tốt nhất — nguyên vật liệu chất lượng, quy trình sản xuất hiện đại, kiểm tra chất lượng nghiêm ngặt, lắp đặt chuyên nghiệp và giá cả minh bạch.</div>
				<ul class="list-style-one">
					<li>Nội Thất Toàn Nhà</li>
					<li>Nhà bếp và tủ quần áo</li>
					<li>Nội thất, Decore và hơn thế nữa</li>
					<li>Post-surgery, including cosmetic, joint replacement, or heart surgery</li>
					<li>Chronic conditions, such as diabetes, COPD, or cancer</li>
					<li>On Site Expertiset</li>
				</ul>
				<div class="bold-text">Thiết kế ngôi nhà của bạn, ngay tại Furniture.vn <br> <a href="index.php?action=contact">Liên hệ với nhà thiết kế</a></div>
			</div>
		</div>

		<!--Image Column-->
		<div class="image-column" style="background-image: url(assets/images/resource/yourName.jpg)">
			<div class="inner-column">
				<div class="image">
					<img src="assets/images/resource/yourName.jpg" alt="">
				</div>
				<a href="https://www.youtube.com/watch?v=-pHfPJGatgE&list=RDwoAHwpOLmyY&index=2" class="overlay-link lightbox-image">
					<!-- <a href="https://www.youtube.com/watch?v=SXZXtD60t2g" class="overlay-link lightbox-image"> -->
					<div class="icon-box">
						<span class="icon flaticon-play-button"></span>
						<i class="ripple"></i>
					</div>
				</a>
			</div>
		</div>
		<!--End Image Column-->

	</div>
</section>

<!-- Testimonial Section -->
<section class="testimonial-section">
	<div class="auto-container">
		<!-- Sec Title -->
		<div class="sec-title-two centered">
			<h2>What our customers says</h2>
			<div class="title-text">Thousands of people done interior</div>
		</div>

		<div class="testimonial-carousel owl-carousel owl-theme">

			<!-- Testimonial Block -->
			<div class="testimonial-block">
				<div class="inner-box">
					<div class="content">
						<div class="image-outer">
							<div class="image">
								<img src="assets/images/resource/author-1.jpg" alt="" />
							</div>
						</div>
						<h3>Michale John</h3>
						<div class="title">Tôi có nội thất sang trọng từ Furnitica</div>
						<div class="text">Tôi dám khẳng định rằng những ai không biết chạy theo thú vui của lý trí sẽ phải chịu nhiều đau khổ. Cũng không có ai theo đuổi nỗi đau bởi vì nó là nỗi đau, mà bởi vì nó sẽ không bao giờ như vậy.</div>
					</div>
				</div>
			</div>

			<!-- Testimonial Block -->
			<div class="testimonial-block">
				<div class="inner-box">
					<div class="content">
						<div class="image-outer">
							<div class="image">
								<img src="assets/images/resource/author-2.jpg" alt="" />
							</div>
						</div>
						<h3>Michale John</h3>
						<div class="title">Tôi có nội thất sang trọng từ Furnitica</div>
						<div class="text">Tôi dám khẳng định rằng những ai không biết chạy theo thú vui của lý trí sẽ phải chịu nhiều đau khổ. Cũng không có ai theo đuổi nỗi đau bởi vì nó là nỗi đau, mà bởi vì nó sẽ không bao giờ như vậy.</div>
					</div>
				</div>
			</div>

			<!-- Testimonial Block -->
			<div class="testimonial-block">
				<div class="inner-box">
					<div class="content">
						<div class="image-outer">
							<div class="image">
								<img src="assets/images/resource/author-1.jpg" alt="" />
							</div>
						</div>
						<h3>Michale John</h3>
						<div class="title">Tôi có nội thất sang trọng từ Furnitica</div>
						<div class="text">Tôi dám khẳng định rằng những ai không biết chạy theo thú vui của lý trí sẽ phải chịu nhiều đau khổ. Cũng không có ai theo đuổi nỗi đau bởi vì nó là nỗi đau, mà bởi vì nó sẽ không bao giờ như vậy.</div>
					</div>
				</div>
			</div>

			<!-- Testimonial Block -->
			<div class="testimonial-block">
				<div class="inner-box">
					<div class="content">
						<div class="image-outer">
							<div class="image">
								<img src="assets/images/resource/author-2.jpg" alt="" />
							</div>
						</div>
						<h3>Michale John</h3>
						<div class="title">Tôi có nội thất sang trọng từ Furnitica</div>
						<div class="text">Tôi dám khẳng định rằng những ai không biết chạy theo thú vui của lý trí sẽ phải chịu nhiều đau khổ. Cũng không có ai theo đuổi nỗi đau bởi vì nó là nỗi đau, mà bởi vì nó sẽ không bao giờ như vậy.</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- End Testimonial Section -->

<!-- Featured Section -->
<section class="featured-section" style="background-image: url(assets/images/background/2.jpg)">
	<div class="auto-container">
		<!-- Title Box -->
		<div class="title-box">
			<h2>Quy trình làm việc của chúng tôi</h2>
		</div>

		<div class="row clearfix">

			<!-- Feature Block -->
			<div class="feature-block col-lg-3 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="icon-outer">
						<div class="icon-box">
							<span class="icon flaticon-hand-shake"></span>
						</div>
						<div class="feature-number">1</div>
					</div>
					<div class="lower-content">
						<h3><a href="index.php?action=residental-interior">Gặp gỡ khách hàng</a></h3>
						<div class="text">Tôi dám nói rằng những nỗi đau lớn là do những người không biết làm theo ý chí của lý trí.</div>
					</div>
				</div>
			</div>

			<!-- Feature Block -->
			<div class="feature-block col-lg-3 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="250ms" data-wow-duration="1500ms">
					<div class="icon-outer">
						<div class="icon-box">
							<span class="icon flaticon-answer"></span>
						</div>
						<div class="feature-number">2</div>
					</div>
					<div class="lower-content">
						<h3><a href="index.php?action=residental-interior">Thảo luận thiết kế</a></h3>
						<div class="text">Tôi dám nói rằng những nỗi đau lớn là do những người không biết làm theo ý chí của lý trí.</div>
					</div>
				</div>
			</div>

			<!-- Feature Block -->
			<div class="feature-block col-lg-3 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="500ms" data-wow-duration="1500ms">
					<div class="icon-outer">
						<div class="icon-box">
							<span class="icon flaticon-sketch"></span>
						</div>
						<div class="feature-number">3</div>
					</div>
					<div class="lower-content">
						<h3><a href="index.php?action=residental-interior">Thiết kế phát thảo</a></h3>
						<div class="text">Tôi dám nói rằng những nỗi đau lớn là do những người không biết làm theo ý chí của lý trí.</div>
					</div>
				</div>
			</div>

			<!-- Feature Block -->
			<div class="feature-block col-lg-3 col-md-6 col-sm-12">
				<div class="inner-box wow fadeInLeft" data-wow-delay="750ms" data-wow-duration="1500ms">
					<div class="icon-outer">
						<div class="icon-box">
							<span class="icon flaticon-house-1"></span>
						</div>
						<div class="feature-number">4</div>
					</div>
					<div class="lower-content">
						<h3><a href="index.php?action=residental-interior">Thực hiện</a></h3>
						<div class="text">Tôi dám nói rằng những nỗi đau lớn là do những người không biết làm theo ý chí của lý trí.</div>
					</div>
				</div>
			</div>

		</div>

	</div>
</section>
<!-- End Featured Section -->

<!-- News Section -->
<section class="news-section">
	<div class="auto-container">
		<!-- Sec Title -->
		<div class="sec-title">
			<h2>Cần một sửa chữa thiết kế? Đọc tạp chí của chúng tôi</h2>
			<div class="text">Luôn cập nhật các xu hướng mới nhất, nguồn cảm hứng, mẹo của chuyên gia, đồ tự làm và hơn thế nữa</div>
		</div>

		<div class="row clearfix">

			<!-- News Block -->
			<?php
			$news = new news();
			$result = $news->getNewsOnePage(0, 3);
			while ($get = $result->fetch()) {
			?>
				<div class="news-block col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<a href="index.php?action=blog-detail&id=<?= $get['maTT'] ?>"><img src="assets/images/resource/<?= $get['anh'] ?>" alt="" /></a>
						</div>
						<div class="lower-content">
							<ul class="post-meta">
								<li>Nội thất</li>
							</ul>
							<h3><a href="index.php?action=blog-detail">Storage ideas for the bedroom by interior designers ...</a></h3>
							<a href="index.php?action=blog-detail&id=<?= $get['maTT'] ?>" class="read-more">Chi tiết <span class="icon flaticon-right-arrow-1"></span></a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>

	</div>
</section>
<!-- End News Section -->

<!-- Call To Action Section -->
<section class="call-to-action-section" style="background-image: url(assets/images/background/1.jpg); background-size: cover;">
	<div class="auto-container">
		<h2>Hãy suy nghĩ nội thất. Nghĩ Furnitica</h2>
		<div class="text">Nội thất cho tất cả các phong cách và ngân sách, Chọn từ hàng ngàn
			mẫu thiết kế. Trái tim yêu thích của bạn vào danh sách rút gọn.</div>
		<a href="index.php?action=contact" class="theme-btn btn-style-two"><span class="txt">Liên hệ chúng tôi</span></a>
	</div>
</section>
<!-- End Call To Action Section -->

<!--Main Footer-->