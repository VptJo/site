<?php
namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Session;

/**
 * 后台登录
 * Class Login
 * @package app\admin\controller
 */
class LoginController extends Controller {
    /**
     * 后台登录
     * @return mixed
     */
    public function index() {
        return $this->fetch();
    }
	
	/**
	 * 判断是否重复登录
	 */
	public function online(){
		$user = Db::name('user')->field('session_id')->where('id', session('admin_id'))->find();
		if($user['session_id'] != session_id()){
			Session::delete('admin_id');
        	Session::delete('admin_name');
			return 1;//不同用户
		}else{
			return -1;
		}
	}

    /**
     * 登录验证
     * @return string
     */
    public function login() {
        if($this->request->isPost()){
            $data            = $this->request->only(['login_name', 'login_pwd', 'verify']);
            $validate_result = $this->validate($data, 'Login');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $where['login_name'] = $data['login_name'];
                //$where['login_pwd'] = md5_salt($data['login_pwd']);

                $user = Db::name('user')->field('id,login_name,status,last_login_time,last_login_ip,session_id')->where($where)->find();
                if (!empty($user)) {
                    if ($user['status'] != 1) {
                        $this->error('当前用户已禁用');
                    } else {
                        Session::set('admin_id', $user['id']);
                        Session::set('admin_name', $user['login_name']);
                        Db::name('user')->update(
                            [
                                'last_login_time' => date('Y-m-d H:i:s', time()),
                                'last_login_ip'   => $this->request->ip(),
                                'id'              => $user['id'],
                                'session_id'       => session_id()  //更改登录状态
                            ]
                        );
                        $this->success('登录成功', 'admin/index/index');
                    }
                } else {
                    $this->error('用户名或密码错误');
                }
            }
        }
    }

    /**
     * 退出登录
     */
    public function logout() {
        Session::delete('admin_id');
        Session::delete('admin_name');
        $this->success('退出成功', 'admin/login/index');
    }
}
