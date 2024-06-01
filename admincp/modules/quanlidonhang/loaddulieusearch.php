<?php

$mysqli = new mysqli("localhost", "root", "", "doan1");


if ($mysqli->connect_errno) {
    echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
    exit();
}

?>
<?php
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
$status = $_POST['status'];

$sql = "SELECT IDOR,FULLNAME,ADRESS,NUMBERPHONE,ORDERDATE,TOTALPAYMENT,`order`.status FROM `order`,account WHERE account.IDAC = `order`.IDAC ";

// Thêm điều kiện về ngày nếu startDate được cung cấp
if (!empty($startDate)) {
    $sql .= " AND ORDERDATE >= '$startDate'";
}

// Thêm điều kiện về ngày nếu endDate được cung cấp
if (!empty($endDate)) {
    $sql .= " AND ORDERDATE <= '$endDate'";
}

// Thêm điều kiện về trạng thái nếu status được cung cấp
if (!empty($status) || $status ==0) {
    $sql .= " AND order.status = $status";
}

// Thực hiện truy vấn SQL
$query = mysqli_query($mysqli, $sql);

// Kiểm tra và xử lý kết quả
if ($query) {
    // Xử lý dữ liệu từ truy vấn SQL
    while ($row = mysqli_fetch_array($query)) {
        // Hiển thị dữ liệu trong các hàng <tr>
        echo "<tr>";
        echo "<th>" . $row['IDOR'] . "</th>";
        echo "<th>" . $row['FULLNAME'] . "</th>";
        echo "<th>" . $row['ADRESS'] . "</th>";
        echo "<th>" . $row['NUMBERPHONE'] . "</th>";
        echo "<th>" . ($row['ORDERDATE'] != '' ? $row['ORDERDATE'] : 'Không có dữ liệu') . "</th>";
        echo "<th>" . $row['TOTALPAYMENT'] . "</th>";
        echo "<th>";
        if ($row['status'] == 1) {
            echo 'Chờ duyệt';
        } else if ($row['status'] == 0) {
            echo "Đã hủy";
        } else if ($row['status'] == 2) {
            echo 'Đã xác nhận';
        } else {
            echo 'Đã nhận hàng';
        }
        echo "</th>";
        echo "<th class='quanli'>";
        echo "<a href='index.php?action=donhang&query=xemdonhang&IDOR=" . $row['IDOR'] . "&status=" . $row['status'] . "'>Xem</a>";
        echo "</th>";
        echo "</tr>";
    }
} else {
    // Xử lý lỗi nếu truy vấn không thành công
    echo "Lỗi: " . mysqli_error($mysqli);
}

?>

