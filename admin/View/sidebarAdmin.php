<?php
$admin = new admin();
$role = $admin->getRoleAdmin($_SESSION['id_admin'])['maQuyen'];
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?action=home">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <!-- <i class="fa-solid fa-earth-americas"></i> -->
            <i class="fa-solid fa-sack-dollar"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <img class="logo-mobile img-fluid" src="../assets/images/logo-mobie.png" alt="Prestashop_Furnitica">
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php?action=home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="text-light fa-solid fa-couch"></i>
            <span>Sản phẩm</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Yêu cầu:</h6>
                <a class="collapse-item" href="index.php?action=admin-page&act=productList">Xem sản phẩm</a>
                <?php if ($role == 1 || $role == 3 || $role == 4) { ?>
                    <a class="collapse-item" href="index.php?action=admin-page&act=addProduct">Thêm sản phẩm</a>
                <?php } ?>
                <a class="collapse-item" href="index.php?action=admin-page&act=categories">Loại sản phẩm</a>
            </div>
        </div>
    </li>
    <?php if ($role == 1) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="text-light fa-solid fa-user-tie"></i>
                <span>Admin</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Yêu cầu:</h6>
                    <a class="collapse-item" href="index.php?action=admin-page&act=adminList">Xem danh sách</a>
                    <a class="collapse-item" href="index.php?action=admin-page&act=addAdmin">Thêm nhân viên</a>
                </div>
            </div>
        </li>
    <?php }
    if ($role == 1 || $role == 3) { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                <i class="text-light fa-solid fa-id-card"></i>
                <span>Khách hàng</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Yêu cầu:</h6>
                    <a class="collapse-item" href="index.php?action=admin-page&act=customerList">Xem danh sách</a>
                    <a class="collapse-item" href="index.php?action=admin-page&act=addCustomer">Thêm khách hàng</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
            <i class="text-light fa-solid fa-file-invoice-dollar"></i>
            <span>Hóa đơn</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Yêu cầu:</h6>
                <a class="collapse-item" href="index.php?action=admin-page&act=invoiceList">Xem danh sách</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
            <i class="text-light fa-solid fa-newspaper"></i>
            <span>Tin tức</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Yêu cầu:</h6>
                <a class="collapse-item" href="index.php?action=admin-page&act=newsList">Xem danh sách</a>
                <?php if ($role == 1 || $role == 3 || $role == 4) { ?>
                    <a class="collapse-item" href="index.php?action=admin-page&act=addNews">Thêm tin tức</a>
                <?php } ?>
                <a class="collapse-item" href="index.php?action=admin-page&act=newsType">Loại tin tức</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
            <i class="text-light fa-solid fa-envelope"></i>
            <span>Thư liên hệ</span>
        </a>
        <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Yêu cầu:</h6>
                <a class="collapse-item" href="index.php?action=admin-page&act=contactList">Xem danh sách</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <?php if ($role == 1) { ?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Bổ sung
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="index.php?action=admin-page&act=thongke">
                <i class="fa-solid fa-signal text-light"></i>
                <span>Thống kê</span>
            </a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
    <?php } ?>
    <!-- Divider -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->