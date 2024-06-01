<br><br>
<style>

</style>
<div class="sign-in" style="
align-item:center;
justify-content:center;
">
    <div class="title-dk">
        <h1>Đăng ký</h1>
    </div><br><br>
    <div class="sign-form">
        <form action="signup.php" method="POST">
            <div class="form-group">
                <label for="hoten">Nhập họ và tên:</label>
                <div class="popup" onmouseover="popup()">*
                    <span class="popuptext" id="myPopup">Họ tên không chứa các ký tự đặc biệt, có thể có dấu.</span>
                </div>
                <br>
                <input type="hoten" name="hoten" id="hoten" placeholder="Nhập Họ và tên:"><br>
                <div class="err-mess"> <span> <?php echo (isset($_SESSION['error']['hoten'])) ? $_SESSION['error']['hoten'] : '' ?></span> </div>

            </div>
            <div class="form-group">
                <label for="email">Tên đăng nhập:</label>
                <div class="popup" onmouseover="popup1()">*
                    <span class="popuptext" id="myPopup1">Chỉ nhận email</span>
                </div><br>
                <input type="text" name="email" id="email" placeholder="Nhập email">
                <div class="err-mess"> <span> <?php echo (isset($_SESSION['error']['email'])) ? $_SESSION['error']['email'] : '' ?></span> </div>
                <div class="err-mess" id="tendn"></div>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <div class="popup" onmouseover="popup2()">*
                    <span class="popuptext" id="myPopup2">Mật khẩu dài 3-18 ký tự, không chứa ký tự đặc biệt</span>
                </div><br>
                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"><br>
                <div class="err-mess"> <span> <?php echo (isset($_SESSION['error']['password'])) ? $_SESSION['error']['password'] : '' ?></span> </div>
            </div>
            <div class="form-group">
                <label for="rpassword">Nhập lại mật khẩu:</label><br>
                <input type="password" name="rpassword" id="rpassword" placeholder="Nhập lại mật khẩu"><br>
                <div class="err-mess"> <span> <?php echo (isset($_SESSION['error']['rpassword'])) ? $_SESSION['error']['rpassword'] : '' ?></span> </div>
            </div>

            <div class="form-group">
                <label for="sdt">Nhập số điện thoại:</label><br>
                <input type="text" name="sdt" id="sdt" placeholder="Nhập số điện thoại"><br>
                <div class="err-mess"> <span> <?php echo (isset($_SESSION['error']['sdt'])) ? $_SESSION['error']['sdt'] : '' ?></span> </div>
            </div>

            <label>Chọn giới tính:</label><br>
            <div class="radio-container">
                <input type="radio" id="nam" name="gender" value="nam" checked>
                <label for="nam">Nam</label>
            </div>
            <div class="radio-container">
                <input type="radio" id="nu" name="gender" value="nu">
                <label for="nu">Nữ</label>
            </div>

            <div class="form-group">
                <label for="email">Nhập địa chỉ:</label>
                <br>
                <input type="address" name="address" id="address" placeholder="Nhập địa chỉ"><br>
                <div class="err-mess"> <span> <?php echo (isset($_SESSION['error']['address'])) ? $_SESSION['error']['address'] : '' ?></span> </div>
            </div>

            <div class="form-group">
                <label for="birth">Nhập ngày sinh:</label><br>
                <input type="text" name="birth" id="birth" placeholder="Nhập ngày sinh"><br>
            </div>
            <div class="err-mess" id="loginError"> <?php echo (isset($err['false'])) ? $err['false'] : '' ?> </div>

            <div class="form-submit">
                <input type="submit" id="submit" value="Đăng ký" name="submit">
            </div>
        </form>
    </div>

    <div class="form-group">
        Đã có tài khoản?<a href="index.php?id=signin"> Đăng nhập.</a>
    </div>
</div>
<?php unset($_SESSION['error']); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            event.preventDefault(); // Ngăn chặn form submit mặc định

            var formData = $(this).serialize(); // Lấy dữ liệu từ form

            $.ajax({
                url: 'signup.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response == 100) {
                        alert("Đăng ký thành công!"); // Hiển thị thông báo thành công
                        window.location.href = 'index.php?id=signin'; // Chuyển hướng đến trang đăng nhập
                    } else {
                        alert(response); // Hiển thị thông báo lỗi từ server
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi gửi yêu cầu AJAX: ', error);
                }
            });

        });

    });

    function popup() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }

    function popup1() {
        var popup = document.getElementById("myPopup1");
        popup.classList.toggle("show");
    }

    function popup2() {
        var popup = document.getElementById("myPopup2");
        popup.classList.toggle("show");
    }
</script>