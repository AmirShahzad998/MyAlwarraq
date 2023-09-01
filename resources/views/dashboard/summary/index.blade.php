@extends('dashboard.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatable/datatables.min.css') }}" />
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <div class="widget-stat card bg-primary">
                <div class="card-body p-4">
                    <div class="media d-flex justify-content-between">
                        <div class="media-body text-white">
                            <p class="mb-1">Total Purchase</p>
                            <h3 class="text-white">{{ $total_purchase }}</h3>
                        </div>
                        <span class="ml-3 float-right">
                            <i class='bx bx-wallet'></i>
                        </span>
                    </div>
                    <small class="text-white">This Month: <strong>{{ $total_purchase_month }}</strong></small>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <div class="widget-stat card bg-primary">
                <div class="card-body p-4">
                    <div class="media d-flex justify-content-between">
                        <div class="media-body text-white">
                            <p class="mb-1">Total Actual Cost</p>
                            <h3 class="text-white">{{ $total_actual }}</h3>
                        </div>
                        <span class="ml-3 float-right">
                            <i class='bx bx-cube'></i>
                        </span>
                    </div>
                    <small class="text-white">This Month: <strong>{{ $total_actual_month }}</strong></small>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-12">
            <div class="widget-stat card bg-primary">
                <div class="card-body p-4">
                    <div class="media d-flex justify-content-between">
                        <div class="media-body text-white">
                            <p class="mb-1">Stock Value</p>
                            <h3 class="text-white">{{ $total }}</h3>
                        </div>
                        <span class="ml-3 float-right">
                            <i class='bx bx-card'></i>
                        </span>
                    </div>
                    <small class="text-white">This Month: <strong>{{ $total_month }}</strong></small>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">Summary</h4>
                </div>
                <div class=" d-flex justify-content-center">
                    <div class="card w-50">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h2 class="fs-3 text-center my-3">Filter Record</h2>
                                    <form action="{{ route('summary.by-date') }}" method="GET">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="date" class="form-control datepicker" name="start_date" value="{{ old('start_date') }}" placeholder="Start Date" data-input>
                                            <input type="date" class="form-control datepicker" name="end_date" value="{{ old('end_date') }}" placeholder="End Date" data-input>
                                            <button class="btn btn-primary" type="submit">GET</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-responsive-md" id="supplier_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Material</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Batch No</th>
                                        <th>Unit Price</th>
                                        <th>Available Unit</th>
                                        <th>Stock Value</th>

                                    </tr>

                                </thead>
                                <tbody>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($monthly_materials as $item)
                                        @if ($item->available_unit == 0)
                                        @else
                                            <tr>
                                                <td>{{ $sr_no++ }}</td>
                                                <td>
                                                    <a
                                                        href="{{ route('material.show', $item->material) }}">{{ $item->material->material_name }}</a>
                                                </td>

                                                <td>
                                                    @if ($item->material_type)
                                                        <a
                                                            href="{{ route('material.materialType_show', $item->material_type->id) }}">{{ $item->type }}</a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($item->date)->format('d-m-Y') }}</td>

                                                @if ($item->material->enable_n_a_option)
                                                    <td>N/A</td>
                                                    <td>N/A</td>

                                                    <td>N/A</td>
                                                @else
                                                    <td>{{ $item->batch_no }}</td>
                                                    <td>{{ $item->unit_price }}</td>
                                                    <td>{{ $item->available_unit }}</td>
                                                @endif
                                                <td>{{ $item->stock_value }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- @dd($monthly_materials) --}}
                        </div>
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
            $('#supplier_table').DataTable({
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
