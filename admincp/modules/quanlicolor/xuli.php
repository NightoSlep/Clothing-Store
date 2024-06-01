<?php

include('../../config/config.php');


if (isset($_POST['themthuonghieu'])) {
	$NAME = $_POST['NAME'];

	$sql_them = "INSERT INTO color(NAME) VALUE('" . $NAME . "')";
	mysqli_query($mysqli, $sql_them);
	header('Location:../../index.php?action=quanlycolor&query=them');
} elseif (isset($_POST['suathuonghieu'])) {
	$NAME = $_POST['NAME'];
	$sql_update = "UPDATE color SET NAME='" . $NAME . "' WHERE IDCO ='$_GET[IDCO]'";

	//xoa hinh anh cu
	$sql = "SELECT * FROM color WHERE IDCO = '$_GET[IDCO]' LIMIT 1";
	$query = mysqli_query($mysqli, $sql);
	mysqli_query($mysqli, $sql_update);
	header('Location:../../index.php?action=quanlycolor&query=them');
} else {

	if ($_GET['status'] == 1) {
		$id = $_GET['IDCO'];
		$sql_xoasp = "UPDATE detailproduct SET IDCO = 1 where IDCO ='" . $id . "'";
		$sql_xoa = "UPDATE color SET status=0  WHERE  IDCO='" . $id . "'";
		mysqli_query($mysqli, $sql_xoasp);
	} else{
		$id = $_GET['IDCO'];

		$sql_xoa = "UPDATE color SET status=1  WHERE  IDCO='" . $id . "'";
	}
	mysqli_query($mysqli, $sql_xoa);
	header('Location:../../index.php?action=quanlycolor&query=them');
}
