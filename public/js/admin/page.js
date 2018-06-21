$('.cmd-save').click(function () {
    var $form = $('#form-page'), data;

    var  $id= $form.find('[name=id]').val();
    if ($form.find('[name=title]').val() == 0) {
        layer.alert('文章标题必须填写', function (index) {
            layer.close(index);
        });
        return false;
    }
    if($id==0){
        var $url=common_ops.buildAdminUrl('/page/store')
    }else{
        var $url=common_ops.buildAdminUrl('/page/###/update').replace('###',$id);
    }

    $.post(
        $url,
        $form.serialize(),
        function (response) {
            if (response.status) {
                layer.msg('保存成功', {time: 1000},function () {
                    window.location.reload();
                });

            }
        },
        'json'
    );
});
