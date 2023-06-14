    <!--Page Title-->
    <section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
    	<div class="auto-container">
    		<h2>Liên hệ</h2>
    		<ul class="page-breadcrumb">
    			<li><a href="index.php?action=home">home</a></li>
    			<li>Liên hệ</li>
    		</ul>
    	</div>
    </section>
    <!--End Page Title-->

    <!-- Contact Form Section -->
    <section class="contact-form-section" style="background-image:url(assets/images/background/contact.png)">
    	<div class="auto-container">
    		<!-- Sec Title -->
    		<div class="sec-title">
    			<h2>Liên hệ</h2>
    			<!-- <div class="text">Do you have anything in your mind to let us know? Kindly don't delay to connect to us by means of our contact form.</div> -->
    			<div class="text">Bạn có bất cứ điều gì cần giải đáp? Vui lòng đừng chậm trễ để kết nối với chúng tôi bằng biểu mẫu liên hệ của chúng tôi.</div>
    		</div>

    		<div class="row clearfix">

    			<!-- Form Column -->
    			<div class="form-column col-lg-7 col-md-12 col-sm-12">
    				<div class="inner-column">

    					<!-- Contact Form -->
    					<div class="contact-form">

    						<!--Contact Form-->
    						<form method="post" class="formContact">
    							<?php if (isset($_SESSION['id']) && $_SESSION['id'] != '') { ?>
    								<div class="row clearfix">
    									<div class="form-group col-lg-6 col-md-6 col-sm-12">
    										<input type="text" name="fullname" placeholder="Tên của bạn" value="<?php echo $_SESSION['fullname'] ?>" autocomplete="off" spellcheck="false" readonly>
    									</div>

    									<div class="form-group col-lg-6 col-md-6 col-sm-12">
    										<input type="text" name="email" placeholder="Địa chỉ email" value="<?php echo $_SESSION['email'] ?>" autocomplete="off" spellcheck="false" readonly>
    									</div>

    									<div class="form-group col-lg-12 col-md-12 col-sm-12">
    										<input type="text" name="subject" placeholder="Chủ đề" autocomplete="off" spellcheck="false">
    									</div>

    									<div class="form-group col-lg-12 col-md-12 col-sm-12">
    										<textarea name="message" id="contactMessage" placeholder="Nội dung" autocomplete="off" spellcheck="false"></textarea>
    									</div>

    									<div class="form-group col-lg-12 col-md-12 col-sm-12">
    										<button class="theme-btn btn-style-one" name="submit-form"><span class="txt">Gửi</span></button>
    									</div>
    								</div>
    							<?php } else { ?>
    								<div class="row clearfix">
    									<div class="form-group col-lg-6 col-md-6 col-sm-12">
    										<input type="text" name="fullname" placeholder="Tên của bạn" autocomplete="off" spellcheck="false">
    									</div>

    									<div class="form-group col-lg-6 col-md-6 col-sm-12">
    										<input type="text" name="email" placeholder="Địa chỉ email" autocomplete="off" spellcheck="false">
    									</div>

    									<div class="form-group col-lg-12 col-md-12 col-sm-12">
    										<input type="text" name="subject" placeholder="Chủ đề" autocomplete="off" spellcheck="false">
    									</div>

    									<div class="form-group col-lg-12 col-md-12 col-sm-12">
    										<textarea name="message" id="contactMessage" placeholder="Nội dung" autocomplete="off" spellcheck="false"></textarea>
    									</div>

    									<div class="form-group col-lg-12 col-md-12 col-sm-12">
    										<button class="theme-btn btn-style-one" name="submit-form"><span class="txt">Gửi</span></button>
    									</div>
    								</div>
    							<?php } ?>
    						</form>
    					</div>

    				</div>
    			</div>

    			<!-- Info Column -->
    			<div class="info-column col-lg-5 col-md-12 col-sm-12">
    				<div class="inner-column">

    					<!-- Contact Info List -->
    					<ul class="contact-info-list">
    						<li><strong>Địa chỉ :</strong><br>12 Trịnh Đình Thảo, Hòa Thạnh, Tân Phú, TP.HCM</li>
    					</ul>
    					<!-- Contact Info List -->
    					<ul class="contact-info-list">
    						<li><strong>Số điện thoại : </strong><a href="tel:1800-456-7890">0937 1234 5678</a></li>
    						<li><strong>Email : </strong><a href="mailto:info@stellaorre.com">furniture.shop@gmail.com</a></li>
    					</ul>
    					<!-- Contact Info List -->
    					<ul class="contact-info-list">
    						<li><strong>Giờ mở cửa :</strong><br>8:00 AM - 10:00 PM <br> Thứ 2 - C.Nhật</li>
    					</ul>

    				</div>
    			</div>

    		</div>

    	</div>
    </section>
    <!-- End Contact Form Section -->

    <!-- Map Section -->
    <section class="map-section">
    	<div class="outer-container">
    		<div class="map-outer">
    			<!-- <div class="map-canvas" data-zoom="12" data-lat="-37.817085" data-lng="144.955631" data-type="roadmap" data-hue="#ffc400" data-title="Melbourne Australia" data-icon-path="assets/images/icons/map-marker.png" data-content="(1800) 456 7890 <br> Mon-Sat: 7.00an - 9.00pm">
    			</div> -->
    			<iframe class="map-canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.0001868574354!2d106.69188487580776!3d10.811296858547967!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317528ea076991ff%3A0x4967dfded5b5b97d!2zMjMgVMSDbmcgQuG6oXQgSOG7lSwgUGjGsOG7nW5nIDExLCBCw6xuaCBUaOG6oW5oLCBUaMOgbmggcGjhu5EgSOG7kyBDaMOtIE1pbmgsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1682320931688!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    		</div>
    	</div>
    </section>
    <!-- End Map Section -->