<?php
namespace app\admin\validate;

use think\Validate;

class User extends Validate {
    protected $rule = [
        'login_name'   => 'require|unique:user',
        'nick_name'   => 'require|unique:user',
        'login_pwd'    => 'confirm:confirm_pwd',
        'confirm_pwd'  => 'confirm:login_pwd',
        'status'       => 'require',
        'group_id'     => 'require'
    ];

    protected $message = [
        'login_name.require'   => '请输入用户名',
        'login_name.require'   => '请输入昵称',
        'login_name.require'   => '昵称已存在',
        'login_name.unique'    => '用户名已存在',
        'login_pwd.confirm'    => '两次输入密码不一致',
        'confirm_pwd.confirm'  => '两次输入密码不一致',
        'status.require'       => '请选择状态',
        'group_id'             => '请选择所属权限组'
    ];
}