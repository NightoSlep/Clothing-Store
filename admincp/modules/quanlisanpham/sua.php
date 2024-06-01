<?php
$sql_sua_sp = "SELECT * FROM product WHERE IDPR='$_GET[IDPR]' LIMIT 1";
$query_sua_sp = mysqli_query($mysqli, $sql_sua_sp);
?>
<?php
while ($row = mysqli_fetch_array($query_sua_sp)) {
?>
	<div class="form">
		<div class="form-title">Sửa Sản Phẩm </div>
		<form method="POST" action="modules/quanlisanpham/xuli.php?IDPR=<?php echo $row['IDPR'] ?>" enctype="multipart/form-data">
			<div class="form-content">
				<div class="form-left">
					<div class="input1 input5">
						<p>Tên Sản phẩm</p>
						<input type="text" name="NAME" value="<?php echo $row['NAME'] ?>">
					</div>
					<div class="input1 input5">
						<p>Mã Sản phẩm</p>
						<input type="text" name="IDPR" value="<?php echo $row['IDPR'] ?>" disabled>
					</div>

					<div class="input1 input5">
						<p>Giá Sản phẩm</p>
						<input type="text" name="COST" value="<?php echo $row['COST'] ?>">
					</div>

					<div class="input1 input5">
						<p>Số Lượng</p>
						<input type="text" name="Totalquanity" value="<?php echo $row['Totalquanity'] ?>" disabled>
					</div>

					<div class="input1 input5">
						<p>Điểm Rate</p>
						<input type="text" name="RATINGPOINT" value="<?php echo $row['RATINGPOINT'] ?>" disabled>
					</div>

					<div class="input1 input5">

						<p>Loại Sản Phẩm</p>
						<div class="custom-select" style="width:200px;">
							<select name="IDCA">
								<?php
								$sql_brand = "SELECT * FROM categories ORDER BY IDCA DESC";
								$query_brand = mysqli_query($mysqli, $sql_brand);
								while ($row_brand = mysqli_fetch_array($query_brand)) {
									if ($row_brand['IDCA'] == $row['IDCA']) {
										echo "<option value='$row_brand[IDCA]' selected>$row_brand[NAME]</option>";
									} else {
										echo "<option value='<?php echo $row_brand[IDCA] ?>'> $row_brand[NAME]</option>";
									}
								}
								?>
							</select>
						</div>
					</div>

					<div class="input1 input3 input5">
						<p>Hình ảnh sản phẩm</p>
						<input type="file" name="IMAGES[]" multiple />
						<?php
						// Tách chuỗi IMAGES thành mảng các tên file ảnh
						$image_names = explode(',', $row['IMAGES']);

						// Lặp qua mảng và hiển thị mỗi tên file ảnh trong một thẻ <img>
						foreach ($image_names as $image_name) {
							echo '<img src="modules/quanlisanpham/uploads/' . $image_name . '" alt="" class="img_sp">';
						}
						?>
					</div>
					<div class="clear"></div>


					<div class="input1 input5">
						<p>Tình trạng</p>
						<div class="custom-select" style="width:200px;">
							<select name="STATUS">
								<?php
								if ($row['STATUS'] == 1) {
								?>
									<option value="1" selected>Kích hoạt</option>
									<option value="0">Ẩn</option>
								<?php
								} else {
								?>
									<option value="1">Kích hoạt</option>
									<option value="0" selected>Ẩn</option>
								<?php
								}
								?>

							</select>
						</div>

					</div>

					<div class="clear"></div>
					<div class="input2 input5-2">
						<input type="submit" name="suasanpham" value=" Sửa Sản Phẩm">
					</div>
				</div>


				<div class="form-right">
					<div class="input1 input6">
						<p>Mô tả</p>
						<textarea rows="10" name="Description" style="resize: none"><?php echo $row['Description'] ?></textarea>
					</div>


				</div>
				<div class="clear"></div>
			</div>
		</form>
	<?php
}
	?>
	</div>