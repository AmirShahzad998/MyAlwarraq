@extends('dashboard.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body  pb-0">
                    <nav aria-label="breadcrumb ">
                        <ol class="breadcrumb breadcrumb-style1">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('material.index') }}">Materials</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">{{ $material->material_name }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Edit</a>
                            </li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- @dd($material->initial_stock_date) --}}
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">Update Material</h4>
                   @can('delete-material')
                    <form action="{{ route('material.destroy', $material) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                    </form>
                    @endcan
                </div>
                <div class="card-body">
                    <form action="{{ route('material.update', $material) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="name">Material Name:</label>
                                    <input type="text" name="material_name"
                                        class="form-control @error('material_name') is-invalid @enderror"
                                        value="{{ $material->material_name }}">
                                    @error('material_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group mb-2">
                                    <label for="name">Date:</label>
                                    <input type="date" name="initial_stock_date"
                                        class="form-control datepicker  bg-white @error('initial_stock_date') is-invalid @enderror"
                                        value="{{ $material->initial_stock_date }}">
                                    @error('initial_stock_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="unit_price">Unit Price:</label>
                                    <input type="number" name="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        value="{{ $material->unit_price }}" step="any">
                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="initial_stock">Initial Stock:</label>
                                    <input type="number" name="initial_stock"
                                        class="form-control @error('initial_stock') is-invalid @enderror"
                                        value="{{ $material->initial_stock }}" step="any">
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
                                        <input class="form-check-input" type="checkbox" name="enable_sheet_size" id="enable_sheet_size" {{$material->enable_sheet_size ? 'checked' : ''}}>
                                        <label class="form-check-label" for="enable_sheet_size"> Enable Sheet Size </label>
                                    </div>
                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group mb-2">
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" name="enable_job_order" id="enable_job_order" {{$material->enable_job_order ? 'checked' : ''}}>
                                        <label class="form-check-label" for="enable_job_order"> Enable Job Order </label>
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
                                        <input class="form-check-input" type="checkbox" name="enable_n_a_option" id="enable_n_a_option" {{$material->enable_n_a_option ? 'checked' : ''}}>
                                        <label class="form-check-label" for="enable_n_a_option"> Enable N/A </label>
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
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="card-title mb-0">Material Type</h4>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add_type_modal">
                        <i class="bx bx-plus"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type Name</th>
                                    <th>Unit Price</th>
                                    @can('delete-material')
                                    <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $sr_no = 1;
                                @endphp
                                @forelse ($material->types as $item)
                                    <tr>
                                        <td>{{$sr_no++}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->unit_price}}</td>
                                        <td>

                                        @can('delete-material')
                                            <form action="{{route('type.destroy', $item->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
<div class="modal fade bd-example-modal-lg" id="add_type_modal" tabindex="-1"  role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('type.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="form-group mb-2">
                                <label for="">Type Name</label>
                                <input type="hidden" name="material_id" value="{{$material->id}}">
                                <input name="type" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group mb-2">
                                <label for="">Date</label>
                                <input type="hidden" name="material_id" value="{{$material->id}}">
                                <input type="date" name="initial_stock_date" class="form-control datepicker  bg-white">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group mb-2">
                                <label for="">Unit Price</label>
                                <input type="number" name="unit_price" class="form-control" step="any">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group mb-2">
                                <label for="">Inital Stock</label>
                                <input type="number" name="initial_stock" class="form-control" value="0">
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
<script>
     flatpickr('.datepicker', {
        dateFormat: 'd/m/Y'
    });
</script>
@endsection
