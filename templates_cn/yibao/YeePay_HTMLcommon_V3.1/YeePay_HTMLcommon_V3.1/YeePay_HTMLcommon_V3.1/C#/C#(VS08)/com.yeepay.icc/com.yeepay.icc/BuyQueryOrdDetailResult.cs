using System;

namespace com.yeepay.icc
{
	/// <summary>
	/// BuyQueryOrdDetailResult的实体类(查询的订单信息)
	/// </summary>
	[Serializable]
	public class BuyQueryOrdDetailResult
	{
        private string r0_Cmd;
        private string r1_Code;
        private string r2_TrxId;
        private string r3_Amt;
        private string r4_Cur;

        private string r5_Pid;
        private string r6_Order;
        private string r8_MP;
        private string rb_PayStatus;
        private string rc_RefundCount;

        private string rd_RefundAmt;
        private string hmac;
        private string errorMsg;


        /// <summary>
        /// 
        /// </summary>
        /// <param name="r0_Cmd"></param>
        /// <param name="r1_Code"></param>
        /// <param name="p1_MerId"></param>
        /// <param name="r2_TrxId"></param>
        /// <param name="r3_Amt"></param>
        /// <param name="r4_Cur"></param>
        /// <param name="r6_Order"></param>
        /// <param name="rb_PayStatus"></param>
        /// <param name="sd_paySuccessTime"></param>
        /// <param name="rc_RefundCount"></param>
        /// <param name="rd_RefundAmt"></param>
        /// <param name="pe_extInfo1"></param>
        /// <param name="pe_extInfo2"></param>
        /// <param name="pe_extInfo3"></param>
        /// <param name="pe_extInfo4"></param>
        /// <param name="errorMsg"></param>
        /// <param name="hmac"></param>
        /// <param name="errorMsg1"></param>
        public BuyQueryOrdDetailResult(string r0_Cmd, string r1_Code, string r2_TrxId, string r3_Amt, string r4_Cur, string r5_Pid,
            string r6_Order, string r8_MP, string rb_PayStatus, string rc_RefundCount, string rd_RefundAmt, string hmac, string errorMsg)
		{
            this.r0_Cmd = r0_Cmd;
            this.r1_Code = r1_Code;
            this.r2_TrxId = r2_TrxId;
            this.r3_Amt = r3_Amt;
            this.r4_Cur = r4_Cur;

            this.r5_Pid = r5_Pid;
            this.r6_Order = r6_Order;
            this.r8_MP = r8_MP;
            this.rb_PayStatus = rb_PayStatus;
            this.rc_RefundCount = rc_RefundCount;

            this.rd_RefundAmt = rd_RefundAmt;
            this.hmac = hmac;
            this.errorMsg = errorMsg;
		}

        public string R0_Cmd
        {
            get { return r0_Cmd; }
        }

        public string R1_Code
        {
            get { return r1_Code; }
        }

        public string R2_TrdId
        {
            get { return r2_TrxId; }
        }

        public string R3_Amt
        {
            get { return r3_Amt; }
        }

        public string R4_Cur
        {
            get { return r4_Cur; }
        }
        //---
        public string R5_Pid
        {
            get { return r5_Pid; }
        }

        public string R6_Order
        {
            get { return r6_Order; }
        }

        public string R8_MP
        {
            get { return r8_MP; }
        }

        public string Rb_PayStatus
        {
            get { return rb_PayStatus; }
        }

        public string Rc_RefundCount
        {
            get { return rc_RefundCount; }
        }
        //---
        public string Rd_RefundAmt
        {
            get { return rd_RefundAmt; }
        }

        public string Hmac
        {
            get { return hmac; }
        }

        public string ErrorMsg
        {
            get { return errorMsg; }
        }

	}
}
