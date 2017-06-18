<?php 
	require '../backoffice/condb.php';
	if(@$_SESSION['user_name']==""){
		header("Refresh:0; ../index.php");
	}
	if (isset($_GET['sub_day']) && isset($_GET['sub_year']) && isset($_GET['sub_term'])) {
		$sub_day = $_GET['sub_day'];
		$sub_year = $_GET['sub_year'];
		$sub_term = $_GET['sub_term'];
	}else{
		$sub_day = 1;
		$sub_year = date("Y");
		$sub_term = 1;
	}
	$acMenu = 3;
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
		<div class="wrap_list">
			<div class="wrap_list_select_day">
				<form action="list_sub.php">
					<label>เลือกวัน: </label>
					<select id="subDay" name="sub_day" onchange="selectDay()">
						<option>เลือก</option>
						<option value="1">จันทร์</option>
						<option value="2">อังคาร</option>
						<option value="3">พุธ</option>
						<option value="4">พฤหัสบดี</option>
						<option value="5">ศุกร์</option>
						<option value="6">เสาร์</option>
						<option value="7">อาทิตย์</option>
					</select>
					<label>เลือกปีการศึกษา: </label>
					<select id="subYear" name="sub_year" onchange="selectDay()">
						<option>เลือก</option>
						<option value="2017">2560</option>
					</select>
					<label>ภาคการศึกษา: </label>
					<select id="subTerm" name="sub_term" onchange="selectDay()">
						<option>เลือก</option>
						<option value="1">1</option>
						<option value="2">2</option>
					</select>
					<button id="BtnSelectDay" style="display: none;"></button>
				</form>
				<br>
				<form action="list_sub.php" method="post">
					<label>ค้นหารหัสวิชา : </label><input pattern="[0-9]+" maxlength="6" type="" name="sub_id_subject" required="">
					<button class="btn_cal_sub">ค้นหา</button>
				</form>
			</div>
			<br>
			<p class="title_list">ตารางเรียนในปีการศึกษา <?=$sub_year+543?> ภาคการศึกษา <?=$sub_term?> วัน : 
			<?php 
			if (isset($_POST['sub_id_subject'])) {
				$sql = "SELECT * FROM subject where sub_id_subject = '".$_POST['sub_id_subject']."'";
				$query = mysqli_query($con,$sql);
				$result = mysqli_fetch_assoc($query);
				$sub_day = $result['sub_day'];
			}
			switch ($sub_day) {
				case '1':
					echo "จันทร์";
					break;
				case '2':
					echo "อังคาร";
					break;
				case '3':
					echo "พุธ";
					break;
				case '4':
					echo "พฤหัสบดี";
					break;
				case '5':
					echo "ศุกร์";
					break;
				case '6':
					echo "เสาร์";
					break;
				case '7':
					echo "อาทิตย์";
					break;
				default:
					break;
			} ?></p>
			<div class="wrap_ta_list">
				<div class="wrap_ta_list_wrap">
					<table cellspacing="0" cellpadding="0">
						<thead>
							<tr>
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
						<?php 
							$box = 1;
							$colup = 0;
							if (isset($_POST['sub_id_subject'])) {
								$sql = "SELECT * FROM subject where sub_id_subject = '".$_POST['sub_id_subject']."'";
							}else{
								$sql = "SELECT * FROM subject where sub_day = '$sub_day' and sub_year = '$sub_year' and sub_term = '$sub_term'";
							}
							$querysub = mysqli_query($con,$sql);
							$count_rowh = mysqli_num_rows($querysub);
							while ($resultsub = mysqli_fetch_array($querysub)) {

								$getHr[0] = 0;
								$getHr[1] = 0;
								$getHr[2] = 0;
								$contHr = 0;

								$chekbox[1] = 0;
								$chekbox[2] = 0;
								$chekbox[3] = 0;
								$count_check = 1;
								$insbox = 1;
								?>

								<tr>	

								<?php
								$querysubta = mysqli_query($con,"SELECT * FROM table_subject where sub_id = '".$resultsub['sub_id']."'");
								$resultsubta = mysqli_fetch_assoc($querysubta);
								for ($i = 1; $i <= 16 ; $i++) {
									if ($resultsubta['ts_'.$i] == 1) {
										if($chekbox[$count_check] == 0){
											$chekbox[$count_check] = $i;
										}
										$getHr[$contHr] += 1;
									}else if($resultsubta['ts_'.$i] == 0 && $chekbox[$count_check]!=0){
										$count_check++;
										$contHr += 1;
									}
								}
								if($getHr[0] == 1){
									$wid_d[1] = 60;
									$setPoleft[1] = "0";
								}if($getHr[0] == 2){
									$wid_d[1] = 100;
									$setPoleft[1] = "13";
								}if($getHr[0] == 3){
									$wid_d[1] = 100;
									$setPoleft[1] = "48";
								}if($getHr[0] == 4){
									$wid_d[1] = 100;
									$setPoleft[1] = "80";
								}if($getHr[0] == 5){
									$wid_d[1] = 100;
									$setPoleft[1] = "100";
								}if($getHr[1] == 1){
									$wid_d[2] = 60;
									$setPoleft[2] = "0";
								}if($getHr[1] == 2){
									$wid_d[2] = 100;
									$setPoleft[2] = "13";
								}if($getHr[1] == 3){
									$wid_d[2] = 100;
									$setPoleft[2] = "48";
								}if($getHr[1] == 4){
									$wid_d[2] = 100;
									$setPoleft[2] = "80";
								}if($getHr[1] == 5){
									$wid_d[2] = 100;
									$setPoleft[2] = "100";
								}


								while ($box <= 16) {

									if($box==1){
										if (1 == $resultsubta['ts_'.$box]) {
											?>
												<td id="col_<?=$box?>" style="background: #02937e;" class="col_data">
												<?php
													if ($chekbox[1] == $box) {
														echo "<a href='?detail_sub_id=".$resultsub['sub_id']."&sub_day=".$resultsub['sub_day']."&sub_year=".$resultsub['sub_year']."&sub_term=".$resultsub['sub_term']."#list_detail_sub'><span style='left: ".$setPoleft[$insbox]."px'><div style='width:0px;'><div style='width:".$wid_d[$insbox]."px;position:relative;'>".$resultsub['sub_id_subject']."<br>".$resultsub['sub_room']."</div></div></span></a>";
														$insbox++;
													}
												?>
												</td>
											<?php
										}else{
											?>
												<td id="col_<?=$box?>" class="col_data"></td>
											<?php
										}
									}else if($box==16){
										if (1 == $resultsubta['ts_'.$box]) {
											?>
												<td id="col_<?=$box?>" style="background: #02937e;border-radius: 0 0 0 13px;" class="col_data">
													<?php
													if ($chekbox[16] == $box) {
														echo "<a href='?detail_sub_id=".$resultsub['sub_id']."&sub_day=".$resultsub['sub_day']."&sub_year=".$resultsub['sub_year']."&sub_term=".$resultsub['sub_term']."#list_detail_sub'><span style='left: ".$setPoleft[$insbox]."px'><div style='width:0px;'><div style='width:".$wid_d[$insbox]."px;position:relative;'>".$resultsub['sub_id_subject']."<br>".$resultsub['sub_room']."</div></div></span></a>";
														$insbox++;
													}
												?>
												</td>
											<?php
										}else{
											?>
												<td id="col_<?=$box?>"  class="col_data"></td>
											<?php
										}
									}

									else{
										if (1 == $resultsubta['ts_'.$box]) {
											?>
												<td id="col_<?=$box?>" style="background: #02937e;" class="col_data">
													<?php
													if ($chekbox[$insbox] == $box) {
														echo "<a href='?detail_sub_id=".$resultsub['sub_id']."&sub_day=".$resultsub['sub_day']."&sub_year=".$resultsub['sub_year']."&sub_term=".$resultsub['sub_term']."#list_detail_sub'><span style='left: ".$setPoleft[$insbox]."px'><div style='width:0px;'><div style='width:".$wid_d[$insbox]."px;position:relative;'>".$resultsub['sub_id_subject']."<br>".$resultsub['sub_room']."</div></div></span></a>";
														$insbox++;
													}
												?>
												</td>
											<?php
										}else{
											?>
												<td id="col_<?=$box?>" class="col_data"></td>
											<?php
										}
									}
									$box++;
								}	
								$box = 1;
								?>
								</tr>		
								<?php
							}
							while(8>$colup+$count_rowh){
							?>
								<tr>
									<?php for ($i=0; $i < 16; $i++) {
										?>
										<td id="col_<?=$box?>" class="col_data"><div class="col_emp"></div></td>
										<?php
									} ?>
								</tr>
							<?php
								$colup++;
							}
							?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div id="list_detail_sub" class="overlay light">
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
							<a href="insert/ins_regis_sub_list.php?sub_id=<?=$result['sub_id']?>&sub_day=<?=$sub_day?>&sub_year=<?=$sub_year?>&sub_term=<?=$sub_term?>"><div class="btn_cal_sub">ลงทะเบียนวิชานี้</div></a>
						</div>
						<?php 
						}
						?>
					</div>
				</div>
	        </div>
        </div>
    </div>
</body>
</html>
<script type="text/javascript">
	function selectDay() {
		var subDay = document.getElementById("subDay").value;
		var subYear = document.getElementById("subYear").value;
		var subTerm = document.getElementById("subTerm").value;
		if (subDay!=="เลือก" && subYear!=="เลือก"&& subTerm!=="เลือก"){
			document.getElementById("BtnSelectDay").click();
		}
	}
</script>

