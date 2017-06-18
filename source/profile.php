<?php 
	require '../backoffice/condb.php';
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
	<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
</head>
<body>
	<?php 
		require 'nav.php';
	?>
	<div class="wrap_main">
		<div class="wrap_profile">
			<div class="wrap_data_profile">
				<div class="wrap_img">
					<?php 
					$sqlu = "SELECT user_img FROM user where user_id = '".@$_SESSION['user_id']."'";
					$queryu = mysqli_query($con,$sqlu);
					$resultu = mysqli_fetch_assoc($queryu);
					if($resultu['user_img']=="0"){
						?>
						<img src="../images/img-none.png">
						<?php
					}else{
						?>
						<img src="../images/<?=$resultu['user_img']?>">
						<?php
					}
				 ?>
				 <form method="post" action="edit_img.php"  enctype="multipart/form-data" style="position:absolute;">
                          <label for="edit_img">
                          <div class="edit_img_st">
                             แก้ไขรูป
                          </div>
                          </label>
                          <input id="edit_img" type="file" name="fileToUpload" id="fileToUpload" onchange="EditImg()" class="btn_edit_img" style="display:none;" required>
                          
                          <button style="display:none;" id="subimg" type="submit" name="submit"></button>
                 </form>
				</div>
				
				<div class="box_data_profile">
					<p>ชื่อผู้ใช้งาน : <?=@$_SESSION['user_name']?> <?=@$_SESSION['user_surname']?></p><br>
					<p>สาขาวิชาที่เรียน : 
					<?php 
					switch (@$_SESSION['user_branch']) {
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
						
						default:
							echo "ยังไม่ระบุ";
							break;
					}
					 ?>
					</p><br>
					<?php 
						$sql = "SELECT * FROM sub_student where user_id ='".@$_SESSION['user_id']."'";
					  	$query = mysqli_query($con,$sql);
					  	
					  	$gpx = 0;
					  	$grade = 0;
					  	$credit = 0;
					  	if (mysqli_num_rows($query)>0) {
					  		while ($result = mysqli_fetch_array($query)) {
					  			$sqlj = "SELECT sub_credit FROM subject where sub_id ='".$result['sub_id']."'";
					  			$queryj = mysqli_query($con,$sqlj);
								$resultj = mysqli_fetch_assoc($queryj);
								$credit += $resultj['sub_credit'];
					  			$grade += $result['ss_grade']*$resultj['sub_credit'];
						  	}
						  	$gpx = $grade/$credit;
						  	$gpx = number_format($gpx, 2, '.', '');
					  	}
					 ?>
					<p>เกรดเฉลี่ย : <?=$gpx?></p><br>
					<a href="add_sub.php" class="btn_add_sub">
						<div>+ วิชาที่เรียน</div>
					</a>
				</div>
			</div>
		</div>
		<div class="wrap_data_sub">
			<div class="wrap_data_wrap">
				<table>
					<tr>
						<th id="title_func" style="color: #fff;background: #006D5F;padding: 5px 0;" colspan="5">วิชาที่สำเร็จ</th>
					</tr>
					<tr>
						<th width="100">รหัสวิชา</th>
						<th width="540">ชื่อวิชา</th>
						<th width="80">หน่วยกิต</th>
						<th width="80">เกรด</th>
					</tr>
				</table>
				<div class="wrap_ta_data">
					<table>
						<?php 
							$sqlss = "SELECT * FROM sub_student where user_id ='".@$_SESSION['user_id']."'";
							$queryss = mysqli_query($con,$sqlss);
							if (mysqli_num_rows($queryss)>0) {
								while ($result = mysqli_fetch_array($queryss)) {
									$sqlSub = "SELECT * FROM subject where sub_id ='".$result['sub_id']."'";
									$querySub = mysqli_query($con,$sqlSub);
									$resultSub = mysqli_fetch_assoc($querySub);
						?>
						<tbody>
							<tr>
								<td width="100"><?=$resultSub['sub_id_subject']?></td>
								<td width="540"><?=$resultSub['sub_name']?></td>
								<td width="80"><?=$resultSub['sub_credit']?></td>
								<td width="80">
								<?php
									switch ($result['ss_grade']) {
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
							</tr>
						</tbody>
						<?php 
							  	}
							}
						 ?>
					</table>
				</div>	
			</div>
		</div>
	</div>
</body>
</html>
<script type="text/javascript">
// 	function SelectFunc(num) {
// 		if(num==1){
// 			document.getElementById("title_func").innerHTML = "วิชาที่สำเร็จ";
// 		}else if(num==2){
// 			document.getElementById("title_func").innerHTML = "วิชารอศึกษา";
// 		}
// 	}
	function EditImg() {
		var inputImg = document.getElementById("edit_img").value;
		  if (inputImg && inputImg.value!="") {
		    document.getElementById("subimg").click();
		  }
	}
</script>