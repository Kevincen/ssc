<?php 
define('Copyright', '作者QQ:1834219632');
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'function/cheCookie.php';
global $user;

$name = base64_decode($_COOKIE['g_user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //获取最新投注的10条记录
    //$type= $user['type'];
    $db=new DB();
    //$sql = "SELECT * FROM g_zhudan where g_nid='$name' and g_win=null and g_type='$type' ORDER BY g_id DESC LIMIT 10";
    $sql = "SELECT g_mingxi_1,g_mingxi_2,g_date,g_odds,g_jiner FROM g_zhudan where g_nid='$name' and g_win is null ORDER BY g_id DESC LIMIT 10";
    $result1 = $db->query($sql, 1);
    for ($i=0;$i<count($result1);$i++) {
        $type = $result1[$i]['g_mingxi_1'];
        if ($type== '选二连直') {
            $ball_array = explode('|',$result1[$i]['g_mingxi_2']);

            $ball_array[0] = '前位 ' .$ball_array[0];
            $ball_array[1] = '后位' . $ball_array[1];
            $result1[$i]['g_mingxi_2'] = $ball_array[0] ." ". $ball_array[1];
        }
    }
    echo json_encode($result1);
    exit;
}

//获取游戏的开放情况
$configModel = configModel("g_kg_game_lock,g_cq_game_lock,g_gx_game_lock,g_pk_game_lock,g_nc_game_lock,g_lhc_game_lock,g_xj_game_lock,g_jsk3_game_lock");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"<?php echo $oncontextmenu?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧</title>
<link href="css/left.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="js/sc.js"></script>
<script type="text/javascript">
//切换风格
function ChangeSkin(skin)
{
	$("body").removeClass("skin_brown skin_blue skin_red").addClass(skin);
}
	/*
function getinfo()
	{
		//获取注单
		$.ajax({
			type : "POST",
			url : '/function/Refresh.php',
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						getinfo();
						return false;
					}
				}
			},
			success:function(data){
				var datestr=data.split(';');
				$("#pls").html(datestr[0]);
				$("#xinyong").html(datestr[1]);
				$("#jine").html(datestr[2]);
				$("#tentable").html(datestr[3]);
			}
		});
	}
setInterval(getinfo, 5000);
*/
function getinfo2()
{
	//获取信用金额等信息
	$.ajax({
		type : "POST",
		url : '/function/getmine.php',
		error : function(XMLHttpRequest, textStatus, errorThrown){
			if (XMLHttpRequest.readyState == 4){
				if (XMLHttpRequest.status == 500){
					getinfo2();
					return false;
				}
			}
		},
		success:function(data){
			var datestr=data.split(';');
			$("#xinyong").html(datestr[0]);
			$("#jine").html(datestr[1]);
		}
	});
}
setInterval(getinfo2, 20000);

$(function(){

	//左侧注单刷新
	$("#rushBtn").click(function(){
        $.post("/templates_cn/left.php",{},function(data){
            var orderhtml = '';
            console.log(data);
            for (var i=0;i<data.length;i++) {
                var date = data[i]['g_date'].split(' ');
                orderhtml +='<tr> \
                    <td>'+ data[i]['g_mingxi_2']+ '</td> \
                    <td>&nbsp;'+ data[i]['g_odds']+ '&nbsp;</td> \
                    <td>&nbsp;'+data[i]['g_jiner']+ '&nbsp;</td> \
                    <td>&nbsp;'+date[1] + '&nbsp;</td> \
                </tr>'
            }
            $('#new_orders').html(orderhtml);
        },'json');
	});


});

</script>
</head>
<body class="bd <?php echo $_COOKIE['g_skin']; ?>">
<table border="0" cellpadding="0" cellspacing="0" class="t_list">
  <tr>
    <td class="t_list_caption redbg" colspan="2">账户信息</td>
  </tr>
  <tr>
    <td class="t_td_caption_1" width="71">账号：</td>
    <td class="t_td_text" width="137"><?php echo $user[0]['g_name']?>(<label id="pls" ><?php echo strtoupper($user[0]['g_panlu'])?></label>盘)</td>
  </tr>
  <tr>
    <td class="t_td_caption_1">信用额度：</td>
    <td class="t_td_text"><?php echo is_Number($user[0]['g_money'])?></td>
  </tr>
  <tr>
    <td class="t_td_caption_1">信用余额：</td>
    <td id="jine" class="t_td_text" style="font-weight:bold;"><?php echo is_Number($user[0]['g_money_yes'])?></td>
  </tr>
  <tr>
    <td class="t_td_caption_1">已下金额：</td>
    <td class="t_td_text">功能未做</td>
  </tr>
  
  
  <!--新旧版跳转临时按钮-->
  <tr>
    <td class="t_list_caption left_version" colspan="2"><a href="/index.php?version=hk" target="_parent">新版</a></td>
  </tr>
  <!--临时按钮end-->
  <?php if ($configModel['g_kg_game_lock']==1){?>
  <tr>
    <td class="t_list_caption font_st" colspan="2"><a href="http://baidu.lehecai.com/lottery/draw/view/544?agentId=5555" target="_blank">"广东快乐十分"开奖网</a></td>
  </tr>
  <?php
  }
  ?>
  <?php if ($configModel['g_cq_game_lock']==1){?>
  <tr>
    <td class="t_list_caption font_st" colspan="2"><a href="http://video.shishicai.cn/cqssc/" target="_blank">"重庆时时彩"开奖网</a></td>
  </tr>
  <?php
  }
  ?>
  <?php if ($configModel['g_pk_game_lock']==1){?>
  <tr>
  <tr>
    <td class="t_list_caption font_st" colspan="2"><a href="http://www.bwlc.net/buy/trax/" target="_blank">"北京赛车(PK10)"官网</a></td>
  </tr>
  <?php
  }
  ?>
  <?php if ($configModel['g_nc_game_lock']==1){?>
  <tr>
    <td class="t_list_caption font_st" colspan="2"><a href="http://www.16cp.com/gamedraw/lucky/open.shtml" target="_blank">"幸运农场"官网</a></td>
  </tr>
  <?php
  }
  ?>
  <?php if ($configModel['g_gx_game_lock']==1){?>
  <tr>
    <td class="t_list_caption font_st" colspan="2"><a href="http://video.shishicai.cn/haoma/gxkl10/list/50.aspx" target="_blank">"广西快乐十分"开奖网</a></td>
  </tr>
  <?php
  }
  ?>
  
  <?php if ($configModel['g_xj_game_lock']==1){?>
  <tr>
  <tr>
    <td class="t_list_caption font_st" colspan="2"><a href="http://www.xjflcp.com/ssc/" target="_blank">"新疆时时彩"开奖网</a></td>
  </tr>
  <?php
  }
  ?>
  <?php if ($configModel['g_jsk3_game_lock']==1){?>
  <tr>
  <tr>
    <td class="t_list_caption font_st" colspan="2"><a href="http://www.cailele.com/lottery/k3/" target="_blank">"江苏骰宝（快3）"开奖网</a></td>
  </tr>
  <?php
  }
  ?>
</table>
<div id="newOrder" class="box new-order">
    <ul id="refresh_title">
        <li class="new_fresh_title">最新注单</li>
        <li class="rushBtn"><a id="rushBtn" class=" btn_r elem_btn btn" href="javascript:void(0)">刷新</a></li>
    </ul>
    <div class="neworderListBox">
        <table cellspacing="0" class="struct_table_newOrder">
        <thead>
            <tr class="sub_title bg_deep_blue">
                <td>号码</td>
                <td>赔率</td>
                <td>金额</td>
                <td>时间</td>
                
            </tr>                  
        </thead>
        <tbody id="new_orders">
            <tr>
                <td>10</td>
                <td>1.985</td>
                <td>1000</td>
                <td>13:33:33</td>
            </tr> 
            <tr>
                <td>功</td>
                <td>能</td>
                <td>未</td>
                <td>做</td>
            </tr> 
        </tbody>
        </table>
    </div>
</div>
<!--这里有中文判断，不能直接转换为简体，先循环，在最后输出时再转简体-->
<!--<table border="0" cellpadding="0" cellspacing="1" class="t_list"  width="230" style="top:-1px;left:0px;" id="tentable">
  <TR class="t_list_caption">
    <TD colSpan=4 align="middle"><SPAN class=STYLE2>最新下注的十个单</SPAN></TD>
  </TR>
  <TR class="t_list_caption">
    <TD align="middle"><FONT color=#000000>时间</FONT></TD>
    <TD align="middle"><FONT color=#000000>内容</FONT></TD>
    <TD align="middle"><FONT color=#000000>赔率</FONT></TD>
    <TD align="middle"><FONT color=#000000>金额</FONT></TD>
  </TR>-->
	<?php 
		/*for($i=0;$i<count($result1);$i++){
      $SumNum = sumCountMoney ($user, $result1[$i], true);
        if ($result1[$i]['g_mingxi_1_str'] == null) 
		{
        	if ($result1[$i]['g_mingxi_1'] == '總和、龍虎' || $result1[$i]['g_mingxi_1'] == '總和、龍虎和')
			{
        		$n = $result1[$i]['g_mingxi_2'];
        	}
			else
			{
        		$n = $result1[$i]['g_mingxi_1'].'『'.$result1[$i]['g_mingxi_2'].'』';
        	}
        	//$n = $result[$i]['g_mingxi_1'] == '總和、龍虎' ? $result[$i]['g_mingxi_2'] : $result[$i]['g_mingxi_1'].'『'.$result[$i]['g_mingxi_2'].'』';
        	$html = '<font color="#0066FF">'.$n.'</font>';
        } 
		else 
		{
        	$_xMoney = $result1[$i]['g_mingxi_1_str'] * $result1[$i]['g_jiner'];
        	$SumNum['Money'] = '<font color="#009933">'.$result1[$i]['g_mingxi_1_str'].'</font> x <font color="#0066FF">'.$result1[$i]['g_jiner'].'</font><br />'.$_xMoney;
        	$html = '<font color="#0066FF">'.$result1[$i]['g_mingxi_1'].'</font><br />'.
        				'<span style="line-height:23px">復式  『 '.$result1[$i]['g_mingxi_1_str'].' 組 』</span><br/><span>'.$result1[$i]['g_mingxi_2'].'</span>';
        }*/
  ?>
  <!--<TR class="t_td_text">
    <TD align="middle"><FONT color=#000000><?php echo date('H:i:s',strtotime($result1[$i]['g_date']));?></FONT></TD>
    <TD align="middle"><FONT color=#000000><?php echo $html?></FONT></TD>
    <TD align="middle"><FONT color=#000000><font color="red"><b><?php echo $result1[$i]['g_odds']?></b></font></FONT></TD>
    <TD align="middle"><FONT color=#000000><?php echo $result1[$i]['g_jiner']?></FONT></TD>
  </TR>-->
  <?php
 // }
  ?>
 <!--</table>-->
</body>
</html>