<?php
if (!defined('Copyright') && Copyright != '作者QQ:914190123')
    exit('作者QQ:914190123');
if (!defined('ROOT_PATH'))
    exit('invalid request');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Welcome</title>
    <script type="text/javascript">if ( top.location != self.location ) top.location=self.location;</script>
</head>
<?php

$name=$loginName;
$sql = "SELECT * FROM `g_rank` WHERE `g_name` = '{$name}' AND `g_pwd` = 1 LIMIT 1 ";
$result = $db->query($sql, 1);
if ($result)
{
    //判斷帳號是否需要重新设置密码
    alert('你是首次登陆或者上级更改密码，需要修改密码！');
    ?>

    <body>
    <iframe src="/Manage/temp/UpdatePwd_first.php" name="mainFrame" scrolling="No" noresize="noresize" id="mainFrame" width="100%" height="300px" frameborder="no" border="0" framespacing="0"/>
    </body>
    <?php
    //include_once ROOT_PATH.'Manage/temp/UpdatePwd_first.php';
}else{
?>
<frameset rows="84,*" cols="*" frameborder="no" border="0" framespacing="0">
    <frame src="/Manage/temp/topMenu.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
    <frame src="/Manage/temp/newFile.php" name="mainFrame" id="mainFrame"  />
</frameset>
</frameset>
<noframes>

    <body>
    </body><?php } ?>
</noframes></html>

