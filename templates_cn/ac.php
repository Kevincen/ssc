<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/global.php';
include_once ROOT_PATH.'function/cheCookie.php';

//获取公告信息
$db=new DB();
$text = $db->query("SELECT g_text FROM g_news WHERE g_number_alert_show = 1 ORDER BY g_id DESC LIMIT 1 ", 0);
if ($text)
{
	$n = strip_tags($text[0][0]);
	//繁体转换简体
	$lang = new utf8_lang;
	$n = $lang->hk_cn($n);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<link type="text/css" rel="stylesheet" href="css/left.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
<script type="text/javascript">
//切换风格
function ChangeSkin(skin)
{
	$("body").removeClass("skin_brown skin_blue skin_red").addClass(skin);
}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<div class="marquee">
  <a href="javascript:void(0)" class="more more_announcement" id="moreNotice">更多</a>
  <p class="marqueeBox"><marquee id="marqueeBox" scrollamount="2"><?php echo trim($n);?></marquee></p>
</div>
<?php 
//获取公告信息
$text_list = $db->query("SELECT * FROM g_news WHERE g_number_alert_show = 1 ORDER BY g_id DESC LIMIT 10 ", 0);
$list = '';
if(is_array($text_list))
{
	//繁体转换简体
	$lang = new utf8_lang;
	foreach($text_list as $val)
	{
		$val[1] = $lang->hk_cn($val[1]);
		$list .= '<tr class=""><td>'.$val[2].'</td><td style="text-align:left;text-indent:2em;">'.$val[1].'</td></tr>';
	}
	
	if(!empty($list))
	{
		$list = '<table class="t1 dataArea struct_table_center more_announcement w100"><tbody><tr><th style="width:110px">时间</th><th>公告详情</th></tr></tbody><tbody class="more_ann_box">'.$list.'</tbody></table>';
	}
	
}
?>
<script type="text/javascript">
$(function(){
	var txt_html = '<?php echo $list; ?>';
	//查看更多历史公告
	$("#moreNotice").click(function(){
		if(txt_html !='')
		{
			window.top.ShowTxtDialog(txt_html);
		}
	});
});
</script>
</body>
</html>