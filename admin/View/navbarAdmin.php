        <?php
        $admin = new admin();
        $role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
        ?>
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>

                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span class="badge badge-danger badge-counter">
                            <?php
                            $admin = new admin();
                            $notify = $admin->getNotifyContactToDay();
                            $a = $notify->rowCount();
                            echo $a;
                            ?>
                        </span>
                    </a>
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Liên hệ
                        </h6>
                        <div style="overflow-y:auto ; max-height: 300px">
                            <?php
                            $admin = new admin();
                            $notify = $admin->getLimitNotifyContact();

                            while ($get = $notify->fetch()) :

                                $dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                                $dateNowFix = $dateNow->format('d/m/Y');
                                $dateNotify = new DateTime($get['ngaygui'], new DateTimeZone('Asia/Ho_Chi_Minh'));
                                $dateNotifyFix = $dateNotify->format("d/m/Y");
                                //hiển thị thời gian thông báo
                                $diff = $dateNow->diff($dateNotify);
                                $days = $diff->days;

                                $h = $diff->h;
                                $m = $diff->i;

                                if ($days == 0) {
                                    if ($h == 0) {
                                        if ($m == 0) {
                                            $dateShow = '1 phút trước';
                                        } else {
                                            $dateShow = $m . ' phút trước';
                                        }
                                    } else {
                                        $dateShow = $h . ' giờ ' . $m . ' phút trước';
                                    }

                            ?>
                                    <div class="dropdown-item d-flex align-items-center" href="#">
                                        <div class="mr-3">
                                            <?php
                                            if (!empty($get['anh'])) {
                                                if (strpos($get['anh'], 'https') !== false) { ?>
                                                    <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
                                                    <?php } else {
                                                    if (isset($get['anh']) && $get['anh'] != '') { ?>
                                                        <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('../assets/images/imageAccount/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
                                                    <?php } else { ?>
                                                        <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
                                                <?php }
                                                }
                                            } else { ?>
                                                <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
                                            <?php }
                                            ?>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500"><?= $get['tacgia'] ?> -
                                                <?= $dateShow ?></div>
                                            <span class="font-weight-bold"><?= $get['noidung'] ?></span>
                                        </div>
                                    </div>
                            <?php }
                            endwhile; ?>
                        </div>
                        <a class="dropdown-item text-center small text-gray-500" href="index.php?action=admin-page&act=contactList">Xem thêm</a>
                    </div>
                </li>

                <!-- Nav Item - Messages -->
                <?php if ($role == 1) { ?>
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <span class="badge badge-danger badge-counter">
                                <?php
                                $admin = new admin();
                                $notify = $admin->getNotifyToDay();
                                $a = $notify->rowCount();
                                echo $a;
                                ?>
                            </span>
                        </a>
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Thông báo trong ngày
                            </h6>

                            <div style="overflow-y:auto ; max-height: 300px">
                                <?php
                                $admin = new admin();
                                $notify = $admin->getLimitNotify();

                                while ($get = $notify->fetch()) :

                                    $dateNow = new DateTime('now', new DateTimeZone('Asia/Ho_Chi_Minh'));
                                    $dateNowFix = $dateNow->format('d/m/Y');
                                    $dateNotify = new DateTime($get['ngay'], new DateTimeZone('Asia/Ho_Chi_Minh'));
                                    $dateNotifyFix = $dateNotify->format("d/m/Y");
                                    //hiển thị thời gian thông báo
                                    $diff = $dateNow->diff($dateNotify);
                                    $days = $diff->days;

                                    $h = $diff->h;
                                    $m = $diff->i;

                                    if ($days == 0) {
                                        if ($h == 0) {
                                            if ($m == 0) {
                                                $dateShow = '1 phút trước';
                                            } else {
                                                $dateShow = $m . ' phút trước';
                                            }
                                        } else {
                                            $dateShow = $h . ' giờ ' . $m . ' phút trước';
                                        }

                                ?>
                                        <div class="dropdown-item d-flex align-items-center">
                                            <div class="dropdown-list-image mr-3">
                                                <?php
                                                if (!empty($get['anh'])) {
                                                    if (strpos($get['anh'], 'https') !== false) { ?>
                                                        <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
                                                        <?php } else {
                                                        if (isset($get['anh']) && $get['anh'] != '') { ?>
                                                            <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('../assets/images/imageAccount/<?php echo $get['anh'] ?>'); background-size: cover; background-position: center;"></div>
                                                        <?php } else { ?>
                                                            <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
                                                    <?php }
                                                    }
                                                } else { ?>
                                                    <div class="rounded-circle" style="width: 50px; height: 50px; background-image: url('../assets/images/imageAccount/user.png'); background-size: cover; background-position: center;"></div>
                                                <?php }
                                                ?>
                                                <!-- <img class="rounded-circle" src="../assets/images/imageAccount/undraw_profile_1.svg" alt="..."> -->
                                                <!-- <div class="status-indicator bg-success"></div> -->
                                            </div>
                                            <div class="font-weight-bold">
                                                <div class="text-truncate"><?= $get['noidung'] ?></div>
                                                <div class="small text-dark-500"><?= $get['tacgia'] ?> -
                                                    <?= $dateShow ?>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                                endwhile; ?>

                            </div>

                            <a class="dropdown-item text-center small text-gray-500" href="index.php?action=admin-page&act=notifyList">Xem thêm</a>
                        </div>
                    </li>
                <?php } ?>
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['fullname_admin'] ?></span>
                        <img class="img-profile rounded-circle" src="<?php
                                                                        if (!empty($_SESSION['image_admin'])) {
                                                                            if (strpos($_SESSION['image_admin'], 'https') !== false) {
                                                                                echo $_SESSION['image_admin'];
                                                                            } else {
                                                                                echo '../assets/images/imageAccount/' . $_SESSION['image_admin'];
                                                                            }
                                                                        } else {
                                                                            echo '../assets/images/imageAccount/user.png';
                                                                        }
                                                                        ?>
">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="1">
                        <a class="dropdown-item" href="index.php?action=myAccount">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Thông tin tài khoản
                        </a>
                        <!-- <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a> -->
                        <a class="dropdown-item" href="index.php?action=changePassword">
                            <i class="fa-solid fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Đổi mật khẩu
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="index.php?action=logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Đăng xuất
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->