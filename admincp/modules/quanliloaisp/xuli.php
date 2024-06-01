<?php
include('../../config/config.php');

if (isset($_POST['themloaisp'])) {
	//them
	$NAME = $_POST['NAME'];

	$sql_them = "INSERT INTO categories(NAME) VALUE('" . $NAME . "')";
	mysqli_query($mysqli, $sql_them);
	header('Location:../../index.php?action=quanlyloaisp&query=them');
} elseif (isset($_POST['sualoaisp'])) {
	//sua
	$NAME = $_POST['NAME'];

	$sql_update = "UPDATE categories SET NAME='" . $NAME . "'WHERE IDCA='$_GET[IDCA]'";
	mysqli_query($mysqli, $sql_update);
	header('Location:../../index.php?action=quanlyloaisp&query=them');
} else {


	if ($_GET['status'] == 1) {
		$id = $_GET['IDCA'];
		$sql_xoasp = "UPDATE PRODUCT SET IDCA = 1 where IDCA ='" . $id . "'";
		$sql_xoa = "UPDATE categories SET status= '0'  WHERE IDCA='" . $id . "'";
		mysqli_query($mysqli, $sql_xoasp);
	} else
		$sql_xoa = "UPDATE categories SET status='1'  WHERE IDCA='" . $id . "'";
	mysqli_query($mysqli, $sql_xoa);
	header('Location:../../index.php?action=quanlyloaisp&query=them');
}
