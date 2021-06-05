<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:51:"E:\web\site/application/admin\view\menu\update.html";i:1495866897;s:44:"E:\web\site/application/admin\view\base.html";i:1495860029;}*/ ?>
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
            <li class=""><a href="<?php echo url('admin/menu/index'); ?>">后台菜单</a></li>
            <li class="layui-this">编辑菜单</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <form class="layui-form form-container" action="<?php echo url('admin/menu/update'); ?>" method="post">
                    <div class="layui-form-item">
                        <label class="layui-form-label">上级菜单</label>
                        <div class="layui-input-block">
                            <select name="pid" lay-verify="required">
                                <option value="0">一级菜单</option>
                                <?php if(is_array($admin_menu_level_list) || $admin_menu_level_list instanceof \think\Collection): if( count($admin_menu_level_list)==0 ) : echo "" ;else: foreach($admin_menu_level_list as $key=>$vo): ?>
                                <option value="<?php echo $vo['id']; ?>" <?php if($admin_menu['id']==$vo['id']): ?> disabled="disabled"<?php endif; if($admin_menu['pid']==$vo['id']): ?> selected="selected"<?php endif; ?>><?php if($vo['level'] != '1'): ?>|<?php for($i=1;$i<$vo['level'];$i++){echo ' ----';} endif; ?> <?php echo $vo['title']; ?></option>
                                <?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="title" value="<?php echo $admin_menu['title']; ?>" required  lay-verify="required" placeholder="请输入菜单名称" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">控制器方法</label>
                        <div class="layui-input-block">
                            <input type="text" name="name" value="<?php echo $admin_menu['name']; ?>" required  lay-verify="required" placeholder="请输入控制器方法 如：admin/Index/index" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">图标</label>
                        <div class="layui-input-block">
                            <input type="text" name="icon" value="<?php echo $admin_menu['icon']; ?>" placeholder="（选填）如：fa fa-home" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="status" value="1" title="显示" <?php if($admin_menu['status']==1): ?> checked="checked"<?php endif; ?>>
                            <input type="radio" name="status" value="0" title="隐藏" <?php if($admin_menu['status']==0): ?> checked="checked"<?php endif; ?>>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="sort" value="<?php echo $admin_menu['sort']; ?>" required  lay-verify="required" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <input type="hidden" name="id" value="<?php echo $admin_menu['id']; ?>">
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
		
	</body>

</html>