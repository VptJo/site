<?php
namespace app\admin\validate;

use think\Validate;

class Goods extends Validate {
	
    protected $rule = [
        'title'   => 'require'
    ];

    protected $message = [
        'title.require'   => '请输入标题'
    ];
}
