
<?php 
	require '../../backoffice/condb.php';
	$ss_id = $_GET['ss_id'];
	$sqlc = "DELETE FROM `sub_student` WHERE ss_id = '$ss_id'";
    $queryc = mysqli_query($con,$sqlc);
    if ($queryc) {
		echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
	}else{
		echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
	}
	
	header("Refresh:0; ../add_sub.php");
?>