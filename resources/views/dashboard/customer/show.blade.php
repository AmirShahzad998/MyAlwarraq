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
                                <a href="{{ route('customer.index') }}">Customer</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">{{ $customer->customer_name }}</a>
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
                    <h4 class="card-title mb-0">{{ $customer->customer_name }}</h4>
                    @can('delete-customer')
                    <div class="button-wrapper">
                        <form action="{{ route('customer.destroy', $customer) }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="btn btn-xs btn-danger" onclick="return confirm(&quot;Confirm delete?&quot;)"
                                type="submit">
                                Delete
                            </button>
                        </form>

                    </div>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-2">
                                <label for="">Customer Name</label>
                                <input type="text" class="form-control" value="{{ $customer->customer_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-2">
                                <label for="">Email</label>
                                <input type="text" class="form-control" value="{{ $customer->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-2">
                                <label for="">Contact No</label>
                                <input type="text" class="form-control" value="{{ $customer->contact_no }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-2">
                                <label for="">Address</label>
                                <input type="text" class="form-control" value="{{ $customer->address }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customer Logs</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="transaction_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @forelse ($material-> as $item)

                                @empty

                                @endforelse --}}
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
