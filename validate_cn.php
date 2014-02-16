<?php
if (!defined('ROOT_PATH'))
exit('invalid request');
if (!defined('Copyright') && Copyright != '作者QQ:1834219632')
exit('作者QQ:1834219632');
include_once ROOT_PATH.'function/global.php';

//$loginName = base64_decode($_COOKIE['g_user']);
//获取公告信息
$text = $db->query("SELECT * FROM g_news WHERE g_number_alert_show = 1 ORDER BY g_id DESC LIMIT 10 ", 0);
$list = '';
if(is_array($text))
{
	foreach($text as $val)
	{
		//繁体转换简体
		$lang = new utf8_lang;
		$val[1] = $lang->hk_cn($val[1]);
		
		$list .= '<tr class=""><td>'.$val[2].'</td><td style="text-align:left;text-indent:2em;">'.$val[1].'</td></tr>';
	}
	if(!empty($list))
	{
		$list = '<table class="t1 dataArea struct_table_center more_announcement w100"><tbody><tr><th style="width:110px">时间</th><th>公告详情</th></tr></tbody><tbody class="more_ann_box">'.$list.'</tbody></table>';
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $loginName; ?> - <?php echo $Title?></title>
<link type="text/css" rel="stylesheet" href="templates_cn/css/skin.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
</head>
<body class="<?php echo $g_skin; ?>">
<?php
$sql = "SELECT * FROM `g_user` WHERE `g_name` = '{$loginName}' AND `g_pwd` = 1 LIMIT 1 ";
$result = $db->query($sql, 1);
if($result)
{
	//判斷帳號是否需要重新设置密码
	alert_href($loginName.'你是首次登陆或者上级更改密码，需要修改密码！','templates_cn/UpPwd_first.php');
	exit;
}
?>
<div class="header" id="xyheader"><div class="xyheader"></div></div>
<div id="layout" class="container">
    <div dom="mainlayout"  class="main-content1" id='mainlayout'>
        <div class="mains_corll" dom="main" id='main'>
            <div id="protocol">
                <div class="g-xy">
                    <h3><strong>游戏协议</strong></h3>
                    <div class="txt">
                        <ul>
                            <li>・ 01. 为避免出现争议，请您务必在下注之后查看“下注状况”。 </li>
                            <li>・ 02. 任何投诉必须在开奖之前，后台将不接受任何开奖之后的投诉。</li>
                            <li>・ 03. 公布赔率时出现的任何打字错误或非故意人为失误，所有（相关）注单一律不算。</li>
                            <li>・ 04. 公布之所有赔率为浮动赔率，下注时请确认当前赔率及金额，下注确认后一律不能修改。</li>
                            <li>・ 05. 开奖后接受的投注，一律视为无效。</li>
                            <li>・ 06. 若本后台发现客户以不正当的手法投注或投注注单不正常，后台将有权“取消”相应之注单，客户不得有任何异议。</li>
                            <li>・ 07. 如因软件或线路问题导致交易内容或其他与账号设定不符合的情形，请在开奖前立即与本后台联络反映问题，否则本后台将以资料库中的数据为准。</li>
                            <li>・ 08. 倘若发生遭黑客入侵破坏行为或不可抗拒之灾害致网站故障或资料损坏、数据丢失等情况，后台将以资料库数据为依据。</li>
                            <li>・ 09. 各级管理人员及客户必须对本系统各项功能进行了解及熟悉，任何违反正常使用的操作，后台概不负责。</li>
                            <li>・ 10. 请认真了解游戏规则。</li>
                        </ul>
                    </div>
                </div>
                <div class="bottom">
                    <a href="javascript:void(0)" class="btn_m elem_btn" id="agree">同意</a>
                    <a href="javascript:void(0)" class="btn_m elem_btn" id="disagree">不同意</a>
                </div>
            </div>
        </div>
    </div>
</div><!--container-->
<form action="" method="post" name="form1">
    <input type="hidden" name="sid" value="yes" />
    <input type="hidden" name="version" value="cn" />
</form>    
<script type="text/javascript">
$(function(){
	//绑定同意按钮
	$("#agree").click(function(){
		document.form1.submit();
	});
	//绑定退出按钮
	$("#disagree").click(function(){
		art.dialog({
			title:'用户提示',
			content: '您确定要退出吗？',
			resize:false,
			drag:false,
			fixed:true,
			width:400,
			padding:0,
			ok: function(){
				window.location='templates_cn/quit.php'
			},		
			cancel: true 
		});
	});
	$(".dataArea tr").hover(function(){
		$(this).addClass("bc");
	},function(){
		$(this).removeClass("bc");
	});
});	
<?php 
//弹出公告信息
if(!empty($list))
{
?>
art.dialog({
	title:'历史公告',
	content: '<?php echo $list; ?>',
	lock:true,
	resize:false,
	drag:false,
	fixed:true,
	padding:0,
	opacity:0.5,
	width:750,
	ok: true
});
<?php
}
?>
</script>
</body>
</html>