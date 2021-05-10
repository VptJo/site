<?php
namespace app\common\controller;

use think\auth\Auth;
use think\Loader;
use think\Controller;
use think\Db;
use think\Session;
use think\Url;

/**
 * 后台公用基础控制器
 * Class AdminBase
 * @package app\common\controller
 */
class AdminBaseController extends Controller {

	protected function _initialize() {
		Url::root('/index.php');
		parent::_initialize();
		$this->checkAuth();
		$this->getMenu();

		// 输出当前请求控制器（配合后台侧边菜单选中状态）
		$this->assign('controller', Loader::parseName($this->request->controller()));

		// 判断登录状态
		$user = Db::name('user')->field('session_id')->where('id', session('admin_id'))->find();
		if ($user['session_id'] != session_id()) {
			Session::delete('admin_id');
			Session::delete('admin_name');
			$this->success('该账号已在别处登录！', 'admin/login/index');
		}
	}

	/**
	 * 权限检查
	 * @return bool
	 */
	protected function checkAuth() {

		if (!Session::has('admin_id')) {
			$this->redirect('admin/login/index');
		}

		$module = $this->request->module();
		$controller = $this->request->controller();
		$action = $this->request->action();

		// 排除权限
		$not_check = array(
			'admin/Index/index',
			'admin/Index/update',
			'admin/AuthGroup/getjson',
			'admin/System/clear'
		);

		if (!in_array($module . '/' . $controller . '/' . $action, $not_check)) {
			$auth = new Auth();
			$admin_id = Session::get('admin_id');
			if (!$auth->check($module . '/' . $controller . '/' . $action, $admin_id) && $admin_id != 1 && $admin_id != 2) {
				$this->error('没有权限');
			}
		}
	}

	/**
	 * 获取侧边栏菜单
	 */
	protected function getMenu() {
		$menu = array();
		$admin_id = Session::get('admin_id');
		$auth = new Auth();
		$order['sort'] = 'asc';
		$order['id'] = 'asc';
		$auth_rule_list = Db::name('auth_rule')->where('status', 1)->order($order)->select();
		foreach ($auth_rule_list as $value) {
			if ($auth->check($value['name'], $admin_id) || $admin_id == 1 || $admin_id == 2) {
				$menu[] = $value;
			}
		}
		$menu = !empty($menu) ? array2tree($menu) : array();
		$this->assign('menu', $menu);
	}

}
