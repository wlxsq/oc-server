<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/03
 * Time: 15:34
 */

namespace app\lib\exception;


class SuccessMessage extends BaseException
{
	public $code = 201;
	public $msg = 'ok';
	public $errorCode = 0;
}