<?php 
include_once ROOT_PATH.'function/cheCookie.php';
if(!isset($_SESSION['code']))
{
	exit(href('templates/quit.php'));
}
else
{
	 unset($_SESSION['code']);	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title?> - - old</title>
<script type="text/javascript">
if ( top.location != self.location ) top.location=self.location;
/*
function document.onkeydown()
{ 
	if ( event.keyCode==116) 
	{ 
		event.keyCode = 0; 
		event.cancelBubble = true; 
		return false; 
	}
}
*/
</script>
<script type="text/javascript" src="/js/jquery.js"></script>
</head>
<frameset rows="108,*,26" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="templates/top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
  <frameset cols="230,*" frameborder="no" border="0" framespacing="0">
    <frame src="templates/left.php" name="leftFrame" noresize="noresize" id="leftFrame" />
    <frame src="templates/sGame_sm.php?g=k3" name="mainFrame" id="mainFrame" />
  </frameset>
  <frame scrolling="no" noresize="" target="content" frameborder="no" src="templates/ac.php" name="DownFrame"></frame>
</frameset>
<noframes>
<body>
</body>
</noframes></html>