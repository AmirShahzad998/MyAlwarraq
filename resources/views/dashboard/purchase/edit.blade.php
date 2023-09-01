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
                                <a href="{{ route('purchase.index') }}">Purchase Invoice</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <a href="javascript:void(0);">{{$purchase->invoice_no}}</a>
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
                    @livewire('purchase.edit', ['purchase' => $purchase])
                </div>
            </div>
        </div>
    </div>           

@endsection
@section('script')
    @livewireScripts
@endsection