<%@page language="java" contentType="text/html;charset=gbk"%>
<%@page import="com.yeepay.PaymentForOnlineService,com.yeepay.RefundResult;"%>
<%!	String formatString(String text){ 
			if(text == null) {
				return ""; 
			}
			return text;
		}
%>
<%
	request.setCharacterEncoding("GBK");
	String pb_TrxId     	= formatString(request.getParameter("pb_TrxId"));   	//易宝交易流水号
	String p3_Amt     		= formatString(request.getParameter("p3_Amt"));		//退款金额
	String p4_Cur     		= formatString(request.getParameter("p4_Cur"));		//交易币种
	String p5_Desc     		= formatString(request.getParameter("p5_Desc"));		//退款说明
	//new String(formatString(request.getParameter("p5_Desc")).getBytes("iso-8859-1"),"gbk");//中文转码的例子
	try {
		RefundResult rr = PaymentForOnlineService.refundByTrxId(pb_TrxId,p3_Amt,p4_Cur,p5_Desc);	// 调用后台外理查询方法
		out.println("业务类型 [r0_Cmd:" + rr.getR0_Cmd() + "]<br>");
		out.println("查询结果 [r1_Code:" + rr.getR1_Code() + "]<br>");
		out.println("易宝支付交易流水号 [r2_TrxId:" + rr.getR2_TrxId() + "]<br>");
		out.println("支付金额 [r3_Amt:" + rr.getR3_Amt() + "]<br>");
		out.println("交易币种 [r4_Cur:" + rr.getR4_Cur() + "]<br>");
	} catch(Exception e) {
		//byte[] by = e.getMessage().getBytes("UTF-8");
		
		//String errMsg = new String(by,"GBK");
		out.println("Refund fail:" + e.getMessage());
	}
%>

