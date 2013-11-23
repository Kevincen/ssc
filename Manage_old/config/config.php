<?php
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
exit('作者QQ：914190123');
if (!defined('ROOT_PATH'))
exit('invalid request');
$db=new DB();
$ConfigModel = $db->query("SELECT *  FROM `g_config` LIMIT 1", 1);
$ConfigModel = $ConfigModel[0];
?>