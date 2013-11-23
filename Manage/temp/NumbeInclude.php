<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2012-02-18
*/
session_start();
if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 2){
	header('Location:/Manage/temp/openNumber_cq.php');
} else  if (isset($_SESSION['GameType']) && $_SESSION['GameType'] == 3){
	header('Location:/Manage/temp/openNumber_gx.php');
} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 5){
	header('Location:/Manage/temp/openNumber_nc.php');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 6){
	header('Location:/Manage/temp/openNumber_pk.php');
} else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 7){
	header('Location:/Manage/temp/openNumber_lhc.php');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 8){
	header('Location:/Manage/temp/openNumber_xj.php');
}else if(isset($_SESSION['GameType']) && $_SESSION['GameType'] == 9){
	header('Location:/Manage/temp/openNumber_jsk3.php');
}else{
	 header('Location:/Manage/temp/openNumber.php');
}
?>