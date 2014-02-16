<?php 
/*前台主框架*/
include_once ROOT_PATH.'function/cheCookie.php';
if(!isset($_SESSION['code']))
{
	exit(href('templates_cn/quit.php'));
}
else
{
	 unset($_SESSION['code']);	
}

//获取有效线路
$host = array();
foreach($Home as $key=>$line)
{
	if(!empty($line) && !empty($Port[$key]))
	{
		if($Port[$key] == '80')
		{
			$host[] = 'http://'.$line;	
		}
		else
		{
			$host[] = 'http://'.$line.':'.$Port[$key];
		}
	}
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo base64_decode($_COOKIE['g_user']); ?> - <?php echo $Title_cn; ?></title>
<link id="css_link" type="text/css" rel="stylesheet" href="templates_cn/css/skin.css">
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/artDialog.js?skin=twitter"></script>
<style type="text/css">
html,body { margin:0;padding:0; height:100%; overflow:hidden;}   
</style>
</head>
<body class="<?php echo $_COOKIE['g_skin']; ?>">
<iframe src="templates_cn/main.php" style="width:100%; height:100%; border:0;" scrolling="no"></iframe>
<div id="lineSelectBox" style="display:none;">
    <ul>
    	<?php foreach($host as $link_key=>$link){?>
    	<li>
        	<span class="linetitle">线路<?php echo $link_key+1; ?>:&nbsp;</span><span class="timebox">反应时间:<font id="<?php echo $link_key; ?>m" style="color:red;"></font></span>
            <a href="<?php echo $link; ?>" onclick="return false;">选择</a>
        </li>
        <?php }?>  
    </ul>
    <div style="clear: both;"><font color="red">提示:</font>反应时间越小，网速越快。</div>
</div>
<div id="speed" style="display:none"></div>
<script type="text/javascript">
//切换风格
function ChangeSkin(skin)
{
	$("body").removeClass("skin_brown skin_blue skin_red").addClass(skin);
    //document.getElementById('css_link').href = document.getElementById('css_link').href;
}

var Dialog = null;
//显示测速
function ShowLinkBox()
{
	Dialog = art.dialog({
		id: 'LinkBox',
		title:false,
		content: document.getElementById('lineSelectBox'),
		resize:false,
		drag:false,
		fixed:true,
		width:268,
		padding:0,
		left:750,
		top:40,
		button:[{
			name: '测速',
			callback:function(){
				test(0);
				return false;
			}
		}], 	
		cancel: true,
		cancelVal:'关闭',
		close: function(){
			Dialog = null;
		}

	});
	test(0);
}

//线路切换
var version = "<?php echo $_GET['version']; ?>";
$(function(){
	$("#lineSelectBox li a").click(function(){
		var n_link = $(this).attr("href");
		if(n_link !='')
		{
			n_link = n_link+"/index.php?version="+version;
			//alert('功能未完成！');
			window.location = n_link;
		}
	});
});

//测速
var li = $("#lineSelectBox li"),count = 0;
var speed = document.getElementById('speed');
var cache = [],timeout = null;  
var cacheImg = function ()
{
    var cid ='';
    for(var c = 0; c < li.length; c++)
	{
       var clink = {}
       cid = c+'';
       clink.img = document.createElement('img');
       clink.url = li[c].getElementsByTagName("a")[0].href.split('/').slice(0,3).join('/')+"/speed.gif?";
       clink.time = 0;
       clink.number = 0;
       clink.img.onerror = getError;
       clink.img.onload =  getLoad;
       clink.img.id = cid;
       clink.loadTime = [];
       clink.stop = false;
       cache[c] = clink;
    }
}    
//清除文字
var clear = function(c){
    clearTimeout(timeout);
    timeout = null;
    if (!c) {
        for (var i = li.length - 1; i >= 0; i--) 
		{
            if(li[i].getElementsByTagName('font').length)
			{
                li[i].getElementsByTagName('font')[0].innerHTML = '';
            }
        };
    };
}
var test = function (c){
    clear(c);
	if(Dialog != null)
	{
		art.dialog({id:'LinkBox'}).button({
			name: '测速',		
			disabled: true
		});
	}
    
    var cid = "";
    if(cache.length > 0 && cache[c])
	{
		li[c].getElementsByTagName("font")[0].innerHTML = "测速中"; 
        cache[c].img.src = cache[c].url+(Math.random()+'').replace('0.','');
		speed.appendChild(cache[c].img);
        cache[c].time = new Date().getTime();
        cache[c].stop = false;
        timeout = setTimeout(function() {
            getError.call(cache[c].img,c);
        }, 5000);
    }
	else
	{
		if(Dialog != null)
		{
			art.dialog({id: 'LinkBox'}).button({
				name: '测速',			
				disabled: false
			});
		}
    };
}

function getError(c){
    var n = this.id;
    if (typeof c === 'number') 
	{
        n = c;
    };
    n = parseInt(n,10);
    if(document.getElementById(this.id+'m'))
	{
        if (!cache[parseInt(n,10)].stop) 
		{
            cache[parseInt(n,10)].number = 0; 
            cache[parseInt(n,10)].stop = true;
            if(document.getElementById(n+'m').innerHTML == '测速中')
			{
                document.getElementById(n+'m').innerHTML = '无法链接';
            }
        };
        setTimeout(function(){test(n+1);},500);
    }
}
function getLoad(){
    var end = new Date().getTime(),
    cid = parseInt(this.id,10),
    clink = cache[cid],
    td = clink.number?end - cache[cid].time:end - cache[cid].time,
    total = 0;
    cache[cid].loadTime.push(td);
    cache[cid].number += 1;
    if(cache[cid].stop){
        return ;
    }
    if(cache[cid].number < 2 )
	{
        setTimeout(function(){test(cid);},500);
    }
	else
	{
        for(var c = 0; c < 2; c ++)
		{
            total += clink.loadTime[c];
        }
        document.getElementById(cid+'m').innerHTML = (total/2).toFixed(2)+'毫秒';
        count -= 1;
        cache[cid].number = 0;
        cache[cid].loadTime.length = 0;
        cache[cid].stop = true;
        setTimeout(function(){test(cid+1);},500);
    }            
}
cacheImg();

var Dialog2;
//退出登录
function LogOut()
{
	Dialog2 = art.dialog({
		title:'用户提示',
		content: '您确定要退出吗？',
		resize:false,
		fixed:true,
		lock:true,
		opacity:0,
		width:400,
		padding:0,
		ok: function(){
			window.top.location='templates_cn/quit.php'
		},		
		cancel: true 
	});
}

var TxtDialog;
//弹出公告窗口
function ShowTxtDialog(txt_html)
{
	TxtDialog = art.dialog({
		title:'历史公告',
		content:txt_html,
		lock:true,
		resize:false,	
		fixed:true,
		padding:0,
		opacity:0,
		width:750,
		ok: true
	});	
}
$(function(){
	$('.dataArea tr').live('mouseover mouseout', function(event) {
	  if (event.type == 'mouseover') {
		$(this).addClass("bc");
	  } else {
		$(this).removeClass("bc");
	  }
	});	   
});	
</script>
</body>
</html>