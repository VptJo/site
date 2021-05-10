<?php
namespace app\admin\validate;

use think\Validate;

class Member extends Validate {
	
	protected $rule = [
		'mobile'      => 'require|unique:member',
    	'nickname'   => 'require'
    ];

    protected $message = [
    	'mobile.require'       => '请输入手机号',
        'mobile.unique'        => '手机号已存在',
        'nickname.require'    => '请输入姓名'
    ];
}