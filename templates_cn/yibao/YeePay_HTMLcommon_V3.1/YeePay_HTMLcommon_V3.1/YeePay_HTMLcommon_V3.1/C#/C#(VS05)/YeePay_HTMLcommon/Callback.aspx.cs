using System;
using System.Data;
using System.Configuration;
using System.Collections;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Web.UI.HtmlControls;
using com.yeepay.icc;
using com.yeepay.utils;

public partial class ICCCallback : System.Web.UI.Page
{

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            // 校验返回数据包
            Buy.logstr(FormatQueryString.GetQueryString("r6_Order"), Request.Url.Query, "");
            BuyCallbackResult result = Buy.VerifyCallback(FormatQueryString.GetQueryString("p1_MerId"), FormatQueryString.GetQueryString("r0_Cmd"), FormatQueryString.GetQueryString("r1_Code"), FormatQueryString.GetQueryString("r2_TrxId"),
                FormatQueryString.GetQueryString("r3_Amt"), FormatQueryString.GetQueryString("r4_Cur"), FormatQueryString.GetQueryString("r5_Pid"), FormatQueryString.GetQueryString("r6_Order"), FormatQueryString.GetQueryString("r7_Uid"),
                FormatQueryString.GetQueryString("r8_MP"), FormatQueryString.GetQueryString("r9_BType"), FormatQueryString.GetQueryString("rp_PayDate"), FormatQueryString.GetQueryString("hmac"));

            if (string.IsNullOrEmpty(result.ErrMsg))
            {
		//在接收到支付结果通知后，判断是否进行过业务逻辑处理，不要重复进行业务逻辑处理
                if (result.R1_Code == "1")
                {
                    if (result.R9_BType == "1")
                    {
                        //  callback方式:浏览器重定向
                        Response.Write("支付成功!" +
                            "<br>接口类型:" + result.R0_Cmd +
                            "<br>返回码:" + result.R1_Code +
                            //"<br>商户号:" + result.P1_MerId +
                            "<br>交易流水号:" + result.R2_TrxId +
                            "<br>商户订单号:" + result.R6_Order +

                            "<br>交易金额:" + result.R3_Amt +
                            "<br>交易币种:" + result.R4_Cur +
                            "<br>订单完成时间:" + result.Rp_PayDate +
                            "<br>回调方式:" + result.R9_BType +
                            "<br>错误信息:" + result.ErrMsg + "<BR>");
                    }
                    else if (result.R9_BType == "2")
                    {
                        // * 如果是服务器返回则需要回应一个特定字符串'SUCCESS',且在'SUCCESS'之前不可以有任何其他字符输出,保证首先输出的是'SUCCESS'字符串
                        Response.Write("SUCCESS");
                        Response.Write("支付成功!" +
                             "<br>接口类型:" + result.R0_Cmd +
                             "<br>返回码:" + result.R1_Code +
                             //"<br>商户号:" + result.P1_MerId +
                             "<br>交易流水号:" + result.R2_TrxId +
                             "<br>商户订单号:" + result.R6_Order +

                             "<br>交易金额:" + result.R3_Amt +
                             "<br>交易币种:" + result.R4_Cur +
                             "<br>订单完成时间:" + result.Rp_PayDate +
                             "<br>回调方式:" + result.R9_BType +
                             "<br>错误信息:" + result.ErrMsg + "<BR>");
                    }
                }
                else
                {
                    Response.Write("支付失败!" +
                             "<br>接口类型:" + result.R0_Cmd +
                             "<br>返回码:" + result.R1_Code +
                             //"<br>商户号:" + result.P1_MerId +
                             "<br>交易流水号:" + result.R2_TrxId +
                             "<br>商户订单号:" + result.R6_Order +

                             "<br>交易金额:" + result.R3_Amt +
                             "<br>交易币种:" + result.R4_Cur +
                             "<br>订单完成时间:" + result.Rp_PayDate +
                             "<br>回调方式:" + result.R9_BType +
                             "<br>错误信息:" + result.ErrMsg + "<BR>");
                }
            }
            else
            {
                Response.Write("交易签名无效!");
            }
        }
    }
}
