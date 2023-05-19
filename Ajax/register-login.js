$(document).ready(function () {
	//Thêm rule cho đăng ký
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
	//đăng nhập
	$('#formLogin').submit(function (event) {
		event.preventDefault();
		// console.log($(this).serializeArray());
		$.ajax({
			type: 'POST',
			url: 'Controller/login-account.php',
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
					setTimeout(function () {
						window.location = '/index.php?action=myAccount';
					}, 1000);
				} else { // false								
					Toast.fire({
						icon: 'error',
						title: response.message
					});
					alert(JSON.parse(response).message);
				}
			}
		})
	})

	//Đăng ký
	$('#formRegister').validate({
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
			nameAccount: {
				required: true,
				maxlength: 30,
				noSpecial: true,
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
			password: {
				required: true,
				minlength: 5,
				maxlength: 100
			},
			repassword: {
				equalTo: '#password'
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
			nameAccount: {
				required: 'Vui lòng nhập thông tin',
				maxlength: 'Tối đa 30 ký tự'
			},
			phoneNumber: {
				required: 'Vui lòng nhập thông tin',
				digits: 'Số điện thoại không hợp lệ',
			},
			password: {
				required: 'Vui lòng nhập thông tin',
				maxlength: 'Tối đa 100 ký tự',
				minlength: 'Mật khẩu yếu'
			},
			repassword: {
				equalTo: 'Mật khẩu nhập lại không đúng'
			},
			email: {
				required: 'Vui lòng nhập thông tin',
				email: 'Email không hợp lệ'
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: 'POST',
				url: 'Controller/register-account.php',
				data: $(form).serializeArray(),
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
						setTimeout(function () {
							window.location = 'index.php?action=login-account';
						}, 1000);
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
	})
});
