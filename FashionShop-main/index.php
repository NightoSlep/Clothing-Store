<?php
session_start();
include "./admincp/config/config.php";
if (isset($_GET['id'])) {
    $temp = $_GET['id'];
    if ($temp == "out") {
        session_destroy();
        header('location:index.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="uniqlo_roman_180.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css" type="text/css"> 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/aa6d8f6c48.js" crossorigin="anonymous"></script>
    <script src="js/ajax.js"></script>

    <title>Fashion</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    
    <div id="container">
         <!-- fetch data from ajax -->
        <div id="data"></div>

        <div id="main" >
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                if ($id == 'chitiet-sp') {
                    include "include/detail-products.php";
                }
                if ($id == 'quanlytaikhoan') {
                    include "include/acc-management.php";
                }
                if ($id == 'signin') {
                    include "include/sign-in.php";
                }
                if ($id == 'signup') {
                    include "include/sign-up.php";
                }
                if ($id == 'shop-cart') {
                    include "include/shop-cart.php";
                }
            } else{
                if (isset($_GET['search'])) {
                    include "include/find-products.php";
                   
                } else {
                    include 'slide.php';
                    include "include/show-products.php";
                }
            }
            ?>
            <div class="clear"></div>
        </div>
    </div>
    <?php include 'footer.php'; ?>

    <script src="js/myjs.js" type="text/javascript"></script>

</body>

</html>