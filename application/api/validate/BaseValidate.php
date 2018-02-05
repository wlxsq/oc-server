<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/22
 * Time: 20:41
 */

namespace app\api\validate;


use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
	public function goCheck()
	{
		$request = Request::instance();
		$params = $request->param();
		$result = $this->batch()->check($params, $this->rule);
		if (!$result) {
			$e = new ParameterException([
				'msg' => $this->error,
			]);
			throw $e;
		} else {
			return true;
		}
	}
	
	/**
	 * 判断是否是正整数
	 * @param $value
	 * @param string $rule
	 * @param string $data
	 * @param string $field
	 * @return bool
	 */
	protected function isPositiveInteger($value, $rule = '', $data = '', $field = '')
	{
		if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 判断是否是手机号
	 * @param $value
	 * @return bool
	 */
	protected function isMobile($value)
	{
		$rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
		$result = preg_match($rule, $value);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 判断是否为空
	 * @param $value
	 * @param string $rule
	 * @param string $data
	 * @param string $field
	 * @return bool
	 */
	protected function isNotEmpty($value, $rule = '', $data = '', $field = '')
	{
		if (empty($value)) {
			return false;
		} else {
			return true;
		}
	}
	
	/**
	 * 将参数匹配rule规则后，转换成数组返回
	 * @param $arrays
	 * @return array
	 * @throws ParameterException
	 */
	public function getDataByRule($arrays)
	{
		if (array_key_exists('user_id', $arrays) | array_key_exists('uid', $arrays)) {
			throw new ParameterException([
				'msg' => '参数中包含非法参数名user_id或者uid'
			]);
		}
		$newArray = [];
		foreach ($this->rule as $key => $value) {
			$newArray[$key] = $arrays[$key];
		}
		return $newArray;
	}
	
	/**
	 * 无验证规则的直接返回true
	 * @param $value
	 * @return bool
	 */
	public function isOK($value)
	{
		return true;
	}
}