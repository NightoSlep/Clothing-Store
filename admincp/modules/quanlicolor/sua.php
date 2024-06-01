<?php 
    
    $sql_sua_color = "SELECT * FROM color WHERE IDCO = '$_GET[IDCO]'";
    $query_sua_color = mysqli_query($mysqli,$sql_sua_color);


?>




<div class="form">
   <div class="form-title">Sửa Màu Sản Phẩm </div>
   <div class="form-content">
<?php 
  
  while($row= mysqli_fetch_array($query_sua_color)){

?>
   <form method="POST" action="modules/quanlicolor/xuli.php?IDCO=<?php echo $row['IDCO'] ?>" enctype="multipart/form-data">
	  
	  <div class="input1">
         <p>Tên Màu</p>
	  	<input type="text" name="NAME" value="<?= $row['NAME'] ?>">
	  </div>
	<div class="input2">
	<input type="submit" name="suathuonghieu" value="Sửa MÀU sản phẩm">
	</div>
 </form>
 <?php } ?>
   </div>
</div>