@extends('admin.layout.main')

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <section class="content-header">
            <h1>添加菜单</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">Data tables</li>
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
                                        <select id="parent_id" name="menu_parent_id" class="form-control">
                                            <option value="0">option 0</option>
                                            <option value="1">option 1</option>
                                            <option value="2">option 2</option>
                                            <option value="3">option 3</option>
                                        </select>
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