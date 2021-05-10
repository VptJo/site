<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;
use app\admin\model\Category as CategoryModel;
use app\admin\model\Artist as ArtistModel;

/**
 * 艺人管理
 * Class Member
 * @package app\admin\controller
 */
class ArtistController extends AdminBaseController {

	protected $category_model;
	protected $artist_model;

	protected function _initialize() {
		parent::_initialize();
		$this->category_model = new CategoryModel();
		$this->artist_model = new ArtistModel();
		$category_level_list = $this->category_model->getLevelList(1);
		$this->assign('category_level_list', $category_level_list);
	}

	/**
	 * 艺人管理
	 * @param string $keyword
	 * @param int    $page
	 * @return mixed
	 */
	public function index($keyword = '', $cate_id = '') {
		$map = array();
		if ($keyword) {
			$map['title|number'] = array(
				'like',
				"%{$keyword}%"
			);
		}
		if ($cate_id) {
			$map['cate_id'] = $cate_id;
		}
		$list = $this->artist_model->where($map)->order('add_time DESC')->paginate(15, false, array('query' => get_query()));
		$this->assign('list', $list);
		$this->assign('keyword', $keyword);
		$this->assign('cate_id', $cate_id);
		return $this->fetch();
	}

	/**
	 * 添加
	 */
	public function add() {
		if ($this->request->isPost()) {
			$data = $this->request->post();
			$validate_result = $this->validate($data, 'Artist');
			if ($validate_result !== true) {
				$this->error($validate_result);
			} else {
				$dangqi = implode(',', array_keys(input('dangqi/a', array())));
				$data['dangqi'] = $dangqi;
				$photo = implode(',', array_keys(input('photo/a', array())));
				$data['photo'] = $photo;
				if ($this->artist_model->allowField(true)->save($data)) {
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
			$validate_result = $this->validate($data, 'Artist');
			if ($validate_result !== true) {
				$this->error($validate_result);
			} else {
				$dangqi = implode(',', array_keys(input('dangqi/a', array())));
				$data['dangqi'] = $dangqi;
				$photo = implode(',', array_keys(input('photo/a', array())));
				$data['photo'] = $photo;
				if ($this->artist_model->allowField(true)->save($data, array('id' => $id)) !== false) {
					$this->success('更新成功');
				} else {
					$this->error('更新失败');
				}
			}
		} else {
			$model = $this->artist_model->find($id);
			$this->assign('model', $model);
			return $this->fetch();
		}
	}

	/**
	 * 删除
	 * @param $id
	 */
	public function delete($id) {
		if ($this->artist_model->destroy($id)) {
			$this->success('删除成功');
		} else {
			$this->error('删除失败');
		}
	}

}
