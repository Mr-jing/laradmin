@extends('admin.layout.main')

@section('after.css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>菜单权限设置</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin')}}">首页</a></li>
                <li><a href="{{url('/admin/routes')}}">角色列表</a></li>
                <li class="active">角色权限设置</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <th style="width: 60px;">
                                        <input title="全选" type="checkbox" id="check-all">
                                        <label for="check-all">全选</label>
                                    </th>
                                    <th>权限名称</th>
                                    <th>method:uri</th>
                                </tr>
                                @foreach($routes as $route)
                                    <tr>
                                        @if($route['checked'])
                                            <td><input type="checkbox" class="checkbox route-id"
                                                       data-id="{{$route['id']}}" checked="checked"></td>
                                        @else
                                            <td><input type="checkbox" class="checkbox route-id"
                                                       data-id="{{$route['id']}}"></td>
                                        @endif
                                        <td>{{$route['name']}}</td>
                                        <td>{{$route['method']}}:{{$route['uri']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default" onclick="history.go(-1);">取消</button>
                            <button type="submit" class="btn btn-info pull-right" id="menu-setting-btn"
                                    data-url="{{action('Admin\RoleController@postRoutes', ['roles' => $role->id])}}">提交
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
