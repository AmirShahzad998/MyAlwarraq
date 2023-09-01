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
                            <a href="{{ route('role.index') }}">Role</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="javascript:void(0);">Create</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add New Role</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="table-responsive">
                                <label for="permissions" class="form-label">Assign Permissions</label>
                                <table id="role_table" class="table table-striped text-theme w-100">
                                    <thead>
                                        <tr>
                                            <th ><input type="checkbox" name="all_permission"></th>
                                            <th >Name</th>
                                            <th width="10%">Guard</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($permission as $permission)
                                    <tr>
                                        <td>
                                            <input type="checkbox"
                                            name="permission[{{ $permission->name }}]"
                                            value="{{ $permission->name }}"
                                            class='permission'>
                                        </td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->guard_name }}</td>
                                    </tr>
                                     @endforeach
                                    </tbody>
                                   </table>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }

            });
        });
    </script>
@endsection
