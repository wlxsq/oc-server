<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/09
 * Time: 15:13
 */

namespace app\exam\validate;


use app\exam\model\Problem;
use app\exam\model\ProblemAnswer;
use app\exam\model\ProblemSelection;

class BaseProblem extends BaseValidate
{
	/**
	 * 判断这个题目id是否存在
	 * @param $value
	 * @return bool
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	protected function ProblemIDIsExist($value)
	{
		$result = Problem::find($value);
		if ($result) return true;
		else return false;
	}
	
	/**
	 * 判断要添加的这个选项id是否合法
	 * @param $value
	 * @return bool
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	protected function SelectionIDIsExist($value)
	{
		$result = ProblemSelection::find($value);
		$result1 = ProblemAnswer::where('selection_id', '=', $value)->find();
		if ($result && !$result1) return true;
		else return false;
	}
	
}