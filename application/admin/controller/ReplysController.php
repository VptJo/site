<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;

/**
 * 艺人评论管理
 * Class Member
 * @package app\admin\controller
 */
class ReplysController extends AdminBaseController {

	protected function _initialize() {
		parent::_initialize();
	}

	/**
	 * 艺人管理
	 * @param string $keyword
	 * @param int    $page
	 * @return mixed
	 */
	public function artist($keyword = '') {
		$map['status'] = 0;
		if ($keyword) {
			$map['name|message'] = array(
				'like',
				"%{$keyword}%"
			);
		}
		$list = db('artist_replys')->where($map)->order('add_time DESC')->paginate(15, false, array('query' => get_query()));
		$this->assign('list', $list);
		$this->assign('keyword', $keyword);
		return $this->fetch();
	}

	/**
	 * 审核
	 * @param $id
	 */
	public function artist_audit($id) {
		$result = db('artist_replys')->where('id', $id)->setField('status', 1);
		if ($result) {
			$this->success('审核成功');
		} else {
			$this->error('审核失败');
		}
	}

	/**
	 * 删除
	 * @param $id
	 */
	public function artist_del($id) {
		$result = db('artist_replys')->where('id', $id)->setField('status', -1);
		if ($result) {
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}

	/**
	 * 场地管理
	 * @param string $keyword
	 * @param int    $page
	 * @return mixed
	 */
	public function area($keyword = '') {
		$map['status'] = 0;
		if ($keyword) {
			$map['name|message'] = array(
				'like',
				"%{$keyword}%"
			);
		}
		$list = db('area_replys')->where($map)->order('add_time DESC')->paginate(15, false, array('query' => get_query()));
		$this->assign('list', $list);
		$this->assign('keyword', $keyword);
		return $this->fetch();
	}

	/**
	 * 审核
	 * @param $id
	 */
	public function area_audit($id) {
		$result = db('area_replys')->where('id', $id)->setField('status', 1);
		if ($result) {
			$this->success('审核成功');
		} else {
			$this->error('审核失败');
		}
	}

	/**
	 * 删除
	 * @param $id
	 */
	public function area_del($id) {
		$result = db('area_replys')->where('id', $id)->setField('status', -1);
		if ($result) {
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}

	/**
	 * 物料管理
	 * @param string $keyword
	 * @param int    $page
	 * @return mixed
	 */
	public function goods($keyword = '') {
		$map['status'] = 0;
		if ($keyword) {
			$map['name|message'] = array(
				'like',
				"%{$keyword}%"
			);
		}
		$list = db('goods_replys')->where($map)->order('add_time DESC')->paginate(15, false, array('query' => get_query()));
		$this->assign('list', $list);
		$this->assign('keyword', $keyword);
		return $this->fetch();
	}

	/**
	 * 审核
	 * @param $id
	 */
	public function goods_audit($id) {
		$result = db('goods_replys')->where('id', $id)->setField('status', 1);
		if ($result) {
			$this->success('审核成功');
		} else {
			$this->error('审核失败');
		}
	}

	/**
	 * 删除
	 * @param $id
	 */
	public function goods_del($id) {
		$result = db('goods_replys')->where('id', $id)->setField('status', -1);
		if ($result) {
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}

}
