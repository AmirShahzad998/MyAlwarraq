@extends('dashboard.layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body  pb-0">
                <nav aria-label="breadcrumb ">
                    <ol class="breadcrumb breadcrumb-style1">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('role.index') }}">Roles</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">{{ $role->name }}</a>
                        </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <li class="breadcrumb-item active">{{ $role->name }} Role</li>
                    <div class="table-responsive">
                        <table id="role_table" class="table table-striped text-theme w-100">
                            <label for="permissions" class="form-label">Assigned Permissions</label>
                            <table id="role_table" class="table table-striped text-theme w-100">
                                <thead>
                                    <th >Name</th>
                                    <th scope="col" width="10%">Guard</th>
                                </thead>
                                <tbody>
                                    @foreach($rolePermissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
