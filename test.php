<?php
/* 
  Copyright (c) 2010-02 Game
  Game All Rights Reserved. 
  QQ:1834219632
  Author: Version:1.0
  Date:2011-12-07 09:28:32
*/
//exit("SELECT g_text FROM g_set_user_news WHERE g_name = 'ccccc' union all select g_name as g_text from  g_manage where g_nid<>'' LIMIT 1");
//echo base64_encode("ccccc' union all select g_name as g_text from  g_manage where g_nid<>'");exit;
exit( md5("admin123"));
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
$db = new DB();
$db->query("delete from g_send_back_default",2);
$rows = $db->query("select * from g_send_back where g_name='vv2288' order by g_id desc",1);
foreach($rows as $row){
	$sql="insert into g_send_back_default(g_type,g_a_limit,g_b_limit,g_c_limit,g_d_limit,g_e_limit,g_game_id)values(";
	$sql.="'".$row['g_type']."',";
	$sql.="'".$row['g_a_limit']."',";
	$sql.="'".$row['g_b_limit']."',";
	$sql.="'".$row['g_c_limit']."',";
	$sql.="'".$row['g_d_limit']."',";
	$sql.="'".$row['g_e_limit']."',";
	$sql.="'".$row['g_game_id']."')";
	$db->query($sql,2);
}
echo "ok";