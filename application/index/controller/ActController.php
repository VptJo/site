<?php
namespace app\index\controller;
/**
 * 活动
 */
class actController extends BaseController {

	
	public function index() {
		$list = db('act')->order('sort')->select();
		$this->assign('list', $list);
		return $this->fetch();
	}

	
	public function show($id) {
		$act = db('act')->where('id', $id)->find();
		$this->assign('act', $act);
		return $this->fetch();
	}
	
	public function praise() {
		$type=1;
		$order="praise desc ";
		if(input("type")){
			$type=input("type");
		}
		if($type==2){
			$order="clicks desc ";
		}
		$list = db('cas')->order($order)->select();
		$this->assign('type', $type);
		$this->assign('list', $list);
		return $this->fetch('praise');
	}
	/**
	 * 详细
	 */
	public function detail($id) {
		$model = db('act')->where('id', $id)->find($id);
		if (!$model) {
			$this->error('您要查看的数据不存在！');
		}

		$replys = db('act_replys')->where('aid', $id)->order('add_time desc')->select();
		$this->assign('replys', $replys);
		$this->assign('model', $model);
		// 增加点击
		db('act')->where('id', $id)->setInc('clicks');
		return $this->fetch();
	}

	/**
	 * 评论
	 */
	public function reply() {
		$data = request()->post();
		$member = db('member')->where('openid', session('openid'))->find();
		$data['add_time'] = now_time();
		$data['open_id'] = session('openid');
		$data['name'] = $member['nickname'];
		$data['thumb'] = $member['headimgurl'];
		$data['ip'] = request()->ip();
		$result = db('act_replys')->insertGetId($data);
		if ($result) {
			$reply = db('act_replys')->find($result);
			$this->success('评论成功, 审核后才能显示！', '', $reply);
		} else {
			$this->error('评论失败');
		}
	}

	public function zan($id) {
		// 点赞
		if (request()->isAjax()) {
			// 判断是否今日点赞过,一个用户一个IP一天一次哦
			$zan = db('act_zan')->where('aid', $id)->where('open_id', session('openid'))->find();
			if ($zan && substr($zan['add_time'], 0, 10) == date('Y-m-d')) {
				$this->error('今天已经赞过了！');
			}
			$data['ip'] = request()->ip();
			$data['aid'] = $id;
			$data['add_time'] = now_time();
			$result = db('act')->where('id', $id)->setInc('praise');
			$result2 = db('act_zan')->insert($data);
			if ($result && $result2) {
				$this->success('点赞成功');
			} else {
				$this->error('点赞失败');
			}
		}
	}

}
