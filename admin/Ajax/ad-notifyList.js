function adminDropAllNotify() {
	Swal.fire({
		title: 'Xóa tất cả thông báo',
		text: 'Bạn chắc chắn muốn xóa?',
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
				url: 'Controller/ad-notifyList.php?act=dropAll',
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
						$.get('include/ad-notifyList.php', function (data) {
							$('.notifyList').html(data);
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

$(document).ready(function () {
	$('.formFilterNotify').on('change', function (event) {
		event.preventDefault();
		let day = $('[name="day"]').val();
		$.ajax({
			type: 'POST',
			url: 'include/ad-notifyList.php',
			data: {day},
			success: function (response) {
				$('.notifyList').html(response);
			}
		})
	})
});
