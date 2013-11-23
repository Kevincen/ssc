(function(){
	var HourRound;
	var MinutesRound;
	var SecondsRound;
	var Number;
	var EndTime;
	var URL = "toolsgx.php?date=";
	var Count = 180, Stamp = 0, Lock = 60,Lock1 = 0;
	$(function(){
		getNumber();
		setInterval(function() {
			$.post (URL, { pid : "3"}, function (data){}, "text");
		}, 300000);
	});

	//----讀取已開盤的時間
	function getNumber()
	{
		$.ajax({
			type : "POST",
			data : {pid : "1"},
			url : URL+ +new Date(),
			dataType : "json",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						getNumber();
						return false;
					}
				}
			},
			success:function(data){
				if (data.error == 0){
					Number = data.number;
					Stamp = data.endTime;
					EndTime = $("#endTime_gxs");
					$("#number_gxs").html("第"+Number+"期");
					serNumberPlanning1(Number);
					stratSetTime();
				} else if (data.error == 9){
					$("#number_gxs").html("自動開獎已被關閉");
					setTimeout(getNumber, 5000);
				}
			}
		});
	}
	
	//----倒計時
	function stratSetTime(){
		if (Stamp < 1){
			if(Number.substring(7)==50){
			EndTime.html("盘期结束，已封盘。");
			}
			else{
			EndTime.html("正在讀取開獎號碼");
			setNumberAndPlanning(URL);
			}
			return false;
		}
		else if (Count < 1 && Stamp > 10){
			Count = 180;
			getNumber();
			return;
		}
		HourRound = Math.floor(Stamp / 60 / 60);
		MinutesRound = Math.floor(Stamp / 60 - (60 * HourRound));
		SecondsRound = Math.round(Stamp - (60 * 60 * HourRound) - (60 * MinutesRound));
		EndTime.html( HourRound+ ":"+ MinutesRound + ":" + SecondsRound);
		Stamp--;
		Count--;
		setTimeout(stratSetTime, 1000);
	}
	
	//----設置下一期開獎信息
	function setNumberAndPlanning(){
		$.ajax({
			type : "POST",
			data : {pid : "2"},
			url : URL+ +new Date(),
			dataType : "text",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						getNumber();
						return false;
					}
				}
			},
			success:function(data){
				if (data == 1){
					serNumberPlanning();
					return;
				} else if(data == 2){
					getNumber();
					return;
				}
			}
		});
	}
	
	//----讀取開獎號碼
	function serNumberPlanning() {
		Lock--;
		$.ajax({
			type : "POST",
			data : {pid : "4", numberid : Number},
			url : URL+ +new Date(),
			dataType : "text",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						Lock = 60;
						setTimeout(serNumberPlanning, 3000);
						return false;
					}
				}
			},
			success:function(data){
				if (data == 1 || Lock <= 0){
					Lock = 60;
					getNumber();
					return false;
				} else {
					setTimeout(serNumberPlanning, 3000);
				}
			}
		});
	}

	function serNumberPlanning1(Number1) {
		$.ajax({
			type : "POST",
			data : {pid : "4", numberid : (Number1-1)},
			url : URL+ +new Date(),
			dataType : "text",
			error : function(XMLHttpRequest, textStatus, errorThrown){
				if (XMLHttpRequest.readyState == 4){
					if (XMLHttpRequest.status == 500){
						setTimeout(serNumberPlanning1(Number1), 3000);
						return false;
					}
				}
			},
			success:function(data){
				if (data == 1){
					$("#test_gxs").html("OK");
					return false;
				} else {
					$("#test_gxs").html(Lock1++);
					setTimeout(function(){serNumberPlanning1(Number1)}, 3000);
				}
			}
		});
	}


})();