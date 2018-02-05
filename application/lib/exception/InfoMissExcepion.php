<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/22
 * Time: 22:26
 */

namespace app\lib\exception;


class InfoMissExcepion extends BaseException
{
	public $code = 404;
	public $msg = '查询的个人不存在';
	public $errorCode = 40000;
}
