<?php

$sql_nhanvien = "SELECT account.*, permission.NAME as namepe FROM account INNER JOIN permission ON account.IDPE = permission.IDPE";
$query_nhanvien = mysqli_query($mysqli, $sql_nhanvien);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js "></script>
<div class="form2" style="width:100%">
    <div class="form-title">
        <p>Liệt kê tài khoản</p>
    </div>
    <div class="form2-content">
    <table id="myTable3" class="table table-hover" style="width:100%; background-color: transparent !important; --bs-table-bg: unset !important;">
    <thead>
        <tr>
            <th>Mã tài khoản</th>
            <th>Tên</th>
            <th>Tên Quyền</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_nhanvien)) {
            $i++;
        ?>
            <tr>
                <td><?= $row['IDAC'] ?></td>
                <td><?= $row['FULLNAME'] ?></td>
                <td><?= $row['namepe'] ?></td>
                <td><?= $row['EMAIL'] ?></td>
                <td><?= $row['BIRTH'] ?></td>
                <td><?= $row['NUMBERPHONE'] ?></td>
                <td><?= $row['ADRESS'] ?></td>
                <td>
                    <?php
                    if ($row['status'] == 1) {
                        echo "Hiện";
                    } else {
                        echo "Ẩn";
                    }
                    ?>
                </td>
                <td>
                    <?php if (in_array(5, $_SESSION['IDAB_array'])) { ?>
                        <a href="?action=quanlynhanvien&query=sua&IDAC=<?php echo $row['IDAC'] ?>" style="padding: 10px;
    text-decoration: none;
    color: #fff;
    background-color: #1d1b31;
    border-radius: 8px;">Sửa</a> <br> <br>
                        <?php
                        if ($row['status'] == 1) {
                            echo '<a href="modules/quanlynhanvien/xuli.php?IDAC=' . $row['IDAC'] . '&status=' . $row['status'] . '" style="padding: 10px;
                            text-decoration: none;
                            color: #fff;
                            background-color: #1d1b31;
                            border-radius: 8px;">Khóa</a>';
                        } else {
                            echo '<a href="modules/quanlynhanvien/xuli.php?IDAC=' . $row['IDAC'] . '&status=' . $row['status'] . '" style="background-color:green;padding: 10px;
                            text-decoration: none;
                            color: #fff;
                            background-color: #1d1b31;
                            border-radius: 8px;">Khôi phục</a>';
                        }
                        ?>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


    </div>

</div>
<script>
    $(document).ready(function() {
        $('#myTable3').DataTable();
    });
</script>