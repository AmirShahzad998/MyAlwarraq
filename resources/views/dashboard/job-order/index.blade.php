@extends('dashboard.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatable/datatables.min.css') }}" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header header-elements border shadow pb-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Job Orders</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                <h4 class="mb-0">Job Orders</h4>
                <div class="card-header-elements ms-auto">
                    <a href="{{ route('job-order.create') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i></a>
                </div>
            </div>

            <div class=" d-flex justify-content-center">
                <div class="card w-50">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="fs-3 text-center my-3">Filter Record</h2>
                                <form action="{{ route('job-orders.by-date') }}" method="GET">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control datepicker" name="start_date" placeholder="Start Date" data-input>
                                        <input type="date" class="form-control datepicker" name="end_date" placeholder="End Date" data-input>
                                        <button class="btn btn-primary" type="submit">GET</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md" id="job_order_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order No</th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                <th>Status</th>
                                @can('add-estimated-cost')
                                    <th>Estimated Cost</th>
                                @endcan
                                @can('add-actual-cost')
                                    <th>Buying Cost</th>
                                @endcan
                                @can('update-order')
                                    <th>Action</th>
                                @endcan
                            </tr>

                        </thead>
                        <tbody>
                            @php
                                $sr_no = 1;
                            @endphp
                            @foreach ($orders as $item)
                                <tr>
                                    <td>{{ $sr_no++ }}</td>
                                    <td><a href="{{ route('job-order.show', $item) }}">{{ $item->order_no }}</a></td>
                                    <td>{{ \Carbon\Carbon::parse($item->order_date)->format('d-m-Y') }}</td>
                                    <td>{{ $item->customer->customer_name }}</td>
                                    <td>{{ $item->order_type }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->unit_price }}</td>
                                    <td>{{ $item->total }}</td>
                                    <td><span
                                            class="badge bg-{{ $item->active ? 'primary' : 'danger' }}">{{ $item->active ? 'Active' : 'In-Active' }}</span>
                                    </td>
                                    @can('add-estimated-cost')
                                        <td>
                                            <a href="{{ route('job-order.estimate', $item) }}"
                                                class="btn btn-sm btn-primary {{ $item->active ? '' : 'disabled' }}">
                                                @if ($item->total_estimate_cost)
                                                    {{ $item->total_estimate_cost }}
                                                @else
                                                    Add Estimate
                                                @endif
                                            </a>
                                        </td>
                                    @endcan
                                    @can('add-actual-cost')
                                        <td>
                                            <a href="{{ route('job-order.actual', $item) }}"
                                                class="btn btn-sm btn-primary {{ $item->active ? '' : 'disabled' }}">
                                                @if ($item->total_actual_cost)
                                                    {{ $item->total_actual_cost }}
                                                @else
                                                    Add Actual
                                                @endif
                                            </a>
                                        </td>
                                    @endcan
                                    @can('update-order')
                                        <td>
                                            <a href="{{ route('job-order.edit', $item) }}" class="btn btn-sm btn-primary">
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
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/libs/datatable/datatables.min.js') }}"></script>
    <script>
        var billing_table, start_date, end_date, month_date;
        $(document).ready(function() {

            $('#job_order_table').DataTable({
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
        flatpickr('.datepicker', {
        dateFormat: 'd/m/Y'
    });
    </script>
@endsection
