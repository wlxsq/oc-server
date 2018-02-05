<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/09
 * Time: 17:03
 */

namespace app\lib\exception;


class ErrorMessage extends BaseException
{
	public $code = 500;
	public $msg = 'error';
	public $errorCode = 0;
}