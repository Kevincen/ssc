package com.yeepay;

public class RefundResult {
	private String r0_Cmd; 			// 请求命令
	private String r1_Code; 		// 请求结果
	private String r2_TrxId; 		// 交易流水号
	private String r3_Amt; 			// 交易金额
	private String r4_Cur; 			// 交易币种
	private String hmac; 			// 签名校验

	public String getR0_Cmd() {
		return r0_Cmd;
	}

	public void setR0_Cmd(String cmd) {
		r0_Cmd = cmd;
	}

	public String getR1_Code() {
		return r1_Code;
	}

	public void setR1_Code(String code) {
		r1_Code = code;
	}

	public String getR2_TrxId() {
		return r2_TrxId;
	}

	public void setR2_TrxId(String trxId) {
		r2_TrxId = trxId;
	}

	public String getR3_Amt() {
		return r3_Amt;
	}

	public void setR3_Amt(String amt) {
		r3_Amt = amt;
	}

	public String getR4_Cur() {
		return r4_Cur;
	}

	public void setR4_Cur(String cur) {
		r4_Cur = cur;
	}

	public String getHmac() {
		return hmac;
	}

	public void setHmac(String hmac) {
		this.hmac = hmac;
	}
}
