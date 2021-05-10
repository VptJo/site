/**
 * 后台JS主入口
 */

layui.define(['form', 'layer', 'element', 'layedit', 'laydate', 'upload'], function(exports) {
	var layer = layui.layer,
		element = layui.element(),
		layedit = layui.layedit,
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
	 * 编辑器初始化
	 */
	var layedit_index = layedit.build('content', {
		tool: ['strong', 'italic', 'underline', 'del', '|', 'left', 'center', 'right', '|', 'link', 'unlink', 'image'],
		uploadImage: {
			url: "/index.php/admin/upload/upload",
			type: "post"
		}
	});

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
		data.field.content = layedit.getContent(layedit_index);
		$.ajax({
			url: data.form.action,
			type: data.form.method,
			data: data.field,
			success: function(info) {
				if(info.code === 1) {
					setTimeout(function() {
						location.href = info.url;
					}, 1000);
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
					}, 1000);
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
							}, 1000);
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
	 * 通用操作
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
						layer.msg(info.msg);
						if(info.code === 1) {
							setTimeout(function() {
								location.href = info.url;
							}, 1000);
						}
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
		url: "/index.php/index/index/upload",
		ext: 'jpg|png|gif',
		success: function(result, e) {
			$("input[name='" + e.id + "']").val(result.filename);
			$("#" + e.id.substr(0, e.id.length - 3)).prop("src", result.filename);
		}
	});

	exports('index', {});
});