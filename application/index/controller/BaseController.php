<?php
namespace app\index\controller;

use think\Controller;
use think\Url;

/**
 * 后台公用基础控制器
 * Class AdminBase
 * @package app\common\controller
 */
class BaseController extends Controller {

	protected function _initialize() {
		Url::root('/index.php');
		if (stripos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {//判断是否微信浏览
			if (!session('openid')) {
				//①、获取用户openid和基本信息
				$appid = config("appid");
				$redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . "/index.php/index/index/getOpenIdByCode";
				$baseUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . urlencode($redirect_url) . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
				Header("Location: $baseUrl");
			}
		}
	}

}
