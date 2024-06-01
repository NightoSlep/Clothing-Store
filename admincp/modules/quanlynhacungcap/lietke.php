<?php

$sql_nhacungcap = "SELECT * FROM supplier ORDER BY 	IDSU ASC";
$query_nhacungcap = mysqli_query($mysqli, $sql_nhacungcap);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js "></script>
<style>
    th {
        padding: 10px 0;
        ;
    }
</style>
<div class="form2" style="width:100%">
    <div class="form-title">
        <p>Liệt kê nhà cung cấp</p>
    </div>
    <div class="form2-content">
    <table id="myTable4" class="table table-hover" style="width:100%; background-color: transparent !important; --bs-table-bg: unset !important;">
    <thead>
        <tr>
            <th>Mã nhà cung cấp</th>
            <th>Tên nhà cung cấp</th>
            <th>Trạng thái</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Thao tác</th> <!-- Thêm cột Thao tác -->
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_nhacungcap)) {
            $i++;
        ?>
            <tr>
                <td><?php echo $row['IDSU']; ?></td>
                <td><?php echo $row['NAME']; ?></td>
                <td><?php echo ($row['status'] == 0) ? 'Vô hiệu hóa' : 'Sẵn sàng'; ?></td>
                <td><?= $row['ADRESS'] ?></td>
                <td><?= $row['PHONENUMBER'] ?></td>
                <td><?= $row['EMAIL'] ?></td>
                <td>
                    <?php
                    if (in_array(10, $_SESSION['IDAB_array']) && $row['IDSU'] != 1) {
                        echo '<a href="?action=quanlynhacungcap&query=sua&IDSU=' . $row['IDSU'] . '&name=' . $row['NAME'] . '&adress=' . $row['ADRESS'] . '&phonenumber=' . $row['PHONENUMBER'] . '&email=' . $row['EMAIL'] . '" style="padding: 10px;
                        text-decoration: none;
                        color: #fff;
                        background-color: #1d1b31;
                        border-radius: 8px;">Sửa</a>';
                        echo ($row['status'] == 1) ?
                            '<a href="modules/quanlynhacungcap/xuli.php?IDSU=' . $row['IDSU'] . '&status=' . $row['status'] . '" class="btn btn-danger">Vô hiệu hóa</a>' :
                            '<a href="modules/quanlynhacungcap/xuli.php?IDSU=' . $row['IDSU'] . '&status=' . $row['status'] . '" class="btn btn-success">Khôi phục</a>';
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


    </div>

</div>
<script>
    $(document).ready(function() {
        $('#myTable4').DataTable();
    });
</script>