$('#cmd-cate-save').click(function () {
    var $form = $('#form-cate');
    var $id = $form.find('[name=id]').val();
    if (!$form.find('[name=name]').val().trim().length) {
        layer.alert('产品分类名称不能为空', function (index) {
            $form.find('[name=name]').focus();
            layer.close(index);
        });
        return false;
    }

    if (!$form.find('[name=description]').val().trim().length) {
        layer.alert('产品分类描述不能为空', function (index) {
            $form.find('[name=description]').focus();
            layer.close(index);
        });
        return false;
    }

    if (!$form.find('[name=image]').val().trim().length) {
        layer.alert('产品分类封面不能为空', function (index) {
            $form.find('[name=image]').focus();
            layer.close(index);
        });
        return false;
    }

    if($id==0){
        var $url= common_ops.buildAdminUrl('/category/store');
    }else{
        var $url=common_ops.buildAdminUrl('/category/###/update').replace('###', $id)
    }

    $.post(
        $url,
        $form.serialize() + '&_method=POST',
        function (response) {
            if (response.status) {
                layer.msg('保存成功', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/category');
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
        common_ops.buildAdminUrl('/category/###/hide').replace('###', $this.parent().data('id')),
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
        common_ops.buildAdminUrl('/category/###/display').replace('###', $this.parent().data('id')),
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
            common_ops.buildAdminUrl('/category/###/delete').replace('###', $this.parent().data('id')),
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

// 排序
$('.cmd-set-sort').click(function () {
    var $this = $(this);

    layer.prompt({value: $this.data('sort'), title: '请输入正确的序号'}, function (sort) {
        if (!sort.match(/^\d+$/)) {
            layer.msg('必须填写正整数', {time: 1000});
            return false;
        }
        $.post(
            common_ops.buildAdminUrl('/category/###/sort').replace('###', $this.data('id')),
            {_method: 'post', sort: sort},
            function (response) {
                window.location.reload();
            },
            'json'
        );
    });
});
