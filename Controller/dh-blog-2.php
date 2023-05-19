<?php
include_once "View/blog-2.php";
$news = new news();
$newsAll = $news->getAllNews();
$count = $newsAll->rowCount();

$p = new page();
$limit = 4;
$page = $p->findPage($count, $limit);
$start = $p->findStart($limit);
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

if (isset($_GET['page']) && $_GET['page'] <= 0 || isset($_GET['page']) && $_GET['page'] > $page) {
	echo '<meta http-equiv="refresh" content="0; url=./index.php?action=404"/>';
} else {
	include_once "View/blog-2.php";
}
