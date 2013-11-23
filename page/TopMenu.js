var Html_SB="<html>";
Html_SB+="<head>";
Html_SB+="    <meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";
Html_SB+="    <script src='js/Forbid.js' type='text/javascript'></script>";
Html_SB+="    <link href='css/index.css' rel='stylesheet' type='text/css'>";
Html_SB+="</head>";
Html_SB+="<body>";
Html_SB+="<table width='100%' height='100%' border='0' cellspacing='0' cellpadding='0'><tr><td align='center'><object classid=\'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\' codebase=\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,22,0\' width=700 height=500 id=SB><param name=wmode value=transparent /><param name=movie value=../user/SB.swf /><param name=FlashVars value=pageID=0 /><param name=quality value=high /><param name=menu value=false><embed src=../user/SB.swf name=SB quality=high wmode=transparent type=\'application/x-shockwave-flash\' pluginspage=\'http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash\' width=700 height=500></embed></object></td></tr></table>";
Html_SB+="</body>";
Html_SB+="</html>";
var SB_Limit_Time=0;//限製時間

var s_LT=1;//選擇遊戲類型

function Today_Second() {
    var date=new Date();
    return date.getHours()*3600+date.getMinutes()*60+date.getSeconds();
}

function SB_Limit(Ltime) {
    SB_Limit_Time=Today_Second() + Ltime;
}

function go_web(t_url) {
	window.open(t_url.replace("￥",s_LT),'content');
}

function Limit_URL(url) {
    if (SB_Limit_Time > Today_Second()){
        parent.frames["content"].document.close();
        parent.frames["content"].document.write(Html_SB);
    } else {
        parent.frames["content"].location=url.replace("￥",s_LT);    
    }
}

///按鈕部分代碼
var mBut_1_1=new Array();
var mBut_2_1=new Array();
var mBut_3_1=new Array();

var mBut_1=new Array();
var mBut_2=new Array();
var mBut_3=new Array();
var mBut_4=new Array();

function SelectType(LT) {
    document.getElementById("bST_1").className="bST_1";
    document.getElementById("bST_2").className="bST_2";
    document.getElementById("bST_" + LT).className="bST_" + LT + "_s";
	s_LT=LT;
    mBut_1=eval("mBut_" + s_LT + "_1");
    Loading_But(1);
}

function Loading_But(bID) {
	var mBut=eval("mBut_" + bID);
	var But_Width=new Array("0","0","37","49","63","73","86","98","109");
	var But_Htm="";
    for (i=0;i<(mBut.length);i++){
        if (mBut[i] instanceof Array) {
		    if (But_Htm!="") But_Htm+="<td width='3'><img src='images/main_34.gif' width='1' height='30'></td>";
		    var But_W=Number(But_Width[mBut[i][0].length]);
		    var Color_B = "";
		    //if (mBut[i][0]=="實時滾單" || mBut[i][0]=="自動補貨設定") Color_B = " class='font_r'";
		    //if (mBut[i][0]=="經營狀況分析") Color_B = " class='font_b'";
		    But_Htm+="<td width='" + But_W + "' height='30'><table width='" + (But_W-5) + "' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td height='24' style='cursor:hand' onMouseOver=this.style.backgroundImage='url(images/bg.gif)';this.style.borderStyle='solid';this.style.borderWidth='1';borderColor='#145398'; onmouseout=this.style.backgroundImage='url()';this.style.borderStyle='none' onClick=" + mBut[i][1] + "><div align='center'" + Color_B + ">" + mBut[i][0] + "</div></td></tr></table></td>";
		}
		
	}
	document.getElementById("But_Html").innerHTML = "<table width='100%' border='0' cellspacing='0' cellpadding='0' style='position: relative; top: -11px'><tr>" + But_Htm + "<td>&nbsp;</td></tr></table>";
	But_Htm="";
	mBut=null;
}

// ＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝
var CacheBet = new Array();

function Save_CacheBet(T) {
    CacheBet[Number(T)]=parent.frames["content"].document.body.innerHTML;
}
function Load_CacheBet(T) {
    parent.frames["content"].document.body.innerHTML=CacheBet[Number(T)];
}

function Clase_CacheBet() {
    CacheBet = new Array();
}
