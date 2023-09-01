<div>
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card">

                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="mb-0">Purchase Invoice</h4>
                    @can('delete-purchase')

                    <form action="{{route('purchase.destroy', $purchase)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i></button>
                    </form>
                    @endcan
                </div>
                <form wire:submit.prevent="update">

                <div class="card-body mt-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="">Supplier Name</label>
                                <select wire:model="supplier_id" id="supplier_id" class="form-control select">
                                    <option value=""></option>
                                    @foreach ($suppliers as $item)
                                        <option value="{{ $item->id }}" {{$item->id == $supplier_id ? 'selected' : ''}}>{{ $item->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="">Invoice No</label>
                                <input type="text" wire:model="invoice_no"
                                    class="form-control @error('invoice_no') is-invalid @enderror" id="invoice_no"
                                    value="{{ old('invoice_no') }}" placeholder="Invoice No">
                                @error('invoice_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-2">
                                <label for="">Purchase Date</label>
                                <input type="text" wire:model="purchase_date"
                                    class="form-control bg-white @error('purchase_date') is-invalid @enderror"
                                    id="purchase_date" value="{{ old('purchase_date') }}" placeholder="Purchase Date">
                                @error('purchase_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row mt-3">
                        <div class="col-12 text-end">
                            @can('delete-purchase')

                            <form action="{{route('purchase.destroy', $purchase)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="bx bx-trash"></i></button>
                            </form>
                            @endcan
                        </div>
                    </div> --}}
                    <div class="row mt-3">
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow">
                    <h4>Add Material</h4>
                    <button type="button" class="btn btn-sm btn-primary" wire:click="add_material"
                        {{ $enable_material ? '' : 'disabled' }}><i class="bx bx-plus"></i></button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Material Name</th>
                                <th>Type</th>
                                <th>Job Order</th>
                                <th>Batch No</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                @can('delete-material')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if ($purchase_materials)
                                @php
                                    $sr_no = 1;
                                @endphp
                                @forelse ($purchase_materials as $item)
                                    <tr>
                                        <td>{{ $sr_no++ }}</td>
                                        <td>{{ $item->material_name }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->order_no }}</td>
                                        <td>{{ $item->batch_no }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td>{{ $item->total }}</td>
                                        @can('delete-material')
                                        <td><button type="button" class="btn btn-sm btn-danger" wire:click="remove({{$item->id}})"><i class="bx bx-trash"></i></button></td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No Record Found</td>
                                    </tr>
                                @endforelse
                            @endif
                        </tbody>
{{-- @dd($purchase_materials) --}}
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end">Grand Total</td>
                                <td colspan="2">
                                    <input type="number" step="any" class="form-control" id="grand_total"
                                        wire:model="grand_total" value="0" readonly>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer {{ $enable_material ? '' : 'd-none' }}">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" wire:click="save_invoice">Save Invoice</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade bd-example-modal-lg" id="material_modal" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="add">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Material Name</label>
                                    <select wire:model="material_id" id="material_id" class="form-control select"
                                        style="width: 100%;">
                                        <option value=""></option>
                                        @foreach ($materials as $item)
                                            <option value="{{ $item->id }}">{{ $item->material_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Type</label>
                                    <select wire:model="material_type_id" class="form-control select" id="material_type_id" style="width: 100%;">
                                        <option value="">Select an option</option>
                                        @if ($material_types)
                                            @foreach ($material_types as $item)
                                                <option value="{{ $item->id }}">{{ $item->type }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('material_type_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-lg-3 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Batch No</label>
                                    <input type="text" wire:model="batch_no"
                                        class="form-control @error('batch_no') is-invalid @enderror"
                                        value="{{ old('batch_no') }}" placeholder="batch_no">
                                    @error('batch_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group mb-2">
                                    <label for="">Quantity</label>
                                    <input type="number" wire:model="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        value="{{ old('quantity') }}" placeholder="Quantity">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group mb-2">
                                    <label for="">Unit Price</label>
                                    <input type="number" wire:model="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        value="{{ old('unit_price') }}" placeholder="Unit Price" step="any">
                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-2">
                                    <label for="">Total</label>
                                    <input type="number" wire:model="total"
                                        class="form-control @error('total') is-invalid @enderror" value="100"
                                        readonly>
                                    @error('total')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            @if ($enable_order)
                                <div class="col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Job Order</label>
                                        <select wire:model="order_no" class="form-control select" id="order_no" style="width: 100%;">
                                            <option value="">Select an option</option>
                                            @if ($job_orders)
                                                @foreach ($job_orders as $item)
                                                    <option value="{{ $item->order_no }}">{{ $item->order_no }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('job_order')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            @endif
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
</div>
@push('script')
    <script>
        $('#purchase_date').flatpickr();
        $('#supplier_id').select2({
            placeholder: "Select a supplier",
            selectOnClose: false
        });
        $('#material_id').select2({
            placeholder: "Select a material",
            width: "resolve",
            dropdownParent: $("#material_modal"),
        });
        $('#order_no').select2({
            placeholder: "Select a material",
            width: "resolve",
            dropdownParent: $("#material_modal"),
        });


        $('#material_type_id').select2({
            placeholder: "Select an option",
            width: "resolve",
            dropdownParent: $("#material_modal"),
        });
        $(".select").on('change', function(event) {
            let value = $(this).val();
            let element = event.target.id;
            @this.set(element, value);
        });
        window.addEventListener('render_select2', event => {

            $('#supplier_id').select2({
                placeholder: "Select a supplier",
            });
            $('#material_id').select2({
                placeholder: "Select a material",
                width: "resolve",
                dropdownParent: $("#material_modal"),
            });
            $('#material_type_id').select2({
                placeholder: "Select an option",
                width: "resolve",
                dropdownParent: $("#material_modal"),
            });
            $('#order_no').select2({
                placeholder: "Select an option",
                width: "resolve",
                dropdownParent: $("#material_modal"),
            });
            $(".select").on('change', function(event) {
                let value = $(this).val();
                let element = event.target.id;
                @this.set(element, value);
            });
        });
        window.addEventListener('open_material_modal', event => {
            $("#material_modal").modal('show');
        });

        window.addEventListener('close_material_modal', event => {
            $("#material_modal").modal('hide');
        })
    </script>
@endpush
