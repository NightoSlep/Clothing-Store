<?php
include('../../config/config.php');

if (isset($_POST['themnhanvien'])) {
	$quyen = $_POST['quyen'];
	$gender = $_POST['gender'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$sdt = $_POST['sdt'];
	$email = $_POST['email'];
	$ADRESS = $_POST['ADRESS'];
	$sql_them = "INSERT INTO account(GENDER,PASSWORD,FULLNAME,NUMBERPHONE,EMAIL,ADRESS,IDPE) VALUES ('$gender','$password','$fullname','$sdt',
    '$email','$ADRESS','$quyen')";
	mysqli_query($mysqli, $sql_them);
	header('Location:../../index.php?action=quanlynhanvien&query=them');
} elseif (isset($_POST['suanhanvien'])) {
	//sua
	$quyen = $_POST['quyen'];
	$gender = $_POST['gender'];
	$password = $_POST['password'];
	$fullname = $_POST['fullname'];
	$sdt = $_POST['sdt'];
	$email = $_POST['email'];
	$ADRESS = $_POST['ADRESS'];
	$sql_update = "UPDATE account SET GENDER='" . $gender . "',PASSWORD='" . $password . "' ,IDPE = '$quyen',FULLNAME='" . $fullname . "',NUMBERPHONE='" . $sdt . "',EMAIL='" . $email . "',ADRESS='" . $ADRESS . "' WHERE IDAC='$_GET[IDAC]'";
	mysqli_query($mysqli, $sql_update);
	header('Location:../../index.php?action=quanlynhanvien&query=them');
} else {
	$id = $_GET['IDAC'];
	if ($_GET['status'] == 1)
		$sql_xoa = "UPDATE account SET status= '0'  WHERE IDAC='" . $id . "'";
	else
		$sql_xoa = "UPDATE account SET status= '1'  WHERE IDAC='" . $id . "'";
	mysqli_query($mysqli, $sql_xoa);
	header('Location:../../index.php?action=quanlynhanvien&query=them');
}
