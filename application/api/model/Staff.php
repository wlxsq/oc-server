<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/22
 * Time: 20:50
 */

namespace app\api\model;


class Staff extends BaseModel
{
	protected $hidden = ['create_time','update_time','delete_time','head_pic_id'];
	public function img()
	{
		return $this->belongsTo('Image', 'head_pic_id','id');
	}
}