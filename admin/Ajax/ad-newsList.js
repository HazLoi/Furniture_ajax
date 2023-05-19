function adminDeleteNews(maTT, type) {
	Swal.fire({
		title: 'Ẩn tin tức',
		text: 'Bạn có chắc chắn muốn ẩn tin tức này?',
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
				url: 'Controller/ad-newsList.php?act=deleteNews',
				data: {
					maTT,
					type
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
						$.get('include/ad-newsList.php', { type }, function (data) {
							$('.newsList').html(data);
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

function adminRestoreNews(maTT, type) {
	Swal.fire({
		title: 'Khôi phục tin tức',
		text: 'Bạn có chắc chắn muốn khôi phục tin tức này?',
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
				url: 'Controller/ad-newsList.php?act=restoreNews',
				data: {
					maTT,
					type
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
						$.get('include/ad-newsList.php', { type }, function (data) {
							$('.newsList').html(data);
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

function adminDropNews(maTT, type) {
	Swal.fire({
		title: 'Xóa vĩnh viễn tin tức',
		text: 'Bạn có chắc chắn muốn xóa tin tức này?',
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
				url: 'Controller/ad-newsList.php?act=dropNews',
				data: {
					maTT,
					type
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
						$.get('include/ad-newsList.php', { type }, function (data) {
							$('.newsList').html(data);
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

function adminFilterNewsByTT(type) {
	$('.searchTitleNews').val('');
	$.ajax({
		type: 'POST',
		url: 'include/ad-newsList.php',
		data: {
			'type': type
		},
		success: function (response) {
			$('.newsList').html(response);
		}
	})
};


$(document).ready(function () {
	$('.searchTitleNews').on('input', function (event) {
		$.ajax({
			type: 'POST',
			url: 'include/ad-newsList.php',
			data: {search: $(this).val()},
			success: function (response) {
				$('.newsList').html(response);
			}
		})
	})
})