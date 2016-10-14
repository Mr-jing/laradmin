@extends('admin.layout.main')

@section('after.css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>赋予角色权限</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin')}}">首页</a></li>
                <li><a href="{{url('/admin/routes')}}">权限列表</a></li>
                <li class="active">赋予角色权限</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="{{action('Admin\RoleController@getRoutes', ['roles' => $role->id])}}">设置权限</a>
                            </li>
                            <li class="active">
                                <a href="{{action('Admin\RoleController@getMenus', ['roles' => $role->id])}}">设置菜单</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="box">
                                    <div class="box-body">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <th style="width: 60px;">
                                                    <input title="全选" type="checkbox" id="check-all">
                                                    <label for="check-all">全选</label>
                                                </th>
                                                <th>菜单名称</th>
                                            </tr>
                                            @foreach($menus as $menu)
                                                <tr>
                                                    @if($menu['checked'])
                                                        <td><input type="checkbox" class="checkbox menu-id"
                                                                   data-id="{{$menu['id']}}" checked="checked"></td>
                                                    @else
                                                        <td><input type="checkbox" class="checkbox menu-id"
                                                                   data-id="{{$menu['id']}}"></td>
                                                    @endif
                                                    <td>{{$menu['prefix']}}{{$menu['name']}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-default" onclick="history.go(-1);">取消
                                        </button>
                                        <button type="submit" class="btn btn-info pull-right" id="menu-setting-btn"
                                                data-url="{{action('Admin\RoleController@postMenus', ['roles' => $role->id])}}">
                                            提交
                                        </button>
                                    </div>
                                </div>
                            </div>
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
