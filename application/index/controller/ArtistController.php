<?php
namespace app\index\controller;
/**
 * 艺人
 */
class ArtistController extends BaseController {

	/**
	 * 艺人分类列表
	 */
	public function index() {
		$list = db('category')->where('pid', 1)->order('sort')->select();
		$this->assign('list', $list);
		return $this->fetch();
	}

	/**
	 * 艺人排行榜按点赞次数
	 * @return mixed
	 */
	public function praise() {
		$type=1;
		$order="praise desc ";
		if(input("type")){
			$type=input("type");
		}
		if($type==2){
			$order="clicks desc ";
		}
		$list = db('artist')->order($order)->select();
		$this->assign('type', $type);
		$this->assign('list', $list);
		return $this->fetch('praise');
	}

	/**
	 * 艺人列表
	 */
	public function show($id) {
		$cate = db('category')->where('id', $id)->find();
		$this->assign('cate', $cate);
		$list = db('artist')->where('cate_id', $id)->where('status', 1)->order('sort')->select();
		$this->assign('list', $list);
		return $this->fetch();
	}

	/**
	 * 艺人详细
	 */
	public function detail($id) {
		$model = db('artist')->where('id', $id)->find($id);
		if (!$model) {
			$this->error('您要查看的数据不存在！');
		}
		$model['dangqis'] = explode(',', $model['dangqi']);
		if ($model['photo']) {
			$photos = explode(',', $model['photo']);
			foreach ($photos as $photo) {
				$model['photos'][] = $photo;
			}
		}
		$this->assign('model', $model);
		$cate = db('category')->where('id', $model['cate_id'])->find();
		$this->assign('cate', $cate);
		$replys = db('artist_replys')->where('aid', $id)->order('add_time desc')->select();
		$this->assign('replys', $replys);
		// 增加点击
		db('artist')->where('id', $id)->setInc('clicks');
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
		$result = db('artist_replys')->insertGetId($data);
		if ($result) {
			$reply = db('artist_replys')->find($result);
			$this->success('评论成功, 审核后才能显示！', '', $reply);
		} else {
			$this->error('评论失败');
		}
	}

	public function zan($id) {
		// 点赞
		if (request()->isAjax()) {
			// 判断是否今日点赞过,一个用户一个IP一天一次哦
			$zan = db('artist_zan')->where('aid', $id)->where('open_id', session('openid'))->find();
			if ($zan && substr($zan['add_time'], 0, 10) == date('Y-m-d')) {
				$this->error('今天已经赞过了！');
			}
			$data['ip'] = request()->ip();
			$data['aid'] = $id;
			$data['add_time'] = now_time();
			$data['open_id'] = session('openid');
			$result = db('artist')->where('id', $id)->setInc('praise');
			$result2 = db('artist_zan')->insert($data);
			if ($result && $result2) {
				$this->success('点赞成功');
			} else {
				$this->error('点赞失败');
			}
		}
	}

}
