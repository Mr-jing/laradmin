@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <section class="content-header">
            <h1>添加权限</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i>首页</a></li>
                <li><a href="{{url('/admin/routes')}}">权限列表</a></li>
                <li class="active">添加权限</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">添加权限</h3>
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p>{{$error}}</p>
                                </div>
                            @endforeach
                        </div>

                        <form class="form-horizontal" action="{{url('admin/routes')}}" method="post">

                            {!! csrf_field() !!}

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="group" class="col-sm-2 control-label">分组名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="group" name="route_group"
                                               value="{{old('route_group')}}" placeholder="输入分组名称，例如：用户管理">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">权限名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="route_name"
                                               value="{{old('route_name')}}" placeholder="输入权限名称，例如：用户列表页面">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="method" class="col-sm-2 control-label">method</label>
                                    <div class="col-sm-10">
                                        {!! \Form::select(
                                        'route_method',
                                        ['GET' => 'GET', 'POST'=>'POST','PUT'=>'PUT','DELETE' => 'DELETE'],
                                        old('route_method'),
                                        ['id' => 'method', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uri" class="col-sm-2 control-label">uri</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="uri" name="route_uri"
                                               value="{{old('route_uri')}}" placeholder="输入权限uri，例如：admin/users">
                                    </div>
                                </div>

                            </div>

                            <div class="box-footer">
                                <button type="submit" class="btn btn-default" onclick="history.go(-1);">取消</button>
                                <button type="submit" class="btn btn-info pull-right">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
