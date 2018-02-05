<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 16:44
 */

namespace app\api\validate;


class NewStudent extends BaseValidate
{
	protected $rule = [
		'name' => 'require|max:25',
		'gender' => 'number|between:1,2',
		'birthday' => 'date',
		'telphone' => 'require|isMobile',
		'address' => 'isOK',
		'content' => 'isOK',
		'head_pic_id' => 'isOK',
		'specialty' => 'isOK',
		'father_name' => 'isOK',
		'mother_name' => 'isOK',
		'father_telphone' => 'isOK',
		'mother_telphone' => 'isOK',
	];
	protected $message = [
		'name.require' => '名称必须',
		'name.max' => '名称最多不能超过25个字符',
		'birthday' => '出生日期不合法',
		'email' => '邮箱格式错误',
		'telphone' => '手机号格式错误',
	];
}