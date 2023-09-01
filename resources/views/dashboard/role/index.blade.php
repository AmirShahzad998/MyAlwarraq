@extends('dashboard.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatable/datatables.min.css') }}" />
@endsection
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
                            <li class="breadcrumb-item active">
                                <a href="{{route('role.index')}}">Roles</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">All Material</h4>
                    <a href="{{ route('role.create') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="role_table">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Guard Name</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($roles as $key => $role)
                                        <td>{{ $sr_no++ }}</td>
                                        <td><a href="{{ route('role.show', $role) }}">{{ $role->name }}</a></td>
                                        <td>{{ $role->guard_name }}</td>
                                        <td>
                                            <div class="btn-group">
                                            <a class="btn btn-xs btn-primary" href="{{ route('role.edit', $role) }}"><i
                                                    class="bx bx-pencil"></i>
                                            </a>
                                            <form action="{{route('role.destroy', $role)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-xs btn-danger" onclick="return confirm(&quot;Confirm delete?&quot;)" type="submit">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
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
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/libs/datatable/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            $('#role_table').DataTable({
                "dom": '<lfB<t>ip>',
                buttons: ['excel', 'print'],
                paging: true,
                searching: true,
                autoWidth: true,
                lengthChange: true,
                columnDefs: [{
                    orderable: true,
                    targets: '_all'
                }],
                pageLength: 25

            });

        });
    </script>
@endsection