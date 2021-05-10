<?php
namespace app\admin\validate;

use think\Validate;

class Artist extends Validate {
	
    protected $rule = [
        'name'   => 'require'
    ];

    protected $message = [
        'name.require'   => '请输入名字'
    ];
}