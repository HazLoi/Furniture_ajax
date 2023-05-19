function adminDeleteInvoice(maHD, searchByCustomerName, maTTHD) {
	Swal.fire({
		title: 'Ẩn hóa đơn',
		text: 'Bạn có chắc chắn muốn ẩn hóa đơn này?',
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
				url: 'Controller/ad-invoiceList.php?act=deleteInvoice',
				data: {
					maHD,
					maTTHD,
					searchByCustomerName
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
						$.get('include/ad-invoiceList.php', { searchByCustomerName, maTTHD }, function (data) {
							$('.invoiceList').html(data);
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

function adminDropInvoice(maHD, searchByCustomerName, maTTHD) {
	Swal.fire({
		title: 'Xóa vĩnh viễn hóa đơn',
		text: 'Bạn có chắc chắn muốn xóa hóa đơn này?',
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
				url: 'Controller/ad-invoiceList.php?act=dropInvoice',
				data: {
					maHD,
					maTTHD,
					searchByCustomerName
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
						$.get('include/ad-invoiceList.php', { searchByCustomerName, maTTHD }, function (data) {
							$('.invoiceList').html(data);
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

function adminRestoreInvoice(maHD, searchByCustomerName, maTTHD) {
	Swal.fire({
		title: 'Khôi phục đơn hàng',
		text: 'Bạn có chắc chắn muốn khôi phục đơn hàng này?',
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
				url: 'Controller/ad-invoiceList.php?act=restoreInvoice',
				data: {
					maHD,
					maTTHD,
					searchByCustomerName
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
						$.get('include/ad-invoiceList.php', { searchByCustomerName, maTTHD }, function (data) {
							$('.invoiceList').html(data);
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

function updateQtyProductInvoiceDetail(soluong, maSP, maHD, dongia) {
	$.ajax({
		type: 'POST',
		url: 'Controller/ad-editInvoice.php?act=updateQtyProductInvoiceDetail',
		data: {
			'soluong': soluong,
			'dongia': dongia,
			'maSP': maSP,
			'maHD': maHD
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
				$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
					$('.fullContentEditInvoice').html(data);
				})
				setTimeout(function () {
					window.location = 'index.php?action=admin-page&act=editInvoice&id=' + maHD;
				}, 1000);
			} else { // false								
				Toast.fire({
					icon: 'error',
					title: response.message
				});
			}
		}
	})
};

function restoreInvoiceDetail(maSP, maHD) {
	Swal.fire({
		title: 'Khôi phục sản phẩm đơn hàng',
		text: 'Bạn có chắc chắn muốn khôi phục sản phẩm này?',
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
				url: 'Controller/ad-editInvoice.php?act=restoreInvoiceDetail',
				data: {
					'maSP': maSP,
					'maHD': maHD
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
						$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
							$('.fullContentEditInvoice').html(data);
						})
						// setTimeout(function () {
						// 	window.location = 'index.php?action=admin-page&act=editInvoice&id=' + maHD;
						// }, 1500);
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

function deleteInvoiceDetail(maSP, maHD) {
	Swal.fire({
		title: 'Xóa sản phẩm thuộc đơn hàng',
		text: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
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
				url: 'Controller/ad-editInvoice.php?act=deleteInvoiceDetail',
				data: {
					maSP,
					maHD,
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
						$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD, 'maTTHD': maTTHD }, function (data) {
							$('.fullContentEditInvoice').html(data);
						})
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

function filterInvoiceListByStatus(maTTHD) {
	$.ajax({
		type: 'POST',
		url: 'include/ad-invoiceList.php',
		data: {
			maTTHD,
		},
		success: function (response) {
			$('.invoiceList').html(response);
		}
	});
};

$(document).ready(function () {
	$('select[name="editTinhtrang"]').on('change', function () {
		// lấy giá trị chọn từ select
		let tinhtrang = $(this).val();
		// Lấy maHD từ input
		var maHD = $('[name="maHD"]').val();
		$.ajax({
			type: 'POST',
			url: 'Controller/ad-editInvoice.php?act=editTT',
			data: {
				'tinhtrang': tinhtrang,
				'maHD': maHD
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
					$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
						$('.fullContentEditInvoice').html(data);
						setTimeout(() => {
							window.location.reload();
						}, 1000)
					})
					// $.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
					// 	$('.fullContentEditInvoice').html(data);
					// })
				} else { // false								
					Toast.fire({
						icon: 'error',
						title: response.message
					});
				}
			},
		});
	});

	$('input[name="editCompanyName"]').on('blur', function () {
		let companyName = $(this).val();
		var maHD = $('[name="maHD"]').val();
		$.ajax({
			type: 'POST',
			url: 'Controller/ad-editInvoice.php?&act=editCompanyName',
			data: {
				'companyName': companyName,
				'maHD': maHD
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
				if (response.status == 1) {
					Toast.fire({
						icon: 'success',
						title: response.message
					});
					$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
						$('.fullContentEditInvoice').html(data);
						setTimeout(() => {
							window.location.reload();
						}, 1000)
					})
					// $.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
					// 	$('.fullContentEditInvoice').html(data);
					// })
				} else {
					Toast.fire({
						icon: 'error',
						title: response.message
					});
				}
			},
			error: function (error) {
				// Xử lý khi yêu cầu Ajax gặp lỗi
				console.log("Lỗi yêu cầu Ajax: ", error);
			}
		});
	});

	$('input[name="editAddress1"]').on('blur', function () {
		let address = $(this).val();
		var maHD = $('[name="maHD"]').val();
		$.ajax({
			type: 'POST',
			url: 'Controller/ad-editInvoice.php?&act=editAddress1',
			data: {
				'address': address,
				'maHD': maHD
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
				if (response.status == 1) {
					Toast.fire({
						icon: 'success',
						title: response.message
					});
					$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
						$('.fullContentEditInvoice').html(data);
						setTimeout(() => {
							window.location.reload();
						}, 1000)
					})
					// $.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
					// 	$('.fullContentEditInvoice').html(data);
					// })
				} else {
					Toast.fire({
						icon: 'error',
						title: response.message
					});
				}
			},
			error: function (error) {
				// Xử lý khi yêu cầu Ajax gặp lỗi
				console.log("Lỗi yêu cầu Ajax: ", error);
			}
		});
	});

	$('input[name="editAddress2"]').on('blur', function () {
		let address = $(this).val();
		var maHD = $('[name="maHD"]').val();
		$.ajax({
			type: 'POST',
			url: 'Controller/ad-editInvoice.php?&act=editAddress2',
			data: {
				'address': address,
				'maHD': maHD
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
				if (response.status == 1) {
					Toast.fire({
						icon: 'success',
						title: response.message
					});
					$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
						$('.fullContentEditInvoice').html(data);
						setTimeout(() => {
							window.location.reload();
						}, 1000)
					})
					// $.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
					// 	$('.fullContentEditInvoice').html(data);
					// })
				} else {
					Toast.fire({
						icon: 'error',
						title: response.message
					});
				}
			},
			error: function (error) {
				// Xử lý khi yêu cầu Ajax gặp lỗi
				console.log("Lỗi yêu cầu Ajax: ", error);
			}
		});
	});

	$('input[name="editZip"]').on('blur', function () {
		let zip = $(this).val();
		var maHD = $('[name="maHD"]').val();
		$.ajax({
			type: 'POST',
			url: 'Controller/ad-editInvoice.php?&act=editZip',
			data: {
				'zip': zip,
				'maHD': maHD
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
				if (response.status == 1) {
					Toast.fire({
						icon: 'success',
						title: response.message
					});
					$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
						$('.fullContentEditInvoice').html(data);
						setTimeout(() => {
							window.location.reload();
						}, 1000)
					})
					// $.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
					// 	$('.fullContentEditInvoice').html(data);
					// })
				} else {
					Toast.fire({
						icon: 'error',
						title: response.message
					});
				}
			},
			error: function (error) {
				// Xử lý khi yêu cầu Ajax gặp lỗi
				console.log("Lỗi yêu cầu Ajax: ", error);
			}
		});
	});

	$('.inpSearchInvoiceById').on('input', function (event) {
		event.preventDefault();
		console.log($(this).serializeArray()[0].value);
		$.ajax({
			type: 'POST',
			url: 'include/ad-invoiceList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.invoiceList').html(response);
			}
		})
	})

	$('.inpSearchInvoiceByCustomerName').on('input', function (event) {
		event.preventDefault();
		console.log($(this).serializeArray()[0].value);
		$.ajax({
			type: 'POST',
			url: 'include/ad-invoiceList.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.invoiceList').html(response);
			}
		})
	})

	$('#formEditNote').submit(function (event) {
		event.preventDefault();
		// console.log($(this).serializeArray());
		$.ajax({
			type: 'POST',
			url: 'Controller/ad-editInvoice.php?&act=editInvoice',
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
					$.get('include/ad-contentEditInvoice.php', { 'maHD': maHD }, function (data) {
						$('.fullContentEditInvoice').html(data);
						setTimeout(() => {
							window.location.reload();
						}, 1000)
					})
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
});
