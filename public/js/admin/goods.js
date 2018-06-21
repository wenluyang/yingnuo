$('.cmd-save').click(function () {
    var $form = $('#form-product'), data;
    var $id = $form.find('[name=id]').val();

    if ($form.find('[name=category_id]').val()==0) {
        layer.alert('请先选择一个产品分类', function (index) {
            $form.find('[name=category_id]').focus();
            layer.close(index);
        });
        return false;
    }


    if (!$form.find('[name=name]').val().trim().length) {
        layer.alert('产品名称不能为空', function (index) {
            $form.find('[name=name]').focus();
            layer.close(index);
        });
        return false;
    }

    var r = /^[0-9]*[1-9][0-9]*$/;
    if (!r.test($form.find('[name=stock]').val())) {
        layer.alert('产品库存必须填写正整数', function (index) {
            $form.find('[name=stock]').focus();
            layer.close(index);
        });
        return false;
    }

    if (!$form.find('[name=price]').val().trim().length) {
        layer.alert('产品价格不能为空', function (index) {
            $form.find('[name=price]').focus();
            layer.close(index);
        });
        return false;
    }



    if (!$form.find('[name=image]').val().trim().length) {
        layer.alert('产品图片不能为空', function (index) {
            $form.find('[name=image]').focus();
            layer.close(index);
        });
        return false;
    }

    if($id==0){
        var $url= common_ops.buildAdminUrl('/goods/store');
    }else{
        var $url=common_ops.buildAdminUrl('/goods/###/update').replace('###', $id)
    }

    $.post(
        $url,
        $form.serialize() + '&_method=POST',
        function (response) {
            if (response.status) {
                layer.msg('保存成功', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/goods');
                });
            }
        },
        'json'
    );
});