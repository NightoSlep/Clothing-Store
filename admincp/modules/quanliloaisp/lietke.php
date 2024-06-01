<?php 
  
   $sql_loaisp = "SELECT * FROM categories ";
   $query_loaisp = mysqli_query($mysqli,$sql_loaisp);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js "></script>

<div class="form2">
    <div class="form-title">
        <p>Liệt kê Loại sản phẩm</p>
    </div>
    <div class="form2-content">
    <table id="myTable6" class="table table-hover" style="width:100%; background-color: transparent !important; --bs-table-bg: unset !important;">
    <thead>
        <tr>
            <th>Mã loại sản phẩm</th>
            <th>Tên Loại Sản phẩm</th>
            <th>Quản lí</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        while ($row = mysqli_fetch_array($query_loaisp)) {
            $i++;
            ?>
            <tr>
                <td><?= $row['IDCA'] ?></td>
                <td><?= $row['NAME'] ?></td>
                <td>
                    <?php
                    if (in_array(9, $_SESSION['IDAB_array'])) {
                        if ($row['IDCA'] != 1) {
                            echo '<a href="?action=quanlyloaisp&query=sua&IDCA=' . $row['IDCA'] . '" style="background-color:green;padding: 10px;
                            text-decoration: none;
                            color: #fff;
                            background-color: #1d1b31;
                            border-radius: 8px;">Sửa</a></br></br>';
                            if ($row['status'] == 1) {
                                echo '<a href="modules/quanliloaisp/xuli.php?IDCA=' . $row['IDCA'] . '&status=' . $row['status'] . '&NAME=' . $row['NAME'] . '" style="background-color:green;padding: 10px;
                                text-decoration: none;
                                color: #fff;
                                background-color: #1d1b31;
                                border-radius: 8px;">Vô hiệu hóa</a>';
                            } else {
                                echo '<a href="modules/quanliloaisp/xuli.php?IDCA=' . $row['IDCA'] . '&status=' . $row['status'] . '&NAME=' . $row['NAME'] . '" style="background-color:green;padding: 10px;
                                text-decoration: none;
                                color: #fff;
                                background-color: #1d1b31;
                                border-radius: 8px;">Khôi phục</a>';
                            }
                        }
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
        $('#myTable6').DataTable();
    });
</script>