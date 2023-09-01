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
                            <li class="breadcrumb-item">
                                <a href="{{ route('material.index') }}">Materials</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">{{ $materialType->material->material_name }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card overflow-hidden" style="height: 300px">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">{{$materialType->material->material_name}}</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Material Name</label>
                            <input type="text" class="form-control" value="{{$materialType->material->material_name}}" readonly>
                        </div>
                        <div class="col-12">
                            <label for="">Unit Price</label>
                            <input type="text" class="form-control" value="{{$materialType->material->unit_price}}" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card overflow-hidden" style="height: 300px">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">Material Types</h4>
                </div>
                <div class="card-body" id="vertical-example">
                    <div class="table-responsive">
                        <table class="table" id="type_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Material Type</th>
                                    <th>Unit Price</th>
                                    <th>Available Unit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp

                                    <tr>
                                        <td>{{$sr_no++}}</td>
                                        <td>{{$materialType->type}}</td>
                                        <td>{{$materialType->unit_price}}</td>

                                        <td>{{$materialType->material->transactions->sum('purchase_quantity') - $materialType->material->transactions->sum('order_quantity')}}</td>
                                    </tr>

                                {{-- @dd($materialType) --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">{{ $materialType->type }} 's Transaction</h4>
                    <span class="badge bg-danger">{{$materialType->material->transactions->sum('purchase_quantity') - $materialType->material->transactions->sum('order_quantity')}}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="transaction_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    {{-- @if ($materialType->material->enable_job_order)
                                        <th>Job order</th>
                                    @endif --}}

                                    <th>Purchase Invoice</th>
                                    <th>Supplier</th>
                                    <th>Batch No</th>
                                    <th>Customer</th>
                                    <th>Job Order</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp
                                @forelse ($materialType->transactions as $item)
                                    <tr>
                                        <td>{{$sr_no++}}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y')}}</td>
                                        <td>{{$item->title}}</td>
                                        {{-- @if ($materialType->material->enable_job_order)
                                        <td>
                                            {{ $item->job_order ? $item->job_order->order_no : '-' }}</td>
                                        @endif --}}

                                        <td>
                                            @if ($item->purchase)
                                               <a href="{{ route('purchase.show',$item->purchase) }}"> {{$item->purchase->invoice_no}}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->purchase)
                                            {{$item->purchase->supplier->supplier_name}}
                                            @endif
                                        </td>

                                        <td>{{ $item->batch_no }}</td>
                                        <td>
                                            @if ($item->job_order)
                                                {{$item->job_order->customer->customer_name}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->job_order)
                                            <a href="{{ route('job-order.show', $item->job_order) }}">{{$item->job_order->order_no}}</a>
                                            @endif
                                        </td>
                                        <td>{{$item->description}}</td>
                                        <td>
                                            @if ($item->job_order_id)
                                                {{$item->order_quantity}}
                                            @else
                                                {{$item->purchase_quantity}}
                                            @endif
                                        </td>

                                        {{-- <td>
                                            @if ($item->purchase_detail)
                                            {{$item->purchase_detail->supplier_name}}
                                        @endif
                                    </td> --}}
                                    <td>{{ $item->unit_price }}</td>
                                    <td>
                                        @if ($item->job_order_id)
                                        {{ $item->unit_price * $item->order_quantity }}
                                        @else
                                        {{ $item->unit_price * $item->purchase_quantity }}
                                        @endif
                                    </td>
                                    </tr>
                                @empty
                                @endforelse
                                {{-- @dd($transactions) --}}
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
    <!-- Page JS -->
    <script>
        var requirement_table = $('#transaction_table').DataTable({
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
