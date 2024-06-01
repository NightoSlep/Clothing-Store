<div class="sidebar close">
  <div class="logo-details">
    <i class='bx bxl-c-plus-plus'></i>
    <span class="logo_name">Nhóm 7</span>
  </div>
  <ul class="nav-links">
    <?php
    if (in_array(32, $_SESSION['IDAB_array']))
      echo "<li>
    <a href='index.php?action=home'>
      <i class='bx bx-grid-alt'></i>
      <span class='link_name'>Dashboard</span>
    </a>
    <ul class='sub-menu blank'>
      <li><a class='link_name' href='#'>Dashboard</a></li>
    </ul>
  </li>"; ?>


    <li>
      <div class="iocn-link">
        <a href="#">
          <i class='bx bx-collection'></i>
          <span class="link_name"> Danh mục</span>
        </a>
        <i class='bx bxs-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="#">Quản lí danh mục</a></li>
        <?php if (in_array(8, $_SESSION['IDAB_array']) || in_array(9, $_SESSION['IDAB_array'])){
          echo  "<li><a href='index.php?action=quanlyloaisp&query=them'>Quản lí Loại sản phẩm</a></li>";}
          if(in_array(21, $_SESSION['IDAB_array']) || in_array(22, $_SESSION['IDAB_array'])){
          echo "<li><a href='index.php?action=quanlycolor&query=them'>Quản Lí Màu Sắc</a></li>
        ";}
        ?>
      </ul>
    </li>
    <?php if (in_array(25, $_SESSION['IDAB_array']) || in_array(26, $_SESSION['IDAB_array']))
      echo " <li>
        <a href='index.php?action=quanlysanpham&query=them'>
          <i class='bx bx-book-alt'></i>
          <span class='link_name'>Quản lí sản phẩm </span>
        </a>
        <ul class='sub-menu blank'>
            <li><a class='link_name' href='#'>Quản lí sản phẩm</a></li>
          </ul>

    </li>";?>
   
   <?php if (in_array(6, $_SESSION['IDAB_array']) || in_array(7, $_SESSION['IDAB_array'])){
    echo "    <li>
    <a href='index.php?action=quanlynhacungcap&query=them'>
      <i class='bx bx-line-chart'></i>
      <span class='link_name'>Quản lí nhà cung cấp</span>
    </a>
    <ul class='sub-menu blank'>
      <li><a class='link_name' href='#'>Quản lí nhà cung cấp</a></li>
    </ul>
  </li>";}

  if (in_array(10, $_SESSION['IDAB_array']) || in_array(11, $_SESSION['IDAB_array'])){
echo"
    <li>
      <a href='index.php?action=quanlyphieunhap&query=lietke'>
        <i class='bx bx-comment-edit'></i>
        <span class='link_name'>Quản lí phiếu nhập</span>
      </a>
      <ul class='sub-menu blank'>
        <li><a class='link_name' href='#'>Quản lí phiếu nhập</a></li>
      </ul>
    </li>";}  
; ?>

<?php if (in_array(2, $_SESSION['IDAB_array']) || in_array(3, $_SESSION['IDAB_array'])||in_array(4, $_SESSION['IDAB_array']) || in_array(5, $_SESSION['IDAB_array']))
echo "
    <li>
        <a href='index.php?action=quanlynhanvien&query=them'>
          <i class='fa-solid fa-person'></i>
          <span class='link_name'>Quản lí tài khoản</span>
        </a>
        <ul class='sub-menu blank'>
        <li><a class='link_name' href='#'>Quản lí tài khoản</a></li>
      </ul>



  </li>";?>
  
  <?php if (in_array(29, $_SESSION['IDAB_array']) || in_array(30, $_SESSION['IDAB_array']))
    echo "
    <li>
        <a href='index.php?action=quanlynhomquyen&query=them'>
          <i class='bx bx-plug'></i>
          <span class='link_name'>Quản lí nhóm quyền</span>
        </a>
        <ul class='sub-menu blank'>
        <li><a href='index.php?action=quanlynhomquyen&query=them'>Quản lý nhóm quyền</a></li>
      </ul>



  </li>
";?>

  <li>
  <div class='iocn-link'>
        <a href='\Web_ban_Hang_cong_nghe_v2-main\admincp\login.php'>
          <i class='fa fa-sign-out'></i>
          <span class='link_name'>Đăng xuất</span>
        </a>
        <i class='bx bxs-chevron-down arrow'></i>
      </div>

      <ul class='sub-menu'>
        <li><a class='link_name' href='\Web_ban_Hang_cong_nghe_v2-main\admincp\login.php'>Đăng xuất</a></li>

      </ul>
  </li>
</div>