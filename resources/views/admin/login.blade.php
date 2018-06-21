
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{env('APP_NAME')}} 管理员登陆</title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>

<div class="container" style="margin-top: 200px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">管理员登陆</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">账号：</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="">

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">密码：</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" >

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> 记住登陆
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    登陆
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
