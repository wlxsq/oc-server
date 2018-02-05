<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/24
 * Time: 19:37
 */

namespace app\api\controller\v1;


use app\api\service\UserToken;
use app\api\validate\TokenGet;

class Token
{
	/**
	 * 微信登录，获取Token
	 * @param string $code
	 * @return string
	 * @throws \app\lib\exception\ParameterException
	 * @throws \think\Exception
	 */
	public function getToken($code = '')
	{
		(new TokenGet())->goCheck();
		$ut = new UserToken($code);
		$token= $ut->get();
		return $token;
	}
}