using System;

namespace com.yeepay.icc
{
	[Serializable]
    
	public class BuyCallbackResult
	{
		// 定义内部变量
        private string p1_MerId;
        private string r0_Cmd;
        private string r1_Code;
        private string r2_TrxId;
        private string r3_Amt;

        private string r4_Cur;
        private string r5_Pid;
        private string r6_Order;
        private string r7_Uid;
        private string r8_MP;

        private string r9_BType;
        private string rp_PayDate;
        private string hmac;
        private string errMsg;


    /// <summary>
    /// 
    /// </summary>
    /// <param name="r0_Cmd"></param>
    /// <param name="r1_Code"></param>
    /// <param name="r2_TrxId"></param>
    /// <param name="p1_MerId"></param>
    /// <param name="p2_Order"></param>
    /// <param name="p3_Amt"></param>
    /// <param name="p4_Cur"></param>
    /// <param name="rp_PayDate"></param>
    /// <param name="r9_BType"></param>
    /// <param name="pe_extInfo1"></param>
    /// <param name="pe_extInfo2"></param>
    /// <param name="pe_extInfo3"></param>
    /// <param name="pe_extInfo4"></param>
    /// <param name="errMsg"></param>
    /// <param name="hmac"></param>
    /// <param name="errMsg1"></param>
        public BuyCallbackResult(string p1_MerId, string r0_Cmd, string r1_Code, string r2_TrxId, string r3_Amt,
            string r4_Cur, string r5_Pid, string r6_Order, string r7_Uid, string r8_MP,
            string r9_BType, string rp_PayDate, string hmac, string errMsg)
		{
            this.p1_MerId = p1_MerId;
            this.r0_Cmd = r0_Cmd;
            this.r1_Code = r1_Code;
            this.r2_TrxId = r2_TrxId;
            this.r3_Amt = r3_Amt;

            this.r4_Cur = r4_Cur;
            this.r5_Pid = r5_Pid;
            this.r6_Order = r6_Order;
            this.r7_Uid = r7_Uid;
            this.r8_MP = r8_MP;

            this.r9_BType = r9_BType;
            this.rp_PayDate = rp_PayDate;
            this.hmac = hmac;
            this.errMsg = errMsg;
		}

        // 公共属性
        public string P1_MerId
        {
            get { return p1_MerId; }
        }
        public string R0_Cmd
        {
            get { return r0_Cmd; }
        }
        public string R1_Code
        {
            get { return r1_Code; }
        }
        public string R2_TrxId
        {
            get { return r2_TrxId; }
        }
        public string R3_Amt
        {
            get { return r3_Amt; }
        }
        ///--
        public string R4_Cur
        {
            get { return r4_Cur; }
        }
        public string R5_Pid
        {
            get { return r5_Pid; }
        }
        public string R6_Order
        {
            get { return r6_Order; }
        }
        public string R7_Uid
        {
            get { return r7_Uid; }
        }
        public string R8_MP
        {
            get { return r8_MP; }
        }
        ///--
        public string R9_BType
        {
            get { return r9_BType; }
        }
        public string Rp_PayDate
        {
            get { return rp_PayDate; }
        }
        public string Hmac
        {
            get { return hmac; }
        }
        public string ErrMsg
        {
            get { return errMsg; }
        }
	}
}
