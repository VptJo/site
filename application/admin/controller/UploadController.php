<?php
namespace app\admin\controller;

use app\common\controller\AdminBaseController;

/**
 * 通用上传接口
 * Class Upload
 * @package app\api\controller
 */
class UploadController extends AdminBaseController {

	protected function _initialize() {
		parent::_initialize();
		if (!session('admin_id')) {
			$this->error('未登录');
		}
	}

	/**
	 * 通用图片上传接口
	 * @return \think\response\Json
	 */
	public function upload() {
		$config = array(
			'size' => 2097152,
			'ext' => 'jpg,gif,png,bmp'
		);
		$file = $this->request->file('file');
		$save_path = '/public/uploads/';
		$upload_path = str_replace('\\', '/', ROOT_PATH . $save_path);
		$info = $file->validate($config)->move($upload_path);
		if ($info) {
			$result = array(
				'error' => 0,
				'url' => str_replace('\\', '/', $save_path . $info->getSaveName())
			);
		} else {
			$result = array(
				'error' => 1,
				'message' => $file->getError()
			);
		}
		return json($result);
	}

}
