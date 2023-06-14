<div class="preloader"></div>

<header class="main-header header-style-one">
	<!--Header Top-->
	<div class="header-top">
		<div class="auto-container clearfix">
			<div class="top-left clearfix">
				<div class="text"><span class="icon flaticon-call-answer"></span> Liên hệ số điện thoại : <a href="tel:093-1234-5678" class="number">093 1234 5678</a></div>

			</div>
			<div class="top-right clearfix">
				<!-- Info List -->
				<ul class="info-list">
					<li><a href="index.php?action=about">Giới thiệu</a></li>
					<li><a href="index.php?action=blog-2">Tin tức</a></li>
					<li class="quote"><a href="index.php?action=contact">Liên hệ</a></li>
				</ul>
			</div>
		</div>
	</div>
	<!-- End Header Top -->

	<!-- Header Upper -->
	<div class="header-upper">
		<div class="inner-container">
			<div class="auto-container clearfix">
				<!--Info-->
				<div class="logo-outer">
					<div class="logo mt-3"><a href="index.php?action=home"><img src="assets/images/logo-mobie.png" alt="" title=""></a></div>
				</div>

				<!--Nav Box-->
				<div class="nav-outer clearfix">
					<!--Mobile Navigation Toggler For Mobile-->
					<div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
					<nav class="main-menu navbar-expand-md navbar-light">
						<div class="navbar-header">
							<!-- Togg le Button -->
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="icon flaticon-menu-1"></span>
							</button>
						</div>

						<div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
							<ul class="navigation clearfix">
								<li class="<?php if (empty($_GET['action']) || isset($_GET['action']) && $_GET['action'] == "home") echo "current" ?>">
									<a href="index.php?action=home">Trang chủ</a>
								</li>

								<li class="<?php if (isset($_GET['action']) && $_GET['action'] == "about") echo "current" ?>">
									<a href="index.php?action=about">Giới thiệu</a>
								</li>

								<li class="<?php if (isset($_GET['action']) && $_GET['action'] == "blog" || $_GET['action'] == "blog-2") echo "current" ?>">
									<a href="index.php?action=blog-2">Tin tức</a>
								</li>

								<li class="<?php if (isset($_GET['action']) && $_GET['action'] == "shop") echo "current" ?>">
									<a href="index.php?action=shop">Cửa hàng</a>
								</li>

								<li id="cart-menu" class="<?php if (isset($_GET['action']) && $_GET['action'] == "cart-page") echo "current" ?>">
									<a href="index.php?action=cart-page">Giỏ hàng
										<sup id="cart-count">( <?= (!empty($_SESSION['productCart'])) ? count($_SESSION['productCart']) : '0' ?> )</sup>
									</a>
								</li>

								<?php if (!isset($_SESSION['id'])) { ?>
									<li class="dropdown <?php if (isset($_GET['action']) && $_GET['action'] == "login" || $_GET['action'] == "register") echo "current" ?>">
										<a href="index.php?action=login-account">Tài khoản</a>
										<ul>
											<li><a href="index.php?action=login-account">Đăng nhập</a></li>
											<li><a href="index.php?action=register-account">Đăng ký</a></li>
										</ul>
									</li>
								<?php } else { ?>
									<li class="dropdown <?php if (isset($_GET['action']) && $_GET['action'] == "myAccount") echo "current" ?>">
										<a href="index.php?action=myAccount" class="d-flex">
											<?php echo $_SESSION['fullname']; ?>
											<?php
											if (!empty($_SESSION['image'])) {
												if (strpos($_SESSION['image'], 'https') !== false) { ?>
													<div class="ml-2 rounded-circle" style="width: 35px; height: 35px; background-image: url('<?php echo $_SESSION['image'] ?>'); background-size: cover; background-position: center;"></div>
													<?php } else {
													if (isset($_SESSION['image']) && $_SESSION['image'] != '') { ?>
														<div class="ml-2 rounded-circle" style="width: 35px; height: 35px; background-image: url('assets/images/imageAccount/<?php echo $_SESSION['image'] ?>'); background-size: cover; background-position: center;"></div>
													<?php } else { ?>
														<div class="ml-2 rounded-circle" style="width: 35px; height: 35px; background-image: url('assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
												<?php }
												}
											} else { ?>
												<div class="ml-2 rounded-circle" style="width: 35px; height: 35px; background-image: url('assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
											<?php }
											?>
										</a>
										<ul>
											<li><a href="index.php?action=myAccount">Thông tin tài khoản</a></li>

											<li><a href="index.php?action=logout-account">Đăng xuất</a></li>
										</ul>
									</li>
								<?php } ?>
							</ul>
						</div>
					</nav>
					<!-- Main Menu End-->

					<!-- Outer Box -->
					<!-- <div class="outer-box clearfix">
							<div class="search-box-btn"><span class="icon flaticon-magnifying-glass-1"></span></div>
						</div> -->
				</div>
			</div>
		</div>
	</div>
	<!--End Header Upper-->

	<!-- Mobile Menu  -->
	<div class="mobile-menu">
		<div class="menu-backdrop"></div>
		<div class="close-btn"><span class="icon flaticon-cancel"></span></div>

		<nav class="menu-box">
			<div class="nav-logo"><a href="index.php?action=home"><img src="assets/images/logo-mobie.png" alt="" title=""></a></div>
			<ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
			<!--Social Links-->
			<div class="social-links">
				<ul class="clearfix">
					<li><a href="https://www.twitter.com/" target="_blank"><span class="fab fa-twitter"></span></a></li>
					<li><a href="https://www.facebook.com/" target="_blank"><span class="fab fa-facebook-square"></span></a></li>
					<li><a href="https://www.pinterest.com/" target="_blank"><span class="fab fa-pinterest-p"></span></a></li>
					<li><a href="https://www.instagram.com/" target="_blank"><span class="fab fa-instagram"></span></a></li>
					<li><a href="https://www.youtube.com/" target="_blank"><span class="fab fa-youtube"></span></a></li>
				</ul>
			</div>
		</nav>
	</div><!-- End Mobile Menu -->

</header>