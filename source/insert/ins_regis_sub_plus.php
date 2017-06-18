<script src="../../js/pace.js"></script>
<?php 
	require '../../backoffice/condb.php';
	$check_regis = 0;


	$sql = "SELECT * FROM subject INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE sub_id_subject = '".$_POST['sub_id_subject']."'";
	$query = mysqli_query($con,$sql);
	$result = mysqli_fetch_assoc($query);
	$sub_id = $result['sub_id'];
	$sub_day = $result['sub_day'];
	if (mysqli_num_rows($query)<1) {
		$check_regis = 1;
	}

	$sqls = "SELECT * FROM `sub_student` WHERE user_id = '".@$_SESSION['user_id']."' and sub_id = '".$result['sub_id']."' and ss_grade > '1'";
	$querys = mysqli_query($con,$sqls);
	if (mysqli_num_rows($querys)>0) {
		$check_regis = 2;
	}

	$sql_check_time = "SELECT * FROM regis_sub INNER JOIN subject ON regis_sub.sub_id = subject.sub_id INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE subject.sub_day = '$sub_day' and regis_sub.user_id = '".@$_SESSION['user_id']."'";
	$query_check_time = mysqli_query($con,$sql_check_time);
	while ($result_check_time = mysqli_fetch_array($query_check_time)) {
		for ($i=1; $i <=16 ; $i++) {
			if($result['ts_'.$i]==1 && $result['ts_'.$i]==$result_check_time['ts_'.$i]){
				$check_regis = 3;
			}
		}
	}

	if($result['sub_com_sub_id']!=""){
		$sqlsss = "SELECT sub_id FROM `subject` WHERE sub_id_subject = '".$result['sub_com_sub_id']."'";
		$querysss = mysqli_query($con,$sqlsss);
		$resultsss = mysqli_fetch_assoc($querysss);

		$sqlc = "SELECT * FROM sub_student where sub_id = '".$resultsss['sub_id']."' and user_id = '".@$_SESSION['user_id']."'";
		$queryc = mysqli_query($con,$sqlc);
		if (mysqli_num_rows($queryc)<1) {
			$check_regis = 4;
		}
	}



	if ($check_regis==0) {
		$sql = "INSERT INTO `regis_sub`( `user_id`, `sub_id`) VALUES ('".@$_SESSION['user_id']."','$sub_id')";
		$query = mysqli_query($con,$sql);
		if ($query) {
	  		echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
		}else{
	  		echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
		}
	}else if($check_regis==1){
	  	echo "<script type='text/javascript'>alert('ไม่มีวิชานี้ในระบบ')</script>";
	}else if($check_regis==2){
	  	echo "<script type='text/javascript'>alert('วิชานี้ไม่สามารถลงทะเบียนได้อีก')</script>";
	}else if($check_regis==3){
	  	echo "<script type='text/javascript'>alert('วิชาที่ลงทะเบียนซ้อนเวลา')</script>";
	}else if($check_regis==4){
			echo "<script type='text/javascript'>alert('ไม่สามารถลงทะเบียนวิชานี้ได้ เนื่องจากยังไม่ผ่านวิชาเรียน โปรดตรวจสอบ')</script>";
	}
	header("Refresh:0; ../cal_sub.php");
?>