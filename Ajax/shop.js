function updateQtyProductCart(quantity, productId, index) {
	$.ajax({
		type: 'POST',
		url: 'Controller/productCart.php?act=updateProduct',
		data: {
			'soluong': quantity,
			'maSP': productId,
			'vitri': index,
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
				$.get('include/shoppingCart.php', function (data) {
					$('#myCart').html(data);
				})
			} else { // false								
				Toast.fire({
					icon: 'error',
					title: response.message
				});
				$.get('include/shoppingCart.php', function (data) {
					$('#myCart').html(data);
				})
			}
		}
	})

}

function deleteProductInCart(index) {
	Swal.fire({
		title: 'Xóa sản phẩm',
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
				url: 'Controller/productCart.php?act=deleteProduct',
				data: {
					'index': index
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
							title: 'Xóa sản phẩm thành công'
						});

						$('#cart-count').text('( ' + response.count + ' )');

						$.get('include/shoppingCart.php', function (data) {
							$('#myCart').html(data);
						});
					} else { // false								
						Toast.fire({
							icon: 'error',
							title: 'Đã có lỗi xãy ra'
						});
					}
				}
			});
		}
	})
}

function deleteAllProductCart() {
	$.ajax({
		type: 'POST',
		url: 'Controller/productCart.php?act=deleteAllProductCart',
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
				$('#cart-count').text('( ' + response.count + ' )');
				$.get('include/shoppingCart.php', function (data) {
					$('#myCart').html(data);
				})
			} else { // false								
				Toast.fire({
					icon: 'warning',
					title: response.message
				});
			}
		}
	})
}

function wishlist(maSP, id) {
	$.ajax({
		type: 'POST',
		url: 'Controller/wishlist.php',
		data: {
			'maSP': maSP,
			'id': id,
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
				$.get('include/contentShop.php', function (data) {
					$('.contentShop').html(data);
				})
			} else if (response.status == 2) { // true						
				Toast.fire({
					icon: 'warning',
					title: response.message
				});
				$.get('include/contentShop.php', function (data) {
					$('.contentShop').html(data);
				})
			} else { // false								
				Toast.fire({
					icon: 'error',
					title: response.message
				});
			}
		}
	})
}

function filterProductByCategory(category, page = 1) {
	$('#searchProductShop input[name="productSearch"]').val('');
	$.ajax({
		type: 'POST',
		url: 'include/contentShop.php',
		data: {
			category,
			page,
		},
		success: function (response) {
			$('.contentShop').html(response);
			history.pushState({
				page: page
			}, "", "?action=shop&page=" + page);
			bindAddToCartEvent();
		}
	});
}

function pageShop(page, category, productSearch, sortProductByPrice) {
	$.ajax({
		type: 'POST',
		url: 'include/contentShop.php',
		data: {
			productSearch,
			category,
			page,
			sortProductByPrice
		},
		success: function (response) {
			$('.contentShop').html(response);
			history.pushState({
				page: page
			}, "", "?action=shop&page=" + page);
			bindAddToCartEvent();
		}
	});
}

function bindAddToCartEvent() {
	$('.formAddToCartInShop').submit(function (event) {
		// console.log($(this).serializeArray());
		// console.log($(this).find('input[name="trang"]').val());
		// let trang = $(this).find('input[name="soluong"]').val();
		// console.log(trang);
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'Controller/productCart.php?act=addToCart',
			data: $(this).serializeArray(),
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
					$('#cart-count').text('( ' + response.count + ' )');
				} else { // false								
					Toast.fire({
						icon: 'warning',
						title: response.message
					});
				}
			}
		})
	})
}

function pageComment(maSP, page) {
	$.ajax({
		type: 'POST',
		url: 'include/contentComment.php',
		data: {
			maSP,
			page,
		},
		success: function (response) {
			$('.contentComment').html(response);
			history.pushState({
				maSP,
				page,
			}, "", "?action=product-detail&act=page&page=" + page + "&maSP=" + $maSP);
		}
	});
}

$(document).ready(function () {
	bindAddToCartEvent();
	$('.cat-list li a').on('click', function (event) {
		// Xóa lớp "active" từ tất cả các mục
		$('.cat-list li a').removeClass('active');

		// Thêm lớp "active" vào mục được chọn
		$(this).addClass('active')
	});

	$('#formAddToCart').submit(function (event) {
		event.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'Controller/productCart.php?act=addToCart',
			data: $(this).serializeArray(),
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
					$('#cart-count').text('( ' + response.count + ' )');
				} else { // false								
					Toast.fire({
						icon: 'warning',
						title: response.message
					});
				}
			}
		})
	})

	$('#searchProductShop').submit(function (event) {
		event.preventDefault();

		// Xóa lớp "active" từ tất cả các mục
		$('.cat-list li a').removeClass('active');

		$.ajax({
			type: 'POST',
			url: 'include/contentShop.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.contentShop').html(response);

				bindAddToCartEvent();
			}
		})
	})

	$('.sortProductByPrice').on('change', function (event) {
		event.preventDefault();
		// 
		sortProductByPrice = $(this).val();
		category = $('.cat-list li a.active').text().trim().split(" - ")[0];
		page = $('input[name="trang"]').val();
		productSearch = $('input[name="productSearch"]').val();
		console.log(sortProductByPrice);
		console.log(category);
		console.log(page);
		console.log(productSearch);
		$.ajax({
			type: 'POST',
			url: 'include/contentShop.php',
			data: {
				productSearch,
				category,
				page,
				sortProductByPrice
			},
			success: function (response) {
				$('.contentShop').html(response);
				history.pushState({
					page: page
				}, "", "?action=shop&page=" + page);
				bindAddToCartEvent();
			}
		});
		// if (category != false) {
		// 	console.log(sortProductByPrice);
		// 	console.log(category);
		// 	console.log(page);
		// 	console.log(1);
		// 	$.ajax({
		// 		type: 'POST',
		// 		url: 'include/contentShop.php',
		// 		data: {
		// 			category,
		// 			page,
		// 			sortProductByPrice
		// 		},
		// 		success: function (response) {
		// 			$('.contentShop').html(response);
		// 			history.pushState({
		// 				page: page
		// 			}, "", "?action=shop&page=" + page);
		// 			bindAddToCartEvent();
		// 		}
		// 	});
		// } else if (productSearch != '') {
		// 	console.log(sortProductByPrice);
		// 	console.log(page);
		// 	console.log(productSearch);
		// 	console.log(2);
		// 	$.ajax({
		// 		type: 'POST',
		// 		url: 'include/contentShop.php',
		// 		data: {
		// 			productSearch,
		// 			sortProductByPrice,
		// 			page,
		// 		},
		// 		success: function (response) {
		// 			$('.contentShop').html(response);
		// 			bindAddToCartEvent();
		// 		}
		// 	})
		// } else {
		// 	console.log(sortProductByPrice);
		// 	console.log(3);
		// 	$.ajax({
		// 		type: 'POST',
		// 		url: 'include/contentShop.php',
		// 		data: {
		// 			sortProductByPrice,
		// 		},
		// 		success: function (response) {
		// 			$('.contentShop').html(response);
		// 			bindAddToCartEvent();
		// 		}
		// 	});
		// }
	});

	$("textarea[name='content']").on('input', function () {
		var maxLength = 1000; // Số ký tự tối đa
		var contentLength = $(this).val().length; // Độ dài của nội dung
		var remainingLength = maxLength - contentLength; // Số ký tự còn lại

		if (remainingLength >= 0) {
			$("label span.maxlenght").text("(" + remainingLength + ")");
		} else if (remainingLength < 0) {
			$("label span.maxlenght").text("(0)");
		}
	})

	// kiểm tra bình luận
	$('#formCommentProduct').validate({
		rules: {
			content: {
				required: true,
				maxlength: 1000
			}
		},
		messages: {
			content: {
				required: 'Vui lòng nhập thông tin',
				maxlength: 'Đã vượt quá 1000 ký tự'
			},
		},
		submitHandler: function (form) {
			fname = $("input[name='fname']").val();
			lname = $("input[name='lname']").val();
			email = $("input[name='email']").val();
			maSP = $("input[name='maSP']").val();
			content = $("textarea[name='content']").val();
			rating = $("input[name='rating']:checked").val();
			if (!rating) {
				// Nếu rating chưa được chọn, thực hiện xử lý lỗi tại đây
				$(".rating-box span.ratingCheck").text("Vui lòng chọn đánh giá");
				return;
			}
			$.ajax({
				type: 'POST',
				url: 'Controller/commentProduct.php',
				data: {
					fname,
					lname,
					email,
					maSP,
					rating,
					content,
				},
				success: function (response) {
					response = JSON.parse(response); 0
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
						$.get('include/contentComment.php', { maSP }, function (data) {
							$('.contentComment').html(data);
						})
						$("textarea[name='content']").val('');
						$('input[name="rating"]').prop('checked', false);
						$(".rating-box span.ratingCheck").text('');
					} else if (response.status == 2) {
						Toast.fire({
							icon: 'warning',
							title: response.message
						});
						$.get('include/contentComment.php', { maSP }, function (data) {
							$('.contentComment').html(data);
						})
						$("textarea[name='content']").val('');
						$('input[name="rating"]').prop('checked', false);
						$(".rating-box span.ratingCheck").text('');
					}
					else { // false								
						Toast.fire({
							icon: 'error',
							title: response.message
						});
					}
				}
			})
		}
	})
});


