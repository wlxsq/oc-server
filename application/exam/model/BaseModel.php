<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/05
 * Time: 19:59
 */

namespace app\exam\model;

use traits\model\SoftDelete;
use think\Model;

class BaseModel extends Model
{
	use SoftDelete;
	protected $deleteTime = 'delete_time';
}