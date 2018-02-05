<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 18:58
 */

namespace app\api\validate;


class NewCourse extends BaseValidate
{
	protected $rule = [
		'name' => 'require|max:25',
		'total_time' => 'number|between:1,200',
		'price' => 'number',
	];
	protected $message=[
		'name.max'=>'课程名不能超过25个字符',
		'total_time.between'=>'总课时得在[1-200]范围',
		'total_time.number'=>'总课时必须是整数',
		'price'=>'价格必须是整数',
	];
}