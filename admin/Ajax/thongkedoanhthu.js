function changeChart(chartType) {
	$.ajax({
		type: 'POST',
		url: 'include/thongkedoanhthu.php',
		data: {
			chartType
		},
		success: function (response) {
			$('.thongkedoanhthu').html(response);
		}
	})
}

$(document).ready(function () {
	$('.formThongKeDoanhThu').on('submit', function (event) {
		event.preventDefault();
		console.log($(this).serializeArray()[0].value);
		$.ajax({
			type: 'POST',
			url: 'include/thongkedoanhthu.php',
			data: $(this).serializeArray(),
			success: function (response) {
				$('.thongkedoanhthu').html(response);
			}
		})
	})

})