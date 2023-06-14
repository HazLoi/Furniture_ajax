$(document).ready(function () {
	 // Thêm phương thức kiểm tra ngày sinh không lớn hơn ngày hiện tại
	 $.validator.addMethod('maxDate', function(value, element) {
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
	//đăng nhập
	$('#formLoginAdmin').submit(function (event) {
		event.preventDefault();
		// console.log($(this).serializeArray());
		$.ajax({
			type: 'POST',
			url: 'Controller/login.php',
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
						window.location = '/admin/';
					}, 1000);
				} else if (response.status == 2){ // false								
					Toast.fire({
						icon: 'warning',
						title: response.message
					});
				} else{
					Toast.fire({
						icon: 'error',
						title: response.message
					});
				}
			}
		})
	})
	//Sửa thông tin 
	//thay đổi thông tin tài khoản
	$('#formInfoAdmin').validate({
		rules: {
			fullname: {
				required: true,
				noDigits: true,
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
});
