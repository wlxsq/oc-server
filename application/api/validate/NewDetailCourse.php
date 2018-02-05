<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 19:24
 */

namespace app\api\validate;


use app\api\model\Course;
use app\api\model\CourseDetail;

class NewDetailCourse extends BaseValidate
{
	protected $rule = [
		'course_id' => 'isExist|isNotFull',
		'name' => 'require|max:25',
		'content' => 'require',
	];
	
	protected $message = [
		'name.max' => '课时名长度不能超过25个字符',
		'content' => '课时详情不能为空',
		'course_id.isExist'=>'要添加课时的课程不存在或者已被删除',
		'course_id.isNotFull'=>'该课程课时已添满',
	];
	
	/**
	 * 判断这个课程id是否存在
	 * @param $value
	 * @return bool
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	protected function isExist($value)
	{
		$result = Course::where('id','=',$value)
			->where('delete_time','=','0')
			->find();
		if(!$result) return false;
		return true;
	}
	
	/**
	 * 判断这个课程课时是否已全部添加
	 * @param $value
	 * @return bool
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	protected function isNotFull($value)
	{
		$data = Course::where('id','=',$value)->find();
		$result = CourseDetail::Where('course_id','=',$value)->count();
		if($result>=$data['total_time']){
			return false;
		}
		return true;
	}
}