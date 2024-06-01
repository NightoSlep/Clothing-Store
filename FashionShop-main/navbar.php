<?php
$sql = "SELECT * FROM categories WHERE NOT (IDCA='1') ORDER BY IDCA ";
$query = mysqli_query($con, $sql);
?>

<style>
    .menu {
        position: relative;
        display: inline-block;
    }

    .menu-link {
        color: #000;
        text-indent: -8px;
        text-decoration: none !important;
    }

    .dropdown {
        position: absolute;
        top: 100%;
        left: 0;
        display: none;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .menu:hover .dropdown {
        display: block;
    }

    .dropdown ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .dropdown li {
        padding: 8px 12px;
        
    }

    .dropdown li:last-child {
        border-bottom: none; /* Loại bỏ đường viền dưới cho mục cuối cùng */
    }

    .dropdown li:hover {
        background-color: #f0f0f0;
    }

    .dropdown a {
        text-decoration: none !important;
        color: #000;
        font-size: 16px;
    }

    .dropdown a:hover {
        color: #333;
    }

    .search-bar {
        position: relative;
        display: inline-block;
        border: none;
    }

    .search-bar input[type="text"] {
        height: 29px;
        padding: 10px 30px 10px 10px;
        width: 250px;
        padding-right: 40px;
    }

    .search-bar button.search-btn {
        position: absolute;
        top: 10;
        right: 0;
        border: none;
        margin-right: 2px;
    }

    .search-btn {
        top: 50%;
        transform: translateY(-50%);
        border: none;
    }

    .search-btn i {
        font-size: 22px;
        color: #888;
    }

    .dropdown-wrapper {
        position: relative;
        display: inline-block;
    }

    .dropdown-wrapper .dropdown-menu {
        display: none;
        position: absolute;
        background-color: #fff; /* Màu trắng không trong suốt */
        min-width: 160px;
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        z-index: 1;
        height: auto; /* Đặt chiều cao tự động */
    }

    .dropdown-wrapper:hover .dropdown-menu {
        display: block;
    }

    .icon {
        position: relative;
    }

    .icon a {
        text-decoration: none;
        color: #000;
    }

    .icon i {
        font-size: 25px;
    }

    .icon:hover i {
        color: #333;
    }

    .icon .user-icon {
        margin-right: 10px;
    }

    .icon .cart-icon {
        margin-left: 10px;
    }
</style>

<nav>
    <div class="left-sidebar">
        <a href="index.php"><img class="logo" src="icons/uniqlo-logo.jpg" alt="logo"></a>
        <div class="menu">
            <ul style="list-style-type: style none;">
                <li class="item-menu" style="list-style-type: none;">
                    <a href="index.php?search=" class="menu-link" style="text-decoration:none">Loại Sản Phẩm</a>
                    <div class="dropdown">
                        <ul id="dropdown-menu">
                            <?php
                            while ($row_title = mysqli_fetch_array($query)) { ?>
                                <li>
                                    <a id="loaisp" onclick="phanloai(<?php echo $row_title['IDCA']; ?>,1)">
                                        <?php echo $row_title['NAME']; ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-sidebar">
        <div class="search-bar">
            <form action="index.php" method="GET">
                <input type="text" name="search" placeholder="Tìm kiếm theo từ khóa">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="icon">
            <?php if (!isset($_SESSION['user'])) { ?>
                <span class="user-icon"><a href="index.php?id=signin"><i class="far fa-user"></i></a></span>
            <?php
            } else if (isset($_SESSION['user'])) {
                $data = $_SESSION['user']; ?>
                <div class="dropdown-wrapper">
                    <span class="user-icon"><a href="index.php?id=quanlytaikhoan"><i class="far fa-user"></i></a></span>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?id=quanlytaikhoan">Quản lý tài khoản</a>
                        <a class="dropdown-item" href="index.php?id=out">Đăng xuất</a>
                    </div>
                </div>
            <?php } ?>
            <span class="cart-icon"><a href="index.php?id=shop-cart"><i class="fas fa-cart-plus"></i></a></span>
        </div>
    </div>
</nav>
