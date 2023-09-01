@extends('dashboard.layouts.app')
@section('css')
    <link href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatable/datatables.min.css') }}" />

@endsection
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
                                <a href="{{ route('user.index') }}">User</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">{{ $user->user_name }}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">show</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card mb-4">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ $user->user_image }}" alt="user-avatar" class="d-block rounded" height="100"
                            width="100" id="uploadedAvatar">
                        <div class="button-wrapper">
                            <form action="{{route('user.destroy', $user)}}" method="post">
                                @method('delete')
                                @csrf
                                <button class="btn btn-xs btn-danger" onclick="return confirm(&quot;Confirm delete?&quot;)" type="submit">
                                    Delete 
                                </button>
                            </form>
                            <p class="text-muted mb-0">
                                <span class="badge bg-danger">{{ $user->roles->first()->name }}</span>
                                {{-- @dd($user) --}}
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="mb-2">
                                <label for="">User Name</label>
                                <input type="text" class="form-control" value="{{ $user->user_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-2">
                                <label for="">Email</label>
                                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="mb-2">
                                <label for="">Contact No</label>
                                <input type="text" class="form-control" value="{{ $user->contact_no }}" readonly>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /Account -->
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>User Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="logs_table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>04-11-2022</td>
                                    <td>Login Alert</td>
                                    <td>User recently logges in</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatable/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('#logs_table').DataTable({
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
        $('#delete_btn').click(function() {
            var form = $('#delete_form'); // storing the form
            swal({
                    title: "Are you sure to delete ?",
                    text: "You will not be able to recover this data !!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it !!",
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                })
        });
    </script>
@endsection
