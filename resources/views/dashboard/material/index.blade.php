@extends('dashboard.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatable/datatables.min.css') }}" />
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body pb-0">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb breadcrumb-style1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Materials</a>
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
                <h4 class="card-title mb-0">All Material</h4>
                <a href="{{ route('material.create') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md" id="material_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Material Name</th>
                                <th>Type</th>
                                <th>Unit Price</th>
                                <th>Available Unit</th>
                                <th>Stock Value</th>
                                @can('update-material')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sr_no = 1;
                            @endphp
                            @foreach ($materials as $item)
                                <tr>
                                    <td>{{ $sr_no++ }}</td>
                                    <td><a href="{{ route('material.show', $item) }}">{{ $item->material_name }}</a></td>
                                    <td>{{ $item->types_count}}</td>
                                    <td>{{ $item->unit_price }}</td>
                                    <td>{{$item->transactions_sum_purchase_quantity - $item->transactions_sum_order_quantity}}</td>
                                    @php
                                        $stock_value = ($item->transactions_sum_purchase_quantity - $item->transactions_sum_order_quantity) * $item->unit_price
                                    @endphp
                                    <td>{{$stock_value}}</td>
                                    @can('update-material')
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('material.edit', $item) }}">
                                            <i class="bx bx-pencil"></i>
                                        </a>
                                    </td>
                                    @endcan
                                </tr>
                                {{-- @dd($materials) --}}
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
        var requirement_table = $('#material_table').DataTable({
            "dom": '<lBf<t>ip>',
            buttons: ['excel', 'print'],
            paging: true,
            processing: true,
            searching: true,
            autoWidth: true,
            lengthChange: true,
            columnDefs: [{
                orderable: true,
                targets: '_all'
            }],
            pageLength: 25
        });
    </script>
@endsection
