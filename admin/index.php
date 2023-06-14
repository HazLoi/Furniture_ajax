<?php
include_once "Controller/a-dhModel.php";
include_once 'vendor/autoload.php';

if (isset($_GET['export']) && $_GET['export'] != '') {
	$export = new export();
	switch ($_GET['export']) {
		case 'admin':
			$export->exportDataAdmins();
			break;
		case 'customer':
			$export->exportDataCustomers();
			break;
		case 'product':
			$export->exportDataProducts();
			break;
		case 'invoice':
			$export->exportDataInfoInvoices();
			break;
		case 'news':
			$export->exportDataNews();
			break;
		case 'contact':
			$export->exportDataContacts();
			break;
	}
} else {
?>

	<!DOCTYPE html>
	<html lang="en">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Admin Furniture Shop</title>

		<!-- Custom fonts for this template-->

		<!-- <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<!-- Custom styles for this template-->
		<link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
		<!-- bootstrap 4 -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://cdn.tiny.cloud/1/hua105m6e502u4v9yv22xm69hndxltgb4sptvmumkiguh052/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	</head>

	<body id="page-top">

		<div id="wrapper">
			<?php
			if (!empty($_SESSION['id_admin']) && $_SESSION['id_admin'] != '') {
				include_once 'View/sidebarAdmin.php';
			?>
				<!-- Content Wrapper -->
				<div id="content-wrapper" class="d-flex flex-column">
					<!-- Main Content -->
					<div id="content">
						<?php
						include_once 'View/navbarAdmin.php';
						?>
						<div class="container-fluid">
							<?php
							include_once 'Controller/a-dhView.php';
							?>
						</div>
					</div>
				</div>
			<?php } else { ?>
				<!-- Content Wrapper -->
				<div id="content-wrapper" class="d-flex flex-column" style="background-color: white">
					<!-- Main Content -->
					<div id="content">
						<?php
						include_once 'View/login.php';
						?>
					</div>
				</div>
			<?php } ?>
		</div>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="Ajax/export.js"></script>
		<script src="Ajax/thongkedoanhthu.js"></script>
		<script src="Ajax/changePassword.js"></script>
		<script src="Ajax/ad-notifyList.js"></script>
		<script src="Ajax/ad-contact.js"></script>
		<script src="Ajax/ad-login.js"></script>
		<script src="Ajax/ad-categoryList.js"></script>
		<script src="Ajax/ad-productList.js"></script>
		<script src="Ajax/ad-adminList.js"></script>
		<script src="Ajax/ad-customerList.js"></script>
		<script src="Ajax/ad-invoiceList.js"></script>
		<script src="Ajax/ad-newsList.js"></script>
		<script src="assets/js/test.js"></script>
		<!-- Bootstrap core JavaScript-->
		<!-- <script src="assets/vendor/jquery/jquery.min.js"></script> -->
		<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

		<!-- Core plugin JavaScript-->
		<!-- <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script> -->

		<!-- Custom scripts for all pages-->
		<script src="assets/js/sb-admin-2.min.js"></script>

		<!-- Page level plugins -->
		<script src="assets/vendor/chart.js/Chart.min.js"></script>

		<!-- Page level custom scripts -->
		<script src="assets/js/demo/chart-area-demo.js"></script>
		<script src="assets/js/demo/chart-pie-demo.js"></script>
		<script>
			tinymce.init({
				selector: '#description',
				plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker  permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
				toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
				tinycomments_mode: 'embedded',
				tinycomments_author: 'Author name',
				mergetags_list: [{
						value: 'First.Name',
						title: 'First Name'
					},
					{
						value: 'Email',
						title: 'Email'
					},
				],
				width: '100%', // Đặt chiều rộng cho trình soạn thảo
				height: 400 // Đặt chiều cao cho trình soạn thảo
			});
			tinymce.init({
				selector: '#noteInvoice', // Chỉ định ID của phần tử textarea
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