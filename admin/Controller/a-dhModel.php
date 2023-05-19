<?php
session_start();
// tự động cập nhật file model khi tạo tên file === class
set_include_path(get_include_path().PATH_SEPARATOR.'Model/');
spl_autoload_extensions('.php');
spl_autoload_register();
