<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:47:"E:\web\site/application/admin\view\act\add.html";i:1495866896;s:44:"E:\web\site/application/admin\view\base.html";i:1495860029;}*/ ?>
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
			<li class="">
				<a href="<?php echo url('admin/act/index'); ?>">活动管理</a>
			</li>
			<li class="layui-this">添加活动</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<form class="layui-form form-container" action="<?php echo url('admin/act/add'); ?>" method="post">
					
					<div class="layui-form-item">
						<label class="layui-form-label">标题</label>
						<div class="layui-input-block">
							<input type="text" name="title" required lay-verify="required" placeholder="请输入标题" class="layui-input">
						</div>
					</div>
				<div class="layui-form-item">
						<label class="layui-form-label">活动封面</label>
						<div class="layui-input-block" id="upload-div">
							<img src="" class="img-see" />
							<input type="text" name="thumb" readonly class="layui-input layui-input-inline">
							<input type="file" name="file" class="layui-upload-file">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">详细内容</label>
						<div class="layui-input-block">
							<textarea id="content" name="content" class="layui-textarea" lay-verify="content"></textarea>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">状态</label>
						<div class="layui-input-block">
							<input type="radio" name="status" value="1" title="显示" checked="checked">
							<input type="radio" name="status" value="0" title="隐藏">
						</div>
					</div>
					<div class="layui-form-item">
						<div class="layui-input-block">
							<button class="layui-btn" lay-submit lay-filter="*">保存</button>
							<button type="reset" class="layui-btn layui-btn-primary">重置</button>
						</div>
					</div>
				</form>
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
		
<script src="__JS__/kindeditor/kindeditor.config.js"></script>
<script src="__JS__/kindeditor/kindeditor-all-min.js"></script>


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
	$(document).ready(function() {
		var _kindEditor;
		KindEditor.ready(function(K) {
			_kindEditor = K.create('#content', KindEditorOptions);
			K('#upload-photo-btn').click(function() {
				var photo_list_item = '';
				_kindEditor.loadPlugin('multiimage', function() {
					_kindEditor.plugin.multiImageDialog({
						showRemote: false,
						imageUrl: K('#photo').val(),
						clickFn: function(data) {
							$.each(data, function(index, item) {
								photo_list_item += '<div class="photo-list"><img src="' + item.url +
									'" class="photo-see" /><input type="text" name="photo[' + item.url + ']" style="display:none;">';
								photo_list_item += '<button class="layui-btn layui-btn-danger remove-photo-btn">移除</button></div>';
							});
							$('#photo-container').append(photo_list_item);
							_kindEditor.hideDialog();
						}
					});
				});
			});
		});

		$('#photo-container').on('click', '.remove-photo-btn', function() {
			$(this).parent('.photo-list').remove();
		});
	});
</script>

	</body>

</html>