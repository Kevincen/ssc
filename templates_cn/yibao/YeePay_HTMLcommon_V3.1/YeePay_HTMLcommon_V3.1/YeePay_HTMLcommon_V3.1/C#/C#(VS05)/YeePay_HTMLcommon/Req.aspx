<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Req.aspx.cs" Inherits="ICCBuyHKReq" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Untitled Page</title>
</head>
<body onload="document.yeepay.submit()">
    
    <form name="yeepay" action="<%=reqURL_onLine%>" method="post">
		<input type="hidden" name="p0_Cmd"					value="Buy"/>
		<input type="hidden" name="p1_MerId"				value="<%=p1_MerId%>"/>
		<input type="hidden" name="p2_Order"				value="<%=p2_Order%>"/>
		<input type="hidden" name="p3_Amt"					value="<%=p3_Amt%>"/>
		<input type="hidden" name="p4_Cur"					value="<%=p4_Cur%>"/>
		<input type="hidden" name="p5_Pid"					value="<%=p5_Pid%>"/>
		<input type="hidden" name="p6_Pcat"				    value="<%=p6_Pcat%>"/>
		<input type="hidden" name="p7_Pdesc"				value="<%=p7_Pdesc%>"/>
		<input type="hidden" name="p8_Url"				    value="<%=p8_Url%>"/>
		<input type="hidden" name="p9_SAF"					value="<%=p9_SAF%>"/>
		<input type="hidden" name="pa_MP"		            value="<%=pa_MP%>"/>
		<input type="hidden" name="pd_FrpId"			    value="<%=pd_FrpId%>"/>		
		<input type="hidden" name="pr_NeedResponse"			value="<%=pr_NeedResponse%>"/>
		<input type="hidden" name="hmac"					value="<%=hmac%>"/>
	</form>
</html>
