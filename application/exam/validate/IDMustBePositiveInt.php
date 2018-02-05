<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/08
 * Time: 15:26
 */

namespace app\exam\validate;


class IDMustBePositiveInt extends BaseValidate
{
	protected $rule = [
		'id' => 'require|isPositiveInteger',
	];
	protected $message = [
		'id' => 'id不合法',
	];
}