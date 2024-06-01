<?php
session_start();
include "admincp/config/config.php";
header('Content-Type: text/html; charset=UTF-8');

$err = [];

$hoten = $_POST["hoten"];
$email = $_POST["email"];
$password = $_POST["password"];
$rpassword = $_POST["rpassword"];
$address = $_POST["address"];
$sdt = $_POST["sdt"];
$gender = $_POST['gender'];
$birth = $_POST['birth'];

$hoten = strip_tags($hoten);
$hoten = addslashes($hoten);
$email = strip_tags($email);
$email = addslashes($email);
$password = strip_tags($password);
$password = addslashes($password);
$rpassword = strip_tags($rpassword);
$rpassword = addslashes($rpassword);
$address = strip_tags($address);
$address = addslashes($address);
$sdt = strip_tags($sdt);
$sdt = addslashes($sdt);
$gender = strip_tags($gender);
$gender = addslashes($gender);
$birth = strip_tags($birth);
$birth = addslashes($birth);

if (empty($email)) {
    echo 'Bạn chưa nhập email';
    return;
}
if (mysqli_num_rows(mysqli_query($con, "SELECT EMAIL FROM account WHERE EMAIL='$email'")) > 0) {
    echo "Tài khoản đã bị trùng khớp! Yêu cầu thực hiện đăng ký lại!";
    return;
}
if (empty($hoten)) {
    echo 'Bạn chưa nhập họ và tên';
    return;
}
if (!preg_match("/^[a-zA-Z\sÀ-ỹĐđ]{1,55}$/", $hoten)) {
    echo 'Họ và tên không hợp lệ';
    return;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Nhập sai email';
    return;
}
if (empty($password)) {
    echo 'Bạn chưa nhập mật khẩu';
    return;
}
if (!preg_match("/^[a-z0-9_-]{6,18}$/", $password)) {
    echo 'Bạn chưa nhập sai định dạng mật khẩu';
    return;
}
if (empty($rpassword)) {
    echo 'Bạn chưa nhập lại mật khẩu';
    return;
}
if ($password != $rpassword) {
    echo 'Mật khẩu nhập lại không đúng';
    return;
}
if (empty($sdt)) {
    echo 'Bạn chưa nhập số điện thoại';
    return;
}
if (empty($address)) {
    echo 'Bạn chưa nhập số địa chỉ';
    return;
}
if (empty($gender)) {
    echo 'Bạn chưa chọn giới tính';
    return;
}


$sql = "INSERT INTO `account` (`NUMBERPHONE`,`FULLNAME`,`GENDER`,`PASSWORD`,`EMAIL`,`BIRTH`,`ADRESS`,`IDPE`) 
        VALUES ('{$sdt}','{$hoten}','{$gender}','{$password}','{$email}','{$birth}', '{$address}', '6')";
$query = mysqli_query($con, $sql);
if ($query) {
    echo 100;
} else {
    echo 'Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau.';
}

?>
