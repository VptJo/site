<?php
namespace app\admin\controller;

use app\admin\model\AuthGroup as AuthGroupModel;
use app\admin\model\AuthRule as AuthRuleModel;
use app\common\controller\AdminBaseController;

/**
 * 权限组
 * Class AuthGroup
 * @package app\admin\controller
 */
class AuthGroupController extends AdminBaseController {
    protected $auth_group_model;
    protected $auth_rule_model;

    protected function _initialize() {
        parent::_initialize();
        $this->auth_group_model = new AuthGroupModel();
        $this->auth_rule_model  = new AuthRuleModel();
    }

    /**
     * 权限组
     * @return mixed
     */
    public function index() {
        $auth_group_list = $this->auth_group_model->select();

        return $this->fetch('index', ['auth_group_list' => $auth_group_list]);
    }

    /**
     * 添加权限组
     */
    public function add() {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if ($this->auth_group_model->save($data) !== false) {
                $this->success('保存成功');
            } else {
                $this->error('保存失败');
            }
        }else{
        	return $this->fetch();
        }
    }

    /**
     * 更新权限组
     * @param $id
     */
    public function update($id) {
        if ($this->request->isPost()) {
            $data = $this->request->post();

            if($id == 1 && $data['status'] != 1){
                $this->error('超级管理组不可禁用');
            }
            if ($this->auth_group_model->save($data, $id) !== false) {
                $this->success('更新成功');
            } else {
                $this->error('更新失败');
            }
        }else{
        	$auth_group = $this->auth_group_model->find($id);
        	return $this->fetch('update', ['auth_group' => $auth_group]);
        }
    }

    /**
     * 删除权限组
     * @param $id
     */
    public function delete($id) {
        if($id == 1){
            $this->error('超级管理组不可删除');
        }
        if ($this->auth_group_model->destroy($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }

    /**
     * AJAX获取规则数据
     * @param $id
     * @return mixed
     */
    public function getJson($id) {
        $auth_group_data = $this->auth_group_model->find($id)->toArray();
        $auth_rules      = explode(',', $auth_group_data['rules']);
        $auth_rule_list  = $this->auth_rule_model->field('id,pid,title')->select();

        foreach ($auth_rule_list as $key => $value) {
            in_array($value['id'], $auth_rules) && $auth_rule_list[$key]['checked'] = true;
        }

        return $auth_rule_list;
    }

    /**
     * 更新权限组规则
     * @param $id
     * @param $auth_rule_ids
     */
    public function auth($id, $auth_rule_ids = '') {
        if ($this->request->isPost()) {
            if ($id) {
                $group_data['id']    = $id;
                $group_data['rules'] = is_array($auth_rule_ids) ? implode(',', $auth_rule_ids) : '';

                if ($this->auth_group_model->save($group_data, $id) !== false) {
                    $this->success('授权成功');
                } else {
                    $this->error('授权失败');
                }
            }
        }else{
        	return $this->fetch('auth', ['id' => $id]);
        }
    }
}