package com.yeepay;

import java.io.UnsupportedEncodingException;
import java.net.URLDecoder;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import com.yeepay.DigestUtil;
import com.yeepay.HttpUtils;
import org.apache.commons.logging.Log;
import org.apache.commons.logging.LogFactory;


public class PaymentForOnlineService {
	
	private static Log log 					= LogFactory.getLog(PaymentForOnlineService.class);
	private static String p1_MerId 			= Configuration.getInstance().getValue("p1_MerId"); 			// 商家ID
	private static String queryRefundReqURL = Configuration.getInstance().getValue("queryRefundReqURL");	// 请求地址
	private static String keyValue 			= Configuration.getInstance().getValue("keyValue");				// 商家密钥
	private static String query_Cmd  		= "QueryOrdDetail";       										// 订单查询请求，固定值” QueryOrdDetail”
	private static String buy_Cmd 	 		= "Buy";       		   											// 订单查询请求，固定值” Buy”
	private static String refund_Cmd 		= "RefundOrd";			   										// 退款请求，固定值 ” RefundOrd”
	private static String decodeCharset 	= "GBK";			   											// 定义编码格式
	private static String EMPTY = "";

	
	
	/**
	 * 生成hmac方法
	 * 业务类型
	 * @param p0_Cmd
	 * 商户编号
	 * @param p1_MerId
	 * 商户订单号
	 * @param p2_Order
	 * 支付金额
	 * @param p3_Amt
	 * 交易币种
	 * @param p4_Cur
	 * 商品名称
	 * @param p5_Pid
	 * 商品种类
	 * @param p6_Pcat
	 * 商品描述
	 * @param p7_Pdesc
	 * 商户接收支付成功数据的地址
	 * @param p8_Url
	 * 送货地址
	 * @param p9_SAF
	 * 商户扩展信息
	 * @param pa_MP
	 * 银行编码
	 * @param pd_FrpId
	 * 应答机制
	 * @param pr_NeedResponse
	 * 商户密钥
	 * @param keyValue
	 * @return
	 */
	public static String getReqMd5HmacForOnlinePayment(String p0_Cmd,String p1_MerId,
			String p2_Order, String p3_Amt, String p4_Cur,String p5_Pid, String p6_Pcat,
			String p7_Pdesc,String p8_Url, String p9_SAF,String pa_MP,String pd_FrpId,
			String pr_NeedResponse,String keyValue) {
		  StringBuffer sValue = new StringBuffer();
		// 业务类型
		sValue.append(p0_Cmd);
		// 商户编号
		sValue.append(p1_MerId);
		// 商户订单号
		sValue.append(p2_Order);
		// 支付金额
		sValue.append(p3_Amt);
		// 交易币种
		sValue.append(p4_Cur);
		// 商品名称
		sValue.append(p5_Pid);
		// 商品种类
		sValue.append(p6_Pcat);
		// 商品描述
		sValue.append(p7_Pdesc);
		// 商户接收支付成功数据的地址
		sValue.append(p8_Url);
		// 送货地址
		sValue.append(p9_SAF);
		// 商户扩展信息
		sValue.append(pa_MP);
		// 银行编码
		sValue.append(pd_FrpId);
		// 应答机制
		sValue.append(pr_NeedResponse);
		
		String sNewString = null;

		sNewString = DigestUtil.hmacSign(sValue.toString(), keyValue);
		return (sNewString);
	}

	

	/**
	 * 订单查询请求参数
	 * 该方法是根据《易宝支付产品通用接口（HTML版）文档 v3.0》怎样查询订单进行的封装
	 * 具体参数含义请仔细阅读《易宝支付产品通用接口（HTML版）文档 v3.0》
	 * 商户订单号
	 * @param p2_Order
	 * @return queryResult
	 */
	public static QueryResult queryByOrder(String p2_Order) {
		
		QueryResult qr = null;
		String hmac = DigestUtil.getHmac(new String[] {query_Cmd,p1_MerId,p2_Order},keyValue);
		Map reParams = new HashMap();
		reParams.put("p0_Cmd", query_Cmd);
		reParams.put("p1_MerId", p1_MerId);
		reParams.put("p2_Order", p2_Order);
		reParams.put("hmac", hmac);
		List responseStr = null; 
		
		try {
			log.debug("Begin http communications.data[" + reParams + "]");
			responseStr = HttpUtils.URLGet(queryRefundReqURL, reParams);
			log.debug("End http communications.responseStr.data[" + responseStr + "]");
		} catch (Exception e) {
			throw new RuntimeException(e.getMessage());
		}
		if (responseStr.size() == 0) {
			throw new RuntimeException("No response.");
		}
		qr = new QueryResult();
		for (int t = 0; t < responseStr.size(); t++) {
			String currentResult = (String) responseStr.get(t);
			if (currentResult == null || currentResult.equals("")) {
				continue;
			}
			int i = currentResult.indexOf("=");
			int j = currentResult.length();
			if (i >= 0) {
				String sKey = currentResult.substring(0, i);
				String sValue = currentResult.substring(i + 1);
				try {
					sValue = URLDecoder.decode(sValue, decodeCharset);
				} catch (UnsupportedEncodingException e) {
					throw new RuntimeException(e.getMessage());
				}
				if (sKey.equals("r0_Cmd")) {
					qr.setR0_Cmd(sValue);
				} else if (sKey.equals("r1_Code")) {
					qr.setR1_Code(sValue);
				} else if (sKey.equals("r2_TrxId")) {
					qr.setR2_TrxId(sValue);
				} else if (sKey.equals("r3_Amt")) {
					qr.setR3_Amt(sValue);
				} else if (sKey.equals("r4_Cur")) {
					qr.setR4_Cur(sValue);
				} else if (sKey.equals("r5_Pid")) {
					qr.setR5_Pid(sValue);
				} else if (sKey.equals("r6_Order")) {
					qr.setR6_Order(sValue);
				} else if (sKey.equals("r8_MP")) {
					qr.setR8_MP(sValue);
				} else if (sKey.equals("rb_PayStatus")) {
					qr.setRb_PayStatus(sValue);
				} else if (sKey.equals("rc_RefundCount")) {
					qr.setRc_RefundCount(sValue);
				} else if (sKey.equals("rd_RefundAmt")) {
					qr.setRd_RefundAmt(sValue);
				} else if (sKey.equals("hmac")) {
					qr.setHmac(sValue);
				}
			}
		}
		if (!qr.getR1_Code().equals("1")) {
			throw new RuntimeException("Query fail.Error code:" + qr.getR1_Code());
		}
		String newHmac = "";
		newHmac = DigestUtil.getHmac(new String[] { qr.getR0_Cmd(), qr.getR1_Code(), qr.getR2_TrxId(),
				  qr.getR3_Amt(), qr.getR4_Cur(), qr.getR5_Pid(), qr.getR6_Order(), qr.getR8_MP(),
				  qr.getRb_PayStatus(), qr.getRc_RefundCount(),qr.getRd_RefundAmt()}, keyValue);
		if (!newHmac.equals(qr.getHmac())) {
			throw new RuntimeException("Hmac error.");
		}
		return (qr);
		
	}
	
	/**
	 * 订单退款请求参数
	 * 方法是根据《易宝支付产品通用接口（HTML版）文档 v3.0》退款如何操作进行的封装
	 * 具体参数含义请仔细阅读《易宝支付产品通用接口（HTML版）文档 v3.0》
	 * 易宝支付交易流水号
	 * @param pb_TrxId
	 * 退款金额
	 * @param p3_Amt
	 * 交易币种
	 * @param p4_Cur
	 * 退款说明
	 * @param p5_Desc
	 * @return refundResult
	 */
	public static RefundResult refundByTrxId(String pb_TrxId,String p3_Amt,String p4_Cur,String p5_Desc) {
		RefundResult rr = null;
		String hmac = DigestUtil.getHmac(new String[] {refund_Cmd,p1_MerId,pb_TrxId,p3_Amt,p4_Cur,p5_Desc},keyValue);
		Map reParams = new HashMap();
		reParams.put("p0_Cmd", refund_Cmd);
		reParams.put("p1_MerId", p1_MerId);
		reParams.put("pb_TrxId", pb_TrxId);
		reParams.put("p3_Amt", p3_Amt);
		reParams.put("p4_Cur", p4_Cur);
		reParams.put("p5_Desc", p5_Desc);
		reParams.put("hmac", hmac);
		List responseStr = null; 
		try {
			log.debug("Begin http communications.data[" + reParams + "]");
			responseStr = HttpUtils.URLGet(queryRefundReqURL, reParams);
			log.debug("End http communications.responseStr.data[" + responseStr + "]");
		} catch (Exception e) {
			throw new RuntimeException(e.getMessage());
		}
		if (responseStr.size() == 0) {
			throw new RuntimeException("No response.");
		}
		
		
		rr = new RefundResult();
		for (int t = 0; t < responseStr.size(); t++) {
			String currentResult = (String) responseStr.get(t);
			if (currentResult == null || currentResult.equals("")) {
				continue;
			}
			try {
				URLDecoder.decode(currentResult, decodeCharset);
			} catch (UnsupportedEncodingException e) {
				throw new RuntimeException(e.getMessage());
			}
			int i = currentResult.indexOf("=");
			int j = currentResult.length();
			if (i >= 0) {
				String sKey = currentResult.substring(0, i);
				String sValue = currentResult.substring(i + 1);
				if (sKey.equals("r0_Cmd")) {
					rr.setR0_Cmd(sValue);
				} else if (sKey.equals("r1_Code")) {
					rr.setR1_Code(sValue);
				} else if (sKey.equals("r2_TrxId")) {
					rr.setR2_TrxId(sValue);
				} else if (sKey.equals("r3_Amt")) {
					rr.setR3_Amt(sValue);
				} else if (sKey.equals("r4_Cur")) {
					rr.setR4_Cur(sValue);
				} else if (sKey.equals("hmac")) {
					rr.setHmac(sValue);
				}	
			}
		}
		if (!rr.getR1_Code().equals("1")) {
			throw new RuntimeException("Query fail.Error code:" + rr.getR1_Code());
		}
		String newHmac = "";
		newHmac = DigestUtil.getHmac(new String[] { rr.getR0_Cmd(), rr.getR1_Code(), rr.getR2_TrxId(),
				  rr.getR3_Amt(), rr.getR4_Cur()}, keyValue);
		if (!newHmac.equals(rr.getHmac())) {
			throw new RuntimeException("Hmac error.");
		}
		return (rr);
	}
	
	/**
	 * 返回校验hmac方法
	 * 
	 * @param hmac
	 * 商户编号
	 * @param p1_MerId
	 * 业务类型
	 * @param r0_Cmd
	 * 支付结果
	 * @param r1_Code
	 * 易宝支付交易流水号
	 * @param r2_TrxId
	 * 支付金额
	 * @param r3_Amt
	 * 交易币种
	 * @param r4_Cur
	 * 商品名称
	 * @param r5_Pid
	 * 商户订单号
	 * @param r6_Order
	 * 易宝支付会员ID
	 * @param r7_Uid
	 * 商户扩展信息
	 * @param r8_MP
	 * 交易结果返回类型
	 * @param r9_BType
	 * 交易结果返回类型
	 * @param keyValue
	 * @return
	 */
	public static boolean verifyCallback(String hmac, String p1_MerId,
			String r0_Cmd, String r1_Code, String r2_TrxId, String r3_Amt,
			String r4_Cur, String r5_Pid, String r6_Order, String r7_Uid,
			String r8_MP, String r9_BType, String keyValue) {
		StringBuffer sValue = new StringBuffer();
		// 商户编号
		sValue.append(p1_MerId);
		// 业务类型
		sValue.append(r0_Cmd);
		// 支付结果
		sValue.append(r1_Code);
		// 易宝支付交易流水号
		sValue.append(r2_TrxId);
		// 支付金额
		sValue.append(r3_Amt);
		// 交易币种
		sValue.append(r4_Cur);
		// 商品名称
		sValue.append(r5_Pid);
		// 商户订单号
		sValue.append(r6_Order);
		// 易宝支付会员ID
		sValue.append(r7_Uid);
		// 商户扩展信息
		sValue.append(r8_MP);
		// 交易结果返回类型
		sValue.append(r9_BType);
		String sNewString = null;
		sNewString = DigestUtil.hmacSign(sValue.toString(), keyValue);

		if (hmac.equals(sNewString)) {
			return (true);
		}
		return (false);
	}
	
}