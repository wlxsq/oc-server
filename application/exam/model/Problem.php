<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/05
 * Time: 20:01
 */

namespace app\exam\model;


class Problem extends BaseModel
{
	protected $hidden = ['create_time', 'update_time', 'delete_time'];
	
	/**
	 * 获取这个题目的所有选项
	 * @return \think\model\relation\HasMany
	 */
	public function selection()
	{
		return $this->hasMany('ProblemSelection','pro_id','id')->order('rand()');
	}
}