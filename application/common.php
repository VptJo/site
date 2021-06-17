<?php

/* 
 * 加密--32位密码
 */
function md5_salt($password) {
	return md5(crypt($password, config('salt')));
}
/**
 * 截取中文字符串
 */
function msubstr($str, $start = 0, $length, $charset = "utf-8", $suffix = false) {
	if (function_exists("mb_substr")) {
		if ($suffix)
			return mb_substr($str, $start, $length, $charset) . "...";
		else
			return mb_substr($str, $start, $length, $charset);
	} elseif (function_exists('iconv_substr')) {
		if ($suffix)
			return iconv_substr($str, $start, $length, $charset) . "...";
		else
			return iconv_substr($str, $start, $length, $charset);
	}
	$re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
	$re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
	$re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
	$re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("", array_slice($match[0], $start, $length));
	if ($suffix)
		return $slice . "…";
	return $slice;
}
/**
 * 返回格式化后的当前时间
 */
function now_time(){
	return date('Y-m-d H:i:s',time());
}
function cache_data($data){
		$list = db("setting")->select();
		$temp=array();
		foreach ($list as $key => $value) {
				$temp[$value['key']] = $value['value'];
		}
		foreach ($data as $key => $value) {
			if (isset($temp[$key])) {
				db("setting")-> insert(['key' => $key, 'value' => trim($value)]);
			} else {
				db("setting") ->where("key='$key'")-> update(array( 'value' => trim($value)));
			}
		}
}
function getOpenId(){
//		$we_config = get_config('payment_config');
////		define("APPID", $we_config['wxpay_appid']);
////		define("MCHID", $we_config['wxpay_mchid']);
////		define("KEY", $we_config['wxpay_key']);
////		define("APPSECRET", $we_config['wxpay_appsercet']);
//		$code = input("code");//获取code
//		$weixin =  file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$we_config['wxpay_appid']."&secret=".$we_config['wxpay_appsercet']."&code=".$code."&grant_type=authorization_code");//通过code换取网页授权access_token
//		$jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
//		$array = get_object_vars($jsondecode);//转换成数组
//		$openid = $array['openid'];//输出openid
//		if($openid){
//			 Db::name('member')->update(
//                  [
//                      'openid'   => $openid,
//                      'id'       => input("uid")
//                  ]
//           );
//		}
//		echo  $openid;
//		exit;
	}
	
/**
 * 获取当前request参数数组,去除值为空
 * @return array
 */
function get_query(){
	$param = request()->except(['s']);
	$rst = array();
	foreach($param as $k=>$v){
		if(!empty($v)){
			$rst[$k] = $v;
		}
	}
	return $rst;
}


//发送短信
function send_sms($phone,$template_id,$code,$app_config){
	include_once ('./extend/taobao/TopSdk.php');
    date_default_timezone_set('Asia/Shanghai');
	$c = new TopClient;
//	$c -> format = 'json';
//	$c -> simplify = true;
	$c -> appkey = $app_config['app_key'];  //  23613152
	$c -> secretKey = $app_config['app_secret'];//  be075d72e8767e336b778b47b6a8f68e
	$req = new AlibabaAliqinFcSmsNumSendRequest;
	$req -> setSmsType("normal");
	$req -> setSmsFreeSignName($app_config['app_sign']);//
	$req -> setSmsParam('{"code":"'.$code.'"}');
	$req -> setRecNum($phone);
	$req -> setSmsTemplateCode($template_id);
	$resp = $c -> execute($req);
	return $resp;
}

/**
 * 数组里删除指定key的数据
 */
function array_remove($data, $key){
    if(!array_key_exists($key, $data)){
        return $data;
    }
    $keys = array_keys($data);
    $index = array_search($key, $keys);
    if($index !== FALSE){
        array_splice($data, $index, 1);
    }
    return $data;
}

/**
 * 数组层级缩进转换
 * @param array $array
 * @param int   $pid
 * @param int   $level
 * @return array
 */
function array2level($array, $pid = 0, $level = 1) {
    static $list = [];
    foreach ($array as $v) {
        if ($v['pid'] == $pid) {
            $v['level'] = $level;
            $list[]     = $v;
            array2level($array, $v['id'], $level + 1);
        }
    }

    return $list;
}

/**
 * 构建层级（树状）数组
 * @param array  $array 要进行处理的一维数组，经过该函数处理后，该数组自动转为树状数组
 * @param string $pid 父级ID的字段名
 * @param string $child_key_name 子元素键名
 * @return array|bool
 */
function array2tree(&$array, $pid = 'pid', $child_key_name = 'children') {
    $counter = array_children_count($array, $pid);
    if ($counter[0] == 0)
        return false;
    $tree = [];
    while (isset($counter[0]) && $counter[0] > 0) {
        $temp = array_shift($array);
        if (isset($counter[$temp['id']]) && $counter[$temp['id']] > 0) {
            array_push($array, $temp);
        } else {
            if ($temp[$pid] == 0) {
                $tree[] = $temp;
            } else {
                $array = array_child_append($array, $temp[$pid], $temp, $child_key_name);
            }
        }
        $counter = array_children_count($array, $pid);
    }

    return $tree;
}

/**
 * 子元素计数器
 * @param $array
 * @param $pid
 * @return array
 */
function array_children_count($array, $pid) {
    $counter = [];
    foreach ($array as $item) {
        $count = isset($counter[$item[$pid]]) ? $counter[$item[$pid]] : 0;
        $count++;
        $counter[$item[$pid]] = $count;
    }

    return $counter;
}

/**
 * 把元素插入到对应的父元素$child_key_name字段
 * @param        $parent
 * @param        $pid
 * @param        $child
 * @param string $child_key_name 子元素键名
 * @return mixed
 */
function array_child_append($parent, $pid, $child, $child_key_name) {
    foreach ($parent as &$item) {
        if ($item['id'] == $pid) {
            if (!isset($item[$child_key_name]))
                $item[$child_key_name] = [];
            $item[$child_key_name][] = $child;
        }
    }

    return $parent;
}

/**
 * 循环删除目录和文件
 * @param string $dir_name
 * @return bool
 */
function delete_dir_file($dir_name) {
    $result = false;
    if(is_dir($dir_name)){
        if ($handle = opendir($dir_name)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != '.' && $item != '..') {
                    if (is_dir($dir_name . DS . $item)) {
                        delete_dir_file($dir_name . DS . $item);
                    } else {
                        unlink($dir_name . DS . $item);
                    }
                }
            }
            closedir($handle);
            if (rmdir($dir_name)) {
                $result = true;
            }
        }
    }

    return $result;
}

/**
 * 判断是否为手机访问
 * @return  boolean
 */
function is_mobile() {
    static $is_mobile;

    if (isset($is_mobile)) {
        return $is_mobile;
    }

    if (empty($_SERVER['HTTP_USER_AGENT'])) {
        $is_mobile = false;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false
              || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
              || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
              || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
              || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
              || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
              || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false
    ) {
        $is_mobile = true;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}
