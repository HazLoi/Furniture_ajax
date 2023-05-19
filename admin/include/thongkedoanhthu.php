<?php
set_include_path(get_include_path() . PATH_SEPARATOR . '../Model/');
spl_autoload_extensions('.php');
spl_autoload_register();

$connect = new connect();


// lấy năm có doanh thu đầu tiên và mới nhất
$selectFirstYear = "SELECT YEAR(ngay) as year FROM hoa_don GROUP BY YEAR(ngay) ORDER BY YEAR(ngay) limit 1";
$selectLastYear = "SELECT YEAR(ngay) as year FROM hoa_don GROUP BY YEAR(ngay) ORDER BY YEAR(ngay) DESC limit 1";
$firstYear = $connect->getInstance($selectFirstYear)['year'];
$lastYear = $connect->getInstance($selectLastYear)['year'];

// Chọn năm có doanh thu gần nhất
$year = $lastYear;
// Lấy năm từ form
if (isset($_POST['year']) && intval($_POST['year']) != '') {
	$checkNumber = "/^\d+$/";
	if (intval($_POST['year']) > $lastYear) {
		$year = $lastYear;
	} else if (intval($_POST['year']) < $firstYear) {
		$year = $firstYear;
	} else {
		$year = $_POST['year'];
	}
}
$yearFix = $year;


// Lấy dữ liệu doanh thu và số lượng đã mua theo tháng trong năm
$data = $connect->getList("SELECT MONTH(a.ngay) AS thang, SUM(b.soluongmua) AS soluongmua, SUM(b.thanhtien) AS doanhthu 
                          FROM hoa_don AS a, ct_hoadon AS b 
                          WHERE a.maHD = b.maHD AND YEAR(a.ngay) = $year AND a.trangthai = 1 AND a.tinhtrang = 3 AND b.trahang = 1
                          GROUP BY MONTH(a.ngay)");

// $data = $connect->getList("SELECT MONTH(hd.ngay) AS thang, 
//                             SUM(ct.soluongmua) AS soluongmua, 
//                             SUM(ct.thanhtien) AS doanhthu
//                             FROM hoa_don AS hd
//                             JOIN ct_hoadon AS ct ON hd.maHD = ct.maHD
//                             WHERE hd.trangthai = 1 AND hd.tinhtrang = 3 AND hd.i_delete = 1 AND ct.trahang = 1
//                             GROUP BY MONTH(hd.ngay)
//                             ");

// Chuẩn bị dữ liệu cho biểu đồ
$categories = array();
$dataDoanhThu = array();
$dataSoLuongMua = array();

foreach ($data as $row) {
	$month = "Tháng " . $row['thang'];
	$categories[] = $month;
	$dataDoanhThu[$month] = intval($row['doanhthu']);
	$dataSoLuongMua[$month] = intval($row['soluongmua']);
}

$chartType = 'column';
if (isset($_GET['chartType']) && $_GET['chartType'] != '') {
	$chartType = $_GET['chartType'];
} else if (isset($_POST['chartType']) && $_POST['chartType'] != '') {
	$chartType = $_POST['chartType'];
}

if (!empty($dataDoanhThu) && !empty($dataSoLuongMua)) {
	// Hiển thị biểu đồ
	echo "<div id='revenueChart'></div>";

	echo "<script src='https://code.highcharts.com/highcharts.js'></script>";
	echo "<script>
            Highcharts.chart('revenueChart', {
                chart: {
                    type: '$chartType'
                },
                title: {
                    text: 'Thống kê doanh thu và số lượng đã bán theo tháng trong năm $year'
                },
                xAxis: {
                    categories: " . json_encode($categories) . ",
                    crosshair: true
                },
                yAxis: [{
                    min: 0,
                    title: {
                        text: 'Doanh thu (VNĐ)'
                    }
                }, {
                    min: 0,
                    title: {
                        text: 'Số lượng'
                    },
                    opposite: true
                }],
                series: [{
                    name: 'Doanh thu',
                    data: " . json_encode(array_values($dataDoanhThu)) . ",
                    color: '#FF6384',
                    yAxis: 0
                }, {
                    name: 'Số lượng đã bán',
                    data: " . json_encode(array_values($dataSoLuongMua)) . ",
                    color: '#36A2EB',
                    yAxis: 1
                }]
            });
        </script>";
} else {
	echo "<h1 class='text-center my-5'>Năm $year không có thu nhập</h1>";
}
