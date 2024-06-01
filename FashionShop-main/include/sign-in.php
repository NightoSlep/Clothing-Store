<div class="dk-content" style="
    display:flex;
    align-item:center;
    justify-content:center;
">
    <?php
    if (isset($_GET['trangthai'])) {
        $result = $_GET['trangthai'];

        if ($result == 'dktk') {
            echo '<script> alert("Bạn đã đăng ký thành công.")</script>';
        }
        if ($result == 'sai-tk-mk') {
            $err['false'] = "Tài khoản hoặc mật khẩu sai.";
        }
    }
    ?>
    <div class="sign-in">
        <br>
        <div class="title-dk">
            <h1>Đăng nhập</h1>
        </div>

        <div class="sign-form">
            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label for="email">Tên đăng nhập:</label> <br>
                    <input type="text" name="email" id="email" placeholder="Nhập tên đăng nhập">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label><br>
                    <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"><br><br>
                    <!-- Thêm phần hiển thị lỗi -->
                    <div class="err-mess" id="loginError"> <?php echo (isset($err['false'])) ? $err['false'] : '' ?> </div>
                </div>

                <div class="form-submit">
                    <input type="submit" id="submit" value="Đăng nhập" name="submit">
                </div>

            </form>
        </div>
        <div class="form-group">
            <a href="#">Quên mật khẩu?</a>
        </div>
        <div class="form-group">
            Bạn chưa có tài khoản?<a href="index.php?id=signup"> Đăng ký thành viên</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').submit(function(event) {
            event.preventDefault(); // Ngăn chặn việc submit form mặc định

            var formData = $(this).serialize(); // Thu thập dữ liệu form

            $.ajax({
                type: 'POST',
                url: 'signin.php', // Đường dẫn tới file xử lý đăng nhập
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response.trim() == 200) {
                        window.location.href = 'index.php'; // Chuyển hướng tới trang dashboard
                    } else {
                        // Đăng nhập thất bại
                        $('#loginError').html('Tài khoản hoặc mật khẩu sai.'); // Hiển thị thông báo lỗi
                    }
                }
            });
        });
    });
</script>
