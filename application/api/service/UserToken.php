<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/19
 * Time: 17:42
 */

namespace app\api\service;


use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;
use app\api\model\User as UserModel;

class UserToken extends Token
{
	protected $code;
	protected $wxAppID;
	protected $wxAppSecret;
	protected $wxLoginUrl;
	
	/**
	 * 生成登录链接
	 * UserToken constructor.
	 * @param $code
	 */
	function __construct($code)
	{
		$this->code = $code;
		$this->wxAppID = config('weixin.app_id');
		$this->wxAppSecret = config('weixin.app_secret');
		$this->wxLoginUrl = sprintf(
			config('weixin.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
	}
	
	/**
	 * 获取Token值
	 * @return string
	 * @throws Exception
	 * @throws WeChatException
	 */
	public function get()
	{
		$result = curl_get($this->wxLoginUrl);
		$wxResult = json_decode($result, true);
		if (empty($wxResult)) {
			throw new Exception('获取session_key及openID时异常，微信内部错误');
		} else {
			$loginFail = array_key_exists('errcode', $wxResult);
			if ($loginFail) {
				$this->processLoginError($wxResult);
			} else {
				return $this->grantToken($wxResult);
			}
		}
	}
	
	/**
	 * openID登录（第一次登录则注册，否则直接登录）
	 * @param $wxResult
	 * @return string
	 */
	private function grantToken($wxResult)
	{
		//  拿到openid
		//  数据库里看一下，这个openid是否已经存在
		//  如果存在，则不处理，如果不存在，则新增一条user记录。
		//  生成令牌准备缓存数据，写入缓存。
		//  把令牌返回到客户端
		//  key:令牌
		//  value:wxResult,uid,scope,
		$openid = $wxResult['openid'];
		$user = UserModel::getByOpenID($openid);
		if ($user) {
			$uid = $user->id;
		} else {
			$uid = $this->newUser($openid);
		}
		$cachedValue = $this->prepareCacheValue($wxResult, $uid);
		$token = $this->saveToCache($cachedValue);
		return $token;
	}
	
	/**
	 * 将某些值写入缓存
	 * @param $cachedValue
	 * @return string
	 */
	private function saveToCache($cachedValue)
	{
		$key = self::generateToken();
		$value = json_encode($cachedValue);
		$expire_in = config('setting.token_expire_in');
		$request = cache($key, $value, $expire_in);
		if (!$request) {
			throw new TokenException([
				'msg' => '服务器缓存异常',
				'errorCode' => 10005,
			]);
		}
		return $key;
	}
	
	/**
	 * 准备需要写入缓存的数组值
	 * @param $wxResult
	 * @param $uid
	 * @return mixed
	 */
	private function prepareCacheValue($wxResult, $uid)
	{
		$cachedValue = $wxResult;
		$cachedValue['uid'] = $uid;
		$cachedValue['scope'] = 16;
		return $cachedValue;
	}
	
	/**
	 * 添加一个新User
	 * @param $openid
	 * @return mixed
	 */
	private function newUser($openid)
	{
		$user = UserModel::create([
			'openid' => $openid,
		]);
		return $user->id;
	}
	
	/**
	 * 登录进程错误
	 * @param $wxResult
	 * @throws WeChatException
	 */
	private function processLoginError($wxResult)
	{
		throw new WeChatException([
			'msg' => $wxResult['errmsg'],
			'errorCode' => $wxResult['errcode'],
		]);
	}
}