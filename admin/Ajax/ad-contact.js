function adminRepContact(maLH, email, subject) {
	Swal.fire({
		title: 'Ẩn thư',
		text: 'Bạn có chắc chắn muốn ẩn thư này?',
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
				url: 'Controller/ad-contact.php?act=deleteContact',
				data: {
					maLH,
					email,
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

					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/ad-contact.php', {
							email,
							subject
						}, function (data) {
							$('.contentContact').html(data);
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

function adminDropContact(maLH, email, subject) {
	Swal.fire({
		title: 'Xóa vĩnh viễn thư',
		text: 'Bạn có chắc chắn muốn xóa thư này?',
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
				url: 'Controller/ad-contact.php?act=dropContact',
				data: {
					maLH,
					email,
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
					if (response.status == 1) { // true						
						Toast.fire({
							icon: 'success',
							title: response.message
						});
						$.get('include/ad-contact.php', {
							email,
							subject
						}, function (data) {
							$('.contentContact').html(data);
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

function filterContactByEmail(email) {
	$.ajax({
		type: 'POST',
		url: 'include/ad-contact.php',
		data: {
			email
		},
		success: function (response) {
			$('.contentContact').html(response);
		}
	})
};


$(document).ready(function () {
	$('.formSearchSubjectContact').on('keyup', function (event) {
		event.preventDefault();
		var subject = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'include/ad-contact.php',
			data: { subject },
			success: function (response) {
				$('.contentContact').html(response);
			}
		})
	})

	$('.formSearchSubjectContact').on('submit', function (event) {
		event.preventDefault();
	})

	$('.formSearchEmailContact').on('keyup', function (event) {
		event.preventDefault();
		var email = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'include/ad-contact.php',
			data: { email },
			success: function (response) {
				$('.contentContact').html(response);
			}
		})
	})

	$('.formSearchEmailContact').on('submit', function (event) {
		event.preventDefault();
	})

	$('.formRepContact').validate({
		submitHandler: function (form) {
			let repcontent = tinymce.activeEditor.getContent().trim();
			let email = $('[name="email"]').val();
			let contactId = $('[name="maLH"]').val();
			let authorSend = $('[name="authorSend"]').val();
			let subject = $('[name="subject"]').val();
			let content = $('[name="content"]').val();
			if (repcontent == '') {
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
					title: 'Vui lòng nhập nội dung phản hồi'
				});

			} else {
				Swal.fire({
					title: 'Đang trong quá trình gửi đi',
					html: '<img style="width: 100px; height: 100px" src="../assets/images/loading-gif.gif" alt="Loading" />',
					showConfirmButton: false,
					allowOutsideClick: false,
					onBeforeOpen: function () {
						Swal.showLoading();
					}
				});

				$.ajax({
					type: 'POST',
					url: 'Controller/ad-contact.php?act=repContact',
					data: {
						repcontent,
						contactId,
						content,
						email,
						authorSend,
						subject,
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
							$('.formRepContact')[0].reset(); // Reset form fields
							$('.formRepContact').validate().resetForm(); // Reset validation
							setTimeout(function () {
								window.location = 'index.php?action=admin-page&act=contactList';
							}, 1000);

						} else { // false								
							Toast.fire({
								icon: 'warning',
								title: response.message
							});
						}
					}
				})
			}
		}
	})
});
