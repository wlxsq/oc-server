<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 14:48
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
	public $code = 504;
	public $msg = '参数错误';
	public $errorCode = 50000;
}