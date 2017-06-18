<?php 
	require '../backoffice/condb.php';
	$resultu['sub_name']="";
	if(@$_SESSION['user_name']==""){
		header("Refresh:0; ../index.php");
	}
	$acMenu = 1;
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>CalList</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="../images/cal-favicon.ico" sizes="16x16">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php 
		require 'nav.php';
	?>
	<div class="wrap_main">
		<div class="wrap_add_sub">
			<div class="wrap_box_add_sub">
				<form action="add_sub.php" method="POST">
					<input placeholder="รหัสวิชา" pattern="[0-9]+" maxlength="6" type="text" name="sub_id_subject">
					<button>ค้นหารหัสวิชา</button>
				</form>
					<br>
				<form action="insert/ins_subject.php" method="POST">
				<?php 
					if(isset($_POST['sub_id_subject'])){
						$sqlu = "SELECT sub_name,sub_id FROM subject where sub_id_subject = '".$_POST['sub_id_subject']."'";
						$queryu = mysqli_query($con,$sqlu);
						$resultu = mysqli_fetch_assoc($queryu);
						?>
						<label>รายชื่อวิชา : 
						<?php 
							if ($resultu['sub_name']!="") {
								echo $resultu['sub_name'];
							}else{
								echo "ไม่พบวิชาเรียน";
							}
						?>
						</label>
						<input type="hidden" name="sub_id" value="<?=$resultu['sub_id']?>" required>
						<?php
					}else{
						?>
						<label>รายชื่อวิชา : </label>
						<?php
					}
				?>
					<div class="wrap_box_add_grade">
					<label>เกรดที่ได้: </label>
						<select name="ss_grade" required>
							<option value="">เลือก</option>
							<option value="4">A</option>
							<option value="3.5">B+</option>
							<option value="3">B</option>
							<option value="2.5">C+</option>
							<option value="2">C</option>
							<option value="1.5">D+</option>
							<option value="1">D</option>
							<option value="0">F</option>
						</select>
					</div>
					<br>
					<br>
					<br>
					<?php 
					if ($resultu['sub_name']!="") {
					?>
					<button style="width: 100%;">ยืนยัน</button>
					<?php
					}
					?>
				</form>
			</div>
			<div class="wrap_sub_comp">
				<table>
					<tr>
						<th width="150">รหัสวิชา</th>
						<th width="610">ชื่อวิชา</th>
						<th width="90" class="displayN">หน่วยกิต</th>
						<th width="70">เกรด</th>
						<th width="80"></th>
					</tr>
				</table>
				<div class="wrap_sub_data">
					<table>
					<?php 
						$sqlta = "SELECT * FROM sub_student where user_id = '".@$_SESSION['user_id']."'";
						$queryta = mysqli_query($con,$sqlta);
						while ($resultta = mysqli_fetch_array($queryta)) {
							$sqlsub = "SELECT * FROM subject where sub_id = '".$resultta['sub_id']."' ";
							$querysub = mysqli_query($con,$sqlsub);
							$resultsub = mysqli_fetch_assoc($querysub);
					?>
						<tr>
							<td width="120"><?=$resultsub['sub_id_subject']?></td>
							<td width="500" style="text-align: left;"><?=$resultsub['sub_name']?></td>
							<td width="70" class="displayN"><?=$resultsub['sub_credit']?></td>
							<td width="80">
								<?php
								switch ($resultta['ss_grade']) {
									case '4':
										echo "A";
										break;
									case '3.5':
										echo "B+";
										break;
									case '3':
										echo "B";
										break;
									case '2.5':
										echo "C+";
										break;
									case '2.0':
										echo "C";
										break;
									case '1.5':
										echo "D+";
										break;
									case '1':
										echo "D";
										break;
									case '0':
										echo "F";
										break;
									
									default:
										echo "N/A";
										break;
								}
							?>	
							</td>
							<td width="40">
								<a href="delete/del_sub_student.php?ss_id=<?=$resultta['ss_id']?>">
									<img class="icon_delete" src="../images/icon-delete.png">
								</a>
							</td>
						</tr>
					<?php 
						} 
						?>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

