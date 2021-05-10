<?php
namespace app\admin\validate;

use think\Validate;

/**
 * 后台登录验证
 * Class Login
 * @package app\admin\validate
 */
class Login extends Validate {

    protected $rule = [
        'login_name' => 'require',
        'login_pwd'  => 'require',
        'verify'     => 'require|captcha'
    ];

    protected $message = [
        'login_name.require' => '请输入用户名',
        'login_pwd.require'  => '请输入密码',
        'verify.require'     => '请输入验证码',
        'verify.captcha'     => '验证码不正确'
    ];
}