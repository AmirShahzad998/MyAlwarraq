<div>
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="card">
                <div class="card-header header-elements border shadow">
                    <h4 class="mb-0">Add Material</h4>
                </div>
                <div class="card-body mt-3">
                    <form wire:submit.prevent="add">
                        <div class="row">
                            <div class="col-12">
                                <div class="from-group mb-2">
                                    <label for="">Material Name:</label>
                                    <select wire:model="material_id"
                                        class="form-control @error('material_id') is-invalid @enderror" id="material_id">
                                        <option value=""></option>
                                        @foreach ($materials as $item)
                                            <option value="{{ $item->id }}">{{ $item->material_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('material_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="">Type</label>
                                    <select wire:model="material_type_id" class="form-control" id="material_type_id"  style="width: 100%;">
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
                            @if ($enable_sheet)
                                <div class="col-lg-6 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Sheet No:</label>
                                        <input type="number" wire:model="sheet_no"
                                            class="form-control @error('sheet_no') is-invalid @enderror"
                                            value="{{ old('sheet_no') }}">
                                        @error('sheet_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group mb-2">
                                        <label for="">Sheet Quantity:</label>
                                        <input type="number" wire:model="sheet_quantity"
                                            class="form-control @error('sheet_quantity') is-invalid @enderror"
                                            value="{{ old('sheet_quantity') }}">
                                        @error('sheet_quantity')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            @endif
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="">Quantity:</label>
                                    <input type="number" wire:model="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        value="{{ old('quantity') }}" {{$enable_sheet ? 'readonly' : ''}}>
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="">Unit Price:</label>
                                    <input type="number" wire:model="unit_price"
                                        class="form-control @error('unit_price') is-invalid @enderror"
                                        value="{{ old('unit_price') }}" step="any">
                                    @error('unit_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="">Total:</label>
                                    <input type="number" wire:model="total"
                                        class="form-control @error('total') is-invalid @enderror" value="100" readonly>
                                    @error('total')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-danger" wire:click="reset_form">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="mb-0">All Materials</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mt-5">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Material Name</th>
                                <th>Type</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Total</th>
                                @can('delete-material')
                                <th>Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @if ($estimated_materials)
                            @php
                                $sr_no = 1;
                            @endphp
                            @forelse ($estimated_materials as $item)
                                <tr>
                                    <td>{{$sr_no++}}</td>
                                    <td>{{$item->material_name}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->unit_price}}</td>
                                    <td>{{$item->total}}</td>
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
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end">Grand Total</td>
                                <td colspan="2">
                                    <input type="number" step="any" class="form-control" id="total_estimate_cost"
                                        wire:model="total_estimate_cost" value="0" readonly>

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" wire:click="store">Save Estimate Cost</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script>
     $('#material_date').flatpickr();
    $('#material_id').select2({
        placeholder: "Select an option"
    });
    $("#material_id").on('change', function(event) {
        let value = $(this).val();
        let element = event.target.id;
        @this.set(element, value);
    });

    $('#material_type_id').select2({
        placeholder: "Select an option"
    });
    $("#material_type_id").on('change', function(event) {
        let value = $(this).val();
        let element = event.target.id;
        @this.set(element, value);
    });
    window.addEventListener('render_select2', event => {
        $('#material_id').select2({
            placeholder: "Please select an option",
        });
        $('#material_type_id').select2({
            placeholder: "Select an option"
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

