@extends('dashboard.layouts.app')
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
                                <a href="{{ route('job-order.index') }}">Job Order</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">{{$jobOrder->order_no}}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="mb-0">Job-Order No: {{$jobOrder->order_no}}</h4>
                    <div class="card-header-elements ms-auto">

                        <button class="btn btn-sm btn-danger" onclick="print_now()"><i class="bx bx-printer"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <label for="">Customer Name</label>
                            <input type="text" value="{{$jobOrder->customer->customer_name}}" class="form-control" readonly>
                        </div>
                        <div class="col-lg-3 col-12">
                            <label for="">Order Date</label>
                            <input type="text" value="{{ \Carbon\Carbon::parse($jobOrder->order_date)->format('d-m-Y')}}" class="form-control" readonly>
                        </div>
                        <div class="col-lg-3 col-12">
                            <label for="">Order Type</label>
                            <input type="text" value="{{$jobOrder->order_type}}" class="form-control" readonly>
                        </div>
                        <div class="col-lg-3 col-12">
                            <label for="">Quantity</label>
                            <input type="text" value="{{$jobOrder->quantity}}" class="form-control" readonly>
                        </div>
                        <div class="col-12 mt-2">
                            <label for="">Description</label>
                            <textarea rows="4" class="form-control" readonly>{{$jobOrder->description}}</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="mb-0"><a href="{{route('job-order.estimate', $jobOrder)}}">Estimate Cost</a></h4>
                    <span class="badge bg-danger">{{$jobOrder->total_estimate_cost}}</span>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp
                                @forelse ($jobOrder->estimated_materials as $item)
                                    <tr>
                                        <td>{{$sr_no++}}</td>
                                        <td>{{$item->material_name}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->material_date)->format('d-m-Y')}}</td>
                                        <td>{{$item->unit_price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->total}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-end text-danger">Total Estimate Cost</td>
                                    <td class="text-danger">{{$jobOrder->total_estimate_cost}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="mb-0"><a href="{{route('job-order.actual', $jobOrder)}}">Actual Buying Cost</a></h4>
                    <span class="badge bg-danger">{{$jobOrder->total_actual_cost}}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Batch No</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp
                                @forelse ($jobOrder->actual_materials as $item)
                                    <tr>
                                        <td>{{$sr_no++}}</td>
                                        <td>{{$item->material_name}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->material_date)->format('d-m-Y')}}</td>
                                        <td>{{$item->batch_no}}</td>
                                        <td>{{$item->unit_price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->total}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6" class="text-end text-danger">Total Buying Cost</td>
                                    <td class="text-danger">{{$jobOrder->total_actual_cost}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function print_now() {
            window.print();
        }
    </script>

@endsection
