<div>
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                    <h4 class="mb-0">Job Order</h4>
                    <span href="{{ route('material.create') }}" class="badge bg-danger text-end">{{$order_no}}</span>

                </div>
                <div class="card-body mt-3">
                    <form wire:submit.prevent="store">
                        <div class="row">
                            <div class="col-12">
                                <div class="from-group mb-2">
                                    <label for="">Customer Name:</label>
                                    <select wire:model="customer_id"
                                        class="form-control @error('customer_name') is-invalid @enderror" id="customer_id">
                                        <option value=""></option>
                                        @foreach ($customers as $item)
                                            <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('customer_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Order No:</label>
                                    <input type="text" wire:model="order_no"
                                        class="form-control @error('order_no') is-invalid @enderror" id="order_no"
                                        value="{{ old('order_no') }}">
                                    @error('order_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="">Order Date:</label>
                                    <input type="date" wire:model="order_date"
                                        class="form-control bg-white @error('order_date') is-invalid @enderror" id="order_date"
                                        value="{{ old('order_date') }}">
                                    @error('order_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="">Order Type:</label>
                                    <input type="text" wire:model="order_type"
                                        class="form-control @error('order_type') is-invalid @enderror"
                                        value="{{ old('order_type') }}">
                                    @error('order_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="">Description:</label>
                                    <input type="text" wire:model="description"
                                        class="form-control @error('description') is-invalid @enderror"
                                        value="{{ old('description') }}">
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label for="">Quantity:</label>
                                    <input type="number" wire:model="quantity"
                                        class="form-control @error('quantity') is-invalid @enderror"
                                        value="{{ old('quantity') }}">
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
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-danger" wire:click="reset_form">Reset</button>
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
        $('#order_date').flatpickr();
        $('#customer_id').select2({
            placeholder: "Select an option"
        });
        $("#customer_id").on('change', function(event) {
            let value = $(this).val();
            let element = event.target.id;
            @this.set(element, value);
        });
        window.addEventListener('render_select2', event => {
            $('#customer_id').select2({
                placeholder: "Please select an option",
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
