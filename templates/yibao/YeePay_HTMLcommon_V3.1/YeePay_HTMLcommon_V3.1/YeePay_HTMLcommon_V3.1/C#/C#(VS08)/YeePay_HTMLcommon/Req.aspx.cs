using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using com.yeepay.icc;

public partial class ICCBuyHKReq : System.Web.UI.Page
{
    protected string p1_MerId = Buy.GetMerId();

    protected string p2_Order;
    protected string p3_Amt;
    protected string p4_Cur;
    protected string p5_Pid;
    protected string p6_Pcat;

    protected string p7_Pdesc;
    protected string p8_Url;
    protected string p9_SAF;
    protected string pa_MP;
    protected string pd_FrpId;

    protected string pr_NeedResponse; 
    protected string hmac;

    protected string reqURL_onLine = Buy.GetBuyUrl();
    protected void Page_Load(object sender, EventArgs e)
    {
        // 设置 Response编码格式为GB2312
        Response.ContentEncoding = System.Text.Encoding.GetEncoding("gb2312");
        //1
        //p2_Order	商户平台订单号
        //若不为""，提交的订单号必须在自身账户交易中唯一;为""时，易宝支付会自动生成随机的商户订单号.
        p2_Order = Request.Form["p2_Order"];
        //p3_Amt	交易金额  精确两位小数，最小值为0.01,为持卡人实际要支付的金额.                 
        p3_Amt = Request.Form["p3_Amt"];
        //交易币种,固定值"CNY".
        p4_Cur = "CNY";
        //商品名称
        //用于支付时显示在易宝支付网关左侧的订单产品信息.
        p5_Pid = Request.Form["p5_Pid"];
        //商品种类
        p6_Pcat = Request.Form["p6_Pcat"];
        //2
        //商品描述
        p7_Pdesc = Request.Form["p7_Pdesc"];
        //商户接收支付成功数据的地址,支付成功后易宝支付会向该地址发送两次成功通知.
        p8_Url = Request.Form["p8_Url"];
        //送货地址
        //为“1”: 需要用户将送货地址留在易宝支付系统;为“0”: 不需要，默认为 ”0”.
        p9_SAF = "0";
        //商户扩展信息
        //商户可以任意填写1K 的字符串,支付成功时将原样返回.	
        pa_MP = Request.Form["pa_MP"];
        //银行编码
        //默认为""，到易宝支付网关.若不需显示易宝支付的页面，直接跳转到各银行、神州行支付、骏网一卡通等支付页面，该字段可依照附录:银行列表设置参数值.
        pd_FrpId = Request.Form["pd_FrpId"];
        //3
        //应答机制
        //默认为"1": 需要应答机制;
        pr_NeedResponse = "1";

        hmac = Buy.CreateBuyHmac(p2_Order, p3_Amt, p4_Cur, p5_Pid, p6_Pcat, p7_Pdesc, p8_Url, p9_SAF, pa_MP, pd_FrpId, pr_NeedResponse);
    }
}
