<%@page language="java" contentType="text/html;charset=gbk"%>
<%@page import="com.yeepay.PaymentForOnlineService,com.yeepay.QueryResult"%>
<%!	String formatString(String text){ if(text == null) return "";  return text;}%>
<%
	String p2_Order   = formatString(request.getParameter("p2_Order"));     			// 商家要查询的交易定单号
	try {
		QueryResult qr = PaymentForOnlineService.queryByOrder(p2_Order);	// 调用后台外理查询方法
		out.println("业务类型 [r0_Cmd:" + qr.getR0_Cmd() + "]<br>");
		out.println("查询结果 [r1_Code:" + qr.getR1_Code() + "]<br>");
		out.println("易宝支付交易流水号 [r2_TrxId:" + qr.getR2_TrxId() + "]<br>");
		out.println("支付金额 [r3_Amt:" + qr.getR3_Amt() + "]<br>");
		out.println("交易币种 [r4_Cur:" + qr.getR4_Cur() + "]<br>");
		out.println("商品名称 [r5_Pid:" + qr.getR5_Pid() + "]<br>");
		out.println("商户订单号 [r6_Order:" + qr.getR6_Order() + "]<br>");
		out.println("商户扩展信息 [r8_MP:" +  qr.getR8_MP() + "]<br>");
		out.println("支付状态 [rb_PayStatus:" +  qr.getRb_PayStatus() + "]<br>");
		out.println("已退款次数 [rc_RefundCount:" + qr.getRc_RefundCount() + "]<br>");
		out.println("已退款金额 [rd_RefundAmt:" + qr.getRd_RefundAmt() + "]<br>");
	} catch(Exception e) {
		out.println(e.getMessage());
	}
%>


