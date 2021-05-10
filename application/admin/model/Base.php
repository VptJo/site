<?php
namespace app\admin\model;

use think\Model;

/**
 * 基础模型
 */
class Base extends Model {
	
	// 定义时间戳字段名
    protected $createTime = 'add_time';
	
}
