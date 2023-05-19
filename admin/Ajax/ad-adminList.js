function adminDeleteAdmin(id,searchByEmail, role) {
	Swal.fire({
		title: 'Ẩn tài khoản',
		text: 'Bạn có chắc chắn muốn ẩn tài khoản này?',
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
				url: 'Controller/ad-adminList.php?act=deleteAdmin',
				data: {
					id,
					role,
					searchByEmail
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
						$.get('include/ad-adminList.php', { searchByEmail,role }, function (data) {
							$('.adminList').html(data);
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

function adminDropAdmin(id,searchByEmail, role) {
	Swal.fire({
		title: 'Xóa vĩnh viễn tài khoản',
		text: 'Bạn có chắc chắn muốn xóa tài khoản này?',
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
				url: 'Controller/ad-adminList.php?act=dropAdmin',
				data: {
					id,
					role,
					searchByEmail
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
						$.get('include/ad-adminList.php', { searchByEmail,role }, function (data) {
							$('.adminList').html(data);
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

function adminRestoreAdmin(id,searchByEmail, role) {
	Swal.fire({
		title: 'Khôi phục tài khoản',
		text: 'Bạn có chắc chắn muốn khôi phục tài khoản này?',
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
				url: 'Controller/ad-adminList.php?act=restoreAdmin',
				data: {
					id,
					role,
					searchByEmail
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
						$.get('include/ad-adminList.php', { searchByEmail,role }, function (data) {
							$('.adminList').html(data);
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

function filterAdminByRole(role) {
	$.ajax({
		type: 'POST',
		url: 'include/ad-adminList.php',
		data: {
			role
		},
		success: function (response) {
			$('.adminList').html(response);
		}
	});
}


$(document).ready(function () {
	$('.inpSearchAdminByEmail').on('input', function (event) {
		event.preventDefault();
		console.log($(this).serializeArray()[0].value);
		$.ajax({
			type: 'POST',
			url: 'include/ad-adminList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.adminList').html(response);
			}
		})
	})

	$('.inpSearchAdminById').on('input', function (event) {
		event.preventDefault();
		console.log($(this).serializeArray()[0].value);
		$.ajax({
			type: 'POST',
			url: 'include/ad-adminList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.adminList').html(response);
			}
		})
	})


	$('.searchAdminByEmail').submit(function (event) {
		event.preventDefault();
		// Tiếp tục xử lý AJAX và các hành động khác
	});

	$('.searchAdminById').submit(function (event) {
		event.preventDefault();
		// Tiếp tục xử lý AJAX và các hành động khác
	});

	// sắp xếp sản phẩm từ a-z z-a
	

});