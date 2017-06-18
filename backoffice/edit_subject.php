
<?php 
	require 'condb.php';

	$checkAr = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
	$sub_id = $_GET['sub_id'];
	$count = 0;
	
	$name_column = array("sub_name","sub_credit","sub_level","sub_teacher_name","sub_teacher_surname","sub_group","sub_room","sub_term","sub_day","sub_importance","sub_difficulty","sub_id_subject","sub_com_sub_id");
	$sql = "UPDATE `subject` SET ";
	for ($i=0; $i <= 12 ; $i++) { 
		if (isset($_POST[$name_column[$i]])&&$_POST[$name_column[$i]]!="") {
			$sql .= "$name_column[$i] = '".$_POST[$name_column[$i]]."',";
		}
	}
	$strlen = strlen($sql);
	$sql = substr($sql,0,$strlen-1);
	$sql .= " where sub_id = '$sub_id'";

	//echo $sql;
	$query = mysqli_query($con,$sql);

	$checkTa = false;
	for ($i=0; $i <=16 ; $i++) { 
		if (isset($_POST['ts_'.$i])) {
			$checkTa = true;
		}
	}
	$query_e = true;
	if ($checkTa) {
		$query_de = mysqli_query($con,"DELETE FROM `table_subject` WHERE sub_id = '$sub_id'");
		for ($i=1; $i < 17 ; $i++) { 
			if(isset($_POST['ts_'.$i])){
				$ts[$i] = 1;
			}else{
				$ts[$i] = 0;
			}
		}
		$sql_e = "INSERT INTO `table_subject`(`ts_1`, `ts_2`, `ts_3`, `ts_4`, `ts_5`, `ts_6`, `ts_7`, `ts_8`, `ts_9`, `ts_10`, `ts_11`, `ts_12`, `ts_13`, `ts_14`, `ts_15`, `ts_16`, `sub_id`) VALUES ('$ts[1]','$ts[2]','$ts[3]','$ts[4]','$ts[5]','$ts[6]','$ts[7]','$ts[8]','$ts[9]','$ts[10]','$ts[11]','$ts[12]','$ts[13]','$ts[14]','$ts[15]','$ts[16]','$sub_id')";
		$query_e = mysqli_query($con,$sql_e);
		//echo $sql_e;
	}
	if ($query && $query_e) {
		echo "<script type='text/javascript'>alert('แก้ไขเรียบร้อย')</script>";
	}else{
		echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
	}
	header("Refresh:0; index.php");
?>