<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 16:19
 */

namespace app\api\controller\v1;

use app\api\model\Student as StudentModel;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\NewStudent;
use app\lib\exception\InfoMissExcepion;
use app\lib\exception\SuccessMessage;

class Student
{
	/**
	 * 通过id获取学生个人详细信息
	 * @param $id
	 * @return array|false|\PDOStatement|string|\think\Model
	 * @throws InfoMissExcepion
	 * @throws \app\lib\exception\ParameterException
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getStudentInfo($id)
	{
		(new IDMustBePositiveInt())->goCheck();
		$student = StudentModel::with('img')->find($id);
		if (!$student) {
			throw new InfoMissExcepion(['msg'=>'查询的学生不存在']);
		}
		return $student;
	}
	
	/**
	 * 通过TeaID
	 * @param $id
	 * @return false|static[]
	 * @throws InfoMissExcepion
	 * @throws \app\lib\exception\ParameterException
	 * @throws \think\exception\DbException
	 */
	public function getStuInfoByTeaID($id)
	{
		(new IDMustBePositiveInt())->goCheck();
		$student = StudentModel::with('img')->all();
		if (!$student) {
			throw new InfoMissExcepion(['msg'=>'查询的学生不存在']);
		}
		return $student;
	}
	
	/**
	 * 创建新的学生信息
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function createStudentInfo()
	{
		$validate = new NewStudent();
		$validate->goCheck();
		
		$dataArray = $validate->getDataByRule(input('post.'));
		$result = StudentModel::create($dataArray);
		if (!$result) {
			throw new Exception();
		}
		return json(new SuccessMessage(), 201);
	}
}