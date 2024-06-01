<?php
    include "admincp/config/config.php";
    $limit = 8;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }    
    $start_form = ($page - 1) * $limit;
    $price = $_GET['price'];

    $sql = "SELECT * FROM `product` WHERE `status` = '1'";

    if ($price <= 40000) {
        $sql .= " AND `COST` <= '$price'";
        $option1 = mysqli_query($con, $sql);
    } elseif ($price <= 50000) {
        $sql .= " AND `COST` > '40000' AND `COST` <= '$price'";
        $option2 = mysqli_query($con, $sql);
    } else {
        $sql .= " AND `COST` > '$price'";
        $option3 = mysqli_query($con, $sql);
    }

    $sql .= " ORDER BY `COST` ASC LIMIT $start_form, $limit";

    $output = "";
    if ($price <= 40000){
        $output .= "        <br><br>
        <div class='title'>
            <ul class='breadcrumb'>
                <li><a href='index.php'>Trang chủ</a></li>
                <li>Từ khóa tìm kiếm :  Giá sản phẩm thấp hơn" . $price . "</li>
            </ul>
        </div><br>";
    } else if($price > 40000 && $price < 50001 ){
        $output .= "        <br><br>
        <div class='title'>
            <ul class='breadcrumb'>
                <li><a href='index.php'>Trang chủ</a></li>
                <li>Từ khóa tìm kiếm :  Giá sản phẩm từ 40000 đến " . $price . "</li>
            </ul>
        </div><br>";
    } else if($price > 50000){
        $output .= "        <br><br>
        <div class='title'>
            <ul class='breadcrumb'>
                <li><a href='index.php'>Trang chủ</a></li>
                <li>Từ khóa tìm kiếm :  Giá sản phẩm lớn hơn " . $price . "</li>
            </ul>
        </div><br>";
    }

    if ($price <= 40000) {
        $output .= '<div class="content-sp">';
        while ($row = mysqli_fetch_assoc($option1)) {
            $output .= '<div class="card"> 
                            <div class="card-container">
                            <img src="upload/' . $row['IMAGES'] . ' " alt="Images" class="images">
                                <div class="middle">
                                    <div><a href="cart.php?id_product=' . $row['IDPR'] . '&id_color=1">Thêm vào giỏ</a></div>
                                    <div><a href="index.php?id=chitiet-sp&sp=' . $row['IDPR'] . '">Chi tiết</a></div>
                                </div>
                            <h4><b>' . $row['NAME'] . '</b></h4>
                            <p> ' . $row['COST'] . ' đ</p>
                            </div>
                        </div>
            ';
        }
        $output .= '</div>';

        // phân trang
        $sql = "SELECT * FROM product WHERE status='1' AND `COST` <= '$price'";
        $records = mysqli_query($con, $sql);

        $totalRecords = mysqli_num_rows($records);
        $totalPage = ceil($totalRecords / $limit);

        $output .= "<div class='pagi'><ul class='pagination justify-content-center' style='margin:20px 0'>";

        for ($num = 1; $num <= $totalPage; $num++) {
            if ($num == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            $output .= "<li class='page-item $active'><a class='page-link' id='$num' href=''>$num</a></li>";
        }

        $output .= "</ul></div>";
        echo $output;
    } else if ($price > 40000 && $price <= 50000) {
        $output .= '<div class="content-sp">';
        while ($row = mysqli_fetch_assoc($option2)) {
            $output .= '<div class="card"> 
                            <div class="card-container">
                            <img src="upload/' . $row['IMAGES'] . ' " alt="Images" class="images">
                                <div class="middle">
                                    <div><a href="cart.php?id_product=' . $row['IDPR'] . '&id_color=1">Thêm vào giỏ</a></div>
                                    <div><a href="index.php?id=chitiet-sp&sp=' . $row['IDPR'] . '">Chi tiết</a></div>
                                </div>
                            <h4><b>' . $row['NAME'] . '</b></h4>
                            <p> ' . $row['COST'] . ' đ</p>
                            </div>
                        </div>
            ';
        }
        $output .= '</div>';

        // phân trang
        $sql = "SELECT * FROM product WHERE status='1' AND `COST` > '40000' AND `COST` <= '$price'";
        $records = mysqli_query($con, $sql);

        $totalRecords = mysqli_num_rows($records);
        $totalPage = ceil($totalRecords / $limit);

        $output .= "<div class='pagi'><ul class='pagination justify-content-center' style='margin:20px 0'>";

        for ($num = 1; $num <= $totalPage; $num++) {
            if ($num == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            $output .= "<li class='page-item $active'><a class='page-link' id='$num' href=''>$num</a></li>";
        }
        $output .= "</ul></div>";
        echo $output;
    } else if ($price > 50000) {
        $output .= '<div class="content-sp">';
        while ($row = mysqli_fetch_assoc($option3)) {
            $output .= '<div class="card"> 
                            <div class="card-container">
                            <img src="upload/' . $row['IMAGES'] . ' " alt="Images" class="images">
                                <div class="middle">
                                    <div><a href="cart.php?id_product=' . $row['IDPR'] . '&id_color=1">Thêm vào giỏ</a></div>
                                    <div><a href="index.php?id=chitiet-sp&sp=' . $row['IDPR'] . '">Chi tiết</a></div>
                                </div>
                            <h4><b>' . $row['NAME'] . '</b></h4>
                            <p> ' . $row['COST'] . ' đ</p>
                            </div>
                        </div>
            ';
        }
        $output .= '</div>';

        // phân trang
        $sql = "SELECT * FROM product WHERE status='1' AND `COST` > '$price'";
        $records = mysqli_query($con, $sql);

        $totalRecords = mysqli_num_rows($records);
        $totalPage = ceil($totalRecords / $limit);

        $output .= "<div class='pagi'><ul class='pagination justify-content-center' style='margin:20px 0'>";

        for ($num = 1; $num <= $totalPage; $num++) {
            if ($num == $page) {
                $active = "active";
            } else {
                $active = "";
            }
            $output .= "<li class='page-item $active'><a class='page-link' id='$num' href=''>$num</a></li>";
        }
        $output .= "</ul></div>";
        echo $output;
    }
?> 