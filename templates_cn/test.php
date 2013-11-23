<?php  

define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'class/db.php';
$db = new DB();
$arr = $db->query("select * from g_send_back_default where g_game_id=2 order by g_id",1);
foreach($arr as $k){
	$db->query("insert into g_send_back_default(g_type,g_a_limit,g_b_limit,g_c_limit,g_d_limit,g_e_limit,g_game_id)values('".$k['g_type']."',
	".$k['g_a_limit'].",
	".$k['g_b_limit'].",
	".$k['g_c_limit'].",
	".$k['g_d_limit'].",
	".$k['g_e_limit'].",8)");
}
?>