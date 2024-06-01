
	<div class="form">
		<div class="form-title">Thêm Sản Phẩm </div>
		<form method="POST" action="modules/quanlisanpham/xuli.php" enctype="multipart/form-data">
			<div class="form-content">
				<div class="form-left">
					<div class="input1 input5">
						<p>Tên Sản phẩm</p>
						<input type="text" name="NAME" value="">
					</div>
					<div class="input1 input5">
						<p>Mã Sản phẩm</p>
						<input type="text" name="IDPR" value="" disabled>
					</div>

					<div class="input1 input5">
						<p>Giá Sản phẩm</p>
						<input type="text" name="COST" value="">
					</div>

					<div class="input1 input5">
						<p>Số Lượng</p>
						<input type="text" name="Totalquanity" value="0" disabled>
					</div>

					<div class="input1 input5">
						<p>Điểm Rate</p>
						<input type="text" name="RATINGPOINT" value="0" disabled>
					</div>

					<div class="input1 input5">

						<p>Loại Sản Phẩm</p>
						<div class="custom-select" style="width:200px;">
							<select name="IDCA">
								<?php
								$sql_brand = "SELECT * FROM categories ORDER BY IDCA DESC";
								$query_brand = mysqli_query($mysqli, $sql_brand);
								while ($row_brand = mysqli_fetch_array($query_brand)) {

										echo "<option value='$row_brand[IDCA]'> $row_brand[NAME]</option>";
									
								}
								?>
							</select>
						</div>
					</div>

					<div class="input1 input3 input5">
						<p>Hình ảnh sản phẩm</p>
						<input type="file" name="IMAGES[]" multiple />
						
					</div>
					<div class="clear"></div>


					<div class="input1 input5">
						<p>Tình trạng</p>
						<div class="custom-select" style="width:200px;">
							<select name="STATUS">
									<option value="1" selected>Kích hoạt</option>
									<option value="0">Ẩn</option>
								

							</select>
						</div>

					</div>

					<div class="clear"></div>
					<div class="input2 input5-2">
						<input type="submit" name="themsanpham" value=" Thêm Sản Phẩm">
					</div>
				</div>


				<div class="form-right">
					<div class="input1 input6">
						<p>Mô tả</p>
						<textarea rows="10" name="Description" style="resize: none"></textarea>
					</div>


				</div>
				<div class="clear"></div>
			</div>
		</form>

	</div>