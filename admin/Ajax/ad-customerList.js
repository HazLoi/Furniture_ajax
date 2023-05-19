function adminDeleteCustomer(id, searchByEmail) {
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
				url: 'Controller/ad-customerList.php?act=deleteCustomer',
				data: {
					id,
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
						$.get('include/ad-customerList.php', { searchByEmail }, function (data) {
							$('.customerList').html(data);
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

function adminDropCustomer(id, searchByEmail) {
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
				url: 'Controller/ad-customerList.php?act=dropCustomer',
				data: {
					id,
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
						$.get('include/ad-customerList.php', { searchByEmail }, function (data) {
							$('.customerList').html(data);
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

function adminRestoreCustomer(id, searchByEmail) {
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
				url: 'Controller/ad-customerList.php?act=restoreCustomer',
				data: {
					id,
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
						$.get('include/ad-customerList.php', { searchByEmail }, function (data) {
							$('.customerList').html(data);
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
	});
};


$(document).ready(function () {
	$('.inpSearchCustomerById').on('input', function (event) {
		event.preventDefault();
		console.log($(this).serializeArray()[0].value);
		$.ajax({
			type: 'POST',
			url: 'include/ad-customerList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.customerList').html(response);
			}
		})
	})

	$('.inpSearchCustomerByEmail').on('input', function (event) {
		event.preventDefault();
		console.log($(this).serializeArray()[0].value);
		$.ajax({
			type: 'POST',
			url: 'include/ad-customerList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.customerList').html(response);
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

});