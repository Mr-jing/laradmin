@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <section class="content-header">
            <h1>添加菜单</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i>首页</a></li>
                <li><a href="{{url('admin/menus')}}">菜单列表</a></li>
                <li class="active">添加菜单</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">添加菜单</h3>

                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <p>{{$error}}</p>
                                </div>
                            @endforeach
                        </div>

                        <form class="form-horizontal" action="{{url('admin/menus')}}" method="post">

                            {!! csrf_field() !!}

                            <div class="box-body">
                                <div class="form-group">
                                    <label for="parent_id" class="col-sm-2 control-label">父级菜单</label>
                                    <div class="col-sm-10">
                                        {!! \Form::select('menu_parent_id', $menuOptions, 0, [
                                            'id' => 'parent_id',
                                            'class' => 'form-control',
                                        ]) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">名称</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="menu_name"
                                               placeholder="名称">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-2 control-label">url</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="url" name="menu_url"
                                               placeholder="url">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sort" class="col-sm-2 control-label">排序数值</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="sort" name="menu_sort"
                                               placeholder="排序数值"
                                               value="0">
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
