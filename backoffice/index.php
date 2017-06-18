<?php
	require 'condb.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Back Office</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<script src="../js/pace.js"></script>
	<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
</head>
<body>
	<div class="wrap_main" style="width: 90%;margin-bottom: 40px;">
		<div class="wrap_func">
			<form action="index.php" method="post">
				<label>ค้นหารหัสวิชา : </label>
				<input type="" pattern="[0-9]+" maxlength="6" name="sub_search" placeholder="รหัสวิชา,กลุ่มวิชาเรียน">
				<label>สาขาวิชา : </label>
		        <select name="sub_branch">
		           	<option value=""> สาขาที่เรียน </option>
		           	<option value="0"> ทุกสาขา </option>
		           	<option value="1"> สาขาธุรกิจ </option>
		           	<option value="5"> สาขาออกแบบ </option>
		           	<option value="2"> ออกแบบอินเมชั่น </option>
		           	<option value="3"> ออกแบบเกม </option>
		           	<option value="4"> ออกแบบเว็บและสื่อโต้ตอบ </option>
		           	<option value="9"> ทั้งหมด </option>
		        </select>
				<button>ค้นหา</button>
			</form>
		</div>
		<div class="wrap_sub_b">
		<a href="#add_sub">เพิ่มรายวิชา</a>
			<table>
				<tr>
					<th width="100">ID</th>
					<th width="100">รหัสวิชา</th>
					<th width="500">ชื่อวิชา</th>
					<th width="80">หน่วยกิต</th>
					<th width="100">กลุ่ม</th>
					<th width="150">ห้องเรียน</th>
					<th width="80">ความสำคัญ</th>
					<th width="80">ระดับความยาก</th>
					<th width="250">สาขา</th>
					<th width="80">วัน</th>
				</tr>
				<?php 
					if (isset($_POST['sub_search']) || isset($_POST['sub_branch'])) {
						$sub_search = $_POST['sub_search'];
						$sub_branch = $_POST['sub_branch'];
						$sqlss = "SELECT * FROM subject where sub_id_subject = '$sub_search' or sub_group = '$sub_search' or sub_branch = '$sub_branch'";
						if($_POST['sub_branch']==9){
							$sqlss = "SELECT * FROM subject";
						}
					}else{
						$sqlss = "SELECT * FROM subject";
					}
					$queryss = mysqli_query($con,$sqlss);
					while ($resultss = mysqli_fetch_array($queryss)) {
				?>

				<tr>
					<td><?=$resultss['sub_id']?></td>
					<td><?=$resultss['sub_id_subject']?></td>
					<td><?=$resultss['sub_name']?></td>
					<td><?=$resultss['sub_credit']?></td>
					<td><?=$resultss['sub_group']?></td>
					<td><?=$resultss['sub_room']?></td>
					<td><?=$resultss['sub_importance']?></td>
					<td><?=$resultss['sub_difficulty']?></td>
					<td><?php 
						switch ($resultss['sub_branch']) {
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
					</td>
					<td><?php 
						switch ($resultss['sub_day']) {
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
								echo "ยังไม่ระบุ";
								break;
						}
						 ?>
					</td>
					<td><a href="#edit_sub<?=$resultss['sub_id']?>">แก้ไข</a></td>
					<td><a href="del_subject.php?sub_id=<?=$resultss['sub_id']?>">ลบ</a></td>
				</tr>

				<?php
					}
				?>
			</table>
		</div>
	</div>
	<div id="add_sub" class="overlay light">
		<a class="cancel" href="#"></a>
        <div class="popup" style="margin: 8% auto 0;">
	        <div style="width: 1000px;margin: 0 auto;height: 500px">
        		<a style="position: relative;left: 1000px;text-decoration: none;color: #000;cursor: pointer;" class="cancel" href="#">X</a>
	            <h2>เพิ่มรายวิชา</h2>
	            <form action="ins_subject.php" method="POST">
	            	<div class="wrap_add_sub_1">
	            		<input type="text" placeholder="ชื่อวิชา" name="sub_name" required><br>
		            	<input type="number" min="1" max="9" maxlength="1" placeholder="หน่วยกิต" name="sub_credit" required><br>
			            <select name="sub_level" required>
			            	<option> ระดับชั้นปี </option>
			            	<option value="1"> 1 </option>
			            	<option value="2"> 2 </option>
			            	<option value="3"> 3 </option>
			            	<option value="4"> 4 </option>
			            </select><br>
			            <label>ชื่อ - นามสกุลอาจารย์ประจำวิชา</label><br>
		            	<input style="width: 130px;margin: 5px 2.5px" type="text" placeholder="ชื่อ" name="sub_teacher_name" required>
		            	<input style="width: 130px;margin: 5px 2.5px" type="text" placeholder="นามสกุล" name="sub_teacher_surname" required><br>
		            	<input type="text" placeholder="กลุ่มวิชาเรียน" name="sub_group" required><br>
			            <input type="text" placeholder="ห้องเรียน" name="sub_room" required>
	            	</div>
	            	<div class="wrap_add_sub_2">
	            		<select name="sub_term" required placeholder="เทอม">
			            	<option value=""> เทอม </option>
			            	<option value="1"> 1 </option>
			            	<option value="2"> 2 </option>
			            </select><br>
			            <select name="sub_branch" required>
			            	<option value=""> วิชาสาขา </option>
			            	<option value="0"> ทุกสาขา </option>
			            	<option value="1"> สาขาธุรกิจ </option>
			            	<option value="5"> วิชาบังคับสาขาออกแบบ </option>
			            	<option value="2"> ออกแบบอินเมชั่น </option>
			            	<option value="3"> ออกแบบเกม </option>
			            	<option value="4"> ออกแบบเว็บและสื่อโต้ตอบ </option>
			            </select><br>
			            <input maxlength="6" pattern="[0-9]+" placeholder="รหัสวิชา" type="text" onchange="checkIdSub(this.value)" name="sub_id_subject" required><br>
			            <span id="ans_ids" class="error"></span>
			            <input type="number" min="0" max="100" placeholder="ระดับความสำคัญ" name="sub_importance" required><br>
						<input type="number" min="0" max="100" placeholder="ระดับความยาก" name="sub_difficulty" required><br>
			            <select name="sub_day" required>
			            	<option> วันที่เรียน </option>
			            	<option value="1"> จันทร์ </option>
			            	<option value="2"> อังคาร </option>
			            	<option value="3"> พุธ </option>
			            	<option value="4"> พฤหัสบดี </option>
			            	<option value="5"> ศุกร์ </option>
			            	<option value="6"> เสาร์ </option>
			            	<option value="7"> อาทิตย์ </option>
			            </select>
			            <input maxlength="6" pattern="[0-9]+" placeholder="รหัสวิชาที่จำเป็นต้องผ่าน" type="text" name="sub_com_sub_id">
			            <font style="font-size: 10px;color: red;">*ถ้าไม่มีไม่ต้องใส่</font>
	            	</div>
	            	
		            <h2>เลือกเวลาเรียน</h2>
			        <font style="font-size: 10px;color: red;">*เลือกเวลาโดยการคลิกที่เวลานั้นได้เลย</font>
		            <div class="wrap_add_ta_list">
						<table cellspacing="0" cellpadding="0">
							<thead>
								<tr>
									<td><label for="ts_1s"><div onclick="check_box_id(1)" id="b1" class="box_check"><span>07:35&nbsp; - </span></div></label></td>
									<td><label for="ts_2s"><div onclick="check_box_id(2)" id="b2" class="box_check"><span>08:25 &nbsp; - </span></div></label></td>
									<td><label for="ts_3s"><div onclick="check_box_id(3)" id="b3" class="box_check"><span>09:25 &nbsp; - </span></div></label></td>
									<td><label for="ts_4s"><div onclick="check_box_id(4)" id="b4" class="box_check"><span>10:20 &nbsp; - </span></div></label></td>
									<td><label for="ts_5s"><div onclick="check_box_id(5)" id="b5" class="box_check"><span>11:15 &nbsp; - </span></div></label></td>
									<td><label for="ts_6s"><div onclick="check_box_id(6)" id="b6" class="box_check"><span>12:05&nbsp; -</span></div></label></td>
									<td><label for="ts_7s"><div onclick="check_box_id(7)" id="b7" class="box_check"><span>13:00&nbsp; -</span></div></label></td>
									<td><label for="ts_8s"><div onclick="check_box_id(8)" id="b8" class="box_check"><span>13:55&nbsp; -</span></div></label></td>
									<td><label for="ts_9s"><div onclick="check_box_id(9)" id="b9" class="box_check"><span>14:50&nbsp; -</span></div></label></td>
									<td><label for="ts_10s"><div onclick="check_box_id(10)" id="b10" class="box_check"><span>15:45&nbsp; -</span></div></label></td>
									<td><label for="ts_11s"><div onclick="check_box_id(11)" id="b11" class="box_check"><span>16:40&nbsp; -</span></div></label></td>
									<td><label for="ts_12s"><div onclick="check_box_id(12)" id="b12" class="box_check"><span>17:35&nbsp; -</span></div></label></td>
									<td><label for="ts_13s"><div onclick="check_box_id(13)" id="b13" class="box_check"><span>18:30&nbsp; -</span></div></label></td>
									<td><label for="ts_14s"><div onclick="check_box_id(14)" id="b14" class="box_check"><span>19:25&nbsp; -</span></div></label></td>
									<td><label for="ts_15s"><div onclick="check_box_id(15)" id="b15" class="box_check"><span>20:20&nbsp; -</span></div></label></td>
									<td><label for="ts_16s"><div onclick="check_box_id(16)" id="b16" class="box_check"><span style="left: 0;">21:15</span></div></label></td>
								</tr>
							</thead>
						</table>
					</div>
					<div style="display: none;">
					<input id="ts_1s" type="checkbox" name="ts_1" value="1">
					<input id="ts_2s" type="checkbox" name="ts_2" value="1">
					<input id="ts_3s" type="checkbox" name="ts_3" value="1">
					<input id="ts_4s" type="checkbox" name="ts_4" value="1">
					<input id="ts_5s" type="checkbox" name="ts_5" value="1">
					<input id="ts_6s" type="checkbox" name="ts_6" value="1">
					<input id="ts_7s" type="checkbox" name="ts_7" value="1">
					<input id="ts_8s" type="checkbox" name="ts_8" value="1">
					<input id="ts_9s" type="checkbox" name="ts_9" value="1">
					<input id="ts_10s" type="checkbox" name="ts_10" value="1">
					<input id="ts_11s" type="checkbox" name="ts_11" value="1">
					<input id="ts_12s" type="checkbox" name="ts_12" value="1">
					<input id="ts_13s" type="checkbox" name="ts_13" value="1">
					<input id="ts_14s" type="checkbox" name="ts_14" value="1">
					<input id="ts_15s" type="checkbox" name="ts_15" value="1">
					<input id="ts_16s" type="checkbox" name="ts_16" value="1">
					</div>

		            <button id="btn_sub_ins">เพิ่มรายวิชา</button>
	            </form>
	        </div>
        </div>
    </div>
    <?php 
    if (isset($_POST['sub_search']) || isset($_POST['sub_branch'])) {
						$sub_search = $_POST['sub_search'];
						$sub_branch = $_POST['sub_branch'];
						$sqlss = "SELECT * FROM subject where sub_id_subject = '$sub_search' or sub_group = '$sub_search' or sub_branch = '$sub_branch'";
						if($_POST['sub_branch']==9){
							$sqlss = "SELECT * FROM subject";
						}
					}else{
						$sqlss = "SELECT * FROM subject";
					}
					$queryss = mysqli_query($con,$sqlss);
					while ($resultss = mysqli_fetch_array($queryss)) {
    ?>
    <div id="edit_sub<?=$resultss['sub_id']?>" class="edit_sub overlay light">
		<a class="cancel" href="#"></a>
        <div class="popup" style="margin: 8% auto 0;">
	        <div style="width: 1000px;margin: 0 auto;height: 500px">
        		<a style="position: relative;left: 1000px;text-decoration: none;color: #000;cursor: pointer;" class="cancel" href="#">X</a>
	            <h2>แก้ไขรายวิชา</h2>
	            <form action="edit_subject.php?sub_id=<?=$resultss['sub_id']?>" method="POST">
	            	<div class="wrap_add_sub_1">
	            		<input type="text" placeholder="ชื่อวิชา" name="sub_name" value="<?=$resultss['sub_name']?>"><br>
		            	<input type="number" min="1" max="9" maxlength="1" placeholder="หน่วยกิต" name="sub_credit" value="<?=$resultss['sub_credit']?>"><br>
			            <select name="sub_level">
			            	<option value=""> ระดับชั้นปี </option>
			            	<option value="1"> 1 </option>
			            	<option value="2"> 2 </option>
			            	<option value="3"> 3 </option>
			            	<option value="4"> 4 </option>
			            </select><br>
			            <label>ชื่อ - นามสกุลอาจารย์ประจำวิชา</label><br>
		            	<input style="width: 130px;margin: 5px 2.5px" type="text" placeholder="ชื่อ" name="sub_teacher_name"  value="<?=$resultss['sub_teacher_name']?>">
		            	<input style="width: 130px;margin: 5px 2.5px" type="text" placeholder="นามสกุล" name="sub_teacher_surname" value="<?=$resultss['sub_teacher_surname']?>"><br>
		            	<input type="text" placeholder="กลุ่มวิชาเรียน" name="sub_group" value="<?=$resultss['sub_group']?>"><br>
			            <input type="text" placeholder="ห้องเรียน" name="sub_room" value="<?=$resultss['sub_room']?>">
	            	</div>
	            	<div class="wrap_add_sub_2">
	            		<select name="sub_term" placeholder="เทอม">
			            	<option value=""> เทอม </option>
			            	<option value="1"> 1 </option>
			            	<option value="2"> 2 </option>
			            </select><br>
			            <select name="sub_branch">
			            	<option value=""> วิชาสาขา </option>
			            	<option value="0"> ทุกสาขา </option>
			            	<option value="1"> สาขาธุรกิจ </option>
			            	<option value="5"> วิชาบังคับสาขาออกแบบ </option>
			            	<option value="2"> ออกแบบอินเมชั่น </option>
			            	<option value="3"> ออกแบบเกม </option>
			            	<option value="4"> ออกแบบเว็บและสื่อโต้ตอบ </option>
			            </select><br>
			            <input maxlength="6" pattern="[0-9]+" placeholder="รหัสวิชา" type="text" onchange="checkIdSub(this.value)" name="sub_id_subject" value="<?=$resultss['sub_id_subject']?>"><br>
			            <span id="ans_ids" class="error"></span>
			            <input type="number" min="0" max="100" placeholder="ระดับความสำคัญ" name="sub_importance" value="<?=$resultss['sub_importance']?>"><br>
						<input type="number" min="0" max="100" placeholder="ระดับความยาก" name="sub_difficulty" value="<?=$resultss['sub_difficulty']?>"><br>
			            <select name="sub_day">
			            	<option value=""> วันที่เรียน </option>
			            	<option value="1"> จันทร์ </option>
			            	<option value="2"> อังคาร </option>
			            	<option value="3"> พุธ </option>
			            	<option value="4"> พฤหัสบดี </option>
			            	<option value="5"> ศุกร์ </option>
			            	<option value="6"> เสาร์ </option>
			            	<option value="7"> อาทิตย์ </option>
			            </select>
			            <input maxlength="6" pattern="[0-9]+" placeholder="รหัสวิชาที่จำเป็นต้องผ่าน" type="text" name="sub_com_sub_id" value="<?=$resultss['sub_com_sub_id']?>">
			            <font style="font-size: 10px;color: red;">*ถ้าไม่มีไม่ต้องใส่</font>
	            	</div>
	            	
		            <h2>แก้ไขเวลาเรียน</h2>
			        <font style="font-size: 10px;color: red;">*ถ้าไม่ต้องการเปลี่ยนไม่ต้องเลือก</font>
		            <div class="wrap_add_ta_list">
						<table cellspacing="0" cellpadding="0">
							<thead>
								<tr>
									<td><label for="ts_1s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(1)" id="b1_<?=$resultss['sub_id']?>" class="box_check"><span>07:35&nbsp; - </span></div></label></td>
									<td><label for="ts_2s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(2)" id="b2_<?=$resultss['sub_id']?>" class="box_check"><span>08:25 &nbsp; - </span></div></label></td>
									<td><label for="ts_3s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(3)" id="b3_<?=$resultss['sub_id']?>" class="box_check"><span>09:25 &nbsp; - </span></div></label></td>
									<td><label for="ts_4s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(4)" id="b4_<?=$resultss['sub_id']?>" class="box_check"><span>10:20 &nbsp; - </span></div></label></td>
									<td><label for="ts_5s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(5)" id="b5_<?=$resultss['sub_id']?>" class="box_check"><span>11:15 &nbsp; - </span></div></label></td>
									<td><label for="ts_6s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(6)" id="b6_<?=$resultss['sub_id']?>" class="box_check"><span>12:05&nbsp; -</span></div></label></td>
									<td><label for="ts_7s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(7)" id="b7_<?=$resultss['sub_id']?>" class="box_check"><span>13:00&nbsp; -</span></div></label></td>
									<td><label for="ts_8s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(8)" id="b8_<?=$resultss['sub_id']?>" class="box_check"><span>13:55&nbsp; -</span></div></label></td>
									<td><label for="ts_9s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(9)" id="b9_<?=$resultss['sub_id']?>" class="box_check"><span>14:50&nbsp; -</span></div></label></td>
									<td><label for="ts_10s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(10)" id="b10_<?=$resultss['sub_id']?>" class="box_check"><span>15:45&nbsp; -</span></div></label></td>
									<td><label for="ts_11s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(11)" id="b11_<?=$resultss['sub_id']?>" class="box_check"><span>16:40&nbsp; -</span></div></label></td>
									<td><label for="ts_12s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(12)" id="b12_<?=$resultss['sub_id']?>" class="box_check"><span>17:35&nbsp; -</span></div></label></td>
									<td><label for="ts_13s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(13)" id="b13_<?=$resultss['sub_id']?>" class="box_check"><span>18:30&nbsp; -</span></div></label></td>
									<td><label for="ts_14s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(14)" id="b14_<?=$resultss['sub_id']?>" class="box_check"><span>19:25&nbsp; -</span></div></label></td>
									<td><label for="ts_15s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(15)" id="b15_<?=$resultss['sub_id']?>" class="box_check"><span>20:20&nbsp; -</span></div></label></td>
									<td><label for="ts_16s_<?=$resultss['sub_id']?>"><div onclick="check_box_id_<?=$resultss['sub_id']?>(16)" id="b16_<?=$resultss['sub_id']?>" class="box_check"><span style="left: 0;">21:15</span></div></label></td>
								</tr>
							</thead>
						</table>
					</div>
					<div style="display: none;">
					<input id="ts_1s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_1" value="1">
					<input id="ts_2s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_2" value="1">
					<input id="ts_3s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_3" value="1">
					<input id="ts_4s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_4" value="1">
					<input id="ts_5s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_5" value="1">
					<input id="ts_6s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_6" value="1">
					<input id="ts_7s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_7" value="1">
					<input id="ts_8s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_8" value="1">
					<input id="ts_9s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_9" value="1">
					<input id="ts_10s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_10" value="1">
					<input id="ts_11s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_11" value="1">
					<input id="ts_12s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_12" value="1">
					<input id="ts_13s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_13" value="1">
					<input id="ts_14s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_14" value="1">
					<input id="ts_15s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_15" value="1">
					<input id="ts_16s_<?=$resultss['sub_id']?>" type="checkbox" name="ts_16" value="1">
					</div>

		            <button id="btn_sub_ins">แก้ไขข้อมูล</button>
	            </form>
	        </div>
        </div>
    </div>
    <script type="text/javascript">
    	function check_box_id_<?=$resultss['sub_id']?>(va) {
			if (document.getElementById('ts_'+va+'s_'+<?=$resultss['sub_id']?>).checked == false) {
		        document.getElementById('b'+va+"_"+<?=$resultss['sub_id']?>).style.background = "#2b9e8d";
		    }else if(document.getElementById('ts_'+va+'s_'+<?=$resultss['sub_id']?>).checked){
		        document.getElementById('b'+va+"_"+<?=$resultss['sub_id']?>).style.background = "#006D5F";
		    }
		}
    </script>
    <?php 
	}
     ?>
</body>
</html>

 <script type="text/javascript">

function checkIdSub(sub_id_subject){
	$.post("check_sub_id.php", {sub_id_subject: sub_id_subject}, function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {	
				  $('#ans_ids').html(data);
			   }
          });
}
function check_box_id(va) {
	if (document.getElementById('ts_'+va+'s').checked == false) {
        document.getElementById('b'+va).style.background = "#2b9e8d";
    }else if(document.getElementById('ts_'+va+'s').checked){
        document.getElementById('b'+va).style.background = "#006D5F";
    }
}

</script>