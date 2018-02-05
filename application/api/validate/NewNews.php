<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/04
 * Time: 17:00
 */

namespace app\api\validate;


class NewNews extends BaseValidate
{
	protected $rule = [
		'head_pic_id' => 'isOK',
		'title' => 'require|max:100',
		'detail_content' => 'require',
		'simple_content' => 'isOK|max:50',
		'author' => 'isOK',
	];
	protected $message = [
		'title.max' => '标题长度不能超过100个字符',
		'detail_content' => '正文不能为空',
		'simple_content.max' => '文章概要信息不能超过50个字符',
	];
}