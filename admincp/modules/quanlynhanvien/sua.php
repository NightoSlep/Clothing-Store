<?php
$sql_sua_nv = "SELECT * FROM account WHERE IDAC=$_GET[IDAC] LIMIT 1";
$query_sua_nv = mysqli_query($mysqli, $sql_sua_nv);
?>

<div class="form">
	<div class="form-title">Sửa tài khoản </div>
	<div class="form-content">
		<form method="POST" action="modules/quanlynhanvien/xuli.php?IDAC=<?php echo $_GET['IDAC'] ?>">
			<?php
			while ($dong = mysqli_fetch_array($query_sua_nv)) {
			?>

				<div class="input1">
					<p>Fullname</p>
					<input type="text" name="fullname" required value="<?php echo $dong['FULLNAME'] ?>">
				</div>
				<div class="input1">

					<p>Password</p>
					<input type="text" name="password" value="<?php echo $dong['PASSWORD'] ?>">
				</div>


				<div class="input1">
					<p>Số điện thoại</p>
					<input type="text" name="sdt" required value="<?php echo $dong['NUMBERPHONE'] ?>">
				</div>

				<div class="input1">
					<p>Email</p>
					<input style="width:300px" type="text" name="email" required value="<?php echo $dong['EMAIL'] ?>">
				</div>

				<div class="input1">
					<p>Địa chỉ</p>
					<input type="text" style="width:300px" name="ADRESS" required value="<?php echo $dong['ADRESS'] ?>">
				</div>

				<div class="input1">
					<p>Giới tính :</p>
					<select name="gender" id="">
						<?php
						// Assuming $_GET['IDAC'] contains the ID of the account you want to retrieve gender for
						$IDAC = mysqli_real_escape_string($mysqli, $_GET['IDAC']);
						$sql_phanquyen = mysqli_query($mysqli, "SELECT GENDER FROM account WHERE IDAC = '$IDAC'");
						if ($sql_phanquyen) {
							$row_quyen = mysqli_fetch_assoc($sql_phanquyen);
							$gender = strtoupper($row_quyen['GENDER']); // Convert gender to uppercase for consistency
							if ($gender == 'MALE') {
								echo '<option value="MALE" selected>Nam</option>';
								echo '<option value="FEMAL">Nữ</option>';
							} else {
								echo '<option value="MALE">Nam</option>';
								echo '<option value="FEMAL" selected>Nữ</option>';
							}
						} else {
							// Handle error if query fails
							echo '<option value="" disabled selected>Không có dữ liệu</option>';
						}
						?>
					</select>
				</div>


				<div class="input1">
					<p>Quyền truy cập :</p>
					<select name="quyen" id="">
						<?php
						$sql_phanquyen = mysqli_query($mysqli, 'select* FROM permission ');
						$sql_phanquyen1 = mysqli_query($mysqli, 'select* FROM account ');
						$row_quyen1 = mysqli_fetch_array($sql_phanquyen1);
						while ($row_quyen = mysqli_fetch_array($sql_phanquyen)) {
							if ($row_quyen['IDPE'] == $row_quyen1['IDPE']) {
						?>
								<option selected value="<?php echo $row_quyen['IDPE'] ?>">
									<?php echo $row_quyen['Name'] ?>
								</option>
							<?php
							} else {
							?>
								<option value="<?php echo $row_quyen['IDPE'] ?>">
									<?php echo $row_quyen['Name'] ?>
								</option>
						<?php
							}
						}
						?>
					</select>
				</div>
				<div class="input2">
					<input type="submit" name="suanhanvien" value="Sửa tài khoản">
				</div>
			<?php } ?>
		</form>
	</div>
</div>