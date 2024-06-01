<?php
$mysqli = new mysqli("localhost", "root", "", "doan1");

if (isset($_GET['action']) && $_GET['action'] == "xoa") {
  $IDPE = $_GET['IDPE'];
  try {
    $sql_update = "UPDATE account SET IDPE=6 WHERE IDPE=$IDPE";
    $mysqli->query($sql_update);

    $sql_delete = "DELETE FROM detailpermission WHERE IDPE=$IDPE";
    $mysqli->query($sql_delete);
    $sql_delete1 = "DELETE FROM permission WHERE IDPE=$IDPE";
    $mysqli->query($sql_delete1);
    echo ' <script>window.location.href = "/Web_ban_Hang_cong_nghe_v2-main/admincp/index.php?action=quanlynhomquyen&query=them";
  </script>  ';
    return;
  } catch (Exception $e) {
    $mysqli->rollback();
    echo "Error: " . $e->getMessage();
  }
}

$mysqli->begin_transaction();


if (isset($_POST['action']) && isset($_POST['action']) == "check") {
  $sql = "SELECT * FROM permission WHERE Name='" . $_POST['groupName'] . "'";
  $row = mysqli_query($mysqli, $sql);
  $count = mysqli_num_rows($row);

  if ($count > 0) {
    echo 'Tên đã tồn tại';
    return;
  }
  return;
}

if (isset($_POST['action']) && isset($_POST['action']) == "checksua") {
  $sql = "SELECT * FROM permission WHERE Name='" . $_POST['groupName'] . "' and IDPE ='" . $_POST['groupID'] . "'";
  $row = mysqli_query($mysqli, $sql);
  $count = mysqli_num_rows($row);

  if ($count > 0) {
    echo 'Tên đã tồn tại';
    return;
  }
  return;
}

if (isset($_POST['groupID']) && $_POST['groupID'] != "") {
  try {
    $groupName = $_POST['groupName'];
    $groupID = $_POST['groupID'];
    if (isset($_POST['permissions'])) {
      $permissions = $_POST['permissions'];
    }
    $groupdescription = $_POST['Description'];
  } catch (Exception $e) {
  }
  try {
    $sql_update = "UPDATE permission SET Name='$groupName',Description='$groupdescription' WHERE IDPE=$groupID";
    $mysqli->query($sql_update);

    // Xóa toàn bộ dữ liệu trong bảng detailpermission dựa trên IDPE
    $sql_delete = "DELETE FROM detailpermission WHERE IDPE=$groupID";
    $mysqli->query($sql_delete);
    if (isset($_POST['permissions'])) {
      foreach ($permissions as $permission) {
        $sql_insert = "INSERT INTO detailpermission (IDPE, IDAB) VALUES ($groupID, $permission)";
        $mysqli->query($sql_insert);
      }
    }

    $mysqli->commit();

    echo "Data saved successfully!";
    return;
  } catch (Exception $e) {
    $mysqli->rollback();
    echo "Error: " . $e->getMessage();
  }
  return;
} else {
  $groupName = $_POST['groupName'];
  if (isset($_POST['permissions'])) {
    $permissions = $_POST['permissions'];
  }
  $groupdescription = $_POST['Description'];
  try {
    $sql_update = "INSERT INTO permission (Name, Description) VALUES ('$groupName', '$groupdescription')";
    $mysqli->query($sql_update);
    $last_inserted_id = $mysqli->insert_id;
    if (isset($_POST['permissions'])) {

      foreach ($permissions as $permission) {
        $sql_insert = "INSERT INTO detailpermission (IDPE, IDAB) VALUES ($last_inserted_id, $permission)";
        $mysqli->query($sql_insert);
      }
    }
    $mysqli->commit();

    echo "Thêm nhóm quyền thành công!";
    return;
  } catch (Exception $e) {
    $mysqli->rollback();
    echo "Error: " . $e->getMessage();
  }
  return;
}
$mysqli->close();
