<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
include_once ROOT_PATH.'function/cheCookie.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo base64_decode($_COOKIE['g_user']); ?> - <?php echo $Title_cn; ?></title>
</head>
<frameset rows="116,*,29" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
  <frameset cols="230,*" frameborder="no" border="0" framespacing="0">
    <frame src="left.php" name="leftFrame" noresize="noresize" id="leftFrame" scrolling="no"/>
    <frame src="sGame_sm.php?g=k3" name="mainFrame" id="mainFrame" />
  </frameset>
  <frame scrolling="no" noresize="noresize" target="content" frameborder="no" src="ac.php" name="DownFrame" id="DownFrame"></frame>
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>