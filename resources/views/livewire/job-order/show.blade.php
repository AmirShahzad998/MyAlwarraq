<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="form-group mb-2">
                                <label for="">Order No</label>
                                <input class="form-control" value="{{$jobOrder->order_no}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group mb-2">
                                <label for="">Order Date</label>
                                <input class="form-control" value="{{$jobOrder->order_date}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group mb-2">
                                <label for="">Customer Name</label>
                                <input class="form-control" value="{{$jobOrder->customer->customer_name}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="form-group mb-2">
                                <label for="">Order Type</label>
                                <input class="form-control" value="{{$jobOrder->order_type}}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-8 col-12">
                            <div class="form-group mb-2">
                                <label for="">Description</label>
                                <input class="form-control" value="{{$jobOrder->description}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                            aria-selected="true">
                            Estimate
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                            aria-selected="false">
                            Actual Buying Cost
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                                        <h4 class="mb-0">Add Material</h4>
                                    </div>
                                    <div class="card-body mt-3">
                                        <form wire:submit.prevent="store">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="from-group mb-2">
                                                        <label for="">Material Name:</label>
                                                        <select wire:model="material_id"
                                                            class="form-control @error('material_id') is-invalid @enderror" id="material_id">
                                                            <option value=""></option>
                                                            @foreach ($materials as $item)
                                                                <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('customer_id')
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
                            <div class="col-lg-8 col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                                        <h4 class="mb-0">Materials</h4>
                                    </div>
                                    <div class="card-body mt-3">
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                                        <h4 class="mb-0">Add Material</h4>
                                    </div>
                                    <div class="card-body mt-3">
                                        <form wire:submit.prevent="store">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="from-group mb-2">
                                                        <label for="">Material Name:</label>
                                                        <select wire:model="material_id"
                                                            class="form-control @error('material_id') is-invalid @enderror" id="material_id">
                                                            <option value=""></option>
                                                            @foreach ($materials as $item)
                                                                <option value="{{ $item->id }}">{{ $item->customer_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('customer_id')
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
                            <div class="col-lg-8 col-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center justify-content-between shadow mb-4">
                                        <h4 class="mb-0">Materials</h4>
                                    </div>
                                    <div class="card-body mt-3">
        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade show" id="material_modal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit="store_material">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="nameLarge" class="form-label">Material Name</label>
                                        <select id="nameLarge" class="form-control">
                                            <option value=""></option>
                                            @foreach ($all_materials as $item)
                                                <option value="{{ $item->id }}">{{ $item->material_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group mb-3">
                                        <label for="nameLarge" class="form-label">Name</label>
                                        <input type="text" id="nameLarge" class="form-control"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col mb-3">
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col mb-0">
                                <label for="emailLarge" class="form-label">Email</label>
                                <input type="text" id="emailLarge" class="form-control" placeholder="xxxx@xxx.xx">
                            </div>
                            <div class="col mb-0">
                                <label for="dobLarge" class="form-label">DOB</label>
                                <input type="text" id="dobLarge" class="form-control" placeholder="DD / MM / YY">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" class="btn btn-primary">Save changes</button>
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
