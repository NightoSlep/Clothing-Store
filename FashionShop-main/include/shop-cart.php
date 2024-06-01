<?php
include "./admincp/config/config.php";

if (!empty($_SESSION['user']) && isset($_SESSION['user'])) {
    $user = $_SESSION['user']['email'];
    $cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];
    $i = 1;
    $endbill = 0;

?>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 20%;
    }

/* button form */
    #okButton {
        background-color: red;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #okButton:hover {
        background-color: #45a049;
    }

    #okButton:1 {
        background-color: #3e8e41;
    }

    #okButton2 {
        background-color: red;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #okButton2:hover {
        background-color: #45a049;
    }

    #okButton2:1 {
        background-color: #3e8e41;
    }
</style>

<div id="main">
    <?php if (isset($_GET['action']) == 'tk') { ?>
        <script type="text/javascript">
            if (alert("Bạn đã đặt hàng thành công!")) {
                header('location:index.php?id=quanlytaikhoan');
            }
        </script>
    <?php } ?>
    <div>
        <br>
        <H1>Giỏ hàng</H1>
        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Màu</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Thành tiền</th>
                <th>Thao tác</th>
            </tr>
            <?php $i = 1;
            foreach ($cart as $key => $value): ?>
                <tr>
                    <th> <?php echo $i++; ?></th>
                    <th><img src="./upload/<?php echo $value['images'] ?>" alt=""
                            style="max-width: 100px;max-height: 100px;"></th>
                    <th><?php echo $value['name'] ?></th>
                    <th><?php
                    $value_color = $value['id_color'];
                    $sql_color = "SELECT NAME FROM color WHERE IDCO = '$value_color'";
                    $query_color = mysqli_query($con, $sql_color);
                    $color = mysqli_fetch_assoc($query_color);
                    echo $color['NAME'];
                    ?>
                    </th>
                    <form action="cart.php" method="GET"> 
                        <th><input type="number" id="soluong" value="<?php echo $value['cart_number'] ?>"
                                onchange="return checksoluonggiohang(value,<?php echo $value['total_quanity'] ?>)"
                                name="soluong">
                            <input type="hidden" value="<?php echo $value['productId'] ?>" name="productId">
                            <input type="hidden" value="<?php echo $value['id_color'] ?>" name="id_color">
                            <input type="hidden" value="<?php echo $value['cost'] ?>" name="cost">
                            <input type="hidden" value="update" name="action">
                        </th>
                        <th><?php echo $value['cost'] ?> VND</th>
                        <th><?php echo $bill = $value['cost'] * $value['cart_number'];
                        $endbill = $endbill + $bill ?> VND</th>
                        <th>
                            <button class="btn btn-outline-warning" type="submit">Cập nhật</button>
                    </form>

                    <div> 
                        <a href="cart.php?action=delete&productId=<?php echo $value['productId']; ?>&id_color=<?php echo $value['id_color'] ?>" id="xoa">
                            <button class="btn btn-outline-danger" type="button">Xóa</button>
                        </a>

                    </div>
                    </th>
                </tr>
            <?php endforeach ?>
            <tr>
                <th></th>
                <th></th>
                <!-- <th><button class="btn btn-primary" type="submit"><a href="index.php" style="text-decoration: none; color:black">Trở lại trang chủ </a></button></th> -->
                <th></th>
                <th></th>
                <th></th>
                <th>Tổng tiền</th>
                <th><?php echo $endbill ?> VND</th>
                <th></th>
            </tr>
        </table>
    </div>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
        <div>
            <div>
                <h1>Thanh toán</h1>
            </div>
            <div style="width: 35%;">
                <form action="cart.php?action=thanhtoan" method="POST">
                    <div class="form-group">
                        <strong>Tổng hóa đơn: <?php echo $endbill ?> VND</strong>
                        <input type="hidden" name="tongtien" id="tongtien" value="<?php echo $endbill ?>">
                    </div>
                    <div>
                        <button type="submit">THANH TOÁN</button>
                    </div>
                </form>
            </div>
        </div>
    <?php }
     } else { ?>
</div>
<div id="myModal" class="modal">
    <div class="modal-content">
        <p>Yêu cầu vượt quá số lượng tồn kho</p>
        <button id="okButton">OK</button>
    </div>
</div>

<div id="myModal2" class="modal">
    <div class="modal-content">
        <p>Yêu cầu số lượng không phù hợp</p>
        <button id="okButton2">OK</button>
    </div>
</div>
<script>
     location.href = 'index.php?id=signin';
</script>
<?php  } ?>