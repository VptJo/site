<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:52:"E:\web\site/application/admin\view\goods\update.html";i:1495866896;s:44:"E:\web\site/application/admin\view\base.html";i:1495860029;}*/ ?>
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
				<a href="<?php echo url('admin/goods/index'); ?>">物料管理</a>
			</li>
			<li class="layui-this">编辑物料</li>
		</ul>
		<div class="layui-tab-content">
			<div class="layui-tab-item layui-show">
				<form class="layui-form form-container" action="<?php echo url('admin/goods/update'); ?>" method="post">
					<div class="layui-form-item">
						<label class="layui-form-label">所属分类</label>
						<div class="layui-input-block">
							<select name="cate_id" lay-verify="required">
								<?php if(is_array($category_level_list) || $category_level_list instanceof \think\Collection): if( count($category_level_list)==0 ) : echo "" ;else: foreach($category_level_list as $key=>$vo): ?>
								<option value="<?php echo $vo['id']; ?>" <?php if($model['cate_id']==$vo['id']): ?> selected<?php endif; ?>><?php if($vo['level'] != '1'): ?>| <?php for($i=1;$i
									<$vo[ 'level'];$i++){echo ' ----';} endif; ?> <?php echo $vo['name']; ?></option>
										<?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">标题</label>
						<div class="layui-input-block">
							<input type="text" name="title" value="<?php echo $model['title']; ?>" placeholder="请输入标题" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">费用</label>
						<div class="layui-input-block">
							<input type="text" name="money" value="<?php echo $model['money']; ?>" placeholder="请输入费用" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">本月档期</label>
						<div class="layui-input-block">
							<table id="calendar" class="calendar">
								<tr>
									<td>1<input name="dangqi[1]" type="checkbox" /></td>
									<td>2<input name="dangqi[2]" type="checkbox" /></td>
									<td>3<input name="dangqi[3]" type="checkbox" /></td>
									<td>4<input name="dangqi[4]" type="checkbox" /></td>
									<td>5<input name="dangqi[5]" type="checkbox" /></td>
									<td>6<input name="dangqi[6]" type="checkbox" /></td>
									<td>7<input name="dangqi[7]" type="checkbox" /></td>
								</tr>
								<tr>
									<td>8<input name="dangqi[8]" type="checkbox" /></td>
									<td>9<input name="dangqi[9]" type="checkbox" /></td>
									<td>10<input name="dangqi[10]" type="checkbox" /></td>
									<td>11<input name="dangqi[11]" type="checkbox" /></td>
									<td>12<input name="dangqi[12]" type="checkbox" /></td>
									<td>13<input name="dangqi[13]" type="checkbox" /></td>
									<td>14<input name="dangqi[14]" type="checkbox" /></td>
								</tr>
								<tr>
									<td>15<input name="dangqi[15]" type="checkbox" /></td>
									<td>16<input name="dangqi[16]" type="checkbox" /></td>
									<td>17<input name="dangqi[17]" type="checkbox" /></td>
									<td>18<input name="dangqi[18]" type="checkbox" /></td>
									<td>19<input name="dangqi[19]" type="checkbox" /></td>
									<td>20<input name="dangqi[20]" type="checkbox" /></td>
									<td>21<input name="dangqi[21]" type="checkbox" /></td>
								</tr>
								<tr>
									<td>22<input name="dangqi[22]" type="checkbox" /></td>
									<td>23<input name="dangqi[23]" type="checkbox" /></td>
									<td>24<input name="dangqi[24]" type="checkbox" /></td>
									<td>25<input name="dangqi[25]" type="checkbox" /></td>
									<td>26<input name="dangqi[26]" type="checkbox" /></td>
									<td>27<input name="dangqi[27]" type="checkbox" /></td>
									<td>28<input name="dangqi[28]" type="checkbox" /></td>
								</tr>
								<tr>
									<td>29<input name="dangqi[29]" type="checkbox" /></td>
									<td>30<input name="dangqi[30]" type="checkbox" /></td>
									<td>31<input name="dangqi[31]" type="checkbox" /></td>
								</tr>
							</table>
							(红色为占用日期)
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">物料封面</label>
						<div class="layui-input-block" id="upload-div">
							<img class="img-see" src="<?php echo $model['thumb']; ?>" />
							<input type="text" name="thumb" value="<?php echo $model['thumb']; ?>" readonly class="layui-input layui-input-inline">
							<input type="file" name="file" class="layui-upload-file">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">物料图集</label>
						<div class="layui-input-block">
							<button type="button" id="upload-photo-btn" class="layui-btn">上传图集</button>
							<div id="photo-container">
							</div>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">详细内容</label>
						<div class="layui-input-block">
							<textarea id="content" name="content" class="layui-textarea" lay-verify="content"><?php echo $model['content']; ?></textarea>
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">访问量</label>
						<div class="layui-input-block">
							<input type="text" name="clicks" value="<?php echo $model['clicks']; ?>" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">点赞数</label>
						<div class="layui-input-block">
							<input type="text" name="praise" value="<?php echo $model['praise']; ?>" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">添加时间</label>
						<div class="layui-input-block">
							<input type="text" readonly value="<?php echo $model['add_time']; ?>" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">修改时间</label>
						<div class="layui-input-block">
							<input type="text" readonly value="<?php echo $model['update_time']; ?>" class="layui-input">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">状态</label>
						<div class="layui-input-block">
							<input type="radio" name="status" value="1" title="显示" <?php if($model['status']==1): ?> checked="checked" <?php endif; ?>>
							<input type="radio" name="status" value="0" title="隐藏" <?php if($model['status']==0): ?> checked="checked" <?php endif; ?>>
						</div>
					</div>
					<div class="layui-form-item">
						<div class="layui-input-block">
							<input type="hidden" name="id" value="<?php echo $model['id']; ?>">
							<button class="layui-btn" lay-submit lay-filter="*">更新</button>
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
		// 加载数据--档期
		var dangqi = "<?php echo $model['dangqi']; ?>".split(",");
		for(var i = 0; i < dangqi.length; i++) {
			$("input[type=checkbox][name='dangqi[" + dangqi[i] + "]']").prop("checked", true);
		}
		$('#photo-container').append(photo_list);

		// 加载数据--图册
		var photos = "<?php echo $model['photo']; ?>".split(",");
		var photo_list = '';
		for(var i = 0; i < photos.length; i++) {
			photo_list += '<div class="photo-list"><img src="' + photos[i] +
				'" class="photo-see" /><input type="text" name="photo[' + photos[i] + ']" style="display:none;">';
			photo_list += '<button class="layui-btn layui-btn-danger remove-photo-btn">移除</button></div>';
		}
		$('#photo-container').append(photo_list);
	});
</script>

	</body>

</html>