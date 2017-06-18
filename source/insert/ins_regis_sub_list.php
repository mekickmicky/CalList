<?php 
	require '../../backoffice/condb.php';

	$check = 0;
	if (isset($_GET['sub_id'])) {
		$sub_id = $_GET['sub_id'];

		$sqls = "SELECT * FROM `sub_student` WHERE user_id = '".@$_SESSION['user_id']."' and sub_id = '$sub_id' and ss_grade > '1'";
		$querys = mysqli_query($con,$sqls);
		if (mysqli_num_rows($querys)>0) {
			$check = 1;
		}

		$sqlss = "SELECT * FROM subject INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE subject.sub_id = '$sub_id'";
		$queryss = mysqli_query($con,$sqlss);
		$resultss = mysqli_fetch_assoc($queryss);


		if ($resultss['sub_com_sub_id']!="") {
			$sqlsss = "SELECT sub_id FROM `subject` WHERE sub_id_subject = '".$resultss['sub_com_sub_id']."'";
			$querysss = mysqli_query($con,$sqlsss);
			$resultsss = mysqli_fetch_assoc($querysss);


			$sqlc = "SELECT * FROM sub_student where sub_id = '".$resultsss['sub_id']."' and user_id = '".@$_SESSION['user_id']."'";
			$queryc = mysqli_query($con,$sqlc);
			if (mysqli_num_rows($queryc)<1) {
				$check = 2;
			}
		}


		$sql_check_time = "SELECT * FROM regis_sub INNER JOIN subject ON regis_sub.sub_id = subject.sub_id INNER JOIN table_subject ON table_subject.sub_id = subject.sub_id WHERE subject.sub_day = '".$resultss['sub_day']."' and regis_sub.user_id = '".@$_SESSION['user_id']."'";
		$query_check_time = mysqli_query($con,$sql_check_time);
		while ($result_check_time = mysqli_fetch_array($query_check_time)) {
			for ($i=1; $i <=16 ; $i++) {
				if($resultss['ts_'.$i]==1 && $resultss['ts_'.$i]==$result_check_time['ts_'.$i]){
					$check = 3;
				}
			}
		}


		if ($check==0) {
			$sql = "INSERT INTO `regis_sub`(`user_id`, `sub_id`) VALUES ('".@$_SESSION['user_id']."','$sub_id')";
			 $query =  mysqli_query($con,$sql);
			if ($query) {
				echo "<script type='text/javascript'>alert('ลงทะเบียนเรียบร้อย')</script>";
			}else{
				echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
			}
		}else if ($check==1) {
			echo "<script type='text/javascript'>alert('ผ่านวิชานี้แล้ว')</script>";
		}else if ($check==2) {
			echo "<script type='text/javascript'>alert('ไม่สามารถลงทะเบียนวิชานี้ได้ เนื่องจากยังไม่ผ่านวิชาเรียน โปรดตรวจสอบ')</script>";
		}else if($check==3){
	  	echo "<script type='text/javascript'>alert('วิชาที่ลงทะเบียนซ้อนเวลา')</script>";
	}

		$sub_day = $_GET['sub_day'];
		$sub_year = $_GET['sub_year'];
		$sub_term = $_GET['sub_term'];
		header("Refresh:0; ../list_sub.php?sub_day=$sub_day&sub_year=$sub_year&sub_term=$sub_term");
	}
?>