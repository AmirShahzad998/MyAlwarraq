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
                                <a href="javascript:void(0);">Purchase Invoice</a>
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
                <h4 class="card-title mb-0">All Purchases</h4>
                <a href="{{ route('purchase.create') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i></a>

            </div>
            {{-- filter data monthwise
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <p>You can filter your record with selected month</p>
                        <div class="btn-group">
                            <select name="selected_month" id="selected_month" class="form-control">
                                <option value="1" {{$current_month == 1 ? 'selected' : ''}}>January</option>
                                <option value="2" {{$current_month == 2 ? 'selected' : ''}}>February</option>
                                <option value="3" {{$current_month == 3 ? 'selected' : ''}}>March</option>
                                <option value="4" {{$current_month == 4 ? 'selected' : ''}}>April</option>
                                <option value="5" {{$current_month == 5 ? 'selected' : ''}}>May</option>
                                <option value="6" {{$current_month == 6 ? 'selected' : ''}}>June</option>
                                <option value="7" {{$current_month == 7 ? 'selected' : ''}}>July</option>
                                <option value="8" {{$current_month == 8 ? 'selected' : ''}}>August</option>
                                <option value="9" {{$current_month == 9 ? 'selected' : ''}}>September</option>
                                <option value="10" {{$current_month == 10 ? 'selected' : ''}}>October</option>
                                <option value="11" {{$current_month == 11 ? 'selected' : ''}}>November</option>
                                <option value="12" {{$current_month == 12 ? 'selected' : ''}}>December</option>
                            </select>
                            <button type="button" class="btn btn-primary" id="filter_btn">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            end filter data monthwise --}}

            <div class=" d-flex justify-content-center">
                <div class="card w-50">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-center">
                                <h2 class="fs-3 text-center my-3">Filter Record</h2>
                                <form action="{{ route('purchase.by-date') }}" method="GET">
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
                    <table class="table table-responsive-md" id="purchase_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Invoice No</th>
                                <th>Date</th>
                                <th>Supplier Name</th>
                                <th>Total</th>
                                @can('update-purchase')
                                    <th>Action</th>
                                @endcan
                            </tr>

                        </thead>
                        <tbody>
                            @php
                                $sr_no = 1;
                            @endphp
                            @foreach ($purchases as $item)
                                <tr>
                                    <td>{{ $sr_no++ }}</td>
                                    <td><a href="{{ route('purchase.show', $item) }}">{{ $item->invoice_no }}</a></td>
                                    <td>{{ \Carbon\Carbon::parse($item->purchase_date)->format('d-m-Y') }}</td>
                                    <td>{{ $item->supplier->supplier_name }}</td>
                                    <td>{{ $item->grand_total }}</td>
                                    @can('update-purchase')
                                        <td>
                                            <a href="{{ route('purchase.edit', $item) }}" class="btn btn-sm btn-primary">
                                                <i class="bx bx-pencil"></i>
                                            </a>
                                        </td>
                                    @endcan
                                </tr>
                                {{-- @dd($purchases) --}}
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
        $(document).ready(function() {

            $('#purchase_table').DataTable({
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
        // filter data monthwise
        // var billing_table, start_date, end_date, month_date;
        // $('#filter_btn').click(function() {
        //     get_summary();
        // });

        // function get_summary() {
        //     var selectd_month = $('#selected_month').val();
        //     var url = "{{ route('purchase.index', ':id') }}",
        //         url = url.replace(':id', selectd_month);
        //     window.location.href = url;
        // }
    </script>
@endsection
