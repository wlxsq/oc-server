<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 16:45
 */

namespace app\api\model;


class Student extends BaseModel
{
	protected $hidden = ['create_time','update_time','delete_time','head_pic_id'];
	public function img()
	{
		return $this->belongsTo('Image','head_pic_id','id');
	}
}