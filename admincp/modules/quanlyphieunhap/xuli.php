<?php
include('../../config/config.php');
session_start();

if(isset($_GET['action'])){
	if($_GET['action']=='them'){
		$sanPhamNhap = $_POST["sanPhamNhap"];
		$mauNhap = $_POST["maunhap"];
		$soLuongNhap = $_POST["soluongnhap"];
		$donGia = $_POST["dongia"];
		$nhaCungCap = $_POST["nhacungcap"];
		$fullname = $_SESSION['IDAC'];
		$thoiDiemHienTai = date("Y-m-d");

		$query_phieunhap = "INSERT INTO import(IMPORTINGDATE, IDAC, IDSU, QUANITY,TOTALPAYMENT) VALUES ('$thoiDiemHienTai', '$fullname', '$nhaCungCap', 0,0)";
		mysqli_query($mysqli, $query_phieunhap);
		$id_phieunhap = mysqli_insert_id($mysqli);

		for ($i = 0; $i < count($sanPhamNhap); $i++) {
			$sanPham = $sanPhamNhap[$i];
			$mau = $mauNhap[$i];
			$soLuong = $soLuongNhap[$i];
			$gia = $donGia[$i];
			$query_insertChiTiet = "INSERT INTO detailimport (IDPR, IDIM, QUANITY, IMPROTPRICE,IDCO) VALUES ('$sanPham', '$id_phieunhap', '$soLuong', '$gia','$mau')";
			mysqli_query($mysqli, $query_insertChiTiet);
		}
		header('Location:../../index.php?action=quanlyphieunhap&query=lietke');
		echo "Thêm phiếu nhập và chi tiết phiếu nhập thành công!";
		
	}


	return;
}














if (isset($_POST['themphieunhap'])) {
	$thoiDiemHienTai = date("Y-m-d");
	$fullname = $_SESSION['IDAC'];
	$nhacungcap = $_POST['nhacungcap'];
	$sanPhamNhap = $_POST['sanPhamNhap'];
	$soluongnhap = $_POST['soluongnhap'];
	$dongia = $_POST['dongia'];

	// Lấy ID của phiếu nhập vừa được thêm vào
	$id_phieunhap = mysqli_insert_id($mysqli);
	$QUANITY = 0;
	// Thực hiện thêm chi tiết phiếu nhập
	if ($id_phieunhap) {
		foreach ($sanPhamNhap as $key => $id_sanpham) {
			$soLuongNhap = $soluongnhap[$key];
			$donGia = $dongia[$key];
			// Thực hiện câu lệnh SQL để thêm chi tiết phiếu nhập
			$query_insertChiTiet = "INSERT INTO tbl_chitietphieunhap (id_phieunhap, id_sanpham, soluongnhap, dongia) VALUES ('$id_phieunhap', '$id_sanpham', '$soLuongNhap', '$donGia')";
			mysqli_query($mysqli, $query_insertChiTiet);
			// cập nhật số lượng sản phẩm
			$query_getSoluongSanpham = "SELECT soluong FROM tbl_sanpham WHERE id_sanpham = '$id_sanpham'";
			$result = mysqli_query($mysqli, $query_getSoluongSanpham);
			$row = mysqli_fetch_assoc($result);
			$soluongHientai = $row['soluong'];

			$soluongMoi = (int)$soluongHientai +(int)$soLuongNhap;

			$query_updateSoluongSanpham = "UPDATE tbl_sanpham SET soluong = '$soluongMoi' WHERE id_sanpham = '$id_sanpham'";
			mysqli_query($mysqli, $query_updateSoluongSanpham);

			$thanhTien =(int) $soLuongNhap *(double) $donGia;
            $QUANITY += $thanhTien;
		}
		$query_updateQUANITY = "UPDATE import SET QUANITY = '$QUANITY' WHERE id_phieunhap = '$id_phieunhap'";
        mysqli_query($mysqli, $query_updateQUANITY);
		header('Location:../../index.php?action=quanlyphieunhap&query=lietke');
		echo "Thêm phiếu nhập và chi tiết phiếu nhập thành công!";
	} else {
		echo "Lỗi khi thêm phiếu nhập.";
	}
} else {
	echo "Lỗi khi cập nhật số lượng sản phẩm.";
}
