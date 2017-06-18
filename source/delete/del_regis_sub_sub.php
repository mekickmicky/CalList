
<?php 
	require '../../backoffice/condb.php';
	$sub_id = $_GET['sub_id'];
	$sqlc = "DELETE FROM `regis_sub` WHERE sub_id = '$sub_id' and user_id = '".@$_SESSION['user_id']."'";
    $queryc = mysqli_query($con,$sqlc);
    if ($queryc) {
		echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
	}else{
		echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
	}
	
	header("Refresh:0; ../cal_sub.php");
?>