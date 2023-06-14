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

function findNewsByNewsType(newsType){
	$.ajax({
		type: 'POST',
		url: 'include/news.php',
		data: {
			newsType,
		},
		success: function (response) {
			$('.contentNews').html(response);
		}
	})
}

$(document).ready(function () {
	$('.cat-list li a').click(function (event) {
		// Xóa lớp "active" từ tất cả các mục
		$('.cat-list li a').removeClass('active');

		// Thêm lớp "active" vào mục được chọn
		$(this).addClass('active')
	})

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
