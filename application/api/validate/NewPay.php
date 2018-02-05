<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/25
 * Time: 20:26
 */

namespace app\api\validate;


class NewPay extends BaseValidate
{
	protected $rule = [
		'appid' => 'require',
		'body' => 'require',
		'detail' => 'isOk',
		'attach' => 'isOK',
		'out_trade_no' => 'require',
		'fee_type' => 'isOK',
		'total_fee' => 'require',
		'goods_tag' => 'isOK',
	];
	protected $message = [
		'appid' => 'require',
		'body' => 'require',
		'detail' => 'isOk',
		'attach' => 'isOK',
		'out_trade_no' => 'require',
		'fee_type' => 'isOK',
		'total_fee' => 'require',
		'goods_tag' => 'isOK',
	];
}