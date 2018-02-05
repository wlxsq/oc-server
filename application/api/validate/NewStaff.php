<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 14:18
 */

namespace app\api\validate;


class NewStaff extends BaseValidate
{
	protected $rule = [
		'name' => 'require|max:25',
		'gender' => 'number|between:1,2',
		'birthday' => 'date',
		'telphone' => 'require|isMobile',
		'head_pic_id' => 'isOK',
		'address' => 'isOK',
		'education' => 'isOK',
		'email' => 'email',
	
	];
	protected $message = [
		'name.require' => '名称必须',
		'name.max' => '名称最多不能超过25个字符',
		'birthday' => '出生日期不合法',
		'email' => '邮箱格式错误',
		'telphone' => '手机号格式错误',
	];
	
}