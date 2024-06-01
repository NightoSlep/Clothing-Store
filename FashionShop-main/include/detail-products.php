<?php $id_sp = $_GET['sp'];
$sql_sp = "SELECT * FROM product, categories WHERE product.IDCA = categories.IDCA AND product.IDPR = '$id_sp'";

$query_ca = mysqli_query($con, $sql_sp);
$data = mysqli_fetch_assoc($query_ca);

$sql_chitietsp = "SELECT color.NAME, color.IDCO, detailproduct.QUANITY
                    FROM detailproduct
                    JOIN color ON detailproduct.IDCO = color.IDCO
                    WHERE detailproduct.IDPR = '$id_sp' 
                    ";
$query_chitiet = mysqli_query($con, $sql_chitietsp);
$query_chitiet1 = mysqli_query($con, $sql_chitietsp);

$data_chitiet =  mysqli_fetch_assoc($query_chitiet);


$sql_name = "SELECT NAME FROM product WHERE IDPR = '$id_sp'";
$query_pr = mysqli_query($con, $sql_name);
$data_name = mysqli_fetch_assoc($query_pr);


$sql_distinc = "SELECT DISTINCT IDPR FROM detailproduct";
$query_distinc1 = mysqli_query($con, $sql_distinc);
$query_distinc = mysqli_query($con, $sql_distinc);

?>
<style>
    .chitiet-sp {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex-direction: row;
        flex-wrap: wrap !important;
        /* Thêm thuộc tính flex-wrap để các phần tử con tự động dàn xếp theo hàng */
    }

    .wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .images {
        width: 100%;
        height: 350px;
    }

    .container-sp {
        flex: 1;
    }

    .title-sp {
        margin-bottom: 10px;
    }

    .title-sp h3 {
        margin: 0;
    }

    .content {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        /* Căn trái cho nội dung */
        margin-left: 120px;
    }

    .add-about,
    .add-cart,
    .add-cart-now {
        text-align: center;
    }

    .add-about {
        margin-bottom: 10px;
        margin-left: 120px;
    }

    .title-sp {
        margin-bottom: 10px;
        text-align: right;
    }

    .loaisp,
    .color,
    .gia,
    .soluong {
        text-align: right;
    }

    /* css của thông báo nhập quá số lượng */
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

    .add-to-cart-button {
        background-color: green;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        width: 350px;
    }

    .buy-now-button {
        margin-top: 5px;
        background-color: blue;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        width: 350px;
    }
</style>

<div class="chitiet-sp">

    <form action="cart.php" method="GET" onsubmit="return validateOrder()">
        <br>
        <div class="wrapper">
            <div>
                <img src="upload/<?php echo $data['IMAGES'] ?>" alt="Images" class="images">
            </div>
            <div class="container-sp">
                <div class="title-sp">
                    <h3><?php echo $data_name['NAME'] ?></h3>
                </div>
                <div class="content">
                    <div class="loaisp">
                        <b>Loại sản phẩm:</b>
                        <?php echo $data['NAME'] ?>
                    </div>
                    <div class="color">
                        <b>Màu sắc:</b>
                        <select name="id_color" id="id_color">
                            <?php while ($data_distinc1 = mysqli_fetch_array($query_distinc1)) {
                                if ($data_distinc1['IDPR'] == $id_sp) {
                                    $flag = 1;
                                    break;
                                } else {
                                    $flag = 0;
                                }
                            }
                            if ($flag == 1) {
                                while ($data_color = mysqli_fetch_array($query_chitiet1)) {
                            ?>
                                    <option value="<?php
                                                    echo $data_color['IDCO'];
                                                    ?>">
                                        <?php echo $data_color['NAME']; ?>
                                    </option>
                                <?php       }
                            } else { ?>
                                <option value="">Chưa có sản phẩm</option>
                            <?php   }
                            ?>
                        </select>
                    </div>
                    <div class="soluong" id="soluong">
                       
                    </div>
                    <div class="gia">
                        <b>Giá:</b>
                        <?php echo $data['COST'] ?> VND
                    </div>
                </div>
                <div class="add-about">
                    <div>
                        <label for="soluong">Số lượng hàng muốn đặt:</label>
                        <input type="number" id="cart_" name="soluong" value="0" onchange="return checksoluong(value,<?php echo $product_quanity; ?>)">

                        <input type="hidden" name="id_product" value="<?php echo $data['IDPR'] ?>">
                        <input type="hidden" name="action" id="action" value="add">
                    </div>
                    <div class="add-cart">
                        <button type="submit" class="add-to-cart-button" id="add-cart-button">Thêm vào giỏ</button>
                    </div>
                    <div class="add-cart-now">
                        <button type="submit" class="buy-now-button" onclick="return addnow()">Mua ngay</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
<!-- <script>
    function changeNumber(id_product, id_color){

    }
</script> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    loadProductDetails();

    $('#id_color').change(function() {
        var id_sp = '<?php echo $id_sp; ?>';
        var id_color = $(this).val();
        
        // Gửi yêu cầu AJAX
        $.ajax({
            url: 'include/get_product_details.php',
            type: 'POST',
            data: {id_sp: id_sp, id_color: id_color},
            success: function(response) {
                // Cập nhật thông tin sản phẩm dựa trên dữ liệu nhận được từ server
                $('#soluong').text('Số lượng hàng còn lại: ' + response);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi gửi yêu cầu AJAX: ', error);
            }
        });
    });
    function loadProductDetails() {
    var id_sp = '<?php echo $id_sp; ?>';
    var id_color = $('#id_color').val();
    
    // Gửi yêu cầu AJAX
    $.ajax({
        url: 'include/get_product_details.php',
        type: 'POST',
        data: {id_sp: id_sp, id_color: id_color},
        success: function(response) {
            // Cập nhật thông tin sản phẩm dựa trên dữ liệu nhận được từ server
            $('#soluong').text('Số lượng hàng còn lại: ' + response);
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gửi yêu cầu AJAX: ', error);
        }
    });
}


});
</script>
<script>
    function validateOrder() {
        // Lấy số lượng hàng còn lại từ phần tử có id 'soluong'
        var remainingQuantity = parseInt(document.getElementById('soluong').innerText.split(':')[1].trim());
        
        // Lấy số lượng yêu cầu từ trường nhập liệu
        var requestedQuantity = parseInt(document.getElementById('cart_').value);
        
        // Kiểm tra nếu số lượng yêu cầu vượt quá số lượng hàng còn lại
        if (requestedQuantity > remainingQuantity) {
            // Hiển thị thông báo lỗi
            alert('Số lượng hàng muốn đặt vượt quá số lượng hàng còn lại!');
            return false; // Ngăn chặn gửi form
        }
        return true; // Cho phép gửi form nếu không có lỗi
    }
</script>


<?php include "other-products.php"; ?>