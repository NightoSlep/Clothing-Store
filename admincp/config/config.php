<?php 

	$mysqli = new mysqli("localhost","root","","doan1");

	
	if ($mysqli->connect_errno) {
	  echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
	  exit();
	}

?>