function adminDeleteProduct(maSP, category, searchByName, productStatus) {
	Swal.fire({
		title: 'Ẩn sản phẩm',
		text: 'Bạn có chắc chắn muốn ẩn sản phẩm này?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Chấp nhận',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: 'Controller/ad-productList.php?act=deleteProduct',
				data: {
					maSP,
					category,
					searchByName,
					productStatus
				},
				success: function (response) {
					response = JSON.parse(response);
					const Toast = Swal.mixin({
						toast: true,
						position: 'bottom-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer);
							toast.addEventListener('mouseleave', Swal.resumeTimer);
						}
					});

					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/ad-productList.php', {
							category,
							searchByName,
							productStatus
						}, function (data) {
							$('.productList').html(data);
						});


					} else { // false								
						Toast.fire({
							icon: 'error',
							title: response.message
						});
					}
				}
			});
		}
	})
};

function adminDropProduct(maSP, category, searchByName, productStatus) {
	Swal.fire({
		title: 'Xóa vĩnh viễn sản phẩm',
		text: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Chấp nhận',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: 'Controller/ad-productList.php?act=dropProduct',
				data: {
					maSP,
					category,
					searchByName,
					productStatus
				},
				success: function (response) {
					response = JSON.parse(response);
					const Toast = Swal.mixin({
						toast: true,
						position: 'bottom-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer);
							toast.addEventListener('mouseleave', Swal.resumeTimer);
						}
					});
					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/ad-productList.php', {
							category,
							searchByName,
							productStatus
						}, function (data) {
							$('.productList').html(data);
						});
					} else { // false								
						Toast.fire({
							icon: 'error',
							title: response.message
						});
					}
				}
			});
		}
	})
};

function adminRestoreProduct(maSP, category, searchByName, productStatus) {
	Swal.fire({
		title: 'Khôi phục sản phẩm',
		text: 'Bạn có chắc chắn muốn khôi phục sản phẩm này?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Chấp nhận',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: 'Controller/ad-productList.php?act=restoreProduct',
				data: {
					maSP,
					category,
					searchByName,
					productStatus
				},
				success: function (response) {
					response = JSON.parse(response);
					const Toast = Swal.mixin({
						toast: true,
						position: 'bottom-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer);
							toast.addEventListener('mouseleave', Swal.resumeTimer);
						}
					});
					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/ad-productList.php', {
							category,
							searchByName,
							productStatus
						}, function (data) {
							$('.productList').html(data);
						});
					} else { // false								
						Toast.fire({
							icon: 'error',
							title: response.message
						});
					}
				}
			})
		}
	})
};

function adminFilterProductByCategory(category) {
	// console.log(category);
	// ẩn đi form
	const f1 = document.getElementById('f1');
	const f2 = document.getElementById('f2');
	f2.classList.remove('d-inline-block');
	f1.classList.remove('d-inline-block');
	// xóa đi nội dung của form luôn
	$('.adminSearchProductByName input[name="searchByName"]').val('');
	$('.adminSearchProductById input[name="searchById"]').val('');
	//xóa đi class của nút chọn sản phẩm ẩn hay hiện
	$('#hiddenProduct, #showProduct').removeClass('choose');
	//thực thi
	$.ajax({
		type: 'POST',
		url: 'include/ad-productList.php',
		data: {
			category
		},
		success: function (response) {
			$('.productList').html(response);
		}
	})
};

function adminFilterProductByStatus(productStatus) {
	// ẩn đi form
	const f1 = document.getElementById('f1');
	const f2 = document.getElementById('f2');
	f2.classList.remove('d-inline-block');
	f1.classList.remove('d-inline-block');
	// xóa đi nội dung của form luôn
	$('.adminSearchProductByName input[name="searchByName"]').val('');
	$('.adminSearchProductById input[name="searchById"]').val('');
	//xóa đi class của nút chọn category
	$('.categoryProduct').removeClass('choose');
	//thực thi
	$.ajax({
		type: 'POST',
		url: 'include/ad-productList.php',
		data: {
			productStatus,
		},
		success: function (response) {
			$('.productList').html(response);
		}
	})
};

function adminFilterProductDeletedByCategory(category) {
	// console.log(category);
	$.ajax({
		type: 'POST',
		url: 'include/ad-findProductDeleted.php',
		data: {
			category
		},
		success: function (response) {
			$('.findProductDeleted').html(response);
		}
	})
};

function deleteCommentProduct(maSP, idComment, rate) {
	Swal.fire({
		title: 'Ẩn bình luận',
		text: 'Bạn có chắc chắn muốn ẩn bình luận này?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Chấp nhận',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: 'Controller/ad-productList.php?act=deleteCommentProduct',
				data: {
					maSP,
					idComment,
					rate
				},
				success: function (response) {
					response = JSON.parse(response);
					const Toast = Swal.mixin({
						toast: true,
						position: 'bottom-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer);
							toast.addEventListener('mouseleave', Swal.resumeTimer);
						}
					});

					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/commentList.php', { maSP, rate }, function (data) {
							$('.commentList').html(data);
						});


					} else { // false								
						Toast.fire({
							icon: 'error',
							title: response.message
						});
					}
				}
			});
		}
	})
}

function restoreCommentProduct(maSP, idComment, rate) {
	Swal.fire({
		title: 'Khôi phục bình luận',
		text: 'Bạn có chắc chắn muốn khôi phục bình luận này?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Chấp nhận',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: 'Controller/ad-productList.php?act=restoreCommentProduct',
				data: {
					maSP,
					idComment,
					rate
				},
				success: function (response) {
					response = JSON.parse(response);
					const Toast = Swal.mixin({
						toast: true,
						position: 'bottom-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer);
							toast.addEventListener('mouseleave', Swal.resumeTimer);
						}
					});

					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/commentList.php', { maSP, rate }, function (data) {
							$('.commentList').html(data);
						});


					} else { // false								
						Toast.fire({
							icon: 'error',
							title: response.message
						});
					}
				}
			});
		}
	})
}

function dropCommentProduct(maSP, idComment, rate) {
	Swal.fire({
		title: 'Xóa vĩnh viễn bình luận',
		text: 'Bạn có chắc chắn muốn xóa vĩnh viễn bình luận này?',
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Chấp nhận',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: 'Controller/ad-productList.php?act=dropCommentProduct',
				data: {
					maSP,
					idComment,
					rate
				},
				success: function (response) {
					response = JSON.parse(response);
					const Toast = Swal.mixin({
						toast: true,
						position: 'bottom-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener('mouseenter', Swal.stopTimer);
							toast.addEventListener('mouseleave', Swal.resumeTimer);
						}
					});

					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/commentList.php', { maSP, rate }, function (data) {
							$('.commentList').html(data);
						});
					} else { // false								
						Toast.fire({
							icon: 'error',
							title: response.message
						});
					}
				}
			});
		}
	})
}

function commentByRate(rate, maSP) {
	$.ajax({
		type: 'POST',
		url: 'include/commentList.php',
		data: {
			rate,
			maSP
		},
		success: function (response) {
			$('.commentList').html(response);
		}
	})
};

$(document).ready(function () {
	$('.adminSearchProductByName').on('input', function (event) {
		event.preventDefault();
		// console.log($(this).serializeArray()[0].value);
		$('#hiddenProduct, #showProduct').removeClass('choose');
		$('.categoryProduct').removeClass('choose');
		$.ajax({
			type: 'POST',
			url: 'include/ad-productList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.productList').html(response);
			}
		})
	})

	$('.adminSearchProductById').on('input', function (event) {
		event.preventDefault();
		$('#hiddenProduct, #showProduct').removeClass('choose');
		$('.categoryProduct').removeClass('choose');
		$.ajax({
			type: 'POST',
			url: 'include/ad-productList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.productList').html(response);
			}
		})
	})

	$('.adminSearchProductByName').submit(function (event) {
		event.preventDefault();
		// Tiếp tục xử lý AJAX và các hành động khác
	});

	$('.adminSearchProductById').submit(function (event) {
		event.preventDefault();
		// Tiếp tục xử lý AJAX và các hành động khác
	});

	$('#hiddenProduct, #showProduct').click(function () {

		$('#hiddenProduct, #showProduct').removeClass('choose');

		$(this).addClass('choose');
	});

	$('.categoryProduct').click(function () {

		$('.categoryProduct').removeClass('choose');

		$(this).addClass('choose');
	});

	// sắp xếp sản phẩm từ a-z , z-a
	$('.sortProduct').on('change', function (event) {
		sortProduct = $(this).val();
		findProductByStatus = $('.btn.btn-primary.choose').data('status');
		category = $('.categoryProduct.choose').data('category');
		searchByName = $('input[name="searchByName"]').val();
		searchById = $('input[name="searchById"]').val();
		 
		// console.log(sortProduct); //null
		// console.log(findProductByStatus); //undefined
		// console.log(searchByName); //null
		// console.log(searchById); //null
		// console.log(category); //undefined

		// $.ajax({
		// 	type: 'POST',
		// 	url: 'include/ad-productList.php',
		// 	data: {
		// 		sortProduct,
		// 		findProductByStatus,
		// 		category,
		// 		searchByName,
		// 		searchById
		// 	},
		// 	success: function (response) {
		// 		$('.productList').html(response);
		// 	}
		// })


		if (category !== undefined) {
			// console.log('cateogry');
			$.ajax({
				type: 'POST',
				url: 'include/ad-productList.php',
				data: {
					category,
					sortProduct,
				},
				success: function (response) {
					$('.productList').html(response);
				}
			})
		} else if (searchByName !== '') {
			// console.log('name');
			$.ajax({
				type: 'POST',
				url: 'include/ad-productList.php',
				data: {
					searchByName,
					sortProduct
				},
				success: function (response) {
					$('.productList').html(response);
				}
			})
		} else if (searchById !== '') {
			// console.log('id');
			$.ajax({
				type: 'POST',
				url: 'include/ad-productList.php',
				data: {
					searchById,
					sortProduct
				},
				success: function (response) {
					$('.productList').html(response);
				}
			})
		} else if (findProductByStatus !== undefined) {
			// console.log('status');
			$.ajax({
				type: 'POST',
				url: 'include/ad-productList.php',
				data: {
					'productStatus': findProductByStatus,
					sortProduct
				},
				success: function (response) {
					$('.productList').html(response);
				}
			})
		} else {
			// console.log('none');
			$.ajax({
				type: 'POST',
				url: 'include/ad-productList.php',
				data: {
					sortProduct
				},
				success: function (response) {
					$('.productList').html(response);
				}
			})
		}
	})
});

