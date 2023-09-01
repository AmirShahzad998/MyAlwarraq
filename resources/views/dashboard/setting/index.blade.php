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
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Setting</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-4 col-xxl-4 col-sm-6">
            <div class="card mb-4">
                <div class="card-header header-elements">
                    <h4>Users</h4>
                    <div class="card-header-elements ms-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Users</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false"></button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="{{route('user.create')}}">Add New User</a>
                                <a class="dropdown-item" href="{{route('user.index')}}">View All User</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">You can add, update and remove users.</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-xxl-4 col-sm-6">
            <div class="card mb-4">
                <div class="card-header header-elements">
                    <h4>Roles</h4>
                    <div class="card-header-elements ms-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Roles</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false"></button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="{{route('role.create')}}">Add New Role</a>
                                <a class="dropdown-item" href="{{route('role.index')}}">View All Roles</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">You can add, update and remove users.</p>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-xxl-4 col-sm-6">
            <div class="card mb-4">
                <div class="card-header header-elements">
                    <h4>Permissions</h4>
                    <div class="card-header-elements ms-auto">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Permissions</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                                data-bs-toggle="dropdown" aria-expanded="false"></button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="{{route('permission.create')}}">Add New Permission</a>
                                <a class="dropdown-item" href="{{route('permission.index')}}">View All Permission</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">You can add, update and remove users.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">General Setting</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('setting.general')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="app_name">App Name</label>
                                    <input type="text" name="app_name" class="form-control @error('app_name') is-invalid  @enderror" value="{{$setting->app_name}}">
                                </div>
                            </div>
                            <div class="col-12">
                                <img src="{{$setting->app_logo}}" alt="" style="width: 100px;">
                                <div class="form-group mb-2">
                                    <label for="app_logo">App Logo</label>
                                    <input type="file" name="app_logo" class="form-control @error('app_logo') is-invalid  @enderror">
                                </div>
                            </div>
                            <div class="col-12">
                                <img src="{{$setting->app_favicon}}" alt="" style="width: 100px;">
                                <div class="form-group mb-2">
                                    <label for="app_favicon">App Favicon</label>
                                    <input type="file" name="app_favicon" class="form-control @error('app_favicon') is-invalid  @enderror">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="app_description">Description</label>
                                    <textarea name="app_description" rows="4" class="form-control">{{$setting->app_description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
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
