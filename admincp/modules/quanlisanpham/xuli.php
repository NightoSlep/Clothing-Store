<?php
include '../../config/config.php';

if (isset($_POST['themsanpham'])) {
	$NAME = $_POST['NAME'];
	$COST = $_POST['COST'];
	$Description  = $_POST['Description'];
	$STATUS = $_POST['STATUS'];
	$IDCA = $_POST['IDCA'];

	// Kiểm tra xem có tệp được tải lên không
	if (!empty($_FILES['IMAGES']['name'][0])) {
		// Tạo một mảng để lưu các tên hình ảnh mới
		$image_names = array();
		$destination_dir1 = 'uploads/';
		$destination_dir2 = '../../../FashionShop-main/upload/';
	
		// Kiểm tra sự tồn tại và quyền ghi của các thư mục đích
		if (!is_dir($destination_dir1)) {
			die("Thư mục đích thứ nhất không tồn tại.");
		}
		if (!is_writable($destination_dir1)) {
			die("Thư mục đích thứ nhất không có quyền ghi.");
		}
		if (!is_dir($destination_dir2)) {
			die("Thư mục đích thứ hai không tồn tại.");
		}
		if (!is_writable($destination_dir2)) {
			die("Thư mục đích thứ hai không có quyền ghi.");
		}
	
		foreach ($_FILES['IMAGES']['name'] as $key => $image_name) {
			$image_tmp = $_FILES['IMAGES']['tmp_name'][$key];
			$new_image_name = time() . '_' . $image_name;
			$image_names[] = $new_image_name;
	
			$destination_path1 = $destination_dir1 . $new_image_name;
			$destination_path2 = $destination_dir2 . $new_image_name;
	
			// Di chuyển tệp tải lên đến thư mục đích đầu tiên
			if (move_uploaded_file($image_tmp, $destination_path1)) {
				echo "Tệp đã được tải lên thành công đến: " . $destination_path1 . "<br>";
	
				// Sao chép tệp đến thư mục đích thứ hai
				if (copy($destination_path1, $destination_path2)) {
					echo "Tệp đã được sao chép thành công đến: " . $destination_path2 . "<br>";
				} else {
					echo "Không thể sao chép tệp đến: " . $destination_path2 . "<br>";
				}
			} else {
				echo "Không thể tải lên tệp: " . $image_name . "<br>";
			}
		}
	
		// Cập nhật danh sách ảnh vào CSDL
		$image_list = implode(',', $image_names);
	} else {
		// Nếu không có hình ảnh được tải lên, giữ nguyên danh sách ảnh trong CSDL
		$sql_select = "SELECT * FROM product WHERE IDPR = '$_GET[IDPR]' LIMIT 1";
		$query_select = mysqli_query($mysqli, $sql_select);
		$row_select = mysqli_fetch_array($query_select);
		$image_list = $row_select['images'];
	}

	// Tiếp tục với phần INSERT INTO product
	$sql_them = "INSERT INTO product(NAME,COST,Totalquanity,IDCA,Description,IMAGES,STATUS,RATINGPOINT) VALUES ('$NAME','$COST',0,'$IDCA','$Description','$image_list','$STATUS',0)";
	mysqli_query($mysqli, $sql_them);

	header('Location:../../index.php?action=quanlysanpham&query=them');
} elseif (isset($_POST['suasanpham'])) {
	//sua
	$NAME = $_POST['NAME'];
	$COST = $_POST['COST'];
	$Description  = $_POST['Description'];
	$STATUS = $_POST['STATUS'];
	$IDCA = $_POST['IDCA'];

	// Update thông tin cơ bản của sản phẩm
	$sql_update = "UPDATE product SET NAME='" . $NAME . "', COST='" . $COST . "', Description='" . $Description . "', STATUS='" . $STATUS . "', IDCA='" . $IDCA . "' WHERE IDPR='$_GET[IDPR]'";
	mysqli_query($mysqli, $sql_update);

	// Xử lý ảnh
	if (!empty($_FILES['IMAGES']['name'][0])) {
		$image_names = array();
		foreach ($_FILES['IMAGES']['name'] as $key => $image_name) {
			$image_tmp = $_FILES['IMAGES']['tmp_name'][$key];
			$new_image_name = time() . '_' . $image_name;
			$image_names[] = $new_image_name;
			move_uploaded_file($image_tmp, 'uploads/' . $new_image_name);

			move_uploaded_file($image_tmp, '../../FashionShop-main/upload/' . $new_image_name);

		}

		// Cập nhật danh sách ảnh vào CSDL
		$image_list = implode(',', $image_names);
		$sql_update_images = "UPDATE product SET images = '$image_list' WHERE IDPR = '$_GET[IDPR]'";
		mysqli_query($mysqli, $sql_update_images);

		// Xóa ảnh cũ
		$sql_select = "SELECT * FROM product WHERE IDPR = '$_GET[IDPR]' LIMIT 1";
		$query_select = mysqli_query($mysqli, $sql_select);
		$row_select = mysqli_fetch_array($query_select);
		$old_images = explode(',', $row_select['images']);
		foreach ($old_images as $old_image) {
			unlink('uploads/' . $old_image);
			$destination_path = '../../FashionShop-main/upload/' . $new_image_name;
			echo $destination_path;

		}
	}

	header('Location:../../index.php?action=quanlysanpham&query=them');
} else {
	$id = $_GET['IDPR'];
	$sql_select = "SELECT * FROM product WHERE IDPR = '$id' LIMIT 1";
	$query_select = mysqli_query($mysqli, $sql_select);
	while ($row_select = mysqli_fetch_array($query_select)) {
		unlink('uploads/' . $row_select['IMAGES']);
		unlink('../../FashionShop-main/uploads/' . $row_select['IMAGES']);


	}

	$sql_xoa = "DELETE FROM product WHERE IDPR='$id'";
	mysqli_query($mysqli, $sql_xoa);


	header('Location:../../index.php?action=quanlysanpham&query=them');
}
