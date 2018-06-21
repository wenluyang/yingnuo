var $form = $('#form-article'), data;
$form.find('[name=tags]').tagsInput({
    width:'auto',
    height:40,
    onAddTag:function(tag){
    },
    onRemoveTag:function(tag){
    }
})



$('.cmd-save').click(function () {


    if ($form.find('[name=title]').val() == 0) {
        layer.alert('新闻标题必须填写', function (index) {
            layer.close(index);
        });
        return false;
    }
    if ($form.find('[name=articlecat_id]').val() == 0) {
        layer.alert('请选择一个新闻分类', function (index) {
            layer.close(index);
        });
        return false;
    }

    if ($form.find('[name=tags]').val() == 0) {
        layer.alert('请至少一个TAG，利于搜索', function (index) {
            layer.close(index);
        });
        return false;
    }

        var $id=$form.find('[name=id]').val();

    if($id==0){
        var $url= common_ops.buildAdminUrl('/news/store');
    }else{
        var $url=common_ops.buildAdminUrl('/news/###/update').replace('###', $id)
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


