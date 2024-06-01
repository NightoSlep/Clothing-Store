<?php
// Kết nối cơ sở dữ liệu và các câu lệnh khác cần thiết
$con = mysqli_connect("localhost", "root", "", "doan1");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Change character set to utf8
mysqli_set_charset($con, "utf8");

// Lấy ID của sản phẩm và màu sắc được chọn từ yêu cầu POST
$id_sp = $_POST['id_sp'];
$id_color = $_POST['id_color'];

// Truy vấn cơ sở dữ liệu để lấy thông tin chi tiết sản phẩm dựa trên màu sắc được chọn
$sql_chitietsp = "SELECT color.NAME, color.IDCO, detailproduct.QUANITY
                    FROM detailproduct
                    JOIN color ON detailproduct.IDCO = color.IDCO
                    WHERE detailproduct.IDPR = '$id_sp' AND color.IDCO = '$id_color'";
$query_chitiet = mysqli_query($con, $sql_chitietsp);
$data_chitiet = mysqli_fetch_assoc($query_chitiet);

// Trả về dữ liệu dưới dạng JSON
echo $data_chitiet['QUANITY'];
?>
