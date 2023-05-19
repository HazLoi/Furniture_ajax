function pageNews(page, newsSearch) {
	$.ajax({
		type: 'POST',
		url: 'include/news.php',
		data: {
			page,
			newsSearch
		},
		success: function (response) {
			$('.contentNews').html(response);
			history.pushState({
				page: page
			}, "", "?action=blog-2&page=" + page);
		}
	});
}


$(document).ready(function () {
	$('.searchNews').on('keyup', function (event) {
		event.preventDefault();
		var newsSearch = $(this).val();
		$.ajax({
			type: 'POST',
			url: 'include/news.php',
			data: {newsSearch},
			success: function (response) {
				$('.contentNews').html(response);
			}
		})
	})
});
