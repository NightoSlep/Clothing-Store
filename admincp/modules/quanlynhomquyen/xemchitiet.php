<!DOCTYPE html>
<html>
<head>
  <title>Xem chi tiết nhóm quyền</title>
  <style>
    .title_donhang {
      text-align: center;
      padding: 20px;
      font-size: 25px;
      font-weight: 600;
    }
    .td_sp {
      float: right;
      margin-right: 25px;
    }
    .Thank {
      font-size: 25px;
      text-align: center;
      font-weight: 600;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<p class="title_donhang">Xem chi tiết nhóm quyền</p>

<?php
$mysqli = new mysqli("localhost", "root", "", "doan1");

if ($mysqli->connect_errno) {
  echo "Kết nối MYSQLi lỗi" . $mysqli->connect_error;
  exit();
}

$code = $_GET['IDPE'];

$sql_lietke_phieunhap1  = "SELECT * FROM permission WHERE IDPE=$code";
$query_lietke_phieunhap1 = mysqli_query($mysqli, $sql_lietke_phieunhap1);
$row1 = mysqli_fetch_array($query_lietke_phieunhap1);
$sql_lietke_phieunhap = "SELECT * FROM detailpermission WHERE IDPE=$code";
$query_lietke_phieunhap = mysqli_query($mysqli, $sql_lietke_phieunhap);

$sql_ability = "SELECT * FROM ability";
$query_ability = mysqli_query($mysqli, $sql_ability);

?>
<?php if (in_array(30, $_SESSION['IDAB_array'])){?>
<div>
  <p class="codeability">Mã nhóm quyền : <?php echo $code ?></p>
  <div class="input2">
    <button type="submit" id="submitBtn" style="width: 50%;
    height: 50px;
    border-radius: 8px;
    padding: 0 10px;
    padding: 10px;
    cursor: pointer;
    border: none;
    background-color: rgb(11, 7, 247);
    color: #fff;
    border-radius: 8px;">Lưu</button> <!-- Đặt id cho nút lưu -->
  </div>
</div>
<?php }?>
<div class="input1">
  <p>Tên nhóm quyền</p>
  <input type="text" id="groupName" name="name" required value="<?php echo $_GET['Name']; ?>">
</div>
<div class="input1">
  <p>Mô tả nhóm quyền</p>
  <input type="text" id="Description" name="name" required value="<?php echo $row1['Description']; ?>">
</div>
<table style="width:100%" border="1" style="border-collapse: collapse;">
  <tr>
    <th>ID Tác vụ</th>
    <th>Tên Tác Vụ</th>
    <th>Mô tả</th>
  </tr>
  <?php
  while ($row = mysqli_fetch_array($query_ability)) {
    // Kiểm tra xem IDAB của dòng hiện tại có tồn tại trong kết quả truy vấn detailpermission hay không
    $checked = '';
    $tmp = $row['IDAB'];
    if (mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM detailpermission WHERE IDPE=$code AND IDAB=$tmp")) > 0) {
      $checked = 'checked';
    }
  ?>
    <tr class="tr_sp">
      <td><?php echo $row['IDAB'] ?></td>
      <td><?php echo $row['NAME'] ?></td>
      <td><?php echo $row['DESCRIPTION'] ?></td>
      <!-- Đặt tên cho checkbox dưới dạng mảng -->
      <td><input type='checkbox' class="permissionCheckbox" data-id="<?php echo $row['IDAB']; ?>" <?php echo $checked; ?>></td>
    </tr>
  <?php
  }
  ?>
</table>

<script>
$(document).ready(function(){

  $("#groupName").change(function(){
    var groupName = $("#groupName").val();
    var groupID = <?php echo $code; ?>;

    $.ajax({
      type: "POST",
      url: "./modules/quanlynhomquyen/xuly.php",
      data: { groupName: groupName, action: "checksua",groupID:groupID },
      beforeSend: function() {
        // Vô hiệu hóa nút submit trong quá trình gửi AJAX
        $("#submitBtn").prop("disabled", true);
      },
      success: function(response){
        if(response.includes("Tên đã tồn tại")){
          alert(response);
          $("#groupName").val('');
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("Đã có lỗi xảy ra trong quá trình lưu dữ liệu!");
      },
      complete: function() {
        // Kích hoạt lại nút submit sau khi yêu cầu AJAX kết thúc
        $("#submitBtn").prop("disabled", false);
      }
    });
  });




  $("#submitBtn").click(function(){
    var groupName = $("#groupName").val();
    var groupID = <?php echo $code; ?>;
    var Description =$("#Description").val();
    var permissions = [];
    console.log(groupName);
    $(".permissionCheckbox").each(function(){
      if($(this).is(":checked")){
        permissions.push($(this).data("id"));
      }
    });
    $.ajax({
      type: "POST",
      url: "./modules/quanlynhomquyen/xuly.php",
      data: { groupName: groupName, groupID: groupID, permissions: permissions,Description:Description },
      success: function(response){
        window.location.href = '../admincp/index.php?action=quanlynhomquyen&query=them';
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        alert("Đã có lỗi xảy ra trong quá trình lưu dữ liệu!");
      }
    });
  });
});
</script>

</body>
</html>
