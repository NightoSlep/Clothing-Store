<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["sanPhamNhap"]) && !empty($_POST["sanPhamNhap"])) {
        foreach ($_POST["sanPhamNhap"] as $key => $sanPham) {
            $maSanPham = $sanPham;
            $maMau = $_POST["maunhap"][$key];
            $soLuongNhap = $_POST["soluongnhap"][$key];
            $donGia = $_POST["dongia"][$key];
                        
            // $query = "INSERT INTO table_name (ma_san_pham, ma_mau, so_luong_nhap, don_gia) VALUES ('$maSanPham', '$maMau', '$soLuongNhap', '$donGia')";
            // mysqli_query($mysqli, $query);
        }
        
        // header("Location: thanhcong.php");
        // echo "Thêm phiếu nhập thành công!";
    } else {
        // Trường hợp không có dữ liệu sản phẩm nhập
        echo "Vui lòng chọn ít nhất một sản phẩm để thêm vào phiếu nhập!";
    }
} else {
    // Trường hợp không phải là phương thức POST
    echo "Không có dữ liệu được gửi!";
}
?>
