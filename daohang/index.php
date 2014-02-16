<?php
/*
	导航页
*/
define('ROOT_PATH', $_SERVER["DOCUMENT_ROOT"].'/');
include_once ROOT_PATH.'config/config.php';

//获取有效会员线路
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

//获取有效导航线路
$dhost = array();
foreach($dHome as $dkey=>$dline)
{
	if(!empty($dline) && !empty($dPort[$dkey]))
	{
		if($dPort[$dkey] == '80')
		{
			$dhost[] = 'http://'.$dline;	
		}
		else
		{
			$dhost[] = 'http://'.$dline.':'.$dPort[$dkey];
		}
	}
}




$secode='8888'; //安全码

//未登录
if(empty($_POST['dopost']) && !isset($_SESSION['daohang']))
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>搜索</title>
</head>
<style type="text/css">
body, div, form, input, img, p {
margin: 0;
padding: 0;
}
body {
font: 14px/1.231 Verdana, Arial, Helvetica, sans-serif;
color: #333333
}
a {
color: #DD2405;
text-decoration: underline
}
.main{
margin:0 auto;
text-align: center;
width:100%;
}
.center{
padding: 50px 0 35px 0px;
background-color:#CCCCCC;
margin:0 auto;
}
</style>
<body onload="MyForm.code.focus()">
<div class='main'>
<div class='center'>
<form  method="post" defaultbutton="submit_bt" name="MyForm">
<b>百度+谷歌<b>
<br/>
<input type="password"  width="200" height="25"  id="code" name="code">
<input type="submit"  value="搜索" name="submit_bt">
<input type="hidden" name="dopost" value="submit" />
</form>
</div>
</div>
</body>
</html>
<?php 
}
else
{ 
	if( !isset($_SESSION['daohang']) )
	{
		if($_POST['code'] != $secode)
		{
			echo "<script>location.href='http://www.baidu.com/s?wd=".$_POST['code']."';</script>";
			exit(); 
		}
		else
		{
			$_SESSION['daohang'] = 1;
			echo "<script>location.href='/';</script>";
			exit(); 
		}
	}
	else
	{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>线路选择-合顺导航-会员&代理</title>
<style type="text/css">
html{background:#0399C7 url(daohang/images/1.png) repeat-x;}
body{text-align:center;margin:0;color:#000;font-size:13px;height:100%;}
.bg{width:100%;height:600px;background:url(daohang/images/1.jpg) no-repeat 50% 0;position:absolute;top:0;left:0;z-index:1;}

.frm{width:564px;padding:12px;margin:70px auto 0;}
.clx {zoom:1;padding-left:57px;}
.clx:after {content:'.';display:block;visibility:hidden;clear:both;height:0;font-size:0;}
h1{border-bottom:1px solid #DCDCDC;margin:-60px 40px 50px;font-size:30px;font-weight:bold;color:#FFF;}
h1 span{position:relative;z-index:2;}
.clx .lh{height:424px;}
.clx .fl{width:219px;border:1px solid #B33B30;float:left;margin-left:7px;display:inline;text-align:left;padding:7px 0;}
.clx .fl .h{position:relative;}
.clx .fl p{position:relative;z-index:2;left:5px;}
.clx h2{background:#8F4D30;color:#FEFEFE;position:absolute;padding:3px 10px;font-size:15px;top:-31px;left:3px;height:17px;margin:0;}
.clx h2 span{font-weight:normal;letter-spacing:10px;}
.clx ul{padding-left:30px;margin:2px 0 2px 15px;position:relative;z-index:2;}
.clx li{list-style-type:square;padding:6px 0;}
.clx li a{display:inline-block;border:1px solid #A8A8A8;background:#FFF1CC;width:52px;height:21px;padding-left:14px;color:#000;text-decoration:none;line-height:21px;}
.clx li a:hover{background:#FFE5AC;}
.clx h3{font-size:13px;color:#FF0000;margin:5px 0 5px 28px;position:relative;z-index:2;}
.clx .fir{border-color:#117916;}
.fir h2{background:#006633;}
.fir li a{background:#EEFFDF;color:#674908;}
.fir li a:hover{background:#DCFFBD;}
.fir h3{color:#009944;}
.ad{padding-top:2px;background: none repeat scroll 0 0 #FFFFFF;color: red;font-weight: bold;margin: -48px 53px 45px 65px;position: relative;z-index: 2;}

/*新增添加关于手机的样式 start*/
.phone{position:absolute;bottom:57px; background:url("daohang/images/phone.png") top center no-repeat;padding:145px 5px 0;right:455px;white-space:nowrap}
.phone_box{margin:0;padding:0;width:450px;margin:0 auto;height:100%;position:relative}
.phone p{margin:0;color:#002f5b;font-size:14px}
.phone .title{color:#FFF190;font-weight:bold;font-size:18px;width:145px;margin:0 auto;text-align:left}
.phone .info{text-align:left}
.phone a{color:#0005d4;text-decoration:underline}
/*新增添加关于手机的样式 end*/
/*3G 线路 start*/
.clx span{background: none repeat scroll 0 0 white;border: 1px solid #BEA564;color: red;margin-left: 5px;padding: 0 3px;}
/*3G 线路 end*/
</style>
</head>
<body>
<div><div class="bg">
    <!-- 手机链接 start-->
    <div class="phone_box">
    <div class="phone">
    <p class="title">会员支持手机平台</p>
    <p>手机登录<a id="phone_link"></a></p>
    <p class="info">地址即可！</p>
    </div>
    </div>
    <!-- 手机链接 end-->
</div></div>
<div class=""></div>
<div class="frm">
    <h1><span>合顺导航</span></h1>
    <div class="ad">
        <!-- 時時彩导航-->
         如遇到导航页不能登录，请登录总导航页输入本公司导航网址。<!-- 修改的文字 -->
    </div>
    <div class="clx">
        <div class="fl">
            <div class="h"><h2>1.<span>会员</span></h2></div>
            <div class="lh">
                <ul>   
                    <?php foreach($host as $link_key=>$link){?>             
					<li><a href="<?php echo $link; ?>" target="_blank">线路<?php echo $link_key+1; ?></a></li>
                    <?php }?>                    
                </ul>
                <h3>备用线路：1</h3>
                <ul>
                
                </ul>
            </div>
        </div>
        
        <div class="fl fir">
            <div class="h"><h2>2.<span>代理</span></h2></div>
            <div class="lh">
                <ul>
                    <?php foreach($dhost as $dlink_key=>$dlink){?>             
					<li><a href="<?php echo $dlink; ?>" target="_blank">线路<?php echo $dlink_key+1; ?></a></li>
                    <?php }?> 
                </ul>
                <h3>备用线路：</h3>
                <ul>
                
                </ul>
            </div>
        </div>
    </div>
</div>
<!--测速功能 start-->
<!--測速按鈕-->
<button  onclick="test(0)" style="position:absolute;top:33px;left:64%;z-index:1000;width:55px">測速</button>
<button  onclick="javascript:window.location.reload();" style="position:absolute;top:33px;left:70%;z-index:1000;width:80px">手动刷新</button>
<!--添加用於測速的控件-->
<div id="speed" style="display:none"></div>
</body>
<script type="text/javascript">

var li = document.getElementsByTagName("li"),st,count = 0,

    btn = document.getElementsByTagName('button')[0],
    speed = document.getElementById('speed');

var cache = [],timeout = null;    

var cacheImg = function (){
    var cid ='';
    for(var c = 0; c < li.length; c++){
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
var clear = function(c){
    clearTimeout(timeout);
    timeout = null;
    if (!c) {
        for (var i = li.length - 1; i >= 0; i--) {
            if(li[i].getElementsByTagName('span').length){
                li[i].getElementsByTagName('span')[0].innerHTML = '';
            }
        };
    };
}
var test = function (c){
    clear(c);
    btn.setAttribute('disabled','disabled');
    var cid = "";
    if (cache.length > 0 && cache[c]) {
        if(li[c].getElementsByTagName("span").length > 0 ){ 
            li[c].getElementsByTagName("span")[0].innerHTML = "測速中"; 
            cache[c].img.src = cache[c].url+(Math.random()+'').replace('0.','');
        }else{
            var span = document.createElement("span");
            span.id = c+"m";
            span.innerHTML = "測速中";
            li[c].appendChild(span);
            cache[c].img.src = cache[c].url+(Math.random()+'').replace('0.',''); 
            speed.appendChild(cache[c].img);
        }
        cache[c].time = new Date().getTime();
        cache[c].stop = false;
        timeout = setTimeout(function() {
            getError.call(cache[c].img,c);
        }, 5000);
    }else{
        btn.removeAttribute('disabled');
    };
}

function getError(c){
    var n = this.id;
    if (typeof c === 'number') {
        n = c;
    };
    n = parseInt(n,10);
    if(document.getElementById(this.id+'m')){
        if (!cache[parseInt(n,10)].stop) {
            cache[parseInt(n,10)].number = 0; 
            cache[parseInt(n,10)].stop = true;
            if(document.getElementById(n+'m').innerHTML != '超時' || document.getElementById(n+'m').innerHTML == '測速中'){
                document.getElementById(n+'m').innerHTML = '無法鏈接';
            }
        };
        setTimeout(function(){
            test(n+1);
        },500);
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

    if(cache[cid].number < 2 ){

        setTimeout(function(){
            test(cid);
        },500);
    }else{
        for(var c = 0; c < 2; c ++){
            total += clink.loadTime[c];
        }
        document.getElementById(cid+'m').innerHTML = (total/2).toFixed(2)+'毫秒';
        count -= 1;
        cache[cid].number = 0;
        cache[cid].loadTime.length = 0;
        cache[cid].stop = true;
        setTimeout(function(){
            test(cid+1);
        },500);
    }            
}
cacheImg();
</script>
</html>
<?php 
	}
}
?>