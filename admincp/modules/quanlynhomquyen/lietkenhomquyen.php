<?php

$sql_nhacungcap = "SELECT * FROM permission  ORDER BY IDPE ASC";
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
    <?php if (in_array(30, $_SESSION['IDAB_array'])) {
    ?>
        <a href="?action=quanlynhomquyen&query=sua1" style="padding: 10px;
    color: #fff;
    background-color: #1d1b31;
    border-radius: 8px;">Thêm nhóm quyền</a>
    <?php } ?>
    <div class="form-title">
        <p>Liệt kê các nhóm quyền</p>
    </div>
    <div class="form2-content">
    <table id="myTable2" class="table  table-hover" style="width:100%; background-color: transparent !important;  --bs-table-bg: unset !important;">
    <thead>
        <tr>
            <th>Mã nhóm quyền</th>
            <th>Tên nhóm quyền</th>
            <th>Mô tả</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_nhacungcap)) {
            $i++;
        ?>
            <tr>
                <td><?php echo $row['IDPE']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?= $row['Description'] ?></td>
                <td>
                    <?php
                    if ($row['IDPE'] != 1 && $row['IDPE'] != 6) {
                        echo '<a href="?action=quanlynhomquyen&query=sua&IDPE=' . $row['IDPE'] . '&Name=' . $row['Name'] . '"  style="padding: 10px;
                        text-decoration: none;
                        color: #fff;
                        background-color: #1d1b31;
                        border-radius: 8px;">Xem chi tiết</a></br></br>';
                    }
                    if (in_array(30, $_SESSION['IDAB_array']) && $row['IDPE'] != 1 && $row['IDPE'] != 6) {
                        echo '<a href="modules/quanlynhomquyen/xuly.php?action=xoa&query=sua&IDPE=' . $row['IDPE'] . '&Name=' . $row['Name'] . '"  style="padding: 10px;
                        text-decoration: none;
                        color: #fff;
                        background-color: #1d1b31;
                        border-radius: 8px;">Xóa nhóm quyền</a>';
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
        $('#myTable2').DataTable();
    });
</script>