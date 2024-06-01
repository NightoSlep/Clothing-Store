<?php
$IDOR = $_GET['IDOR'];
$status = $_GET['status'];
$statusnew = $_POST['trangthai'];

$mysqli = new mysqli("localhost", "root", "", "doan1");

if ($mysqli->connect_errno) {
    echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
    exit();
}

if ($status == 1 && ($statusnew == 2 || $statusnew == 3)) {
    // Cập nhật status của order
    $sql_update_order = "UPDATE `order` SET status = $statusnew WHERE IDOR = $IDOR";
    mysqli_query($mysqli, $sql_update_order);

    // Truy vấn detailorder
    $sql_select_detailorder = "SELECT IDPR, IDCO, QUANITY FROM detailorder WHERE IDOR = $IDOR";
    $result_detailorder = mysqli_query($mysqli, $sql_select_detailorder);

    // Duyệt kết quả truy vấn
    while ($row = mysqli_fetch_assoc($result_detailorder)) {
        $IDPR = $row['IDPR'];
        $IDCO = $row['IDCO'];
        $QUANTITY = $row['QUANITY'];

        // Cập nhật quantity trong detailproduct
        $sql_update_detailproduct = "UPDATE detailproduct SET QUANITY = QUANITY - $QUANTITY WHERE IDPR = $IDPR AND IDCO = $IDCO";
        mysqli_query($mysqli, $sql_update_detailproduct);
    }
}else{
    $sql_update_order = "UPDATE `order` SET status = $statusnew WHERE IDOR = $IDOR";
    mysqli_query($mysqli, $sql_update_order);
}
header('Location:../../index.php?action=donhang&query=xemdonhang&IDOR=11&status='. $statusnew);
?>
