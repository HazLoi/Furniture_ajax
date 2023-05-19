<?php
class page
{
	public function findPage($count, $limit)
	{
		$page = (($count % $limit) == 0) ? $count / $limit : ceil($count / $limit);

		return $page;
	}

	public function findStart($limit)
	{
		if (empty($_GET['page']) && empty($_POST['page'])) {
			$start = 0;
		} else if (isset($_POST['page'])) {
			if ($_POST['page'] == 1) {
				$start = 0;
			} else {
				$start = ($_POST['page'] - 1) * $limit;
			}
		} else if (isset($_GET['page'])) {
			if ($_GET['page'] == 1) {
				$start = 0;
			} else {
				$start = ($_GET['page'] - 1) * $limit;
			}
		}

		return $start;
	}
}
