<?php
namespace app\index\controller;

/**
 * 首页
 */
class IndexController extends BaseController {
	protected function _initialize() {
        parent::_initialize();
        $controller=request()->action();
		session("contr",$controller);
    }	
	public function index() {
		return $this->fetch();
	}
	public function about(){
		$content=db("setting")->where("key","content")->find();
		$this->assign("content",html_entity_decode($content['value']));
		return $this->fetch();
	}
	/**
	 * 成功案例
	 */
	public function cas(){
		$list=db("cas")->paginate(10);
		$this->assign("list",$list);
		return $this->fetch();
	}
	public function getToken() {
		$appid = config("appid");
		$appsecret = config("appsecret");
		$weixin = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $appsecret);
		$jsondecode = json_decode($weixin);
		//对JSON格式的字符串进行编码
		$array = get_object_vars($jsondecode);
		//转换成数组
		return $array['access_token'];
	}
	public function getOpenIdByCode() {
		$appid = config("appid");
		$appsecret = config("appsecret");
		//获取code
		$code = input("code");
		//通过code换取网页授权access_token
		$weixin = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=" . $appid . "&secret=" . $appsecret . "&code=" . $code . "&grant_type=authorization_code");
		//对JSON格式的字符串进行编码
		$jsondecode = json_decode($weixin);
		//转换成数组
		$array = get_object_vars($jsondecode);
		//openid
		if (!array_key_exists('openid', $array)) {
			$this->error('请稍后再尝试登录！');
		}
		$openid = $array['openid'];
		if ($openid) {
			$where['openid'] = $openid;
			$member = db('member')->where($where)->find();

			$access_token = $this->getToken();
			$res = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN");
			//对JSON格式的字符串进行编码
			$jsondecode1 = json_decode($res);
			//转换成数组
			$array1 = get_object_vars($jsondecode1);
			//昵称
			$nickname = $array1['nickname'];
			//性别
			$sex = $array1['sex'];
			//微信头像
			$headimgurl = $array1['headimgurl'];
			//城市
			$city = $array1['city'];
			//省份
			$province = $array1['province'];
			//国家
			$country = $array1['country'];
			$data = array(
				'openid' => $openid,
				'nickname' => $nickname,
				'sex' => $sex,
				'headimgurl' => $headimgurl,
				'city' => $city,
				'province' => $province,
				'country' => $country,
				'login_ip' => request()->ip(),
				'login_time' => now_time(),
				'status' => 1
			);
			if (!$member) {
				// 不存在则添加用户
				$data['add_time'] = now_time();
				$res = db("member")->insert($data);
			} else {
				// 存在则修改登录信息
				$data['update_time'] = now_time();
				$res = db("member")->where('id', $member['id'])->update($data);
			}
			session("openid", $openid);
		}
		$redirect_url = $_SERVER['REQUEST_URI'];
		Header("Location: $redirect_url");
	}

}
