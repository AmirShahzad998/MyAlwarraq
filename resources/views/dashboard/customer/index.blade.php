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
                                <a href="{{ route('customer.index') }}">Customers</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-3">
                    <h4 class="card-title mb-0">All Customer</h4>
                    <a href="{{ route('customer.create') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md" id="customer_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    @can('update-customer')
                                    <th>Action</th>
                                    @endcan
                                </tr>

                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp
                                @foreach ($customers as $item)
                                    <tr>
                                        <td>{{ $sr_no++ }}</td>
                                        <td><a href="{{ route('customer.show', $item) }}">{{ $item->customer_name }}</a></td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->contact_no }}</td>
                                        @can('update-customer')
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="{{ route('customer.edit', $item) }}">
                                                <i class="bx bx-pencil"></i>
                                            </a>
                                        </td>
                                        @endcan
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

            $('#customer_table').DataTable({
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
