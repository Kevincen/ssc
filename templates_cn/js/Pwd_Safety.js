//判斷密碼是是否合法（合法返回True）
var Num1='123456789';
var Num2='987654321';
var rex1=/[0-9]+/g;
var rex2=/[a-z]+/g;
function Pwd_Safety(t_PWD) { 
    var PWD_Legality=true;
    var t_PWD_str=t_PWD.toLowerCase();
    
    var resx1=/^[0-9]+$/g;
    if (resx1.test(t_PWD_str)) PWD_Legality=false;
    resx1=/^[a-z]+$/g;
    if (resx1.test(t_PWD_str)) PWD_Legality=false;

    var strs1=t_PWD_str.match(rex1);
    if(strs1!=null){
    for(var i=0;i<strs1.length;i++){
     if(strs1[i].length>3){
       if(Num1.indexOf(strs1[i])!=-1)
         PWD_Legality=false;//数字顺序
       if(Num2.indexOf(strs1[i])!=-1)
         PWD_Legality=false;//数字倒序
    }}}
    strs1=t_PWD_str.match(rex2);
    if(strs1!=null){
    if(strs1.length==1){
      if(strs1[0].length==1)    
         PWD_Legality=false;}//只有一个字母
    }

    for(var i=0;i<t_PWD_str.length-2;i++){
    if(t_PWD_str.charAt(i)==t_PWD_str.charAt(i+1)){
     if(t_PWD_str.charAt(i)==t_PWD_str.charAt(i+2)){
        PWD_Legality=false;
    }}}

    if (t_PWD=="123abc") PWD_Legality=false;
    if (t_PWD=="abc123") PWD_Legality=false;

    if (PWD_Legality==false) alert("出於安全角度考慮‘密碼’需包含兩個以上英文字母和數字等符號組成。其中不能包含4個連續‘相同字符’或‘順序數字’如：aaa、1234、4321。（特別注意：不要重覆使用老密碼）");
    return PWD_Legality; 
}
$(document).ready(function(){
	var url = location.href.split('/'); 
	
})