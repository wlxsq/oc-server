<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/05
 * Time: 21:14
 */

namespace app\exam\validate;

class NewProblem extends BaseProblem
{
	protected $rule = [
		'content' => 'require',
		'degree' => 'number',
	];
	
	protected $message = [
		'content' => '题目内容不能为空',
		'degree' => '难度必须为数字',
	];
}