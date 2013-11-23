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

    public partial class QueryOrderStatus : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            // 商家的交易定单号
            string p2_Order = Request.Form["p2_Order"];
            try
            {
                // 查询订单
                
                BuyQueryOrdDetailResult result = Buy.QueryOrdDetail(p2_Order);
                
                
                if (result.ErrorMsg=="")
                {
                    if (result.R1_Code == "1")
                    {
                        Response.Write("查询成功!");

                        Response.Write("<br>接口类型:" + result.R0_Cmd);
                        Response.Write("<br>返回码:" + result.R1_Code);                   
                        Response.Write("<br>交易流水号:" + result.R2_TrdId);
                        Response.Write("<br>交易金额:" + result.R3_Amt);

                        Response.Write("<br>交易币种:" + result.R4_Cur);
                        Response.Write("<br>商品名称:" + result.R5_Pid);
                        Response.Write("<br>商户订单号:" + result.R6_Order);
                        Response.Write("<br>商户扩展信息:" + result.R8_MP);
                        Response.Write("<br>支付状态:" + result.Rb_PayStatus);
                        Response.Write("<br>已退款次数:" + result.Rc_RefundCount);

                        Response.Write("<br>已退款金额:" + result.Rd_RefundAmt);                                            
                        Response.Write("<br>返回信息:" + result.ErrorMsg);                                            
                    }
                    else
                    {
                        Response.Write("查询失败!");

                        Response.Write("<br>接口类型:" + result.R0_Cmd);
                        Response.Write("<br>返回码:" + result.R1_Code);
                        Response.Write("<br>交易流水号:" + result.R2_TrdId);
                        Response.Write("<br>交易金额:" + result.R3_Amt);

                        Response.Write("<br>交易币种:" + result.R4_Cur);
                        Response.Write("<br>商品名称:" + result.R5_Pid);
                        Response.Write("<br>商户订单号:" + result.R6_Order);
                        Response.Write("<br>商户扩展信息:" + result.R8_MP);
                        Response.Write("<br>支付状态:" + result.Rb_PayStatus);
                        Response.Write("<br>已退款次数:" + result.Rc_RefundCount);

                        Response.Write("<br>已退款金额:" + result.Rd_RefundAmt);
                        Response.Write("<br>返回信息:" + result.ErrorMsg); 

                        Response.Write("<br>返回信息:" + result.ErrorMsg);        
                    }
                }
                else
                {
                    Response.Write("查询返回" + result.ErrorMsg);
                }
            }
            catch (Exception ex)
            {
                Response.Write(ex.Message);
            }
        }
    }
