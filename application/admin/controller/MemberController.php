<?php
namespace app\admin\controller;

use app\admin\model\Member as MemberModel;
use app\common\controller\AdminBaseController;
use think\Config;
use think\Db;

/**
 * 用户管理
 * Class Member
 * @package app\admin\controller
 */
class MemberController extends AdminBaseController {
    protected $member_model;

    protected function _initialize() {
        parent::_initialize();
        $this->member_model = new MemberModel();
    }

    /**
     * 用户管理
     * @param string $keyword
     * @param int    $page
     * @return mixed
     */
    public function index($keyword = '') {
        $map = [];
        if ($keyword) {
            $map['nickname|mobile'] = ['like', "%{$keyword}%"];
        }
        $member_list = $this->member_model->where($map)->order('add_time DESC')->paginate(15, false, ['query' => get_query()]);
        return $this->fetch('index', ['member_list' => $member_list, 'keyword' => $keyword]);
    }
	
    /**
     * 添加用户
     */
    public function add() {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Member');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                $data['password'] = md5_salt($data['password']);
                $data['pay_password'] = md5_salt($data['password']);
                if ($this->member_model->allowField(true)->save($data)) {
                    $this->success('保存成功');
                } else {
                    $this->error('保存失败');
                }
            }
        }else{
        	return $this->fetch();
        }
    }

    /**
     * 更新用户
     * @param $id
     */
    public function update($id) {
        if ($this->request->isPost()) {
            $data            = $this->request->post();
            $validate_result = $this->validate($data, 'Member');

            if ($validate_result !== true) {
                $this->error($validate_result);
            } else {
                if (!empty($data['password'])) {
                    $data['password'] = md5_salt($data['password']);
                }else{
                	$data['password'] = $data['old_pwd'];
                }
                if ($this->member_model->allowField(true)->save($data,['id'=>$id]) !== false) {
                    $this->success('更新成功');
                } else {
                    $this->error('更新失败');
                }
            }
        }else{
        	$member = $this->member_model->find($id);
        	return $this->fetch('update', ['member' => $member]);
        }
    }
	
    /**
     * 删除用户
     * @param $id
     */
    public function delete($id) {
        if ($this->member_model->destroy($id)) {
            $this->success('删除成功');
        } else {
            $this->error('删除失败');
        }
    }
	
}
