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
                                <a href="{{ route('material.index') }}">Material</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Create</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">Add Material</h4>
                </div>
                <div class="card-body">
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
                                    <label for="initial_stock_date">Date</label>
                                    <input type="date" name="initial_stock_date"
                                    class="form-control datepicker  bg-white" @error('initial_stock_date') is-invalid @enderror"
                                        value="{{ old('initial_stock_date') }}" data-input>
                                    @error('initial_stock_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
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
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="initial_stock">Initial Stock</label>
                                    <input type="number" name="initial_stock"
                                        class="form-control @error('initial_stock') is-invalid @enderror"
                                        value="0">
                                    @error('initial_stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group mb-2">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="enable_sheet_size" id="enable_sheet_size">
                                        <label class="form-check-label" for="enable_sheet_size"> Enable Sheet Size </label>
                                    </div>
                                    @error('enable_sheet_size')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group mb-2">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="enable_job_order" id="enable_job_order">
                                        <label class="form-check-label" for="enable_job_order"> Enable Job Order</label>
                                    </div>
                                    @error('enable_job_order')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group mb-2">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="enable_n_a_option" id="enable_n_a_option">
                                        <label class="form-check-label" for="enable_n_a_option"> Enable N/A</label>
                                    </div>
                                    @error('enable_n_a_option')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
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
<script>
     flatpickr('.datepicker', {
        dateFormat: 'd/m/Y'
    });
</script>
@endsection
