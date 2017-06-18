
<?php 
	require 'condb.php';
		$sub_id_subject = $_POST['sub_id_subject'];
		$mySql = "SELECT * FROM subject WHERE sub_id_subject = '$sub_id_subject'";
		$objQuery = mysqli_query($con,$mySql);
		if(mysqli_num_rows($objQuery)>0) {
			echo '<span class="error">รหัสวิชานี้มีลงทะเบียนในระบบแล้ว</span>';
			exit;
		}
		else{
		     echo '<span class="success"></span>';
		}
	
?>