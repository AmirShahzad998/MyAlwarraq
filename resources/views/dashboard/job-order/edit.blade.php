@extends('dashboard.layouts.app')
@section('css')
    @livewireStyles
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
                                <a href="{{ route('job-order.index') }}">Job Order</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">{{$jobOrder->order_no}}</a>
                            </li>
                            <li class="breadcrumb-item active">
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
                <div class="card-body">
                    @livewire('job-order.edit', ['jobOrder' => $jobOrder])
                </div>
            </div>
        </div>
    </div>           

@endsection
@section('script')
    @livewireScripts
@endsection