
<?php 
	require 'condb.php';
	$sub_name = $_POST['sub_name'];
	$sub_credit = $_POST['sub_credit'];
	$sub_level = $_POST['sub_level'];
	$sub_teacher_name = $_POST['sub_teacher_name'];
	$sub_teacher_surname = $_POST['sub_teacher_surname'];
	$sub_group = $_POST['sub_group'];
	$sub_room = $_POST['sub_room'];
	$sub_term = $_POST['sub_term'];
	$sub_day = $_POST['sub_day'];
	$sub_importance = $_POST['sub_importance'];
	$sub_difficulty = $_POST['sub_difficulty'];
	$sub_branch = $_POST['sub_branch'];
	$sub_id_subject = $_POST['sub_id_subject'];
	$sub_com_sub_id =  0;
	if (isset($_POST['sub_com_sub_id'])) {
		$sub_com_sub_id = $_POST['sub_com_sub_id'];
	}
	$sub_year = date("Y");

	for ($i=1; $i < 17 ; $i++) { 
		if(isset($_POST['ts_'.$i])){
			$ts[$i] = 1;
		}else{
			$ts[$i] = 0;
		}
	}
	$mySql = "SELECT * FROM subject WHERE sub_id_subject = '$sub_id_subject'";
	$objQuery = mysqli_query($con,$mySql);
	$reusult = mysqli_fetch_assoc($objQuery);

	if(mysqli_num_rows($objQuery)>0 && $reusult['sub_group']==$sub_group) {
		echo "<script type='text/javascript'>alert('กลุ่มวิชานี้มีลงทะเบียนในระบบแล้ว')</script>";
	}else{
		$mySql = "INSERT INTO subject(`sub_name`, `sub_credit`, `sub_level`, `sub_teacher_name`, `sub_group`, `sub_room`, `sub_term`, `sub_importance`, `sub_teacher_surname`, `sub_branch`, `sub_id_subject`, `sub_difficulty`, `sub_day`,`sub_test`,`sub_year`,`sub_com_sub_id`) VALUES ('$sub_name', '$sub_credit', '$sub_level', '$sub_teacher_name', '$sub_group', '$sub_room', '$sub_term', '$sub_importance', '$sub_teacher_surname', '$sub_branch', '$sub_id_subject', '$sub_difficulty', '$sub_day','0','$sub_year','$sub_com_sub_id')";
		$objQuerys = mysqli_query($con,$mySql);

		$mySql = "SELECT sub_id FROM `subject` WHERE sub_id_subject = '$sub_id_subject'";
		$objQuery = mysqli_query($con,$mySql);
		$reusult = mysqli_fetch_assoc($objQuery);
		$sub_id = $reusult['sub_id'];

		$mySqlt = "INSERT INTO `table_subject`(`ts_1`, `ts_2`, `ts_3`, `ts_4`, `ts_5`, `ts_6`, `ts_7`, `ts_8`, `ts_9`, `ts_10`, `ts_11`, `ts_12`, `ts_13`, `ts_14`, `ts_15`, `ts_16`, `sub_id`) VALUES ('$ts[1]','$ts[2]','$ts[3]','$ts[4]','$ts[5]','$ts[6]','$ts[7]','$ts[8]','$ts[9]','$ts[10]','$ts[11]','$ts[12]','$ts[13]','$ts[14]','$ts[15]','$ts[16]','$sub_id')";
		$objQueryt = mysqli_query($con,$mySqlt);
		if ($objQueryt && $objQuerys) {
		echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
		}else{
		echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
		}
	}
	header("Refresh:0; index.php");
?>