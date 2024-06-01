<?php

$mysqli = new mysqli("localhost", "root", "", "doan1");

if ($mysqli->connect_errno) {
    echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
    exit();
}

?>
<?php

if (isset($_GET['action']) && $_GET['action'] == 'them') {
    if (isset($_GET['IDPR'])) {
        $id = $_GET['IDPR'];
        $idco = $_POST['IDCO'];
        $sql_them = "INSERT INTO detailproduct(IDCO,IDPR,QUANITY,status) VALUE('" . $idco . "','" . $id . "',0,1)";
        mysqli_query($mysqli, $sql_them);
        header('Location: ../../index.php?action=quanlysp&query=xemchitiet&IDPR=' . $id);

        return;
    } else {
        echo "IDPR không được thiếu!";
    }
}

if (isset($_GET['status'])) {
    $id = $_GET['IDPR']; // Gán giá trị cho biến $id
    $idco = $_GET['IDCO'];
    if ($_GET['status'] == 1) {
        $sql_xoa = "UPDATE detailproduct SET status = 0 WHERE IDPR = '" . $id . "' AND IDCO ='" . $idco . "'";
    } else {
        $sql_xoa = "UPDATE detailproduct SET status = 1 WHERE IDPR = '" . $id . "' AND IDCO ='" . $idco . "'";
    }
    mysqli_query($mysqli, $sql_xoa);
    echo '<script>window.location.href = "index.php?action=quanlysp&query=xemchitiet&IDPR=' . $id . '";</script>';
    exit;
}

?>
<style>
    .title_donhang {
        text-align: center;
        padding: 20px;
        font-size: 25px;
        font-weight: 600;

    }

    .td_sp {
        float: right;
        margin-right: 25px;
    }

    .Thank {
        font-size: 25px;
        text-align: center;
        font-weight: 600;
    }
</style>
<form method="POST" action="modules/quanlisanpham/chitietsp.php?action=them&IDPR=<?php echo $_GET['IDPR'] ?>" enctype="multipart/form-data">
    <div class="input2 input5-2">
        <input type="submit" name="themsanpham" value=" Thêm Sản Phẩm">
    </div>

    <div class="input1 input5">
        <p>Màu sắc</p>
        <div class="custom-select" style="width:200px;">
            <select name="IDCO">
                <?php
                $IDPR = $_GET['IDPR'];

                // Truy vấn SQL để lấy ra những màu mà chưa có trong bảng detailproduct của sản phẩm hiện tại
                $sql_color = "SELECT * FROM color WHERE IDCO NOT IN (SELECT IDCO FROM detailproduct WHERE IDPR = '$IDPR')";
                $query_color = mysqli_query($mysqli, $sql_color);

                // Duyệt qua kết quả truy vấn để hiển thị các tùy chọn màu
                while ($row_color = mysqli_fetch_array($query_color)) {
                    echo "<option value='$row_color[IDCO]'>$row_color[NAME]</option>";
                }
                ?>
            </select>
        </div>
    </div>
</form>
<p class="title_donhang">Xem chi tiết các sản phẩm</p>

<?php

$mysqli = new mysqli("localhost", "root", "", "doan1");


if ($mysqli->connect_errno) {
    echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
    exit();
}

?>
<?php

$code = $_GET['IDPR'];
$sql_lietke_phieunhap = "SELECT detailproduct.IDPR, detailproduct.QUANITY,detailproduct.status,product.NAME AS NAMEPR, color.NAME AS NAMECO ,color.IDCO FROM detailproduct,color,product WHERE product.IDPR='$code' and product.IDPR = detailproduct.IDPR and color.IDCO = detailproduct.IDCO";
$query_lietke_phieunhap = mysqli_query($mysqli, $sql_lietke_phieunhap);
?>
<table style="width:100%" border="1" style="border-collapse: collapse;">
    <tr>
        <th>Số thứ tự</th>
        <th>Tên sản phẩm</th>
        <th>Số lượng</th>
        <th>Màu</th>
        <th>Trạng thái</th>


    </tr>
    <?php

    $i = 0;
    while ($row = mysqli_fetch_array($query_lietke_phieunhap)) {
        $i++;

    ?>
        <tr>
            <th><?= $i ?></th>

            <th class="width1"><?= $row['NAMEPR'] ?></th>
            <th><?= $row['QUANITY'] ?></th>
            <th><?= $row['NAMECO'] ?></th>
            <th>
                <?php
                if ($row['status'] == 1) {
                    echo "Hiện";
                } else {
                    echo "Ẩn ";
                }
                ?>
            </th>
            <th style="width:max-content">
                <?php if (in_array(26, $_SESSION['IDAB_array'])) {
                    if ($row['status'] == 1) { ?>
                        <a href="#" onclick="confirmAction('?action=quanlysp&query=xemchitiet&IDPR=<?php echo $row['IDPR'] ?>&status=1&IDCO=<?php echo $row['IDCO'] ?>')">Tạm ẩn</a>
                    <?php } else { ?>
                        <a href="#" onclick="confirmAction('?action=quanlysp&query=xemchitiet&IDPR=<?php echo $row['IDPR'] ?>&status=0&IDCO=<?php echo $row['IDCO'] ?>')">Hiện lại</a>
                <?php }
                } ?>

            </th>
        </tr>

    <?php
    }
    ?>

</table>
<script>
    function confirmAction(actionUrl) {
        if (confirm("Bạn có chắc chắn muốn thực hiện hành động này không?")) {
            window.location.href = actionUrl;
        } else {}
    }
</script>