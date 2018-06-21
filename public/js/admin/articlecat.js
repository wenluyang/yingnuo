$('#cmd-cate-save').click(function () {
    var $form = $('#form-cate');
    var $id = $form.find('[name=id]').val();
    if (!$form.find('[name=name]').val().trim().length) {
        layer.alert('栏目名称不能为空', function (index) {
            $form.find('[name=name]').focus();
            layer.close(index);
        });
        return false;
    }

    if($id==0){
        var $url= common_ops.buildAdminUrl('/articlecat/store');
    }else{
        var $url=common_ops.buildAdminUrl('/articlecat/###/update').replace('###', $id)
    }

    $.post(
        $url,
        $form.serialize() + '&_method=POST',
        function (response) {
            if (response.status) {
                layer.msg('保存成功', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/articlecat');
                });
            }
        },
        'json'
);
});


// 隐藏标签
$('#category-tags').on('click', '.cmd-category-tag-hide', function () {
    var $this = $(this);

    $.post(
        common_ops.buildAdminUrl('/articlecat/###/hide').replace('###', $this.parent().data('id')),
        {_method: 'PATCH'},
        function (response) {
            if (response.status) {

                layer.msg('设置隐藏成功', {time: 1000},function () {
                    window.location.reload();
                });
            }
        },
        'json'
);
});


// 显示标签
$('#category-tags').on('click', '.cmd-category-tag-show', function () {
    var $this = $(this);

    $.post(
        common_ops.buildAdminUrl('/articlecat/###/display').replace('###', $this.parent().data('id')),
        {_method: 'PATCH'},
        function (response) {
            if (response.status) {
                layer.msg('设置显示成功', {time: 1000},function () {
                    window.location.reload();
                });
            }
        },
        'json'
);
});


// 删除商学院
$('#category-tags').on('click', '.cmd-category-tag-delete', function () {
    var $this = $(this);
    layer.confirm('确认删除？', {icon: 3, title: '提示'}, function (index) {
        $.post(
            common_ops.buildAdminUrl('/articlecat/###/delete').replace('###', $this.parent().data('id')),
            {_method: 'delete'},
            function (response) {
                if (response.status) {
                    if ($('#category-tags .list-group-item').length == 1) {
                        $('#category-tags').empty().append('<div class="list-group-item">没有栏目分类</div>');
                    } else {
                        $this.closest('.list-group-item').remove();
                    }
                    layer.close(index);
                }
            },
            'json'
    );
    });
});
