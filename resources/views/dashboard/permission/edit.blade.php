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
                            <a href="{{ route('permission.index') }}">Permissions</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">{{ $permission->name }}</a>
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
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Update Permission</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.update', $permission) }}" method="post" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="name">Permission Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ $permission->name }}">
                                    @error('name')
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
    </div>




@endsection
