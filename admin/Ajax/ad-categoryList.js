function adminDeleteCategory(maLoai) {
	Swal.fire({
		title: 'Ẩn loại sản phẩm',
		text: 'Bạn có chắc chắn muốn ẩn loại sản phẩm này?',
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
				url: 'Controller/ad-categoryList.php?act=deleteCategory',
				data: {
					maLoai,
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
						$.get('include/ad-categoryList.php', function (data) {
							$('.categoryList').html(data);
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

function adminRestoreCategory(maLoai) {
	Swal.fire({
		title: 'Khôi phục loại sản phẩm',
		text: 'Bạn có chắc chắn muốn khôi phục loại sản phẩm này?',
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
				url: 'Controller/ad-categoryList.php?act=restoreCategory',
				data: {
					'maLoai': maLoai
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
						$.get('include/ad-categoryList.php', function (data) {
							$('.categoryList').html(data);
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

function adminDropCategory(maLoai) {
	Swal.fire({
		title: 'Xóa vĩnh viển loại sản phẩm',
		text: 'Bạn có chắc chắn muốn xóa loại sản phẩm này?',
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
				url: 'Controller/ad-categoryList.php?act=dropCategory',
				data: {
					maLoai,
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
						$.get('include/ad-categoryList.php', function (data) {
							$('.categoryList').html(data);
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