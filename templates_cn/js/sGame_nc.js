/*****************************
 * 新增快捷和正常投注
 *****************************/
function kuijie(){
    $('#td_input_money').css('display','inline');
    $('#td_input_money1').css('display','inline');
    if(!$('#kuijie').hasClass('on')){
        $('#kuijie').addClass('on');
        $('#yiban').removeClass('on');
        var i=0;
        $('.tt').each(function(){
            $(this).prev().attr('align','center')
            $(this).hide();
            //$(this).css('display','none');
        })
        $('.wqs').each(function(){
            $(this).find("colgroup").html('<col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125"><col class="col_single w125"><col class="w125">');
        })
        /*添加效果*/
        $('.caption_1,.o').bind({'mouseenter':function(){
            if( $(this).attr('title')!='选中' ){ //未选中
                if($(this).hasClass('o') && $(this).prev().hasClass('caption_1')){
                    $(this).css({'background-color':'#ffd094','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#ffd094','cursor':'pointer'});
                }
                if(($(this).hasClass('caption_1')||$(this).attr('class').indexOf('No_')>=0) && $(this).next().hasClass('o')){
                    $(this).next().css({'background-color':'#ffd094','cursor':'pointer'});
                    $(this).css({'background-color':'#ffd094','cursor':'pointer'});
                }
            }

        },'mouseleave':function(){
            if( $(this).attr('title')!='选中' ){ //未选中
                if($(this).hasClass('o') && $(this).prev().hasClass('caption_1')){
                    $(this).css({'background-color':'#fff','cursor':'pointer'});
                    $(this).prev().css({'background-color':'#FDF8F2','cursor':'pointer'});
                }
                if($(this).hasClass('caption_1') && $(this).next().hasClass('o')){
                    $(this).next().css({'background-color':'#fff','cursor':'pointer'});
                    $(this).css({'background-color':'#FDF8F2','cursor':'pointer'});
                }
            }
        },'click':function(){
            if($(this).hasClass('o') && $(this).prev().hasClass('caption_1')){
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
            if($(this).hasClass('caption_1') && $(this).next().hasClass('o')){
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
    if(!$('#yiban').hasClass('on')){
        $('#yiban').addClass('on');
        $('#kuijie').removeClass('on');
        $('.tt').each(function(){
            $(this).prev().width( 45 );
            $(this).show();
        })
        $('.wqs').each(function(){
            $(this).find("colgroup").html('<col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8"> <col class="col_single w8"> <col class="w8"> <col class="w8">');
        })

    }
    $('.caption_1,.o').unbind('mouseenter').unbind('mouseleave').unbind('click');
    $('.caption_1').css({'background-color':'#FDF8F2','cursor':''});
    $('.o').css({'background-color':'#fff','cursor':''});
    $('#td_input_money').hide();
    $('#td_input_money1').hide();
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
    $('.tt').each(function(){
        if(  $(this).prev().attr('title')=='选中' ){ //已选中
            $(this).find('input').val( $('#AllMoney').val() );
            sel=true;
        }
    })
    return sel;
}
function iSubmit(){
    if($('#kuijie').hasClass('on')){
        var sel = AllMoney();
        if(sel==false){
            my_alert('您未选择号码！');
            return false;
        }
    }
    return true;
}

$(function () {
	$('#kuijie').bind('click',function(){
		kuijie();							   
	})
	$('#yiban').bind('click',function(){
		yiban();							   
	})
    kuijie();

	action();
	$("#dp").attr("action","./inc/DataProcessingnc.php?t="+encodeURI($("#tys").html()));

    if (typeof  common_action_set != undefined) {
        common_action_set(function() {
            $("#submit_top,#submit_bottom").click();
        });
    }
	//POST提交表單
	$("#submit_top,#submit_bottom").click(function () {
		if(iSubmit()==false)return false;
		var suc = true;
		$.ajax ({type:"post",url:URL,dataType:"text",async:false,data:{typeid:"postodds"},success : function (data) {
				suc = postodds (data);
                MyReset();
            }
		});
		 
		return suc;
	});
	
	$("#sub").click(function () {//连码
		var value = "", count = 0;
		$("#lm").attr("action","fn9.php?v="+$("#o").html());
		$(":radio").each(function () {
			if ($(this).attr("checked")) {value = $(this).val();}
		});
		$(":checkbox").each(function () {
			if ($(this).attr("checked")) {count++;}
		});
		if (value == "") {alert("請選擇類型!!!"); return false;}
		switch (value) {
			case "t1" : if (count < 1) {alert("蔬菜单选、至少勾選1种蔬菜!!!");return false};break;
			case "t2" : if (count < 1) {alert("动物单选、至少勾選1种动物!!!");return false};break;
			case "t3" : if (count < 2) {alert("幸运二、至少勾選2個號碼!!!");return false};break;
			case "t4" : if (count < 2) {alert("连连中、至少勾選2個號碼!!!");return false};break;
			case "t5" : if (count < 2) {alert("背靠背、至少勾選2個號碼!!!");return false};break;
			case "t6" : if (count < 3) {alert("幸运三、至少勾選3個號碼!!!");return false};break;
			case "t7" : if (count < 4) {alert("幸运四、至少勾選4個號碼!!!");return false};break;
			case "t8" : if (count < 5) {alert("幸运五、至少勾選5個號碼!!!");return false};break;
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
		
		if ( value == "t3" || value == "t4" || value == "t5" || value == "t6") {
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
	//alert($this.value);
/*	var box = $(":checkbox");
	box.css("display","inline");
	box.attr("checked","");
	box.attr("disabled","");

	if($this.value=='t1'){
		var discheck1= $("#t19");
		discheck1.css("display","inline");
		discheck1.attr("checked","");
		discheck1.attr("disabled","disabled");
		var discheck2= $("#t20");
		discheck2.css("display","inline");
		discheck2.attr("checked","");
		discheck2.attr("disabled","disabled");
	}
	
	if($this.value=='t2'){
		box.css("display","inline");
		box.attr("checked","");
		box.attr("disabled","disabled");
		
		var discheck1= $("#t19");
		discheck1.css("display","inline");
		discheck1.attr("checked","");
		discheck1.attr("disabled","");
		var discheck2= $("#t20");
		discheck2.css("display","inline");
		discheck2.attr("checked","");
		discheck2.attr("disabled","");
	}
	$(".v").css("background","#fff");
	$(".qw").attr("disabled","").css("color","#006600");*/
}

function getResult ($this)
{
/*	$(".nv_a").addClass("nv").removeClass("nv_a");
	$($this).removeClass("nv").addClass("nv_a");*/
    $('.kon').removeClass('kon');
    $($this).addClass("kon");
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

