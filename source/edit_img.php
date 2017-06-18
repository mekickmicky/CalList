<meta charset="utf-8">
<?php
require '../backoffice/condb.php';

if (isset($_FILES["fileToUpload"])) {
$target_dir = "../images/profile_img/";
$target_file = $target_dir."img_profile_id_".@$_SESSION['user_id'].".jpg";
$uploadOk = 1;


//$imageFileType = pathinfo($target_dir.basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION);



//echo getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 6000000) {
    echo "<script type=\"text/javascript\">alert('มีขนาดไฟล์ใหญ่เกินไป โปรใช้ไฟลรูปไม่เกิน 6mb') </script>";
    $uploadOk = 0;
}
// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
//     echo "<script type=\"text/javascript\">alert('สามารถใช้ภาพนามสกุล JPG , PNG , JPEG , GIF เท่านั้น') </script>";
//     $uploadOk = 0;
// }

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
        $query = mysqli_query($con,"SELECT user_img FROM user WHERE user_id = '".@$_SESSION['user_id']."'");
        $result = mysqli_fetch_assoc($query);
        if ($result['user_img']!='0') {
            unlink($result['user_img']);
        }
        
    } else {
        echo "<script type=\"text/javascript\">alert('ไฟล์นี้ไม่ใช่รูปภาพ') </script>";
        $uploadOk = 0;
    }
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "<br>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br>";
        $query = mysqli_query($con,"UPDATE user SET user_img ='$target_file' WHERE user_id = '".@$_SESSION['user_id']."'");
        if ($query) {
            echo "<script type=\"text/javascript\">alert('เรียบร้อย') </script>";
        }else{
            echo "<script type=\"text/javascript\">alert('ล้มเหลว') </script>";
        }

    } else {
        //echo "Sorry, there was an error uploading your file.";
        echo "<script type=\"text/javascript\">alert('ล้มเหลว') </script>";
    }
}

header("Refresh:0; profile.php");


}
?>
