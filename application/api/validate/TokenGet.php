<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/24
 * Time: 19:38
 */

namespace app\api\validate;


class TokenGet extends BaseValidate
{
	protected $rule = [
		'code'=>'require|isNotEmpty',
	];
	
	protected $message=[
		'code' => '没有code还想获取Token,做梦哦',
	];
}