
<?php 
	require '../../backoffice/condb.php';
	$sqlc = "DELETE FROM `regis_sub` WHERE user_id = '".@$_SESSION['user_id']."'";
    $queryc = mysqli_query($con,$sqlc);
    if ($queryc) {
		echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
	}else{
		echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
	}
	
	header("Refresh:0; ../cal_sub.php");
?>