<?php
namespace app\admin\controller;

use app\admin\model\AuthRule as AuthRuleModel;
use app\common\controller\AdminBaseController;
use think\Db;

/**
 * 后台菜单
 * Class Menu
 * @package app\admin\controller
 */
class MenuController extends AdminBaseController {

    protected $auth_rule_model;

    protected function _initialize() {
        parent::_initialize();
        $this->auth_rule_model = new AuthRuleModel();
        $admin_menu_list       = $this->auth_rule_model->order(['sort' => 'ASC', 'id' => 'ASC'])->select();
        $admin_menu_level_list = array2level($admin_menu_list);

        $this->assign('admin_menu_level_list', $admin_menu_level_list);
    }

    /**
     * 后台菜单
     * @return mixed
     */
    public function index() {
        return $this->fetch();
    }

    /**
     * 添加菜单
     */
    public function add($pid = 0) {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Menu');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->auth_rule_model->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }else{
        	return $this->fetch('add', ['pid' => $pid]);
        }
    }

    /**
     * 更新菜单
     * @param $id
     */
    public function update($id) {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Menu');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if ($this->auth_rule_model->save($data, $id) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }else{
        	$admin_menu = $this->auth_rule_model->find($id);
        	return $this->fetch('update', ['admin_menu' => $admin_menu]);
        }
    }

    /**
     * 删除菜单
     * @param $id
     */
    public function delete($id) {
        if ($this->auth_rule_model->destroy($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
}