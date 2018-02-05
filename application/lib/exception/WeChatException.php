<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2018/01/24
 * Time: 20:24
 */

namespace app\lib\exception;


class WeChatException extends BaseException
{
	public $code = 400;
	public $msg = '微信服务器接口调用失败';
	public $errorCode = 999;
}