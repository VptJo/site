<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\admin\model\User as UserModel;
use think\Db;


/**
 * 后台首页
 * Class Index
 * @package app\admin\controller
 */
class IndexController extends AdminBaseController {
    protected function _initialize() {
        parent::_initialize();
    }

    /**
     * 首页
     * @return mixed
     */
    public function index() {
		$total_member = db('member')->count();
		$this->assign("total_member",$total_member);
		$today_member = db('member')->where("to_days(add_time)=to_days(now())")->count();
		$this->assign("today_member",$today_member);
		$today_login = db('member')->where("to_days(login_time)=to_days(now())")->count();
		$this->assign("today_login",$today_login);
        return $this->fetch();
    }
	
	/**
     * 更新密码
     * @param $id
     * @param $group_id
     */
    public function update() {
    	$user_model = new UserModel();
        if ($this->request->isPost()) {
	      	$data = $this->request->post();
			if(empty($data['old_pwd'])){
				$this->error('请输入旧密码');
			}
			if(empty($data['login_pwd']) || empty($data['login_pwd2'])){
				$this->error('请输入新密码');
			}
			if($data['login_pwd'] != $data['login_pwd2']){
				$this->error('二次密码输入不一致');
			}
            $user = $user_model->find(session('admin_id'));
			if(md5_salt($data['old_pwd'])!=$user['login_pwd']){
				$this->error('旧密码错误');
			}
            $user->id = session('admin_id');
            $user->login_pwd = md5_salt($data['login_pwd']);
            if ($user->save() !== false) {
                $this->success('更新成功');
            } else {
                $this->error('更新失败');
            }
        }else{
        	$user = $user_model->find(session('admin_id'));
        	return $this->fetch('update', ['user' => $user]);
        }
    }
	
}
