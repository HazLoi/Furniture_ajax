<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
// Tạo đối tượng đọc file excel
$reader = IOFactory::createReader('Xlsx');

$admin = new admin();
$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];

$act = "admin-page";
if (!empty($_GET['act'])) {
	$act = $_GET['act'];
}

switch ($act) {
	case 'admin-page':
		include_once "View/admin-page.php";
		break;
	case 'newsType':
		if (!empty($_GET['get'])) {
			if ($_GET['get'] == 'add') {
				$validate = new validate();
				$check = $validate->checkAddNewsType($_POST['newsType']);
				if (!empty($check)) {
					$admin = new admin();
					$admin->addNewsType($_POST['newsType']);
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsType"/>';
				} else {
					include_once "View/newsType.php";
				}
			} else if ($_GET['get'] == 'edit') {
				if (!empty($_GET['id']) && intval($_GET['id']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsNewsType($_GET['id']);
					if (!empty($check)) {
						$admin = new admin();
						$getNewsTypeName = $admin->checkNewsType($_GET['id']);
						$newsTypeNameBefore = $getNewsTypeName['tenloai'];
						$newsTypeName = $getNewsTypeName['tenloai'];
						if (!empty($_POST['newsTypeName'])) {
							if (!empty($_GET['active']) && $_GET['active'] == 'edit') {
								$validate = new validate();
								$check = $validate->checkEditNewsType($_POST['newsTypeName']);
								if ($check == 1) {
									if ($newsTypeNameBefore != $_POST['newsTypeName']) {
										$checkExistsNewsTypeName = $validate->checkExistsNewsTypeName($_GET['id'], $_POST['newsTypeName']);
										if (empty($checkExistsNewsTypeName)) {
											$admin = new admin();
											$admin->editNewsType($_GET['id'], $_POST['newsTypeName']);
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsType"/>';
										} else {
											$_SESSION['newsTypeErrorEditNewsType'] = 'Tên loại đã tồn tại';
											include_once "View/newsType.php";
										}
									} else {
										$admin = new admin();
										$admin->editNewsType($_GET['id'], $_POST['newsTypeName']);
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsType"/>';
									}
								} else {
									include_once "View/newsType.php";
								}
							}
						} else {
							include_once "View/newsType.php";
						}
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsType"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsType"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsType"/>';
			}
		} else {
			include_once "View/newsType.php";
		}
		break;
	case 'productList':
		if (!empty($_GET['get']) && $_GET['get'] == 'export') {
			$export = new export();
			$export->exportDataProducts();
			// echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
		} else {
			include_once "View/productList.php";
		}
		break;
	case 'addProduct':
		if ($role == 1 || $role == 3 || $role == 4) {
			if (!empty($_GET['get'])) {
				if ($_GET['get'] == "add") {
					if (isset($_POST['productName']) && isset($_POST['category']) && isset($_POST['price']) && isset($_POST['instock']) && isset($_POST['descriptionShort']) && isset($_POST['descriptionLong']) && isset($_FILES['image']['name'])) {
						$productName = $_POST['productName'];
						$category = $_POST['category'];
						$price = $_POST['price'];
						$sale = $_POST['sale'];
						$instock = $_POST['instock'];
						$selled = $_POST['selled'];
						$rate = $_POST['rate'];
						$like = $_POST['like'];
						$descriptionShort = $_POST['descriptionShort'];
						$descriptionLong = $_POST['descriptionLong'];
						$dateSale = $_POST['dateSale'];


						$validate = new validate();
						$result = $validate->adminAddProduct($productName, $_FILES['image']['name'], $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale);

						if ($result == 1) {
							$checkExistsProductName = $validate->checkAddProductName($productName);
							if (empty($checkExistsProductName)) {
								$nameImage = preg_replace("/[^A-Za-z0-9]/", "", $_POST['productName']);
								$imageExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
								$image = $nameImage . "." . $imageExtension;

								$admin = new admin();
								$admin->addProductDatabase($productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale);

								$saveImage = new addImage();
								$saveImage->saveImageProduct($_FILES['image'], $productName);
								echo "<script> alert('Thêm sản phẩm thành công') </script>";
								echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=addProduct"/>';
							} else {
								echo "<script> alert('Tên sản phẩm đã tồn tại') </script>";
								include_once "View/addProduct.php";
							}
						}
					} else {
						$productName = '';
						$price = '';
						$sale = '';
						$instock = '';
						$selled = '';
						$rate = '';
						$like = '';
						$descriptionShort = '';
						$descriptionLong = '';
						$dateSale = '';


						$validate = new validate();
						$result = $validate->adminAddProduct($productName, '', $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale);
					}
				}
			}
			include_once "View/addProduct.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'editProduct':
		if ($role == 1 || $role == 3 || $role == 5) {
			if (!empty($_GET['maSP']) && intval($_GET['maSP']) != null) {
				$validate = new validate();
				$check = $validate->checkExistsProduct($_GET['maSP']);
				if (!empty($check)) {
					$admin = new admin();
					$result = $admin->findProductById($_GET['maSP']);
					$productName = $result['ten'];
					$categoryId = $result['loai'];
					$categoryName = $result['tenloai'];
					$instock = $result['tonkho'];
					$sale = $result['giamgia'];
					$selled = $result['giamgia'];
					$price = $result['dongia'];
					$rate = $result['danhgia'];
					$like = $result['yeuthich'];
					$descriptionShort = $result['motangan'];
					$descriptionLong = $result['mota'];
					$dateSale = $result['thoigiangiamgia'];
					$imageOld = $result['anh'];

					if (!empty($_GET['get'])) {
						if ($_GET['get'] == 'edit') {
							if (isset($_POST['productName']) && isset($_POST['price']) && isset($_POST['sale']) && isset($_POST['instock']) && isset($_POST['selled']) && isset($_POST['rate']) && isset($_POST['like']) && isset($_POST['descriptionShort']) && isset($_POST['descriptionLong']) && isset($_POST['dateSale'])) {
								$productName = $_POST['productName'];
								$category = $_POST['category'];
								$price = $_POST['price'];
								$sale = $_POST['sale'];
								$instock = $_POST['instock'];
								$selled = $_POST['selled'];
								$rate = $_POST['rate'];
								$like = $_POST['like'];
								$descriptionShort = $_POST['descriptionShort'];
								$descriptionLong = $_POST['descriptionLong'];
								$dateSale = $_POST['dateSale'];

								$validate = new validate();
								$result = $validate->adminEditProduct($productName, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale);
								if ($result == 1) {
									if (!empty($_FILES['image']['name']) && !empty($_FILES['image']['name']) != null) {

										$checkExistsProductName = $validate->checkExistsProductName($_GET['maSP'], $productName);
										if (empty($checkExistsProductName)) {
											$nameImage = preg_replace("/[^A-Za-z0-9]/", "", $_POST['productName']);
											$imageExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
											$image = $nameImage . "." . $imageExtension;

											$admin = new admin();
											$admin->editProductDatabase($_GET['maSP'], $productName, $category, $image, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale);

											$saveImage = new addImage();
											$saveImage->editImageProduct($_FILES['image'], $productName, $imageOld);
											echo "<script> alert('Cập nhật sản phẩm thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
										} else {
											echo "<script> alert('Tên sản phẩm đã tồn tại') </script>";
											include_once "View/editProduct.php";
										}
									} else {
										$checkExistsProductName = $validate->checkExistsProductName($_GET['maSP'], $productName);
										if (empty($checkExistsProductName)) {

											$admin = new admin();
											$admin->editProductDatabaseNoImage($_GET['maSP'], $productName, $category, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale);

											echo "<script> alert('Cập nhật sản phẩm thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
										} else {
											echo "<script> alert('Tên sản phẩm đã tồn tại') </script>";
											include_once "View/editProduct.php";
										}
									}
								}
							} else {
								$productName = '';
								$price = '';
								$sale = '';
								$instock = '';
								$selled = '';
								$rate = '';
								$like = '';
								$descriptionShort = '';
								$descriptionLong = '';
								$dateSale = '';

								$validate = new validate();
								$result = $validate->adminEditProduct($productName, $price, $sale, $instock, $selled, $rate, $like, $descriptionShort, $descriptionLong, $dateSale);
							}
						}
					}
					include_once "View/editProduct.php";
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'adminList':
		if ($role == 1) {
			if (!empty($_GET['get'])) {
				if ($_GET['get'] == 'export') {
					$export = new export();
					$export->exportDataAdmins();
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
				}
			}
			include_once "View/adminList.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'editAdmin':
		if ($role == 1) {
			if (!empty($_GET['id']) && intval($_GET['id']) != null) {
				$validate = new validate();
				$check = $validate->checkExistsAdmin($_GET['id']);
				if (!empty($check)) {
					$admin = new admin();
					$result = $admin->findAdminById($_GET['id']);

					$fname = $result['ho'];
					$lname = $result['ten'];
					$emailBefore = $result['email'];
					$phone = $result['sdt'];
					$roleId = $result['maQuyen'];
					$roleName = $result['quyen'];
					$birth = $result['ngaysinh'];
					$address = $result['diachi'];
					$userNameBefore = $result['tendn'];
					if (!empty($_GET['get'])) {
						if (!empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['birth']) && !empty($_POST['address']) && !empty($_POST['userName'])) {
							if ($_GET['get'] == 'edit') {
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$fname = $_POST['fname'];
								$lname = $_POST['lname'];
								$role = $_POST['role'];
								$password = $_POST['password'];
								$birth = $_POST['birth'];
								$address = $_POST['address'];
								$userName = $_POST['userName'];

								if ($emailBefore == $email) {
									$validate = new validate();
									$check = $validate->adminEditAdmin($fname, $lname, $email, $phone, $birth, $address, $userName, $userNameBefore);
									if ($check == 1) {
										$admin = new admin();
										$resultUpdate = $admin->updateAdmin($_GET['id'], $email, $phone, $fname, $lname, $role, $password, $birth, $address, $userName);
										echo "<script> alert('Cập nhật tài khoản Quản trị thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
									} else {
										include_once "View/editAdmin.php";
									}
								} else {
									$admin = new admin();
									$checkExists = $admin->existsEmailAdmin($email);
									if (empty($checkExists)) {
										$validate = new validate();
										$check = $validate->adminEditAdmin($fname, $lname, $email, $phone, $birth, $address, $userName, $userNameBefore);
										if ($check == 1) {
											$resultUpdate = $admin->updateAdmin($_GET['id'], $email, $phone, $fname, $lname, $role, $password, $birth, $address, $userName);
											echo "<script> alert('Cập nhật tài khoản Quản trị thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
										} else {
											include_once "View/editAdmin.php";
										}
									} else {
										echo "<script> alert('Email đã tồn tại') </script>";
										$_SESSION['emailErrorAdminEditAdmin'] = 'Email đã tồn tại';
										// echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
									}
								}
							}
						} else {
							$email = '';
							$phone = '';
							$fname = '';
							$lname = '';
							$birth = '';
							$address = '';
							$userName = '';

							$validate = new validate();
							$check = $validate->adminEditAdmin($fname, $lname, $email, $phone, $birth, $address, $userName, $userNameBefore);
						}
					}
					include_once "View/editAdmin.php";
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'customerList':
		if ($role == 1 || $role == 3) {
			if (!empty($_GET['get'])) {
				if ($_GET['get'] == 'export') {
					$export = new export();
					$export->exportDataCustomers();
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
				}
			}
			include_once "View/customerList.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'editCustomer':
		if ($role == 1 || $role == 3) {
			if (!empty($_GET['id']) && intval($_GET['id']) != null) {
				$validate = new validate();
				$check = $validate->checkExistsCustomer($_GET['id']);
				if (!empty($check)) {
					$admin = new admin();
					$result = $admin->findCustomerById($_GET['id']);
					$fname = $result['ho'];
					$lname = $result['ten'];
					$emailBefore = $result['email'];
					$phone = $result['sdt'];
					$address = $result['diachi'];
					$birth = $result['ngaysinh'];
					if (!empty($_GET['get'])) {
						if (!empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['address'])) {
							echo 1;
							if ($_GET['get'] == 'edit') {
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$fname = $_POST['fname'];
								$lname = $_POST['lname'];
								$password = $_POST['password'];
								$address = $_POST['address'];
								$birth = $_POST['birth'];

								$validate = new validate();
								if ($emailBefore == $email) {
									$check = $validate->adminEditCustomer($fname, $lname, $email, $phone, $address, $birth);
									if ($check == 1) {
										$admin = new admin();
										$admin->updateCustomer($_GET['id'], $email, $phone, $fname, $lname, $password, $birth, $address);
										echo "<script> alert('Cập nhật tài khoản thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
									} else {
										echo 'abc';
										die;
										include_once "View/editCustomer.php";
									}
								} else {
									$admin = new admin();
									$checkExists = $admin->existsEmailCustomer($email);
									if (empty($checkExists)) {
										$check = $validate->adminEditCustomer($fname, $lname, $email, $phone, $address, $birth);
										if ($check == 1) {
											$admin = new admin();
											$admin->updateCustomer($_GET['id'], $email, $phone, $fname, $lname, $password, $birth, $address);
											echo "<script> alert('Cập nhật tài khoản thành công') </script>";
											echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
										} else {
											echo 'def';
											die;
											include_once "View/editCustomer.php";
										}
									} else {
										echo "<script> alert('Email đã tồn tại') </script>";
									}
								}
							}
						} else {
							$email = '';
							$phone = '';
							$fname = '';
							$lname = '';
							$password = '';
							$address = '';
							$birth = '';
							$check = $validate->adminEditCustomer($fname, $lname, $email, $phone, $address, $birth);
						}
					} else {
						include_once "View/editCustomer.php";
					}
					include_once "View/editCustomer.php";
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'addCustomer':
		if ($role == 1 || $role == 3) {
			if (!empty($_GET['get']) && $_GET['get'] == 'add') {


				if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password'])) {
					$admin = new admin();
					$validate = new validate();
					$checkAddCustomer = $validate->checkAddCustomer($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password']);
					if ($checkAddCustomer == 1) {
						$firstName = $_POST['firstName'];
						$lastName = $_POST['lastName'];
						$email = $_POST['email'];
						$password = $_POST['password'];

						$insert = $admin->addCustomer($firstName, $lastName, $email, $password);

						if ($insert) {
							echo "<script> alert('Thêm tài khoản thành công') </script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=customerList"/>';
						} else {
							echo "<script> alert('Thêm tài khoản thất bại') </script>";
						}
					}
				} else {
					$firstName = '';
					$lastName = '';
					$email = '';
					$password = '';

					$validate = new validate();
					$checkAddCustomer = $validate->checkAddCustomer($firstName, $lastName, $email, $password);
				}
				include "View/addCustomer.php";
			} else {
				include "View/addCustomer.php";
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'addAdmin':
		if ($role == 1) {
			if (!empty($_GET['get']) && $_GET['get'] == 'add') {
				if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['password'])  && !empty($_POST['phone'])) {
					$admin = new admin();
					$validate = new validate();
					$checkAddAdmin = $validate->checkAddAdmin($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['phone'], $_POST['userName']);
					if ($checkAddAdmin == 1) {
						$firstName = $_POST['firstName'];
						$lastName = $_POST['lastName'];
						$email = $_POST['email'];
						$password = $_POST['password'];
						$phone = $_POST['phone'];
						$role = $_POST['role'];
						$userName = $_POST['userName'];

						$insert = $admin->addAdmin($firstName, $lastName, $email, $password, $phone, $role, $userName);
						if ($insert) {
							echo "<script> alert('Thêm tài khoản thành công') </script>";
							echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
						} else {
							echo "<script> alert('Thêm tài khoản thất bại') </script>";
						}
					}
				}
			}
			include "View/addAdmin.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'categories':
		if (!empty($_GET['get'])) {
			if ($_GET['get'] == 'add') {
				$validate = new validate();
				$check = $validate->checkAddCategory($_POST['categoryName']);
				if (!empty($check)) {
					$admin = new admin();
					$admin->addCategory($_POST['categoryName']);
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
				} else {
					include_once "View/categories.php";
				}
			} else if ($_GET['get'] == 'edit') {
				if (!empty($_GET['id']) && intval($_GET['id']) != null) {
					$validate = new validate();
					$check = $validate->checkExistsCategory($_GET['id']);
					if (!empty($check)) {
						$admin = new admin();
						$getCategoryName = $admin->getCategoryById($_GET['id']);
						$categoryName = $getCategoryName['tenloai'];
						if (!empty($_GET['active']) && $_GET['active'] == 'edit') {
							$validate = new validate();
							$check = $validate->checkEditCategory($_POST['categoryName']);
							if ($check == 1) {
								$checkExistsCategoryName = $validate->checkExistsCategoryName($_GET['id'], $_POST['categoryName']);
								if (empty($checkExistsCategoryName)) {
									$admin = new admin();
									$admin->editCategory($_GET['id'], $_POST['categoryName']);
									echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
								} else {
									$_SESSION['categoryNameErrorEditCategory'] = 'Tên loại đã tồn tại';
									include_once "View/categories.php";
								}
							} else {
								include_once "View/categories.php";
							}
						}
						include_once "View/categories.php";
					} else {
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
					}
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=categories"/>';
			}
		} else {
			include_once "View/categories.php";
		}
		break;
	case 'invoiceList':
		if (!empty($_GET['get'])) {
			if ($_GET['get'] == 'export') {
				if ($role == 1 || $role == 3) {
					$export = new export();
					$export->exportDataInfoInvoices();
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=invoiceList"/>';
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
				}
			}
		}
		include_once "View/invoiceList.php";
		break;
	case 'editInvoice':
		if ($role == 1 || $role == 3) {
			include_once "View/editInvoice.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'newsList':
		if (!empty($_GET['get'])) {
			if ($_GET['get'] == 'export') {
				if ($role == 1 || $role == 3 || $role == 4) {
					$export = new export();
					$export->exportDataNews();
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
				}
			}
		}
		include_once "View/newsList.php";
		break;
	case 'addNews':
		if ($role == 1 || $role == 3 || $role == 4) {
			if (!empty($_GET['get']) && $_GET['get'] == 'add') {
				if (!empty($_POST['title']) && !empty($_POST['date']) && !empty($_FILES['image']['name']) && !empty($_POST['contentShort']) && !empty($_POST['contentLong'])) {
					$title = $_POST['title'];
					$date = $_POST['date'];
					$image = $_FILES['image']['name'];
					$contentShort = $_POST['contentShort'];
					$contentLong = $_POST['contentLong'];
					$newsType = $_POST['newsType'];

					$validate = new validate();
					$result = $validate->checkAddNews($title, $date, $image, $contentShort, $contentLong);
					if ($result == 1) {
						$nameImage = preg_replace("/[^A-Za-z0-9]/", "", $title);
						$imageExtension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
						$imageName = $nameImage . "." . $imageExtension;

						$admin = new admin();
						$admin->addNews($title, $date, $imageName, $contentShort, $contentLong, $newsType);

						$saveImage = new addImage();
						$saveImage->saveImageNews($_FILES['image'], $title);

						echo "<script> alert('Thêm tin tức thành công') </script>";
						echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
					}
				} else {
					$title = '';
					$date = '';
					$image = '';
					$contentShort = '';
					$contentLong = '';

					$validate = new validate();
					$result = $validate->checkAddNews($title, $date, $image, $contentShort, $contentLong);
				}
			}
			include_once "View/addNews.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'editNews':
		if ($role == 1 || $role == 3 || $role == 5) {
			if (!empty($_GET['maTT']) && intval($_GET['maTT']) != null) {
				$validate = new validate();
				$check = $validate->checkExistsNews($_GET['maTT']);
				if (!empty($check)) {
					$admin = new admin();
					$result = $admin->getNewsById($_GET['maTT']);

					$title = $result['tenTT'];
					$content = $result['noidung'];
					$detail = $result['chitiet'];
					$date = $result['ngay'];
					$newsType = $result['loai'];

					if (!empty($_GET['get'])) {
						if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['detail']) && !empty($_POST['date'])) {
							if ($_GET['get'] == 'edit') {
								$title = $_POST['title'];
								$content = $_POST['content'];
								$detail = $_POST['detail'];
								$date = $_POST['date'];
								$newsType = $_POST['newsType'];

								$validate = new validate();
								$check = $validate->checkEditNews($title, $date, $content, $detail);
								if ($check == 1) {
									if (!empty($_FILES['image']['name']) && !empty($_FILES['image']['name']) != null) {
										$code = '';
										$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
										$charactersLength = strlen($characters);
										$codeLength = 8;
										for ($i = 0; $i < $codeLength; $i++) {
											$code .= $characters[rand(0, $charactersLength - 1)];
										}
										$imageExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
										$saveImageName = $code . "." . $imageExtension;

										$admin = new admin();
										$admin->editNews($_GET['maTT'], $title, $date, $saveImageName, $content, $detail, $newsType);

										$saveImage = new addImage();
										$saveImage->saveImageNews($_FILES['image'], $code);
										// echo "<script> alert('Cập nhật tin tức thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
									} else {
										$admin->editNewsNoImage($_GET['maTT'], $title, $date, $content, $detail, $newsType);
										// echo "<script> alert('Cập nhật tin tức thành công') </script>";
										echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
									}
								} else {
									include_once "View/editNews.php";
								}
							}
						} else {
							$title = '';
							$content = '';
							$detail = '';
							$date = '';

							$validate = new validate();
							$check = $validate->checkEditNews($title, $date, $content, $detail);
						}
					}
					include_once "View/editNews.php";
				} else {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
				}
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=newsList"/>';
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'commentList':
		if (!empty($_GET['maSP']) && intval($_GET['maSP']) != null) {
			include_once "View/commentList.php";
		} else {
			echo "<script> alert('Sản phẩm không tồn tại') </script>";
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
		}
		break;
	case 'thongke':
		if ($role == 1 || $role == 3) {
			include_once "View/thongke.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'contactList':
		if (!empty($_GET['get'])) {
			if ($_GET['get'] == 'export') {
				$export = new export();
				$export->exportDataContacts();
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=contactList"/>';
			}
		}
		include_once "View/contactList.php";

		break;
	case 'repContact':
		if ($role != 2) {
			if (!empty($_GET['maLH']) && intval($_GET['maLH']) != '') {
				$admin = new admin();
				$info = $admin->getInfoContact($_GET['maLH']);
				$author = $info['tacgia'];
				$email = $info['email'];
				$subject = $info['chude'];
				$content = $info['noidung'];
				include_once "View/repContact.php";
			} else {
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'importProducts':
		if ($role == 1 || $role == 3) {
			// echo "<pre>";
			// print_r($_FILES);
			// echo "</pre>";
			// die;
			$file = $_FILES['fileImport']['name'];
			$extension = pathinfo($file, PATHINFO_EXTENSION);
			if ($extension !== 'xlsx') {
				echo "<script>alert('Đây không phải là file excel')</script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
			} else {

				// Đọc file excel
				$spreadsheet = $reader->load($_FILES['fileImport']['tmp_name']);

				// Chọn sheet cần đọc dữ liệu
				$worksheet = $spreadsheet->getActiveSheet();

				// Lấy số dòng và số cột
				$rowCount = $worksheet->getHighestRow();
				$columnCount = $worksheet->getHighestColumn();

				// Khởi tạo mảng chứa dữ liệu
				$data = array();

				// Đọc dữ liệu từ sheet
				for ($row = 2; $row <= $rowCount; $row++) {
					$productImage = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$productName = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$category = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$price = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$instock = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$descriptionShort = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$descriptionLong = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

					// Thêm dữ liệu vào mảng
					$data[] = array(
						'productImage' => $productImage,
						'productName' => $productName,
						'category' => $category,
						'price' => $price,
						'instock' => $instock,
						'descriptionShort' => $descriptionShort,
						'descriptionLong' => $descriptionLong,
					);
				}

				// In ra mảng dữ liệu
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
				// die;

				$check = 0;
				$admin = new admin();
				foreach ($data as $key => $item) {
					$getCategoryByName = $admin->getCategoryByName($item['category']);
					if ($getCategoryByName) {
						$categoryId = $getCategoryByName['maLoai'];
						$validate = new validate();
						$check = $validate->checkAddProductName($item['productName']);
						//Kiểm tra tên tồn tại
						if (empty($check)) {
							$result = $admin->importProducts($item['productImage'], $item['productName'], $categoryId, $item['price'], $item['instock'], $item['descriptionShort'], $item['descriptionLong']);
							if ($result) {
								$check += 1;
							} else {
								$check -= 1;
							}
						} else {
							$ten = $item['productName'];
							echo "<script>alert('$ten đã tồn tại')</script>";
							break;
						}
					} else {
						echo "<script>alert('Tên loại: {$item['category']} đã bị xóa hoặc không tồn tại ở vị trí $key')</script>";
						break;
					}
				}
				// thêm thành công - thất bại
				if ($check > 0) {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
				} else {
					echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=productList"/>';
				}
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'importAdmin':
		if ($role == 1) {
			// echo "<pre>";
			// print_r($_FILES);
			// echo "</pre>";
			// die;
			$file = $_FILES['fileImport']['name'];
			$extension = pathinfo($file, PATHINFO_EXTENSION);
			if ($extension !== 'xlsx') {
				echo "<script>alert('Đây không phải là file excel')</script>";
				echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
			} else {

				// Đọc file excel
				$spreadsheet = $reader->load($_FILES['fileImport']['tmp_name']);

				// Chọn sheet cần đọc dữ liệu
				$worksheet = $spreadsheet->getActiveSheet();

				// Lấy số dòng và số cột
				$rowCount = $worksheet->getHighestRow();
				$columnCount = $worksheet->getHighestColumn();

				// Khởi tạo mảng chứa dữ liệu
				$data = array();

				// Đọc dữ liệu từ sheet
				for ($row = 2; $row <= $rowCount; $row++) {
					$fname = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$lname = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$email = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$password = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$phone = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$role = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

					// Thêm dữ liệu vào mảng
					$data[] = array(
						'fname' => $fname,
						'lname' => $lname,
						'email' => $email,
						'password' => $password,
						'phone' => $phone,
						'role' => $role,
					);
				}

				// In ra mảng dữ liệu
				// echo "<pre>";
				// print_r($data);
				// echo "</pre>";
				// die;

				$check = 0;
				$admin = new admin();
				foreach ($data as $key => $item) {
					$getRoleByName = $admin->getRoleByName($item['role']);
					if ($getRoleByName) {
						$roleId = $getRoleByName['maQuyen'];

						$check = $admin->existsEmailAdmin($item['email']);
						//Kiểm tra tên tồn tại
						if (empty($check)) {
							$result = $admin->importAdmin($item['fname'], $item['lname'], $item['email'], $item['password'], $item['phone'], $roleId);
							if ($result) {
								$check += 1;
							} else {
								$check -= 1;
							}
						} else {
							$a = $item['email'];
							echo "<script>alert('$a đã tồn tại ở vị trí $key')</script>";
							break;
						}
					} else {
						echo "<script>alert('Quyền: {$item['role']} đã bị xóa hoặc không tồn tại ở vị trí $key')</script>";
						break;
					}
				}
				// thêm thành công - thất bại
				if ($check > 0) {
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
				} else {
					echo "<script>alert('Có lỗi đã xãy ra trong quá trình xử lý')</script>";
					echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=adminList"/>';
				}
			}
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	case 'notifyList':
		if ($role == 1) {
			include_once "View/notifyList.php";
		} else {
			echo '<meta http-equiv="refresh" content="0; url=./index.php?action=admin-page&act=404"/>';
		}
		break;
	default:
		include_once "View/404.php";
		break;
}
