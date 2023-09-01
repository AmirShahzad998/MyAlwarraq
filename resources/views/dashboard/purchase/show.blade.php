@extends('dashboard.layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                <h4 class="mb-0">Invoice No: {{$purchase->invoice_no}}</h4>
                <div class="card-header-elements ms-auto">
                    <button class="btn btn-sm btn-danger" onclick="print_now()"><i class="bx bx-printer"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4 mb-2">
                        <label for="">Invoice No</label>
                        <input type="text" class="form-control" value="{{$purchase->invoice_no}}" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mb-2">
                        <label for="">Supplier Name</label>
                        <input type="text" class="form-control" value="{{$purchase->supplier->supplier_name}}" readonly>
                    </div>

                </div>
                <div class="row">
                    <div class="col-4 mb-2">
                        <label for="">Invoice Date</label>
                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d-m-Y')}}" readonly>
                    </div>

                </div>
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Material Name</th>
                            <th>Type</th>
                            <th>Job Order</th>
                            <th>Batch No</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $sr_no = 1;
                        @endphp
                        @forelse ($purchase->details as $item)
                            <tr>
                                <td>{{$sr_no++}}</td>
                                <td>{{$item->material_name}}</td>
                                <td>{{$item->type}}</td>
                                <td>{{$item->order_no}}</td>
                                <td>{{$item->batch_no}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->unit_price}}</td>
                                <td>{{$item->total}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Record Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>

                        <tr>
                            <td colspan="4" class="text-end">Grand Total</td>
                            <td colspan="2">
                                <input type="number" step="any" class="form-control" value="{{$purchase->grand_total}}" readonly>

                            </td>
                        </tr>
                    </tfoot>
                </table>
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
