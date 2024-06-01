<?php

$sql_color = "SELECT * FROM color ";
$query_color = mysqli_query($mysqli, $sql_color);



?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js "></script>


<div class="form2 form2-1">
    <div class="form-title">
        <p>Liệt kê Màu Sản phẩm </p>
    </div>
    <div class="form2-content">
        <table id="myTable7" class="table table-hover" style="width:100%; background-color: transparent !important; --bs-table-bg: unset !important;">
            <thead>
                <tr>
                    <th>Mã Màu</th>
                    <th>Tên Màu</th>
                    <th>Quản lí</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($query_color)) {
                    $i++;
                ?>
                    <tr>
                        <td><?= $row['IDCO'] ?></td>
                        <td><?= $row['NAME'] ?></td>
                        <td>
                            <?php
                            if (in_array(26, $_SESSION['IDAB_array'])) {
                                if ($row['IDCO'] != 1) {
                                    echo '<a href="?action=quanlycolor&query=sua&IDCO=' . $row['IDCO'] . '" style="background-color:green;padding: 10px;
                                    text-decoration: none;
                                    color: #fff;
                                    background-color: #1d1b31;
                                    border-radius: 8px;">Sửa</a> </br> </br>';
                                    if ($row['status'] == 1) {
                                        echo '<a href="modules/quanlicolor/xuli.php?IDCO=' . $row['IDCO'] . '&status=' . $row['status'] . '" style="background-color:green;padding: 10px;
                                        text-decoration: none;
                                        color: #fff;
                                        background-color: #1d1b31;
                                        border-radius: 8px;">Vô hiệu hóa</a>';
                                    } else {
                                        echo '<a href="modules/quanlicolor/xuli.php?IDCO=' . $row['IDCO'] . '&status=' . $row['status'] . '" style="background-color:green;padding: 10px;
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
        $('#myTable7').DataTable();
    });
</script>