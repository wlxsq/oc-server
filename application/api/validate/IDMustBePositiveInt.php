<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/22
 * Time: 20:48
 */

namespace app\api\validate;


class IDMustBePositiveInt extends BaseValidate
{
	protected $rule = [
		'id' => 'require|isPositiveInteger',
	];
	protected $message = [
		'id' => 'id不合法',
	];
}