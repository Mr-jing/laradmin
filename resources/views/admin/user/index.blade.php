@extends('admin.layout.main')

@section('after.css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <section class="content-header">
            <h1>用户列表</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin')}}"><i class="fa fa-dashboard"></i>首页</a></li>
                <li class="active">用户列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="{{url('admin/users/create')}}" class="btn btn-block btn-success"
                                       role="button"><i class="fa fa-plus-circle"></i>添加用户</a>
                                </div>
                                <div class="col-sm-10"></div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                               role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 163px;">用户ID
                                                </th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 163px;">用户名
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 203px;">邮箱
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 203px;">角色
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="Platform(s): activate to sort column ascending"
                                                    style="width: 179px;">注册时间
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending"
                                                    style="width:145px;">操作
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($users as $user)
                                                <tr role="row" class="odd">
                                                    <td>{{$user['id']}}</td>
                                                    <td>{{$user['name']}}</td>
                                                    <td>{{$user['email']}}</td>
                                                    <td>{{$user['role']}}</td>
                                                    <td>{{$user['created_at']}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{action('Admin\UserController@edit', [$user['id']])}}"
                                                               title="编辑" role="button"
                                                               class="btn btn-default btn-flat">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a data-url="{{action('Admin\UserController@destroy', [$user['id']])}}"
                                                               data-method="DELETE" href="javascript:void(0);"
                                                               title="删除" role="button"
                                                               class="btn btn-default btn-flat delete_action">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
