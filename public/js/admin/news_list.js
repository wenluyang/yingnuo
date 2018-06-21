// 推荐
$('.cmd-tuijian').click(function () {
    var $this = $(this);
    $.post(
        common_ops.buildAdminUrl('/news/###/recom').replace('###', $this.parent().data('id')),
        {_method: 'POST'},
        function (response) {
            if (response.status) {

                layer.msg('推荐成功', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/news');
                });
            }
        },
        'json'
    );
});


// 取消推荐
$('.cmd-untuijian').click(function () {
    var $this = $(this);
    $.post(
        common_ops.buildAdminUrl('/news/###/unrecom').replace('###', $this.parent().data('id')),
        {_method: 'POST'},
        function (response) {
            if (response.status) {
                layer.msg('取消推荐成功', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/news');
                });
            }
        },
        'json'
    );
});


// 审核
$('.cmd-shenhe').click(function () {
    var $this = $(this);
    $.post(
        common_ops.buildAdminUrl('/news/###/shenhe').replace('###', $this.parent().data('id')),
        {_method: 'POST'},
        function (response) {
            if (response.status) {
                layer.msg('该新闻已经成功审核', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/news');
                });
            }
        },
        'json'
    );
});



// 取消审核
$('.cmd-unshenhe').click(function () {
    var $this = $(this);
    $.post(
        common_ops.buildAdminUrl('/news/###/unshenhe').replace('###', $this.parent().data('id')),
        {_method: 'POST'},
        function (response) {
            if (response.status) {
                layer.msg('该新闻已经取消审核', {time: 1000},function () {
                    window.location.href=common_ops.buildAdminUrl('/news');
                });
            }
        },
        'json'
    );
});

//删除新闻
$('.cmd-delete').click(function () {
    var $this = $(this);
    layer.confirm('确认删除该新闻？', {icon: 3, title: '提示'}, function (index) {
        $.post(
            common_ops.buildAdminUrl('/news/###/delete').replace('###', $this.parent().data('id')),
            {_method: 'DELETE'},
            function (response) {
                if (response.status) {
                    window.location.reload();
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
            common_ops.buildAdminUrl('/news/###/sort').replace('###', $this.parent().data('id')),
            {_method: 'post', sort: sort},
            function (response) {
                window.location.reload();
            },
            'json'
        );
    });
});
