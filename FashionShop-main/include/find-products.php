<?php
if (isset($_GET['search'])) {
    $key = $_GET['search'];
    if ($key == "") {
        $key = 'tatca';
    }
    $key = strip_tags($key);
    $key = addslashes($key);
}

$limit_pg = 8;

if ($key == 'tatca') {
    $sql = "SELECT * FROM product WHERE status='1' ORDER BY IDPR DESC";
    $key = 'Tất cả sản phẩm';
    $query = mysqli_query($con, $sql);
    $row = mysqli_num_rows($query);
    $page = ceil($row / $limit_pg);
    if (isset($_GET['page'])) {
        $pg = $_GET['page'];
    } else {
        $pg = 1;
    }
    $start = ($pg - 1) * $limit_pg;
    $new_sql = "SELECT * FROM product WHERE status='1' LIMIT $start,$limit_pg";
    $new_query = mysqli_query($con, $new_sql);
?>
    <br>
    <div class="title">
        <ul class="breadcrumb">
            <li><a href="index.php">Trang chủ</a></li>
            <li>Từ khóa tìm kiếm : <?php echo $key ?></li>
        </ul>
    </div>
    <?php
} else {
    if (isset($_GET['loaisp'])) {
        $loaisp1 = $_GET['loaisp'];
        $sql = "SELECT * FROM product WHERE status='1' AND product.NAME LIKE '%$key%' OR IDCA LIKE '%$loaisp1%'";
        $query = mysqli_query($con, $sql);
        $row = mysqli_num_rows($query);
        $page = ceil($row / $limit_pg);
        if (isset($_GET['page'])) {
            $pg = $_GET['page'];
        } else {
            $pg = 1;
        }
        $start = ($pg - 1) * $limit_pg;
        $new_sql = "SELECT * FROM product WHERE status='1' AND product.NAME LIKE '%$key%'  OR 'IDCA' LIKE '%$loaisp1%' LIMIT $start,$limit_pg";
        $new_query = mysqli_query($con, $new_sql);
    } else if ($key) {
        $sql = "SELECT * FROM product WHERE status='1' AND product.NAME LIKE '%$key%' ";
        $query = mysqli_query($con, $sql);
        $row = mysqli_num_rows($query);
        $page = ceil($row / $limit_pg);
        if (isset($_GET['page'])) {
            $pg = $_GET['page'];
        } else {
            $pg = 1;
        }
        $start = ($pg - 1) * $limit_pg;
        $new_sql = "SELECT * FROM product WHERE status='1' AND product.NAME LIKE '%$key%' LIMIT $start,$limit_pg";
        $new_query = mysqli_query($con, $new_sql);
    }

    if (empty(mysqli_num_rows($query))) {
    ?>
        <br>
        <div class="title">
            <ul class="breadcrumb">
                <li><a href="index.php">Trang chủ</a></li>
                <li>Từ khóa tìm kiếm : <?php echo $key ?></li>
            </ul>
        </div>
        <br>
        <div>
            <h3>Không tồn tại kết quả tìm kiếm!</h3>
        </div>
    <?php
    } else {
    ?>
        <br>
        <div class="title">
            <ul class="breadcrumb">
                <li><a href="index.php">Trang chủ</a></li>
                <li>Từ khóa tìm kiếm : <?php echo $key ?></li>
            </ul>
        </div>
<?php
    }
}
?>

<style>
.hot_deal {
  max-width: 1200px;
  margin: 0 auto;
  margin-top: 30px;
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
  text-decoration: none;
  color: #fff;
}

.middle a:hover {
  color: #ff0000;
}

.card-container:hover .middle {
  display: block;
}

.middle-add,
.middle-detail {
  display: inline-block;
  width: 150px;
}

.middle-add a,
.middle-detail a {
  text-decoration: none;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  margin: 5px auto;
  display: block;
}

.price-filter {
    position: absolute;
    top: 700px;
    right: 50px;
    margin-top: 10px; 
    width: 200px;
}

.price-filter select {
    width: 200px;
    padding: 8px;
    font-size: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
}

.price-filter label {
    display: inline-block;
    margin-right: 10px;
    font-weight: bold;
    font-size: 14px;  
    color: #333;
}
</style>

<div class="hot_deal">
    <div class="price-filter-container">
            <div class="price-filter">
                <label for="price-filter">Sắp xếp theo giá tiền:</label>
                <select id="price" onchange="priceSort(this.value, 1)">
                <option value="40000" >Dưới 40,000 VND</option>
                <option value="50000" >Từ 40,000 VND đến 50,000 VND</option>
                <option value="50001" >Trên 50,000 VND</option>
                </select>
            </div>
        </div>
    <div class="content-sp" >
        <?php while ($data = mysqli_fetch_array($new_query)) { ?>
            <div class="card" >
                <div class="card-container">
                    <img src="upload/<?php echo $data['IMAGES'] ?> " alt="Avatar" class="images">
                    <div class="middle">
                        <div class="middle-add">
                            <a href="cart.php?id_product=<?php echo $data['IDPR'];
                            
                            ?>&id_color=1&action=add">Thêm vào giỏ</a> 
                        </div>      
                      <div class="middle-detail">
                          <a href="index.php?id=chitiet-sp&sp=<?php echo $data['IDPR'] ?>">Chi tiết</a>
                      </div>
                    </div>
                    <h4><b><?php echo $data['NAME'] ?></b></h4>
                    <p><?php echo number_format($data['COST']); ?> VND</p>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="pagi">
        <ul class="pagination justify-content-center">
            <?php
            if ($key == 'Tất cả sản phẩm') {
                for ($num = 1; $num <= $page; $num++) {
                    if ($pg == $num) {
            ?>
                        <li class="page-item active"><a href="index.php?search=&page=<?php echo $num ?>" class="page-link"> <?php echo $num ?></a></li>
                    <?php } else {
                    ?>
                        <li class="page-item"><a href="index.php?search=&page=<?php echo $num ?>" class="page-link"> <?php echo $num ?></a></li>
                    <?php
                    }
                }
            } else
                for ($num = 1; $num <= $page; $num++) {
                    if ($pg == $num) {
                    ?>
                    <li class="page-item active"><a href="index.php?search=<?php echo $key ?>&page=<?php echo $num ?>" class="page-link"> <?php echo $num ?></a></li>
                <?php } else {
                ?>
                    <li class="page-item"><a href="index.php?search=<?php echo $key ?>&page=<?php echo $num ?>" class="page-link"> <?php echo $num ?></a></li>
                <?php
                    }
                }
            ?>
        </ul>
    </div>
</div>
