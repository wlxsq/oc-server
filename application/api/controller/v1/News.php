<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/04
 * Time: 16:57
 */

namespace app\api\controller\v1;



use app\api\model\News as NewsModel;
use app\api\validate\IDMustBePositiveInt;
use app\api\validate\NewNews;
use app\lib\exception\InfoMissExcepion;
use app\lib\exception\SuccessMessage;
use think\Exception;

class News
{
	/**
	 * 添加新闻
	 * @return \think\response\Json
	 * @throws Exception
	 * @throws \app\lib\exception\ParameterException
	 */
	public function createNewsInfo()
	{
		$validate = new NewNews();
		$validate->goCheck();
		
		$dataArray = $validate->getDataByRule(input('post.'));
		$result = NewsModel::create($dataArray);
		if(!$result){
			throw new Exception(['msg'=>'添加新闻失败！']);
		}
		return json(new SuccessMessage(),201);
	}
	
	/**
	 * 获取所有新闻信息
	 * @return \think\response\Json
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getAllNewsInfo()
	{
		$result = NewsModel::where('delete_time', '=', '0')->select();
		return json($result);
	}
	
	/**
	 * 通过新闻ID获取详细信息
	 * @param $id
	 * @return \think\response\Json
	 * @throws InfoMissExcepion
	 * @throws \app\lib\exception\ParameterException
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public function getDetailNewsInfoByID($id){
		(new IDMustBePositiveInt())->goCheck();
		$result = NewsModel::find($id);
		if(!$result){
			throw new InfoMissExcepion();
		}
		$result->reading = $result->reading+1;
		$result->save();
		return json($result);
	}
}