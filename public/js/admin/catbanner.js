$('#cmd-slideshow-save').click(function () {
    var $form = $('#form-slideshow');
    var $id=$form.find('[name=id]').val();

    if ($form.find('[name=category_id]').val()==0) {
        layer.alert('请选择一个产品分类', function (index) {
            $form.find('[name=category_id]').focus();
            layer.close(index);
        });
        return false;
    }


    if (!$form.find('[name=title]').val().trim().length) {
        layer.alert('轮播图标题不能为空', function (index) {
            $form.find('[name=title]').focus();
            layer.close(index);
        });
        return false;
    }


    if (!$form.find('[name=url]').val().trim().length) {
        layer.alert('轮播图网址不能为空', function (index) {
            $form.find('[name=url]').focus();
            layer.close(index);
        });
        return false;
    }


    if (!$form.find('[name=image]').val().trim().length) {
        layer.alert('轮播图图片必须上传', function (index) {
            $form.find('[name=image]').focus();
            layer.close(index);
        });
        return false;
    }
    if($id==0){
        var $url=common_ops.buildAdminUrl('/catbanner/store')
    }else {
        var $url=common_ops.buildAdminUrl('/catbanner/###/update').replace('###', $id)
    }

    $.post(
        $url,
        $form.serialize() + '&_method=POST',
        function (response) {
            if (response.status) {
                layer.msg('保存成功', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/catbanner');
                });
            }
        },
        'json'
    );
});



// 删除轮播图
$('.cmd-slideshow-delete').click(function () {
    var $this = $(this);
    layer.confirm('确认删除？', {icon: 3, title: '提示'}, function (index) {
        $.post(
            common_ops.buildAdminUrl('/catbanner/###/delete').replace('###', $this.parent().data('id')),
            {_method: 'delete'},
            function (response) {
                if (response.status) {
                    if ($('#category-tags .list-group-item').length == 1) {
                        $('#category-tags').empty().append('<div class="list-group-item">暂时还没有添加任何幻灯图片</div>');
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



// 设置序号
$('.cmd-sortord').click(function () {
    var $this = $(this);
    layer.prompt({value: $this.data('sortord'), title: '请输入序号'}, function (sort){
        if (!sort.match(/^-?\d+$/)) {
            layer.msg('排序必须填写整数', {time: 1000});
            return false;
        }

        $.post(
            common_ops.buildAdminUrl('/catbanner/###/sort').replace('###', $this.parent().data('id')),
            {_method: 'POST', sort},
            function (response) {
                if (response.status) {
                    window.location.reload();
                }
            }
        );
    });
});

