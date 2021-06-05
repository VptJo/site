<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"E:\web\site/application/admin\view\replys\goods.html";i:1495866897;s:44:"E:\web\site/application/admin\view\base.html";i:1495860029;}*/ ?>
<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="UTF-8">
		<title>后台管理系统</title>
		<meta name="renderer" content="webkit">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="stylesheet" href="/public/static/layui/css/layui.css" media="all">
		<link rel="stylesheet" href="/public/static/css/font-awesome.min.css">
		<!--CSS引用-->
		
		<link rel="stylesheet" href="/public/static/css/admin.css">
		<!--[if lt IE 9]>
    <script src="/public/static/js/html5shiv.min.js"></script>
    <script src="/public/static/js/respond.min.js"></script>
    <![endif]-->
	</head>

	<body>
		<div class="layui-layout layui-layout-admin">
			<!--头部-->
			<div class="layui-header header">
				<a href=""><img class="logo" src="/public/static/images/admin_logo.png" alt=""></a>
				<div class="user-action">
					<a class="" href="/index.php/index/index" target="_blank"><i class="fa fa-home"></i> 网站前台</a>
					<a class="" href="/index.php/admin/system/clear"><i class="fa fa-eraser"></i> 清除缓存</a>
					<a href="/index.php/admin/index/update"><i class="fa fa-user"></i> <?php echo session('admin_name'); ?></a>
					<a class="" href="<?php echo url('admin/login/logout'); ?>"><i class="fa fa-power-off"></i> 退出系统</a>
				</div>
			</div>

			<!--侧边栏-->
			<div class="layui-side layui-bg-black">
				<div class="layui-side-scroll">
					<ul class="layui-nav layui-nav-tree">
						<li class="layui-nav-item layui-nav-title">
							<a href="/index.php/admin/index/index"><i class="fa fa-home"></i> 网站概览</a>
						</li>
						<?php if(is_array($menu) || $menu instanceof \think\Collection): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): if(isset($vo['children'])): ?>
						<li class="layui-nav-item">
							<a href="javascript:;"><i class="<?php echo $vo['icon']; ?>"></i> <?php echo $vo['title']; ?></a>
							<?php if(is_array($vo['children']) || $vo['children'] instanceof \think\Collection): if( count($vo['children'])==0 ) : echo "" ;else: foreach($vo['children'] as $key=>$v): ?>
							<dl class="layui-nav-child">
								<dd>
									<a href="<?php echo url($v['name']); ?>"> <?php echo $v['title']; ?></a>
								</dd>
							</dl>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</li>
						<?php else: ?>
						<li class="layui-nav-item">
							<a href="<?php echo url($vo['name']); ?>"><i class="<?php echo $vo['icon']; ?>"></i> <?php echo $vo['title']; ?></a>
						</li>
						<?php endif; endforeach; endif; else: echo "" ;endif; ?>

						<li class="layui-nav-item" style="height: 30px; text-align: center"></li>
					</ul>
				</div>
			</div>

			<!--主体-->
			
<div class="layui-body">
	<!--tab标签-->
	<div class="layui-tab layui-tab-brief">
		<ul class="layui-tab-title">
			<li class="layui-this">物料评论审核</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">

				<form class="layui-form layui-form-pane" action="<?php echo url('admin/replys/goods'); ?>" method="get">
					<div class="layui-inline">
						<label class="layui-form-label">关键词</label>
						<div class="layui-input-inline">
							<input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="请输入关键词" class="layui-input">
						</div>
					</div>
					<div class="layui-inline">
						<button class="layui-btn">搜索</button>
					</div>
				</form>
				<hr>

				<table class="layui-table">
					<thead>
						<tr>
							<th>姓名</th>
							<th>内容</th>
							<th>回复时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
						<tr>
							<td><?php echo $vo['name']; ?></td>
							<td><?php echo $vo['message']; ?></td>
							<td><?php echo $vo['add_time']; ?></td>
							<td>
								<a href="<?php echo url('admin/replys/goods_audit',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-normal layui-btn-small ajax-do">通过</a>
								<a href="<?php echo url('admin/replys/goods_del',['id'=>$vo['id']]); ?>" class="layui-btn layui-btn-danger layui-btn-small ajax-delete">删除</a>
							</td>
						</tr>
						<?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
				<!--分页-->
				<?php echo $list->render(); ?>
			</div>
		</div>
	</div>
</div>


			<!--底部-->
			<div class="layui-footer footer">
				<div class="layui-main">
					<p>2016 &copy;
						<a href="">Admin 管理系统</a>
					</p>
				</div>
			</div>
		</div>

		<!--JS引用-->
		<script src="/public/static/js/jquery.min.js"></script>
		<script src="/public/static/layui/layui.js"></script>
		

		<script>
			// 定义全局JS变量
			var GV = {
				current_controller: "admin/<?php echo $controller; ?>/"
			};

			layui.config({
				base: '/public/static/js/'
			}).use('admin');
		</script>

		<!--页面JS脚本-->
		
<script>
	var GV = {
		current_controller: "admin/<?php echo $controller; ?>/goods"
	};
</script>

	</body>

</html>