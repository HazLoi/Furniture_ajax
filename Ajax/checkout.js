$(document).ready(function () {
	//Không nhập ký tự đặc biệt
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
	$.validator.addMethod("noDigits", function (value, element) {
		return !/\d/.test(value);
	}, "Không được nhập chữ số");
	//Đăng ký
	$('#formCheckout').validate({
		rules: {
			fname: {
				required: true,
				maxlength: 10,
				noDigits: /\d/,
				noSpecial: true,
			},
			lname: {
				required: true,
				maxlength: 20,
				noDigits: /\d/,
				noSpecial: true,
			},
			address1: {
				required: true,
			},
			city: {
				required: true,
			},
			email: {
				required: true,
				email: true
			},
			phoneNumber: {
				required: true,
				digits: true,
				phoneVN: true
			},
		},
		messages: {
			fname: {
				required: 'Vui lòng nhập thông tin',
				maxlength: 'Tối đa 10 ký tự',
				noDigits: 'Không được chứa số'
			},
			lname: {
				required: 'Vui lòng nhập thông tin',
				maxlength: 'Tối đa 20 ký tự',
				noDigits: 'Không được chứa số'
			},
			address1: {
				required: 'Vui lòng nhập thông tin',
			},
			city: {
				required: 'Vui lòng chọn Quốc Gia',
			},
			phoneNumber: {
				required: 'Vui lòng nhập thông tin',
				digits: 'Số điện thoại không hợp lệ',
			},
			email: {
				required: 'Vui lòng nhập thông tin',
				email: 'Email không hợp lệ'
			},
		},
		submitHandler: function (form) {
			console.log($(form).serializeArray());
			Swal.fire({
				title: 'Đang gửi hóa đơn về email của bạn',
				html: '<img style="width: 100px; height: 100px" src="assets/images/loading-gif.gif" alt="Loading" />',
				showConfirmButton: false,
				allowOutsideClick: false,
				onBeforeOpen: function () {
					Swal.showLoading();
				}
			});
			$.ajax({
				type: 'POST',
				url: 'Controller/checkout.php',
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

					Swal.close(); // Ẩn Swal loading

					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						setTimeout(function () {
							window.location = 'index.php?action=shop';
						}, 1200);
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
