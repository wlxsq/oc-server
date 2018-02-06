<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/04
 * Time: 16:55
 */

namespace app\api\controller\v1;


use app\api\validate\IDMustBePositiveInt;
use app\api\validate\NewSignin;
use app\api\model\SigninRecord as SigninRecordModel;
use app\lib\exception\SuccessMessage;
use think\Exception;

class User
{
	public function loginWithPsd()
	{
		//  手机号登录，工号登录
		//  实现密码登录
	}
	
	public function logout()
	{
	
	}

    /**
     * 用户签到
     * @return \think\response\Json
     * @throws Exception
     * @throws \app\lib\exception\ParameterException
     */
	public function signin()
    {
        //  数据验证
        $validate = new NewSignin();
        $validate->goCheck();
        //  获取post数据
        $data = $validate->getDataByRule(input('post.'));
        //  更新至数据库
        $result = SigninRecordModel::create($data);
        if(!$result){
            throw new Exception(['msg' => '签到失败！']);
        }
        return json(new SuccessMessage(), 201);
    }

    /**
     * 通过用户ID获取该ID的签到记录
     * @return \think\response\Json
     * @throws Exception
     * @throws \app\lib\exception\ParameterException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getSignRecordByUserID($id)
    {
        //  数据验证
        (new IDMustBePositiveInt())->goCheck();
        //  从数据库获取数据
        $result = SigninRecordModel::where('user_id','=',$id)->select();
        if(!$result){
            throw new Exception(['msg' => '获取签到记录失败！！']);
        }
        return json($result);
    }

    /**
     * 获取所有的签到记录
     * @return \think\response\Json
     * @throws Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getAllSignRecord()
    {
        $result = SigninRecordModel::select();
        if(!$result){
            throw new Exception(['msg' => '获取签到记录失败！！']);
        }
        return json($result);
    }
	
}