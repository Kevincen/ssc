/*****************************
* 新增快捷和正常投注
*****************************/
function kuijie(){
	$('#td_input_money').show();
	if($('#kuijie').attr('class')!='intype_hover'){
		$('#kuijie').attr('class','intype_hover');
		$('#yiban').attr('class','intype_normal'); 
		$('.je').hide();
		$('.tt').each(function(){
			var w = $(this).prev().width();
			w+=$(this).width();
			$(this).prev().css('width', w );   
			$(this).prev().attr('align','center');
			$(this).hide(); 
		})
		$('.wqs').find('.t_list_caption').find('td').each(function(){
			if( $(this).attr('colspan')>=3 ){
				var n = $(this).attr('colspan')-$(this).attr('colspan')/3	
				$(this).attr('colspan',n);
			}												
		})
		/*添加效果*/  
		$('.caption_1,.o').bind({'mouseenter':function(){
			if( $(this).attr('title')!='选中' ){ //未选中
				if($(this).attr('class')=='o' && $(this).prev().attr('class')=='caption_1'){
					$(this).css({'background-color':'#ffd094','cursor':'pointer'});	  
					$(this).prev().css({'background-color':'#ffd094','cursor':'pointer'});	 
				}
				if($(this).attr('class')=='caption_1' && $(this).next().attr('class')=='o'){
					$(this).next().css({'background-color':'#ffd094','cursor':'pointer'});	  
					$(this).css({'background-color':'#ffd094','cursor':'pointer'});	 
				}
			}
			 
		},'mouseleave':function(){ 
			if( $(this).attr('title')!='选中' ){ //未选中
				if($(this).attr('class')=='o' && $(this).prev().attr('class')=='caption_1'){
					$(this).css({'background-color':'#fff','cursor':'pointer'});	  
					$(this).prev().css({'background-color':'#FDF8F2','cursor':'pointer'});	 
				}
				if($(this).attr('class')=='caption_1' && $(this).next().attr('class')=='o'){
					$(this).next().css({'background-color':'#fff','cursor':'pointer'});	  
					$(this).css({'background-color':'#FDF8F2','cursor':'pointer'});	 
				}
			}
		},'click':function(){
			if($(this).attr('class')=='o' && $(this).prev().attr('class')=='caption_1'){ 
				if( $(this).attr('title')=='选中' ){ //已选中 取消选中
					$(this).css({'background-color':'#fff','cursor':'pointer'});	  
					$(this).prev().css({'background-color':'#FDF8F2','cursor':'pointer'});	
					$(this).attr('title','');
					$(this).prev().attr('title','');
				}else{												//选中
					$(this).css({'background-color':'#ffc214','cursor':'pointer'});	  
					$(this).prev().css({'background-color':'#ffc214','cursor':'pointer'});	 
					$(this).attr('title','选中');
					$(this).prev().attr('title','选中');
				}
			}
			if($(this).attr('class')=='caption_1' && $(this).next().attr('class')=='o'){
				if( $(this).attr('title')=='选中' ){ //已选中 取消选中
					$(this).next().css({'background-color':'#fff','cursor':'pointer'});	  
					$(this).css({'background-color':'#FDF8F2','cursor':'pointer'});	 
					$(this).attr('title','');
					$(this).next().attr('title','');
				}else{												//选中
					$(this).next().css({'background-color':'#ffc214','cursor':'pointer'});	  
					$(this).css({'background-color':'#ffc214','cursor':'pointer'});	
					$(this).attr('title','选中');
					$(this).next().attr('title','选中');
				}
			}	
		}})
	}
}
function yiban(){
	if($('#yiban').attr('class')!='intype_hover'){
		$('#yiban').attr('class','intype_hover');
		$('#kuijie').attr('class','intype_normal'); 
		$('.o').each(function(){ 
			$(this).css('width', '75px' );
			$(this).next().show(); 
		})
		$('.wqs').find('.t_list_caption').find('td').each(function(){
			if( $(this).attr('colspan')>=2 ){
				var n = $(this).attr('colspan')+$(this).attr('colspan')/2	
				$(this).attr('colspan',n);
			}												
		})
		 
	}	
	$('.caption_1,.o').unbind('mouseenter').unbind('mouseleave').unbind('click');
	$('.caption_1').css({'background-color':'#FDF8F2','cursor':''});
	$('.o').css({'background-color':'#fff','cursor':''});
	$('#td_input_money').hide();
	$('.je').show();
}
function MyReset(){
	$('.caption_1').css({'background-color':'#FDF8F2','cursor':''});
	$('.o').css({'background-color':'#fff','cursor':''});
	$('.caption_1').attr('title','');
	$('.o').attr('title','');
	$('.inp1').val('');
	$('#AllMoney').val('');
}

function AllMoney(){ 
	var sel=false;
	$('td.tt').each(function(){
		if(  $(this).prev().attr('title')=='选中' ){ //已选中 
			$(this).find('input').val( $('#AllMoney').val() );
			sel=true;
		}
	}) 
	return sel;
}
function iSubmit(){
	if($('#kuijie').attr('class')=='intype_hover'){	
		var sel = AllMoney();
		if(sel==false){
			alert('您未选择号码！');
			return false;
		}
	}
	return true;
}

/**************************************/
$(function () {
	$('#kuijie').bind('click',function(){
		kuijie();							   
	})
	$('#yiban').bind('click',function(){
		yiban();							   
	})
	
	action();
	$("#dp").attr("action","./inc/DataProcessing.php?t="+encodeURI($("#tys").html()));
	
	//POST提交表單
	$("#submits,#submits1").click(function () {
		if(iSubmit()==false)return false;
		var suc = true;
		$.ajax ({type:"post",url:URL,dataType:"text",async:false,data:{typeid:"postodds"},success : function (data) {
				suc = postodds (data);
            }
		});
		return suc;
	});
	
	$("#sub").click(function () {
		var value = "", count = 0;
		$("#lm").attr("action","fn1.php?v="+$("#o").html());
		$(":radio").each(function () {
			if ($(this).attr("checked")) {value = $(this).val();}
		});
		$(":checkbox").each(function () {
			if ($(this).attr("checked")) {count++;}
		});
		if (value == "") {alert("請選擇類型!!!"); return false;}
		switch (value) {
			case "t1" : if (count < 2) {alert("任選二、至少勾選2個號碼!!!");return false};break;
			case "t2" : if (count < 2) {alert("選二連直、至少勾選2個號碼!!!");return false};break;
			case "t3" : if (count < 2) {alert("選二連組、至少勾選2個號碼!!!");return false};break;
			case "t4" : if (count < 3) {alert("任選三、至少勾選3個號碼!!!");return false};break;
			case "t5" : if (count < 3) {alert("選三前直、至少勾選3個號碼!!!");return false};break;
			case "t6" : if (count < 3) {alert("選三前組、至少勾選3個號碼!!!");return false};break;
			case "t7" : if (count < 4) {alert("任選四、至少勾選4個號碼!!!");return false};break;
			case "t8" : if (count < 5) {alert("任選五、至少勾選5個號碼!!!");return false};break;
		}
	});
	
	$("#rn").click(function () {
		rm ();
	});
	
	$(":checkbox").click(function () {
		$(":radio").each(function () {
			if ($(this).attr("checked")) {
				check($(this).val());
			}
		});
	});
	
	function rm (){
		var box = $(":checkbox");
		box.css("display","inline");
		box.attr("checked","");
		box.attr("disabled","");
		$(".v").css("background","#fff");
	}
	
	function check(value) {
		var c = 0;
		var che = $(":checkbox")
		che.each(function () {
			if ($(this).attr("checked")) {
				c++;
				$("."+$(this).attr("id")).css("background","yellow");
			} else {
				$("."+$(this).attr("id")).css("background","#fff");
			}
		});
		
		if (value == "t1" || value == "t2" || value == "t3" || value == "t4" || value == "t5" || value == "t6") {
			if (c >=8) {atts (che,"disabled");} else {atts (che,"");}
		} else if (value == "t7" || value == "t8") {
			if (c >=6) {atts (che,"disabled");} else {atts (che,"");}
		}
	}
	function atts (che,value) {
		che.each(function () {
			if (!$(this).attr("checked")) {
				$(this).attr("disabled",value);
			}
		});
	}
});

function cRadio ($this) 
{
	var box = $(":checkbox");
	box.css("display","inline");
	box.attr("checked","");
	box.attr("disabled","");
	$(".v").css("background","#fff");
	$(".qw").attr("disabled","").css("color","#006600");
}

function getResult ($this)
{
	$(".nv_a").addClass("nv").removeClass("nv_a");
	$($this).removeClass("nv").addClass("nv_a");
	$(".nv_ab").removeClass("nv_ab");
	$($this).parent().addClass("nv_ab");
	var rowHtml = new Array();
	var data = stringByInt ($($this).html());
	//alert(data);
	for (var k in data)
	{
		rowHtml.push(data[k]);
	}
	$("#z_cl").html(rowHtml.join(''));
	$(".z_cl:even").addClass("hhg");
}
$(document).ready(function(){
	var url = location.href.split('/'); 
	
})