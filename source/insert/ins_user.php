
<?php 
	require '../../backoffice/condb.php';
	$user_name = $_POST['user_name'];
	$user_surname = $_POST['user_surname'];
	$user_email = $_POST['user_email'];
	$user_id_student = $_POST['user_id_student'];
	$user_password = $_POST['user_password'];
	$user_branch = $_POST['user_branch'];

	$sqlc = "SELECT * FROM user where user_email ='$user_email' or user_id_student = '$user_id_student'";
    $queryc = mysqli_query($con,$sqlc);
    if (mysqli_num_rows($queryc)>0) {
    	echo "<script type='text/javascript'>alert('มีรหัสนักศึกษา หรือ อีเมลในระบบแล้ว')</script>";
    }else{
    	$query = "INSERT INTO user(user_name,user_surname,user_email,user_id_student,user_password,user_branch,user_img) VALUES('$user_name','$user_surname','$user_email','$user_id_student','$user_password','$user_branch','0')";
		  	echo $query;
		  	mysqli_query($con,$query);
		if ($query) {
			echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
		}else{
			echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
		}
    }
	
	header("Refresh:0; ../../index.php");
?>