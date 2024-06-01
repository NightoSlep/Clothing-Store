<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "doan1");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$productId = $_GET['productId'];

// Truy vấn cơ sở dữ liệu để lấy danh sách màu
$sql = "SELECT color.IDCO, color.NAME FROM color, detailproduct WHERE detailproduct.IDCO = color.IDCO AND detailproduct.IDPR = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

// Lưu danh sách màu vào mảng
$colors = [];
while ($row = $result->fetch_assoc()) {
    $colors[] = $row;
}

// Trả về danh sách màu dưới dạng JSON
echo json_encode($colors);

// Đóng kết nối
$stmt->close();
$mysqli->close();
?>
