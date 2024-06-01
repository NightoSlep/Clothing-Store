<div class="form">
	<div class="form-title">Thêm tài khoản</div>
	<div class="form-content">
		<form method="POST" action="modules/quanlynhanvien/xuli.php" style="display: flex;justify-content: space-between;width:100%">
		<div class="input1">
					<p>Fullname</p>
					<input type="text" name="fullname" required value="">
				</div>
				<div class="input1">

					<p>Password</p>
					<input type="text" name="password" value="">
				</div>


				<div class="input1">
					<p>Số điện thoại</p>
					<input type="text" name="sdt" required value="">
				</div>

				<div class="input1">
					<p>Email</p>
					<input style="width:300px" type="text" name="email" required value="">
				</div>

				<div class="input1">
					<p>Địa chỉ</p>
					<input type="text" style="width:300px" name="ADRESS" required value="">
				</div>

				<div class="input1">
					<p>Giới tính :</p>
					<select name="gender" id="">
								echo '<option value="MALE" selected>Nam</option>';
								echo '<option value="FEMAL">Nữ</option>';
					</select>
				</div>


				<div class="input1">
					<p>Quyền truy cập :</p>
					<select name="quyen" id="">
						<?php
						$sql_phanquyen = mysqli_query($mysqli, 'select* FROM permission ');
						while ($row_quyen = mysqli_fetch_array($sql_phanquyen)) {
						?>
								<option  value="<?php echo $row_quyen['IDPE'] ?>">
									<?php echo $row_quyen['Name'] ?>
								</option>
							
						<?PHP }?>
					</select>
				</div>
			
	</div>
	<div class="input2">
		<input type="submit" name="themnhanvien" value="Thêm tài khoản">
	</div>
	</form>
</div>
</div>