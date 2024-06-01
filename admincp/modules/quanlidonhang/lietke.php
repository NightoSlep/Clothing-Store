<?php

$sql_lietke_dh = "SELECT * FROM account, `order` WHERE account.IDAC = `order`.IDAC ORDER BY `order`.IDOR DESC";
$query_lietke_dh = mysqli_query($mysqli, $sql_lietke_dh);



?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<div class="form2 form2-1">
    <div class="form-title">
        <p>Liệt kê Danh Sách đơn hàng </p>
    </div>
    <label for="input datesearch1">Ngày bắt đầu</label>
    <input class="input datesearch1" style="width: 20rem" type="date" /> <br>
    <br>
    <label for="input datesearch2">Ngày kết thúc</label>
    <input class="input datesearch2" style="width: 20rem" type="date" />

    <!-- Thêm combobox trạng thái -->
    <label for="status">Trạng thái</label>
    <select id="status">
        <option value="">Tất cả</option>
        <option value="1">Chờ duyệt</option>
        <option value="0">Đã hủy</option>
        <option value="2">Đã xác nhận</option>
        <option value="3">Đã nhận hàng</option>
    </select>

    <div class="input2 input5-2" style="width: 25%;">
        <input type="submit" name="timkiem" id="search" value="Tìm kiếm">
    </div>
    <div class="form2-content">
        <table>
            <!-- Bảng để hiển thị dữ liệu -->
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Địa Chỉ</th>
                <th>Số Điện Thoại</th>
                <th>Ngày Đặt</th>
                <th>Tổng giá trị</th>
                <th>Trạng thái</th>
            </tr>
            <tbody id="datahere">
                <?php
                while ($row = mysqli_fetch_array($query_lietke_dh)) {
                ?>
                    <tr>
                        <th><?php echo $row['IDOR'] ?></th>
                        <th><?php echo $row['FULLNAME'] ?></th>
                        <th><?php echo $row['ADRESS'] ?></th>
                        <th><?php echo $row['NUMBERPHONE'] ?></th>
                        <th><?php echo $row['ORDERDATE'] ?></th>
                        <th><?php echo $row['TOTALPAYMENT'] ?></th>
                        <th>
                            <?php
                            if ($row['status'] == 1) {
                                echo 'Chờ duyệt';
                            } else if ($row['status'] == 0) {
                                echo "Đã hủy";
                            } else if ($row['status'] == 2) {
                                echo 'Đã xác nhận';
                            } else {
                                echo 'Đã nhận hàng';
                            }
                            ?></th>
                        <th class="quanli">
                            <a href="index.php?action=donhang&query=xemdonhang&IDOR=<?php echo $row['IDOR'] ?>&status=<?php echo $row['status'] ?>">Xem</a>
                        </th>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script jQuery AJAX -->
<script>
    $(document).ready(function() {
        $("#search").click(function() {
            var startDate = $(".datesearch1").val();
            var endDate = $(".datesearch2").val();
            var status = $("#status").val(); // Lấy giá trị của combobox trạng thái

            $.ajax({
                url: 'modules/quanlidonhang/loaddulieusearch.php',
                method: 'POST',
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    status: status // Gửi giá trị trạng thái
                },
                success: function(response) {
                    $("#datahere").html(response);
                }
            });
        });
    });
</script>