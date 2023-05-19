<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$connect = new connect();

$selectFirstYear = "SELECT YEAR(ngay) as year FROM hoa_don GROUP BY YEAR(ngay) ORDER BY YEAR(ngay) limit 1";
$selectLastYear = "SELECT YEAR(ngay) as year FROM hoa_don GROUP BY YEAR(ngay) ORDER BY YEAR(ngay) DESC limit 1";

$firstYear = $connect->getInstance($selectFirstYear)['year'];
$lastYear = $connect->getInstance($selectLastYear)['year'];

?>
<!-- Form nhập năm -->
<form class="formThongKeDoanhThu" method="post">
    <label for="year">Nhập năm <?php echo $firstYear . '-' . $lastYear ?>:</label>
    <input class="form-control" type="text" id="year" name="year" autocomplete="off" spellcheck="false">
</form>
<div class="my-2">
    <a class="btn btn-info" href="javascript:changeChart('column')">Biểu đồ dạng cột</a>
    <a class="btn btn-info" href="javascript:changeChart('line')">Biểu đồ dạng đường</a>

</div>
<div class="thongkedoanhthu">
    <?php include "include/thongkedoanhthu.php" ?>
</div>