<?php 
	require 'backoffice/condb.php';
	if(@$_SESSION['user_name']!=""){
		header("Refresh:0; source/profile.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>CalList</title>
	<meta charset="utf-8">
	<link rel="icon" type="image/png" href="images/cal-favicon.ico" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
</head>
<body class="boIndex">
	<div class="fr_wrap_img">
		<div class="">
			<img src="images/logo.png">
		</div>
	</div>
	<div class="fr_wrap_log">
		<div class="wrap_logo">
			<img src="images/logo-res.png">
		</div>
		<div class="wrap_log">
			<form method="POST" action="index.php">
				<input type="text" name="username" placeholder="อีเมล หรือ รหัสนักศึกษา" required><br><br>
				<input type="password" placeholder="รหัสผ่าน" title="ต้องมี 8 ตัวอักษรขึ้นไป" name="password"  style="margin-bottom: 10px;" required>
				<br><br>
				<button class="btn_log">เข้าสู่ระบบ</button>
				<a href="#register">
					<div class="btn_regis">
						สมัครสมาชิก
					</div>
				</a>
			</form>
		</div>
	</div>
	<div id="register" class="overlay light">
        <a class="cancel" href="#"></a>
        <div class="popup">
	        <div class="wrap_pop">
	            <h2>สมัครสมาชิก</h2>
	            <form action="source/insert/ins_user.php" method="POST">
	            	<input type="text" placeholder="ชือ" name="user_name" required>
		            <input type="text" placeholder="นามสกุล" name="user_surname" required>
		            <input type="email" placeholder="อีเมล" name="user_email" onblur="checkEmail(this.value)" required>
		            <span id="ans_e"></span>
		            <input maxlength="8" pattern="[0-9]+" placeholder="รหัสนักศึกษา" type="text" onblur="checkIdStudent(this.value)" name="user_id_student" required>
		            <span id="ans_s"></span>
		            <select name="user_branch" required>
		            	<option> สาขาที่เรียน </option>
		            	<option value="1"> สาขาธุรกิจ </option>
		            	<option value="2"> ออกแบบอินเมชั่น </option>
		            	<option value="3"> ออกแบบเกม </option>
		            	<option value="4"> ออกแบบเว็บและสื่อโต้ตอบ </option>
		            </select>
		            <input id="us_p1" type="password" minlength="8" title="ต้องมี 8 ตัวอักษรขึ้นไป" onblur="checkConfirmPassword()" placeholder="รหัสผ่าน" name="user_password" required>
		            <input id="us_p2" type="password" onblur="checkConfirmPassword()" placeholder="รหัสผ่านอีกครั้ง" name="user_password" required>
		            <span id="ans_p" class="error"></span>
		            <button>สมัครสมาชิก</button>
	            </form>
	        </div>
        </div>
    </div>
</body>
</html>
<?php 
if (isset($_POST['username'])) {
	$sql = "SELECT * FROM user where user_email ='".$_POST['username']."' or user_id_student = '".$_POST['username']."' and user_password = '".$_POST['password']."'";
	//echo $sql;
  	$query = mysqli_query($con,$sql);
  	$result = mysqli_fetch_assoc($query);
	if(mysqli_num_rows($query)>0){
	  	$_SESSION['user_id'] = $result['user_id'];
	  	$_SESSION['user_name'] = $result['user_name'];
	  	$_SESSION['user_surname'] = $result['user_surname'];
	  	$_SESSION['user_email'] = $result['user_email'];
	  	$_SESSION['user_id_student'] = $result['user_id_student'];
	  	$_SESSION['user_branch'] = $result['user_branch'];
	  	echo "<script type='text/javascript'>alert('เข้าสู่ระบบ')</script>";
	}else{
	  	echo "<script type='text/javascript'>alert('อีเมล รหัสนักศึกษา หรือ รหัสผ่านผิดพลาด')</script>";
	}
	header("Refresh:0; index.php");
}
 ?>

 <script type="text/javascript">

function checkEmail(email){
	if (email!="") {
		$.post("source/check.php", {email: email}, function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {	
				  $('#ans_e').html(data);
			   }
          });
	}
}
function checkIdStudent(id_student){
	$.post("source/check.php", {id_student: id_student}, function(data)
		{			
			   if (data != '' || data != undefined || data != null) 
			   {	
				  $('#ans_s').html(data);
			   }
          });
}
function checkConfirmPassword()
{	
	if(document.getElementById("us_p1").value!="" && document.getElementById("us_p2").value!=""){
	var password1 = document.getElementById("us_p1").value;
	var password2 = document.getElementById("us_p2").value;
		if (password1 == password2) {
			$('#ans_p').html("");
		}else{
			$('#ans_p').html("รหัสผ่านไม่ตรงกัน");	
		}
	}
}

</script>