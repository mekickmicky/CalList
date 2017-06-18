
<?php 
	require 'condb.php';
	$sub_id = $_GET['sub_id'];
	$sqlc = "DELETE FROM `subject` WHERE sub_id = '$sub_id'";
    $queryc = mysqli_query($con,$sqlc);
	$sqlt = "DELETE FROM `table_subject` WHERE sub_id = '$sub_id'";
    $queryt = mysqli_query($con,$sqlt);
    if ($queryc && $queryt) {
		echo "<script type='text/javascript'>alert('เรียบร้อย')</script>";
	}else{
		echo "<script type='text/javascript'>alert('ล้มเหลว')</script>";
	}
	
	header("Refresh:0; index.php");
?>