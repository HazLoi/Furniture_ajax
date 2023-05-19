<?php
include_once 'a-dhAjax.php';

$user = new user();
$insertReturnProduct = $user->insertReturnProduct($_POST['maHD'], $_POST['maSP'], $_SESSION['id'], $_FILES['image']['name'], $_POST['content'], $_FILES['image']);

	

