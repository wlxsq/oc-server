<?php
/**
 * Created by wlxsq
 * User: wlxsq
 * Date: 2017/12/22
 * Time: 22:57
 */

namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
	private $code;
	private $msg;
	private $errorCode;
	
	//  还需要返回客户端当前请求的URL路径
	public function render(\Exception $e)
	{
		if ($e instanceof BaseException) {
			//如果是自定义的异常
			$this->code = $e->code;
			$this->msg = $e->msg;
			$this->errorCode = $e->errorCode;
		} else {
//			Config::get('app_debug');
			if (config('app_debug')) {
				//  return default error page
				return parent::render($e);
			} else {
				$this->code = 500;
				$this->msg = '服务器内部错误，不想告诉你';
				$this->errorCode = 999;
				$this->recordErrorLog($e);
			}
		}
		$request = Request::instance();
		$result = [
			'msg' => $this->msg,
			'error_code' => $this->errorCode,
			'request_utl' => $request->url()
		];
		return json($result, $this->code);
	}
	
	private function recordErrorLog(\Exception $e)
	{
		Log::init([
			'type' => 'File',
			'path' => LOG_PATH,
			'level' => ['error'],
		]);
		Log::record($e->getMessage(), 'error');
	}
}