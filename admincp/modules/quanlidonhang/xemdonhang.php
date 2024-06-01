<?php
$code = $_GET['IDOR'];
$status = $_GET['status'];
$sql_lietke_dh = "SELECT IDOR, product.NAME AS NAMEPR, COLOR.NAME AS NAMECO, detailorder.QUANITY, product.COST FROM detailorder,product,color WHERE detailorder.IDPR=product.IDPR 
    AND detailorder.IDCO = color.IDCO
    AND detailorder.IDOR='" . $code . "'";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);
?>

<form method="POST" action="modules\quanlidonhang\xuly_thaydoi_trangthai.php?IDOR=<?php echo $_GET['IDOR']?>&status=<?php echo $_GET['status']?>">
  <select name="trangthai" <?php if ($status == 0 || $status == 3) echo 'disabled'; ?>>
    <?php if ($status == 3) { ?>
      <option value="3" selected>Đã nhận hàng</option>
    <?php } ?>
    <?php if ($status != 2) { ?>
      <option value="0" <?php if ($status == 0) echo 'selected'; ?>>Đã hủy</option>
      <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Chờ duyệt</option>
    <?php } ?>
    <?php if ($status != 0 && $status != 3) { ?>
      <option value="2" <?php if ($status == 2) echo 'selected'; ?>>Đã xác nhận</option>
      <option value="3" <?php if ($status == 3) echo 'selected'; ?>>Đã nhận hàng</option>
    <?php } ?>
  </select>

  <?php if ($status == 1 || $status == 2) { ?>
    <div class="input2 input5-2">
      <input type="submit" name="luu" value="Lưu thay đổi">
    </div>
  <?php } ?>

  <input type="hidden" name="IDOR" value="<?php echo $code; ?>">
</form>



<p class="title_donhang">Xem đơn hàng</p>

<table style="width:100%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>Mã đơn hàng</th>
    <th>Tên sản phẩm</th>
    <TH>Màu</TH>
    <th>Số lượng</th>
    <th>Đơn giá</th>
    <th>Thành tiền</th>
  </tr>

  <?php
  $tongtien = 0;
  while ($row = mysqli_fetch_array($query_lietke_dh)) {
    $tongtien += $row['COST'] * $row['QUANITY'];
  ?>
    <tr class="tr_sp">
      <td><?php echo  $row['IDOR'] ?></td>
      <td><?php echo $row['NAMEPR'] ?></td>
      <td><?php echo $row['NAMECO'] ?></td>
      <td><?php echo $row['QUANITY'] ?></td>
      <td><?php echo number_format($row['COST'], 0, ',', '.') . 'VND' ?></td>
      <td><?php echo number_format($row['COST'] * $row['QUANITY'], 0, ',', '.') . 'VND' ?></td>
    </tr>
  <?php } ?>

  <tr>
    <td colspan="6">
      <p class="td_sp">Tổng tiền : <?php echo number_format($tongtien, 0, ',', '.') . 'VND' ?></p>
    </td>
  </tr>
</table>

<table>
  <th>
    <a href="index.php?action=quanlydonhang&query=them">Quay Lại trang đơn Hàng</a>
  </th>
</table>