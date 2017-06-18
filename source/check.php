
<?php 
	require '../backoffice/condb.php';
	if (isset($_POST['email'])) {
		$user_email = $_POST['email'];
		$mySql = "SELECT * FROM user WHERE user_email = '$user_email' ";
		$objQuery = mysqli_query($con,$mySql);
		$objResult = mysqli_fetch_array($objQuery);
		if($objResult) {
			echo '<p class="error">อีเมลนี้มีอยู่ในระบบแล้ว</p>';
			exit;
		}
		else{
		     echo '<p class="success">สามารถใช้อีเมลนี้ได้</p>';
		}
	}if (isset($_POST['id_student'])) {
		$id_student = $_POST['id_student'];
		$mySql = "SELECT * FROM user WHERE user_id_student = '$id_student' ";
		$objQuery = mysqli_query($con,$mySql);
		$objResult = mysqli_fetch_array($objQuery);
		if($objResult) {
			echo '<p class="error">รหัสนักศึกษานี้มีอยู่ในระบบแล้ว</p>';
			exit;
		}
		else if ( preg_match("/^[0-9]{8}+$/", $id_student)) {
		     echo '<p class="success">สามารถใช้รหัสนักศึกษานี้ได้</p>';
		}
		else{
			echo '<p class="error">สามารถใช้ตัวเลข 8 หลักได้เท่านั้น</p>';
		}
	}
?>