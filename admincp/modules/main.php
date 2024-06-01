<?php
    include('config/config.php');
?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

<section class="home-section">
  <div class="home-content">
    <i class='bx bx-menu'></i>
    <span class="text">Drop Down Sidebar</span>
  </div>
  <div class="home-content2">
    <?php
    
    if (isset($_GET['action'])  && isset($_GET['query'])) {
      $tam = $_GET['action'];
      $query = $_GET['query'];
    } else {
      $tam = '';
      $query = '';
    }
    if ($tam == 'quanlyloaisp' && $query == 'them') {
      if(in_array(9, $_SESSION['IDAB_array'])){
        include 'modules/quanliloaisp/them.php';
      }
      include 'modules/quanliloaisp/lietke.php';
    } elseif ($tam == 'quanlynhacungcap' && $query == 'them') {
      if(in_array(7, $_SESSION['IDAB_array'])){
        include("modules/quanlynhacungcap/them.php");
      }
      include("modules/quanlynhacungcap/lietke.php");
    } elseif ($tam == 'quanlynhacungcap' && $query == 'sua') {
      include("modules/quanlynhacungcap/sua.php");
    } elseif ($tam == 'quanlynhanvien' && $query == 'them') {
      if(in_array(5, $_SESSION['IDAB_array'])){
        include("modules/quanlynhanvien/them.php");
      }
      include("modules/quanlynhanvien/lietke.php");
    } elseif ($tam == 'quanlyphieunhap' && $query == 'lietke') {
      include("modules/quanlyphieunhap/lietke.php");
    } elseif ($tam == 'quanlyphieunhap' && $query == 'them') {
      if(in_array(10, $_SESSION['IDAB_array']) ){
        include("modules/quanlyphieunhap/them.php");
      }
    } elseif ($tam == 'quanlyphieunhap' && $query == 'xemchitiet') {
      include("modules/quanlyphieunhap/xemchitiet.php");
    } elseif ($tam == 'quanlynhanvien' && $query == 'sua') {
      include("modules/quanlynhanvien/sua.php");
    } elseif ($tam == 'quanlyloaisp' && $query == 'sua') {
      include("modules/quanliloaisp/sua.php");
    } elseif ($tam == 'quanlycolor' && $query == 'them') {
      if(in_array(21, $_SESSION['IDAB_array'])){
        include("modules/quanlicolor/them.php");
      }
      include("modules/quanlicolor/lietke.php");
    } elseif ($tam == 'quanlycolor' && $query == 'sua') {
      include("modules/quanlicolor/sua.php");
    } elseif ($tam == 'quanlysanpham' && $query == 'them') {
      if(in_array(26, $_SESSION['IDAB_array'])){
        include("modules/quanlisanpham/them.php");
      }
      include("modules/quanlisanpham/lietke.php");
    } elseif ($tam == 'quanlysp' && $query == 'sua') {
      include("modules/quanlisanpham/sua.php");
    } elseif($tam == 'quanlysp' && $query == 'xemchitiet'){
      include("modules/quanlisanpham/chitietsp.php");
    }

    elseif ($tam == 'quanlysp' && $query == 'xoa_anh') {
      include("modules/quanlisanpham/sua_anh_phu.php");
    } elseif ($tam == 'quanlydonhang' && $query == 'them') {
      include("modules/quanlidonhang/lietke.php");
    } elseif ($tam == 'donhang' && $query == 'xemdonhang') {
      include("modules/quanlidonhang/xemdonhang.php");
    } elseif ($tam == 'quanlynhomquyen' && $query == 'them') {
      include("modules/quanlynhomquyen/lietkenhomquyen.php");
    } elseif ($tam == 'quanlynhomquyen' && $query == 'sua') {
      include("modules/quanlynhomquyen/xemchitiet.php");
    }elseif ($tam == 'quanlynhomquyen' && $query == 'sua1'){
      include("modules/quanlynhomquyen/themnhomquyen.php");

    }else {
      if (in_array(14, $_SESSION['IDAB_array'])||in_array(16, $_SESSION['IDAB_array'])) {

      include("modules/dashboard.php");}
    }



    ?>
  </div>

</section>