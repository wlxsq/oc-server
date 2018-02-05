<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/05
 * Time: 19:59
 */

namespace app\exam\controller\v1;


use app\exam\model\Problem as ProblemModel;
use app\exam\model\ProblemAnswer;
use app\exam\model\ProblemSelection;
use app\exam\validate\IDMustBePositiveInt;
use app\exam\validate\NewAnswer;
use app\exam\validate\NewProblem;
use app\exam\validate\NewSelection;
use app\lib\exception\ErrorMessage;
use app\lib\exception\InfoMissExcepion;
use app\lib\exception\SuccessMessage;
use think\Exception;

class Problem
{
	/**
	 * 添加题目描述
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function createNewProblem()
	{
		//  数据验证
		$validata = new NewProblem();
		$validata->goCheck();
		//  获取验证后的数据
		$dataArray = $validata->getDataByRule(input('post.'));
		$result = ProblemModel::create($dataArray);
		if (!$result) {
			throw new Exception('添加题目失败！');
		}
		return json(new SuccessMessage(), 201);
	}
	
	/**
	 * 通过题目id删除题目
	 * @param $id
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function deleteProblemByID($id)
	{
		(new IDMustBePositiveInt())->goCheck();
		$result = ProblemModel::destroy($id);
		if (!$result) {
			throw new InfoMissExcepion(['msg' => '要删除的题目不存在！', 'errorCode' => '1001']);
		}
		return json(new SuccessMessage(), 201);
	}
	
	/**
	 * 获取所有题目数据
	 * @return \think\response\Json
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getAllProblem()
	{
		$result = ProblemModel::all([], 'selection');
		$result['cnt']=count($result);
		return json($result);
	}
	
	/**
	 * 为某问题添加选项
	 * @param $id
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function addProblemSelection()
	{
		$validate = new NewSelection();
		$validate->goCheck();
		$dataArray = $validate->getDataByRule(input('post.'));
		$result = ProblemSelection::create($dataArray);
		if (!$result) {
			throw new Exception('添加选项失败！');
		}
		return json(new SuccessMessage(), 201);
	}
	
	/**
	 * 为某个选项添加答案
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function addSelectionAnswer()
	{
		$validate = new NewAnswer();
		$validate->goCheck();
		$dataArray = $validate->getDataByRule(input('post.'));
		$result = ProblemAnswer::create($dataArray);
		if (!$result) {
			throw new Exception('为选项添加答案失败！');
		}
		return json(new SuccessMessage(), 201);
	}
	
	/**
	 * 检查某道选择题的答案
	 * @throws ErrorMessage
	 * @throws \app\lib\exception\ParameterException
	 */
	public function checkAnswer()
	{
		$validate = new IDMustBePositiveInt();
		$validate->goCheck();
		$dataArray = $validate->getDataByRule(input('post.'));
		$result = ProblemAnswer::checkAnswer($dataArray);
		return $result;
	}
}