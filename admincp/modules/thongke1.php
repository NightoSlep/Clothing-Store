<?php
include('../config/config.php');

if (isset($_GET['startDate']) && isset($_GET['endDate']) && isset($_GET['categoryID']) && isset($_GET['top'])) {
    $startDate = mysqli_real_escape_string($mysqli, $_GET['startDate']);
    $endDate = mysqli_real_escape_string($mysqli, $_GET['endDate']);
    $categoryID = mysqli_real_escape_string($mysqli, $_GET['categoryID']);
    $top = mysqli_real_escape_string($mysqli, $_GET['top']);

    // Tạo câu truy vấn SQL với các biến đã được xác thực
    $sql = "
    SELECT 
        product.IDPR, 
        product.NAME, 
        COALESCE(SUM(detailorder.QUANITY), 0) AS sum
    FROM 
        product
    LEFT JOIN 
        detailorder ON product.IDPR = detailorder.IDPR
    LEFT JOIN 
        `order` ON detailorder.IDOR = `order`.IDOR
    WHERE 1
    ";
    
    // Nếu ngày bắt đầu được cung cấp, thêm điều kiện vào câu truy vấn
    if (!empty($startDate)) {
        $sql .= " AND `order`.ORDERDATE >= '$startDate'";
    }

    // Nếu ngày kết thúc được cung cấp, thêm điều kiện vào câu truy vấn
    if (!empty($endDate)) {
        $sql .= " AND `order`.ORDERDATE <= '$endDate'";
    }

    // Nếu categoryID được cung cấp, thêm điều kiện vào câu truy vấn
    if (!empty($categoryID)) {
        $sql .= " AND product.IDCA = '$categoryID'";
    }

    // Hoàn thành câu truy vấn
    $sql .= " GROUP BY product.IDPR";

    // Sắp xếp theo giảm dần theo tổng số lượng
    $sql .= " ORDER BY sum DESC";

    // Nếu top được cung cấp, giới hạn kết quả trả về
    if (!empty($top)) {
        $sql .= " LIMIT $top";
    }

    // Thực thi câu truy vấn
    $sql_query = mysqli_query($mysqli, $sql);

    // Khởi tạo mảng chứa dữ liệu
    $chart_data = [];

    // Lặp qua kết quả truy vấn và thêm vào mảng dữ liệu
    while ($val = mysqli_fetch_array($sql_query)) {
        $chart_data[] = array(
            'IDPR' => $val['IDPR'],
            'sum' => $val['sum'],
            'NAME' => $val['NAME']
        );
    }

    // Xuất dữ liệu dưới dạng JSON
    echo json_encode($chart_data);
} else {
    // Trường hợp không có các biến GET được cung cấp
    echo json_encode(["error" => "Vui lòng cung cấp ngày bắt đầu, ngày kết thúc, categoryID và top."]);
}
?>
