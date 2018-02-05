<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 18:56
 */

namespace app\api\controller\v1;

use app\api\model\Course as CourseModel;
use app\api\model\CourseDetail;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\NewCourse;
use app\api\validate\NewDetailCourse;
use app\lib\exception\InfoMissExcepion;
use app\lib\exception\SuccessMessage;
use think\Exception;

class Course
{
	/**
	 * 添加新的课程
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function createCourseInfo()
	{
		$validate = new NewCourse();
		$validate->goCheck();
		$course = $validate->getDataByRule(input('post.'));
		$result = CourseModel::create($course);
		if (!$result) {
			throw new Exception(['msg' => '添加课程失败']);
		}
		return json(new SuccessMessage(), 201);
	}
	
	/**
	 * 添加新的详细课时信息
	 * @param $id
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function createDetailCourseInfo()
	{
		$validata = new NewDetailCourse();
		$validata->goCheck();
		$dataArray = $validata->getDataByRule(input('post.'));
		$result = CourseDetail::create($dataArray);
		if (!$result) {
			throw new Exception(['msg' => '添加课时失败！']);
		}
		return json(new SuccessMessage(), 201);
	}
	
	/**
	 * 获取所有课程信息
	 * @return \think\response\Json
	 * @throws InfoMissExcepion
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getAllCourseInfo()
	{
		$result = CourseModel::where('delete_time', '=', '0')->select();
		return json($result);
	}
	
	/**
	 * 通过课程ID获取课程详细信息
	 * @param $id
	 * @return \think\response\Json
	 * @throws InfoMissExcepion
	 * @throws \app\lib\exception\ParameterException
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getDetailCourseInfo($id)
	{
		(new IDMustBePositiveInt())->goCheck();
		$check = CourseModel::where('id', '=', $id)
			->where('delete_time', '=', '0')
			->find();
		if (!$check) {
			throw new InfoMissExcepion(['msg' => '该课程不存在']);
		}
		$result = CourseDetail::where('course_id', '=', $id)->select();
		return json($result);
	}
}