<?php
namespace app\admin\controller;

use app\admin\model\User as UserModel;
use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthGroupAccess as AuthGroupAccessModel;
use app\common\controller\AdminBaseController;
use think\Config;
use think\Db;

/**
 * 管理员管理
 * Class User
 * @package app\admin\controller
 */
class UserController extends AdminBaseController {
	
    protected $user_model;
    protected $auth_group_model;
    protected $auth_group_access_model;

    protected function _initialize() {
        parent::_initialize();
        $this->user_model        	   = new UserModel();
        $this->auth_group_model        = new AuthGroupModel();
        $this->auth_group_access_model = new AuthGroupAccessModel();
    }

    /**
     * 管理员管理
     * @return mixed
     */
    public function index() {
        $user_list = $this->user_model->order('add_time desc')->paginate(15);
        return $this->fetch('index', ['user_list' => $user_list]);
    }

    /**
     * 添加管理员
     * @param $group_id
     */
    public function add($group_id = 0) {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'User');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
            	$data['add_time'] = now_time();
                $data['login_pwd'] = md5_salt($data['login_pwd']);
                if ($this->user_model->allowField(true)->save($data)) {
                    $auth_group_access['uid']      = $this->user_model->id;
                    $auth_group_access['group_id'] = $group_id;
                    $this->auth_group_access_model->save($auth_group_access);
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }else{
        	$auth_group_list = $this->auth_group_model->select();
        	return $this->fetch('add', ['auth_group_list' => $auth_group_list]);
        }
    }

    /**
     * 更新管理员
     * @param $id
     * @param $group_id
     */
    public function update($id, $group_id = 0) {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'User');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $user           = $this->user_model->find($id);
                $user->id       = $id;
                $user->login_name = $data['login_name'];
                $user->status   = $data['status'];
                if (!empty($data['login_pwd']) && !empty($data['confirm_pwd'])) {
                    $user->login_pwd = md5_salt($data['login_pwd']);
                }
                if ($user->save() !== false) {
                    $auth_group_access['uid']      = $id;
                    $auth_group_access['group_id'] = $group_id;
                    $this->auth_group_access_model->where('uid', $id)->update($auth_group_access);
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }else{
        	$user             = $this->user_model->find($id);
        	$auth_group_list        = $this->auth_group_model->select();
        	$auth_group_access      = $this->auth_group_access_model->where('uid', $id)->find();
        	$user['group_id'] = $auth_group_access['group_id'];
        	return $this->fetch('update', ['user' => $user, 'auth_group_list' => $auth_group_list]);
        }
    }

    /**
     * 删除管理员
     * @param $id
     */
    public function delete($id) {
        if ($id == 1) {
            $this->error('默认管理员不可删除');
        }
        if ($this->user_model->destroy($id)) {
            $this->auth_group_access_model->where('uid', $id)->delete();
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}
