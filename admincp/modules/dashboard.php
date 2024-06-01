<?php

$sql_se1 = "SELECT * FROM `order`";
$query_se1 = mysqli_query($mysqli, $sql_se1);

?>
<style>
    .boxTable2, .boxTable3{
    margin-top: 40px;
    background-color: white;

}


.boxTable3 {
    margin-top: 0;
    margin-bottom: 20px;
    padding: 3px;
}

#title{
    padding: 10px 20px;
    text-align: center;
}
#sanPhamBanChayTable{
    border-collapse:separate;
    border: 2px solid black;
    border-bottom: 0;

}
#loaisanPhamBanChayTable{
    border-collapse:separate;
    border: 2px solid black;
    border-bottom: 0;

}
#sanPhamBanChayTable th{
    border-bottom: 2px solid black;
    border-right: 2px solid black;
}

#sanPhamBanChayTable, #sanPhamBanChayTable > thead, #sanPhamBanChayTable > tbody{
    width: 100%;
}
#loaisanPhamBanChayTable, #loaisanPhamBanChayTable > thead, #loaisanPhamBanChayTable > tbody{
    width: 100%;
}
#loaisanPhamBanChayTable th{
    border-bottom: 2px solid black;
    border-right: 2px solid black;
}
thead{
    height: 50px;
}

tbody td{
    height: 30px;
    text-align: center;

}

tbody tr{
    border: 2px solid black;


}
</style>
<div class="line-dh1">
    <div class="line-dh1-title">Quản Lí trang web</div>

    <a href="index.php?action=quanlydonhang&query=them" class="line-dh1-content">
        Đơn hàng mới

        <?php
        $dem = 0;
        while ($row_se1 = mysqli_fetch_array($query_se1)) {
            if ($row_se1['status'] == 1) {
                $dem++;
            }
        } ?>

        <?php if ($dem > 0) { ?>
            <div class="box-noti"><?php echo $dem; ?></div>
        <?php } ?>

    </a>
</div>

<div class="clear"></div>

<div class="thongke_donhang">
    <p>Thống kê</p>
    <p>Loại Sản Phẩm</p>
    <div class="custom-select" style="width:200px;">
        <select name="IDCA" id="IDCA">
            <option value=''> Chọn loại sản phẩm</option>
            <?php
            $sql_brand = "SELECT * FROM categories ORDER BY IDCA DESC";
            $query_brand = mysqli_query($mysqli, $sql_brand);

            while ($row_brand = mysqli_fetch_array($query_brand)) {
                echo "<option value='$row_brand[IDCA]'> $row_brand[NAME]</option>";
            }
            ?>
        </select>
    </div>
    <label for="input datesearch12">Ngày bắt đầu</label>
    <input class="input datesearch1" style="width: 20rem" type="date" /> <br>
    <br>
    <label for="input datesearch23">Ngày kết thúc</label>
    <input class="input datesearch2" style="width: 20rem" type="date" />
    <label for="input datesearch24">Top :</label>
    <input type="number" id="top">
    <button id="btntimkiem">Tìm kiếm</button>
    <div id="chart" ></div>
    <div>
        <canvas id="myChart" style="width:100%"></canvas>
    </div>
    <div class="boxTable3">
                                                <h1 id="title">THỐNG KÊ SẢN PHẨM BÁN CHẠY</h1>
                                                <table id="sanPhamBanChayTable">
                                                    <thead>
                                                        <th>Mã sản phẩm</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Tổng số lượng bán ra</th>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
</div>
<div class="boxTable3">
                                                <h1 id="title">THỐNG KÊ LOẠI SẢN PHẨM BÁN CHẠY</h1>
                                                <table id="loaisanPhamBanChayTable">
                                                    <thead>
                                                        <th>Mã loại sản phẩm</th>
                                                        <th>Tên loại sản phẩm</th>
                                                        <th>Tổng số lượng bán ra</th>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
</div>

<!-- Thêm thư viện jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Thêm thư viện Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function() {
    const myChart = new Chart(
        document.getElementById('myChart'), {
            type: 'bar',
            data: {
                labels: [], // Ban đầu là nhãn tạm thời
                datasets: [
                    {
                        label: 'Doanh thu Bán ra',
                        data: [], // Dữ liệu tạm thời
                        borderWidth: 1,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)'
                    },
                    {
                        label: 'Doanh thu Nhập hàng',
                        data: [], // Dữ liệu tạm thời
                        borderWidth: 1,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)'
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            title: function(tooltipItems) {
                                const index = tooltipItems[0].dataIndex;
                                const label = myChart.data.labels[index];
                                const name = myChart.data.customData[index].NAME;
                                return `ID: ${label}, Tên: ${name}`;
                            },
                            label: function(context) {
                                const datasetLabel = context.dataset.label || '';
                                const value = context.raw;
                                return `${datasetLabel}: ${value}`;
                            },
                            afterLabel: function(context) {
                                const index = context.dataIndex;
                                const name = myChart.data.customData[index].NAME;
                                const sumBanRa = myChart.data.customData[index].sum_ban_ra;
                                const sumNhapHang = myChart.data.customData[index].sum_nhap_hang;
                                return `Tên: ${name}\nBán ra: ${sumBanRa}\nNhập hàng: ${sumNhapHang}`;
                            }
                        }
                    }
                }
            }
        }
    );

    function fetchData() {
        // Lấy giá trị ID danh mục
        var categoryID = $("#IDCA").val();
        // Lấy ngày bắt đầu
        var startDate = $(".datesearch1").val();
        // Lấy ngày kết thúc
        var endDate = $(".datesearch2").val();

        // Log giá trị để debug
        console.log("Category ID:", categoryID);
        console.log("Start Date:", startDate);
        console.log("End Date:", endDate);

        // Thực hiện hai yêu cầu AJAX song song
        $.when(
            $.ajax({
                url: 'modules/thongke.php',
                type: 'GET',
                data: {
                    categoryID: categoryID,
                    startDate: startDate,
                    endDate: endDate
                }
            }),
            $.ajax({
                url: 'modules/thongkephieunhap.php',
                type: 'GET',
                data: {
                    categoryID: categoryID,
                    startDate: startDate,
                    endDate: endDate
                }
            })
        ).done(function(response1, response2) {
            // Log phản hồi từ server
            console.log("Response from thongke.php:", response1[0]);
            console.log("Response from thongkephieunhap.php:", response2[0]);

            // Parse JSON từ phản hồi
            var dataBanRa = JSON.parse(response1[0]);
            var dataNhapHang = JSON.parse(response2[0]);

            // Hợp nhất dữ liệu
            var mergedData = mergeData(dataBanRa, dataNhapHang);

            // Cập nhật biểu đồ với dữ liệu mới
            updateChart(mergedData);
        }).fail(function(xhr, status, error) {
            // Xử lý lỗi
            console.error("Error:", error);
        });
    }

    // Hàm hợp nhất dữ liệu từ hai nguồn
    function mergeData(dataBanRa, dataNhapHang) {
        const mergedData = {};

        dataBanRa.forEach(item => {
            if (!mergedData[item.IDPR]) {
                mergedData[item.IDPR] = { NAME: item.NAME, sum_ban_ra: 0, sum_nhap_hang: 0 };
            }
            mergedData[item.IDPR].sum_ban_ra += parseInt(item.sum);
        });

        dataNhapHang.forEach(item => {
            if (!mergedData[item.IDPR]) {
                mergedData[item.IDPR] = { NAME: item.NAME, sum_ban_ra: 0, sum_nhap_hang: 0 };
            }
            mergedData[item.IDPR].sum_nhap_hang += parseInt(item.sum);
        });

        return Object.keys(mergedData).map(key => ({
            IDPR: key,
            NAME: mergedData[key].NAME,
            sum_ban_ra: mergedData[key].sum_ban_ra,
            sum_nhap_hang: mergedData[key].sum_nhap_hang
        }));
    }

    // Hàm cập nhật biểu đồ với dữ liệu mới
    function updateChart(data) {
        // Log dữ liệu để debug
        console.log("Data for chart:", data);

        // Tạo mảng labels, values_ban_ra và values_nhap_hang từ dữ liệu hợp nhất
        const labels = data.map(item => item.IDPR);
        const values_ban_ra = data.map(item => item.sum_ban_ra);
        const values_nhap_hang = data.map(item => item.sum_nhap_hang);

        // Cập nhật dữ liệu biểu đồ
        myChart.data.labels = labels;
        myChart.data.datasets[0].data = values_ban_ra;
        myChart.data.datasets[1].data = values_nhap_hang;

        // Gán dữ liệu tùy chỉnh để sử dụng trong tooltip
        myChart.data.customData = data;

        // Cập nhật biểu đồ
        myChart.update();
    }
    function thongKeSanPhamBanChay() {
    // Lấy giá trị ID danh mục
    var categoryID = $("#IDCA").val();
    // Lấy ngày bắt đầu
    var startDate = $(".datesearch1").val();
    // Lấy ngày kết thúc
    var endDate = $(".datesearch2").val();
    var top = $("#top").val();

    $.ajax({
        url: 'modules/thongke1.php',
        type: 'GET',
        dataType: "json",
        data: {
            categoryID: categoryID,
            startDate: startDate,
            endDate: endDate,
            top: top
        },
        success: function(response) {
            // Lấy thẻ tbody của bảng
            var tbody = document.getElementById("sanPhamBanChayTable").getElementsByTagName('tbody')[0];
            tbody.innerHTML = ""; // Xóa dữ liệu cũ trước khi thêm dữ liệu mới

            // Lặp qua dữ liệu từ API để tạo các dòng trong tbody của bảng
            for (var i = 0; i < response.length; i++) {
                var row = tbody.insertRow();
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = response[i].IDPR;
                cell2.innerHTML = response[i].NAME;
                cell3.innerHTML = response[i].sum;

                if (i % 2 == 0) {
                    cell1.style.backgroundColor = "whitesmoke";
                    cell2.style.backgroundColor = "whitesmoke";
                    cell3.style.backgroundColor = "whitesmoke";
                }

                cell1.style.borderRight = "2px solid black";
                cell2.style.borderRight = "2px solid black";
                cell3.style.borderRight = "2px solid black";

                cell1.style.borderBottom = "2px solid black";
                cell2.style.borderBottom = "2px solid black";
                cell3.style.borderBottom = "2px solid black";
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gọi API: ', error);
        }
    });
}


function thongKeSanPhamBanChay1() {
    // Lấy giá trị ID danh mục
    var categoryID = $("#IDCA").val();
    // Lấy ngày bắt đầu
    var startDate = $(".datesearch1").val();
    // Lấy ngày kết thúc
    var endDate = $(".datesearch2").val();
    var top = $("#top").val();

    $.ajax({
        url: 'modules/thongke2.php',
        type: 'GET',
        dataType: "json",
        data: {
            categoryID: categoryID,
            startDate: startDate,
            endDate: endDate,
            top: top
        },
        success: function(response) {
            // Lấy thẻ tbody của bảng
            var tbody = document.getElementById("loaisanPhamBanChayTable").getElementsByTagName('tbody')[0];
            tbody.innerHTML = ""; // Xóa dữ liệu cũ trước khi thêm dữ liệu mới

            // Lặp qua dữ liệu từ API để tạo các dòng trong tbody của bảng
            for (var i = 0; i < response.length; i++) {
                var row = tbody.insertRow();
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = response[i].IDCA;
                cell2.innerHTML = response[i].category_name;
                cell3.innerHTML = response[i].sum;

                if (i % 2 == 0) {
                    cell1.style.backgroundColor = "whitesmoke";
                    cell2.style.backgroundColor = "whitesmoke";
                    cell3.style.backgroundColor = "whitesmoke";
                }

                cell1.style.borderRight = "2px solid black";
                cell2.style.borderRight = "2px solid black";
                cell3.style.borderRight = "2px solid black";

                cell1.style.borderBottom = "2px solid black";
                cell2.style.borderBottom = "2px solid black";
                cell3.style.borderBottom = "2px solid black";
            }
        },
        error: function(xhr, status, error) {
            console.error('Lỗi khi gọi API: ', error);
        }
    });
}
    // Gắn hàm fetchData vào sự kiện click của nút
    $("#btntimkiem").click(fetchData);
    $("#btntimkiem").click(thongKeSanPhamBanChay);
    $("#btntimkiem").click(thongKeSanPhamBanChay1);

    // Gọi hàm fetchData khi tải trang
    fetchData();
    thongKeSanPhamBanChay();
    thongKeSanPhamBanChay1();

});

 




</script>