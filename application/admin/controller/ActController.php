<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\admin\model\Act as Model;

/**
 * 活动管理
 * Class Member
 * @package app\admin\controller
 */
class ActController extends AdminBaseController {

	protected $model;

	protected function _initialize() {
		parent::_initialize();
		$this->model = new Model();
	}

	/**
	 * 列表
	 * @param string $keyword
	 * @param int    $page
	 * @return mixed
	 */
	public function index($keyword = '') {
		$map = array();
		if ($keyword) {
			$map['title'] = array(
				'like',
				"%{$keyword}%"
			);
		}
		$list = $this->model->where($map)->order('add_time DESC')->paginate(15, false, array('query' => get_query()));
		$this->assign('list', $list);
		$this->assign('keyword', $keyword);
		return $this->fetch();
	}

	/**
	 * 添加
	 */
	public function add() {
		if ($this->request->isPost()) {
			$data = $this->request->post();
			$validate_result = $this->validate($data, 'Act');
			if ($validate_result !== true) {
				$this->error($validate_result);
			} else {
				if ($this->model->allowField(true)->save($data)) {
					$this->success('保存成功');
				} else {
					$this->error('保存失败');
				}
			}
		} else {
			return $this->fetch();
		}
	}

	/**
	 * 更新
	 * @param $id
	 */
	public function update($id) {
		if ($this->request->isPost()) {
			$data = $this->request->post();
			$validate_result = $this->validate($data, 'Act');
			if ($validate_result !== true) {
				$this->error($validate_result);
			} else {
				if ($this->model->allowField(true)->save($data, array('id' => $id)) !== false) {
					$this->success('更新成功');
				} else {
					$this->error('更新失败');
				}
			}
		} else {
			$model = $this->model->find($id);
			$this->assign('model', $model);
			return $this->fetch();
		}
	}

	/**
	 * 删除
	 * @param $id
	 */
	public function delete($id) {
		if ($this->model->destroy($id)) {
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}

}
