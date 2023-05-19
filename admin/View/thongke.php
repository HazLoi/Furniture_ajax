<div style="overflow: hidden">
	<!-- main -->
	<div id="wrapper-site">
		<div class="container">
			<div class="row">
				<div id="content-wrapper" class="onecol">
					<div id="main">
						<div class="page-content">
							<div>
								<div class="card mt-3">
									<div class="card-header info" style="font-size: 18px">
										Thống kê Số lượng sản phẩm được bán ra
									</div>

									<div class="card-body">

										<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
											<a class="nav-link list-group-item list-group-item-action 
												<?php if ((isset($_GET['get']) && $_GET['get'] == "dayMonhYear") || empty($_GET['get']))
													echo "active"
												?>" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Theo ngày-tháng-năm</a>
											<a class="nav-link list-group-item list-group-item-action 
												<?php if (isset($_GET['get']) && $_GET['get'] == "monthYear") echo "active" ?>" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Theo tháng-năm</a>
											<a class="nav-link list-group-item list-group-item-action 
												<?php if (isset($_GET['get']) && $_GET['get'] == "year") echo "active" ?>" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Theo quý</a>
										</div>

										<div class="tab-content mt-2" id="v-pills-tabContent">

											<div class="tab-pane fade <?php if ((isset($_GET['get']) && $_GET['get'] == "dayMonthYear") || empty($_GET['get']))
																					echo "show active"
																				?>" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
												<form action="index.php?action=admin-page&act=thongke&get=dayMonthYear" method="POST">
													<input class="form-control" type="date" name="day" value="<?php if (isset($_GET['get']) && $_GET['get'] == "dayMonthYear") echo $_POST['day'] ?>">
													<button class="border-0 btn btn-primary mt-2" name="thong_ke">Thống kê</button>
												</form>
											</div>

											<div class="tab-pane mt-2 fade <?php if (isset($_GET['get']) && $_GET['get'] == "monthYear") echo "show active" ?>" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
												<form action="index.php?action=admin-page&act=thongke&get=monthYear" method="POST">
													<input class="form-control" type="month" name="month" value="<?php if (isset($_GET['get']) && $_GET['get'] == "monthYear") echo $_POST['month'] ?>">
													<button class="border-0 btn btn-primary mt-2" name="thong_ke">Thống kê</button>
												</form>
											</div>

											<div class="tab-pane mt-2 fade <?php if (isset($_GET['get']) && $_GET['get'] == "year") echo "show active" ?>" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
												<form action="index.php?action=admin-page&act=thongke&get=year" method="POST">
													<select class="form-control" name="quy" id="quy">
														<?php if (isset($_GET['get']) && $_GET['get'] == "year") { ?>
															<option value="<?php echo $_POST['quy'] ?>"><?php echo "Quý " . $_POST['quy'] ?></option>
														<?php } ?>
														<option value="1">Quý 1</option>
														<option value="2">Quý 2</option>
														<option value="3">Quý 3</option>
														<option value="4">Quý 4</option>
													</select>
													<input class="form-control" type="number" name="year" min="2000" max="2100" onblur="if (this.value < 2000) {this.value = 2000;} 
               else if (this.value > 2100) {this.value = 2100;}" value="<?php if (isset($_GET['get']) && $_GET['get'] == "year") {
																									echo $_POST['year'];
																								} else {
																									echo date('Y');
																								} ?>">
													<button class="border-0 btn btn-primary mt-2" name="thong_ke">Thống kê</button>
												</form>
											</div>
										</div>
										<!-- <div class="list-group">
                          <p class="list-group-item list-group-item-action">Theo ngày</p>
                          <a href="index.php?action=thong_ke&lich=thang" class="list-group-item list-group-item-action">Theo tháng</a>
                        <a href="index.php?action=thong_ke&lich=quy" class="list-group-item list-group-item-action">Theo quý</a>
                        <a href="index.php?action=thong_ke&lich=nam" class="list-group-item list-group-item-action">Theo năm</a>
                        </div> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="d-flex justify-content-center mt-5">
		<div class="w-100">
			<div id="chart_div"></div>
		</div>
	</div>
	<div class="d-flex justify-content-center">
		<div class="w-100">
			<div id="chart_div1"></div>
		</div>
	</div>

</div>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load('visualization', '1.0', {
		'packages': ['corechart']
	});
	google.setOnLoadCallback(drawVisualization);

	function drawVisualization() {
		//thống kê số lượng bán hàng theo mặt hàng vẽ biểu đồ
		// tạo bảng DataTable
		var data = new google.visualization.DataTable();
		var ten = new Array();
		var soluongban = new Array();
		var dataten = 0;
		var sl = 0;
		var rows = new Array();

		// + dòng
		<?php
		$admin = new admin();

		if (isset($_GET['get']) && $_GET['get'] == "monthYear") {
			if (isset($_POST['month']) && $_POST['month'] != '') {
				$date = new DateTime('now');
				$dateinput = new DateTime($_POST['month']);
				$dateNow = $date->format('Y-m-d');
				$dateInput = $dateinput->format('Y-m-d');

				if ($dateNow < $dateInput) {
					$month = date('m', strtotime('now'));
					$year = date('Y', strtotime('now'));
					$_POST['month'] = $year . "-" . $month;
					echo $_POST['month'] . "----";
					$result = $admin->thongKeTheoMY($month, $year);

					while ($set = $result->fetch()) {
						$ten = $set['ten'];
						$soluong = $set['soluongmua'];
						echo "ten.push('" . $ten . "');";
						echo "soluongban.push('" . $soluong . "');";
					}
				} else {
					$month = date('m', strtotime($_POST['month']));
					$year = date('Y', strtotime($_POST['month']));
					$result = $admin->thongKeTheoMY($month, $year);

					while ($set = $result->fetch()) {
						$ten = $set['ten'];
						$soluong = $set['soluongmua'];
						echo "ten.push('" . $ten . "');";
						echo "soluongban.push('" . $soluong . "');";
					}
				}
			}
		} elseif (isset($_GET['get']) && $_GET['get'] == "dayMonthYear") {
			if (isset($_POST['day']) && $_POST['day'] != '') {
				$day = date('d', strtotime($_POST['day']));
				$month = date('m', strtotime($_POST['day']));
				$year = date('Y', strtotime($_POST['day']));
				$result = $admin->thongKeTheoDMY($day, $month, $year);

				while ($set = $result->fetch()) {
					$ten = $set['ten'];
					$soluong = $set['soluongmua'];
					echo "ten.push('" . $ten . "');";
					echo "soluongban.push('" . $soluong . "');";
				}
			}
		} elseif (isset($_GET['get']) && $_GET['get'] == 'year') {
			$yearNow = date('Y', strtotime('now'));
			$yearInput = date('Y', strtotime($_POST['year']));

			

			if ($yearInput > $yearNow) {
				$_POST['year'] = $yearNow;
				if (isset($_POST['year']) && $_POST['year'] != '') {
					$quy = $_POST['quy'];
					$year = date('Y', strtotime($_POST['year']));

					$result = $admin->thongKeTheoQuy($quy, $year);

					while ($set = $result->fetch()) {
						$ten = $set['ten'];
						$soluong = $set['soluongmua'];
						echo "ten.push('" . $ten . "');";
						echo "soluongban.push('" . $soluong . "');";
					}
				}
			} else {
				if (isset($_POST['year']) && $_POST['year'] != '') {
					$quy = $_POST['quy'];
					$year = $_POST['year'];
					$result = $admin->thongKeTheoQuy($quy, $year);

					while ($set = $result->fetch()) {
						$ten = $set['ten'];
						$soluong = $set['soluongmua'];
						echo "ten.push('" . $ten . "');";
						echo "soluongban.push('" . $soluong . "');";
					}
				}
			}
		}
		?>

		for (var i = 0; i < ten.length; i++) {
			dataten = ten[i];
			sl = parseInt(soluongban[i]);
			rows.push([dataten, sl]);
		}
		// + cột
		data.addColumn('string', 'Hàng hóa');
		data.addColumn('number', 'Số lượng bán');
		data.addRows(rows);
		// tạo option
		var option = {
			title: 'Thống kê biểu đồ cột',
			'width': 1650,
			'height': 1000,
			'backgroundColor': '#ffffff',
		};

		var option1 = {
			title: 'Thống kê biểu đồ tròn',
			'width': 1700,
			'height': 1000,
			'backgroundColor': '#ffffff',
			is3D: true
		};

		// tiến hành vẽ draw Pie,Column,Bar,Line
		/**
		 * Area Chart (Biểu đồ diện tích)
		 * Bubble Chart (Biểu đồ bong bóng)
		 * Candlestick Chart (Biểu đồ nến Nhật Bản)
		 * Combo Chart (Biểu đồ kết hợp)
		 * Donut Chart (Biểu đồ vòng tròn)
		 * Gantt Chart (Biểu đồ Gantt)
		 * Histogram (Biểu đồ tần suất)
		 * Org Chart (Biểu đồ tổ chức)
		 * Scatter Chart (Biểu đồ phân tán)
		 * Stepped Area Chart (Biểu đồ diện tích bậc thang)
		 * Table (Bảng)
		 */
		var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
		chart.draw(data, option);

		var chart1 = new google.visualization.PieChart(document.getElementById('chart_div1'));
		chart1.draw(data, option1);

		// var table = new google.visualization.Table(document.getElementById('chart_div'));
		// table.draw(data,option);
	}
</script>