$(document).ready(function () {
	//Thay đổi mật khẩu tại trang thông tin tài khoản
	$('#changePasswordAdmin').validate({
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
				minlength: 'Mật khẩu yếu',
				maxlength: 'Nhiều nhất 100 ký tự',
			},
			passwordRenew: {
				equalTo: 'Mật khẩu nhập lại không đúng'
			},
		},
		submitHandler: function (form) {
			$.ajax({
				type: 'POST',
				url: 'Controller/myAccount.php?act=changePasswordAdmin',
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
						$('#changePasswordAdmin')[0].reset(); // Reset form fields
						$('#changePasswordAdmin').validate().resetForm(); // Reset validation
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
})

