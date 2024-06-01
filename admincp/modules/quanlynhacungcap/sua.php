<?php
	$sql_sua_nhacungcap = "SELECT * FROM supplier WHERE IDSU='$_GET[IDSU]' LIMIT 1";
	$query_sua_nhacungcap = mysqli_query($mysqli,$sql_sua_nhacungcap);
?>

<div class="form">
   <div class="form-title">Sửa nhà cung cấp</div>
   <div class="form-content">
   <form method="POST" action="modules/quanlynhacungcap/xuli.php?IDSU=<?php echo $_GET['IDSU'] ?>">
   <?php
 	while($dong = mysqli_fetch_array($query_sua_nhacungcap)) {
 	?>
	  <div class="input1">
         <p>Tên nhà cung cấp</p>
	  	<input type="text" name="NAME" value="<?php echo $dong['NAME'] ?>">
	  </div>
	  <div class="input1">
	 
	    <p>Địa chỉ</p>
	    <input type="text" name="ADRESS" value="<?php echo $dong['ADRESS'] ?>">
	  </div>
	  <div class="input1">
         <p>Email</p>
	  	<input type="text" name="EMAIL" value="<?php echo $dong['EMAIL'] ?>">
	  </div>
	  <div class="input1">
	 
	    <p>Số điện thoại</p>
	    <input type="text" name="PHONENUMBER" value="<?php echo $dong['PHONENUMBER'] ?>">
	  </div>
	<div class="input2">
	<input type="submit" name="suanhacungcap" value="Sửa nhà cung cấp">
	</div>
    <?php } ?>
 </form>
   </div>
</div>
