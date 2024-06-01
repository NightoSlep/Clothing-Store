<?php
$queryGetListSP = mysqli_query($mysqli, "SELECT DISTINCT product.* FROM product INNER JOIN detailproduct ON product.IDPR = detailproduct.IDPR");
$queryNhaCungCap = mysqli_query($mysqli, "SELECT * FROM supplier");
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="form">
    <div class="form-title">Thêm phiếu nhập hàng</div>
    <h1>Chọn sản phẩm</h1>
    <div class="form-content">
        <form method="POST" action="modules/quanlyphieunhap/xuli.php?action=them" id="form">

            <div>
                <select name="sanPhamNhap[]" id="sanpham" class="sanpham">
                    <?php
                    mysqli_data_seek($queryGetListSP, 0); // Đưa con trỏ về đầu kết quả
                    while ($row = mysqli_fetch_array($queryGetListSP)) {
                        echo "<option value='" . $row['IDPR'] . "'>" . $row['NAME'] . "</option>";
                    }
                    ?>
                </select>
                <select name="maunhap[]" id="mau" class="mau"></select>
                <label for="soluongnhap">Số lượng: </label>
                <input type="text" name="soluongnhap[]">
                <label for="">Đơn giá</label>
                <input type="text" name="dongia[]">
                <input type="button" value="Hủy" name="huy" class="btnHuy">
            </div>

            <select name="nhacungcap" id="">
                <?php
                while ($row_nhacungcap = mysqli_fetch_array($queryNhaCungCap)) {
                    echo "<option value='" . $row_nhacungcap['IDSU'] . "'>" . $row_nhacungcap['NAME'] . "</option>";
                }
                ?>
            </select>
            <input type="button" value="Thêm" id="btnThem">
            <div class="input2">
                <input type="submit" name="themphieunhap" value="Thêm phiếu nhập">
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#sanpham").change(function() {
            var productId = $(this).val();
            $.ajax({
                url: "modules/quanlyphieunhap/loaddata.php",
                type: "GET",
                data: {
                    productId: productId
                },
                dataType: "json",
                success: function(response) {
                    var selectMau = $("#mau");
                    selectMau.empty();

                    $.each(response, function(index, color) {
                        selectMau.append("<option value='" + color.IDCO + "'>" + color.NAME + "</option>");
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed: " + status + ", " + error);
                }
            });
        });

        $("#form").on("change", ".sanpham", function() {
            var productId = $(this).val();
            var parentDiv = $(this).closest("div");
            var selectMau = parentDiv.find(".mau");

            $.ajax({
                url: "modules/quanlyphieunhap/loaddata.php",
                type: "GET",
                data: {
                    productId: productId
                },
                dataType: "json",
                success: function(response) {
                    selectMau.empty();

                    $.each(response, function(index, color) {
                        selectMau.append("<option value='" + color.IDCO + "'>" + color.NAME + "</option>");
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX request failed: " + status + ", " + error);
                }
            });
        });



        });

        document.querySelectorAll('.btnHuy').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var parentDiv = btn.parentElement; // Lấy phần tử cha của nút "Hủy"
                parentDiv.remove(); // Xóa phần tử cha, tức là hàng chứa nút "Hủy"
            });
        });

        document.getElementById("btnThem").addEventListener("click", function() {
            // Lấy phần tử form
            var form = document.getElementById("form");

            // Đếm số lượng sản phẩm đã được thêm vào form
            var productCount = form.querySelectorAll('.sanpham').length;

            // Tạo chuỗi HTML chứa các phần tử mới với ID duy nhất
            var newElementsHTML = `
        <div>
            <select name="sanPhamNhap[]" id="sanpham${productCount}" class="sanpham">
                <?php
                mysqli_data_seek($queryGetListSP, 0); // Đưa con trỏ về đầu kết quả
                while ($row = mysqli_fetch_array($queryGetListSP)) {
                    echo "<option value='" . $row['IDPR'] . "'>" . $row['NAME'] . "</option>";
                }
                ?>
            </select>
            <select name="maunhap[]" id="mau${productCount}" class="mau"></select>
            <label for="soluongnhap">Số lượng: </label>
            <input type="text" name="soluongnhap[]">
            <label for="">Đơn giá</label>
            <input type="text" name="dongia[]">
            <input type="button" value="Hủy" name="huy" class="btnHuy">
        </div>
    `;

            // Chèn chuỗi HTML vào đầu của form
            form.insertAdjacentHTML("afterbegin", newElementsHTML);

            // Lắng nghe sự kiện click cho nút "Hủy" mới
            var newBtnHuy = form.querySelector('.btnHuy');
            newBtnHuy.addEventListener('click', function() {
                var parentDiv = newBtnHuy.parentElement; // Lấy phần tử cha của nút "Hủy"
                parentDiv.remove(); // Xóa phần tử cha, tức là hàng chứa nút "Hủy"
            });
        });
</script>