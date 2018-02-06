<?php
/**
 * Created by PhpStorm.
 * User: wlxsq
 * Date: 2018/2/6
 * Time: 22:05
 */

namespace app\api\validate;


class NewSignin extends BaseValidate
{
    protected $rule = [
        'user_id' => 'require|isPositiveInteger',
        'sign_time' => 'require|isPositiveInteger',
    ];

    protected $message = [
        'user_id' => '用户id不合法！',
        'sign_time' => '签到时间必须是时间戳形式！'
    ];
}