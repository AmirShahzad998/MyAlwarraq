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
                        <li class="breadcrumb-item active">
                            <a href="javascript:void(0);">Edit</a>
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
                    <h4 class="card-title mb-0">Update Role</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.update', $role) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mb-2">
                                    <label for="name">Role Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $role->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 col-12">
                                <div class="mb-2">
                                    <label for="guard_name">Gurad Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('guard_name') is-invalid @enderror"
                                        value="{{ $role->guard_name }}">
                                    @error('guard_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class="col-12 mt-3">
                                <div class="table-responsive">
                                    <table id="role_table" class="table table-striped text-theme w-100">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" onclick='selects()' value="Select All" /></th>
                                                <th>Name</th>
                                                <th width="10%">Guard</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($permission as $permission)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="checkbox"
                                                            name="permission[{{ $permission->name }}]"
                                                            value="{{ $permission->name }}" class='permission'
                                                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                    </td>
                                                    <td>{{ $permission->name }}</td>
                                                    <td>{{ $permission->guard_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
        function selects() {
            var ele = document.getElementsByName('permission');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = true;
            }
        }


        $('.all_checked').on('click', function() {
            const allCheckedCheckbox = $(this);
            $('.checkbox').each(function() {
                $(this).prop('checked', allCheckedCheckbox.prop('checked'));
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if ($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked', false);
                    });
                }

            });
        });
    </script>
@endsection
