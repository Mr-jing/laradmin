@extends('admin.layout.main')

@section('after.css')
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('content')
    <div class="content-wrapper" style="min-height: 916px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>角色列表</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i>首页</a></li>
                <li class="active">角色列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header" style="margin-bottom: -15px;">
                            <div class="row">
                                <div class="col-sm-2">
                                    <a href="{{url('admin/roles/create')}}" class="btn btn-block btn-success"
                                       role="button"><i class="fa fa-plus-circle"></i>添加角色</a>
                                </div>
                                <div class="col-sm-10"></div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                               role="grid" aria-describedby="example1_info">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Rendering engine: activate to sort column descending"
                                                    style="width: 163px;">唯一名称
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1" aria-label="Browser: activate to sort column ascending"
                                                    style="width: 203px;">描述
                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1"
                                                    colspan="1"
                                                    aria-label="CSS grade: activate to sort column ascending"
                                                    style="width:145px;">操作
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($roles as $role)
                                                <tr role="row">
                                                    <td>{{$role['name']}}</td>
                                                    <td>{{$role['description']}}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{action('Admin\RoleController@getRoutes', [$role['id']])}}"
                                                               title="设置" role="button"
                                                               class="btn btn-default btn-flat">
                                                                <i class="fa fa-gear "></i>
                                                            </a>
                                                            <a href="{{action('Admin\RoleController@edit', ['id' => $role->id])}}"
                                                               title="编辑" role="button"
                                                               class="btn btn-default btn-flat">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a data-url="{{action('Admin\RoleController@destroy', ['id' => $role->id])}}"
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
