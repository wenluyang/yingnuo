var admin_login_ops = {
    init: function () {
        return this.eventBind();
    },

    eventBind: function () {
        $('.login').click(function () {
            var username = $('.login-box-body input[name=name]').val();
            var password = $('.login-box-body input[name=password]').val();

            if (username.length < 1) {
                layer.alert('用户名必须填写', {icon: 5});
                return false;
            }

            if (password.length < 1) {
                layer.alert('密码必须填写', {icon: 5});
                return false;

            }

            var data = {
                name: username,
                password: password,
            };

            $.ajax({
                url: '',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function (res) {
                    if (res.code == 200) {
                        layer.alert(res.msg, {icon: 6}, function () {
                            location.href = '/admin/home';
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
    admin_login_ops.init();
});