<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:50:"E:\web\site/application/index\view\area\index.html";i:1495856712;}*/ ?>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="applicable-device" content="mobile" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>万一传媒</title>
		<link href="__CSS__/public.css" rel="stylesheet" type="text/css" />
		<link href="__CSS__/baoliao.css" rel="stylesheet" type="text/css">

		<script src="__JS__/jquery-1.8.3.min.js"></script>
		<script>
			$(window).load(function() {
				$("#status").fadeOut();
				$("#preloader").delay(350).fadeOut("slow");
			})
		</script>
	</head>

	<body>
		<div class="mobile">
			<!--页面加载 开始-->
			<div id="preloader">
				<div id="status">
					<p class="center-text"><span>数据加载中···</span></p>
				</div>
			</div>
			<!--页面加载 结束-->
			<!--header 开始-->
			<header>
				<div class="header">
					<h2>场地分类</h2>
				</div>
			</header>
			<!--header 结束-->
			<div class="guanggao">
				<img src="__IMG__/ad-01.jpg" />
			</div>
			<div class="cate">
				<?php if(is_array($list) || $list instanceof \think\Collection): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
				<div class="photo">
					<a href="<?php echo url('area/show',array('id'=>$vo['id'])); ?>"><img src="<?php echo $vo['thumb']; ?>" /></a>
					<span><?php echo $vo['name']; ?></span>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="copyright">Copyright © 2017-2018 版权所有</div>
		</div>
	</body>

</html>