<?php 
	require '../backoffice/condb.php';
	if(@$_SESSION['user_name']==""){
		header("Refresh:0; ../index.php");
	}
	$term = 1;
	$level = 1;
	if (isset($_POST['term']) && isset($_POST['level'])) {
		$level = $_POST['level'];
		$term = $_POST['term'];
	}
	$acMenu =2;
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
		<div class="wrap_cal">
			<div class="wrap_select_data_cal">
				<form action="insert/ins_regis_sub.php" method="post">
					<label>ระดับชั้นปี: </label>
					<select id="se_level" name="level" required>
						<option value="">เลือก</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
					</select>
					<label>ภาคการศึกษาที่: </label>
					<select id="se_term" name="term" required>
						<option value="">เลือก</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					<button>คำนวณ</button>
				</form>
			</div>
			<br><br>
			<p class="title_list">ตารางเรียนในปีการศึกษา <?php echo date("Y")+543; ?> ภาคการศึกษา <?php echo $term; ?></p>
			<div class="wrap_ta_cal">
				<div class="wrap_ta_cal_wrap">
					<table cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th style="font-size: 14px;background: #adadad;color: #000;">วัน/เวลา</th>
								<th><span>07:35&nbsp;&nbsp; -</span></th>
								<th><span>08:25&nbsp;&nbsp; -</span></th>
								<th><span>09:25&nbsp;&nbsp; -</span></th>
								<th><span>10:20&nbsp;&nbsp; -</span></th>
								<th><span>11:15&nbsp;&nbsp; -</span></th>
								<th style="background: #02937e;"><span>12:05&nbsp;&nbsp; -</span></th>
								<th><span>13:00&nbsp;&nbsp; -</span></th>
								<th><span>13:55&nbsp;&nbsp; -</span></th>
								<th><span>14:50&nbsp;&nbsp; -</span></th>
								<th><span>15:45&nbsp;&nbsp; -</span></th>
								<th><span>16:40&nbsp;&nbsp; -</span></th>
								<th><span>17:35&nbsp;&nbsp; -</span></th>
								<th><span>18:30&nbsp;&nbsp; -</span></th>
								<th><span>19:25&nbsp;&nbsp; -</span></th>
								<th><span>20:20&nbsp;&nbsp; -</span></th>
								<th><span style="left: 0;">21:15</span></th>
							</tr>
						</thead>
						<tr>
							<td class="col_day">จันทร์</td>
							<?php 
								$sub_day = 1;
								require 'link_sub.php';
							 ?>
						</tr>
						<tr>
							<td class="col_day">อังคาร</td>
							<?php 
								$sub_day = 2;
								require 'link_sub.php';
							 ?>
						</tr>
						<tr>
							<td class="col_day">พุธ</td>
							<?php 
								$sub_day = 3;
								require 'link_sub.php';
							 ?>
						</tr>
						<tr>
							<td class="col_day">พฤหัสบดี</td>
							<?php 
								$sub_day = 4;
								require 'link_sub.php';
							 ?>
						</tr>
						<tr>
							<td class="col_day">ศุกร์</td>
							<?php 
								$sub_day = 5;
								require 'link_sub.php';
							 ?>
						</tr>
						<tr>
							<td style="background: #af2323;" class="col_day">เสาร์</td>
							<?php 
								$sub_day = 6;
								require 'link_sub.php';
							 ?>
						</tr>
						<tr>
							<td style="background: #af2323;border-radius: 0 0 0 10px;" class="col_day">อาทิตย์</td>
							<?php 
								$sub_day = 7;
								require 'link_sub.php';
							 ?>
						</tr>
					</table>
				</div>
			</div>
			<div class="wrap_ins_sub">
				<form action="insert/ins_regis_sub_plus.php" method="post">
					<label>ลงทะเบียนเพิ่ม รหัสวิชา : </label><input name="sub_id_subject" pattern="[0-9]+" maxlength="6" required><button class="btn_cal_sub">ตกลง</button>
				</form>
				<a href="delete/del_regis_sub.php"><div class="btn_cal_sub" style="background: #444;">ล้างตาราง</div></a>
				<a href="#detail_subject"><div class="btn_cal_sub">ลายละเอียด</div></a>
			</div>
		</div>
	</div>
	<div id="detail_sub" class="overlay light">
        <a class="cancel" href="#"></a>
        <div class="popup">
	        <div class="wrap_pop">
	            <div class="wrap_list_detail_sub">
					<div class="wrap_list_data_sub_data">
						<h2>รายละเอียดวิชา</h2>
						<?php 
						if (isset($_GET['detail_sub_id'])) {
							$query = mysqli_query($con,"SELECT * FROM `subject` WHERE sub_id = '".$_GET['detail_sub_id']."'");
							$result = mysqli_fetch_assoc($query);
						?>
						<div class="wrap_list_data_sub_data_div">
							<p>ชื่อวิชา : <?=$result['sub_name']?></p>
							<p>รหัสวิชา : <?=$result['sub_id_subject']?></p>
							<p>กลุ่มวิชาเรียน : <?=$result['sub_group']?></p>
							<p>ผู้สอน : <?=$result['sub_teacher_name']?> <?=$result['sub_teacher_surname']?></p>
							<p>สาขา : 
						<?php 
						switch ($result['sub_branch']) {
							case '0':
								echo "ทุกสาขา";
								break;
							case '1':
								echo "สาขาธุรกิจ";
								break;
							case '2':
								echo "ออกแบบอินเมชั่น";
								break;
							case '3':
								echo "ออกแบบเกม";
								break;
							case '4':
								echo "ออกแบบเว็บและสื่อโต้ตอบ";
								break;
							case '5':
								echo "สาขาออกแบบ";
								break;
							
							default:
								echo "ยังไม่ระบุ";
								break;
						}
						 ?>
							</p>
						</div>
						<div class="wrap_list_data_sub_data_div">
							<p>เรียน : <?=$result['sub_room']?></p>
							<p>ชั้นปีที่ : <?=$result['sub_level']?></p>
							<p>จำนวนหน่วยกิต : <?=$result['sub_credit']?> หน่วยกิต</p>
							<p>สอบ : 
							<?php 
							if ($result['sub_test']==0) {
								echo "n/a";
							}else{
								echo $result['sub_test'];
							}
							?>
							</p>
						</div>
						<?php 
						}
						?>
					</div>
				</div>
	        </div>
        </div>
    </div>
    <div id="detail_subject" class="overlay light">
        <a class="cancel" href="#"></a>
        <div class="popup" style="margin: 9% auto 0;">
	        <div class="wrap_pop">
	            <div class="wrap_cal_detail_sub">
	            	<?php 
	            		$allcredit = 0;
	            		$levelc = 0;
						$sql = "SELECT * FROM regis_sub INNER JOIN subject ON regis_sub.sub_id = subject.sub_id WHERE regis_sub.user_id = '".@$_SESSION['user_id']."'";
						$query = mysqli_query($con,$sql);
						while ($result = mysqli_fetch_array($query)) {
							$allcredit += $result['sub_credit'];
							if ($result['sub_level'] > $levelc) {
								$levelc = $result['sub_level'];
							}
						}
						$count_sub = mysqli_num_rows($query);
	            	?>
	            	<h2>รายละเอียดการลงทะเบียน</h2>
	            	<p>ลงทะเบียนในระดับชั้นปีที่ : <?=$levelc?></p>
	            	<p>จำนวนหน่วยกิต : <?=$allcredit?> หน่วยกิต</p>
	            	<p>จำนวนวิชา : <?=$count_sub?> วิชา</p>
	            	<p></p>
	            	<div class="wrap_cal_detail_sub_wrap_over">
	            		<div class="wrap_cal_detail_sub_wrap">
	            			<table>
			            		<tr>
			            			<th width="100">รหัสวิชา</th>
			            			<th width="500">ชื่อรายวิชา</th>
			            			<th width="100">กลุ่ม</th>
			            			<th width="300">ตารางสอบ</th>
			            			<th width="50"></th>
			            		</tr>
			            	</table>
							<div class="wrap_list_data_sub_data">
								<table>
									<?php 
									$query = mysqli_query($con,$sql);
									while ($result = mysqli_fetch_array($query)) {
									?>
				            		<tr>
				            			<td width="100"><?=$result['sub_id_subject']?></td>
				            			<td width="500" style="text-align: left;"><?=$result['sub_name']?></td>
				            			<td width="100"><?=$result['sub_group']?></td>
			            				<?php 
			            					if ($result['sub_test']==0) {
			            						?>
			            						<td width="300">n/a</td>
			            						<?php
			            					}else{
			            						?>
			            						<td width="300" style="text-align: left;"><?=$result['sub_test']?></td>
			            						<?php
			            					}
			            				?>
				            			<td width="50"><a href="delete/del_regis_sub_sub.php?sub_id=<?=$result['sub_id']?>"><img class="icon_delete" src="../images/icon-delete.png"></a></td>
				            		</tr>
				            		<?php 
				            		}
				            		?>
			            		</table>
							</div>
	            		</div>
	            	</div>
				</div>
	        </div>
        </div>
    </div>
</body>
</html>

