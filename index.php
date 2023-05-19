<?php
include_once "Controller/a-dhModel.php";

if (isset($_GET['printPDF']) && $_GET['printPDF'] == 'printPDFInvoice') {
	include_once "View/infoInvoicePDF.php";
} else {
?>

	<!DOCTYPE html>
	<html lang="en">

	<!-- stella-orre/  30 Nov 2019 03:42:43 GMT -->

	<head>
		<meta charset="utf-8">
		<title>Furniture Shop</title>
		<!-- Stylesheets -->
		<link href="assets/css/bootstrap.css" rel="stylesheet">
		<link href="assets/css/style.css" rel="stylesheet">
		<link href="assets/css/responsive.css" rel="stylesheet">
		<link href="assets/css/fontawesome-all.css" rel="stylesheet">

		<link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
		<link rel="icon" href="assets/images/favicon.png" type="image/x-icon">

		<!-- Responsive -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<script src="https://cdn.tiny.cloud/1/e83adcy8e0z7zkydyh90kgy6ld79wf36zftett1h3argx76l/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="assets/js/jquery.js"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
	</head>

	<body>
		<div id="mainContent">
			<?php include_once "View/header.php"; ?>
			<div class="page-wrapper">

				<?php include_once "Controller/a-dhView.php"; ?>

			</div>
			<?php include_once "View/footer.php"; ?>

		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="Ajax/contact.js"></script>
		<script src="Ajax/news.js"></script>
		<script src="Ajax/shop.js"></script>
		<script src="Ajax/checkout.js"></script>
		<script src="Ajax/myAccount.js"></script>
		<script src="Ajax/register-login.js"></script>
		<script src="assets/js/test.js"></script>
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/jquery-ui.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.fancybox.js"></script>
		<script src="assets/js/isotope.js"></script>
		<script src="assets/js/owl.js"></script>
		<script src="assets/js/wow.js"></script>
		<script src="assets/js/appear.js"></script>
		<script src="assets/js/jquery.bootstrap-touchspin.js"></script>
		<script src="assets/js/scrollbar.js"></script>
		<script src="assets/js/mixitup.js"></script>
		<script src="assets/js/script.js"></script>
		<script src="js/jquery.js"></script>
		<script>
			tinymce.init({
				selector: '#contactMessage', // Chỉ định ID của phần tử textarea
				plugins: 'link lists', // Chỉ cần sử dụng các plugin cần thiết
				toolbar: 'undo redo | bold italic underline | bullist numlist | link', // Chỉ định các công cụ cần thiết
				// menubar: false, // Tắt thanh menu
				// statusbar: false, // Tắt thanh trạng thái
				width: '100%', // Đặt chiều rộng cho trình soạn thảo
				height: 300 // Đặt chiều cao cho trình soạn thảo
			});
		</script>
	</body>

	</html>
<?php } ?>