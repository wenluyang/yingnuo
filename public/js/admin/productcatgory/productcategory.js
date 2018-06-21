// 改赞数
$('.cmd-set-sort').click(function () {
    var $this = $(this);

    layer.prompt({value: $this.data('count'), title: '请输入序号'}, function (count) {
        if (!count.match(/^\d+$/)) {
            layer.msg('必须填写正整数', {time: 1000});
            return false;
        }
        $.post(
            '/admin/productcategory/sort?id=###'.replace('###', $this.data('id')),
            {_method: 'POST', count: count},
            function (response) {
                window.location.reload();
            },
            'json'
        );
    });
});


// 删除分类

$('.cmd-delete').click(function () {
    var $this = $(this);
    layer.confirm('确认删除该产品分类？', {icon: 3, title: '提示'}, function (index) {
        $.post(
            '/admin/productcategory/delete?id=###'.replace('###', $this.data('id')),
            {_method: 'POST'},
            function (response) {
                if (response.code==200) {
                    window.location.reload();
                }
            },
            'json'
        );
    });
});


var product_category_ops = {
    init: function () {
        return this.eventBind();
    },

    eventBind: function () {
        $('.productcategory_save').click(function () {

            var productcategoryname = $('.product_category input[name=name]').val();
            var sort = $('.product_category input[name=sort]').val();

            if (productcategoryname.length < 1) {
                layer.alert('产品分类名称必须填写', {icon: 5});
                return false;
            }

            if (!sort.match(/^-?\d+$/)) {
                layer.alert('排序必须填写整数', {icon: 5},function (index) {
                    $('.product_category input[name=sort]').focus();
                    layer.close(index);
                });
                return false;
            }



            var data = {
                name: productcategoryname,
                sort: sort,
            };

            $.ajax({
                url: '',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function (res) {
                    if (res.code == 200) {
                        layer.alert(res.msg, {icon: 6}, function () {
                            location.href = location.href;
                        })
                    } else {
                        layer.alert('登录出现错误，请联系管理员!', {icon: 5});
                        return false;
                    }

                }


            })


        });
    }
};

$(document).ready(function () {
    product_category_ops.init();
});