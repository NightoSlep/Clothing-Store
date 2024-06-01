<?php
include "admincp/config/config.php";
session_start();
if ($_SESSION['user']) {

    $action = (isset($_GET['action'])) ? $_GET['action'] : 'add';
    $cart_number = (isset($_GET['soluong'])) ? $_GET['soluong'] : 1;

    if (isset($_GET['id_product']) && $_GET['id_color']) {

        $id = $_GET['id_product'];
        $color = $_GET['id_color'];

        $sql_chitiet = "SELECT * FROM detailproduct, product WHERE detailproduct.IDPR = product.IDPR AND product.IDPR = '$id'";
        $query_detail = mysqli_query($con, $sql_chitiet);

        $sql_sanpham = "SELECT * FROM  product WHERE product.IDPR = '$id'";
        $query_sanpham = mysqli_query($con, $sql_sanpham);

        if ($query_detail) {
            $product = mysqli_fetch_assoc($query_detail);
        }

        if ($query_sanpham) {
            $product_test = mysqli_fetch_assoc($query_sanpham);
        }


        $item = [
            'productId' => $product_test['IDPR'],
            'name' => $product_test['NAME'],
            'id_color' => $color,
            'images' => $product_test['IMAGES'],
            'cost' => $product_test['COST'],
            'total_quanity' => $product['QUANITY'],
            'cart_number' => $cart_number
        ];
    }



    if ($action == 'add') {
        // Tạo một khóa duy nhất cho mỗi sản phẩm với mỗi màu sắc

        $id = $_GET['id_product'];
        $color = $_GET['id_color'];
        $key = $id . '_' . $color;

        if (isset($_SESSION['cart'][$key])) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng của sản phẩm đó
            $_SESSION['cart'][$key]['cart_number'] += $cart_number;
?><script>
                history.back(-1)
            </script><?php
                    } else {
                        // Nếu sản phẩm chưa tồn tại trong giỏ hàng, thêm một bản ghi mới vào giỏ hàng
                        $_SESSION['cart'][$key] = $item;
                        ?><script>
                history.back(-1)
            </script><?php
                    }
                }

                if (isset($_GET['action']) && $_GET['action'] == 'update') {
                    // Kiểm tra xem id_product và id_color có được gửi qua không
                    if (isset($_GET['productId']) && isset($_GET['id_color'])) {
                        $id = $_GET['productId'];
                        $color = $_GET['id_color'];
                        // Tạo khóa duy nhất cho sản phẩm với mỗi màu sắc
                        $key = $id . '_' . $color;
                        $cart_number1 = $_GET['soluong'];
                        // Cập nhật số lượng của sản phẩm trong giỏ hàng
                        $_SESSION['cart'][$key]['cart_number'] = $cart_number1;

                        // Chuyển hướng trở lại trang giỏ hàng sau khi cập nhật
                        header('Location: index.php?id=shop-cart');
                        exit();
                    }
                }
                

                //Thêm ngay
                if ($action == 'addnow') {
                    if (isset($key)) {
                        if (isset($_SESSION['cart'][$key])) {
                            $_SESSION['cart'][$key]['cart_number'] += $cart_number;
                            header('location:index.php?id=shop-cart');
                        } else {
                            $_SESSION['cart'][$key] = $item;
                            header('location:index.php?id=shop-cart');
                        }
                    }
                }

                // Xử lý hành động 'delete'
                if ($action == 'delete') {
                    if (isset($_GET['productId'])) {
                        $id = $_GET['productId'];
                        $color = $_GET['id_color'];
                        // Tạo khóa duy nhất cho sản phẩm với mỗi màu sắc
                        $key = $id . '_' . $color;                        // Xóa mặt hàng khỏi giỏ hàng
                        unset($_SESSION['cart'][$key]);
                        header('location: index.php?id=shop-cart');
                        exit();
                    }
                }

                if ($action == 'thanhtoan') {
                    $tongtien = $_POST['tongtien'];
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $time = date("y-m-d h:i:s A");
                    $id_user = $_SESSION['user']['id_user'];

                    $sql = ("INSERT INTO `order` (`ORDERDATE`,`TOTALPAYMENT`,`TOTALPRODUCT`, `IDAC`, `status`) 
            VALUES ('{$time}','{$tongtien}','{$cart_number}', '{$id_user}', '1')");
                    $query = mysqli_query($con, $sql);

                    if ($query) {
                        $sql4 = "SELECT DISTINCT IDOR FROM `order` WHERE `ORDERDATE` = '{$time}'";
                        $query3 = mysqli_query($con, $sql4);
                        $hoadon = mysqli_fetch_assoc($query3);
                        $cart = $_SESSION['cart'];
                        $id_hoadon = $hoadon['IDOR'];
                        echo $id_hoadon;
                        foreach ($cart as $key => $value) {
                            $id_sanpham = $value['productId'];
                            $soluongsp = $value['cart_number'];
                            $soluongspconlai = $value['total_quanity'] - $value['cart_number'];
                            $id_color = $value['id_color'];
                            $thanhtien = $value['cost'] * $value['cart_number'];
                            $sql_cthd = ("INSERT INTO `detailorder` (`IDPR`, `QUANITY`, `PAYMENT`, `IDOR`, `IDCO`)
                                        VALUES ('{$id_sanpham}','{$soluongsp}','{$thanhtien}','{$id_hoadon}', '{$id_color}')");
                            $query1 = mysqli_query($con, $sql_cthd);
                            $sql_slgh = ("UPDATE detailproduct SET `QUANITY` = $soluongspconlai WHERE IDPR = $id_sanpham AND IDCO = $id_color");
                            $query2 = mysqli_query($con, $sql_slgh);
                        }
                        $_SESSION['cart'] = null;
                        header('location: index.php?id=quanlytaikhoan&action=showhoadon');
                    }
                }
            } else {
                header('location: index.php?id=signin');
            }
