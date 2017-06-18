<?php 
	require '../../backoffice/condb.php';
	if (isset($_POST['ss_grade'])) {
		$ss_grade = $_POST['ss_grade'];
		$sub_id = $_POST['sub_id'];
		$queryc = "SELECT * FROM sub_student where sub_id = '$sub_id' and user_id = '".@$_SESSION['user_id']."'";
		$result = mysqli_query($con,$queryc);
		if (mysqli_num_rows($result)>0) {
			$sql = "UPDATE `sub_student` SET `ss_grade`= '$ss_grade' WHERE sub_id = '$sub_id' and user_id = '".@$_SESSION['user_id']."'";
			$query = mysqli_query($con,$sql);
			if ($query) {
				echo "<script type='text/javascript'>alert('แก้ไขเกรด')</script>";
			}else{
				echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
			}
		}else{
			$sql = "INSERT INTO `sub_student`(`sub_id`, `user_id`, `ss_grade`) VALUES ('$sub_id','".@$_SESSION['user_id']."','$ss_grade')";
			 $query =  mysqli_query($con,$sql);
			if ($query) {
				echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
			}else{
				echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
			}
		}
		header("Refresh:0; ../add_sub.php");
	}
?>