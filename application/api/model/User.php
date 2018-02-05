<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/05
 * Time: 13:48
 */

namespace app\api\model;


class User extends BaseModel
{
	/**
	 * 获取User信息
	 * @param $openid
	 * @return array|false|\PDOStatement|string|\think\Model
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function getByOpenID($openid)
	{
		$user = self::where('openid','=',$openid)->find();
		return $user;
	}
}