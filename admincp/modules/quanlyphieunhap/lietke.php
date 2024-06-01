<?php

$sql_phieunhap = "SELECT * FROM import ORDER BY IDIM ASC";
$query_phieunhap = mysqli_query($mysqli, $sql_phieunhap);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js "></script>

<div class="form">
    <?php if (in_array(10, $_SESSION['IDAB_array'])) { ?>
        <div class="form-title">
            <p>Liệt kê Danh sách phiếu nhập</p>
            <a href="?action=quanlyphieunhap&query=them" style="display: inline-block;
  padding: 10px 20px;
  font-size: 16px;
  text-align: center;
  text-decoration: none;
  background-color: rgb(11, 7, 247);
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;" onmouseover="this.style.backgroundColor='red'" onmouseout="this.style.backgroundColor='rgb(11, 7, 247)'">Thêm phiếu nhập</a>
        </div>
    <?php } ?>
    <div class="form2-content">
        <table id="myTable1" class="table table-hover" style="width:100%; background-color: transparent !important;  --bs-table-bg: unset !important;">
            <thead>
                <tr>
                    <th>Mã phiếu nhập</th>
                    <th>Người nhập</th>
                    <th>Ngày nhập</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($query_phieunhap)) {
                    $i++;
                ?>
                    <tr>
                        <th><?= $row['IDIM'] ?></th>
                        <th><?php
                            $idUser = $row['IDAC'];
                            $selectUserByid = "SELECT FULLNAME FROM account WHERE IDAC = '$idUser'";
                            $queryUserByid = mysqli_query($mysqli, $selectUserByid);
                            $userRow = mysqli_fetch_assoc($queryUserByid);
                            echo $userRow['FULLNAME'];
                            ?></th>

                        <th><?php
                            $dateFormatted = date('d/m/Y - h:m:i', strtotime($row['IMPORTINGDATE']));
                            echo $dateFormatted;
                            ?></th>

                        <th><?php echo number_format($row['TOTALPAYMENT'], 0, ',', '.') . "đ" ?></th>
                        <th>
                            <a href="?action=quanlyphieunhap&query=xemchitiet&idphieunhap=<?php echo $row['IDIM'] ?>" style="padding: 10px;
    text-decoration: none;
    color: #fff;
    background-color: #1d1b31;
    border-radius: 8px;">Xem chi tiết</a>
                        </th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div>

</div>
<script>
    $(document).ready(function() {
        $('#myTable1').DataTable();
    });
</script>