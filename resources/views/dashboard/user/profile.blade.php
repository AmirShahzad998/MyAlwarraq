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
                                <a href="javascript:void(0);">{{ auth()->user()->user_name }}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">Profile</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-12">
            <div class="card mb-4">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{ auth()->user()->user_image }}" alt="user-avatar" class="d-block rounded" height="100"
                            width="100" id="uploadedAvatar">
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">{{ auth()->user()->user_name }}</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                            </label>
                            <p class="text-muted mb-0">Update your profile or change password</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="card-body">
                    <form action="{{route('user.profile.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="mb-2">
                                    <label for="">User Name</label>
                                    <input type="text" class="form-control" name="user_name" value="{{ auth()->user()->user_name }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-2">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ auth()->user()->email }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-2">
                                    <label for="">Contact No</label>
                                    <input type="text" class="form-control" name="contact_no" value="{{ auth()->user()->contact_no }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="mb-2">
                                    <label for="">User Image</label>
                                    <input type="file" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('change-password.edit')}}" class="btn btn-danger">Change Password</a>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
        <div class="col-lg-12 col-12">
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
                                <tr>
                                    <td>2</td>
                                    <td>04-10-2022</td>
                                    <td>Login Alert</td>
                                    <td>User recently logges in</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>04-10-2022</td>
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
