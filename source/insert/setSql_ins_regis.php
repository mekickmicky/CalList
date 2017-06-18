<?php 
	switch (@$_SESSION['user_branch']) {
		case '1':
			$canRegis = "subject.sub_branch = '1' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'";
			break;
		case '2':
			$canRegis = "subject.sub_branch = '2' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'  or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'  or subject.sub_branch = '5' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'";
			break;
		case '3':
			$canRegis = "subject.sub_branch = '3' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'  or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'  or subject.sub_branch = '5' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'";
			break;
		case '4':
			$canRegis = "subject.sub_branch = '4' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'  or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'  or subject.sub_branch = '5' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day'";
			break;
		default:
			break;
	}
	if ($creditFull>0) {
		if ($creditFull==1) {
			$setScore = 50;
		}else if($creditFull==2){
			$setScore = 55;
		}else if($creditFull==3){
			$setScore = 60;
		}else if($creditFull==4){
			$setScore = 65;
		}else if($creditFull==5){
			$setScore = 70;
		}else if($creditFull==6){
			$setScore = 75;
		}else if($creditFull==7){
			$setScore = 80;
		}

		switch (@$_SESSION['user_branch']) {
			case '1':
				$canRegis = "subject.sub_branch = '1' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore";
				break;
			case '2':
				$canRegis = "subject.sub_branch = '2' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore or subject.sub_branch = '5' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore";
				break;
			case '3':
				$canRegis = "subject.sub_branch = '3' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore or subject.sub_branch = '5' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore";
				break;
			case '4':
				$canRegis = "subject.sub_branch = '4' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore or subject.sub_branch = '0' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore or subject.sub_branch = '5' and subject.sub_term = '".$_POST['term']."' and subject.sub_level <= '".$_POST['level']."' and subject.sub_day = '$day' and subject.sub_importance >=$setScore";
				break;
			default:
				break;
		}
	}
?>