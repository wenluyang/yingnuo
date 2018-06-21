$('#cmd-attribute-save').click(function () {
    var $form = $('#form-type');
    var $id = $form.find('[name=id]').val();
    var $type_id = $form.find('[name=type_id]').val();
    if (!$form.find('[name=name]').val().trim().length) {
        layer.alert('属性名称不能为空', function (index) {
            $form.find('[name=name]').focus();
            layer.close(index);
        });
        return false;
    }

    if($id==0){
        var $url= common_ops.buildAdminUrl('/type/###/attributes/store').replace('###', $type_id);
    }else{
        var $url=common_ops.buildAdminUrl('/type/###/attributes/!!!/update').replace('!!!', $id).replace('###', $type_id)
    }

    $.post(
        $url,
        $form.serialize() + '&_method=POST',
        function (response) {
            if (response.status) {
                layer.msg('保存成功', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/type');
                });
            }
        },
        'json'
    );
});




$('.cmd-delete').on('click', function () {
    var $this = $(this);
    layer.confirm('确认删除？', {icon: 3, title: '提示'}, function (index) {
        $.post(
            common_ops.buildAdminUrl('/type/attributes/###/delete').replace('###', $this.parent().data('id')),
            {_method: 'delete'},
            function (response) {
                if (response.status) {
                    layer.msg('删除成功', {time: 1000},function () {
                        window.location.href=common_ops.buildAdminUrl('/type');
                    });
                }
            },
            'json'
        );
    });
});

