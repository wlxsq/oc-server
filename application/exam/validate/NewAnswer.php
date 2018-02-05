<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/09
 * Time: 15:47
 */

namespace app\exam\validate;


class NewAnswer extends BaseProblem
{
	protected $rule = [
		'selection_id' => 'number|SelectionIDIsExist',
		'answer' => 'require',
		'resolution' => 'isOK',
		'score' => 'number',
	];
	
	protected $message = [
		'selection_id.number' => '添加答案的选项必须为整数',
		'selection_id.SelectionIDIsExist' => '添加答案的选项不存在或者该选项答案已存在',
		'answer' => '答案不能为空',
		'resolution' => 'require',
		'score'=>'分数必须为数字',
	];
}