

<?php
session_start();
include "admincp/config/config.php";
//kiểm tra conect database
$err = [];

    $email = $_POST["email"];
    $password = $_POST["password"];

    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    $email = strip_tags($email);
    $email = addslashes($email);
    $password = strip_tags($password); 
    $password = addslashes($password); 

    $sql = "SELECT * FROM account Where EMAIL = '$email'";

    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $checkUsername = mysqli_num_rows($query);


    if ($checkUsername == 1) {
        $checkPass = ($password == $data['PASSWORD']);        
        if ($checkPass) {
            //hẳn khúc này là set dữ liệu cho session user
            $_SESSION['user']['hoten'] = $data['FULLNAME'];
            $_SESSION['user']['sdt'] = $data['NUMBERPHONE'];
            $_SESSION['user']['id_user'] = $data['IDAC'];
            $_SESSION['user']['email'] = $data['EMAIL'];
            $_SESSION['user']['address'] = $data['ADRESS'];
            $_SESSION['user']['gender'] = $data['GENDER'];
            $_SESSION['user']['BIRTH'] = $data['BIRTH'];
            echo 200;
        } else {
            // $err['false'] = "Tài khoản hoặc mât khẩu sai.";
            echo'err';        }
    } else {
        // $err["false"] = 'Tài khoản hoặc mât khẩu sai.';
        echo'err';     }


?>