function submitformscq(){
	var money =  $("#money");
	var money_a = parseInt(money.val());
	var mix = parseInt($("#mix").html());
	var max1 = parseInt($("#max1").html());
	var max2 = parseInt($("#max2").html());
	var max3 = parseInt($("#max3").html());
	var max4 = parseInt($("#max4").html());
	var max5 = parseInt($("#max5").html());
	
	if (money.val() == "") {
		alert("請填寫下註金額!!!");
		money.focus();
		return false;
	}

	if (money_a < mix) {
		alert("最低下註金額："+mix+"￥");
		money.focus();
		return false;
	}

	if (money_a > max1) {
		alert("單注限額："+max1+"￥");
		money.focus();
		return false;
	}
	
	if ((money_a+max5) > max2) {
		alert("單號限額："+max2+"￥");
		money.focus();
		return false;
	}
	
	if ((money_a+max5) > max4) {
		alert("單期限額："+max4+"￥");
		money.focus();
		return false;
	}
	
	if (confirm("確定下註嗎？")){
		var s_cq = $(".actiionn");
		var a = s_cq.val()+","+money.val()+"|";
		s_cq.val(a);
		return true;
	}
	return false;
}

function only ($this) {
	var n = $($this);
	var r = /^\+?[1-9][0-9]*$/;
	if (!r.test(n.val())) {
		n.val("");
		$("#countOdds").html(0);
	} else {
		var odds = $("#odds").html();
		var pc = $("#pc").html();
		var m = (parseInt(n.val()) * odds - parseInt(n.val())) > pc ? pc : (n.val() * odds - parseInt(n.val())).toFixed(3);
		$("#countOdds").html(m);
	}
}