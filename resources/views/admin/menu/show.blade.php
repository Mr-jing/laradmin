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
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tables</a></li>
                <li class="active">角色列表</li>
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
                                    <th style="width: 10px"><input title="全选" type="checkbox" id="check-all"></th>
                                    <th>角色名称</th>
                                    <th>角色描述</th>
                                </tr>
                                @foreach($allRoles as $role)
                                    <tr>
                                        <td><input type="checkbox" class="checkbox"></td>
                                        <td>{{$role['name']}}</td>
                                        <td>{{$role['description']}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
