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

    public partial class Refund : System.Web.UI.Page
    {
        protected void Page_Load(object sender, EventArgs e)
        {
            // 设置 Response编码格式为GB2312
            Response.ContentEncoding = System.Text.Encoding.GetEncoding("gb2312");

            string pb_TrxId = Request.Form["pb_TrxId"];
            string p3_Amt = Request.Form["p3_Amt"];
            string p4_Cur = Request.Form["p4_Cur"];
            string p5_Desc = Request.Form["p5_Desc"];
            
            try
            {
                BuyRefundOrdResult result = Buy.RefundOrd(pb_TrxId, p3_Amt, p4_Cur, p5_Desc);

                if (result.ErrorMsg == "")
                {
                    if (result.R1_Code == "1")
                    {
                        Response.Write("退款成功!" +
                            "<br>接口类型:" + result.R0_Cmd +
                            "<br>返回码:" + result.R1_Code +
                            "<br>交易流水号:" + result.R2_TrxId +
                            "<br>退款金额:" + result.R3_Amt +

                            "<br>退款币种:" + result.R4_Cur
                            );

                    }
                    else
                    {
                        Response.Write("退款失败!" +
                            "<br>接口类型:" + result.R0_Cmd +
                            "<br>返回码:" + result.R1_Code +
                            "<br>交易流水号:" + result.R2_TrxId +
                            "<br>退款金额:" + result.R3_Amt +

                            "<br>退款币种:" + result.R4_Cur
                            );
                    }
                }
                else
                {
                    Response.Write("退款返回"+result.ErrorMsg);
                }

            }
            catch (Exception ex)
            {
                Response.Write(ex.ToString());
            }
        }
    }

