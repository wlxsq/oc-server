<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/22
 * Time: 17:45
 */

namespace app\api\controller\v1;


use app\api\model\Staff as StaffModel;
use app\api\model\user as UserModel;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\NewStaff;
use app\lib\exception\InfoMissExcepion;
use app\lib\exception\SuccessMessage;
use think\Exception;

header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');   // 指定允许其他域名访问
header('Access-Control-Allow-Headers:x-requested-with,content-type');// 响应头设置


class Staff
{
	/**
	 * 通过id获取员工详细信息
	 * @param $id
	 * @return array|false|\PDOStatement|string|\think\Model
	 * @throws InfoMissExcepion
	 * @throws \app\lib\exception\ParameterException
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getStaffInfo($id)
	{
		(new IDMustBePositiveInt())->goCheck();
		$staff = StaffModel::with('img')->find($id);
		if (!$staff) {
			throw new InfoMissExcepion();
		}
		return $staff;
	}
	
	/**
	 * 创建新的员工信息并为该员工新建账号
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function createStaffInfo()
	{
		$validate = new NewStaff();
		$validate->goCheck();
		
		$dataArray = $validate->getDataByRule(input('post.'));
		$result = StaffModel::create($dataArray);
		if (!$result) {
			throw new Exception(['msg'=>'添加员工信息失败！']);
		}
		$staff = StaffModel::where('telphone','=',$dataArray['telphone']);
		$result = UserModel::create(['uid'=>$staff['id'],'telphone'=>$staff['telphone']]);
		if(!$result){
			throw new Exception(['msg'=>'为新员工创建账户失败！']);
		}
		return json(new SuccessMessage(), 201);
	}
	
	/**
	 * 查询所有员工的信息
	 * @return \think\response\Json
	 * @throws InfoMissExcepion
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getAllStaffInfo()
	{
		$staffs = StaffModel::where('id','>=','0')->select();
		if(!$staffs){
			throw new InfoMissExcepion(['msg'=>'没有员工信息']);
		}
		return json($staffs);
	}
}