@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <section class="content-header">
            <h1>编辑用户</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i>首页</a></li>
                <li><a href="{{url('admin/users')}}">用户列表</a></li>
                <li class="active">编辑用户</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">编辑用户</h3>
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p>{{$error}}</p>
                                </div>
                            @endforeach
                        </div>

                        <form class="form-horizontal" method="post"
                              action="{{action('Admin\UserController@update', [$user->id])}}">

                            {!! method_field('PUT') !!}
                            {!! csrf_field() !!}

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">用户名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="用户名" value="{{old('name', $user->name)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">邮箱</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                               placeholder="邮箱" value="{{old('email', $user->email)}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">密码</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password"
                                               placeholder="密码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-sm-2 control-label">重复密码</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation" placeholder="重复密码">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role_id" class="col-sm-2 control-label">角色</label>
                                    <div class="col-sm-10">
                                        {!! \Form::select('role_id', $roleOptions, $user->roles[0]->id, [
                                            'id' => 'role_id',
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="box-footer">
                                <button type="button" class="btn btn-default" onclick="history.go(-1);">取消</button>
                                <button type="submit" class="btn btn-info pull-right">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
