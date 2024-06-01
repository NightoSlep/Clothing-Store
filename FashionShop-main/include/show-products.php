<?php
$sql = " SELECT * FROM product WHERE status='1' ORDER BY IDPR LIMIT 8";
$query = mysqli_query($con, $sql);
?>


<style>
.hot_deal {
  max-width: 1200px;
  margin: 0 auto;
  margin-top: 15px;
  position: relative;
}

.content-sp {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
}

.card {
  width: calc(25% - 10px);
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
    display: flex; 
    align-items: center; 
}

.price-filter select {
    width: 200px;
    padding: 8px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
}

.price-filter label {
    margin-right: 10px;
    font-weight: bold;
    font-size: 16px;
    color: #333;
}

.price-filter-container {
    position: absolute;
    top: 0;
    right: 0;
}
</style>
<div class="hot_deal">
    <div class="title_deal">
        <h3><b>Sản phẩm tiêu biểu</b></h3>
    </div>
    <div class="price-filter-container">
        <div class="price-filter">
            <label for="price-filter">Sắp xếp theo giá tiền:</label>
            <select id="price" onchange="priceSort(this.value, 1)">
            <option value="" >Chọn mức giá</option>

              <option value="40000" >Dưới 40,000 VND</option>
              <option value="50000" >Từ 40,000 VND đến 50,000 VND</option>
              <option value="50001" >Trên 50,000 VND</option>
            </select>
        </div>
    </div>
   
    <div class="content-sp">
        <?php while ($data = mysqli_fetch_array($query)) { ?>
            <div class="card">
                <div class="card-container">
                    <img src="upload/<?php echo $data['IMAGES'] ?> " alt="Images" class="images">
                    <div class="middle">
                      <div class="middle-add">
                        <a href="cart.php?id_product=<?php echo $data['IDPR']; ?>&id_color=1&action=add">Thêm vào giỏ</a> 
                      </div>      
                      <div class="middle-detail">
                          <a href="index.php?id=chitiet-sp&sp=<?php echo $data['IDPR'] ?>">Chi tiết</a>
                      </div>
                    </div>
                    <h4><b><?php echo $data['NAME'] ?></b></h4>
                    <p><?php echo number_format($data['COST']) ?> VND</p>
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
