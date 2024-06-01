<style>
.flex-container {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.left-menu {
    width: 20%;
}

.left-menu ul {
    list-style: none;
    padding: 0;
}

.left-menu ul li {
    margin-bottom: 10px;
}

.left-menu ul li {
    vertical-align: middle;
    margin-right: 10px;
}

.left-menu button{
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
    width: 80%;
}

.thong-tin-tk {
    width: 80%;
}

.thong-tin-tk ul {
    list-style: none;
    padding: 0;
}

.thong-tin-tk ul li {
    margin-bottom: 10px;
}

.thong-tin-tk button {
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-right: 10px;
}

.thong-tin-tk button a {
    text-decoration: none;
    color: #fff;
}

.thong-tin-tk button:hover {
    background-color: #0056b3;
}


</style>
<br>
<div class="flex-container">
    <br>
    <div class="left-menu">
        <ul>
            <li>
                <button>
                    <a href="index.php?id=quanlytaikhoan&action=showtttk" style="color: #fff; ">
                        Thông tin tài khoản
                    </a>
                </button>
            </li>
            <li>
                <button class="hoa-don-button">
                    <a href="index.php?id=quanlytaikhoan&action=showhoadon" style="color: #fff; ">
                        Hóa đơn đã mua    
                    </a>
                </button>
            </li>
        </ul>
    </div>

    <?php 
        if(isset($_GET['trangthai'])){
            $trangthai = $_GET['trangthai'];
            if($trangthai == 'suatk'){
                ?> <script type="text/javascript">
                alert("Thao tác thành công!");

                // location.href = 'signin.php';
                </script> <?php 
                $idus = $_SESSION['user']['id_user'];
                $sql = mysqli_query($con,"SELECT * FROM account Where IDAC = $idus");
                $data = mysqli_fetch_assoc($sql); 
                $_SESSION['user'] = $data; 

            } 
        }
        $actionql = (isset($_GET['action'])) ? $_GET['action'] : 'showtttk';
        if ($actionql == 'showtttk') {
    ?>

    <div class="thong-tin-tk">
        <div class="title-user"><h3>Thông tin tài khoản</h3></div>
        <div>
            <ul>
                <li><label for="#">Họ và tên:  <?php echo $_SESSION['user']['hoten']?></label></li>
                <li><label for="#">Tên tài khoản:  <?php echo $_SESSION['user']['email']?></label></li>
                <li><label for="#">SDT:  <?php echo $_SESSION['user']['sdt']?></label></li>
                <li><label for="#">Giới tính:  <?php echo $_SESSION['user']['gender']?></label></li>
                <li><label for="#">Ngày sinh:  <?php echo $_SESSION['user']['BIRTH']?></label></li>
                <li><label for="#">Địa chỉ:  <?php echo $_SESSION['user']['address']?></label></li>
            </ul>
            <button><a href="index.php?id=quanlytaikhoan&action=suatttk">Chỉnh sửa thông tin</a></button>
            <button><a href="index.php?id=quanlytaikhoan&action=repass">Đặt lại mật khẩu</a></button>
        </div>    
    </div>

    <?php } ?>

    <?php 
        if($actionql =='suatttk'){ ?>
            <div class="thong-tin-tk">
                <h3>Sửa thông tin tài khoản</h3>
                <form action="xuli-user.php?action=suattk&id-user=<?php echo $_SESSION['user']['id_user']?>" method="POST">
                    <label for="hoten">Họ và tên:</label><br>
                    <input type="text" name="hoten" id="hoten" value="<?php echo $_SESSION['user']['hoten']?>"> <br>
                    <label for="email">Email:</label><br>
                    <input type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email']?>"><br>
                    <label for="sdt"> Giới tính:</label><br>
                    <input type="text" name="gender" id="gender" value="<?php echo $_SESSION['user']['gender']?>"><br>
                    <label for="sdt"> Ngày sinh:</label><br>
                    <input type="text" name="birth" id="birth" value="<?php echo $_SESSION['user']['birth']?>"><br>
                    <label for="sdt"> Số điện thoại:</label><br>
                    <input type="text" name="sdt" id="sdt" value="<?php echo $_SESSION['user']['sdt']?>"><br>
                    <label for="sdt"> Địa chỉ:</label><br>
                    <input type="text" name="address" id="address" value="<?php echo $_SESSION['user']['address']?>"><br>
                    
                    <div class="flex-button">
                    <button type="submit">Thực hiện</button>
                </form>
                <button type="button"> <a href="index.php?id=quanlytaikhoan"> Trở lại </a></button>
            </div> 
    <?php }
        if ($actionql == 'repass'){ ?>
            <div class="thong-tin-tk">
                <h3>Đặt lại mật khẩu</h3>
                <form action="xuli-user.php?action=repass&id-user=<?php echo $_SESSION['user']['id_user']?>" method="POST">
                        <label for="oldlpassword">Mật khẩu cũ:</label> <br>
                        <input type="password" name="oldlpassword" id="oldlpassword"><br>
                        <label for="newpassword">Mật khẩu mới</label><br>
                        <input type="password" name="newpassword" id="newpassword"><br>
                        <label for="renewpasswor">Nhập lại mật khẩu</label><br>
                        <input type="password" name="renewpassword" id="renewpassword"><br>
                        <div class="flex-button">
                            <button type="submit" >Thực hiện</button>
                        </div>
                </form>
                <button type="button" ><a href="index.php?id=quanlytaikhoan"> Trở lại </a></button>
            </div>
</div>
<?php }
    if($actionql == 'showhoadon'){
        $idkh = $_SESSION['user']['id_user'];
        $sql_hd_o = "SELECT * FROM `order` WHERE IDAC = $idkh ORDER BY IDOR ASC";
        $queryhd_o = mysqli_query($con,$sql_hd_o);
        $i = 1;
        $limit_pg = 20;
        $row = mysqli_num_rows($queryhd_o);
        $page = ceil($row / $limit_pg);
        if(isset($_GET['page'])){
            $pg = $_GET['page'];
        } else{
            $pg = 1;
        }
        $start = ($pg - 1)*$limit_pg;
        $sql_hd = "SELECT * FROM `order` WHERE `IDAC` = $idkh ORDER BY IDOR DESC LIMIT $start,$limit_pg";
        $queryhd = mysqli_query($con,$sql_hd); 
?>

<div class="thong-tin-tk">
    <div class="tittle-user">
        <h3>Hóa đơn đã mua</h3>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Hóa đơn ngày</th>
                    <th scope="col">Sản phẩm mua</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($_GET['page'])){
                    $pg = $_GET['page'];
                    if($pg == 1){ $i = 1;}
                    if($pg >= 2){$i =  ($pg+20)*1+1;}
                   
                }else $i = 1;
                while($data3 = mysqli_fetch_assoc($queryhd)){  ?>
                <tr>
                    <th scope="row"><?php echo $i; $i++;?></th>
                    <td><?php echo date_format(date_create($data3['ORDERDATE']),"d/m/Y H:i:s") ?></td>
                    <td><?php 
                        $idhd3 = $data3['IDOR'];
                        $sql_cthd = "SELECT * FROM product ,detailorder where detailorder.IDPR = product.IDPR AND detailorder.IDOR = $idhd3";
                        $querycthd = mysqli_query($con,$sql_cthd);
                        $sql_ordt="SELECT * FROM product ,detailorder where detailorder.IDPR = product.IDPR AND detailorder.IDOR = $idhd3";
                        $queryordt = mysqli_query($con,$sql_ordt);
                        while($data5 = mysqli_fetch_assoc($querycthd)  ){
                            echo $data5['NAME']; ?> <br> <?php
                        } 
                     ?>
                        
                    <td><?php 
                            
                        while($data4 = mysqli_fetch_assoc($queryordt)  ){
                            echo $data4['QUANITY']; 
                        ?> <br> 
                            <?php
                            
                        }  
                    ?></td>
                    <td><?php echo $data3['TOTALPAYMENT'] ?> VND</td>
                    <td><?php 
                        switch($data3['status']){
                            case 0:
                                echo 'Đã hủy';
                                break;
                            case 1:
                                echo "Đang chờ";
                                break;
                            case 2:
                                echo "Đã xác nhận";
                                break;   
                            case 3:
                                echo "Giao hàng";
                                break;
                            case 4:
                                echo "Nhận hàng";
                                break;         
                        }
                    ?></td>
                    <td>
                        <button><a href="index.php?id=quanlytaikhoan&action=chitiethoadon&&idhd=<?php echo $data3['IDOR'] ?>"> Chi tiết </a></button> 
                        <?php if($data3['status'] == '1'){
                            if($data3['status'] != "0"){?>       
                        <button><a href="#" id="xoahd" onclick="XoaHD(<?php echo $data3['IDOR']?>)">Hủy đơn hàng</a></button>
                        <?php }}?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<div class="pagi">
    <ul class="pagination justify-content-center">
        <?php
            for ($i=1; $i <= $page; $i++) { 
                if($pg == $i){
                    ?>
                    <li class="page-item active"><a href="index.php?id=quanlytaikhoan&action=showhoadon&page=<?php echo $i?>" class="page-link"> <?php echo $i ?></a></li>
                <?php 
                } else{
                ?>
                    <li class="page-item"><a href="index.php?id=quanlytaikhoan&action=showhoadon&page=<?php echo $i?>" class="page-link"> <?php echo $i ?></a></li>
                <?php
                }
            }
        ?>
    </ul>
</div>
    <?php }?>

<?php 
    if($actionql == 'chitiethoadon'){
        $idhd = $_GET['idhd'];
        $sql_hd = "SELECT * FROM `order` WHERE IDOR = $idhd";
        $queryhd = mysqli_query($con,$sql_hd);
?>
        <div class="thong-tin-tk">
            <div class="title"><h3>Hóa đơn đã mua</h3></div>
                <?php while($hd = mysqli_fetch_assoc($queryhd)){  ?>
                    <div class="Hoa-don">
                        <h4>Thông tin hóa đơn ngày <?php echo $hd['ORDERDATE']?></h4>
                        <ul>
                            <li>
                            Trạng thái: <?php
                                            switch($hd['status']){
                                                case 0:
                                                    echo "Đã hủy";
                                                    break;
                                                case 1:
                                                    echo "Đang chờ";
                                                    break;
                                                case 2:
                                                    echo "Đã xác nhận";
                                                    break;   
                                                case 3:
                                                    echo "Giao hàng";
                                                    break;
                                                case 4:
                                                    echo "Nhận hàng";
                                                    break;         
                                            } 
                                        ?>
                            </li>
                            <li>Tổng hóa đơn: <?php echo $hd['TOTALPAYMENT']?>VND</li>
                            <?php   if($hd['status'] == '1'){
                                        if($hd['status'] != "0"){?>       
                                            <li> <button> <a href="" id="xoahd" onclick="XoaHD(<?php echo $hd['IDOR']?>)">Hủy đơn hàng</a></button>
                                                <button> <a href="index.php?id=quanlytaikhoan&action=showhoadon"> Trở lại</a></button>   
                                            </li>
                                        <?php }
                                    }
                            ?>
                        </ul>
                        <?php   
                            $sql_chd = "SELECT IMAGES,product.NAME as namepr,detailorder.QUANITY,product.COST,color.NAME as nameco FROM detailorder,product,color WHERE color.IDCO = detailorder.IDCO and detailorder.IDPR = product.IDPR AND detailorder.IDOR = $idhd";
                            $querychd = mysqli_query($con,$sql_chd);
                        ?>
                        <div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Màu</th>
                                        <th>Số Lượng</th>
                                        <th>Giá</th>
                                        <th>Thanh Tiền</th>
                                    </tr>
                                </thead>
                                <?php 
                                    $i = 1;
                                    while($data = mysqli_fetch_assoc($querychd)){ 
                                ?>
                                    <tr>
                                        <th><?php echo $i?></th>
                                        <th><img src="./upload/<?php echo $data['IMAGES']?>" alt="" style="max-width: 200px;"></th>
                                        <th><?php echo $data['namepr']?></th>
                                        <th><?php echo $data['nameco']?></th>
                                        <form action="cart.php" method="GET">
                                        <th><?php echo $data['QUANITY']?>
                                        </th>
                                        <th><?php echo number_format($data['COST'])?> VND</th>
                                        <th><?php echo number_format($bill = $data['COST'] * $data['QUANITY']);?> VND</th>
                                </tr>
                                <?php $i++;}?>
                            </table>
                        </div>
                    </div>
                <?php } ?> 
            </div>
        </div>
<?php } ?>  
