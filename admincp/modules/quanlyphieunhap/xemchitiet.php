

<style>

  .title_donhang{
    text-align: center;
    padding: 20px;
    font-size: 25px;
    font-weight: 600;
    
  }
  .td_sp{
    float :right;
    margin-right: 25px;
  }
  .Thank{
    font-size: 25px;
    text-align: center;
    font-weight: 600;
  }
</style>

<p class="title_donhang">Xem chi tiết phiếu nhập</p>

<?php 

	$mysqli = new mysqli("localhost","root","","doan1");
  
	
	if ($mysqli->connect_errno) {
	  echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
	  exit();
	}

?>
<?php
  
	$code = $_GET['idphieunhap'];
	$sql_lietke_phieunhap = "SELECT * FROM detailimport,product WHERE IDIM='$code' and detailimport.IDPR = product.IDPR";
	$query_lietke_phieunhap = mysqli_query($mysqli,$sql_lietke_phieunhap);

  $sql_cart = "SELECT * FROM import WHERE IDIM='$code'";
  $query_cart = mysqli_query($mysqli,$sql_cart);
  $row1= mysqli_fetch_array($query_cart);  
?>
<p class="codecart">Mã phiếu nhập :  <?php echo $code ?></p>

<table style="width:100%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>Tên sản phẩm</th>
    <th>Màu</th>
    <th>Số lượng</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
  
  
  </tr >
  <?php
  $i = 0;
  $tongtien = 0;
  while($row = mysqli_fetch_array($query_lietke_phieunhap)){
  	$i++;
  ?>
  <tr class="tr_sp">
    <td><?php
    echo $row['NAME'];
 ?></td>
    <td><?php echo $row['QUANITY'] ?></td>
    <td><?php 
    
    $a= $row['IDCO'] ;
    
    $sql_cart12 = "SELECT * FROM color WHERE IDCO='$a'";
    $query_cart12 = mysqli_query($mysqli,$sql_cart12);
    $row12= mysqli_fetch_array($query_cart12);
    echo $row12['NAME'];
    ?></td>

    <td><?php echo number_format($row['IMPROTPRICE'],0,',','.').'VND' ?></td>
    <td><?php echo number_format($row['QUANITY']*$row['IMPROTPRICE'],0,',','.').'VND' ?></td>
   	
  </tr>
  <?php
  } 
  ?>

</table>
<h1 class="td_sp">Tổng tiền : <?php echo number_format($row1['TOTALPAYMENT'],0,',','.').'VND' ?></h1>
