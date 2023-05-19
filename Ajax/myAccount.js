function deleteInvoice(invoiceId, status) {
	Swal.fire({
		title: 'Hủy đơn hàng',
		text: 'Bạn có chắc chắn muốn hủy đơn này?',
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
				url: 'Controller/myAccount.php?act=deleteInvoice',
				data: {
					'id': invoiceId,
					status
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
					if (response.status == 1) {
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/invoiceDetail.php', { 'id': invoiceId, status }, function (data) {
							$('.invoiceDetail').html(data);
						});
					} else {
						Toast.fire({
							icon: 'warning',
							title: response.message
						});
					}
				}
			});
		}
	});
}

function deleteWishlist(productId) {
	Swal.fire({
		title: 'Hủy theo dõi sản phẩm',
		text: 'Bạn có chắc chắn muốn hủy theo dõi sản phẩm này?',
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
				url: 'Controller/myAccount.php?act=deleteWishlist',
				data: {
					'id': productId,
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
						$.get('include/wishlist.php', function (data) {
							$('#v-pills-wishlist').html(data);
						})

					} else { // false								
						Toast.fire({
							icon: 'warning',
							title: response.message
						});
					}
				}
			});
		}
	})
}

function checkInvoice(invoiceId, status) {
	Swal.fire({
		title: 'Xác nhận thanh toán',
		text: 'Bạn đã thanh toán hóa đơn này ?',
		icon: 'success',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Chấp nhận',
		cancelButtonText: 'Hủy'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: 'Controller/myAccount.php?act=checkInvoice',
				data: {
					'id': invoiceId,
					status
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
						$.get('include/invoiceDetail.php', { 'id': invoiceId, status }, function (data) {
							$('.invoiceDetail').html(data);
						});
						$.get('include/invoiceListAccount.php', { 'id': invoiceId, status }, function (data) {
							$('.invoiceListAccount').html(data);
						});
					} else { // false								
						Toast.fire({
							icon: 'warning',
							title: response.message
						});
					}
				}
			});
		}
	})
}

function viewInvoiceDetail(invoiceId) {
	$.ajax({
		type: 'POST',
		url: 'include/invoiceDetail.php',
		data: {
			'id': invoiceId,
		},
		success: function (response) {
			$('.invoiceDetail').html(response);
		}
	})
}

function filterInvoiceByStatus(status, invoiceId) {
	$.ajax({
		type: 'POST',
		url: 'include/invoiceListAccount.php',
		data: {
			'status': status,
			'id': invoiceId,
		},
		success: function (response) {
			$('.invoiceListAccount').html(response);
		}
	})
}

$(document).ready(function () {
	//Không nhập ký tự đặc biệt
	$.validator.addMethod("noSpecial", function (value, element) {
		var specialCharacters = /[!@#$%^&*(),.?\":{}|<>]/; // Các ký tự đặc biệt không được nhập
		return !specialCharacters.test(value);
	}, "Không được nhập ký tự đặc biệt");

	// Thêm phương thức kiểm tra ngày sinh không lớn hơn ngày hiện tại
	$.validator.addMethod('maxDate', function (value, element) {
		var selectedDate = new Date(value);
		var currentDate = new Date();
		return selectedDate <= currentDate;
	}, 'Ngày sinh không được lớn hơn ngày hiện tại.');
	//Kiểm tra số điện thoại phải là số điện thoại VN không
	$.validator.addMethod("phoneVN", function (phone_number, element) {
		phone_number = phone_number.replace(/\s+/g, "");
		return this.optional(element) || phone_number.length > 9 &&
			phone_number.match(/^(84|0[3|5|7|8|9])+([0-9]{8})$/);
	}, "Vui lòng nhập số điện thoại hợp lệ");
	$.validator.addMethod("noDigits", function (value, element) {
		return !/\d/.test(value);
	}, "Không được nhập chữ số");
	//Thay đổi mật khẩu tại trang thông tin tài khoản
	$('#changePasswordAccount').validate({
		rules: {
			password: {
				required: true,
			},
			passwordNew: {
				required: true,
				minlength: 5,
				maxlength: 100,
			},
			passwordRenew: {
				equalTo: '#passwordNew'
			},
		},
		messages: {
			password: {
				required: 'Vui lòng nhập thông tin',
			},
			passwordNew: {
				required: 'Vui lòng nhập thông tin',
				minlength: 'Ít nhất 5 ký tự',
				maxlength: 'Nhiều nhất 100 ký tự',
			},
			passwordRenew: {
				equalTo: 'Mật khẩu nhập lại không đúng'
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: 'POST',
				url: 'Controller/myAccount.php?act=changePasswordAccount',
				data: $(form).serializeArray(),
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
						$('#changePasswordAccount')[0].reset(); // Reset form fields
						$('#changePasswordAccount').validate().resetForm(); // Reset validation
					} else { // false								
						Toast.fire({
							icon: 'warning',
							title: response.message
						});
					}
				}
			})
		}
	})
	//thay đổi thông tin tài khoản
	$('#formInfoAccount').validate({
		rules: {
			fullname: {
				required: true,
				noDigits: true,
				noSpecial: true,
			},
			date: {
				required: true,
				maxDate: true,
			},
			phone: {
				required: true,
				phoneVN: true,
			},
			address: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
		},
		messages: {
			fullname: {
				required: 'Vui lòng nhập thông tin',
				noDigits: 'Không được chứa số'
			},
			date: {
				required: 'Vui lòng nhập thông tin',
			},
			address: {
				required: 'Vui lòng nhập thông tin',
			},
			phone: {
				required: 'Vui lòng nhập thông tin',
				phoneVN: 'Số điện thoại không hợp lệ'
			},
			email: {
				required: 'Vui lòng nhập thông tin',
				email: 'Email không hợp lệ'
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: 'POST',
				url: 'Controller/myAccount.php?act=saveInfo',
				data: $(form).serializeArray(),
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

						setTimeout(function () {
							window.location.reload();
						}, 1300);
					} else { // false								
						Toast.fire({
							icon: 'warning',
							title: response.message
						});
					}
				}
			})
		}
	})
	//lấy lại mật khẩu
	$('#resetPassword').validate({
		rules: {
			password: {
				required: true,
				minlength: 5,
				maxlength: 100,
			},
			repassword: {
				equalTo: '#passwordNew'
			},
		},
		messages: {
			password: {
				required: 'Vui lòng nhập thông tin',
				minlength: 'Ít nhất 5 ký tự',
				maxlength: 'Nhiều nhất 100 ký tự',
			},
			repassword: {
				equalTo: 'Mật khẩu nhập lại không đúng'
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: 'POST',
				url: 'Controller/resetPassword.php',
				data: $(form).serializeArray(),
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
						$('#resetPassword')[0].reset(); // Reset form fields
						$('#resetPassword').validate().resetForm(); // Reset validation
						setTimeout(function () {
							window.location = 'index.php?action=login-account';
						}, 1300);
					} else { // false								
						Toast.fire({
							icon: 'warning',
							title: response.message
						});
					}
				}
			})
		}
	})
	//Lý do trả hàng
	$('#formReturnProduct').validate({
		rules: {
			image: {
				required: true,
			},
			content: {
				required: true,
			},
		},
		messages: {
			image: {
				required: 'Vui lòng thêm ảnh',
			},
			content: {
				required: 'Vui lòng nhập thông tin',
			},
		},
		submitHandler: function (form) {
			// Lấy giá trị của trường textarea "content" từ trình soạn thảo TinyMCE
			var contentValue = tinymce.activeEditor.getContent().trim();
			if (contentValue == '') {
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

				Toast.fire({
					icon: 'error',
					title: 'Vui lòng nhập nội dung'
				});
			} else {
				var formData = new FormData(form);
				console.log(formData);
				$.ajax({
					type: 'POST',
					url: 'Controller/returnProduct.php',
					data: formData,
					processData: false,
					contentType: false,
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
							setTimeout(function () {
								window.location = 'index.php?action=myAccount';
							}, 1300);
						} else { // false								
							Toast.fire({
								icon: 'warning',
								title: response.message
							});
						}
					}
				})
			}

		}
	})

});