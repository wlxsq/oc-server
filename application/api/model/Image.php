<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/22
 * Time: 21:35
 */

namespace app\api\model;


class Image extends BaseModel
{
	protected $hidden = ['create_time', 'delete_time', 'update_time', 'id','from'];
}