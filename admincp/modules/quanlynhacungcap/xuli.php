<?php
include('../../config/config.php');
if (isset($_POST['themnhacungcap'])) {
	//them
	$name = $_POST['NAME'];
	$adress = $_POST['ADRESS'];
	$email =  $_POST['EMAIL'];
	$phonenumber =  $_POST['PHONENUMBER'];
	$sql_them = "INSERT INTO supplier(email,adress,phonenumber,name) VALUE('" . $email . "','" . $adress . "','" . $phonenumber . "','" . $name . "')";
	mysqli_query($mysqli, $sql_them);
	header('Location:../../index.php?action=quanlynhacungcap&query=them');
} elseif (isset($_POST['suanhacungcap'])) {
	//sua\
	$name = $_POST['NAME'];
	$adress = $_POST['ADRESS'];
	$email =  $_POST['EMAIL'];
	$phonenumber =  $_POST['PHONENUMBER'];
	$sql_update = "UPDATE supplier SET NAME='" . $name . "',ADRESS='" . $adress . "',EMAIL='" . $email . "',PHONENUMBER='" . $phonenumber . "' WHERE IDSU='$_GET[IDSU]'";
	mysqli_query($mysqli, $sql_update);
	header('Location:../../index.php?action=quanlynhacungcap&query=them');
} else {
	if ($_GET['status'] == 1) {
		$id = $_GET['IDSU'];

		$sql_xoa = "UPDATE supplier SET status= '0'  WHERE IDSU='" . $id . "'";
		$id = $_GET['IDSU'];
		$sql_xoasp = "UPDATE import SET IDSU = 1 where IDSU ='" . $id . "'";
	} else {
		$id = $_GET['IDSU'];
		$sql_xoa = "UPDATE supplier SET status= '1'  WHERE IDSU='" . $id . "'";
	}
	mysqli_query($mysqli, $sql_xoa);
	header('Location:../../index.php?action=quanlynhacungcap&query=them');
}
