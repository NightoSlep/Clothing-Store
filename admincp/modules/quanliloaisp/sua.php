
<?php
	$sql_sua_loaisp = "SELECT * FROM categories WHERE IDCA='$_GET[IDCA]' LIMIT 1";
	$query_sua_loaisp = mysqli_query($mysqli,$sql_sua_loaisp);
?>



<div class="form">
   <div class="form-title">Sửa loại Sản Phẩm </div>
   <div class="form-content">
   <form method="POST" action="modules/quanliloaisp/xuli.php?IDCA=<?php echo $_GET['IDCA'] ?>">
   <?php
 	while($dong = mysqli_fetch_array($query_sua_loaisp)) {
 	?>
	  <div class="input1">
         <p>Tên Loại sản phẩm</p>
	  	<input type="text" name="NAME" value="<?php echo $dong['NAME'] ?>">
	  </div>
	  <div class="input1">
	<div class="input2">
	<input type="submit" name="sualoaisp" value="Sửa Loại sản phẩm">
	</div>
    <?php } ?>
 </form>
   </div>
</div>