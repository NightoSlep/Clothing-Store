<?php

$sql_sp = "SELECT IDPR,COST,Totalquanity,product.NAME,categories.NAME as NAMECA, product.status,RATINGPOINT,IMAGES FROM product,categories where product.IDCA =categories.IDCA   ORDER BY IDPR ASC";
$query_sp = mysqli_query($mysqli, $sql_sp);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script defer src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js "></script>
<STYle>
    tr {
        height: max-content;
    }

    th {
        margin: 0 !important;
    }
</STYle>
<div class="form2 form2-1">
    <div class="form-title">
        <p>Liệt kê Sản phẩm </p>
    </div>
    <div class="form2-content">
        <table id="myTable5"  class="table table-hover" style="width:100%; background-color: transparent !important; --bs-table-bg: unset !important;">
            <thead>
                <tr>
                    <th>Mã Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Loại sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Tình trạng</th>
                    <th>Điểm đánh giá</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($row = mysqli_fetch_array($query_sp)) {
                    $i++;
                ?>
                    <tr>
                        <td><?= $row['IDPR'] ?></td>
                        <td><?= $row['NAME'] ?></td>
                        <td><?= $row['COST'] ?></td>
                        <td><?= $row['Totalquanity'] ?></td>
                        <td><?= $row['NAMECA'] ?></td>
                        <td>
                            <?php
                            $images = explode(',', $row['IMAGES']);
                            $first_image = $images[0];
                            ?>
                            <img src="modules/quanlisanpham/uploads/<?php echo $first_image; ?>" alt="" class="img_brand">
                        </td>
                        <td><?php echo ($row['status'] == 1) ? 'Hiện' : 'Ẩn'; ?></td>
                        <td><?= $row['RATINGPOINT'] ?></td>
                        <td>
                            <?php if (in_array(26, $_SESSION['IDAB_array'])) { ?>
                                <a href="?action=quanlysp&query=sua&IDPR=<?php echo $row['IDPR'] ?>" style="background-color:green;padding: 10px;
                            text-decoration: none;
                            color: #fff;
                            background-color: #1d1b31;
                            border-radius: 8px;">Sửa</a> <br> <br>
                            <?php } ?>
                            <a href="?action=quanlysp&query=xemchitiet&IDPR=<?php echo $row['IDPR'] ?>" style="background-color:green;padding: 10px;
                            text-decoration: none;
                            color: #fff;
                            background-color: #1d1b31;
                            border-radius: 8px;">Chi tiết</a>
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
        $('#myTable5').DataTable();
    });
</script>