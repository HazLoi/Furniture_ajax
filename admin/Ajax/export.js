
$(document).ready(function () {
	$('#exportAdmin').on('click', function () {
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
		$.ajax({
			url: 'index.php?export=admin',
			xhrFields: {
				responseType: 'blob'
			},
			success: async function (data, textStatus, xhr) {
				try {
					const filename = xhr.getResponseHeader('Content-Disposition').substring(22, xhr.getResponseHeader('Content-Disposition').length - 1);
					const handle = await window.showSaveFilePicker({
						suggestedName: filename,
						types: [{
							description: 'Excel Files',
							accept: {
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': ['.xlsx']
							}
						}]
					});
					const writable = await handle.createWritable();
					await writable.write(await data.arrayBuffer());
					await writable.close();
					Toast.fire({
						icon: 'success',
						title: 'File dữ liệu đã được lưu thành công'
					});
				} catch (error) {
					console.log(error);
					if (error instanceof DOMException && error.name === 'AbortError') {
						Toast.fire({
							icon: 'warning',
							title: 'Người dùng đã hủy yêu cầu'
						});
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Đã xãy ra lỗi trong quá trình xử lý'
						});
					}
				}
			},
			error: function (xhr, status, error) {
				console.error(error);
				Toast.fire({
					icon: 'error',
					title: 'Đã xảy ra lỗi khi gửi yêu cầu đến máy chủ. Vui lòng thử lại sau!'
				});
			}
		});
	})

	$('#exportCustomer').on('click', function () {
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
		$.ajax({
			url: 'index.php?export=customer',
			xhrFields: {
				responseType: 'blob'
			},
			success: async function (data, textStatus, xhr) {
				try {
					const filename = xhr.getResponseHeader('Content-Disposition').substring(22, xhr.getResponseHeader('Content-Disposition').length - 1);
					const handle = await window.showSaveFilePicker({
						suggestedName: filename,
						types: [{
							description: 'Excel Files',
							accept: {
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': ['.xlsx']
							}
						}]
					});
					const writable = await handle.createWritable();
					await writable.write(await data.arrayBuffer());
					await writable.close();
					Toast.fire({
						icon: 'success',
						title: 'File dữ liệu đã được lưu thành công'
					});
				} catch (error) {
					console.log(error);
					if (error instanceof DOMException && error.name === 'AbortError') {
						Toast.fire({
							icon: 'warning',
							title: 'Người dùng đã hủy yêu cầu'
						});
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Đã xãy ra lỗi trong quá trình xử lý'
						});
					}
				}
			},
			error: function (xhr, status, error) {
				console.error(error);
				Toast.fire({
					icon: 'error',
					title: 'Đã xảy ra lỗi khi gửi yêu cầu đến máy chủ. Vui lòng thử lại sau!'
				});
			}
		});
	})

	$('#exportProduct').on('click', function () {
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
		$.ajax({
			url: 'index.php?export=product',
			xhrFields: {
				responseType: 'blob'
			},
			success: async function (data, textStatus, xhr) {
				try {
					const filename = xhr.getResponseHeader('Content-Disposition').substring(22, xhr.getResponseHeader('Content-Disposition').length - 1);
					const handle = await window.showSaveFilePicker({
						suggestedName: filename,
						types: [{
							description: 'Excel Files',
							accept: {
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': ['.xlsx']
							}
						}]
					});
					const writable = await handle.createWritable();
					await writable.write(await data.arrayBuffer());
					await writable.close();
					Toast.fire({
						icon: 'success',
						title: 'File dữ liệu đã được lưu thành công'
					});
				} catch (error) {
					console.log(error);
					if (error instanceof DOMException && error.name === 'AbortError') {
						Toast.fire({
							icon: 'warning',
							title: 'Người dùng đã hủy yêu cầu'
						});
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Đã xãy ra lỗi trong quá trình xử lý'
						});
					}
				}
			},
			error: function (xhr, status, error) {
				console.error(error);
				Toast.fire({
					icon: 'error',
					title: 'Đã xảy ra lỗi khi gửi yêu cầu đến máy chủ. Vui lòng thử lại sau!'
				});
			}
		});
	})

	$('#exportInvoice').on('click', function () {
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
		$.ajax({
			url: 'index.php?export=invoice',
			xhrFields: {
				responseType: 'blob'
			},
			success: async function (data, textStatus, xhr) {
				try {
					const filename = xhr.getResponseHeader('Content-Disposition').substring(22, xhr.getResponseHeader('Content-Disposition').length - 1);
					const handle = await window.showSaveFilePicker({
						suggestedName: filename,
						types: [{
							description: 'Excel Files',
							accept: {
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': ['.xlsx']
							}
						}]
					});
					const writable = await handle.createWritable();
					await writable.write(await data.arrayBuffer());
					await writable.close();
					Toast.fire({
						icon: 'success',
						title: 'File dữ liệu đã được lưu thành công'
					});
				} catch (error) {
					console.log(error);
					if (error instanceof DOMException && error.name === 'AbortError') {
						Toast.fire({
							icon: 'warning',
							title: 'Người dùng đã hủy yêu cầu'
						});
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Đã xãy ra lỗi trong quá trình xử lý'
						});
					}
				}
			},
			error: function (xhr, status, error) {
				console.error(error);
				Toast.fire({
					icon: 'error',
					title: 'Đã xảy ra lỗi khi gửi yêu cầu đến máy chủ. Vui lòng thử lại sau!'
				});
			}
		});
	})

	$('#exportNews').on('click', function () {
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
		$.ajax({
			url: 'index.php?export=news',
			xhrFields: {
				responseType: 'blob'
			},
			success: async function (data, textStatus, xhr) {
				try {
					const filename = xhr.getResponseHeader('Content-Disposition').substring(22, xhr.getResponseHeader('Content-Disposition').length - 1);
					const handle = await window.showSaveFilePicker({
						suggestedName: filename,
						types: [{
							description: 'Excel Files',
							accept: {
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': ['.xlsx']
							}
						}]
					});
					const writable = await handle.createWritable();
					await writable.write(await data.arrayBuffer());
					await writable.close();
					Toast.fire({
						icon: 'success',
						title: 'File dữ liệu đã được lưu thành công'
					});
				} catch (error) {
					console.log(error);
					if (error instanceof DOMException && error.name === 'AbortError') {
						Toast.fire({
							icon: 'warning',
							title: 'Người dùng đã hủy yêu cầu'
						});
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Đã xãy ra lỗi trong quá trình xử lý'
						});
					}
				}
			},
			error: function (xhr, status, error) {
				console.error(error);
				Toast.fire({
					icon: 'error',
					title: 'Đã xảy ra lỗi khi gửi yêu cầu đến máy chủ. Vui lòng thử lại sau!'
				});
			}
		});
	})

	$('#exportContact').on('click', function () {
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
		$.ajax({
			url: 'index.php?export=contact',
			xhrFields: {
				responseType: 'blob'
			},
			success: async function (data, textStatus, xhr) {
				try {
					const filename = xhr.getResponseHeader('Content-Disposition').substring(22, xhr.getResponseHeader('Content-Disposition').length - 1);
					const handle = await window.showSaveFilePicker({
						suggestedName: filename,
						types: [{
							description: 'Excel Files',
							accept: {
								'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet': ['.xlsx']
							}
						}]
					});
					const writable = await handle.createWritable();
					await writable.write(await data.arrayBuffer());
					await writable.close();
					Toast.fire({
						icon: 'success',
						title: 'File dữ liệu đã được lưu thành công'
					});
				} catch (error) {
					console.log(error);
					if (error instanceof DOMException && error.name === 'AbortError') {
						Toast.fire({
							icon: 'warning',
							title: 'Người dùng đã hủy yêu cầu'
						});
					} else {
						Toast.fire({
							icon: 'error',
							title: 'Đã xãy ra lỗi trong quá trình xử lý'
						});
					}
				}
			},
			error: function (xhr, status, error) {
				console.error(error);
				Toast.fire({
					icon: 'error',
					title: 'Đã xảy ra lỗi khi gửi yêu cầu đến máy chủ. Vui lòng thử lại sau!'
				});
			}
		});
	})
})