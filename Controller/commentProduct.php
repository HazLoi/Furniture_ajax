<?php
include_once 'a-dhAjax.php';

$maSP = $_POST['maSP'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$content = $_POST['content'];
$email = $_POST['email'];
$rating = $_POST['rating'];


$comment = new comment();
$insert = $comment->insertComments($maSP, $_SESSION['id'], $fname, $lname, $email, $content, $rating, $_SESSION['image']);
