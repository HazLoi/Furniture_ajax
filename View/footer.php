<style>
	.fab-wrapper {
		position: fixed;
		bottom: 3rem;
		left: 3rem;
		transform: scaleX(-1);
		z-index: 9999;
	}

	.fab-checkbox {
		display: none;
	}

	.fab1 {
		position: absolute;
		bottom: -1rem;
		right: -1rem;
		width: 3rem;
		height: 3rem;
		background: blue;
		border-radius: 50%;
		background: #126ee2;
		box-shadow: 0px 5px 20px #81a4f1;
		transition: all 0.3s ease;
		z-index: 1;
		border-bottom-right-radius: 6px;
		border: 1px solid #0c50a7;
	}

	.fab1:before {
		content: "";
		position: absolute;
		width: 100%;
		height: 100%;
		left: 0;
		top: 0;
		border-radius: 50%;
		background-color: rgba(255, 255, 255, 0.1);
	}

	.fab-checkbox:checked~.fab:before {
		width: 90%;
		height: 90%;
		left: 5%;
		top: 5%;
		background-color: rgba(255, 255, 255, 0.2);
	}

	.fab1:hover {
		background: #2c87e8;
		box-shadow: 0px 5px 20px 5px #81a4f1;
	}

	.fab-dots {
		position: absolute;
		height: 4px;
		width: 4px;
		background-color: white;
		border-radius: 50%;
		top: 50%;
		transform: translateX(0%) translateY(-50%) rotate(0deg);
		opacity: 1;
		animation: blink 3s ease infinite;
		transition: all 0.3s ease;
	}

	.fab-dots-1 {
		left: 15px;
		animation-delay: 0s;
	}

	.fab-dots-2 {
		left: 50%;
		transform: translateX(-50%) translateY(-50%);
		animation-delay: 0.4s;
	}

	.fab-dots-3 {
		right: 15px;
		animation-delay: 0.8s;
	}

	.fab-checkbox:checked~.fab .fab-dots {
		height: 6px;
	}

	.fab1 .fab-dots-2 {
		transform: translateX(-50%) translateY(-50%) rotate(0deg);
	}

	.fab-checkbox:checked~.fab .fab-dots-1 {
		width: 32px;
		border-radius: 10px;
		left: 50%;
		transform: translateX(-50%) translateY(-50%) rotate(45deg);
	}

	.fab-checkbox:checked~.fab .fab-dots-3 {
		width: 32px;
		border-radius: 10px;
		right: 50%;
		transform: translateX(50%) translateY(-50%) rotate(-45deg);
	}

	@keyframes blink {
		50% {
			opacity: 0.25;
		}
	}

	.fab-checkbox:checked~.fab .fab-dots {
		animation: none;
	}

	.fab-wheel {
		position: absolute;
		bottom: 0;
		right: 0;
		width: 10rem;
		height: 10rem;
		transition: all 0.3s ease;
		transform-origin: bottom right;
		transform: scale(0);
	}

	.fab-checkbox:checked~.fab-wheel {
		transform: scale(1);
	}

	.fab-action {
		position: absolute;
		background: #0f1941;
		width: 3rem;
		height: 3rem;
		border-radius: 50%;
		display: flex;
		align-items: center;
		justify-content: center;
		color: White;
		box-shadow: 0 0.1rem 1rem rgba(24, 66, 154, 0.82);
		transition: all 1s ease;
		transform: scaleX(-1);

		opacity: 0;
	}

	.fab-checkbox:checked~.fab-wheel .fab-action {
		opacity: 1;
	}

	.fab-action:hover {
		background-color: #f16100;
	}

	.fab-wheel .fab-action-1 {
		right: -1rem;
		top: 0;
	}

	.fab-wheel .fab-action-2 {
		right: 3.4rem;
		top: 0.5rem;
	}

	.fab-wheel .fab-action-3 {
		left: 0.5rem;
		bottom: 3.4rem;
	}

	.fab-wheel .fab-action-4 {
		left: 0;
		bottom: -1rem;
	}
</style>
<footer class="main-footer">
	<div class="auto-container">
		<!--Widgets Section-->
		<div class="widgets-section">
			<div class="row clearfix">

				<!--big column-->
				<div class="big-column col-lg-6 col-md-12 col-sm-12">
					<div class="row clearfix">

						<!--Footer Column-->
						<div class="footer-column col-lg-7 col-md-6 col-sm-12">
							<div class="footer-widget logo-widget">
								<div class="logo">
									<a href="index.php?action=home"><img src="assets/images/logo-mobie.png" alt="" /></a>
								</div>
								<div class="text">Stella Orr'e is a WordPress theme to build Interior websites. It has good features and you will love.</div>
								<ul class="social-icons">
									<li><a href="https://www.facebook.com/" target="_blank"><span class="fab fa-facebook-f"></span></a></li>
									<li><a href="https://www.instagram.com/" target="_blank"><span class="fab fa-linkedin-in"></span></a></li>
									<li><a href="https://www.twitter.com/" target="_blank"><span class="fab fa-twitter"></span></a></li>
									<li><a href="https://www.google.com/" target="_blank"><span class="fab fa-google-plus-g"></span></a></li>
								</ul>
							</div>
						</div>

						<!--Footer Column-->
						<div class="footer-column col-lg-5 col-md-6 col-sm-12">
							<div class="footer-widget links-widget">
								<h2>Quick links</h2>
								<div class="widget-content">
									<ul class="list">
										<li><a href="index.php?action=404">About Gaille</a></li>
										<li><a href="index.php?action=404">Privacy Policy</a></li>
										<li><a href="index.php?action=404">Terms & Conditionis</a></li>
										<li><a href="index.php?action=404">Faq</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>

				<!--big column-->
				<div class="big-column col-lg-6 col-md-12 col-sm-12">
					<div class="row clearfix">

						<!--Footer Column-->
						<div class="footer-column col-lg-5 col-md-6 col-sm-12">
							<div class="footer-widget contact-widget">
								<h2>Contact Info</h2>
								<div class="widget-content">
									<a href="tel:1800-574-9687" class="contact-number">(1800) 574 9687</a>
									<ul>
										<li>256, Stella Orr'e, New York 24</li>
										<li>Email :<a href="mailto:info@stellaorre.com"> info@stellaorre.com</a></li>
									</ul>
								</div>
							</div>
						</div>

						<!--Footer Column-->
						<div class="footer-column col-lg-7 col-md-6 col-sm-12">
							<div class="footer-widget newsletter-widget">
								<h2>Newsletter</h2>
								<div class="text">Nhận ưu đãi và giảm giá đặc biệt</div>
								<!-- Newsletter Form -->
								<div class="newsletter-form">
									<form method="post" action="index.php?action=subscribe">
										<div class="form-group">
											<input type="email" name="email" value="" placeholder="Nhập email của bạn">
											<button type="submit" class="theme-btn btn-style-one"><span class="txt">Đăng ký</span></button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>

		<!--Footer Bottom-->
		<div class="footer-bottom clearfix">
			<div class="pull-left">
				<div class="copyright"><a href="index.php?action=home">Furniture Shop</a></div>
			</div>
			<div class="pull-right">
				<a href="index.php?action=home">Furniture Shop</a>
			</div>
		</div>
	</div>

	<div class="fab-wrapper">
		<input id="fabCheckbox" type="checkbox" class="fab-checkbox" />
		<label class="fab1" for="fabCheckbox">
			<span class="fab-dots fab-dots-1"></span>
			<span class="fab-dots fab-dots-2"></span>
			<span class="fab-dots fab-dots-3"></span>
		</label>
		<div class="fab-wheel">
			<a class="fab-action fab-action-1" href="https://m.me/100050132470694" target="_blank" title="Liên hệ qua message">
				<i style="font-size: 25px" class="fab fa-facebook-messenger text-white"></i>
			</a>
			<a class="fab-action fab-action-2" href="mailto:otakushi02@gmail.com" target="_blank" title="Liên hệ qua email">
				<i style="font-size: 20px" class="fa fa-envelope text-white"></i>
			</a>
			<a class="fab-action fab-action-3" href="https://www.youtube.com/" target="_blank" title="Liên hệ qua youtube">
				<i style="font-size: 20px" class="fab fa-youtube text-white"></i>
			</a>
			<a class="fab-action fab-action-4" href="https://m.me/100050132470694" target="_blank" title="Liên hệ qua twitter">
				<i style="font-size: 20px" class="fab fa-twitter text-white"></i>
			</a>
		</div>
	</div>

</footer>


<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>