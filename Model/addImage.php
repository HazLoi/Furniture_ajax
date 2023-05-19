<?php

class addImage
{
	public function saveImageProduct($image, $tensp)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		$tensp = preg_replace("/[^A-Za-z0-9]/", "", $tensp);
		$saveImageMain = $tensp . "." . $imageExtension;

		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = 'assets/images/product/' . $saveImageMain;

			move_uploaded_file($imageTempName, $imageDestination);
		}

		return $validImage;
	}

	public function saveImageReturnProduct($image, $saveImageName)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = '../assets/images/returnProduct/' . $saveImageName;

			move_uploaded_file($imageTempName, $imageDestination);
		}

		return $validImage;
	}

	public function editImageProduct($image, $tensp, $imageOld)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		$tensp = preg_replace("/[^A-Za-z0-9]/", "", $tensp);
		$saveImageMain = $tensp . "." . $imageExtension;

		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = 'assets/images/product/' . $saveImageMain;
			$imageDestination1 = 'assets/images/product/' . $imageOld;

			// Xóa ảnh sản phẩm cũ (nếu tồn tại)
			if (file_exists($imageDestination1)) {
				unlink($imageDestination1);
			}

			move_uploaded_file($imageTempName, $imageDestination);
		}

		return $validImage;
	}

	public function saveImageNews($image, $newsName)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		$newsName = preg_replace("/[^A-Za-z0-9]/", "", $newsName);
		$saveImageMain = $newsName . "." . $imageExtension;
		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = 'assets/images/resource/' . $saveImageMain;
			move_uploaded_file($imageTempName, $imageDestination);
		}


		return $validImage;
	}

	public function addImageAccount($image, $nameImageAccount, $nameImageAccountOld)
	{
		$imageName = $image['name'];
		$imageType = $image['type'];
		$imageTempName = $image['tmp_name'];
		$imageError = $image['error'];
		$imageSize = $image['size'];

		// Validate the image
		$validImage = true;
		if ($imageError !== 0) {
			$validImage = false;
		}
		//kiểm tra kích thước ảnh
		if ($imageSize > 500000) {
			$validImage = false;
		}
		//kiểm tra đuôi ảnh
		$imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		if (!in_array($imageExtension, $allowedExtensions)) {
			$validImage = false;
		}

		// Move the image to the folder if it is valid
		if ($validImage) {
			$imageDestination = 'assets/images/imageAccount/' . $nameImageAccount;

			$imageDestination1 = 'assets/images/imageAccount/' . $nameImageAccountOld;

			// Xóa ảnh sản phẩm cũ (nếu tồn tại)
			if (!empty($nameImageAccountOld) && file_exists($imageDestination1)) {
				unlink($imageDestination1);
			}

			move_uploaded_file($imageTempName, $imageDestination);
		}

		return $validImage;
	}
}
