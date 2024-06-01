<?php
include "admincp/config/config.php";
session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'suattk') {
        $id_user2 = $_GET['id-user'];
        $hoten2 = $_POST['hoten'];
        $email2 = $_POST['email'];
        $sdt2 = $_POST['sdt'];
        $gender2 = $_POST['gender'];
        $birth2 = $_POST['birth'];
        $address2 = $_POST['address'];
        $sql_sua = "UPDATE `account` SET `FULLNAME` = '$hoten2' ,`EMAIL` = '$email2',
                            `NUMBERPHONE` = '$sdt2',`GENDER` = '$gender2',`BIRTH` = '$birth2',
                            `ADRESS` = '$address2' WHERE `account`.`IDAC` = $id_user2";
        var_dump($sql_sua);
        $query_sua = mysqli_query($con,$sql_sua);
        if($query_sua){
              
            ?> <script type="text/javascript">
                alert("Thao tác thành công!"); 
            </script>
                <?php
                // location.href = 'signin.php';
                $idus = $_SESSION['user']['id_user'];
                $sql = mysqli_query($con,"SELECT * FROM `account` Where IDAC = $idus");
                $data = mysqli_fetch_assoc($sql); 
                $_SESSION['user'] = $data;
                header('location:index.php?id=quanlytaikhoan');
        }
    }
    if ($action == 'repass') {
        $id_user3 = $_GET['id-user'];
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $renewpassword = $_POST['renewpassword'];
        $hashop = password_hash($oldpassword, PASSWORD_DEFAULT);
        if ($hashop == $_SESSION['user']['password']) {
            if ($newpassword == $renewpassword) {
                $hashnp = password_hash($newpassword, PASSWORD_DEFAULT);
                $sql_repass = "UPDATE `account` SET `PASSWORD` = '$hashnp' WHERE `account`.`IDAC` = $id_user3";
                $query_repass = mysqli_query($con, $sql_repass);
                if ($query_repass) {
                    header('location:index.php?id=quanlytaikhoan&&trangthai=themtk');
                }
            } else {
                header('location:index.php?id=quanlytaikhoan&&trangthai=sairepass');
            }
        } else {
            header('location:index.php?id=quanlytaikhoan&&trangthai=saipass');
        }
    }
    if ($action == 'huydonhang') {
        $idhd2 = $_GET['idhd'];
        echo $idhd2;
        $sql_hhd1 = "UPDATE `order` SET status = '0' WHERE IDOR = $idhd2";
        $queryhhd1 = mysqli_query($con, $sql_hhd1);
        header("location:index.php?id=quanlytaikhoan&trangthai=huythanhcong");
    }
}
