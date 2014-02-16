<?php
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
/*include_once ROOT_PATH.'function/cheCookie.php';*/
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
    exit('作者QQ:914190123');
if (!defined('ROOT_PATH'))
    exit('invalid request');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $loginName ?> - <?php echo $Title?></title>
    <script type="text/javascript">//if ( top.location != self.location ) top.location=self.location;</script>
</head>
<frameset rows="84,*" cols="*" frameborder="no" border="0" framespacing="0">
    <frame src="/Manage/temp/topMenu.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
    <frame src="/Manage/temp/newFile.php" name="mainFrame" id="mainFrame"  />
</frameset>

<noframes>

    <body>
    </body>
</noframes></html>

