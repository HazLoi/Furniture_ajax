<?php
$news = new news();
if (isset($_GET['id']) && intval($_GET['id']) != null) {
	$result = $news->checkNewsId($_GET['id']);
	if (!empty($result)) {
		include_once "View/blog-detail.php";
	} else {
		echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
	}
} else {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
}
