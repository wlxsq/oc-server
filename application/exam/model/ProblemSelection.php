<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/09
 * Time: 15:28
 */

namespace app\exam\model;


class ProblemSelection extends Problem
{
	protected $hidden = ['pro_id', 'create_time', 'delete_time', 'update_time'];
}