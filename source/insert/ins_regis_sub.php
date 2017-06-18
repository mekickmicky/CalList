<script src="../../js/pace.js"></script>
<?php 
	require '../../backoffice/condb.php';
	$sqlcheckRegis = "SELECT sub_id FROM regis_sub WHERE user_id = '".@$_SESSION['user_id']."'";
	$queryCheckRegis = mysqli_query($con,$sqlcheckRegis);
	if (mysqli_num_rows($queryCheckRegis)>0) {
		$qu = mysqli_query($con,"DELETE FROM `regis_sub` WHERE user_id = '".@$_SESSION['user_id']."'");
	}

	$sql = "SELECT * FROM sub_student where user_id ='".@$_SESSION['user_id']."'";
					  	$query = mysqli_query($con,$sql);
					  	$creditcheck = 0;
					  	$gpx = 0;
					  	$grade = 0;
					  	$credit = 0;
					  	$creditFull = 0;
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
					  	switch ($gpx) {
					  		case $gpx>=3:
					  			$canLearn = 100;
					  			break;
					  		case $gpx>=2.5&&$gpx<3:
					  			$canLearn = 95;
					  			break;
					  		case $gpx>=2&&$gpx<2.5:
					  			$canLearn = 80;
					  			break;
					  		case $gpx>=1.5&&$gpx<2:
					  			$canLearn = 75;
					  			break;
					  		case $gpx<1.5:
					  			$canLearn = 65;
					  			break;
					  		
					  		default:
					  			$canLearn = 40;
					  			break;
					  	}
					  	//echo $canLearn." = score <br>";
				
				
				for ($day=1; $day <= 7; $day++) { 
					$num = 0;
					//echo "---------------------------------------------------------------- DAY ".$day."----------------------------------------------------<br>";
					for ($loop = 0; $loop < 10  ; $loop++) {
						require 'setSql_ins_regis.php';
						$canRegis .= " order by subject.sub_importance DESC limit $num,1";
						$check_regis = true;


						$sql = "SELECT * FROM `subject` INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE $canRegis"; // หาวิชาในวัน
						// $sql = "SELECT * FROM `subject` INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE $canRegis and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' order by subject.sub_difficulty,subject.sub_importance DESC limit $num,1"; // หาวิชาในวัน
						//echo $sql."<br><br>";

						$query = mysqli_query($con,$sql);
						$result = mysqli_fetch_assoc($query);

						if ($result['sub_com_sub_id']!="") {
							$sub_com_sub_id = $result['sub_com_sub_id'];
							$sqlcheckPass = "SELECT * FROM `regis_sub` WHERE user_id = '".@$_SESSION['user_id']."' and sub_id = '$sub_com_sub_id'"; 
							$querycheckPass = mysqli_query($con,$sqlcheckPass);
							if(mysqli_num_rows($querycheckPass)<1){
								$check_regis = false;
							}
						}


						$sql_check_time = "SELECT * FROM regis_sub INNER JOIN subject ON regis_sub.sub_id = subject.sub_id INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE subject.sub_day = '$day' and regis_sub.user_id = '".@$_SESSION['user_id']."'"; // เช็คตารางชน
						$query_check_time = mysqli_query($con,$sql_check_time);
						while ($result_check_time = mysqli_fetch_array($query_check_time)) {
							for ($i=1; $i <=16 ; $i++) {
								if($result['ts_'.$i]==1 && $result['ts_'.$i]==$result_check_time['ts_'.$i]){
									//echo "ตารางซ้อน";
									$check_regis = false;
								}
							}
						}


						

						$sqlc = "SELECT * FROM `sub_student` WHERE user_id = '".@$_SESSION['user_id']."' and sub_id = '".$result['sub_id']."' and ss_grade > '0'";
						$queryc = mysqli_query($con,$sqlc);
						$sqla = "SELECT * FROM `regis_sub` WHERE user_id = '".@$_SESSION['user_id']."' and sub_id = '".$result['sub_id']."'"; 
						$querya = mysqli_query($con,$sqla);

						if (mysqli_num_rows($queryc)==0 && mysqli_num_rows($querya)==0 && mysqli_num_rows($query)>0 && $check_regis) {
							$sub_id = $result['sub_id'];
							$sub_importance = $result['sub_importance'];
							$sub_difficulty = $result['sub_difficulty'];
							$sub_credit = $result['sub_credit'];
						}else{
							$check_regis = false;
						}
						
						if ($check_regis) {
							if ($canLearn >= $sub_difficulty) {
								$sqlins = "INSERT INTO `regis_sub`(`user_id`, `sub_id`) VALUES ('".@$_SESSION['user_id']."','$sub_id')";
								mysqli_query($con,$sqlins);
								$creditcheck += $sub_credit;
								//echo $sub_id."----- ok<br><br>";
								$num++;
							}else{
								$num++;
							}
						}else{
								$num++;
						}
						if($creditcheck > 22){
							$sqlc = "DELETE FROM `regis_sub` WHERE user_id = '".@$_SESSION['user_id']."'";
    						$queryc = mysqli_query($con,$sqlc);
    						$loop = 999;
    						$day = 0;
    						$creditcheck = 0;
    						$creditFull++;
						}
						if($creditFull>7){
							$day = 99;
	  						echo "<script type='text/javascript'>alert('มีวิชาที่จำเป็นต้องลงทะเบียนจำนวนมาก โปรดทำรายการใหม่')</script>";
						}
					}
				}
	header("Refresh:0; ../cal_sub.php");
?>