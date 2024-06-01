<?php
include "admincp/config/config.php";
$limit = 8;

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$loaisp1 = $_GET['loaisp'];

$start_form = ($page - 1) * $limit;

$sql = mysqli_query($con, "SELECT * FROM categories WHERE status='1' AND IDCA = $loaisp1");
$data = mysqli_fetch_assoc($sql);

$sql = "SELECT * FROM product WHERE IDCA = $loaisp1 AND status='1' ORDER BY IDPR DESC LIMIT $start_form, $limit";
$result = mysqli_query($con, $sql);

$output = "";
$output .= "        <br>
            <div class='title'>
                <ul class='breadcrumb'>
                    <li><a href='index.php'>Trang chủ</a></li>
                    <li>Từ khóa tìm kiếm :  " . $data['NAME'] . "</li>
                </ul>
      
            </div>";
if (mysqli_num_rows($result) > 0) {
    $output .= '<div class="content-sp">';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<div class="card"> 
						<div class="card-container">
						<img src="upload/' . $row['IMAGES'] . ' " alt="Images" class="images">
							<div class="middle">
								<div><a href="cart.php?id_product=' . $row['IDPR'] . '&id_color=1">Thêm vào giỏ</a></div>
								<div><a href="index.php?id=chitiet-sp&sp=' . $row['IDPR'] . '">Chi tiết</a></div>
							</div>
						<h4><b>' . $row['NAME'] . '</b></h4>
						<p> ' . number_format($row['COST']) . ' đ</p>
						</div>
					</div>
		';
    }
    $output .= '</div>';
    $sql = "SELECT * FROM product WHERE status='1' AND IDCA = $loaisp1";

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