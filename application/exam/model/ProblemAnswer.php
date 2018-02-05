<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/09
 * Time: 15:57
 */

namespace app\exam\model;


use app\lib\exception\ErrorMessage;
use app\lib\exception\SuccessMessage;

class ProblemAnswer extends Problem
{
	/**
	 * 检查答案
	 * @param $data
	 * @return \think\response\Json
	 * @throws ErrorMessage
	 * @throws \think\db\exception\DataNotFoundException
	 * @throws \think\db\exception\ModelNotFoundException
	 * @throws \think\exception\DbException
	 */
	public static function checkAnswer($data)
	{
		foreach ($data as $value) {
			$result = self::find($value);
			if(!$result){
				throw new ErrorMessage(['msg'=>'你在乱改什么东西？我劝你住手哦！']);
			}
			if($result['answer']==$value){
				$result['state']=true;
			}else{
				$result['state']=false;
			}
			return $result;
		}
	}
}