using System;
using System.Web;
using System.Configuration;
using com.yeepay.utils;

namespace com.yeepay.icc
{
	/// <summary>
	/// B2C在线支付类
	/// </summary>
	public abstract class Buy
	{
		/// <summary>
		/// 构造函数
		/// </summary>
        public Buy()
		{
		
		}
      //支付的请求地址
      private static string nodeAuthorizationURL = ConfigurationManager.AppSettings["authorizationURL"];

      //查询退款的请求地址
      private static string queryRefundReqURL = ConfigurationManager.AppSettings["queryRefundReqURL"];

      // 商户编号
      private static string merchantId = ConfigurationManager.AppSettings["merhantId"];

      // 商户密钥
      private static string keyValue = ConfigurationManager.AppSettings["keyValue"];

		#region 创建支付请求 Url
		
		/// <summary>
        /// 创建Get方式提交的支付请求串
		/// </summary>
		/// <param name="p2_Order"></param>
		/// <param name="p3_Amt"></param>
		/// <param name="p4_Cur"></param>
		/// <param name="p5_Pid"></param>
		/// <param name="p6_Price"></param>
		/// <param name="p7_Pcount"></param>
		/// <param name="p8_Pdesc"></param>
		/// <param name="p9_Url"></param>
		/// <param name="pb_ServerNotifyUrl"></param>
		/// <param name="pb_firstName"></param>
		/// <param name="pb_familyName"></param>
		/// <param name="pb_phone"></param>
		/// <param name="pb_email"></param>
        /// <param name="pp_firstName"></param> 
        /// <param name="pp_familyName"></param> 
        /// <param name="pp_ID"></param> 
        /// <param name="pp_nationality"></param> 
        /// <param name="pp_timeDiff"></param> 
        /// <param name="pp_offCountry"></param>
        /// <param name="pp_transferCountry"></param> 
        /// <param name="pp_destinationCountry"></param>
		/// <param name="pe_extInfo1"></param>
		/// <param name="pe_extInfo2"></param>
		/// <param name="pe_extInfo3"></param>
		/// <param name="pe_message"></param>
		/// <param name="hmac"></param>
		/// <returns></returns>
      public static string GetBuyUrl() { return nodeAuthorizationURL; }
      public static string GetMerId() { return merchantId; }

        public static string CreateBuyHmac(string p2_Order, string p3_Amt, string p4_Cur, string p5_Pid, string p6_Pcat, string p7_Pdesc, 
            string p8_Url, string p9_SAF, string pa_MP, string pd_FrpId, string pr_NeedResponse)
		{
			string sbOld = "";
            //1
            sbOld += "Buy";
            sbOld += merchantId;
            sbOld += p2_Order;
            sbOld += p3_Amt;
            sbOld += p4_Cur;
            //2
            sbOld += p5_Pid;
            sbOld += p6_Pcat;
            sbOld += p7_Pdesc;
            sbOld += p8_Url;
            sbOld += p9_SAF;
            //3
            sbOld += pa_MP;
            sbOld += pd_FrpId;
            sbOld += pr_NeedResponse;
            //生成hmac
            string hmac = Digest.HmacSign(sbOld, keyValue);
            logstr(p2_Order, sbOld, hmac);
            string sForm = "";
              sForm += "<form name='yeepay' action='" + nodeAuthorizationURL + "' method='post'> \r\n ";
              sForm += "<input type='hidden' name='p0_Cmd'	value='Buy'>\r\n";
              sForm += "<input type='hidden' name='p1_MerId'	value='" + merchantId + "'>\r\n";
              sForm += "<input type='hidden' name='p2_Order'	value='"+p2_Order+"'>\r\n";
              sForm += "<input type='hidden' name='p3_Amt'	value='" + p3_Amt + "'>\r\n";
              sForm += "<input type='hidden' name='p4_Cur'	value='"+p4_Cur+"'>\r\n";
              sForm += "<input type='hidden' name='p5_Pid'	value='"+p5_Pid+"'>\r\n";
              sForm += "<input type='hidden' name='p6_Pcat'	value='" + p6_Pcat + "'>\r\n";
              sForm += "<input type='hidden' name='p7_Pdesc'	value='" + p7_Pdesc + "'>\r\n";
              sForm += "<input type='hidden' name='p8_Url'	value='" + p8_Url + "'>\r\n";
              sForm += "<input type='hidden' name='p9_SAF'	value='" + p9_SAF + "'>\r\n";  
              sForm += "<input type='hidden' name='pa_MP'	value='" + pa_MP + "'>\r\n";
              sForm += "<input type='hidden' name='pd_FrpId'	value='" + pd_FrpId + "'>\r\n";
              sForm += "<input type='hidden' name='pr_NeedResponse'	value='" + pr_NeedResponse + "'>\r\n"; 
              sForm += "<input type='hidden' name='hmac'	value='"+hmac+"'>\r\n";
              sForm += "</form>\r\n";
             logstr(p2_Order, sForm, "");
            

			return hmac;
		}

		#endregion
		
        /// <summary>
        /// 验证返回结果
        /// </summary>
        /// <param name="r0_Cmd"></param>
        /// <param name="r1_Code"></param>
        /// <param name="p1_MerId"></param>
        /// <param name="r2_TrxId"></param>
        /// <param name="p2_Order"></param>
        /// <param name="p3_Amt"></param>
        /// <param name="p4_cur"></param>
        /// <param name="rp_PayDate"></param>
        /// <param name="r9_BType"></param>
        /// <param name="pe_extInfo1"></param>
        /// <param name="pe_extInfo2"></param>
        /// <param name="pe_extInfo3"></param>
        /// <param name="pe_extInfo4"></param>
        /// <param name="errMsg"></param>
        /// <param name="hmac"></param>
        /// <returns></returns>
        public static BuyCallbackResult VerifyCallback(string p1_MerId, string r0_Cmd, string r1_Code, string r2_TrxId, string r3_Amt,
            string r4_Cur, string r5_Pid, string r6_Order, string r7_Uid, string r8_MP, string r9_BType, string rp_PayDate, string hmac)
		{
			string sbOld="";

            sbOld += p1_MerId;
            sbOld += r0_Cmd;
            sbOld += r1_Code;
            sbOld += r2_TrxId;
            sbOld += r3_Amt;

            sbOld += r4_Cur;
            sbOld += r5_Pid;
            sbOld += r6_Order;
            sbOld += r7_Uid;
            sbOld += r8_MP;

            sbOld += r9_BType;

            string nhmac = Digest.HmacSign(sbOld, keyValue);
            logstr(r6_Order, sbOld, nhmac);
            if (nhmac == hmac)
			{
                return new BuyCallbackResult(p1_MerId,r0_Cmd, r1_Code, r2_TrxId, r3_Amt, r4_Cur, r5_Pid, r6_Order, r7_Uid, r8_MP, r9_BType,
                    rp_PayDate, hmac, "");
			}
			else
			{
                return new BuyCallbackResult(p1_MerId,r0_Cmd, r1_Code, r2_TrxId, r3_Amt, r4_Cur, r5_Pid, r6_Order, r7_Uid, r8_MP, r9_BType,
                    rp_PayDate, hmac, "交易签名被篡改");
			}
		}


		#region BuyQueryOrdDetailResult 查询订单明细(通讯)
		/// <summary>
		/// 查询订单明细
		/// </summary>
		/// <param name="p1_MerId">商户编号</param>
		/// <param name="keyValue">商户密钥</param>
		/// <param name="p2_Order">商户订单号</param>
		/// <returns>BuyQueryOrdDetailResult</returns>
		public static BuyQueryOrdDetailResult QueryOrdDetail(string p2_Order)
		{
			string sbOld = "";

            sbOld += "QueryOrdDetail";
			sbOld += merchantId;
			sbOld += p2_Order;

           string hmac = Digest.HmacSign(sbOld, keyValue);
           logstr(p2_Order, sbOld, hmac);
		   string para = "";

            para += "?p0_Cmd=QueryOrdDetail";
			para += "&p1_MerId=" + merchantId;	    	//加入商家ID
			para += "&p2_Order=" + p2_Order;				//加入购买订单号码
            para += "&hmac=" + hmac;      	    //加入校验码

            logstr(p2_Order, queryRefundReqURL+para, "");

           string reqResult = HttpUtils.SendRequest(queryRefundReqURL, para);
            //记录查询通讯返回
            logstr(p2_Order, reqResult,"");
			string r0_Cmd		= FormatQueryString.GetQueryString("r0_Cmd", reqResult, '\n');
			string r1_Code		= FormatQueryString.GetQueryString("r1_Code", reqResult, '\n');
            string p1_MerId     = FormatQueryString.GetQueryString("p1_MerId", reqResult, '\n');
			string r2_TrxId		= FormatQueryString.GetQueryString("r2_TrxId", reqResult, '\n');
			string r3_Amt		= FormatQueryString.GetQueryString("r3_Amt", reqResult, '\n');

			string r4_Cur		= FormatQueryString.GetQueryString("r4_Cur", reqResult, '\n');
            string r5_Pid       = FormatQueryString.GetQueryString("r5_Pid", reqResult, '\n');
		    string r6_Order		= FormatQueryString.GetQueryString("r6_Order", reqResult, '\n');
            string r8_MP        = FormatQueryString.GetQueryString("r8_MP", reqResult, '\n');
            string rb_PayStatus = FormatQueryString.GetQueryString("rb_PayStatus", reqResult, '\n');
            string rc_RefundCount = FormatQueryString.GetQueryString("rc_RefundCount", reqResult, '\n');

            string rd_RefundAmt = FormatQueryString.GetQueryString("rd_RefundAmt", reqResult, '\n');
            hmac = FormatQueryString.GetQueryString("hmac", reqResult, '\n');
            //查单返回校验hmac
            sbOld = "";
            sbOld += r0_Cmd;
            sbOld += r1_Code;
            sbOld += p1_MerId;
            sbOld += r2_TrxId;
            sbOld += r3_Amt;

            sbOld += r4_Cur;
            sbOld += r5_Pid;
            sbOld += r6_Order;
            sbOld += r8_MP;
            sbOld += rb_PayStatus;
            sbOld += rc_RefundCount;

            sbOld += rd_RefundAmt;

            string nhmac = Digest.HmacSign(sbOld,keyValue);
            logstr(p2_Order,sbOld,nhmac);
            if (hmac == nhmac)
            {
                BuyQueryOrdDetailResult result = new BuyQueryOrdDetailResult(r0_Cmd, r1_Code, r2_TrxId, r3_Amt, r4_Cur, r5_Pid,
             r6_Order, r8_MP, rb_PayStatus, rc_RefundCount, rd_RefundAmt, hmac, "");

                return result;
            }
            else
            {
                BuyQueryOrdDetailResult result = new BuyQueryOrdDetailResult(r0_Cmd, r1_Code, r2_TrxId, r3_Amt, r4_Cur, r5_Pid,
             r6_Order, r8_MP, rb_PayStatus, rc_RefundCount, rd_RefundAmt, hmac, "交易签名无效");

                return result;
            }

		}
		#endregion

		#region BuyRefundOrdResult 退款(通讯)
		/// <summary>
		/// 退款
		/// </summary>
		/// <param name="p1_MerId">商户编号</param>
		/// <param name="keyValue">商户密钥</param>
		/// <param name="pb_TrxId">yeepay流水号</param>
		/// <param name="p3_Amt">退款金额</param>
		/// <param name="p4_Cur">币种</param>
		/// <param name="p5_Desc">退款说明</param>
		/// <returns></returns>
        public static BuyRefundOrdResult RefundOrd(string pb_TrxId, string p3_Amt, string p4_Cur, string p5_Desc)
		{
			string sbOld = "";

            sbOld += "RefundOrd";
            sbOld += merchantId;
            sbOld += pb_TrxId;
			sbOld += p3_Amt;
			sbOld += p4_Cur;
            sbOld += p5_Desc;			

            string hmac = Digest.HmacSign(sbOld, keyValue);
            logstr(pb_TrxId, sbOld, hmac);
			string para = "";

            para += "?p0_Cmd=RefundOrd";
            para += "&p1_MerId=" + merchantId;	    	//加入商家ID
            para += "&pb_TrxId=" + pb_TrxId;
			para += "&p3_Amt=" + p3_Amt;				//加入购买订单号码
			para += "&p4_Cur=" + p4_Cur;

            para += "&p5_Desc=" + HttpUtility.UrlEncode(p5_Desc, System.Text.Encoding.GetEncoding("gb2312"));
            para += "&hmac=" + hmac;      	    //加入校验码

            logstr(pb_TrxId, queryRefundReqURL + para, "");

            string reqResult = HttpUtils.SendRequest(queryRefundReqURL, para);

            //记录退款通讯返回
            logstr(pb_TrxId, reqResult, "");

			string r0_Cmd	= FormatQueryString.GetQueryString("r0_Cmd", reqResult, '\n');	
			string r1_Code	= FormatQueryString.GetQueryString("r1_Code", reqResult, '\n');
			string r2_TrxId	= FormatQueryString.GetQueryString("r2_TrxId", reqResult, '\n');
			string r3_Amt	= FormatQueryString.GetQueryString("r3_Amt", reqResult, '\n');

			string r4_Cur	= FormatQueryString.GetQueryString("r4_Cur", reqResult, '\n');
            hmac = FormatQueryString.GetQueryString("hmac", reqResult, '\n');
            //校验返回的hmac
            sbOld = "";
            sbOld += r0_Cmd;
            sbOld += r1_Code;
            sbOld += r2_TrxId;
            sbOld += r3_Amt;

            sbOld += r4_Cur;

            string nhmac=Digest.HmacSign(sbOld,keyValue);
            logstr("退款返回流水号："+r2_TrxId,sbOld,nhmac);
            if (hmac == nhmac)
            {
                BuyRefundOrdResult result = new BuyRefundOrdResult(r0_Cmd, r1_Code, r2_TrxId, r3_Amt,
               r4_Cur, hmac,"");
                return result;
            }
            else
            {
                BuyRefundOrdResult result = new BuyRefundOrdResult(r0_Cmd, r1_Code, r2_TrxId, r3_Amt,
               r4_Cur, hmac,"交易签名无效");
                return result;
            }            
		}
		#endregion



        //日志
        public static void logstr(string orderid, string str,string hmac)
        {
            try
            {
                System.IO.StreamWriter sw = new System.IO.StreamWriter(System.Web.HttpContext.Current.Server.MapPath("YeePay_HTMLCommon.log"), true);
                sw.BaseStream.Seek(0, System.IO.SeekOrigin.End);
                sw.WriteLine(DateTime.Now.ToString() + "[" + orderid + "]" + "[" + str + "]" + "[" + hmac + "]");
                sw.Flush();
                sw.Close();
            }
            catch (Exception e)
            {
                Console.WriteLine(e);
            }
        }
	}
}