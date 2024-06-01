<?php
session_start();
include('../config/config.php'); // Điều chỉnh đường dẫn nếu cần

$errors = [];

// Kiểm tra họ và tên
if (empty($_POST['hoten']) || !preg_match("/^[a-zA-ZÀ-ỹà-ỹ\s]+$/", $_POST['hoten'])) {
    $errors['hoten'] = "Họ tên không hợp lệ.";
}

// Kiểm tra email
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Email không hợp lệ.";
} else {
    // Kiểm tra xem email đã tồn tại chưa
    $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    $result = mysqli_query($mysqli, "SELECT * FROM account WHERE EMAIL = '$email'");
    if (mysqli_num_rows($result) > 0) {
        $errors['email'] = "Email đã tồn tại.";
    }
}

// Kiểm tra mật khẩu
if (empty($_POST['password']) || !preg_match("/^[a-zA-Z0-9]{3,18}$/", $_POST['password'])) {
    $errors['password'] = "Mật khẩu không hợp lệ.";
}

// Kiểm tra xác nhận mật khẩu
if ($_POST['password'] !== $_POST['rpassword']) {
    $errors['rpassword'] = "Mật khẩu nhập lại không khớp.";
}

// Kiểm tra số điện thoại
if (empty($_POST['sdt']) || !preg_match("/^\d{10}$/", $_POST['sdt'])) {
    $errors['sdt'] = "Số điện thoại không hợp lệ.";
}

// Kiểm tra địa chỉ
if (empty($_POST['address'])) {
    $errors['address'] = "Địa chỉ không được để trống.";
}

// Trả về phản hồi JSON
if (!empty($errors)) {
    echo json_encode(['status' => 'error', 'errors' => $errors]);
} else {
    echo json_encode(['status' => 'success']);
}
?>
