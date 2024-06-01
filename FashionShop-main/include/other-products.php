<?php
$idloaisp = $data['IDCA'];
$sql_sp_goiy = "SELECT * FROM product WHERE IDCA='$idloaisp' AND status='1' LIMIT 4";
$query = mysqli_query($con, $sql_sp_goiy);
?>

<style>
    .hot_deal {
        max-width: 1200px;
        margin: 0 auto;
    }

    .content-sp {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .card {
        width: calc(25% - 10px); /* Đặt chiều rộng cho mỗi sản phẩm, trừ đi khoảng cách giữa các sản phẩm */
        margin-bottom: 20px;
        box-sizing: border-box;
    }

    .card-container {
        position: relative;
        text-align: center;
    }

    .card-container img {
        max-width: 100%;
    }

    .images {
        width: 100%; 
        height: 350px; 
    }


    .middle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px;
        border-radius: 5px;
        display: none;
    }

    .middle a {
        color: #fff;
        text-decoration: none;
    }

    .middle a:hover {
        color: #ff0000;
    }

    .card-container:hover .middle {
        display: block;
    }

    .get-more {
        text-align: center;
    }

    .get-more a {
        text-decoration: none;
        color: #000;
        font-weight: bold;
        font-size: 18px;
        display: inline-block;
        width: calc(50% - 20px);
        margin: 20px 0;
        padding: 10px;
        position: relative;
        overflow: hidden;
        border: 2px solid transparent !important; 
    }

    .get-more a::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .get-more a:hover::after {
        border-color: #ccc;
    }
</style>
<div class="hot_deal">
    <div class="title_deal">
        <h3><b>Có thể bạn sẽ quan tâm</b></h3>
    </div>
    <div class="content-sp">
        <?php while ($data = mysqli_fetch_array($query)) { ?>
            <div class="card">
                <div class="card-container">
                    <img src="upload/<?php echo $data['IMAGES'] ?> " alt="Avatar" class="images">
                    <div class="middle">
                        <div>
                            <a href="cart.php?id_product=<?php echo $data['IDPR'];?>&id_color=1&action=add">Thêm vào giỏ</a>
                        </div>
                        <div><a href="index.php?id=chitiet-sp&sp=<?php echo $data['IDPR'] ?>">Chi tiết</a></div>
                    </div>
                    <h4><b><?php echo $data['NAME'] ?></b></h4>
                    <p><?php echo number_format($data['COST']); ?> VND</p>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="get-more">
        <div>
            <a href="index.php?search=">Xem thêm </a>
        </div>
    </div>
</div>