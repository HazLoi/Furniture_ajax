<!--Page Title-->
<section class="page-title" style="background-image:url(assets/images/background/5.jpg)">
	<div class="auto-container">
		<h2>Services</h2>
		<ul class="page-breadcrumb">
			<li><a href="index.php?action=home">home</a></li>
			<li>Services 2</li>
		</ul>
	</div>
</section>
<!--End Page Title-->

<!-- Services Page Section -->
<section class="services-page-section style-two">
	<div class="auto-container">

		<!-- Sec Title -->
		<div class="sec-title centered">
			<h2>We Provide Different Services In Interior Field</h2>
			<div class="text">Survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple.</div>
		</div>

		<div class="row clearfix">
			<?php
			$services = new services();

			$result = $services->getServiceLimit(10);

			while ($row = $result->fetch()) :
			?>
				<!-- Service Block -->
				<div class="service-block-three style-two col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<a href="index.php?action=residental-interior"><img src="assets/images/resource/<?php echo $row['image'] ?>" alt="" /></a>
						</div>
						<div class="lower-content">
							<h3><a href="index.php?action=residental-interior"><?php echo $row['name'] ?></a></h3>
							<div class="text"><?php echo $row['des'] ?></div>
							<a href="index.php?action=residental-interior" class="read-more">Read more</a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

	</div>
</section>
<!-- End Story Section -->