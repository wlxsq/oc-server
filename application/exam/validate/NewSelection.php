<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/05
 * Time: 21:14
 */

namespace app\exam\validate;


class NewSelection extends BaseProblem
{
	protected $rule = [
		'pro_id' => 'number|ProblemIDIsExist',
		'selection' => 'require',
	];
	
	protected $message = [
		'pro_id.number' => '添加选项的题目id必须为整数',
		'pro_id.ProblemIDIsExist' => '添加选项的题目不存在',
		'selection' => '选项内容不能为空',
		'ans_id' => 'isOK',
	];
	
	
}