<?php
/*  
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-9
*/
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';


$db=new DB();
$abc =  $_POST['abc'];
$gp =  $_POST['gp'];
$gsrc =  $_POST['gsrc'];
$name = base64_decode($_COOKIE['g_user']);
if($abc==null) {}else{
$sql = "update g_user set g_panlu='$abc' where g_name='$name'";
$result1 = $db->query($sql, 2);
}


echo "<script>window.location=\"".$gsrc.".php?g=".$gp."\";</script>"; 


?>
