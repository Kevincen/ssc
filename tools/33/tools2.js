	(function(){
		var HourRound;
		var MinutesRound;
		var SecondsRound;
		var Number;
		var EndTime;
		var Count = 180, Stamp = 0, Lock = 60;
		var URL = "tools2.php?date=";
		$(function(){getNumber();});
	
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
							setTimeout(getNumber, 2000);
							return false;
						}
					}
				},
				success:function(data){
				if(data!=null){
					if (data.error == 0){
						Number = data.number;
						Stamp = data.endTime;
						EndTime = $("#endTime_s");
						$("#number_s").html("第"+Number+"期");
						serNumberPlanning1(Number);
						stratSetTime();
					} else if (data.error == 9){
						$("#number_s").html("自動開獎已被關閉");
						setTimeout(getNumber, 5000);
					}
				}else {getNumber();}
				}
			});
		}
		
		//----倒計時
		function stratSetTime(){
			if (Stamp < 1){
				EndTime.html("正在讀取開獎號碼");
				setNumberAndPlanning(URL);
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
			$.post(URL+ +new Date(), { pid : "2"}, function(data){
				if (data == 1){
					serNumberPlanning();
					return;
				} else if(data == 2){
					getNumber();
					return;
				}
			}, "text");
		}
		
		//----讀取開獎號碼
		function serNumberPlanning() {
			Lock--;
			$.post(URL+ +new Date(), { pid : "4", numberid : Number }, function(data){
				if (data == 1 || Lock <= 0){
					Lock = 60;
					getNumber();
					return;
				} else {
					setTimeout(serNumberPlanning, 3500);
				}
			}, "text");
		}

		function serNumberPlanning1(Number1) {
			$.post(URL+ +new Date(), { pid : "4", numberid : (Number1-1) }, function(data){
				if (data == 1){
					return;
				} else {
					setTimeout(function(){serNumberPlanning1(Number1)}, 3500);
				}
			}, "text");
		}


	})();