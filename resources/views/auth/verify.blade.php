@extends('auth.layout.app')
@section('title')
    Verify Email
@endsection
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                            </span>
                            <span class="app-brand-text demo text-body fw-bolder">{{env('APP_NAME')}}</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Welcome!</h4>
                    <p class="mb-4">Please verify your email address...</p>

                    <form action="{{ route('verification.resend') }}" method="POST" class="mb-3">
                        @csrf
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>
@endsection