/**
 * 后台JS主入口
 */

layui.define(['form', 'layer', 'element', 'laydate', 'upload'], function(exports) {
	var layer = layui.layer,
		element = layui.element(),
		laydate = layui.laydate,
		form = layui.form();

	/**
	 * AJAX全局设置
	 */
	$.ajaxSetup({
		type: "post",
		dataType: "json"
	});

	/**
	 * 后台侧边菜单选中状态
	 */
	$('.layui-nav-item').find('a').removeClass('layui-this');
	$('.layui-nav-tree').find('a[href*="' + GV.current_controller + '"]').parent().addClass('layui-this').parents('.layui-nav-item').addClass('layui-nav-itemed');

	/**
	 * 通用日期时间选择
	 */
	$('#datetime').on('click', function() {
		laydate({
			elem: this,
			istime: true,
			format: 'YYYY-MM-DD hh:mm:ss'
		})
	});

	/**
	 * 通用表单提交(AJAX方式)
	 */
	form.on('submit(*)', function(data) {
		$.ajax({
			url: data.form.action,
			type: data.form.method,
			data: data.field,
			success: function(info) {
				if(info.code === 1) {
					setTimeout(function() {
						location.href = info.url;
					}, 800);
				}
				layer.msg(info.msg);
			}
		});

		return false;
	});

	/**
	 * 通用批量处理（批量审核、取消审核、删除）
	 */
	$('.ajax-action').on('click', function() {
		var _action = $(this).data('action');
		$.ajax({
			url: _action,
			data: $('.ajax-form').serialize(),
			success: function(info) {
				if(info.code === 1) {
					setTimeout(function() {
						location.href = info.url;
					}, 800);
				}
				layer.msg(info.msg);
			}
		});

		return false;
	});

	/**
	 * 通用全选
	 */
	$('.check-all').on('click', function() {
		$(this).parents('table').find('input[type="checkbox"]').prop('checked', $(this).prop('checked'));
	});

	/**
	 * 通用删除
	 */
	$('.ajax-delete').on('click', function() {
		var _href = $(this).attr('href');
		layer.open({
			shade: false,
			content: '确定删除？',
			btn: ['确定', '取消'],
			yes: function(index) {
				$.ajax({
					url: _href,
					type: "get",
					success: function(info) {
						if(info.code === 1) {
							setTimeout(function() {
								location.href = info.url;
							}, 800);
						}
						layer.msg(info.msg);
					}
				});
				layer.close(index);
			}
		});

		return false;
	});

	/**
	 * 通用
	 */
	$('.ajax-do').on('click', function() {
		var _href = $(this).attr('href');
		layer.open({
			shade: false,
			content: '确定操作？',
			btn: ['确定', '取消'],
			yes: function(index) {
				$.ajax({
					url: _href,
					type: "post",
					success: function(info) {
						if(info.code === 1) {
							setTimeout(function() {
								location.href = info.url;
							}, 800);
						}
						layer.msg(info.msg);
					}
				});
				layer.close(index);
			}
		});

		return false;
	});

	/**
	 * 通用缩略图上传
	 */
	layui.upload({
		url: "/index.php/admin/upload/upload",
		ext: 'jpg|png|gif',
		success: function(result, e) {
			$("#upload-div").find(".layui-input").val(result.url);
			$("#upload-div").find("img").prop("src", result.url);
		}
	});

	/**
	 * 清除缓存
	 */
	$('#clear-cache').on('click', function(event) {
		event.preventDefault();
		var _url = $(this).data('url');
		if(_url !== 'undefined') {
			$.ajax({
				url: _url,
				success: function(data) {
					if(data.code === 1) {
						setTimeout(function() {
							location.href = location.pathname;
						}, 800);
					}
					layer.msg(data.msg);
				}
			});
		}

		return false;
	});

	exports('admin', {});
});