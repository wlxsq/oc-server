<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/24
 * Time: 22:08
 */

namespace app\api\controller\v1;


use app\api\validate\NewPay;
use app\api\model\Api;
class Pay
{
	//  获取参数
	//  验证参数合法性
	//  统一下单
	public function pay()
	{
		//  验证参数合法性并获取参数
		$validate = new NewPay();
		$validate->goCheck();
		$data = $validate->getDataByRule(input('post.'));
		$input = $this->setData($data);
		//  统一下单
		return $input;
	}
	
	/**
	 * 生成对象，数据赋值
	 * @param $data
	 * @return WxPayUnifiedOrder
	 */
	public function setData($data)
	{
		$input = new \WxPayUnifiedOrder();
		$input->SetBody($data['body']);    //  商品描述
		$input->SetAttach($data['attach']);  //  附加数据
		$input->SetOut_trade_no(WxPayConfig::MCHID . date("YmdHis"));   //  订单号
		$input->SetTotal_fee($data['total_fee']);  //  标价币种(单位分，默认人民币)
		$input->SetTime_start(date("YmdHis"));  //  交易开始时间
		$input->SetTime_expire(date("YmdHis", time() + 600));   //  交易结束时间
		$input->SetGoods_tag($data['goods_tag']);   //  订单优惠标记
		$input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");    //  通知地址
		$input->SetTrade_type("JSAPI"); //  交易类型
		$input->SetOpenid($data['openid']);     //  openid
		return $input;
	}
	
	/**
	 * 打印输出数组信息
	 * @param $data
	 */
	function printf_info($data)
	{
		foreach ($data as $key => $value) {
			echo "<font color='#00ff55;'>$key</font> : $value <br/>";
		}
	}
}