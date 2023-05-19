$(document).ready(function () {
	//Thêm rule cho đăng ký
	$.validator.addMethod("noSpecial", function (value, element) {
		var specialCharacters = /[!@#$%^&*(),.?\":{}|<>]/; // Các ký tự đặc biệt không được nhập
		return !specialCharacters.test(value);
	}, "Không được nhập ký tự đặc biệt");

	//Kiểm tra số điện thoại phải là số điện thoại VN không
	$.validator.addMethod("phoneVN", function (phone_number, element) {
		phone_number = phone_number.replace(/\s+/g, "");
		return this.optional(element) || phone_number.length > 9 &&
			phone_number.match(/^(84|0[3|5|7|8|9])+([0-9]{8})$/);
	}, "Vui lòng nhập số điện thoại hợp lệ");
	//không nhập số
	$.validator.addMethod("noDigits", function (value, element) {
		return !/\d/.test(value);
	}, "Không được nhập chữ số");
	//Đăng ký
	$('.formContact').validate({
		rules: {
			fullname: {
				required: true,
				maxlength: 50,
				noDigits: /\d/,
				noSpecial: true,
			},
			subject: {
				required: true,
				maxlength: 30
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: true,
			},
		},
		messages: {
			fullname: {
				required: 'Vui lòng nhập thông tin',
				maxlength: 'Tối đa 50 ký tự',
				noDigits: 'Không được chứa số'
			},
			subject: {
				required: 'Vui lòng nhập thông tin',
				maxlength: 'Tối đa 30 ký tự'
			},
			email: {
				required: 'Vui lòng nhập thông tin',
				email: 'Email không hợp lệ'
			},
			message: {
				required: 'Vui lòng nhập thông tin',
			},
		},
		submitHandler: function (form) {
			let message = tinymce.activeEditor.getContent().trim();
			let email = $('[name="email"]').val();
			let fullname = $('[name="fullname"]').val();
			let subject = $('[name="subject"]').val();
			if (message == '') {
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
				Swal.fire({
					title: 'Đang trong quá trình gửi đi',
					html: '<img style="width: 100px; height: 100px" src="assets/images/loading-gif.gif" alt="Loading" />',
					showConfirmButton: false,
					allowOutsideClick: false,
					onBeforeOpen: function () {
						Swal.showLoading();
					}
				});
				$.ajax({
					type: 'POST',
					url: 'Controller/contact.php',
					data: {
						message,
						email,
						fullname,
						subject
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

						Swal.close(); // Ẩn Swal loading

						if (response.status == 1) { // true						
							Toast.fire({
								icon: 'success',
								title: response.message
							});
							$('.formContact')[0].reset(); // Reset form fields
							$('.formContact').validate().resetForm(); // Reset validation
						} else { // false								
							Toast.fire({
								icon: 'error',
								title: response.message
							});
							alert(JSON.parse(response).message);
						}
					}
				})
			}
		}
	})
});
