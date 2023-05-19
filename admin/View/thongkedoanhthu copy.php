<?php

// Lấy năm hiện tại
$year = date('Y');
$date = new DateTime('now');
$yearNow = $date->format('Y');

// Xử lý form khi được gửi lên
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy năm từ form
    if (isset($_POST['year'])) {
        $checkNumber = "/^\d+$/";
        if (!preg_match($checkNumber, $_POST['year'])) {
            $_SESSION['thongkedoanhthu'] = "Giá trị nhập phải là số !!";
        } else {
            if (intval($_POST['year']) > $yearNow) {
                $year = $yearNow;
                $_POST['year'] = $year;
            } else if (intval($_POST['year']) < 2000) {
                $year = 2000;
                $_POST['year'] = $year;
            } else {
                $year = $_POST['year'];
            }
            $_SESSION['thongkedoanhthu'] = "";
        }
    }
}

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
}
?>

<!-- Form nhập năm -->
<a class="btn btn-info" href="index.php?action=home&chartType=column">Biểu đồ dạng cột</a>
<a class="btn btn-info" href="index.php?action=home&chartType=line">Biểu đồ dạng đường</a>
<form method="post">
    <label for="year">Nhập năm:</label>
    <input type="text" id="year" name="year" value="<?php if (isset($_POST['year']) && $_POST['year'] != '') {
                                                        echo $_POST['year'];
                                                    } ?>">
    <button class="btn btn-success" type="submit">Hiển thị</button><br>
    <span class="text-danger h5"><?php if (isset($_POST['year']) && $_POST['year'] != '') {
                                        echo $_SESSION['thongkedoanhthu'];
                                    } ?></span>
</form>

<?php
// Kiểm tra nếu có dữ liệu doanh thu và số lượng đã mua được lấy từ form

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
}
?>