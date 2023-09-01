@extends('dashboard.layouts.app')
@section('css')
    @livewireStyles
    <link href="{{ asset('assets/vendor/libs/apexchart/apexcharts.css') }}" rel="stylesheet">
    <style>
        .scrollbar {
            overflow-y: scroll;
            margin-bottom: 25px;
        }


        #scrollbar-right::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        #scrollbar-right::-webkit-scrollbar {
            width: 5px;
            border-radius: 50px;
            background-color: #F5F5F5;
        }

        #scrollbar-right::-webkit-scrollbar-thumb {
            background-color: #8592a3;
        }
    </style>
@endsection
@section('content')

    @can('admin-dashboard')
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="card widget-flat bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            @can('create-customer')
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add_customer_modal">
                                    <i class="bx bx-plus widget-icon bg-info-lighten rounded-circle text-white"></i>
                                </button>
                            @endcan
                        </div>
                        <h5 class="text-light fw-normal mt-0 text-white" title="Revenue">Customer</h5>
                        <h3 class="mt-3 mb-3 text-white">{{ $customer_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="card widget-flat bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            @can('create-supplier')
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add_supplier_modal">
                                    <i class="bx bx-plus widget-icon bg-info-lighten rounded-circle text-white"></i>
                                </button>
                            @endcan
                        </div>
                        <h5 class="text-light fw-normal mt-0 text-white" title="Revenue">Supplier</h5>
                        <h3 class="mt-3 mb-3 text-white">{{ $supplier_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="card widget-flat bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            @can('create-material')
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add_material_modal">
                                    <i class="bx bx-plus widget-icon bg-info-lighten rounded-circle text-white"></i>
                                </button>
                            @endcan
                        </div>
                        <h5 class="text-light fw-normal mt-0 text-white" title="Revenue">Material</h5>
                        <h3 class="mt-3 mb-3 text-white">{{ $material_count }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12 col-12">
                <div class="card widget-flat bg-primary">
                    <div class="card-body">
                        <div class="float-end">
                            @can('create-material')
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add_job_order_modal">
                                    <a href="{{ route('job-order.create') }}"> <i
                                            class="bx bx-plus widget-icon bg-info-lighten rounded-circle text-white"></i></a>
                                </button>
                            @endcan
                        </div>
                        <h5 class="text-light fw-normal mt-0 text-white" title="Revenue">Job Orders</h5>
                        <h3 class="mt-3 mb-3 text-white">{{ $job_order_count }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header header-elements border shadow">
                        <h4 class="mb-0">Summary</h4>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('summary.index') }}" class="btn btn-sm btn-primary"><i class="bx bx-book"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart" class="mt-3"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="card">
                    <div class="card-header header-elements border shadow">
                        <h4 class="mb-0">Latest Job Order</h4>
                        <div class="card-header-elements ms-auto">
                            <a href="{{ route('job-order.create') }}" class="btn btn-sm btn-primary"><i
                                    class="bx bx-plus"></i></a>
                        </div>
                    </div>
                    <div class="card-body h-auto">
                        <div id="scrollbar-right" class="widget-media scrollbar" style="overflow-y: scroll; height: 660px;">
                            <ul class="timeline ml-0 pl-0">
                                @php
                                    $sr_no = 1;
                                @endphp
                                @forelse ($orders as $item)
                                    <li>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Order No: <a
                                                        href="{{ route('job-order.show', $item) }}">{{ $item->order_no }}</a>
                                                </h6>
                                                <p class="mb-0">Customer Name: {{ $item->customer->customer_name }}</p>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $item->total }}</small>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-3 mt-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Estimate</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold"><a
                                                        href="{{ route('job-order.estimate', $item) }}">{{ $item->total_actual_cost ? $item->total_estimate_cost : 'Add' }}</a></small>
                                            </div>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-3">
                                            <div class="me-2">
                                                <h6 class="mb-0">Acutal Buying</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold"><a
                                                        href="{{ route('job-order.actual', $item) }}">{{ $item->total_actual_cost ? $item->total_actual_cost : 'Add' }}</a></small>
                                            </div>
                                        </div>
                                        <hr>
                                    </li>
                                @empty
                                    <li>
                                        No Record Found
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('modal')
    <div class="modal fade bd-example-modal-lg" id="add_customer_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="name">Customer Name</label>
                                    <input type="text" name="customer_name"
                                        class="form-control @error('customer_name') is-invalid @enderror"
                                        value="{{ old('customer_name') }}">
                                    @error('customer_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="customer_image">Image</label>
                                    <input type="file" name="customer_image"
                                        class="form-control @error('customer_image') is-invalid @enderror"
                                        value="{{ old('customer_image') }}">
                                    @error('customer_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="contact_no">Contact</label>
                                    <input type="text" name="contact_no"
                                        class="form-control @error('contact_no') is-invalid @enderror"
                                        value="{{ old('contact_no') }}">
                                    @error('contact_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="address">Address</label>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address') }}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-danger light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="add_supplier_modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplier.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="name">Supplier Name</label>
                                    <input type="text" name="supplier_name"
                                        class="form-control @error('supplier_name') is-invalid @enderror"
                                        value="{{ old('supplier_name') }}">
                                    @error('supplier_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="supplier_image">Image</label>
                                    <input type="file" name="supplier_image"
                                        class="form-control @error('supplier_image') is-invalid @enderror"
                                        value="{{ old('supplier_image') }}">
                                    @error('supplier_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="contact_no">Contact</label>
                                    <input type="text" name="contact_no"
                                        class="form-control @error('contact_no') is-invalid @enderror"
                                        value="{{ old('contact_no') }}">
                                    @error('contact_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="email">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="address">Address</label>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address') }}">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-danger light"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="add_material_modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('material.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="material_name">Material Name</label>
                                    <input type="text" name="material_name"
                                        class="form-control @error('material_name') is-invalid @enderror"
                                        value="{{ old('material_name') }}">
                                    @error('material_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">

                                <div class="form-group mb-2">
                                    <label for="unit_price">Unit Price</label>
                                    <input type="number" name="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        value="{{ old('unit_price') }}" step="any">
                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <button type="button" class="btn btn-danger light"
                                    data-bs-dismiss="modal">Close</button>
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
    @livewireScripts
    <script src="{{ asset('assets/vendor/libs/apexchart/apexcharts.min.js') }}"></script>

    <script>
        var options = {
            series: [{
                name: 'Estimate',
                data: {!! $estimate !!}
            }, {
                name: 'Actual',
                data: {!! $actual !!}
            }],
            chart: {
                height: 410,
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'datetime',
                categories: {!! $date !!}
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy HH:mm'
                },
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endsection
