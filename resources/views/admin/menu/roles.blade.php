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
                <li><a href="{{url('/admin/menus')}}">菜单列表</a></li>
                <li class="active">菜单权限设置</li>
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
                                    <th>角色名称</th>
                                    <th>角色描述</th>
                                </tr>
                                @foreach($roles as $role)
                                    <tr>
                                        @if($role['checked'])
                                            <td><input type="checkbox" class="checkbox role-id"
                                                       data-id="{{$role['id']}}" checked="checked"></td>
                                        @else
                                            <td><input type="checkbox" class="checkbox role-id"
                                                       data-id="{{$role['id']}}"></td>
                                        @endif
                                        <td>{{$role['name']}}</td>
                                        <td>{{$role['description']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-default" onclick="history.go(-1);">取消</button>
                            <button type="submit" class="btn btn-info pull-right" id="set-ids-btn"
                                    data-name="role_ids"
                                    data-url="{{action('Admin\MenuController@postRoles', ['menus' => $menu->id])}}">提交
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
