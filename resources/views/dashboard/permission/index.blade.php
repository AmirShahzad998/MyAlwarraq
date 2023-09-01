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
                                <a href="javascript:void(0);">Permissions</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-3">
                    <h4 class="card-title mb-0">All Permission</h4>
                    <a href="{{ route('permission.create') }}" class="btn btn-sm btn-primary"><i class="bx bx-plus"></i></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>

                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $sr_no = 1;
                                    @endphp
                                    @foreach ($permissions as $item)
                                        <td>{{ $sr_no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                            <a class="btn btn-xs btn-primary" href="{{ route('permission.edit', $item) }}"><i
                                                    class="bx bx-pencil"></i>
                                            </a>
                                            <form action="{{route('permission.destroy', $item)}}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-xs btn-danger" onclick="return confirm(&quot;Confirm delete?&quot;)" type="submit">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                            </div>
                                        </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
